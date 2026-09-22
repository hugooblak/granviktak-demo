<?php
/**
 * Title: Omdömen
 * Slug: granviktak/reviews
 * Categories: granviktak-sections
 * Description: Google-betyget stort, tre omdömen bredvid. Texterna är platshållare och byts mot företagets riktiga omdömen.
 */
$reviews = array(
	array( 'De la om hela taket på två dagar, städade efter sig och slutnotan var precis den som stod i offerten. Svårt att klaga.', 'Julia A.', '5', 'för 2 veckor sedan' ),
	array( 'Vi hade läckage vid skorstenen. De kom ut dagen efter jag ringde, hittade felet och lagade det direkt. Väldigt trevliga killar.', 'Stefan A.', '5', 'för 1 månad sedan' ),
	array( 'Noggranna, effektiva och proffsiga. Fick ett fast pris innan de började och det höll hela vägen.', 'Maria L.', '5', 'för 2 månader sedan' ),
);
?>
<!-- wp:group {"align":"full","className":"gt-sec-reviews","backgroundColor":"sand","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group alignfull gt-sec-reviews has-sand-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:30%"><!-- wp:group {"className":"gt-rating","layout":{"type":"default"}} -->
<div class="wp-block-group gt-rating"><!-- wp:paragraph {"className":"gt-rating-num"} -->
<p class="gt-rating-num">4,9</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"gt-stars gt-stars-lg"} -->
<p class="gt-stars gt-stars-lg"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">158 omdömen på Google <span class="gt-sample">(platshållare)</span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="#google">Läs alla omdömen på Google →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"70%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:70%"><?php
foreach ( $reviews as $r ) :
	?><!-- wp:group {"className":"gt-review","layout":{"type":"default"}} -->
<div class="wp-block-group gt-review"><!-- wp:paragraph {"className":"gt-stars"} -->
<p class="gt-stars"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $r[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"gt-review-by","fontSize":"small","textColor":"ink-soft"} -->
<p class="gt-review-by has-ink-soft-color has-text-color"><strong><?php echo esc_html( $r[1] ); ?></strong> · <?php echo esc_html( $r[3] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
