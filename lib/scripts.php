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
		// Dashicons
		wp_enqueue_style( 'dashicons' );

		// Responsive Menu
		wp_register_script( 'app-menu-js', GB_JS . 'responsive-menus.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'app-menu-js' );

		$menu_settings = array(
			'mainMenu' => __( 'Menu' ),
			'menuIconClass' => 'dashicons-before dashicons-menu',
			'subMenu' => __( 'Submenu' ),
			'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
			'menuClasses' => array(
				'combine' => array(
					'.nav-primary',
				),
				'others' => ''
			),
		);

		wp_localize_script( 'app-menu-js', 'genesis_responsive_menu', $menu_settings );

		// Theme JS
		wp_register_script( 'app-js', GB_JS . 'app.min.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( 'app-js' );

		//* Deregister SuperFish Scripts
		wp_deregister_script( 'superfish' );
		wp_deregister_script( 'superfish-args' );

		// Theme CSS
		wp_enqueue_style( 'app-css', GB_CSS . 'app.css' );
	}
}
