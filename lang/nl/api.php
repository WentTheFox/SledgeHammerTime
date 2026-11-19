<?php

return [
  'heading' => 'API Toegang',
  'description' => 'Genereer tijdstempels en verander app instellingen vanuit je eigen programma. Elk eindpunt komt overeen met een app commando. Verzoeken volgen de instellingen van het Discord account waarvoor de sleutel gemaakt is.',
  'overview' => [
    'baseUrl' => 'Basis-URL',
    'reference' => 'Interactieve referentie',
    'spec' => 'OpenAPI specificaties',
  ],
  'keys' => [
    'loginPrompt' => 'Log in om API-sleutels aan te maken. De sleutels gedragen zich als een Discord account wat aan je profiel is gelinkt.',
  ],
  'usage' => [
    'heading' => 'Gebruik de API',
    'authentication' => 'Stuur je sleutel als bearer token in de Authorization header van elk verzoek.',
    'example' => 'Dit retourneert de tijdstempel voor 18.30 uur vandaag in de door u opgeslagen tijdzone. De sleutel in de voorbeelden is verzonnen; gebruik uw eigen sleutel:',
    'limits' => 'Aanvragen worden beperkt per sleutel. De RateLimit headers van elk antwoord vertelt je waar je staat, en een 429 antwoord komt met een Retry-After header.',
    'statistics' => 'Runs worden op dezelfde manier geteld als app-commandos. In het antwoord wordt vermeld om welke run het ging, tenzij je de telemetrie in de app-instellingen hebt uitgeschakeld.',
  ],
  'permissions' => [
    'heading' => 'Rechten',
    'description' => 'Een sleutel heeft de rechten waarmee het is gemaakt en de rest van deze pagina verwijst naar hen door middel van deze codes.',
    'me' => 'Elke sleutel kan <1/> aanroepen om te achterhalen welke rechten hij heeft, ongeacht de bijbehorende rechten.',
    'columns' => [
      'permission' => 'Recht',
      'allows' => 'Staat toe',
    ],
    'scopes' => [
      'timestamps:create' => 'Het genereren van tijdstempels met behulp van de tijdstempel-endpoints en MCP-tools, waarbij de sleutel optreedt als het verbonden Discord-account.',
      'settings:read' => 'Lees de app instellingen van dat account.',
      'settings:write' => 'Wijzig de app instellingen van dat account, alleen de velden die worden verzonden.',
    ],
  ],
  'reference' => [
    'heading' => 'Endpoint referentie',
    'description' => 'Elk eindpunt met de velden die het vereist en de antwoorden die het geeft. Dit wordt ontleend aan de OpenAPI-specificatie van de API-server, zodat het altijd overeenkomt met de versie die momenteel in gebruik is.',
    'errors' => 'Fouten',
    'errorsDescription' => 'Elke foutmelding bevat deze inhoud. De statuscode geeft aan om wat voor soort fout het gaat, en `error.code` geeft de precieze oorzaak aan.',
    'optional' => 'optioneel',
    'unavailable' => 'De referentie kan op dit moment niet worden geladen. De interactieve referentie bevat dezelfde informatie.',
    'permission' => 'Rechten',
    'anyKey' => 'Elke geldige sleutel',
    'noKey' => 'Geen sleutel nodig',
    'requestBody' => 'Request body (JSON)',
    'responses' => 'Reacties',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Gebruik van de MCP-server',
    'description' => 'The MCP server uses the Streamable HTTP transport and the same keys. It offers one tool per command plus settings, and only the tools your key\'s permissions allow.',
    'url' => 'Server URL',
    'placeholderKey' => 'De sleutel in de onderstaande voorbeelden is verzonnen; deze werkt niet. Vervang deze door één van uw eigen sleutels.',
    'claudeCode' => 'Voeg het toe aan Claude Code met:',
    'otherClients' => 'Andere clients gebruiken een vergelijkbare configuratie, met de URL en een Authorization header:',
  ],
];
