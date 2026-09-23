<?php
/**
 * Title: Inline call to action
 * Slug: granviktak/cta-inline
 * Categories: granviktak-sections
 * Description: Small box at the end of guides, linking to the quote form.
 */
$img = get_theme_file_uri( 'assets/img/' );
$url = function ( $path ) { return esc_url( home_url( $path ) ); };
?>
<!-- wp:group {"className":"is-style-card gt-sec-inline","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"backgroundColor":"pine-light","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card gt-sec-inline has-pine-light-background-color has-background" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":2,"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Osäker på vad som behöver göras?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Kostnadsfritt platsbesök och ett fast pris skriftligt inom två arbetsdagar.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"gt-track-cta"} -->
<div class="wp-block-button gt-track-cta"><a class="wp-block-button__link wp-element-button" href="<?php echo $url( '/free-quote/' ); ?>"><?php echo esc_html( gt_bransch( 'cta' ) ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
