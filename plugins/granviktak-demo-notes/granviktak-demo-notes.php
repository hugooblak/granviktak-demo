<?php
/**
 * Plugin Name: Granvik Tak Demo Notes
 * Description: Portfolio helper. Shows a "this is a demo" bar and, when switched on, a note above each section explaining the conversion (CRO) decision behind it. Delete this plugin on a real site.
 * Version: 1.0.0
 * Requires at least: 6.6
 * Author: Hugo Oblak
 * License: GPL-2.0-or-later
 *
 * The notes are not stored in page content, so editors never see them and they vanish with the plugin.
 *
 * @package Granvik TakDemoNotes
 */

defined( 'ABSPATH' ) || exit;

/**
 * Notes on or off. ?cro=1 turns them on (and remembers it in a cookie while you browse), ?cro=0 turns them off.
 */
function npd_notes_on() {
	static $on = null;
	if ( null === $on ) {
		// Never on a demo built for a real company: these notes explain the sales
		// reasoning behind each section and are meant for a portfolio audience.
		if ( function_exists( 'gt_lead' ) && gt_lead( 'ar_riktig' ) ) {
			$on = false;
			return $on;
		}
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['cro'] ) ) {
			$on = '1' === $_GET['cro'];
		} else {
			$on = isset( $_COOKIE['npd_cro'] ) && '1' === $_COOKIE['npd_cro'];
		}
		// phpcs:enable
	}
	return $on;
}

add_action(
	'send_headers',
	function () {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['cro'] ) && ! headers_sent() ) {
			setcookie( 'npd_cro', npd_notes_on() ? '1' : '0', 0, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, is_ssl(), true );
		}
	}
);

/**
 * The notes, keyed by the section class used in the theme's patterns.
 *
 * @return array
 */
function npd_notes() {
	return array(
		'gt-sec-hero'     => array(
			'Offer and first step above the fold',
			'One headline with a concrete promise (a fixed price in writing). Three proof points answer the usual fears: warranty, disruption, insurance. The form starts right here with the easiest question, a ZIP code. People who have started a form are more likely to finish it. Service pages use the same layout with two actions: quote or call.',
		),
		'gt-sec-trust'    => array(
			'Trust strip right under the hero',
			'Short, checkable claims placed where the visitor decides whether to keep reading. Icons are 1 KB SVGs, so this adds almost nothing to load time.',
		),
		'gt-sec-steps'    => array(
			'How it works',
			'People don\'t fill in forms when they can\'t picture what happens next. Three steps make the process feel small, and the button under them says "Start step 1".',
		),
		'gt-sec-services' => array(
			'Services that lead somewhere',
			'Each card goes to a service page or straight to the quote form with that service already picked (?service=repair). One less question for the visitor.',
		),
		'gt-sec-price'    => array(
			'Show the price range',
			'Price is the first question most visitors have. Hiding it sends them to a competitor\'s site to find out. Ranges also pre-qualify leads, so the sales team spends less time on budgets that don\'t fit.',
		),
		'gt-sec-reviews'  => array(
			'Reviews that answer objections',
			'Pick reviews that answer a specific worry (price changed? mess? pressure?), not general praise. These are labelled placeholders. On a live site they come from real, verifiable reviews.',
		),
		'gt-sec-compare'  => array(
			'Compare against the real alternative',
			'The visitor is already comparing. A simple table frames the choice on the points where this company wins, in a calm tone.',
		),
		'gt-sec-promise'  => array(
			'Risk reversal and financing',
			'A written guarantee takes away "what if it goes wrong", financing takes away "can I afford it". The dark background breaks up the page so this section gets read.',
		),
		'gt-sec-faq'      => array(
			'FAQ as objection handling',
			'Questions are the real reasons people hesitate, taken from sales calls. Built with WordPress\'s own Details block: no JavaScript, works with a keyboard, easy to edit.',
		),
		'gt-sec-final'    => array(
			'Second chance at the end',
			'Visitors who scroll to the bottom are interested but not yet convinced. Same low-effort first step as the hero, plus the phone number for people who prefer to talk.',
		),
		'gt-sec-details'  => array(
			'Specific details',
			'Listing exactly what is included builds trust and makes cheaper quotes that leave things out easy to spot.',
		),
		'gt-sec-funnel'   => array(
			'Focus page: nothing to click except the form',
			'No menu and no footer links, so there are no exits. One question per step, big choice cards that move on by themselves, a progress bar, and contact details asked last, after the visitor has already invested. Each personal field says why it\'s needed. Hidden fields record UTM tags and ad click IDs, so every lead shows which campaign it came from. Works without JavaScript as a normal form.',
		),
		'gt-sec-thanks'   => array(
			'Thank-you page that keeps the lead warm',
			'Says exactly when they will hear back (speed to lead matters most in home services), gives a fast path for urgent leaks, and fires one "generate_lead" analytics event per real submission.',
		),
	);
}

