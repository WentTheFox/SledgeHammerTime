/**
 * The parts of an OpenAPI 3.0 document that the API page shows. The document comes from the API server, which builds it
 * from the same schemas it validates requests with, so what is listed here is what the API accepts.
 */
export interface OpenApiSchema {
  $ref?: string;
  type?: string;
  description?: string;
  nullable?: boolean;
  enum?: (string | number | boolean | null)[];
  minimum?: number;
  maximum?: number;
  minLength?: number;
  maxLength?: number;
  properties?: Record<string, OpenApiSchema>;
  required?: string[];
  items?: OpenApiSchema;
  anyOf?: OpenApiSchema[];
  oneOf?: OpenApiSchema[];
  example?: unknown;
  /** The names of the values of an enum, by value, which the API adds for the options that have some */
  'x-enum-labels'?: Record<string, string>;
}

export interface OpenApiMediaContent {
  content?: Record<string, { schema?: OpenApiSchema }>;
}

export interface OpenApiOperation {
  operationId?: string;
  tags?: string[];
  summary?: string;
  description?: string;
  security?: Record<string, string[]>[];
  'x-required-scope'?: string;
  requestBody?: OpenApiMediaContent & { required?: boolean };
  responses?: Record<string, OpenApiMediaContent & { description?: string }>;
}

export interface OpenApiDocument {
  tags?: { name: string; description?: string }[];
  components?: { schemas?: Record<string, OpenApiSchema> };
  paths: Record<string, Partial<Record<HttpMethod, OpenApiOperation>>>;
}

export const HTTP_METHODS = ['get', 'post', 'put', 'patch', 'delete'] as const;
export type HttpMethod = typeof HTTP_METHODS[number];

export interface ListedOperation {
  method: HttpMethod;
  path: string;
  operation: OpenApiOperation;
}

const MAX_REF_DEPTH = 10;

export const resolveSchema = (schema: OpenApiSchema | undefined, doc: OpenApiDocument): OpenApiSchema | undefined => {
  let current = schema;
  for (let depth = 0; current?.$ref && depth < MAX_REF_DEPTH; depth++) {
    const name = current.$ref.replace('#/components/schemas/', '');
    current = doc.components?.schemas?.[name];
  }

  return current;
};

export const schemaTypeLabel = (schema: OpenApiSchema | undefined, doc: OpenApiDocument): string => {
  const resolved = resolveSchema(schema, doc);
  if (!resolved) return 'any';
  const variants = resolved.anyOf ?? resolved.oneOf;
  if (variants) return variants.map(variant => schemaTypeLabel(variant, doc)).join(' | ');
  if (resolved.type === 'array') return `${schemaTypeLabel(resolved.items, doc)}[]`;

  return resolved.type ?? (resolved.properties ? 'object' : 'any');
};

/**
 * Every operation, in the order of the document's tags and then of its paths, so the groups follow what the document says
 */
export const listOperations = (doc: OpenApiDocument): { tag: string; description: string | undefined; operations: ListedOperation[] }[] => {
  const groups = new Map<string, ListedOperation[]>();
  for (const tag of doc.tags ?? []) {
    groups.set(tag.name, []);
  }
  for (const [path, methods] of Object.entries(doc.paths)) {
    for (const method of HTTP_METHODS) {
      const operation = methods[method];
      if (!operation) continue;
      const tag = operation.tags?.[0] ?? '';
      groups.set(tag, [...(groups.get(tag) ?? []), { method, path, operation }]);
    }
  }

  return [...groups.entries()]
    .filter(([, operations]) => operations.length > 0)
    .map(([tag, operations]) => ({ tag, description: doc.tags?.find(entry => entry.name === tag)?.description, operations }));
};

export const jsonSchemaOf = (content: OpenApiMediaContent | undefined): OpenApiSchema | undefined => content?.content?.['application/json']?.schema;

export interface JsonAnnotation {
  type: string;
  optional: boolean;
  description: string | undefined;
  /**
   * Bounds, such as `min 1` or `max length 25`
   */
  constraints: string[];
  /**
   * The values an enum allows, with their names where the API has some: `d (short date)`
   */
  choices: string[] | undefined;
}

