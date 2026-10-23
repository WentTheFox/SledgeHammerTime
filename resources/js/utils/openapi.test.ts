import { describe, expect, it } from 'vitest';
import { buildJsonRows, listOperations, OpenApiDocument, resolveSchema, rowsToJson, schemaTypeLabel } from './openapi';

const doc: OpenApiDocument = {
  tags: [{ name: 'timestamps', description: 'Commands' }, { name: 'settings' }, { name: 'empty' }],
  components: {
    schemas: {
      Item: { type: 'object', properties: { format: { type: 'string', description: 'A style' } }, required: ['format'] },
      Reply: {
        type: 'object',
        required: ['unix'],
        properties: {
          unix: { type: 'integer', description: 'Seconds' },
          note: { type: 'string', nullable: true },
          formats: { type: 'array', items: { $ref: '#/components/schemas/Item' } },
          hour: { anyOf: [{ type: 'string' }, { type: 'number' }], description: 'Text or a number' },
          mode: { type: 'string', enum: ['a', 'b'] },
          count: { type: 'integer', minimum: 1, maximum: 12 },
        },
      },
    },
  },
  paths: {
    '/b': { get: { tags: ['settings'], summary: 'B' } },
    '/a': { post: { tags: ['timestamps'], summary: 'A' }, get: { tags: ['timestamps'], summary: 'A get' } },
  },
};

describe('resolveSchema', () => {
  it('follows references', () => {
    expect(resolveSchema({ $ref: '#/components/schemas/Item' }, doc)?.type).toBe('object');
  });

  it('gives up on a reference that points nowhere', () => {
    expect(resolveSchema({ $ref: '#/components/schemas/Missing' }, doc)).toBeUndefined();
  });
});

describe('schemaTypeLabel', () => {
  it('names plain, array and alternative types', () => {
    expect(schemaTypeLabel({ type: 'integer' }, doc)).toBe('integer');
    expect(schemaTypeLabel({ type: 'array', items: { $ref: '#/components/schemas/Item' } }, doc)).toBe('object[]');
    expect(schemaTypeLabel({ anyOf: [{ type: 'string' }, { type: 'number' }] }, doc)).toBe('string | number');
  });
});

describe('listOperations', () => {
  it('groups by the tags in the order of the document, and leaves out tags without operations', () => {
    const groups = listOperations(doc);

    expect(groups.map(group => group.tag)).toEqual(['timestamps', 'settings']);
    expect(groups[0].description).toBe('Commands');
    expect(groups[0].operations.map(entry => `${entry.method} ${entry.path}`)).toEqual(['get /a', 'post /a']);
  });
});

describe('buildJsonRows', () => {
  const reply = { $ref: '#/components/schemas/Reply' };
  const example = { unix: 1792773000, note: null, formats: [{ format: 'd' }, { format: 'R' }], hour: 18, mode: 'b', count: 3 };
  const rows = buildJsonRows(reply, doc, example);

  it('makes valid JSON of the example, one row per line', () => {
    expect(JSON.parse(rowsToJson(rows))).toEqual({ ...example, formats: [{ format: 'd' }] });
  });

  it('shows one item of an array of objects, indented under it', () => {
    expect(rows.map(row => `${row.depth}:${row.line}`)).toEqual([
      '0:{', '1:"unix": 1792773000,', '1:"note": null,', '1:"formats": [', '2:{', '3:"format": "d"', '2:}', '1:],',
      '1:"hour": 18,', '1:"mode": "b",', '1:"count": 3', '0:}',
    ]);
  });

  it('says what each property is', () => {
    const byLine = (start: string) => rows.find(row => row.line.startsWith(start))?.annotation;

    expect(byLine('"unix"')).toEqual({ type: 'integer', optional: false, description: 'Seconds', constraints: [], choices: undefined });
    expect(byLine('"note"')).toMatchObject({ type: 'string | null', optional: true });
    expect(byLine('"hour"')).toMatchObject({ type: 'string | number' });
    expect(byLine('"mode"')?.choices).toEqual(['a', 'b']);
    // null among the values of a nullable enum is not a choice
    expect(buildJsonRows({ type: 'string', nullable: true, enum: ['x', null] }, doc, 'x')).toHaveLength(1);
    expect(byLine('"format"')).toMatchObject({ optional: false, description: 'A style' });
    expect(rows[0].annotation).toBeNull();
  });

  it('lists the bounds of a property and the names of the values of an enum', () => {
    const labelled: OpenApiDocument = {
      ...doc,
      components: { schemas: { Body: { type: 'object', properties: {
        month: { type: 'integer', minimum: 1, maximum: 12 },
        tz: { type: 'string', minLength: 3, maxLength: 9 },
        style: { type: 'string', enum: ['d', 'R'], 'x-enum-labels': { d: 'short date' } },
      } } } },
    };
    const body = buildJsonRows({ $ref: '#/components/schemas/Body' }, labelled);
    const byLine = (start: string) => body.find(row => row.line.startsWith(start))?.annotation;

    expect(byLine('"month"')?.constraints).toEqual(['min 1', 'max 12']);
    expect(byLine('"tz"')?.constraints).toEqual(['min length 3', 'max length 9']);
    expect(byLine('"style"')?.choices).toEqual(['d (short date)', 'R']);
    // A placeholder that respects the bound, so the copied body is not outright invalid
    expect(JSON.parse(rowsToJson(body)).month).toBe(1);
  });

  it('fills what the example leaves out with a placeholder of the right type', () => {
    const bare = buildJsonRows(reply, doc, {});

    expect(JSON.parse(rowsToJson(bare))).toMatchObject({ unix: 0, note: 'string', mode: 'a', count: 1 });
  });

  it('uses the example of the schema when none is given', () => {
    const withExample: OpenApiDocument = { ...doc, components: { schemas: { ...doc.components?.schemas, Reply: { ...doc.components!.schemas!.Reply, example } } } };

    expect(JSON.parse(rowsToJson(buildJsonRows(reply, withExample)))).toMatchObject({ unix: 1792773000, mode: 'b' });
  });
});
