// Loaded with `node --require` before the SSR server. Tracing is opt-in and configured purely through the standard
// OTEL_* environment variables: without OTEL_EXPORTER_OTLP_ENDPOINT (or OTEL_EXPORTER_OTLP_TRACES_ENDPOINT), or with
// OTEL_SDK_DISABLED=true, this file does nothing and no OpenTelemetry code is even loaded.
// Only the http instrumentation is used (instead of auto-instrumentations-node, which pulls in ~50 instrumentations) as
// the SSR process runs with a small heap: the incoming request from PHP carries `traceparent`, which this continues.
const enabled =
  (process.env.OTEL_EXPORTER_OTLP_ENDPOINT || process.env.OTEL_EXPORTER_OTLP_TRACES_ENDPOINT) &&
  process.env.OTEL_SDK_DISABLED !== 'true';

if (enabled) {
  process.env.OTEL_SERVICE_NAME ||= 'sledgehammertime-ssr';
  process.env.OTEL_EXPORTER_OTLP_PROTOCOL ||= 'http/protobuf';
  const { NodeSDK } = require('@opentelemetry/sdk-node');
  const { HttpInstrumentation } = require('@opentelemetry/instrumentation-http');
  const sdk = new NodeSDK({ instrumentations: [new HttpInstrumentation()] });
  sdk.start();
  process.on('SIGTERM', () => {
    sdk.shutdown().finally(() => process.exit(0));
  });
}