export interface JsonRow {
  depth: number;
  /**
   * One line of the JSON, without indentation
   */
  line: string;
  /**
   * What the property on the line is, set on the lines that start a property
   */
  annotation: JsonAnnotation | null;
}

const MAX_LISTED_CHOICES = 12;

const placeholderFor = (schema: OpenApiSchema | undefined, doc: OpenApiDocument): unknown => {
  const resolved = resolveSchema(schema, doc);
  const variant = (resolved?.anyOf ?? resolved?.oneOf)?.[0];
  if (variant) return placeholderFor(variant, doc);
  if (resolved?.enum?.length) return resolved.enum[0];
  switch (resolved?.type) {
    case 'string':
      return 'string';
    case 'integer':
    case 'number':
      return resolved.minimum ?? 0;
    case 'boolean':
      return false;
    case 'array':
      return [];
    default:
      return {};
  }
};

const annotate = (schema: OpenApiSchema, doc: OpenApiDocument, optional: boolean): JsonAnnotation => {
  const resolved = resolveSchema(schema, doc) ?? schema;
  const type = schemaTypeLabel(schema, doc);

  const labels = schema['x-enum-labels'] ?? resolved['x-enum-labels'];
  const choices = (resolved.enum ?? []).filter(choice => choice !== null);
  const constraints = [
    resolved.minimum !== undefined ? `min ${resolved.minimum}` : null,
    resolved.maximum !== undefined ? `max ${resolved.maximum}` : null,
    resolved.minLength !== undefined ? `min length ${resolved.minLength}` : null,
    resolved.maxLength !== undefined ? `max length ${resolved.maxLength}` : null,
  ].filter((entry): entry is string => entry !== null);

  return {
    type: resolved.nullable && !type.includes('null') ? `${type} | null` : type,
    optional,
    description: schema.description ?? resolved.description,
    constraints,
    // A nullable enum lists null among its values, but that is already in the type
    choices: choices.length > 0 && choices.length <= MAX_LISTED_CHOICES
      ? choices.map(choice => labels?.[String(choice)] ? `${choice} (${labels[String(choice)]})` : String(choice))
      : undefined,
  };
};

/**
 * A JSON body, shown the way it looks like, one row per line, with what each property is next to its line. Values come
 * from the example of the schema, and where it has none (an optional property the example leaves out) from a placeholder.
 */
export const buildJsonRows = (schema: OpenApiSchema | undefined, doc: OpenApiDocument, example?: unknown): JsonRow[] => {
  const rows: JsonRow[] = [];

  const emit = (property: OpenApiSchema, value: unknown, depth: number, key: string | null, last: boolean, optional: boolean) => {
    const resolved = resolveSchema(property, doc) ?? property;
    const prefix = key === null ? '' : `${JSON.stringify(key)}: `;
    const comma = last ? '' : ',';
    const annotation = key === null ? null : annotate(property, doc, optional);
    const itemSchema = resolved.type === 'array' ? resolveSchema(resolved.items, doc) : undefined;

    if (value !== null && resolved.properties) {
      const entries = Object.entries(resolved.properties);
      const source = (value ?? {}) as Record<string, unknown>;
      rows.push({ depth, line: `${prefix}{`, annotation });
      entries.forEach(([name, child], index) => emit(child, source[name], depth + 1, name, index === entries.length - 1, !(resolved.required?.includes(name) ?? false)));
      rows.push({ depth, line: `}${comma}`, annotation: null });
    } else if (value !== null && itemSchema?.properties) {
      const items = Array.isArray(value) ? value : [];
      rows.push({ depth, line: `${prefix}[`, annotation });
      emit(itemSchema, items[0], depth + 1, null, true, false);
      rows.push({ depth, line: `]${comma}`, annotation: null });
    } else {
      const shown = value !== undefined ? value : resolved.type === 'array' ? [placeholderFor(resolved.items, doc)] : placeholderFor(property, doc);
      rows.push({ depth, line: `${prefix}${JSON.stringify(shown)}${comma}`, annotation });
    }
  };

  emit(schema ?? {}, example ?? resolveSchema(schema, doc)?.example, 0, null, true, false);

  return rows;
};

export const rowsToJson = (rows: JsonRow[]): string => rows.map(row => `${'  '.repeat(row.depth)}${row.line}`).join('\n');
