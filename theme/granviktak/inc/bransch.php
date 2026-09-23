<?php
/**
 * Copy per trade.
 *
 * The call list is 20 electricians, 21 VVS, 14 glaziers, 26 builders, 10 painters
 * and two actual roofers - so a single roofing template sells takomläggning to
 * people who have never been on a roof. Every visible line that assumes a trade
 * lives here instead, keyed off the `bransch` field from the company's own
 * Google listing.
 *
 * ROT figures are illustrative and labelled as such on the page. They use real
 * rules: 30 % of the labour, at most 50 000 kr per person per year.
 *
 * @package Granvik Tak
 */

defined( 'ABSPATH' ) || exit;

/**
 * Which family a Google category belongs to.
 *
 * @param string $bransch Google's category string.
 * @return string Family key.
 */
function gt_bransch_nyckel( $bransch ) {
	$b = mb_strtolower( (string) $bransch );
	$karta = array(
		'el'       => array( 'elektriker', 'elinstallation', 'elfirma' ),
		'vvs'      => array( 'vvs', 'rörmokare', 'rormokare', 'badrumsinstallatör', 'värmeteknik', 'rörläggare' ),
		'glas'     => array( 'glasmästare', 'glas', 'fönsterinstallation' ),
		'maleri'   => array( 'målare', 'måleri' ),
		'snickeri' => array( 'snickare', 'möbelsnickare', 'köksrenovering', 'golventreprenör', 'golv' ),
		'tak'      => array( 'takläggare', 'plåtentreprenör', 'fasadentreprenör', 'plåtslager' ),
		'mark'     => array( 'gräventreprenör', 'anläggning', 'markarbete' ),
	);
	foreach ( $karta as $nyckel => $ord ) {
		foreach ( $ord as $o ) {
			if ( false !== mb_strpos( $b, $o ) ) {
				return $nyckel;
			}
		}
	}
	return 'bygg';   // byggföretag, byggfirma, entreprenör, murare and anything unknown
}

/**
 * All trade-dependent copy.
 *
 * @param string $falt Field name, or '' for the whole array.
 * @return mixed
 */
