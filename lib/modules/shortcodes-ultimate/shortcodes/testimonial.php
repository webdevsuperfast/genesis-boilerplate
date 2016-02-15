<?php
add_filter( 'su/data/shortcodes', 'gb_register_testimonial_shortcode', 10, 2 );
function gb_register_testimonial_shortcode( $shortcodes ) {
	$shortcodes['testimonial'] = array(
		'name' => __( 'Testimonial', 'gb' ),
		'type' => 'single',
		'group' => 'custom',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Testimonial Class', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'slideshow' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Enable slideshow?', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'numpost' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Number of testimonial to show', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'slides' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Number of slides', 'gb' ),
				'desc' => ''
			),
			'slides_tablet' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Number of slides(Tablets)', 'gb' ),
				'desc' => ''
			),
			'slides_mobile' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Number of slides(mobile)', 'gb' ),
				'desc' => ''
			),
			'duration' => array(
				'type' => 'number',
				'default' => 250,
				'name' => __( 'Duration', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'speed' => array(
				'type' => 'number',
				'default' => 250,
				'name' => __( 'Speed', 'gb' ),
				'desc' => __( '', 'gb' )
			),
			'image' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Display featured image?', 'gb' ),
				'desc' => ''
			),
			'imagex' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Image width', 'gb' ),
				'desc' => ''
			),
			'imagey' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Image Height', 'gb' ),
				'desc' => ''
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
			'autoplay' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Enable autoplay?', 'gb' ),
				'desc' => ''
			),
			'navigation' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Display navigation?', 'gb' ),
				'desc' => ''
			),
			'pagination' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Display pagination?', 'gb' ),
				'desc' => ''
			),
			'autoheight' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Enable autoheight?', 'gb' ),
				'desc' => ''
			),
		),
		'content' => __( '', 'gb' ),
		'desc' => __( 'Text content', 'gb' ),
		'icon' => 'code',
		'function' => 'gb_custom_testimonial_shortcode'
	);

	return $shortcodes;
}

//* Testimonial shortcode
function gb_custom_testimonial_shortcode( $atts, $content = null ) {
	static $instance = 0;
	$instance++;

	$atts = shortcode_atts( array(
		'class' => '',
		'slideshow' => '',
		'numpost' => '',
		'slides' => '',
		'duration' => '',
		'speed' => '',
		'image' => '',
		'imagex' => '',
		'imagey' => '',
		'autoplay' => '',
		'navigation' => '',
		'pagination' => '',
		'autoheight' => '',
		'alignment' => 'alignnone',
		'row' => '',
		'slides_mobile' => '',
		'slides_tablet' => '',
		'instance' => $instance
	), $atts, 'testimonial' );

	$classes = array();
	$classes[] = 'gb_testimonial';
	$classes[] = 'testimonial';
	$classes[] = $atts['slideshow'] ? 'owl-carousel owl-theme' : 'no-slide';
	$classes[] = $atts['class'];

	// $classes = $atts['slideshow'] ? 'owl-carousel owl-theme' : 'no-slide';
	// $classes .= $atts['class'] ? ' ' . $atts['class'] : '';

	if ( $atts['row'] == 'yes' ) {
		// wp_enqueue_script( 'owl2row' );
	}

	$attributes = array(
		'class' => esc_attr( implode( ' ', $classes ) ),
		'id' => 'testimonial-' . $instance
	);

	$attributes['navigation'] = $atts['navigation'] == 'yes' ? 'true' : 'false';
	$attributes['pagination'] = $atts['pagination'] == 'yes' ? 'true' : 'false';
	$attributes['autoplay'] = $atts['autoplay'] == 'yes' ? 'true' : 'false';
	$attributes['duration'] = $atts['duration'] ? (int) $atts['duration'] : '250';
	$attributes['speed'] = $atts['speed'] ? (int) $atts['speed'] : '250';
	$attributes['autoheight'] = $atts['autoheight'] == 'yes' ? 'true' : 'false';
	// $attributes['id'] = 'testimonial-' . $atts['instance'];
	$attributes['slides'] = $atts['slides'] ? (int) $atts['slides'] : '1';
	$attributes['slidesMobile'] = $atts['slides_mobile'] ? (int) $atts['slides_mobile'] : '1';
	$attributes['slidesTablet'] = $atts['slides_tablet'] ? (int) $atts['slides_tablet'] : '1';

	if ( $atts['slideshow'] == 'yes' ) {
		wp_enqueue_script( 'shortcode-js' );
		wp_localize_script( 'shortcode-js', 'testimonial' . $instance, $attributes );
	}

	// var_dump( $row );

	ob_start();
	$options = array(
		'post_type' => 'testimonial',
		'order' => 'DESC',
		'orderby' => 'date'
	);

	$options['posts_per_page'] = $atts['numpost'] ? $atts['numpost'] : -1;
	$query = new WP_Query( $options );

	if ( $query->have_posts() ) :
		echo '<div class="gb_testimonial_container">';
		echo '<div class="'.esc_attr( implode( ' ', $classes ) ).'" data-instance="'.$instance.'" id="testimonial-'.$instance.'">';
		while ( $query->have_posts() ) : $query->the_post();
			echo '<div class="testimonial-content item">';
				do_action( 'gb_testimonial_before_content', $atts );
				echo '<div class="testimonial-body">';
					do_action( 'gb_testimonial_content', $atts );
				echo '</div>';
				do_action( 'gb_testimonial_after_content', $atts );
			echo '</div>';
		endwhile;
		echo '</div>';
		echo '</div>';
	else:
		echo 'No testimonials found.';
	endif;
	wp_reset_query();

	do_action( 'gb_testimonial_after_loop', $atts );

	$testimonial = ob_get_clean();
	return $testimonial;
}

