<?php
/**
 * Functions
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'GB_THEME_NAME', 'Genesis Boilerplate' );
define( 'GB_THEME_URL', 'http://www.recommendwp.com/' );
define( 'GB_THEME_VERSION', '0.0.1' );
define( 'GB_LIB', CHILD_DIR . '/lib/' );
define( 'GB_MODULES', GB_LIB . 'modules/' );
define( 'GB_JS', CHILD_URL . '/assets/js/' );
define( 'GB_CSS', CHILD_URL . '/assets/css/' );

//* Cleanup WP Head
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

//* Remove Query Strings
add_filter( 'style_loader_src', 'gb_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'gb_remove_cssjs_ver', 10, 2 );

//* Prevent HTML on Comments
add_filter( 'preprocess_comment', 'gb_comment_post', '', 1 );
add_filter( 'comment_text', 'gb_comment_display', '', 1 );
add_filter( 'comment_text_rss', 'gb_comment_display', '', 1 );
add_filter( 'comment_excerpt', 'gb_comment_display', '', 1 );

//* This stops WordPress from trying to automatically make hyperlinks on text:
remove_filter( 'comment_text', 'make_clickable', 9 );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

// Prevent WordPress from displaying login error message
add_filter( 'login_errors', create_function( '$a', "return null;" ) );

//* Remove WP Version
add_filter( 'the_generator', 'gb_remove_wp_version' );

//* Unregister site layouts
// genesis_unregister_layout( 'content-sidebar-sidebar' );
// genesis_unregister_layout( 'sidebar-sidebar-content' );
// genesis_unregister_layout( 'sidebar-content-sidebar' );
// genesis_unregister_layout( 'sidebar-content' );

//* Unregister unneeded sidebars
// unregister_sidebar( 'header-right' );
// unregister_sidebar( 'sidebar-alt' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
// add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Disable the superfish script
add_filter( 'genesis_superfish_enabled', '__return_false' );

//* Move Sidebar Secondary After Content
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action( 'genesis_after_content', 'genesis_get_sidebar_alt' );

//* Remove Gallery Default Styles
add_filter( 'use_default_gallery_style', '__return_false' );

// Remove WP Emoji
// @http://www.denisbouquet.com/remove-wordpress-emoji-code/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Move the secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

//* Mr Image Resize
if ( !function_exists( 'mr_image_resize' ) ) {
	require_once( GB_MODULES . 'mr-image-resize.php' );
}

//* Include php files from lib folder
//* @link https://gist.github.com/theandystratton/5924570
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) {
	require_once $file;
}
