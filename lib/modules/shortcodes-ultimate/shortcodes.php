<?php
/**
 * Extend Shortcodes Ultimate
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       SuperFastBusiness <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Groups
add_filter( 'su/data/groups', 'gb_register_groups', 10, 2 );
function gb_register_groups( $groups ) {
	$groups['custom'] = __( 'Custom', 'gb' );

	return $groups;
}

//* Shortcodes
foreach ( glob( dirname( __FILE__ ) . '/shortcodes/*.php' ) as $file ) {
	require_once $file;
}