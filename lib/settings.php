<?php
/**
 * Override Genesis Settings
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_action( 'init', 'gb_theme_settings' );
function gb_theme_settings() {
	if ( class_exists( 'JDN_Override_Genesis_Settings' ) ) {
        $override = new JDN_Override_Genesis_Settings();
        
        $options = array(
            'update'                    => 1,
			'blog_title'                => 'text', // or 'image'
			'header_right'              => 0,
			'site_layout'               => genesis_get_default_layout(),
			'superfish'                 => 0,
			'nav_extras'                => '',
			'nav_extras_twitter_id'     => '',
			'nav_extras_twitter_text'   => __( '', 'genesis' ),
			'feed_uri'                  => '',
			'comments_feed_uri'         => '',
			'redirect_feeds'            => 0,
			'comments_pages'            => 0,
			'comments_posts'            => 1,
			'trackbacks_pages'          => 0,
			'trackbacks_posts'          => 0,
			'breadcrumb_home'           => 0,
			'breadcrumb_front_page'     => 0,
			'breadcrumb_posts_page'     => 0,
			'breadcrumb_single'         => 0,
			'breadcrumb_page'           => 0,
			'breadcrumb_archive'        => 0,
			'breadcrumb_404'            => 0,
			'breadcrumb_attachment'     => 0,
			'content_archive'           => 'excerpts',
			'content_archive_thumbnail' => 1,
			'posts_nav'                 => 'numeric',
			'blog_cat'                  => '',
			'blog_cat_exclude'          => '',
			'blog_cat_num'              => 5,
			'header_scripts'            => '',
			'footer_scripts'            => '',
			'image_size'		    => 'full',
			'image_alignment'	    => '',    
        );
        
        $override->set_options( $options );
		
		// Remove Theme Settings Metaboxes
		$metaboxes = array( 'header', 'version' );
		$override->remove_metaboxes( $metaboxes );
    }
}