/**
 * Put a note in front of each matching section when notes are on.
 */
add_filter(
	'render_block',
	function ( $html, $block ) {
		if ( is_admin() || ! npd_notes_on() || empty( $block['attrs']['className'] ) ) {
			return $html;
		}
		foreach ( npd_notes() as $class => $note ) {
			if ( preg_match( '/(^|\s)' . preg_quote( $class, '/' ) . '(\s|$)/', $block['attrs']['className'] ) ) {
				return sprintf(
					'<aside class="npd-note" aria-label="%s"><p class="npd-note-title"><span>CRO note</span> %s</p><p>%s</p></aside>',
					esc_attr( 'CRO note: ' . $note[0] ),
					esc_html( $note[0] ),
					esc_html( $note[1] )
				) . $html;
			}
		}
		return $html;
	},
	10,
	2
);

/**
 * Demo bar at the very top of every page.
 */
add_action(
	'wp_body_open',
	function () {
		// A demo built for a real company carries that company's own reviews and
		// photos, so calling it fictional would be a lie - and the CRO notes are
		// written for a portfolio audience, not for the roofer being pitched.
		$ar_riktig = function_exists( 'gt_lead' ) && gt_lead( 'ar_riktig' );

		if ( $ar_riktig ) {
			$foretag = function_exists( 'gt_lead' ) ? gt_lead( 'foretag' ) : get_bloginfo( 'name' );
			?>
			<div class="npd-bar" role="region" aria-label="Om den här sidan">
				<p><strong>Förslag på ny hemsida för <?php echo esc_html( $foretag ); ?>.</strong>
					Text, omdömen och bilder är hämtade från er egen Google-profil. Inget är publicerat —
					sidan ligger bara här tills ni sagt vad ni tycker.</p>
			</div>
			<?php
			return;
		}

		$toggle = add_query_arg( 'cro', npd_notes_on() ? '0' : '1' );
		?>
		<div class="npd-bar" role="region" aria-label="Demo notice">
			<p><strong>Portföljdemo.</strong> <?php echo esc_html( get_bloginfo( 'name' ) ); ?> är ett påhittat företag; omdömen och siffror är exempel.
				<a href="<?php echo esc_url( $toggle ); ?>"><?php echo npd_notes_on() ? 'Dölj CRO-noteringarna' : 'Visa CRO-noteringarna bakom varje sektion'; ?></a>
			</p>
		</div>
		<?php
	},
	1
);

add_action(
	'wp_head',
	function () {
		?>
		<style id="npd-css">
			.npd-bar{background:#0F2233;color:#E9EEF2;font-size:.875rem;line-height:1.4;padding:.5rem 1rem;text-align:center}
			.npd-bar p{margin:0}.npd-bar a{color:#F2B33D;font-weight:700;margin-left:.35rem}
			.npd-note{max-width:1180px;margin:1rem auto;box-sizing:border-box;width:calc(100% - 2rem);background:#FFF8DB;border:2px dashed #C99A06;border-radius:10px;padding:.8rem 1rem;color:#3D2E00;font-size:.9375rem;line-height:1.5}
			.npd-note p{margin:0}.npd-note-title{font-weight:800;margin-bottom:.25rem !important}
			.npd-note-title span{display:inline-block;background:#3D2E00;color:#FFF8DB;font-size:.6875rem;letter-spacing:.06em;text-transform:uppercase;border-radius:4px;padding:.1rem .4rem;margin-right:.35rem;vertical-align:.1em}
		</style>
		<?php
	}
);

/**
 * A short guide on the Dashboard for anyone reviewing the demo in WordPress Playground.
 */
add_action(
	'wp_dashboard_setup',
	function () {
		wp_add_dashboard_widget(
			'npd_guide',
			'Granvik Tak demo: where to look',
			function () {
				$items = array(
					array( home_url( '/?cro=1' ), 'Home page with CRO notes switched on' ),
					array( home_url( '/free-quote/' ), 'The 4-step quote form (submit it, then check Leads)' ),
					array( admin_url( 'edit.php?post_type=npl_lead' ), 'Leads inbox, with status and CSV export' ),
					array( admin_url( 'post.php?post=' . get_option( 'page_on_front' ) . '&action=edit' ), 'Edit the home page (normal blocks, no page builder)' ),
					array( admin_url( 'edit.php' ), 'Guides imported from the old site' ),
					array( admin_url( 'site-editor.php' ), 'Site editor: styles, header, footer, templates' ),
				);
				echo '<ol>';
				foreach ( $items as $item ) {
					printf( '<li><a href="%s">%s</a></li>', esc_url( $item[0] ), esc_html( $item[1] ) );
				}
				echo '</ol>';
			}
		);
	}
);
