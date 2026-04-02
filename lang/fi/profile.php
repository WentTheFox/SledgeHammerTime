<?php

return [
  'title' => 'Profiili',
  'intro' => 'Profiili-sivulla voit hallita käyttäjäsi erityisesti sivuun liittyvia tietoja. Jos etsit missä vaihtaa oletuksia ja muita asetuksia Discord appia varten, vieraile <1>apin asetukset</1> sivulla.',
  'information' => [
    'heading' => 'Profiilin tiedot',
    'description' => "Päivitä käyttäjäsi profiilitietoja.",
    'displayName' => 'Näyttönimi',
    'hiddenFormats' => 'Muodot piiloitettu valintataulukosta',
    'saveSuccess' => 'Profiilisi on päivitetty onnistuneesti.',
  ],
  'accounts' => [
    'heading' => 'Yhdistetyt tilit',
    'description' => 'Voit yhdistää useita tilejä HammerTime tiliisi jotta voit hallita niitä yhdessä paikassa. Käyttäjän perustiedot päivittyvät automaattisesti enintään kerran tunnissa, kun lataat tämän sivun.',
    'discord' => 'Discord tilit',
    'crowdin' => 'Crowdin tilit',
    'noConnectedAccounts' => 'Sinulla ei tällä hetkellä ole yhdistettyjä tilejä',
    'linkAdditional' => [
      'heading' => 'Yhdistä lisätilejä',
      'description' => 'Käytä alla olevia nappeja yhdistääksesi lisätilejä nykyiseen HammerTime tiliisi.',
      'discord' => [
        'description' => 'Jos profiilikuvasi tai näyttönimesi on muuttunut, voit myös käyttää tätä päivittäksesi tieto mille vain Discord käyttäjälle, joka on jo linkitetty.',
        'authorize' => 'Valtuuta Discord tili',
      ],
      'crowdin' => [
        'description' => 'Jos olet projektin kääntäjä, sinun Crowdin käyttäjän yhdistäminen antaa sinun lopulta muokata miten nimesi näkyy käännöskrediiteissä, ja se toimii myös lisätasona henkilöllisyytesi varmistamiseen, mikäli liityt projektin Discord-palvelimelle.',
        'authorize' => 'Valtuuta Crowdin tili',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Käyttäjän poistaminen',
    'description' => 'Kun tilisi poistetaan, kaikki sen resurssit ja tiedot poistetaan pysyvästi. Ennen kuin poistat tilisi, lataa tiedot mitä haluat säilyttää.',
    'deleteButton' => 'Poista käyttäjä',
    'confirmDialog' => [
      'header' => 'Oletko varma, että haluat poistaa tilisi?',
      'body' => 'Kun tilisi poistetaan, kaikki sen resurssit ja tiedot poistetaan pysyvästi.',
    ],
  ],
];
