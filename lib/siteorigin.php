<?php
/**
 * SiteOrigin Settings
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       SuperFastBusiness <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Filter Default SiteOrigin Settings
add_filter( 'siteorigin_panels_settings_defaults', 'gb_siteorigin_settings' );
function gb_siteorigin_settings( $defaults ) {
	// Widgets field
	$defaults['title-html'] = '<h4 class="widgettitle">{{title}}</h4>';
	$defaults['recommended-widgets'] = false;

	// Bottom margin
	$defaults['margin-bottom'] = 0;

	// Side margins
	$defaults['margin-sides'] = 30;

	// Layout field
	$defaults['mobile-width'] = 767;
	$defaults['tablet-layout'] = true;
	$defaults['tablet-width'] = 991;
	
	// Content field
	$defaults['copy-content'] = true;

	// Post types
	$defaults['post-types'] = array( 'page' );

	return $defaults;
}