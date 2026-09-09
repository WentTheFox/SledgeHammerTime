<?php

return [
  'howTo' => 'Kies een datum, kopieer de gewenste tijdsaanduiding van de :syntaxColName kolom en plak deze dan ergens in een chatbericht. Het resultaat zal een dynamische tijdsaanduiding zijn die voor iedereen anders wordt weergegeven, gebaseerd op hun eigen tijdzone.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Tijd',
      'dateAndTime' => 'Datum en tijd',
      'timezone' => 'Tijdzone',
      'naturalLanguageInput' => '@time invoer',
      'modeOffset' => 'Absoluut tijdsverschil',
      'modeZoneName' => 'Tijdzone Naam',
    ],
    'button' => [
      'jumpToToday' => 'Ga naar huidige maand',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Zet naar huidige tijd',
      'lock' => 'Tijdsaanduiding vergrendelen via de URL',
      'unlock' => 'Tijdsaanduiding ontgrendelen',
      'previousYear' => 'Vorig jaar',
      'previousMonth' => 'Vorige maand',
      'previousDecade' => 'Vorige decennium',
      'nextMonth' => 'Volgende maand',
      'nextYear' => 'Volgend jaar',
      'nextDecade' => 'Volgende decennium',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Natuurlijke taalinvoer kon niet worden verwerkt'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Chat syntaxis',
    'resultColumn' => 'Voorbeeld resultaat',
    'editFormats' => 'Pas de indeling aan',
    'resetFormats' => 'Herstel naar standaard',
    'hideFormat' => 'Verberg deze indeling',
    'showFormat' => 'Laat deze indeling zien',
    'unhideInProfile' => 'Verberg in profiel instellingen',
  ],
  'faq' => [
    'title' => 'Meest gestelde vragen',
    'description' => 'Dit gebied is alleen in het Engels voor nu, en de inhoud is zwaar gebaseerd op content van <1>onze Discord server</1>. Sommige linkjes kunnen niet werken zoals verwacht ten zij je een lid ervan bent.',
  ],
  'usefulLinks' => [
    'lead' => 'Dit is mogelijk ook handig:',
    'server' => [
      'header' => 'Officiële HammerTime server',
      'p' => 'Bespreek de website, test de syntaxis en stel nieuwe functies voor',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Genereer tijdstempels in Discord door middel van slash-opdrachten',
    ],
    'oldSite' => [
      'header' => 'HammerTime Oude Website',
      'p' => 'De oude website van dit project. Beschikbaar tot anders wordt vermeld',
    ],
    'textColor' => [
      'header' => 'Rebane\'s <1>gekleurde</1> tekst generator',
      'p' => 'Een eenvoudige app die gekleurde Discord-berichten maakt met behulp van ANSI-kleurcodes',
    ],
    "subreddit" => [
      "p" => "De community die wekelijkse uitdagingen organiseert voor een ondergewaardeerde race-game die de inspiratie vormde voor dit project",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Wist u dat HammerTime niet de enige tool is voor het genereren van tijdstempels?',
        'p2' => 'Misschien wilt u deze andere Discord-tijdstempel generatoren eens bekijken om er een te vinden die het beste bij u past:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'Een eenvoudige en snelle tijdstempelgenerator van 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Generator voor Discord-tijstempels op basis van natuurlijke taal, door dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Gratis Discord-tijdstempelgenerator met ondersteuning voor lokale tijdzones, aangeboden door Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord-tijdstempelgenerator en tijdconverter van DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Maak Discord markdown tijdstempels aan vanuit het Sesh-ecosysteem van planningsbots van Tunks',
      ],
    ],
  ],
];
