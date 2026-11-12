import type { PageProps } from '@/types';
import { isTraceOptedOut } from '@/utils/trace-opt-out';

type BrowserTracingProp = NonNullable<PageProps['app']>['browserTracing'];

/**
 * Loads the OpenTelemetry web SDK only when the server enabled browser tracing (default: off), and only once the
 * browser is idle after the page is interactive, so it never competes with the first paint.
 */
export function startBrowserTracingWhenIdle(config: BrowserTracingProp): void {
  if (!config || isTraceOptedOut()) {
    return;
  }
  const start = () => {
    import('@/utils/browser-tracing').then((module) => module.startBrowserTracing(config)).catch(() => {
      // tracing must never break the page
    });
  };
  if ('requestIdleCallback' in window) {
    window.requestIdleCallback(start, { timeout: 5000 });
  } else {
    setTimeout(start, 2000);
  }
}
