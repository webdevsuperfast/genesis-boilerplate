<?php
add_filter( 'su/data/shortcodes', 'gb_register_content_shortcode', 10, 2 );
function gb_register_content_shortcode( $shortcodes ) {
	$shortcodes['content_box'] = array(
		'name' => __( 'Content Box', 'gb' ),
		'type' => 'wrap',
		'group' => 'custom',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Class', 'gb' ),
				'desc' => __( 'Text class', 'gb' )
			),
			'padding' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Padding', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'width' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 2000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Width', 'gb' ),
				'desc' => __( 'Content width', 'gb' )
			),
			'tablet_width' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 2000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Tablet Width', 'gb' ),
				'desc' => __( 'Content width', 'gb' )
			),
			'alignment' => array(
				'type' => 'select',
				'values' => array(
					'alignnone' => 'None',
					'aligncenter' => 'Center',
					'alignleft' => 'Left',
					'alignright' => 'Right'
				),
				'default' => 'alignnone',
				'name' => __( 'Alignment', 'gb' ),
				'desc' => __( 'Image alignment', 'gb' )
			),
			'size' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Font Size', 'gb' ),
				'desc' => __( 'Font size', 'gb' )
			),
			'height' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Line Height', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'spacing' => array(
				'type' => 'slider',
				'min' => 0,
				'max' => 1,
				'step' => 0.05,
				'default' => '',
				'name' => __( 'Letter Spacing', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'background' => array(
				'type' => 'color',
				'values' => array( ),
				'default' => '',
				'name' => __( 'Background color', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'color' => array(
				'type' => 'color',
				'values' => array( ),
				'default' => '',
				'name' => __( 'Font color', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'margin' => array(
				'type' => 'number',
				'min' => 0,
				'max' => 1000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Margin', 'gb' ),
				'desc' => __( 'Bottom margin', 'gb' )
			)
		),
		'content' => __( 'Box content', 'gb' ),
		'desc' => __( '', 'gb' ),
		'icon' => 'code',
		'function' => 'gb_custom_box_shortcode'
	);

	return $shortcodes;
}

//* Box
function gb_custom_box_shortcode( $atts, $content = null ) {
	static $instance = 0;
	$instance++;
	$atts = shortcode_atts( array(
		'class' => '',
		'size' => '',
		'background' => '',
		'padding' => '',
		'margin' => '',
		'height' => '',
		'spacing' => '',
		'alignment' => '',
		'width' => null,
		'tablet_width' => null,
		'color' => '',
		'instance' => $instance
	), $atts, 'content_box' );

	// if ( $atts['height'] != 0 || $atts['size'] != 0 ) {
		// $height = ($atts['height']/$atts['size']);
	// }

	$selector = 'box-' . $instance;

	$classes = array();
	
	$classes[] = 'gb_box';
	$classes[] = 'box';

	if ( !empty( $atts['class'] ) ) $classes[] = $atts['class'];
	if ( !empty( $atts['alignment'] ) ) $classes[] = $atts['alignment'];

	$styles = array();
	if ( !empty( $atts['size'] ) ) $styles['fontSize'] = $atts['size'] . 'px';
	if ( !empty( $atts['padding'] ) ) $styles['padding'] = $atts['padding'] . 'px';
	if ( !empty( $atts['height'] ) ) $styles['lineHeight'] = $atts['height'] . 'px';
	if ( !empty( $atts['background'] ) ) $styles['backgroundColor'] = $atts['background'];
	if ( !empty( $atts['spacing'] ) ) $styles['letterSpacing'] = $atts['spacing'] . 'em';
	if ( !empty( $atts['width'] ) ) $styles['width'] = $atts['width'] . 'px';
	if ( !empty( $atts['color'] ) ) $styles['color'] = $atts['color'];
	// if ( !empty( $atts['margin'] ) ) $styles['margin-bottom'] = $atts['margin'] . 'px';
	if ( !empty( $atts['alignment'] ) ) $styles['textAlign'] = $atts['alignment'];
	$styles['tabletWidth'] = $atts['tablet_width'] ? $atts['tablet_width'] . 'px' : '100%';

	if ( $atts['margin'] == 0 ) {
		$styles['marginBottom'] = '0px';
	} else {
		$styles['marginBottom'] = $atts['margin'] . 'px';
	}

	wp_enqueue_script( 'shortcode-js' );
	wp_localize_script( 'shortcode-js', 'box' . $instance, $styles );

	$attributes = array(
		'id' => $selector,
		'class' => esc_attr( implode( ' ', $classes ) ),
		// 'style' => implode('; ', array_map( function ( $v, $k ) { return $k . ':' . $v; }, $styles, array_keys( $styles ) ) ),
		'data-instance' => $instance
	);

	ob_start(); ?>

	<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
	<?php echo su_do_shortcode( $content, 's' ); ?>
	</div>
	<?php
	$output = ob_get_clean();
	return $output;
}