<?php

return [
  'seoDescription' => 'Δημιουργήστε δείκτες χρονοσήμανσης για μηνύματα συνομιλίας Discord',
  'changeLanguage' => 'Αλλαγή γλώσσας',
  "notFound" => [
    "heading" => "Η σελίδα δεν βρέθηκε",
    "content" => "Δεν υπάρχει κάτι να δεις εδώ.",
  ],
  'incompleteTranslations' => 'Οι μεταφράσεις είναι ελλιπείς',
  'contributeTranslations' => 'Συνεισφέρετε',
  'copyToClipboard' => 'Αντιγραφή στο πρόχειρο',
  'copiedToClipboard' => 'Αντιγράφηκε στο πρόχειρο!',
  'jsDisabled' => [
    'title' => 'Η JavaScript είναι απαραίτητη',
    'body' => "Ο περιηγητής σας είτε δεν υποστηρίζει JavaScript είτε είναι απενεργοποιημένη αυτή τη στιγμή. Μερικά προγράμματα περιήγησης απενεργοποιούν την JavaScript από προεπιλογή για λόγους ασφαλείας, αλλά είναι απαραίτητη για αυτήν την εφαρμογή. Παρακαλώ ενεργοποιήστε την και ανανεώστε τη σελίδα ή χρησιμοποιήστε διαφορετικό πρόγραμμα περιήγησης.",
  ],
  'nav' => [
    'botSettings' => 'Ρυθμίσεις Εφαρμογής',
    'profile' => 'Προφίλ',
    'legal' => 'Νομικές Πληροφορίες',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Ρυθμίσεις εισαγωγής',
      'customInputs' => [
        'label' => 'Προσαρμοσμένη εισαγωγή',
        'description' => "Αντικαθιστά τις προεπιλεγμένες εισόδους του περιηγητή με προσαρμοσμένες που σέβονται την επιλεγμένη γλώσσα ιστοσελίδας σας",
      ],
      'separateInputs' => [
        'label' => 'Διαχωρισμός εισαγωγών',
        'description' => "Εμφάνιση δύο διαφορετικών εισαγωγών για την ημερομηνία και την ώρα αντί για μια συνδυασμένη (που δεν υποστηρίζεται σε ορισμένα προγράμματα περιήγησης)",
      ],
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'Your system clock is accurate.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'The difference between the local and server time is :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'Details',
      'autoApplyCheckbox' => 'Apply calculated offset to DateTime library when pressing :syncButtonLabel manually (only applies if the difference is above the :offset threshold)',
      'syncButtonLabel' => 'Synchronize',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Τοπικές Ρυθμίσεις',
    ],
    'credits' => [
      'title' => 'Συντελεστές',
      'developedBy' => 'Δημιουργήθηκε από <1></1>',
      'using' => 'Χρησιμοποιώντας <1></1>',
      'fontAwesomeFree' => 'Δωρεάν έκδοση Font Awesome',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Μετάφραση από <1></1>',
      'openSourceSoftware' => 'Λογισμικό ανοικτού κώδικα',
      'viewSourceCode' => 'Προβολή πηγαίου κώδικα',
      'notAffiliated' => 'Αυτό το πρότζεκτ δεν σχετίζεται με το Discord.',
    ],
    'themeButton' => [
      'dark' => 'Σκοτεινή λειτουργία',
      'light' => 'Φωτεινή λειτουργία',
      'system' => 'Χρήση Θέματος Συστήματος',
    ],
  ],
  'designEditor' => [
    'title' => 'Σχεδιασμός Επεξεργασίας',
    'description' => 'Μπορείτε να προσαρμόσετε πολλές πτυχές της εμφάνισης της ιστοσελίδας χρησιμοποιώντας τις εισόδους στον παρακάτω πίνακα. Τα ονόματα των μεταβλητών βασίζονται σε αναγνωριστικά του κώδικα και επομένως δεν μπορούν να μεταφραστούν. Οι τιμές θα επανέλθουν κατά την ανανέωση της σελίδας.',
    'designPageLink' => 'Σχεδιασμός Σελίδας',
    'exportInfo' => 'Μπορείτε να εξάγετε τις αλλαγές σας σε ένα αρχείο UserStyle, το οποίο μπορεί να χρησιμοποιηθεί με μια επέκταση όπως η <1>Stylus</1> για να προσαρμόσετε μόνιμα την εμφάνιση της εφαρμογής. Σημειώστε, ωστόσο, ότι αυτές οι μεταβλητές μπορεί να αλλάξουν ανά πάσα στιγμή, απαιτώντας να ενημερώσετε χειροκίνητα τα προσαρμοσμένα στυλ σας.',
    'export' => 'Εξαγωγή ως UserStyle',
    'variableColumnHeader' => 'Μεταβλητή CSS',
    'valueColumnHeader' => 'Τιμή',
  ],
];
