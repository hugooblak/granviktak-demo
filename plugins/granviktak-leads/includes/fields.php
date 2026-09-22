<?php
/**
 * The form's questions and answer choices, in one place.
 *
 * Change a label here and it changes in the form, the admin inbox and the CSV export.
 *
 * @package Granvik TakLeads
 */

defined( 'ABSPATH' ) || exit;

/**
 * Answer choices for the two multiple-choice questions.
 *
 * @return array
 */
function npl_choices() {
	return apply_filters(
		'npl_choices',
		array(
			'service'  => array(
				'replacement' => __( 'Full roof replacement', 'granviktak-leads' ),
				'storm'       => __( 'Storm or hail damage', 'granviktak-leads' ),
				'repair'      => __( 'Leak or repair', 'granviktak-leads' ),
				'inspection'  => __( 'Inspection only', 'granviktak-leads' ),
				'not-sure'    => __( 'Not sure yet', 'granviktak-leads' ),
			),
			'timeline' => array(
				'asap'     => __( 'As soon as possible', 'granviktak-leads' ),
				'1-3'      => __( 'In the next 1–3 months', 'granviktak-leads' ),
				'research' => __( 'Just getting prices', 'granviktak-leads' ),
			),
		)
	);
}

/**
 * Hidden fields that record where the visitor came from (for ad and SEO reporting).
 *
 * @return string[]
 */
function npl_tracking_fields() {
	return array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid', 'landing_page', 'referrer' );
}

/**
 * Human-readable label for a stored answer.
 *
 * @param string $field Field key.
 * @param string $value Stored value.
 * @return string
 */
function npl_label( $field, $value ) {
	$choices = npl_choices();
	return isset( $choices[ $field ][ $value ] ) ? $choices[ $field ][ $value ] : (string) $value;
}

/**
 * The consent sentence shown under the submit button. Saved with each lead as a record of what the person agreed to.
 *
 * @return string
 */
function npl_consent_text() {
	return apply_filters(
		'npl_consent_text',
		__( 'By clicking "Get my free quote" you agree that Granvik Tak Roofing may call, text or email you about your quote, including by automated means. Consent is not a condition of purchase. Message and data rates may apply. Reply STOP to opt out.', 'granviktak-leads' )
	);
}

/**
 * Lead statuses for simple follow-up tracking in the admin.
 *
 * @return array
 */
function npl_statuses() {
	return array(
		'new'       => __( 'New', 'granviktak-leads' ),
		'contacted' => __( 'Contacted', 'granviktak-leads' ),
		'quoted'    => __( 'Quote sent', 'granviktak-leads' ),
		'won'       => __( 'Won', 'granviktak-leads' ),
		'lost'      => __( 'Lost', 'granviktak-leads' ),
		'spam'      => __( 'Suspected spam', 'granviktak-leads' ),
	);
}

/**
 * Page people land on after a successful submit.
 *
 * @return string
 */
function npl_thank_you_url() {
	$page_id = (int) get_option( 'npl_thank_you_page' );
	$url     = $page_id ? get_permalink( $page_id ) : home_url( '/thank-you/' );
	return apply_filters( 'npl_thank_you_url', $url );
}
