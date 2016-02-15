<?php
add_filter( 'su/data/shortcodes', 'gb_register_image_shortcode', 10, 2 );
function gb_register_image_shortcode( $shortcodes ) {
	$shortcodes['image'] = array(
		'name' => __( 'Image', 'gb' ),
		'type' => 'single',
		'group' => 'custom',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Class', 'gb' ),
				'desc' => __( 'Image class', 'gb' )
			),
			'image' => array(
				'type' => 'upload',
				'default' => '',
				'name' => __( 'Image Source', 'gb' ),
				'desc' => __( 'Off-site images won\'t be resized.', 'gb' )
			),
			'alt' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Alt', 'gb' ),
				'desc' => __( 'Alt text', 'gb' )
			),
			'width' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Width', 'gb' ),
				'desc' => __( 'Image width', 'gb' )
			),
			'height' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Height', 'gb' ),
				'desc' => __( 'Image height', 'gb' )
			),
			'url' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Link', 'gb' ),
				'desc' => __( 'Image link', 'gb' )
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
				'desc' => __( 'Text alignment', 'gb' )
			),
			'margin' => array(
				'type' => 'number',
				'min' => 0,
				'max' => 1000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Margin', 'gb' ),
				'desc' => __( 'Image margin based on chosen alignment', 'gb' )
			),
			'div' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Add enclosing div tags?', 'gb' ),
				'desc' => ''
			),
		),
		'content' => __( '', 'gb' ),
		'desc' => __( 'Text content', 'gb' ),
		'icon' => 'code',
		'function' => 'gb_custom_image_shortcode'
	);
	
	return $shortcodes;
}

//* Image
function gb_custom_image_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'class' => '',
		'image' => '',
		'url' => '',
		'width' => '',
		'height' => '',
		'margin' => '',
		'alignment' => '',
		'alt' => '',
		'div' => ''
	), $atts, 'image' );

	$image = $atts['image'];

	if ( $image ) {
		$image = gb_thumb( $image, $atts['width'] ? $atts['width'] : 0, $atts['height'] ? $atts['height'] : 0 );
	} else {
		$image = $image;
	}

	$classes = array();
	$classes[] = 'gb_image';
	if ( !empty( $atts['class'] ) ) $classes[] = $atts['class'];
	if ( !empty( $atts['alignment'] ) ) $classes[] = $atts['alignment'];

	$styles = array();
	
	// if ( !empty( $atts['margin'] ) ) $styles['margin-bottom'] = $atts['margin'] . 'px';

	if ( $atts['margin'] == 0 ) {
		$styles['margin-bottom'] = '0px';
	} else {
		$styles['margin-bottom'] = $atts['margin'] . 'px';
	}

	$attributes = array();
	$attributes = array(
		'class' => esc_attr( implode( ' ', $classes ) ),
		'style' => implode('; ', array_map( function ( $v, $k ) { return $k . ':' . $v; }, $styles, array_keys( $styles ) ) ),
		'src' => esc_url( $image )
	);

	if ( !empty( $atts['alt'] ) ) $attributes['alt'] = $atts['alt'];

	ob_start(); ?>
	<?php echo $atts['div'] ? '<div class="image-wrapper">' : ''; ?>
	<?php echo $atts['url'] ? '<a href="'.esc_url( $atts['url'] ).'">' : ''; ?>
	<img <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?> />
	<?php echo $atts['url'] ? '</a>' : ''; ?>
	<?php echo $atts['div'] ? '</div>' : ''; ?>
	<?php
	// return apply_filters( 'gb_custom_image_shortcode', $output, $atts );
	$output = ob_get_clean();
	return $output;
}