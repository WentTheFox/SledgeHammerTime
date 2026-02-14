<?php

return [
  'heading' => 'Paginaweergave statistieken',
  'description' => 'Deze pagina bevat statistieken (zowel opgeslagen als weergegeven zonder persoonlijk identificeerbare gegevens) voor het totale aantal bekeken pagina\'s in de app gedurende de afgelopen 30 dagen.',
  'collectionMethod' => 'De gegevens worden aan de serverkant verzameld, op basis van reacties die naar een beperkte set pagina\'s worden gestuurd. De bekeken pagina\'s worden individueel geregistreerd, maar dagelijks verzameld door een achtergrondproces.',
  'lastUpdated' => 'De informatie op deze pagina wordt voor een korte periode in de cache geplaatst om de belasting van de server te verminderen. De gegevens zijn voor het laatst bijgewerkt op <1/>.',
  'charts' => [
    'dailyTotal' => 'Totaal aantal pagina weergaven per dag',
    'breakdown' => 'Opgesplitste pagina weergaves',
    'byPage' => 'Per pagina',
    'byLanguage' => 'Per taal',
  ],
  'values' => [
    'unknown' => 'Onbekend',
  ],
];
