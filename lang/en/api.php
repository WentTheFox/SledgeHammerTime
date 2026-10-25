<?php

return [
  'heading' => 'API Access',
  'description' => 'Generate timestamps and change your app settings from your own programs. Every endpoint matches an app command, and requests follow the settings of the Discord account the key was created for.',
  'overview' => [
    'baseUrl' => 'Base URL',
    'reference' => 'Interactive reference',
    'spec' => 'OpenAPI specification',
  ],
  'keys' => [
    'loginPrompt' => 'Log in to create API keys. The keys act as one of the Discord accounts linked to your profile.',
  ],
  'usage' => [
    'heading' => 'Using the API',
    'authentication' => 'Send your key as a bearer token in the Authorization header of every request.',
    'example' => 'This returns the timestamp for 18:30 today in your saved time zone. The key in the examples is made up, use your own:',
    'limits' => 'Requests are rate limited per key. The RateLimit headers of every response tell you where you stand, and a 429 response comes with a Retry-After header.',
    'statistics' => 'Runs are counted like app commands, and the reply says which run it was, unless you turned telemetry off in your app settings.',
  ],
  'permissions' => [
    'heading' => 'Permissions',
    'description' => 'A key has the permissions it was created with, and the rest of this page refers to them by these codes.',
    'me' => 'Every key can call <1/>, whatever its permissions, to find out which ones it has.',
    'columns' => [
      'permission' => 'Permission',
      'allows' => 'Allows',
    ],
    'scopes' => [
      'timestamps:create' => 'Generating timestamps with the timestamp endpoints and MCP tools, as the Discord account the key acts as.',
      'settings:read' => 'Reading the app settings of that account.',
      'settings:write' => 'Changing the app settings of that account, only the fields that are sent.',
    ],
  ],
  'reference' => [
    'heading' => 'Endpoint reference',
    'description' => 'Every endpoint with the fields it takes and the responses it gives. This is read from the OpenAPI specification of the API server, so it always matches the version that is running.',
    'errors' => 'Errors',
    'errorsDescription' => 'Every error response has this body. The status code tells what kind of error it is, and error.code the exact reason.',
    'optional' => 'optional',
    'unavailable' => 'The reference could not be loaded right now. The interactive reference has the same information.',
    'permission' => 'Permission',
    'anyKey' => 'Any valid key',
    'noKey' => 'No key needed',
    'requestBody' => 'Request body (JSON)',
    'responses' => 'Responses',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Using the MCP server',
    'description' => 'The MCP server uses the Streamable HTTP transport and the same keys. It offers one tool per command plus settings, and only the tools your key\'s permissions allow.',
    'url' => 'Server URL',
    'placeholderKey' => 'The key in the examples below is made up, it will not work. Replace it with one of your own keys.',
    'claudeCode' => 'Add it to Claude Code with:',
    'otherClients' => 'Other clients take a similar configuration, with the URL and an Authorization header:',
  ],
];
