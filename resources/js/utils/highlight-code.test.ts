import { describe, expect, it } from 'vitest';
import { highlightCode } from './highlight-code';

const typesOf = (code: string, language: 'shell' | 'json') => highlightCode(code, language)
  .filter(token => token.type !== 'plain')
  .map(token => `${token.type}:${token.text}`);

describe('highlightCode', () => {
  it('colors the command, flags and quoted strings of a shell example', () => {
    const code = 'curl https://api.example/at \\\n  -H "Authorization: Bearer 42|htk_x" \\\n  -d \'{"hour": 18}\'';

    expect(typesOf(code, 'shell')).toEqual([
      'command:curl',
      'punctuation:\\',
      'flag:-H',
      'string:"Authorization: Bearer 42|htk_x"',
      'punctuation:\\',
      'flag:-d',
      'string:\'{"hour": 18}\'',
    ]);
  });

  it('knows a long flag from a value that merely contains a dash', () => {
    expect(typesOf('claude mcp add --transport http hammer-time', 'shell')).toEqual(['command:claude', 'flag:--transport']);
  });

  it('separates the keys of a JSON example from its values', () => {
    expect(typesOf('{"a": {"b": [1, true, "x"]}}', 'json')).toEqual([
      'punctuation:{', 'key:"a"', 'punctuation::', 'punctuation:{', 'key:"b"', 'punctuation::', 'punctuation:[',
      'number:1', 'punctuation:,', 'number:true', 'punctuation:,', 'string:"x"', 'punctuation:]', 'punctuation:}', 'punctuation:}',
    ]);
  });

  it('never drops or changes any text', () => {
    const shell = 'curl -X POST "a b" \\\n  --data \'{"x": 1}\' trailing';
    const json = JSON.stringify({ a: [1, 2.5, -3e2, null, 'é"\\'], b: { c: false } }, null, 2);

    expect(highlightCode(shell, 'shell').map(token => token.text).join('')).toBe(shell);
    expect(highlightCode(json, 'json').map(token => token.text).join('')).toBe(json);
  });
});
