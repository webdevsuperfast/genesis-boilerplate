<?php
/**
 * Scripts
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://rotsenacob.com
 * @author       Rotsen Mark Acob <rotsenacob.com>
 * @copyright    Copyright (c) 2016, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Theme Scripts & Stylesheet
add_action( 'wp_enqueue_scripts', 'gb_theme_scripts' );
function gb_theme_scripts() {
	$version = wp_get_theme()->Version;
	if ( !is_admin() ) {
		// Slicknav
		wp_register_script( 'app-slicknav-js', GB_JS . 'jquery.slicknav.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'app-slicknav-js' );

		// Theme JS
		wp_register_script( 'app-js', GB_JS . 'app.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'app-js' );

		//* Deregister SuperFish Scripts
		wp_deregister_script( 'superfish' );
		wp_deregister_script( 'superfish-args' );

		// Theme CSS
		// wp_enqueue_style( 'app-css', GB_CSS . 'app.css' );

		$menu = get_theme_mod( 'menu' );

		$menu_args = array(
			'menu' => '#' . $menu,
			'label' => get_theme_mod( 'menu-label', __( 'Menu' ) ),
			'prepend' => get_theme_mod( 'menu-prepend', 'body' ),
			'close' => get_theme_mod( 'menu-close', __( '&#9658;' ) ),
			'open' => get_theme_mod( 'menu-open', __( '&#9660;' ) )
		);

		if ( $menu ) {
			wp_localize_script( 'app-js', 'slick', $menu_args );

			$breakpoint = get_theme_mod( 'menu-breakpoint', 600 );
			$css = '
				.slicknav_menu {
					display: none;
				}
				@media only screen and (max-width: '.$breakpoint.'px) {
					.slicknav_menu {
						display: block;
					}
					#'.$menu.' {
						display: none;
					}
				}
			';

			// wp_add_inline_style( 'app-css', $css );
		}
	}
}
