<?php

return [
  'translations' => [
    'title' => 'Přeložený obsah',
    'text' => 'Tento projekt obsahuje překlady od dobrovolných překladatelů a dalších členů komunity. Tyto překlady jsou poskytovány uživatelům pro jejich pohodlí a nemusí být vždy zcela aktuální. Ve všech ohledech je považována za platnou <1>verze v původním jazyce</1> této stránky.',
  ],
  'lastUpdated' => 'Poslední aktualizace: <1/>',
  'privacy' => [
    'heading' => 'Zásady ochrany osobních údajů',
    'operator' => '<0/> (dále jen "my", "nás", "náš" nebo "vývojář") provozuje webové stránky HammerTime (dále jen "stránky") a HammerTimeBot (dále jen "bot" nebo "aplikace"), pod společným názvem projekt HammerTime (dále jen "projekt"). Tato stránka vás informuje o našich zásadách týkajících se shromažďování, používání a zveřejňování osobních údajů, které získáváme od uživatelů projektu (dále jen "vy", "uživatel" nebo pod společným názvem "uživatelé").',
    'notAffiliated' => 'Ačkoli název "HammerTime" (nebo také "název projektu") je odvozen od dřívějšího názvu "Hammer & Chisel" společnosti Discord, Inc. (dále jen "Discord")<1/>, projekt není žádným způsobem, v žádné podobě ani formě přidružen k společnosti Discord, ani k umělci M.C. Hammer, v jehož písni<3/> se tato fráze výrazně objevuje. Vývojář nevlastní žádnou ochrannou známku ani autorská práva k názvu projektu.',
    'infoCollection' => [
      'heading' => 'Shromažďování a využití informací',
      'pii' => 'Při používání projektu vás nežádáme ani nenabádáme k poskytnutí jakýchkoli údajů umožňující zjištění totožnosti (také "PII", "osobní údaje"), které by mohly být použity k vaší identifikaci jako jednotlivce. Mezi osobní údaje mimo jiné patří: vaše jméno, datum narození, rodné číslo, lokační údaje, telefonní číslo.',
      'auth' => 'Přihlašování probíhá skrze rozhraní OAuth 2 API společnosti Discord (dále jen "API"), které je rovněž zabezpečeno pomocí protokolu HTTPS. Během procesu ověřování OAuth naše stránky neobdržují vaše uživatelské jméno ani heslo, pouze token, který používáme k ověření identity uživatele skrze API. Z výkonnostních důvodů ukládáme základní informace poskytované rozhraním API (to jest ID uživatele, aktuální uživatelské jméno, zobrazované jméno, odkaz na avatar) lokálně.',
      'removal' => 'Pokud deaktivujete svůj Discord účet, tyto informace nebudou automaticky z naší databáze odstraněny, proto nás nezapomeňte kontaktovat, pokud chcete své údaje odstranit.',
    ],
    'logData' => [
      'heading' => 'Protokolová data',
      'browserInfo' => 'Shromažďujeme informace, které váš prohlížeč odešle při každé návštěvě našich stránek (tzv. "protokolová data"). Tyto protokolová data mohou zahrnovat informace, jako je například IP adresa vašeho počítače, operační systém, typ prohlížeče, verze prohlížeče, stránky našeho webu, které navštívíte, čas a datum vaší návštěvy.',
      'thirdParty' => 'Tyto protokolová data ukládáme pouze na našem serveru a nesdílíme je s žádnou třetí stranou. Protokolová data používáme pro diagnostické účely a na výslovné vyžádání je poskytneme příslušným orgánům činným v trestním řízení. Uchováváme je na dobu až 14 dnů a poté je likvidujeme.',
      'debugging' => 'Bot od uživatelů prostřednictvím Discord klienta přijímá interakce, které zahrnují lomítkové příkazy a příkazy v kontextové nabídce (také "akce", "příkaz" nebo pod společným názvem "příkazy"). Lomítkové příkazy můžou navíc být vykonávány s pomocí uživatelem zadaných strukturovaných dvojic klíč-hodnota (dále jen "možnosti"). Bot zaznamenává vykonávání příkazů pro účely ladění, konkrétně: uživatelské jméno na Discordu a identifikátor Snowflake (dále jen "ID") uživatele, informaci o tom, který příkaz provedl, název příkazu (včetně všech možností), a ID Serveru, na kterém byl daný příkaz proveden. Tyto údaje jsou uloženy na serveru projektu na dobu až 30 dnů a jsou zpřístupněny pouze vývojáři.',
      'noPii' => 'Při spouštění příkazů se prosím vyvarujte uvádění jakýchkoli osobních údajů, protože některé informace mohou být uchovány v našem aplikačním protokolu. Pokud tato situace nastane a vyžaduje náš zásah, kontaktujte nás prosím prostřednictvím postupů uvedených na konci tohoto dokumentu.',
    ],
    'telemetry' => [
      'heading' => 'Telemetrie a statistiky',
      'statsCollection' => 'Za účelem vyhodnocování využívání bota a následného ovlivňování vývojových rozhodnutí (např. přidávání či odebírání funkcí) může být shromažďován specifický soubor údajů o příkazech a jejich používání (tzv. telemetrie). Telemetrie je omezena na informaci o tom, který příkaz a jaké možnosti byly použity a kdy k jejich použití došlo, bez jakýchkoli identifikátorů (tudíž nikdy nezahrnuje ID serverů ani uživatelů, ani žádné hodnoty zadané uživatelem, a je zcela anonymní). Telemetrie je uchovávána neomezeně dlouho a statistiky z ní odvozené jsou určeny k veřejnému zobrazování a sdílení v souhrnné podobě.',
      'telemetryOptOut' => 'Používáním projektu uživatelé souhlasí se sběrem telemetrie ve výchozím nastavení. Pokud si uživatel přeje odhlásit se ze sběru telemetrie, může tak učinit prostřednictvím příslušné volby na stránce <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies jsou soubory s malým množstvím dat. Webová stránka je odesílá do vašeho prohlížeče a ten je ukládá na pevný disk vašeho zařízení.',
      'disable' => 'Cookies používáme k uchovávání informací. Váš prohlížeč můžete nastavit tak, aby všechny soubory cookie odmítal, nebo aby vás upozornil, když má být cookie odeslána. Pokud nepovolíte přijímání cookies, některé části našeho webu můžou pro vás přestat být dostupné či funkční.',
      'session' => 'Pro přihlášené uživatele používáme trvalou cookie, která uchovává stav přihlášení napříč relacemi prohlížeče na dobu 30 dnů. Chcete-li zabránit dalšímu uchovávání tohoto stavu, můžete se buď odhlásit, nebo smazat cookies uložené naším webem.',
    ],
    'security' => [
      'heading' => 'Zabezpečení',
      'noGuarantee' => 'Zabezpečení vašich osobních údajů je pro nás důležité, avšak mějte prosím na paměti, že žádná metoda přenosu dat přes internet ani metoda elektronického ukládání není stoprocentně bezpečná. Ačkoli usilujeme o použití komerčně uznávaných prostředků k ochraně vašich osobních údajů, nemůžeme zaručit jejich absolutní bezpečnost.',
      'httpsCloudFlare' => 'Web využívá HTTPS s moderními šifrovacími sadami TLS k ochraně integrity a bezpečnému přenosu dat mezi prohlížečem a naším webem. Vzhledem k tomu, že používáme reverzní proxy službu CloudFlare, část dat odesílaných na náš web prochází skrze jejich servery. CloudFlare se řídí vlastními <1>zásadami ochrany osobních údajů</1>.',
      'breachNotify' => 'V případě narušení bezpečnosti budou všichni uživatelé informováni do 24 hodin od zjištění prostřednictvím oznámení zveřejněného na tomto webu, v odpovědích zasílaných botem a formou oznámení na Discord serveru podpory bota.',
    ],
  ],
  'terms' => [
    'heading' => 'Smluvní podmínky',
    'license' => 'Veškerý zdrojový kód projektu je na GitHubu poskytován „tak, jak stojí a leží“, bez jakékoli záruky či odpovědnosti. Úplné licenční podmínky naleznete v <1>licenci MIT</1>, jejíž kopie je dostupná v každém repozitáři. Podmínky uvedené níže se vztahují na verzi projektu hostovanou vývojářem (dále jako "instance") a zde uvedená omezení nesmí být chápána jako omezení používání zdrojového kódu projektu.',
    'noAbuse' => 'Nesmíte nastavovat automatizace, které by opakovaně spouštěly příkazy prostřednictvím instance. Bot není určen k používání automatizovanými nástroji, jako jsou jiní boti, nebo jakýmkoli softwarem navrženým k napodobování legitimní uživatelské aktivity. Namísto spoléhání se na výstupy našeho bota pro účely automatizace se prosím obraťte na dokumentaci programovacího jazyka použitého vaším botem, zejména pokud jde o generování a práci s UNIX časovými razítky.',
    'fuckWeb3' => 'Tato instance nesmí být používána k podpoře tréninku generativních modelů umělé inteligence ani k usnadňování jakýchkoli událostí či transakcí souvisejících s nezaměnitelnými tokeny (tzv. "NFT") nebo jakoukoli kryptoměnou (např. Ethereum, Bitcoin).',
    'accessRevocation' => 'Váš přístup k instanci může být odebrán z jakéhokoli důvodu (včetně žádného) dle uvážení vývojáře. Důvody mohou zahrnovat mimo jiné: porušení těchto podmínek, úmyslné zneužití funkcí instance, vyhrožování násilím vůči vývojáři nebo jakémukoli přispěvateli projektu, nebo použití instance k škodlivým účelům.',
  ],
  'changes' => [
    'heading' => 'Změny a revize',
    'effectiveFrom' => 'Smluvní podmínky a Zásady ochrany osobních údajů (pod společným názvem "Dokumenty") jsou platné ke dni jejich poslední aktualizace a zůstávají v platnosti až do případných budoucích změn, které nabývají účinnosti okamžitě po jejich zveřejnění na této stránce.',
    'rightToChange' => 'Vyhrazujeme si právo tyto dokumenty kdykoli aktualizovat nebo změnit bez předchozího upozornění, a proto vám doporučujeme tuto stránku pravidelně kontrolovat. Pokračováním v používání projektu po zveřejnění jakýchkoli změn na této stránce potvrzujete, že změny berete na vědomí a souhlasíte s tím, že se zavazujete upravenými dokumenty řídit.',
    'willNotify' => 'Pokud provedeme zásadní změny v těchto dokumentech, budeme vás informovat zřetelným oznámením na našem webu a také zveřejněním oznámení na Discord serveru podpory bota.',
  ],
  'contact' => [
    'heading' => 'Kontakt',
    'whereToContact' => 'Máte-li jakékoli dotazy k těmto dokumentům nebo chcete-li požádat o výmaz jakýchkoli osobních údajů, které uchováváme, kontaktujte nás prosím prostřednictvím <1>Discord serveru bota</1> nebo skrze některou z metod uvedených na <3>webu vývojáře</3>.',
  ],
];
