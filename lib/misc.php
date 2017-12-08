<?php
/**
 * Misc
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://rotsenacob.com
 * @author       Rotsen Mark Acob <rotsenacob.com>
 * @copyright    Copyright (c) 2016, Rotsen Mark Acob
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

//* Setup WooCommerce for Genesis
function gb_woocommerce_setup_genesis() {
    woocommerce_content();
}
