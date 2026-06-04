import { AxiosInstance } from 'axios';
import { Config as ZiggyConfig } from 'ziggy-js';
import { PageProps as AppPageProps } from './';

declare global {
  interface Window {
    axios: AxiosInstance;
  }

  const Ziggy: ZiggyConfig;
}

declare module '@inertiajs/core' {
  export interface InertiaConfig {
    sharedPageProps: AppPageProps;
  }
}

export {};