function gt_bransch( $falt = '' ) {
	static $vald = null;

	if ( null === $vald ) {
		$t = array();

		$t['el'] = array(
			'jobb_etikett' => 'utförda jobb',
			'yrke'    => 'Elektriker',
			'rubrik'  => 'Strömmen ska bara fungera.',
			'rubrik2' => 'Det är vårt jobb.',
			'ingress' => 'Behörig elektriker med fast pris skriftligt. Vi kommer när vi har sagt att vi kommer, och städar efter oss.',
			'cta'     => 'Boka elektriker',
			'tjanster' => array(
				array( 'Nytt i huset', 'Elinstallation', 'Uttag, belysning, laddbox och jordfelsbrytare. Allt enligt regelverket och dokumenterat när vi går.' ),
				array( 'Något krånglar', 'Felsökning', 'Proppar som går, uttag utan ström, sladdar som blir varma. Vi hittar felet innan vi börjar byta saker.' ),
				array( 'Innan du säljer', 'Elbesiktning', 'Vi går igenom hela anläggningen och skriver ett protokoll du kan visa köparen eller försäkringsbolaget.' ),
			),
			'rot'     => array( 'Material (kablar, uttag, centraler)', '9 000 kr', 'Arbete', '24 000 kr', '−7 200 kr', '25 800 kr', 'Räkneexempel — laddbox och ny central' ),
			'faq1'    => array( 'Hur snabbt kan ni komma?', 'Akuta fel samma dag om vi hinner, annars inom några dagar. Planerade jobb bokar vi in när det passar dig.' ),
		);

		$t['vvs'] = array(
			'jobb_etikett' => 'utförda jobb',
			'yrke'    => 'Rörmokare',
			'rubrik'  => 'Vatten ska stanna i rören.',
			'rubrik2' => 'Det ser vi till.',
			'ingress' => 'Fast pris skriftligt innan vi börjar. Vi säger till direkt om vi hittar något bakom väggen, inte efteråt på fakturan.',
			'cta'     => 'Boka rörmokare',
			'tjanster' => array(
				array( 'Hela rummet', 'Badrumsrenovering', 'Rivning, tätskikt, kakel och ny inredning. Branschregler följs och du får våtrumsintyg när vi är klara.' ),
				array( 'Det läcker', 'Stopp och läckor', 'Droppande kranar, stopp i avloppet, fuktfläckar. Vi hittar var vattnet kommer ifrån innan vi bilar.' ),
				array( 'Värmen', 'Värmepump och radiatorer', 'Installation, byte och injustering. Ett rätt injusterat system märks på räkningen.' ),
			),
			'rot'     => array( 'Material (kakel, tätskikt, inredning)', '65 000 kr', 'Arbete', '95 000 kr', '−28 500 kr', '131 500 kr', 'Räkneexempel — badrum, 6 m²' ),
			'faq1'    => array( 'Hur lång tid tar ett badrum?', 'Tre till fem veckor för ett normalt badrum. Tätskiktet måste torka, och den tiden går inte att korta.' ),
		);

		$t['glas'] = array(
			'jobb_etikett' => 'monterade rutor',
			'yrke'    => 'Glasmästare',
			'rubrik'  => 'Trasigt glas väntar inte.',
			'rubrik2' => 'Det gör inte vi heller.',
			'ingress' => 'Akut glasning dygnet runt och fast pris på planerade jobb. Vi mäter, tillverkar och monterar själva.',
			'cta'     => 'Ring för akut glasning',
			'tjanster' => array(
				array( 'Det gick sönder', 'Akut glasning', 'Krossad ruta hemma eller i butiken. Vi bommar för direkt och sätter nytt glas så snart det är tillverkat.' ),
				array( 'Kallt och dragigt', 'Fönsterbyte', 'Nya energiglas i gamla bågar, eller hela fönster. Skillnaden syns på värmeräkningen.' ),
				array( 'Inne i huset', 'Duschväggar och speglar', 'Måttbeställt glas till badrum, kök och inredning. Vi kommer ut och mäter innan vi beställer.' ),
			),
			'rot'     => array( 'Material (glas och beslag)', '6 500 kr', 'Arbete', '8 000 kr', '−2 400 kr', '12 100 kr', 'Räkneexempel — två nya energiglas' ),
			'faq1'    => array( 'Kommer ni ut akut?', 'Ja. Vid krossat glas bommar vi för samma dag så att huset är tätt, och sätter i nytt glas när det är tillverkat.' ),
		);

		$t['maleri'] = array(
			'jobb_etikett' => 'målade hem',
			'yrke'    => 'Målare',
			'rubrik'  => 'En välmålad vägg syns inte.',
			'rubrik2' => 'Det är hela poängen.',
			'ingress' => 'Fast pris skriftligt, täckt och maskat innan vi börjar. Du slipper både stänk och överraskningar.',
			'cta'     => 'Boka målare',
			'tjanster' => array(
				array( 'Inomhus', 'Målning och tapetsering', 'Väggar, tak, snickerier och dörrar. Vi spacklar och slipar först — det är där resultatet avgörs.' ),
				array( 'Utomhus', 'Fasadmålning', 'Tvätt, skrapning, grundning och två strykningar. Rätt färg på rätt underlag håller i femton år.' ),
				array( 'Fönstren', 'Fönsterrenovering', 'Gamla fönster som flagnar. Vi skrapar, kittar och målar om istället för att byta ut.' ),
			),
			'rot'     => array( 'Material (färg, spackel, tapet)', '11 000 kr', 'Arbete', '42 000 kr', '−12 600 kr', '40 400 kr', 'Räkneexempel — tre rum och hall' ),
			'faq1'    => array( 'Kan jag bo kvar under tiden?', 'Ja. Vi målar ett rum i taget och täcker in ordentligt. Färgen vi använder luktar knappt.' ),
		);

		$t['snickeri'] = array(
			'jobb_etikett' => 'utförda jobb',
			'yrke'    => 'Snickare',
			'rubrik'  => 'Måttbeställt sitter som det ska.',
			'rubrik2' => 'Varje gång.',
			'ingress' => 'Vi mäter själva, bygger själva och monterar själva. Fast pris skriftligt innan första brädan kapas.',
			'cta'     => 'Boka snickare',
			'tjanster' => array(
				array( 'Hjärtat i huset', 'Kök och inredning', 'Nytt kök eller nya luckor på gamla stommar. Vi mäter in så att det sitter rakt även i ett gammalt hus.' ),
				array( 'Under fötterna', 'Golv', 'Parkett, trägolv och slipning av gamla golv. Vi kollar underlaget innan vi lägger på.' ),
				array( 'Efter mått', 'Platsbyggt', 'Garderober, bokhyllor och bänkskivor byggda för just din vägg, inte för en standardmodul.' ),
			),
			'rot'     => array( 'Material (stommar, luckor, bänkskiva)', '90 000 kr', 'Arbete', '55 000 kr', '−16 500 kr', '128 500 kr', 'Räkneexempel — köksrenovering' ),
			'faq1'    => array( 'Bygger ni på plats eller i verkstad?', 'Båda. Stommar och luckor kommer färdiga, allt som måste passa mot en sned vägg kapar vi på plats.' ),
		);

		$t['mark'] = array(
			'jobb_etikett' => 'utförda jobb',
			'yrke'    => 'Markentreprenör',
			'rubrik'  => 'Det som ligger under marken',
			'rubrik2' => 'avgör resten.',
			'ingress' => 'Dränering, schakt och markarbeten med fast pris. Vi återställer tomten när vi är klara.',
			'cta'     => 'Boka markarbete',
			'tjanster' => array(
				array( 'Fuktig källare', 'Dränering', 'Schakt runt huset, ny dräneringsledning, isolering och återfyllnad. Rätt gjort håller i femtio år.' ),
				array( 'Ny yta', 'Markarbeten', 'Plattsättning, stödmurar, grus och asfalt. Vi packar underlaget ordentligt så att det inte sjunker.' ),
				array( 'Vattnet bort', 'Avvattning', 'Stuprörsanslutningar, brunnar och ledningar så att regnvattnet leds bort från grunden.' ),
			),
			'rot'     => array( 'Material (rör, makadam, isolering)', '48 000 kr', 'Arbete', '110 000 kr', '−33 000 kr', '125 000 kr', 'Räkneexempel — dränering runt villa' ),
			'faq1'    => array( 'Förstör ni tomten?', 'Vi gräver där vi måste och återställer efteråt. Gräsmattan behöver en säsong, rabatter flyttar vi innan vi börjar.' ),
		);

		$t['tak'] = array(
			'jobb_etikett' => 'lagda tak',
			'yrke'    => 'Takläggare',
			'rubrik'  => 'Taket håller huset torrt.',
			'rubrik2' => 'Vi håller taket.',
			'ingress' => 'Kostnadsfri takbesiktning och fast pris skriftligt. Du betalar ingenting förrän materialet står på tomten.',
			'cta'     => 'Boka takbesiktning',
			'tjanster' => array(
				array( 'Ett nytt tak', 'Takomläggning', 'Rivning av gammalt tak, ny underlagspapp, läkt och pannor. Klart på 2–5 dagar på ett normalt villatak.' ),
				array( 'Innan du byter', 'Taktvätt och impregnering', 'Vi tvättar bort mossa och alger och behandlar ytan. Förlänger livslängden med 10–15 år.' ),
				array( 'Något läcker', 'Takreparation', 'Läckor, trasiga pannor, plåt och hängrännor. Akuta jobb samma vecka.' ),
			),
			'rot'     => array( 'Material (pannor, papp, läkt, plåt)', '92 000 kr', 'Arbete', '120 000 kr', '−36 000 kr', '176 000 kr', 'Räkneexempel — villatak, 140 m²' ),
			'faq1'    => array( 'Hur lång tid tar en takomläggning?', 'Ett normalt villatak tar 2–5 dagar beroende på storlek, lutning och vad vi hittar under de gamla pannorna.' ),
		);

		$t['bygg'] = array(
			'jobb_etikett' => 'utförda projekt',
			'yrke'    => 'Byggare',
			'rubrik'  => 'Ett bygge ska hålla tiden.',
			'rubrik2' => 'Och priset.',
			'ingress' => 'Fast pris skriftligt, egna hantverkare och en kontaktperson hela vägen. Du slipper hålla ihop fem olika firmor.',
			'cta'     => 'Boka platsbesök',
			'tjanster' => array(
				array( 'Mer plats', 'Om- och tillbyggnad', 'Tillbyggnad, inredd vind eller nytt rum i källaren. Vi sköter ritningar och bygglov om du vill.' ),
				array( 'Allt i ett', 'Totalentreprenad', 'En kontakt, ett pris, ett ansvar. Vi håller ihop el, vvs och måleri åt dig.' ),
				array( 'Ut i trädgården', 'Altan och uterum', 'Altaner, uterum och carportar som tål svenskt väder och sitter fast i marken.' ),
			),
			'rot'     => array( 'Material', '140 000 kr', 'Arbete', '180 000 kr', '−50 000 kr', '270 000 kr', 'Räkneexempel — tillbyggnad 15 m²' ),
			'faq1'    => array( 'Sköter ni bygglovet?', 'Ja, om du vill. Vi tar fram ritningar och lämnar in ansökan, och du står bara för avgiften till kommunen.' ),
		);

		$nyckel = gt_bransch_nyckel( gt_lead( 'bransch', '' ) );
		$vald   = isset( $t[ $nyckel ] ) ? $t[ $nyckel ] : $t['bygg'];
	}

	if ( '' === $falt ) {
		return $vald;
	}
	return isset( $vald[ $falt ] ) ? $vald[ $falt ] : '';
}
