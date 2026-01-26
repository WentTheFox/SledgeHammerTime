import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { UnwrapRef } from 'vue';

export const MISSING_ROUTE_HREF = '#missing';

const parameterRequiredRegex = /Ziggy error: '([^']+)' parameter is required/i;
const missingRouteRegex = /Ziggy error: route '([^']+)' is not in the route list/i;

interface SafeRouteParams {
  routeParams: UnwrapRef<ReturnType<typeof useRouteParams>>;
  additionalParameters?: Record<string, string>;
  absolute?: boolean;
}

export const safeRoute = (routeName: string, route: ReturnType<typeof useRoute>, restParams: SafeRouteParams): string => {
  const {
    routeParams,
    additionalParameters,
    absolute = true,
  } = restParams;
  const currentParams = { ...routeParams, ...additionalParameters };
  try {
    return route(routeName, currentParams, absolute);
  } catch (e) {
    if (typeof e === 'object' && e !== null && 'message' in e && typeof e.message === 'string') {
      const parameterMatch = e.message.match(parameterRequiredRegex);
      if (parameterMatch) {
        const [, requiredParameterName] = parameterMatch;
        // Brute-force the required parameters
        console.warn(new Error(`Route ${routeName} missing required parameter ${requiredParameterName}`));
        return safeRoute(routeName, route, {
          ...restParams,
          additionalParameters: {
            ...restParams.additionalParameters,
            [requiredParameterName]: '',
          },
        });
      }
      if (missingRouteRegex.test(e.message)) {
        return MISSING_ROUTE_HREF;
      }
    }
  }

  return `#${routeName}-${Object.entries(currentParams).map(([k, v]) => `${k}:${String(v)}`).join(',')}`;
};
