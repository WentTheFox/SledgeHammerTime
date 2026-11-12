/**
 * Visitors can opt out of performance monitoring on the privacy policy page. The choice is a plain persistent cookie
 * (deliberately not HttpOnly, so the page can show and renew it); the server reads it from the request (public/index.php
 * for PHP and AppServiceProvider for the SSR request). While it is set, nothing is recorded for the visitor.
 */
export const TRACE_OPT_OUT_COOKIE = 'ht_trace_optout';
/**
 * Asked for, but browsers may allow less (Chrome: 400 days, Safari: 7 days for cookies written by JavaScript). It is written
 * again on every page load (see renewTraceOptOut), which starts the period over.
 */
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

/**
 * When the browser says the cookie expires (epoch milliseconds), which can be less than was asked for, or null when the
 * cookie is not set or the browser cannot tell: only the Cookie Store API reports expiry, `document.cookie` does not.
 */
export const getTraceOptOutExpiry = async (): Promise<number | null> => {
  if (typeof window === 'undefined' || !('cookieStore' in window)) {
    return null;
  }
  try {
    // `expires` is part of the specification, TypeScript's DOM types do not have it yet
    const cookie = await window.cookieStore.get(TRACE_OPT_OUT_COOKIE) as { expires?: number | null } | null;

    return typeof cookie?.expires === 'number' ? cookie.expires : null;
  } catch {
    return null;
  }
};
