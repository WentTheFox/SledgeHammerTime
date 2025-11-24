import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { UnwrapRef } from 'vue';

const parameterRequiredRegex = /Ziggy error: '([^']+)' parameter is required/i;
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
    }
  }

  return `#${routeName}-${Object.entries(currentParams).map(([k, v]) => `${k}:${String(v)}`).join(',')}`;
};
