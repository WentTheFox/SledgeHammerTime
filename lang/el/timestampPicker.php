<?php

return [
  'howTo' => 'Επιλέξτε μια ημερομηνία, αντιγράψτε την επιθυμητή χρονοσήμανση από την στήλη :syntaxColName, και στη συνέχεια επικολλήστε την σε οποιοδήποτε μήνυμα συνομιλίας. Το αποτέλεσμα θα είναι μια δυναμική χρονοσήμανση που εμφανίζεται διαφορετικά για τον καθένα με βάση τη δική του ζώνη ώρας.',
  'picker' => [
    'label' => [
      'date' => 'Ημερομηνία',
      'time' => 'Ώρα',
      'dateAndTime' => 'Ημερομηνία και ώρα',
      'timezone' => 'Ζώνη ώρας',
      'naturalLanguageInput' => '@time πεδίο',
      'modeOffset' => 'Απόλυτη Μετατόπιση',
      'modeZoneName' => 'Όνομα Ζώνης ώρας',
    ],
    'button' => [
      'jumpToToday' => 'Μετάβαση στον τρέχοντα μήνα',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Ορισμός τρέχουσας ώρας',
      'lock' => 'Κλείδωμα χρονοσήμανσης μέσω URL',
      'unlock' => 'Ξεκλείδωμα χρονοσήμανσης',
      'previousYear' => 'Προηγούμενο έτος',
      'previousMonth' => 'Προηγούμενος μήνας',
      'previousDecade' => 'Προηγούμενη δεκαετία',
      'nextMonth' => 'Επόμενος μήνας',
      'nextYear' => 'Επόμενο έτος',
      'nextDecade' => 'Επόμενη δεκαετία',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Αδυναμία ανάλυσης εισαγωγής φυσικής γλώσσας'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Σύνταξη συνομιλίας',
    'resultColumn' => 'Παράδειγμα αποτελέσματος',
    'editFormats' => 'Προσαρμογή δομής πίνακα',
    'resetFormats' => 'Επαναφορά προεπιλογών πίνακα',
    'hideFormat' => 'Απόκρυψη',
    'showFormat' => 'Εμφάνιση',
    'unhideInProfile' => 'Αποκάλυψη στις ρυθμίσεις προφίλ',
  ],
  'faq' => [
    'title' => 'Frequently Asked Questions',
    'description' => 'This section is English-only for now, and it\'s heavily based on content from <1>our Discord server</1>. Some links might not work as expected unless you are a member.',
  ],
  'usefulLinks' => [
    'lead' => 'Μπορεί επίσης να σας φανούν χρήσιμα:',
    'server' => [
      'header' => 'Επίσημος Σέρβερ HammerTime',
      'p' => 'Συζητήστε για τον ιστότοπο, δοκιμάστε τις εντολές και προτείνετε χαρακτηριστικά',
    ],
    'bot' => [
      'header' => 'Εφαρμογή HammerTime',
      'p' => 'Δημιουργία χρονοσημάνσεων μέσα από το Discord χρησιμοποιώντας εντολές slash',
    ],
    'oldSite' => [
      'header' => 'HammerTime Beta Ιστοσελίδα',
      'p' => 'Η παλιά ιστοσελίδα του project, ακόμα διαθέσιμη μέχρι την επόμενη ειδοποίηση',
    ],
    'textColor' => [
      'header' => 'Δημιουργία <1>Χρωματιστού</1> κειμένου Rebane',
      'p' => 'Μια απλή εφαρμογή που δημιουργεί πολύχρωμα μηνύματα Discord χρησιμοποιώντας χρωματικούς κώδικες ANSI',
    ],
    "subreddit" => [
      "p" => "Η κοινότητα που φιλοξενεί εβδομαδιαίες προκλήσεις για ένα υποτιμημένο παιχνίδι αγώνων που ενέπνευσε τη δημιουργία αυτού του προγράμματος",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
