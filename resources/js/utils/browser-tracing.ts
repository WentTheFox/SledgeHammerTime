import { context, propagation, ROOT_CONTEXT } from '@opentelemetry/api';
import { ExportResultCode, W3CTraceContextPropagator } from '@opentelemetry/core';
import { OTLPTraceExporter } from '@opentelemetry/exporter-trace-otlp-http';
import { registerInstrumentations } from '@opentelemetry/instrumentation';
import { DocumentLoadInstrumentation } from '@opentelemetry/instrumentation-document-load';
import { FetchInstrumentation } from '@opentelemetry/instrumentation-fetch';
import { XMLHttpRequestInstrumentation } from '@opentelemetry/instrumentation-xml-http-request';
import { resourceFromAttributes } from '@opentelemetry/resources';
import {
  AlwaysOffSampler,
  BatchSpanProcessor,
  ParentBasedSampler,
  ReadableSpan,
  SpanExporter,
  TraceIdRatioBasedSampler,
} from '@opentelemetry/sdk-trace-base';
import { WebTracerProvider } from '@opentelemetry/sdk-trace-web';
import { type Metric, onCLS, onINP, onLCP } from 'web-vitals';

export type BrowserTracingConfig = {
  serviceName: string;
  environment: string;
  /** Same-origin path that is proxied to the OTLP/HTTP traces endpoint of the collector */
  endpoint: string;
  /** 0-1, the share of traces that is recorded */
  sampleRatio: number;
};

const URL_ATTRIBUTES = ['url.full', 'http.url', 'http.target'];

/**
 * Removes the fragment: it never reaches the server and can hold tokens in some OAuth flows. The query string is kept
 * (as on the server spans), the collector redacts the values of credential-looking parameters for every span.
 */
export const stripFragment = (url: string): string => url.replace(/#.*$/, '');

/**
 * Privacy: timings and page URLs only. Everything leaves the browser through here, so it is the single place that
 * removes URL fragments (and per-resource spans, which would be a lot of volume for little value).
 */
export class SanitizingExporter implements SpanExporter {
  constructor(private readonly inner: SpanExporter) {
  }

  export(spans: ReadableSpan[], resultCallback: Parameters<SpanExporter['export']>[1]): void {
    const kept = spans.filter((span) => span.name !== 'resourceFetch');
    kept.forEach((span) => {
      const attributes = span.attributes as Record<string, unknown>;
      URL_ATTRIBUTES.forEach((key) => {
        if (typeof attributes[key] === 'string') {
          attributes[key] = stripFragment(attributes[key]);
        }
      });
    });
    if (kept.length === 0) {
      resultCallback({ code: ExportResultCode.SUCCESS });
      return;
    }
    this.inner.export(kept, resultCallback);
  }

  shutdown(): Promise<void> {
    return this.inner.shutdown();
  }

  forceFlush(): Promise<void> {
    return this.inner.forceFlush?.() ?? Promise.resolve();
  }
}

/** The server sends the trace context of the page request as `Server-Timing: traceparent;desc="00-..."` */
const readServerTraceparent = (): string | undefined => {
  const navigation = performance.getEntriesByType('navigation')[0] as PerformanceNavigationTiming | undefined;
  return navigation?.serverTiming?.find((entry) => entry.name === 'traceparent')?.description || undefined;
};

export function startBrowserTracing(config: BrowserTracingConfig): void {
  const ratioSampler = new TraceIdRatioBasedSampler(config.sampleRatio);
  const provider = new WebTracerProvider({
    resource: resourceFromAttributes({
      'service.name': config.serviceName,
      'deployment.environment': config.environment,
    }),
    // The page's own trace id comes from the server, so this is a decision by trace id for those as well
    sampler: new ParentBasedSampler({
      root: ratioSampler,
      remoteParentSampled: ratioSampler,
      remoteParentNotSampled: new AlwaysOffSampler(),
    }),
    spanProcessors: [new BatchSpanProcessor(new SanitizingExporter(new OTLPTraceExporter({ url: config.endpoint })))],
  });
  provider.register({ propagator: new W3CTraceContextPropagator() });

  // instrumentation-document-load only reads the server's trace context from a <meta name="traceparent">. That tag is
  // not rendered by the server (cached HTML would carry a stale id), it is created here from the response header.
  const traceparent = readServerTraceparent();
  if (traceparent && !document.querySelector('meta[name="traceparent"]')) {
    const meta = document.createElement('meta');
    meta.name = 'traceparent';
    meta.content = traceparent;
    document.head.append(meta);
  }

  // Same-origin only: propagateTraceHeaderCorsUrls is empty, so third parties never get a traceparent header
  const ignoreUrls = [new RegExp(`^(https?://[^/]+)?${config.endpoint.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')}`)];
  registerInstrumentations({
    tracerProvider: provider,
    instrumentations: [
      new DocumentLoadInstrumentation(),
      new FetchInstrumentation({ ignoreUrls, propagateTraceHeaderCorsUrls: [] }),
      new XMLHttpRequestInstrumentation({ ignoreUrls, propagateTraceHeaderCorsUrls: [] }),
    ],
  });

  const pageContext = traceparent ? propagation.extract(ROOT_CONTEXT, { traceparent }) : context.active();
  const tracer = provider.getTracer('web-vitals');
  const report = (metric: Metric) => {
    tracer.startSpan(`web-vital.${metric.name}`, {
      attributes: {
        'web_vital.name': metric.name,
        'web_vital.value': metric.value,
        'web_vital.rating': metric.rating,
        'web_vital.navigation_type': metric.navigationType,
        'url.path': location.pathname,
      },
    }, pageContext).end();
  };
  onLCP(report);
  onCLS(report);
  onINP(report);

  // Web vitals are final when the page is hidden, which is also the last chance to send what is still batched
  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'hidden') {
      void provider.forceFlush();
    }
  });
}
