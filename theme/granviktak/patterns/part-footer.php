<?php
/**
 * Title: Part: sidfot
 * Slug: granviktak/part-footer
 * Inserter: no
 *
 * Markup ligger i en pattern så att länkarna använder sajtens egen adress.
 */
$url = function ( $p ) { return esc_url( home_url( $p ) ); };
$orter = array_slice( (array) gt_lead( 'orter', array() ), 0, 8 );
?>
<!-- wp:group {"tagName":"div","className":"gt-footer is-style-section-dark","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group gt-footer is-style-section-dark" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"32%"} -->
<div class="wp-block-column" style="flex-basis:32%"><!-- wp:group {"className":"gt-brand","layout":{"type":"flex"}} -->
<div class="wp-block-group gt-brand"><!-- wp:site-title {"level":0} /--></div>
<!-- /wp:group -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( gt_bransch( 'yrke' ) ); ?> åt villaägare och bostadsrätter. Fast pris skriftligt och 10 års garanti på arbetet.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="tel:<?php echo esc_attr( gt_lead( 'telefon_tel' ) ); ?>"><strong><?php echo esc_html( gt_lead( 'telefon' ) ); ?></strong></a><br><?php echo esc_html( gt_lead( 'adress' ) ); ?><br>Vard. 07–18, helger efter överenskommelse<br>Org.nr 556000-0000 <span class="gt-sample">(platshållare)</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"medium"} -->
<h2 class="wp-block-heading has-medium-font-size">Tjänster</h2>
<!-- /wp:heading -->

<!-- wp:list {"fontSize":"small"} -->
<ul class="wp-block-list has-small-font-size"><!-- wp:list-item -->
<?php foreach ( (array) gt_bransch( 'tjanster' ) as $gt_i => $gt_t ) : ?><li><a href="<?php echo $url( '/tjanst-' . ( $gt_i + 1 ) ); ?>"><?php echo esc_html( $gt_t[1] ); ?></a></li><?php endforeach; ?>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo $url( '/offert' ); ?>">Boka besiktning</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"medium"} -->
<h2 class="wp-block-heading has-medium-font-size">Orter</h2>
<!-- /wp:heading -->

<!-- wp:list {"fontSize":"small"} --><ul class="wp-block-list has-small-font-size"><?php
foreach ( $orter as $o ) :
	$slug = strtolower( str_replace( array( ' ', 'å', 'ä', 'ö' ), array( '-', 'a', 'a', 'o' ), $o ) );
	?><!-- wp:list-item -->
<li><a href="<?php echo $url( '/taklaggare-i-' . $slug ); ?>"><?php echo esc_html( $o ); ?></a></li>
<!-- /wp:list-item -->
<?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"medium"} -->
<h2 class="wp-block-heading has-medium-font-size">Företaget</h2>
<!-- /wp:heading -->

<!-- wp:list {"fontSize":"small"} -->
<ul class="wp-block-list has-small-font-size"><!-- wp:list-item -->
<li><a href="<?php echo $url( '/om-oss' ); ?>">Om oss</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo $url( '/jobba-hos-oss' ); ?>">Jobba hos oss</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo $url( '/fardiga-projekt' ); ?>">Färdiga projekt</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo $url( '/integritetspolicy' ); ?>">Integritetspolicy</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","fontSize":"small","className":"gt-footer-note","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<p class="has-text-align-center gt-footer-note has-small-font-size" style="margin-top:var(--wp--preset--spacing--50)">Granvik Tak AB · Demosajt byggd som förslag. Bilder och omdömen är platshållare.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
