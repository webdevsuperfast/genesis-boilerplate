<?php
/**
 * Customizer
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         http://rotsenacob.com
 * @author       Rotsen Mark Acob <rotsenacob.com>
 * @copyright    Copyright (c) 2016, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->add_setting( 'genesis-boilerplate', array(
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod'
    ) );

    $wp_customize->add_section( 'mobile-navigation', array(
        'title' => __( 'Mobile Navigation', 'genesis-boilerplate' ),
        'description' => __( '' ),
    ) );
    
    // Menu Location
    $wp_customize->add_setting( 'menu', array(
        'default' => ''
    ) );

    $wp_customize->add_control( 'menu', array(
        'type' => 'select',
        'priority' => 10,
        'label' => __( 'Mobile Menu', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation',
        'choices' => gb_get_menus()
    ) );

    // Menu Label
    $wp_customize->add_setting( 'menu-label', array(
        'default' => __( 'MENU', 'genesis-boilerplate' )
    ) );

    $wp_customize->add_control( 'menu-label', array(
        'type' => 'text',
        'priority' => 20,
        'label' => __( 'Button Label', 'genesis-boilerplate' ),
        'description' => __( 'Label for menu button. Use an empty string for no label.', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation'
    ) );

    // Prepend Menu
    $wp_customize->add_setting( 'menu-prepend', array(
        'default' => 'body'
    ) );

    $wp_customize->add_control( 'menu-prepend', array(
        'type' => 'text',
        'priority' => 30,
        'label' => __( 'Prepend Menu To', 'genesis-boilerplate' ),
        'description' => __( 'Element, jQuery object, or jQuery selector string for the element to prepend the mobile menu to.', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation'
    ) );

    // Closed Symbol
    $wp_customize->add_setting( 'menu-close', array(
        'default' => '&#9658;'
    ) );

    $wp_customize->add_control( 'menu-close', array(
        'type' => 'text',
        'priority' => 40,
        'label' => __( 'Closed Symbol', 'genesis-boilerplate' ),
        'description' => __( 'Character after collapsed parents.', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation'
    ) );

    // Open Symbol
    $wp_customize->add_setting( 'menu-open', array(
        'default' => '&#9660;'
    ) );

    $wp_customize->add_control( 'menu-open', array(
        'type' => 'text',
        'priority' => 50,
        'label' => __( 'Opened Symbol', 'genesis-boilerplate' ),
        'description' => __( 'Character after expanded parents.', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation'
    ) );

    // Brand
    $wp_customize->add_setting( 'menu-brand', array(
        'default' => true
    ) );

    $wp_customize->add_control( 'menu-brand', array(
        'type' => 'checkbox',
        'priority' => 60,
        'label' => __( 'Brand', 'genesis-boilerplate' ),
        'description' => __( 'Add branding to menu bar.', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation'
    ) );

    $wp_customize->add_setting( 'menu-breakpoint', array(
        'default' => 600
    ) );

    $wp_customize->add_control( 'menu-breakpoint', array(
        'type' => 'number',
        'priority' => 70,
        'label' => __( 'Media Breakpoint', 'genesis-boilerplate' ),
        'description' => __( 'Show navigation on media breakpoint', 'genesis-boilerplate' ),
        'section' => 'mobile-navigation'
    ) );
} );