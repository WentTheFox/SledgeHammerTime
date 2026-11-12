// Loaded with `node --require` before the SSR server: continuous profiling (Grafana Pyroscope), wall and CPU time.
// Opt-in and configured through the environment: it does nothing, and the profiler is not even loaded, unless
// PYROSCOPE_SERVER_ADDRESS is set. Profiles are function names, files and lines; the only tags are the environment
// and the version, never anything about a request or a visitor.
const serverAddress = process.env.PYROSCOPE_SERVER_ADDRESS;

if (serverAddress) {
  const Pyroscope = require('@pyroscope/nodejs');
  // Same value as the deployment.environment of the traces, so profiles and traces are filtered the same way
  const resourceEnvironment = /(?:^|,)deployment\.environment=([^,]+)/.exec(process.env.OTEL_RESOURCE_ATTRIBUTES || '')?.[1];
  const tags = { env: process.env.PYROSCOPE_ENVIRONMENT || resourceEnvironment || process.env.NODE_ENV || 'production' };
  if (process.env.GIT_COMMIT_HASH) {
    tags.version = process.env.GIT_COMMIT_HASH;
  }
  Pyroscope.init({
    serverAddress,
    appName: process.env.PYROSCOPE_APPLICATION_NAME || 'sledgehammertime-ssr',
    tags,
    flushIntervalMs: Number(process.env.PYROSCOPE_FLUSH_INTERVAL_MS) || undefined,
    wall: { collectCpuTime: true },
  });
  Pyroscope.start();
}
