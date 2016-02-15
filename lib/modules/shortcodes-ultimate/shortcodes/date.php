<?php
add_filter( 'su/data/shortcodes', 'gb_register_date_shortcode', 10, 2 );
function gb_register_date_shortcode( $shortcodes ) {
	$shortcodes['date'] = array(
		'name' => __( 'Date', 'gb' ),
		'type' => 'single',
		'group' => 'custom',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Date class', 'gb' ),
				'desc' => ''
			),
			'year' => array(
				'type' => 'number',
				'min' => 2015,
				'max' => 2100,
				'step' => 1,
				'default' => 2015,
				'name' => __( 'Year', 'gb' ),
				'desc' => ''
			),
			'month' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 1,
				'name' => __( 'Month', 'gb' ),
				'desc' => ''
			),
			'day' => array(
				'type' => 'number',
				'min' => 1,
				'max' => 31,
				'step' => 1,
				'default' => 1,
				'name' => __( 'Day', 'gb' ),
				'desc' => ''
			),
		),
		'content' => __( '', 'gb' ),
		'desc' => __( 'Text content', 'gb' ),
		'icon' => 'code',
		'function' => 'gb_custom_date_shortcode'
	);

	return $shortcodes;
}

//* Date shortcode
function gb_custom_date_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'class' => null,
		'year' => null,
		'month' => null,
		'day' => null
	), $atts, 'date' );

	$classes = 'date-panel';
	$classes .= $atts['class'] ? ' ' . $atts['class'] : '';

	//* Month
	$monthNum = $atts['month'];
	$monthName = date( 'F', mktime( 0, 0, 0, $monthNum ) );

	//* Date
	$dateNum = $atts['day'];
	$dateName = date( 'd', mktime( 0, 0, 0, 0, $dateNum ) );

	//* Year
	$yearNum = $atts['year'];
	$yearName = date( 'y', mktime( 0, 0, 0, $monthNum, $dateNum, $yearNum ) );

	$output = '<span class="'.esc_attr( $classes ).'">';
	$output .= $atts['month'] ? '<span class="date-heading">'.$monthName.'</span>' : '';
	$output .= $atts['day'] ? '<span class="date-body">'.$dateName.'</span>' : '';
	$output .= $atts['year'] ? '<span class="date-footer">'.$yearName.'</span>' : '';
	$output .= '</span>';

	return $output;
}