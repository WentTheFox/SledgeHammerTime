/**
 * @fileOverview Aliases for commonly used timezone names and abbreviations
 */

const centralEuropeanTimeAliases = ['Central European Time', 'CET', 'CEST', 'Middle European Time', 'MET'];
const westernEuropeanTimeAliases = ['Western European Time', 'WET', 'WEST', 'Canary Islands'];
const easternTimeAliases = ['Eastern Time', 'ET', 'EST', 'EDT'];
const easternStandardTimeAliases = ['Eastern Standard Time', 'EST'];
const pacificTimeAliases = ['Pacific Time', 'PT', 'PST', 'PDT'];
const centralTimeAliases = ['Central Time', 'CT', 'CST', 'CDT'];
const mountainTimeAliases = ['Mountain Time', 'MT', 'MST', 'MDT'];
const centralStandardTimeAliases = ['Central Standard Time', 'CST'];
const samaraTimeAliases = ['Samara Time', 'SAMT'];
const krasnoyarskTimeAliases = ['Krasnoyarsk Time', 'KRAT'];
const yakutskTimeAliases = ['Yakutsk Time', 'YAKT'];
const amazonTimeAliases = ['Amazon Time', 'AMT'];
const brasiliaTimeAliases = ['Brasília Time', 'BRT'];
const australianEasternTime = ['Australian Eastern Time', 'AEST', 'AEDT'];
const westAfricaTime = ['West Africa Time', 'WAT'];

export const timeZoneAliases = {
  'Africa/Cairo': ['Eastern European Time', 'EET', 'EEST'],
  'Africa/Lagos': westAfricaTime,
  'Africa/Tunis': westAfricaTime,
  'America/Anchorage': ['Alaska'],
  'America/Cancun': easternStandardTimeAliases,
  'America/Chicago': centralTimeAliases,
  'America/Ciudad_Juarez': mountainTimeAliases,
  'America/Los_Angeles': pacificTimeAliases,
  'America/Mexico_City': centralStandardTimeAliases,
  'America/Monterrey': centralStandardTimeAliases,
  'America/New_York': easternTimeAliases,
  'America/Ojinaga': centralTimeAliases,
  'America/Phoenix': mountainTimeAliases,
  'America/Tijuana': pacificTimeAliases,
  'America/Toronto': easternTimeAliases,
  'America/Vancouver': pacificTimeAliases,
  'Asia/Anadyr': ['Anadyr Time', 'ANAT'],
  'Asia/Chita': yakutskTimeAliases,
  'Asia/Gaza': ['Palestine Time', 'PST'],
  'Asia/Irkutsk': ['Irkutsk Time', 'IRKT'],
  'Asia/Kamchatka': ['Kamchatka Time', 'Petropavlovsk Time', 'PETT', 'PETST'],
  'Asia/Karachi': ['Pakistani Time', 'PKT', 'PST'],
  'Asia/Magadan': ['Magadan Time', 'MAGT'],
  'Asia/Manila': ['Philippine Time', 'PHT', 'PhST', 'PST'],
  'Asia/Novosibirsk': krasnoyarskTimeAliases,
  'Asia/Omsk': ['Omsk Time', 'OMST'],
  'Asia/Tomsk': krasnoyarskTimeAliases,
  'Asia/Vladivostok': ['Vladivostok Time', 'VLAT'],
  'Asia/Yakutsk': yakutskTimeAliases,
  'Asia/Yekaterinburg': ['Yekaterinburg Time', 'YEKT'],
  'Australia/Brisbane': ['Australian Eastern Standard Time', 'AEST'],
  'Australia/Sydney': australianEasternTime,
  'Australia/Melbourne': australianEasternTime,
  'Australia/Hobart': australianEasternTime,
  'Australia/Perth': ['Australian Western Standard Time', 'AWST'],
  'Australia/Darwin': ['Australian Central Standard Time', 'ACST'],
  'Australia/Adelaide': ['Australian Central Time', 'ACT', 'ACST', 'ACDT'],
  'Australia/Eucla': ['Australian Central Western Standard Time', 'ACWST'],
  'Europe/Amsterdam': centralEuropeanTimeAliases,
  'Europe/Andorra': centralEuropeanTimeAliases,
  'Europe/Astrakhan': samaraTimeAliases,
  'Europe/Belgrade': centralEuropeanTimeAliases,
  'Europe/Berlin': centralEuropeanTimeAliases,
  'Europe/Bratislava': centralEuropeanTimeAliases,
  'Europe/Brussels': centralEuropeanTimeAliases,
  'Europe/Budapest': centralEuropeanTimeAliases,
  'Europe/Copenhagen': centralEuropeanTimeAliases,
  'Europe/Dublin': ['Irish Standard Time', 'IST'],
  'Europe/Gibraltar': centralEuropeanTimeAliases,
  'Europe/Kaliningrad': ['Kaliningrad Time', 'KALT'],
  'Europe/Ljubljana': centralEuropeanTimeAliases,
  'Europe/London': ['British Time', 'BST'],
  'Europe/Luxembourg': centralEuropeanTimeAliases,
  'Europe/Madrid': centralEuropeanTimeAliases,
  'Europe/Malta': centralEuropeanTimeAliases,
  'Europe/Monaco': centralEuropeanTimeAliases,
  'Europe/Moscow': ['Moscow Time', 'MSK'],
  'Europe/Oslo': centralEuropeanTimeAliases,
  'Europe/Paris': centralEuropeanTimeAliases,
  'Europe/Podgorica': centralEuropeanTimeAliases,
  'Europe/Portugal': westernEuropeanTimeAliases,
  'Europe/Prague': centralEuropeanTimeAliases,
  'Europe/Rome': centralEuropeanTimeAliases,
  'Europe/Samara': samaraTimeAliases,
  'Europe/San_Marino': centralEuropeanTimeAliases,
  'Europe/Sarajevo': centralEuropeanTimeAliases,
  'Europe/Saratov': samaraTimeAliases,
  'Europe/Skopje': centralEuropeanTimeAliases,
  'Europe/Stockholm': centralEuropeanTimeAliases,
  'Europe/Tirane': centralEuropeanTimeAliases,
  'Europe/Ulyanovsk': samaraTimeAliases,
  'Europe/Vaduz': centralEuropeanTimeAliases,
  'Europe/Vatican': centralEuropeanTimeAliases,
  'Europe/Vienna': centralEuropeanTimeAliases,
  'Europe/Warsaw': centralEuropeanTimeAliases,
  'Europe/Zagreb': centralEuropeanTimeAliases,
  'Europe/Zurich': centralEuropeanTimeAliases,
  'America/Rio_Branco': ['Acre Time', 'ACT'],
  'America/Cuiaba': amazonTimeAliases,
  'America/Porto_Velho': amazonTimeAliases,
  'America/Campo_Grande': amazonTimeAliases,
  'America/Boa_Vista': amazonTimeAliases,
  'America/Manaus': amazonTimeAliases,
  'America/Sao_Paulo': brasiliaTimeAliases,
  'America/Maceio': brasiliaTimeAliases,
  'America/Fortaleza': brasiliaTimeAliases,
  'America/Recife': brasiliaTimeAliases,
  'America/Noronha': ['Fernando de Noronha Time', 'FNT'],
  'Pacific/Auckland': ['New Zealand Time', 'NZST', 'NZDT'],
} as const satisfies Record<string, string[]>;
