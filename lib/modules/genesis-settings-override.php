<?php
/**
 * Override theme settings and remove theme settings metaboxes with this helper class
 * 
 * Requires WordPress v2.6.0 and PHP v5.3.0
 * 
 * @version 2.0.0
 * @author Joshua David Nelson, josh@joshuadnelson.com
 * @license GPLv2.0+
 * 
 * Copyirght 2015, Joshua David Nelson
 */

class JDN_Override_Genesis_Settings {
	
	// The array of options to set
	private $options = array();
	
	// The array of metaboxes to remove
	private $metaboxes = array();
	
	// The current option to be set
	private $current_option = '';
	
	// The current metabox to be removed
	private $current_metabox = '';
	
	// Set Genesis Theme Options with array
	public function set_options( $these_options ) {
		
		if( !is_array( $these_options ) )
			return;
		
		$this->options = $these_options;
		
		foreach( $this->options as $option => $value ) {
			$this->current_option = $option;
			add_filter( "genesis_pre_get_option_{$option}", array( $this, $option ), 10, 1 );
			
		}
	}
	
	//Override Theme Option with new value using the magic call method
	public function __call( $func, $params ) {
	    if( in_array( $func, $this->options ) ) {
	        return $this->get_value( $func );
	    } else {
	    	return $params;
	    }
	}
	
	// Get the option's new value 
	private function get_value( $option ) {
		if( array_key_exists( $option, $this->options ) ) {
			return $this->options[ $option ];
		} else {
			return null;
		}
	}
	
	// Remove a group of metaboxes 
	public function remove_metaboxes( $metaboxes ) {
		if( !is_array( $metaboxes ) )
			return;
		
		// Set metaboxes
		$this->metaboxes = $metaboxes;
		
		// Add action
		add_action( 'genesis_theme_settings_metaboxes', array( $this, 'remove_genesis_metaboxes' ) );
	}
	
	// Remove genesis theme settings metaboxes
	public function remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
		foreach( $this->metaboxes as $metabox ) {
			remove_meta_box( "genesis-theme-settings-{$metabox}",     $_genesis_theme_settings_pagehook, 'main' );
		}
	}
}