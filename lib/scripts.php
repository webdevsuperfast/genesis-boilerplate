<?php
/**
 * Scripts
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Theme Scripts & Stylesheet
add_action( 'wp_enqueue_scripts', 'gb_theme_scripts' );
function gb_theme_scripts() {
	$version = wp_get_theme()->Version;
	if ( !is_admin() ) {
		wp_register_script( 'app-js', GB_JS . 'app.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'app-js' );

		//* Deregister SuperFish Scripts
		wp_deregister_script( 'superfish' );
		wp_deregister_script( 'superfish-args' );

		wp_enqueue_style( 'app-css', GB_CSS . 'app.css' );

	}
}
