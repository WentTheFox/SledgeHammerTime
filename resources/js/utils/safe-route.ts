import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { UnwrapRef } from 'vue';

export const MISSING_ROUTE_HREF = '#missing';

const parameterRequiredRegex = /Ziggy error: '([^']+)' parameter is required/i;
const missingRouteRegex = /Ziggy error: route '([^']+)' is not in the route list/i;
export const safeRoute = (routeName: string, route: ReturnType<typeof useRoute>, routeParams: UnwrapRef<ReturnType<typeof useRouteParams>>, additionalParameters?: Record<string, string>): string => {
  const currentParams = { ...routeParams, ...additionalParameters };
  try {
    return route(routeName, currentParams);
  } catch (e) {
    if (typeof e === 'object' && e !== null && 'message' in e && typeof e.message === 'string') {
      const parameterMatch = e.message.match(parameterRequiredRegex);
      if (parameterMatch) {
        const [, requiredParameterName] = parameterMatch;
        // Brute-force the required parameters
        console.warn(new Error(`Route ${routeName} missing required parameter ${requiredParameterName}`));
        return safeRoute(routeName, route, routeParams, {
          ...additionalParameters,
          [requiredParameterName]: '',
        });
      }
      if (missingRouteRegex.test(e.message)) {
        return MISSING_ROUTE_HREF;
      }
    }
  }

  return `#${routeName}-${Object.entries(currentParams).map(([k, v]) => `${k}:${String(v)}`).join(',')}`;
};
