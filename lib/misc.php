<?php
/**
 * Misc
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Image Function
function gb_post_image() {
	global $post;
	$image = '';
	$image_id = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_id, 'full' );
	$image = $image[0];
	if ( $image ) return $image;
	return gb_get_first_image();
}

// Get the First Image Attachment Function
function gb_get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = "";
	if ( isset( $matches[1][0] ) )
		$first_img = $matches[1][0];
	return $first_img;
}

//* Allow PHP Execution on Widgets
add_filter( 'widget_text','gb_execute_php', 100 );
function gb_execute_php( $html ) {
	if( strpos( $html,"<"."?php" ) !== false ){
		ob_start();
		eval( "?".">".$html );
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}

//* Theme Settings
add_action( 'get_header', 'gb_do_theme_settings' );
function gb_do_theme_settings() {
	if ( get_theme_mod( 'logo', false ) ) {
		remove_action( 'genesis_header', 'genesis_do_header' );
		add_action( 'genesis_header', 'gb_do_header' );
	}
}

//* Custom Header
function gb_do_header() {
    global $wp_registered_sidebars;

    genesis_markup( array(
        'html5'   => '<div %s>',
        'xhtml'   => '<div class="title-area" id="title-area">',
        'context' => 'title-area'
    ) );
    if ( get_theme_mod( 'logo', false ) ) {
        echo '<h1 class="site-title" itemprop="headline">';
            echo '<a href="'.get_bloginfo( 'url' ).'" class="logo" title="'.get_bloginfo( 'name' ).'">';
                echo '<img src="'.get_theme_mod( 'logo' ).'" alt="'.get_bloginfo( 'name' ).'"/>';
            echo '</a>';
        echo '</h1>';
    } else {
        do_action( 'genesis_site_title' );
        do_action( 'genesis_site_description' );
    }
    echo '</div>';

    if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
        genesis_markup( array(
            'html5'   => '<aside %s>',
            'xhtml'   => '<div class="widget-area header-widget-area">',
            'context' => 'header-widget-area',
        ) );

            do_action( 'genesis_header_right' );
            add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
            add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
            dynamic_sidebar( 'header-right' );
            remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
            remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

        genesis_markup( array(
            'html5' => '</aside>',
            'xhtml' => '</div>',
        ) );
    }
}

//* This will occur when the comment is posted
function gb_comment_post( $incoming_comment ) {
    // convert everything in a comment to display literally
    $incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
    // the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
    $incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
    return( $incoming_comment );
}

//* This will occur before a comment is displayed
function gb_comment_display( $comment_to_display ) {
    // Put the single quotes back in
    $comment_to_display = str_replace( '&apos;', "'", $comment_to_display );
    return $comment_to_display;
}

//* Remove query string from static files
function gb_remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
}

//* Mr Image Resize functionn
function gb_thumb( $url, $width, $height=0, $align='' ) {
    return mr_image_resize( $url, $width, $height, true, $align, false );
}

//* Setup WooCommerce for Genesis
function gb_woocommerce_setup_genesis() {
    woocommerce_content();
}