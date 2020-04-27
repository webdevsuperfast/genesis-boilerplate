<?php
/**
 * Debug Genesis Attributes
 * @author Bryan Willis
 */
add_action( 'wp_footer', 'debug_genesis_attr_filters' );
function debug_genesis_attr_filters()
{      
	global $wp_filter; // current_filter() might be a better way to do this
	$genesis_attr_filters = array ();
	$h1  = '<h1>Current Page Genesis Attribute Filters</h1>';
	$out = '';
	$ul = '<ul>';
	foreach ( $wp_filter as $key => $val )
	{
		if ( FALSE !== strpos( $key, 'genesis_attr' ) )
		{
			$genesis_attr_filters[$key][] = var_export( $val, TRUE );
		}
	}
	foreach ( $genesis_attr_filters as $name => $attr_vals )
	{
		$out .= "<h2 id=$name>$name</h2><pre>" . implode( "\n\n", $attr_vals ) . '</pre>';
		$ul .= "<li><a href='#$name'>$name</a></li>";
	}
	print "$h1$ul</ul>$out";
}