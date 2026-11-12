import { renderToString } from '@vue/server-renderer';
import { i18nVue } from 'laravel-vue-i18n';
import { createSSRApp, h } from 'vue';
import { describe, expect, it } from 'vitest';
import HtTranslate from './HtTranslate.vue';

// The library loads the translations of a language once, so all strings of this file are provided together
const translations: Record<string, string> = {
  'test.afterText': 'We do this (<1>GDPR Article 6(1)(f)</1>).',
  'test.atStart': '<0/> operates the site',
  'test.wrongIndex': 'We do this (<0>GDPR Article 6(1)(f)</0>).',
};

const render = async (key: string, slots: Record<string, (props: { text: string }) => unknown>) => {
  const app = createSSRApp({
    render: () => h(HtTranslate, { i18nKey: key }, slots),
  });
  app.use(i18nVue, { lang: 'en', resolve: () => translations });

  return renderToString(app);
};

const link = ({ text }: { text: string }) => h('a', { href: '#x' }, text);

describe('HtTranslate tag indexes', () => {
  it('numbers a tag after leading text as 1: text nodes count as well', async () => {
    const html = await render('test.afterText', { 1: link });

    expect(html).toContain('We do this (');
    expect(html).toContain('<a href="#x">GDPR Article 6(1)(f)</a>');
    expect(html).toContain(').');
  });

  it('numbers a self-closing tag at the very start of the string as 0', async () => {
    const html = await render('test.atStart', { 0: () => h('b', 'Developer') });

    expect(html).toContain('<b>Developer</b>');
    expect(html).toContain(' operates the site');
  });

  it('with <0> after leading text the link would wrap the leading text, not the tag content', async () => {
    const html = await render('test.wrongIndex', { 0: link });

    expect(html).toContain('<a href="#x">We do this (</a>');
    expect(html).not.toContain('<a href="#x">GDPR Article 6(1)(f)</a>');
  });
});