add_action( 'gb_testimonial_content', 'gb_do_testimonial_content' );
function gb_do_testimonial_content() {
	the_content();
}

// add_action( 'gb_testimonial_before_content', 'gb_do_testimonial_before_content' );
add_action( 'gb_testimonial_content', 'gb_do_testimonial_before_content' );
function gb_do_testimonial_before_content() {
	echo '<div class="testimonial-footer">';
	echo '<h4 class="testimonial-author"><span>'.get_the_title() . apply_filters( 'gb_testimonial_author_args', $author ) .'</span></h4>';
	$position = get_post_meta( get_the_ID(), '_position', true );
	$company = get_post_meta( get_the_ID(), '_company', true );
	if ( $position ) {
		echo wpautop( $position, false );
	}
	if ( $company ) {
		echo wpautop( $company, false );
	}
	echo '</div>';
}

add_action( 'gb_testimonial_before_content', 'gb_do_testimonial_image' );
function gb_do_testimonial_image( $atts ) {
	$image = $atts['image'];
	$imagex = $atts['imagex'];
	$imagey = $atts['imagey'];
	$alignment = $atts['alignment'];

	if ( $image == 'yes' ) {
		$thumb = gb_post_image();
		$thumb = gb_thumb( $thumb, $imagex, $imagey );
		echo '<div class="testimonial-heading">';
		echo '<span class="image-wrapper">';
		echo '<img class="'.$alignment.'" src="'. $thumb .'" alt="'.get_the_title().'" />';
		echo '</span>';
		echo '</div>';
	}
}

// add_action( 'gb_testimonial_after_loop', 'gb_do_testimonial_after_loop' );
function gb_do_testimonial_after_loop( $atts ) {
	$class = $atts['class'];
	$slideshow = $atts['slideshow'];
	$slides = $atts['slides'];
	$duration = $atts['duration'];
	$speed = $atts['speed'];
	$autoplay = $atts['autoplay'];
	$autoheight = $atts['autoheight'];
	$navigation = $atts['navigation'];
	$pagination = $atts['pagination'];
	$row = $atts['row'];
	$slidestablet = $atts['slides_tablet'];
	$slidesmobile = $atts['slides_mobile'];

	$attributes = array(
		'class' => $atts['class'],
		// 'slideshow' => $atts['slideshow'],
		// 'id' => 'testimonial-' . $instance
	);

	$attributes['navigation'] = $atts['navigation'] == 'yes' ? 'true' : 'false';
	$attributes['pagination'] = $atts['pagination'] == 'yes' ? 'true' : 'false';
	$attributes['autoplay'] = $atts['autoplay'] == 'yes' ? 'true' : 'false';
	$attributes['duration'] = $atts['duration'] ? (int) $atts['duration'] : '250';
	$attributes['speed'] = $atts['speed'] ? (int) $atts['speed'] : '250';
	$attributes['autoheight'] = $atts['autoheight'] == 'yes' ? 'true' : 'false';
	$attributes['id'] = 'testimonial-' . $atts['instance'];
	$attributes['slides'] = $atts['slides'] ? (int) $atts['slides'] : '1';
	$attributes['slides_mobile'] = $atts['slides_mobile'] ? (int) $atts['slides_mobile'] : '1';
	$attributes['slides_tablet'] = $atts['slides_tablet'] ? (int) $atts['slides_tablet'] : '1';

	if ( $slideshow == 'yes' ) {
		echo 'Hello World';
		wp_enqueue_script( 'shortcode-js' );
		wp_localize_script( 'shortcode-js', 'testimonial' . $instance, $attributes );
	}
}