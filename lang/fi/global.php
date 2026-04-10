<?php

return [
  'seoDescription' => 'Luo aikaleimailmaisimet Discord-chat-viesteille',
  'changeLanguage' => 'Vaihda kieltä',
  "notFound" => [
    "heading" => "Sivua ei löydy",
    "content" => "Täällä ei ole mitään nähtävää.",
    "suggestions" => [
      "heading" => "Looking for something?",
      "description" => "Here are some pages that might help:",
      "picker" => "Timestamp Picker",
      "botInfoDescription" => "Information about the Discord app and available commands",
      "discordCta" => "Think something is missing? Join the Discord server and let us know.",
      "discordButton" => "Join the Discord Server",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Huoltotila",
    "content" => [
      'pleaseWait' => "Sovellusta päivitetään parhaillaan, ole hyvä ja yritä uudelleen muutaman sekunnin päästä.",
      'joinSupportServer' => "Jos ongelma jatkuu yli muutaman minuutin, liity Discord-palvelimelle ja ilmoita asiasta.",
      'contactDeveloper' => "Jos ongelma jatkuu yli muutaman minuutin, ota yhteyttä kehittäjään ja ilmoita asiasta.",
    ],
    'autoReload' => 'The page will reload automatically <1/>',
    'reloadButton' => 'Reload manually',
    "supportServerButton" => "Palvelin",
  ],
  'incompleteTranslations' => 'Käännökset eivät ole täydellisiä',
  'contributeTranslations' => 'Avusta',
  'timezoneBadge' => [
    'currently' => 'Noudatettu tällä hetkellä',
    'atPickedDate' => 'Noudatettu valittuun aikaan',
    'currentlyAndAtPickedDate' => 'Noudatettu tällä hetkellä ja valittuun aikaan',
  ],
  'copyToClipboard' => 'Kopioi leikepöydälle',
  'copiedToClipboard' => 'Kopioitu leikepöydälle!',
  'jsDisabled' => [
    'title' => 'JavaScript on tarpeellinen',
    'body' => "Sinun selaimesi joko ei tue JavaScriptiä, tai se on pois käytöstä. Jotkut selaimet poistaa JavaScriptin käytöstä oletuksena turvallisuussyistä, mutta se on tarpeellinen tälle sovellukselle. Ole hyvä ja ota se käyttöön ja päivitä sivu, tai käytä eri selainta.",
  ],
  'nav' => [
    'botSettings' => 'Sovelluksen asetukset',
    'profile' => 'Profiili',
    'legal' => 'Lailliset tiedot',
    'analytics' => 'Analytiikka',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Syöttöasetukset',
      'naturalLanguageInput' => [
        'label' => '@time syötekenttä',
        'description' => 'Salli valitun aikaleiman muokkaamista luonnollisen kielen kanssa (esim. "5 tunnin kuluttua") vapaan tekstin syötteen kautta. Samanlailla kuin uusi Discord @time tägi. Vain rajoitettu määrä kieliä on tuettu.',
      ],
      'customDateInput' => [
        'label' => 'Mukautettu päivämäärän syöte',
        'description' => "Vaihda selaimen oletuspäivämäärän syöte mukautetulla päivämäärällä.",
      ],
      'customTimeInput' => [
        'label' => 'Mukautettu ajan syöte',
        'description' => "Vaihda selaimen oletusajan syöte mukautetulla ajalla. Tämä on varsinkin hyödyllinen jos sinulla on ongelmia ajan valitsemisen kanssa mobiiliselaimessa.",
      ],
      'separateInputs' => [
        'label' => 'Erilliset tulot',
        'description' => "Näytä kaksi eri päivämäärän ja kellonajan syötettä yhdistetyn syötteen sijaan (mitä ei tueta joissakin selaimissa)",
      ],
      'flatUi' => [
        'label' => 'Tasoita käyttöliittymä',
        'description' => "Poista varjo- ja korkeusefektit syötteissä ja napeissa",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Aikavyöhykkeiden ryhmien otsikot',
        'description' => 'Näyttää aikavyöhykkeen ryhmän (esim. America, Europe) aikavyöhykkeen valikossa.',
      ],
      'hourCycle' => [
        'label' => 'Mukautettu aikasyötteen kellon tyyppi',
        'description' => 'Vaihda miten tunnit pitäisi näyttää mukautetussa aikasyötteessä. Tällä ei ole vaikutusta tuloksien sarakkeessa esikatseluihin.',
        'options' => [
          'default' => 'Oletuskieli',
          'h12' => '12 tunnin kello',
          'h24' => '24 tunnin kello',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Ensimmäinen viikonpäivä',
        'description' => 'Vaihda minkä päivän pitäisi olla viikon ensimmäinen päivä mukautetun aikasyötteen kalenterissa.',
        'options' => [
          'default' => 'Oletuskieli',
        ],
      ],
      'advancedSettings' => 'Edistyneet syötteen asetukset',
    ],
    'timeSync' => [
      'title' => 'Ajan synkronointi',
      'status' => [
        'syncing' => 'Sinun järjestelmäkelloa synkronoidaan palvelimemme kanssa, ole hyvä ja odota.',
        'accurate' => 'Järjestelmäsi kello on oikeassa.',
        'potentiallyWrong' => 'Järjestelmäsi kello saattaa olla väärässä.',
        'value' => 'Ero paikallis- ja palvelinajan kanssa ei ole tasainen.',
      ],
      'details' => 'Lisätiedot',
      'syncButtonLabel' => 'Synkronoi',
      'roundTripDuration' => 'Meno-paluu matkan kesto',
      't0' => 'Asiakkaan aikaleima pyynnön lähettämisestä',
      't1' => 'Palvelimen aikaleima pyynnön vastaanotosta',
      't2' => 'Palvelimen aikaleima vastauksen lähettämiselle',
      't3' => 'Asiakkaan aikaleima vastauksen vastaanotosta',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Havaittu offset (verkon kautta)',
    ],
    'localSettings' => [
      'title' => 'Paikalliset asetukset',
    ],
    'credits' => [
      'title' => 'Tekijät',
      'developedBy' => 'Kehittänyt <1></1>',
      'using' => 'Käyttämällä <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Käännökset <1></1>',
      'openSourceSoftware' => 'avoimen lähdekoodin ohjelmisto',
      'viewSourceCode' => 'Vilkaise lähdekoodia',
      'notAffiliated' => 'Tämä projekti ei ole sidoksissa Discordin kanssa.',
    ],
    'themeButton' => [
      'dark' => 'Tumma teema',
      'light' => 'Vaalea teema',
      'system' => 'Käytä järjestelmänteemaa',
    ],
  ],
  'designEditor' => [
    'title' => 'Muotoiluneditori',
    'description' => 'Voit muuttaa montaa sivun ulkonäön näkökohtaa käyttämällä alla olevan taulukon syötteitä. Muuttujien nimet perustuvat koodin tunnisteisiin, ja siksi niitä ei voi kääntää. Arvot nollataan kun sivu päivitetään.',
    'designPageLink' => 'Muotoilunsivu',
    'exportInfo' => 'Voit viedä muutoksesi UserStyle-tiedostoon, jota voidaan käyttää <1>Stylus</1> kaltaisen laajennuksen kanssa muuttaakseen sovelluksen ulkoasua pysyvästi. Huomaa, että muuttujat voivat muuttua milloin vaan, joka vaatii sinua päivittämään mukautetut tyylit manuaalisesti.',
    'export' => 'Vie UserStyle-tyylinä',
    'variableColumnHeader' => 'CSS-muuttuja',
    'valueColumnHeader' => 'Arvo',
  ],
];
