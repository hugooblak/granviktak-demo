<?php
/**
 * Title: Tjänster
 * Slug: granviktak/services
 * Categories: granviktak-sections
 * Description: Tre tjänster som bildkort. Bilden är platshållare och byts mot företagets egna jobbfoton.
 */
$img = get_theme_file_uri( 'assets/img/' );
$url = function ( $path ) { return esc_url( home_url( $path ) ); };
$bild = array( gt_lead_bild( 0 ), gt_lead_bild( 1 ), gt_lead_bild( 2 ) );
$fallback = array( 'svc-omlaggning.svg', 'svc-taktvatt.svg', 'svc-reparation.svg' );
$services = array();
foreach ( (array) gt_bransch( 'tjanster' ) as $i => $t ) {
	// $t is array( kicker, title, description )
	$services[] = array( $bild[ $i ] ? $bild[ $i ] : $fallback[ $i ], $t[1], $t[2], '/tjanst-' . ( $i + 1 ), $t[0] );
}
?>
<!-- wp:group {"align":"full","className":"gt-sec-services","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group alignfull gt-sec-services" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"align":"wide","fontSize":"xx-large"} -->
<h2 class="wp-block-heading alignwide has-xx-large-font-size">Tre sätt vi hjälper dig</h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","className":"gt-cards","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","minimumColumnWidth":"18rem"}} -->
<div class="wp-block-group alignwide gt-cards" style="margin-top:var(--wp--preset--spacing--50)"><?php
foreach ( $services as $s ) :
	?><!-- wp:group {"className":"gt-card","layout":{"type":"default"}} -->
<div class="wp-block-group gt-card"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"gt-card-img"} -->
<figure class="wp-block-image size-full gt-card-img"><a href="<?php echo $url( $s[3] ); ?>"><img src="<?php echo esc_url( gt_lead_img( $s[0] ) ); ?>" alt="<?php echo esc_attr( $s[1] ); ?>"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"gt-card-kicker","fontSize":"small"} -->
<p class="gt-card-kicker has-small-font-size"><?php echo esc_html( $s[4] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"fontSize":"x-large"} -->
<h3 class="wp-block-heading has-x-large-font-size"><a href="<?php echo $url( $s[3] ); ?>"><?php echo esc_html( $s[1] ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"small"} -->
<p class="has-ink-soft-color has-text-color has-small-font-size"><?php echo esc_html( $s[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
