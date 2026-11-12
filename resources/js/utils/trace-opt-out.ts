/**
 * Visitors can opt out of performance monitoring on the privacy policy page. The choice is a plain persistent cookie
 * (deliberately not HttpOnly): the browser tracing reads it here, and the server reads it from the request (public/index.php
 * for PHP and AppServiceProvider for the SSR request). While it is set, nothing is recorded for the visitor anywhere.
 */
export const TRACE_OPT_OUT_COOKIE = 'ht_trace_optout';
/** Five years from the moment the cookie is written, which happens again on every page load (see renewTraceOptOut) */
const FIVE_YEARS_SECONDS = 5 * 365 * 24 * 60 * 60;

export const hasTraceOptOutCookie = (cookieString: string): boolean =>
  cookieString.split(';').some((part) => part.trim() === `${TRACE_OPT_OUT_COOKIE}=1`);

export const buildTraceOptOutCookie = (optedOut: boolean, secure: boolean): string =>
  `${TRACE_OPT_OUT_COOKIE}=${optedOut ? '1' : ''}; Max-Age=${optedOut ? FIVE_YEARS_SECONDS : 0}; Path=/; SameSite=Lax${secure ? '; Secure' : ''}`;

export const isTraceOptedOut = (): boolean => typeof document !== 'undefined' && hasTraceOptOutCookie(document.cookie);

export const setTraceOptOut = (optedOut: boolean): void => {
  document.cookie = buildTraceOptOutCookie(optedOut, window.location.protocol === 'https:');
};

/** Starts the five years over: called on every page load, so the choice does not expire for someone who keeps visiting */
export const renewTraceOptOut = (): void => {
  if (isTraceOptedOut()) {
    setTraceOptOut(true);
  }
};
