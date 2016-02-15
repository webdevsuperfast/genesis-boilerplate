<?php
add_filter( 'su/data/shortcodes', 'gb_register_text_shortcode', 10, 2 );
function gb_register_text_shortcode( $shortcodes ) {
	$shortcodes['text'] = array(
		'name' => __( 'Text', 'gb' ),
		'type' => 'wrap',
		'group' => 'custom',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Class', 'gb' ),
				'desc' => __( 'Text class', 'gb' )
			),
			'tag' => array(
				'type' => 'text',
				'default' => 'span',
				'name' => __( 'Tag', 'gb' ),
				'desc' => __( 'HTML tag', 'gb' )
			),
			'icon' => array(
				'type' => 'icon',
				'default' => '',
				'name' => __( 'Icon', 'gb' ),
				'desc' => __( 'You can upload custom icon for this box', 'shortcodes-ultimate' )
			),
			'icon_color' => array(
				'type' => 'color',
				'default' => '#333333',
				'name' => __( 'Icon color', 'gb' ),
				'desc' => __( 'This color will be applied to the selected icon. Does not works with uploaded icons', 'shortcodes-ultimate' )
			),
			'icon_size' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => '',
				'name' => __( 'Icon Size', 'gb' ),
				'desc' => __( '', 'gb' )
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
			'spacing' => array(
				'type' => 'slider',
				'min' => 0,
				'max' => 1,
				'step' => 0.05,
				'default' => '',
				'name' => __( 'Letter Spacing', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'height' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => '',
				'name' => __( 'Line Height', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'alignment' => array(
				'type' => 'select',
				'values' => array(
					'center' => 'Center',
					'left' => 'Left',
					'right' => 'Right'
				),
				'default' => 'left',
				'name' => __( 'Alignment', 'gb' ),
				'desc' => __( 'Text alignment', 'gb' )
			),
			'color' => array(
				'type' => 'color',
				'values' => array( ),
				'default' => '',
				'name' => __( 'Color', 'gb' ),
				'desc' => __( 'Text color', 'gb' )
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
		'content' => __( 'Text', 'gb' ),
		'desc' => __( 'Text content', 'gb' ),
		'icon' => 'code',
		'function' => 'gb_custom_text_shortcode'
	);

	return $shortcodes;
}

//* Text
function gb_custom_text_shortcode( $atts, $content = null ) {
	static $instance = 0;
	$instance++;

	$atts = shortcode_atts( array(
		'class' => '',
		'size' => 'inherit',
		'tag' => 'span',
		'alignment' => '',
		'color' => 'inherit',
		'margin' => '',
		'height' => '',
		'spacing' => '',
		// 'instance' => $instance,
		'icon' => '',
		'icon_color' => '#333',
		'icon_size' => ''
	), $atts, 'text' );

	if ( $atts['height'] != 0 && $atts['size'] != 0 ) {
		$height = ($atts['height']/$atts['size']);
	}

	$selector = 'gb_text-' . $instance;

	$classes = array();
	$classes[] = 'gb_text';
	$classes[] = 'text';
	if ( !empty( $atts['class'] ) ) $classes[] = $atts['class'];

	// var_dump( $atts['icon'] );

	$styles = array();
	if ( !empty( $atts['size'] ) ) $styles['fontSize'] = $atts['size'] . 'px';
	// if ( !empty( $atts['padding'] ) ) $styles['padding'] = $atts['padding'];
	// if ( !empty( $atts['height'] ) ) $styles['line-height'] = $atts['height'] . 'px';
	if ( !empty( $atts['height'] ) ) $styles['lineHeight'] = $height;
	// if ( !empty( $atts['margin'] ) ) $styles['margin-bottom'] = $atts['margin'] . 'px';
	if ( !empty( $atts['spacing'] ) ) $styles['letterSpacing'] = $atts['spacing'] . 'em';
	if ( !empty( $atts['color'] ) ) $styles['color'] = $atts['color'];
	if ( !empty( $atts['alignment'] ) ) $styles['textAlign'] = $atts['alignment'];
	
	if ( $atts['margin'] == 0 ) {
		$styles['marginBottom'] = '0px';
	} else {
		$styles['marginBottom'] = $atts['margin'] . 'px';
	}

	if ( $atts['size'] >= 24 ) {
		$styles['tabletSize'] = ($atts['size'] - $atts['size']/4) . 'px';
	}

	$icon_styles = array();

	if ( !empty( $atts['icon'] ) ) {
		// $icon_styles['padding-left'] = $atts['icon_size'] + '10' . 'px';
		// $icon_styles['position'] = 'relative';
	}

	wp_enqueue_script( 'shortcode-js' );
	wp_localize_script( 'shortcode-js', 'text' . $instance, $styles );

	$attributes = array(
		'class' => esc_attr( implode( ' ', $classes ) ),
		'id' => $selector,
		'style' => implode('; ', array_map( function ( $v, $k ) { return $k . ':' . $v; }, $icon_styles, array_keys( $icon_styles ) ) ),
		// 'style' => 
		'data-instance' => $instance
	);

	ob_start(); ?>

	<?php do_action( 'gb_text_before', $atts ); ?>
	<?php
	// Built-in icon
	if ( $atts['icon'] ) {
		if ( strpos( $atts['icon'], 'icon:' ) !== false ) {
			$atts['icon'] = '<i class="icon-font fa fa-' . trim( str_replace( 'icon:', '', $atts['icon'] ) ) . '" style="width:' . $atts['icon_size'] . 'px;height:' . $atts['icon_size'] . 'px;font-size:' . $atts['icon_size'] . 'px;color:' . $atts['icon_color'] . ';"></i>';
			su_query_asset( 'css', 'font-awesome' );
		}
		// Uploaded icon
		else {
			$atts['icon'] = '<img class="icon-img" src="' . $atts['icon'] . '" width="' . $atts['icon_size'] . '" height="auto" />';
		}
	} 
	?>
	<<?php echo $atts['tag']; ?> <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
	<?php echo $atts['icon']; ?>
	<?php echo su_do_shortcode( $content, 's' ); ?>
	</<?php echo $atts['tag']; ?>>
	<?php do_action( 'gb_text_after', $atts ); ?>

	<?php $output = ob_get_clean();
	return $output;
}