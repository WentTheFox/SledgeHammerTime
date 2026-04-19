<?php

return [
  'howTo' => 'Valitse päivämäärä, kopioi haluamasi aikaleima :syntaxColName -sarakkeeseen ja liitä se mihin tahansa chat-viestin kohtaan. Tuloksena on dynaaminen aikaleima, joka näkyy eri tavalla jokaiselle oman aikavyöhykkeensä perusteella.',
  'picker' => [
    'label' => [
      'date' => 'Päivämäärä',
      'time' => 'Aika',
      'dateAndTime' => 'Päivämäärä ja aika',
      'timezone' => 'Aikavyöhyke',
      'naturalLanguageInput' => '@time syöte',
      'modeOffset' => 'Täydellinen offset',
      'modeZoneName' => 'Alueen nimi',
    ],
    'button' => [
      'jumpToToday' => 'Siirry kuluvaan kuukauteen',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Aseta nykyiseen aikaan',
      'lock' => 'Lukitse aikaleima URL',
      'unlock' => 'Avaa aikaleima',
      'previousYear' => 'Edellinen vuosi',
      'previousMonth' => 'Edellinen kuukausi',
      'previousDecade' => 'Edellinen vuosikymmen',
      'nextMonth' => 'Seuraava kuukausi',
      'nextYear' => 'Ensi vuonna',
      'nextDecade' => 'Seuraava vuosikymmen',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Ei voitu jäsentää luonnollisen kielen syötettä'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Chat-syntaksi',
    'resultColumn' => 'Esimerkki tuloksesta',
    'editFormats' => 'Mukauta muotoja',
    'resetFormats' => 'Palauta oletusarvot',
    'hideFormat' => 'Piilota tämä muoto',
    'showFormat' => 'Näytä tämä muoto',
    'unhideInProfile' => 'Poista piilotus profiilin asetuksista',
  ],
  'faq' => [
    'title' => 'Usein kysytyt kysymykset',
    'description' => 'Tämä osio on vain englanniksi toistaiseksi, ja se pohjautuu vahvasti tietoon <1>Discord-palvelimeltamme</1>. Jotkut linkit eivät saata toimia odotetusti ellet ole jäsen.',
  ],
  'usefulLinks' => [
    'lead' => 'Saatat myös löytää nämä hyödyllisenä:',
    'server' => [
      'header' => 'Official HammerTime Server',
      'p' => 'Keskustele verkkosivustosta, testaa syntaksia ja ehdota ominaisuuksia',
    ],
    'bot' => [
      'header' => 'HammerTime-sovellus',
      'p' => 'Luo aikaleimoja Discordissa kauttaviivakomennoilla',
    ],
    'oldSite' => [
      'header' => 'HammerTime:n vanha sivu',
      'p' => 'Projektin vanha sivu, saatavilla toistaiseksi',
    ],
    'textColor' => [
      'header' => 'Rebanen <1>Värillinen</1> Tekstigeneraattori',
      'p' => 'Yksinkertainen sovellus joka luo värillisiä Discord viestejä käyttäen ANSI-värijärjestelmää',
    ],
    "subreddit" => [
      "p" => "Yhteisön viikottainen aliarvostetun kilpapelin isännöinti inspiroi tämän projektin tekemisen",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Tiesitkö, että HammerTime ei ole ainoa työkalu aikaleimojen tekemiseen?',
        'p2' => 'Saatat haluta katsoa nämä muut Discord-aikaleimojen tekijät löytääksesi parhaan juuri sinulle:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'Yksinkertainen ja nopea aikaleimojen tekijä 3venticiltä',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Luonnollista kieltä käyttävä Discord-aikaleimojen tekijä dabricilta',
      ],
      'discordtimestampCom' => [
        'p' => 'Ilmainen Discord-aikaleimojen tekijä joka tukee paikallisia aikavyöhykkeitä Sellframe Ltd.:ltä.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord-aikaleimojen tekijä ja aikamuunnin DiscordTimestamp.orgilta',
      ],
      'sesh' => [
        'p' => 'Tee Discordin markdown-aikaleimoja Tunksin Sesh-ajatusbotin avulla',
      ],
    ],
  ],
];
