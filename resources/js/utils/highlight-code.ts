export type CodeLanguage = 'shell' | 'json';

export type TokenType = 'command' | 'flag' | 'string' | 'number' | 'key' | 'punctuation' | 'plain';

export interface CodeToken {
  type: TokenType;
  text: string;
}

const SHELL_TOKEN = /("(?:\\.|[^"\\])*"|'(?:[^'\\]|\\.)*')|((?<!\S)--?[A-Za-z][\w-]*)|(\\$)|(\s+)|([^\s"']+)/gm;
const JSON_TOKEN = /("(?:\\.|[^"\\])*")(\s*:)?|(-?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?)|(true|false|null)|([{}[\],:])|(\s+)|(.)/g;

/**
 * A small tokenizer for the few examples the API page shows, so they get colors without a highlighting library.
 * Not a parser: anything it does not recognise comes out as plain text, and joining the tokens gives back the input.
 */
const tokenizeShell = (code: string): CodeToken[] => {
  const tokens: CodeToken[] = [];
  let expectCommand = true;
  for (const match of code.matchAll(SHELL_TOKEN)) {
    const [text, quoted, flag, continuation, whitespace] = match;
    if (quoted !== undefined) {
      tokens.push({ type: 'string', text });
    } else if (flag !== undefined) {
      tokens.push({ type: 'flag', text });
    } else if (continuation !== undefined) {
      tokens.push({ type: 'punctuation', text });
      expectCommand = false;
    } else if (whitespace !== undefined) {
      tokens.push({ type: 'plain', text });
    } else if (expectCommand) {
      tokens.push({ type: 'command', text });
      expectCommand = false;
    } else {
      tokens.push({ type: 'plain', text });
    }
  }
  return tokens;
};

const tokenizeJson = (code: string): CodeToken[] => {
  const tokens: CodeToken[] = [];
  for (const match of code.matchAll(JSON_TOKEN)) {
    const [text, string, afterKey, number, literal, punctuation] = match;
    if (string !== undefined) {
      tokens.push({ type: afterKey === undefined ? 'string' : 'key', text: string });
      if (afterKey !== undefined) tokens.push({ type: 'punctuation', text: afterKey });
    } else if (number !== undefined || literal !== undefined) {
      tokens.push({ type: 'number', text });
    } else if (punctuation !== undefined) {
      tokens.push({ type: 'punctuation', text });
    } else {
      tokens.push({ type: 'plain', text });
    }
  }
  return tokens;
};

export const highlightCode = (code: string, language: CodeLanguage): CodeToken[] => (
  language === 'json' ? tokenizeJson(code) : tokenizeShell(code)
);
