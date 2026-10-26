<?php

return [
  'heading' => 'API Access',
  'description' => 'Erstellen Sie Zeitstempel und ändern Sie die Einstellungen Ihrer App über Ihre eigenen Programme. Jeder Endpunkt entspricht einem App-Befehl, und die Anfragen richten sich nach den Einstellungen des Discord-Kontos, für das der Schlüssel erstellt wurde.',
  'overview' => [
    'baseUrl' => 'Basis-URL',
    'reference' => 'Interactive reference',
    'spec' => 'OpenAPI specification',
  ],
  'keys' => [
    'loginPrompt' => 'Melden Sie sich an, um API-Schlüssel zu erstellen. Die Schlüssel fungieren als eines der mit Ihrem Profil verknüpften Discord-Konten.',
  ],
  'usage' => [
    'heading' => 'Verwendung der API',
    'authentication' => 'Senden Sie Ihren Schlüssel als „Bearer-Token“ im „Authorization“-Header jeder Anfrage.',
    'example' => 'Dies gibt den Zeitstempel für heute um 18:30 Uhr in Ihrer gespeicherten Zeitzone zurück. Der Schlüssel in den Beispielen ist frei erfunden, verwenden Sie Ihren eigenen:',
    'limits' => 'Die Anzahl der Anfragen pro Schlüssel ist begrenzt. Die „RateLimit“-Header jeder Antwort geben Auskunft über den aktuellen Status, und eine 429-Antwort enthält einen „Retry-After“-Header.',
    'statistics' => 'Läufe werden wie App-Befehle gezählt, und in der Antwort wird angegeben, um welchen Lauf es sich handelte, sofern Sie die Telemetrie nicht in Ihren App-Einstellungen deaktiviert haben.',
  ],
  'permissions' => [
    'heading' => 'Berechtigungen',
    'description' => 'Ein Schlüssel verfügt über die Berechtigungen, mit denen er erstellt wurde, und im weiteren Verlauf dieser Seite wird unter Verwendung dieser Codes auf diesen Bezug genommen.',
    'me' => 'Jeder Schlüssel kann unabhängig von seinen Berechtigungen die Funktion <1/> aufrufen, um herauszufinden, über welche Berechtigungen er verfügt.',
    'columns' => [
      'permission' => 'Berechtigung',
      'allows' => 'Ermöglicht',
    ],
    'scopes' => [
      'timestamps:create' => 'Erstellung von Zeitstempeln mithilfe des Zeitstempel-Endpunkts und der MCP-Tools, wobei der Schlüssel als Discord-Konto fungiert.',
      'settings:read' => 'Lesen der App-Einstellungen dieses Kontos.',
      'settings:write' => 'Ändern der App-Einstellungen dieses Kontos, nur die gesendeten Felder.',
    ],
  ],
  'reference' => [
    'heading' => 'Endpunktreferenz',
    'description' => 'Jeder Endpunkt mit den von ihm akzeptierten Feldern und den von ihm zurückgegebenen Antworten. Diese Informationen werden aus der OpenAPI-Spezifikation des API-Servers ausgelesen, sodass sie stets mit der aktuell ausgeführten Version übereinstimmen.',
    'errors' => 'Fehler',
    'errorsDescription' => 'Jede Fehlerantwort enthält diesen Textkörper. Der Statuscode gibt an, um welche Art von Fehler es sich handelt, und „error.code“ nennt den genauen Grund.',
    'optional' => 'optional',
    'unavailable' => 'The reference could not be loaded right now. The interactive reference has the same information.',
    'permission' => 'Berechtigung',
    'anyKey' => 'Jeder gültige Schlüssel',
    'noKey' => 'Kein Schlüssel benötigt',
    'requestBody' => 'Anfragetext (JSON)',
    'responses' => 'Antwort',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Verwendung des MCP-Servers',
    'description' => 'Der MCP-Server nutzt den Streamable-HTTP-Transport und dieselben Schlüssel. Er bietet pro Befehl ein Tool sowie entsprechende Einstellungen an, und zwar ausschließlich die Tools, für die die Berechtigungen Ihres Schlüssels gelten.',
    'url' => 'Server URL',
    'placeholderKey' => 'Der Schlüssel in den folgenden Beispielen ist frei erfunden und funktioniert nicht. Ersetzen Sie ihn durch einen Ihrer eigenen Schlüssel.',
    'claudeCode' => 'Zu Claude Code hinzufügen mit:',
    'otherClients' => 'Andere Clients verwenden eine ähnliche Konfiguration mit der URL und einem „Authorization“-Header:',
  ],
];
