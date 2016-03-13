<?php
/**
 * WooCommerce Template
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

//* Remove standard post content output
remove_action( 'genesis_loop', 'genesis_do_loop');

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add WooCommerce content output
add_action( 'genesis_loop', 'gb_woocommerce_setup_genesis' );

genesis();