import { ExportResultCode } from '@opentelemetry/core';
import type { ReadableSpan, SpanExporter } from '@opentelemetry/sdk-trace-base';
import { describe, expect, it, vi } from 'vitest';
import { SanitizingExporter, stripQueryAndFragment } from './browser-tracing';

const span = (name: string, attributes: Record<string, unknown>) => ({ name, attributes }) as unknown as ReadableSpan;

describe('stripQueryAndFragment', () => {
  it('keeps the origin and path only', () => {
    expect(stripQueryAndFragment('https://beta.hammertime.cyou/en/app?t=1&token=x#frag')).toBe('https://beta.hammertime.cyou/en/app');
    expect(stripQueryAndFragment('/en/app')).toBe('/en/app');
  });
});

describe('SanitizingExporter', () => {
  const exporter = () => {
    const inner: SpanExporter = { export: vi.fn(), shutdown: vi.fn(async () => undefined) };
    return { inner, sanitizing: new SanitizingExporter(inner) };
  };

  it('removes query strings from url attributes and drops url.query', () => {
    const { inner, sanitizing } = exporter();
    const documentFetch = span('documentFetch', { 'url.full': 'https://x.test/en?a=1', 'http.url': '/en?b=2', 'url.query': 'a=1', 'user_agent.original': 'UA' });

    sanitizing.export([documentFetch], vi.fn());

    expect(inner.export).toHaveBeenCalledOnce();
    expect(documentFetch.attributes).toEqual({ 'url.full': 'https://x.test/en', 'http.url': '/en', 'user_agent.original': 'UA' });
  });

  it('drops per-resource spans and does not call the exporter when nothing is left', () => {
    const { inner, sanitizing } = exporter();
    const callback = vi.fn();

    sanitizing.export([span('resourceFetch', {})], callback);

    expect(inner.export).not.toHaveBeenCalled();
    expect(callback).toHaveBeenCalledWith({ code: ExportResultCode.SUCCESS });
  });
});
