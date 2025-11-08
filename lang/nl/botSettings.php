<?php

return [
  'title' => 'App Settings',
  'description' => 'Below you can see your current settings in the HammerTime App for each connected account.',
  'learnMore' => 'Not sure what the app is or curious about what it can do? Visit the <1>Discord App</1> link to learn more.',
  'advancedSettings' => [
    'toggleText' => 'Advanced settings',
    'atCommandName' => 'at',
    'at12CommandName' => 'at12',
    'hourOptionName' => 'hour',
    'minuteOptionName' => 'minute',
    'secondOptionName' => 'second',
  ],
  'fields' => [
    'rawData' => [
      'displayName' => 'Raw data (for debugging purposes)',
    ],
    'timezone' => [
      'displayName' => 'Tijdzone',
    ],
    'format' => [
      'displayName' => 'Format',
      'option' => [
        'd' => 'Verkorte datum notatie',
        'f' => 'Datum en tijd',
        't' => 'Uren en minuten',
        'D' => 'Uitgeschreven datum',
        'F' => 'Dag, datum en tijd',
        'R' => 'Relatief',
        'T' => 'Uren, minuten en seconden',
        'default' => 'Standaard',
      ],
    ],
    'formatMinimalReply' => [
      'displayName' => 'Preview-only reply when using format option',
    ],
    'columns' => [
      'displayName' => 'Columns',
      'option' => [
        'syntax' => 'Syntax only',
        'preview' => 'Preview only',
        'both' => 'Both syntax and preview',
        'default' => 'Standaard',
      ],
    ],
    'ephemeral' => [
      'displayName' => 'Ephemeral',
    ],
    'header' => [
      'displayName' => 'Header',
    ],
    'boldPreview' => [
      'displayName' => 'Format preview as bold',
    ],
    'defaultAtHour' => [
      'displayName' => 'Default ":hourOptionName" option for /:atCommandName command',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Default ":minuteOptionName" option for /:atCommandName command',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Default ":secondOptionName" option for /:atCommandName command',
    ],
    'telemetry' => [
      'displayName' => 'Allow Telemetry collection',
      'explanation' => 'This is entirely optional and has no effect your ability to use the bot. See the <1/> page for details.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Default ":hourOptionName" option for /:at12CommandName command',
    ],
  ],
  'saveSuccess' => 'Your settings have been saved successfully.',
];
