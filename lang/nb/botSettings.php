<?php

return [
  'title' => 'App Settings',
  'description' => 'Below you can see your current settings in the HammerTime App for each connected account.',
  'learnMore' => 'Usikker på hva appen er eller nysgjerrig på hva den kan gjøre? Besøk <1>Discord-appen</1> for å lære mer.',
  'advancedSettings' => [
    'toggleText' => 'Advanced settings',
  ],
  'defaultOption' => 'Default',
  'fields' => [
    'timezone' => [
      'displayName' => 'Tidssone',
    ],
    'format' => [
      'displayName' => 'Format',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Preview-only reply when using format option',
    ],
    'columns' => [
      'displayName' => 'Columns',
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
