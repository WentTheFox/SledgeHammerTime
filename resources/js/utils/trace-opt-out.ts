/**
 * Visitors can opt out of performance monitoring on the privacy policy page. The choice is a plain persistent cookie
 * (deliberately not HttpOnly, so the page can show and renew it); the server reads it from the request (public/index.php
 * for PHP and AppServiceProvider for the SSR request). While it is set, nothing is recorded for the visitor.
 */
export const TRACE_OPT_OUT_COOKIE = 'ht_trace_optout';
/**
 * The longest a cookie can last in Chrome and Firefox, which is what the cookie asks for. Safari is stricter for
 * cookies written by JavaScript (about 7 days). The cookie is written again on every page load (see renewTraceOptOut),
 * which starts the period over.
 */
export const COOKIE_MAX_AGE_DAYS = 400;
const COOKIE_MAX_AGE_SECONDS = COOKIE_MAX_AGE_DAYS * 24 * 60 * 60;

export const hasTraceOptOutCookie = (cookieString: string): boolean =>
  cookieString.split(';').some((part) => {
    const partTrimmed = part.trim();
    return partTrimmed.startsWith(`${TRACE_OPT_OUT_COOKIE}=`) && /=\d+$/.test(partTrimmed);
  });

export const buildTraceOptOutCookie = (optedOut: boolean, secure: boolean, now = new Date()): string => {
  // Persist the expected expiry date as the cookie value to be able to show expiry
  const cookieValue = optedOut ? String(now.getTime() + (COOKIE_MAX_AGE_SECONDS * 1000)) : '';
  return `${TRACE_OPT_OUT_COOKIE}=${cookieValue}; Max-Age=${optedOut ? COOKIE_MAX_AGE_SECONDS : 0}; Path=/; SameSite=Lax${secure ? '; Secure' : ''}`;
};

export const isTraceOptedOut = (): boolean => typeof document !== 'undefined' && hasTraceOptOutCookie(document.cookie);

export const setTraceOptOut = (optedOut: boolean): void => {
  document.cookie = buildTraceOptOutCookie(optedOut, window.location.protocol === 'https:');
};

/** Starts the 400 days over: called on every page load, so the choice does not expire for someone who keeps visiting */
export const renewTraceOptOut = (): void => {
  if (isTraceOptedOut()) {
    setTraceOptOut(true);
  }
};

/** What is assumed for a cookie whose expiry the browser does not report: the lifetime the cookie asks for, which Chrome and Firefox allow as a maximum */
export const ASSUMED_COOKIE_LIFETIME_MS = COOKIE_MAX_AGE_SECONDS * 1000;

/** The expiry the browser reports for the cookie (epoch milliseconds), or null when it does not: only the Cookie Store API has it, and not in every browser */
const getReportedTraceOptOutExpiry = async (): Promise<number | null> => {
  if (typeof window === 'undefined' || !('cookieStore' in window)) {
    return null;
  }
  try {
    // `expires` is part of the specification, TypeScript's DOM types do not have it yet
    const cookie = await window.cookieStore.get(TRACE_OPT_OUT_COOKIE) as (CookieListItem & { expires?: number | null }) | null;

    // Does not work in firefox
    if (typeof cookie?.expires === 'number') {
      return cookie.expires;
    }

    // Fall back to stored cookie value if it's >1 (logic used ot set 1 prior to this change)
    const valueNumber = parseInt(cookie?.value ?? '', 10);
    if (!isNaN(valueNumber) && isFinite(valueNumber) && valueNumber > 1) {
      return valueNumber;
    }
  } catch (error) {
    console.debug('getReportedTraceOptOutExpiry error', error);
  }
  return null;
};

/**
 * When the opt-out cookie expires (epoch milliseconds), or null when the visitor is not opted out. It is what the
 * browser reports, which can be less than was asked for. Firefox does not report it, so then the longest lifetime the
 * browsers allow is assumed, counted from now: the cookie is renewed on every page load, so it starts over then.
 */
export const getTraceOptOutExpiry = async (): Promise<number | null> => {
  if (!isTraceOptedOut()) {
    return null;
  }

  return await getReportedTraceOptOutExpiry() ?? Date.now() + ASSUMED_COOKIE_LIFETIME_MS;
};
