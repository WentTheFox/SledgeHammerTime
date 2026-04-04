import md5 from 'md5';

export const AVATAR_PROVIDERS = ['discord', 'gravatar', 'crowdin'] as const;
export type AvatarProviderName = typeof AVATAR_PROVIDERS[number];

export function gravatarEmailToHash(email: string): string {
  return md5(email.trim().toLowerCase());
}
