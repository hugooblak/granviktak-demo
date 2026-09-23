<?php
/**
 * Title: Vanliga frågor
 * Slug: granviktak/faq
 * Categories: granviktak-sections
 * Description: Sex frågor kunder faktiskt ställer. Öppnas och stängs utan JavaScript.
 */
$faqs = array(
	gt_bransch( 'faq1' ),
	array( 'Vad kostar det?', 'Det beror på omfattningen och vad vi hittar när vi är på plats. Vi kommer ut och tittar kostnadsfritt och skickar sedan ett fast pris — inte en ungefärlig siffra.' ),
	array( 'Måste jag flytta ut under tiden?', 'Nej, i de allra flesta fall kan du bo kvar. Vi säger till i förväg om något moment gör att du behöver vara borta en dag.' ),
	array( 'Hur fungerar ROT-avdraget?', 'Vi drar av 30 % av arbetskostnaden direkt på fakturan, upp till 50 000 kr per person och år, och sköter ansökan mot Skatteverket. Du behöver inte göra något.' ),
	array( 'Vad händer om något oväntat dyker upp?', 'Vi stannar och visar dig vad vi hittat, med foton och vad det kostar att åtgärda. Du bestämmer innan vi fortsätter — det dyker aldrig upp på slutfakturan.' ),
	array( 'Vad ingår i garantin?', '10 års garanti på vårt arbete, utöver materialtillverkarens egen garanti på det vi monterat. Du får den skriftligt när jobbet är klart.' ),
);
?>
<!-- wp:group {"align":"full","className":"gt-sec-faq","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group alignfull gt-sec-faq" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"32%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:32%"><!-- wp:heading {"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-xx-large-font-size">Vanliga frågor</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">Hittar du inte svaret? Ring oss på <a href="tel:<?php echo esc_attr( gt_lead( 'telefon_tel' ) ); ?>"><?php echo esc_html( gt_lead( 'telefon' ) ); ?></a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"68%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:68%"><?php
foreach ( $faqs as $f ) :
	?><!-- wp:details {"className":"gt-faq-item"} -->
<details class="wp-block-details gt-faq-item"><summary><?php echo esc_html( $f[0] ); ?></summary><!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color"><?php echo esc_html( $f[1] ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<?php endforeach; ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
