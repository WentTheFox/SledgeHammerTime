import md5 from 'md5';

export const AVATAR_PROVIDERS = ['discord', 'gravatar', 'libravatar', 'crowdin'] as const;
export type AvatarProviderName = typeof AVATAR_PROVIDERS[number];

export function avatarEmailToHash(email: string): string {
  return md5(email.trim().toLowerCase());
}
