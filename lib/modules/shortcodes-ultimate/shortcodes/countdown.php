<?php
add_filter( 'su/data/shortcodes', 'gb_register_countdown_shortcode', 10, 2 );
function gb_register_countdown_shortcode( $shortcodes ) {
	$shortcodes['countdown'] = array(
		'name' => __( 'Countdown', 'gb' ),
		'type' => 'single',
		'group' => 'custom',
		'atts' => array(
			'id' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Countdown ID', 'gb' ),
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
			'hour' => array(
				'type' => 'number',
				'min' => 0,
				'max' => 23,
				'step' => 1,
				'default' => 1,
				'name' => __( 'Hour', 'gb' ),
				'desc' => ''
			),
			'minute' => array(
				'type' => 'number',
				'min' => 0,
				'max' => 59,
				'step' => 1,
				'default' => 0,
				'name' => __( 'Minute', 'gb' ),
				'desc' => ''
			),
		),
		'content' => __( '', 'gb' ),
		'desc' => __( 'Text content', 'gb' ),
		'icon' => 'code',
		'function' => 'gb_custom_countdown_shortcode'
	);

	return $shortcodes;
}

//* Countdown
function gb_custom_countdown_shortcode( $atts, $content = null ) {
	static $instance = 0;
	$instance++;

	$atts = shortcode_atts( array(
		'id' => '',
		'year' => '',
		'month' => '',
		'day' => '',
		'hour' => '',
		'minute' => ''
	), $atts, 'countdown' );

	$id = $atts['id'] ? $atts['id'] : 'clock';

	$attributes = array(
		'id' => $id,
		'class' => 'gb_countdown',
		'data-instance' => 'countdown-' . $instance
	);

	ob_start();

	do_action( 'gb_countdown_before', $atts );
	echo '<div id="'.esc_attr( $id ).'" class="countdown" ></div>';
	do_action( 'gb_countdown_after', $atts );

	$countdown = ob_get_clean();

	return $countdown;
}

//* Countdown script
add_action( 'gb_countdown_after', 'gb_do_countdown_after' );
function gb_do_countdown_after( $atts ) {
	$id = $atts['id'] ? $atts['id'] : 'clock';
	$year = $atts['year'];
	$month = $atts['month'];
	$month = str_pad($month, 2, '0', STR_PAD_LEFT);
	$day = $atts['day'];
	$day = str_pad($day, 2, '0', STR_PAD_LEFT);
	$hour = $atts['hour'];
	$hour = str_pad($hour, 2, '0', STR_PAD_LEFT);
	$minute = $atts['minute'];
	$minute = str_pad($minute, 2, '0', STR_PAD_LEFT); ?>

	<script type="text/javascript">
		(function($){
			$(window).load(function(){
				$('#<?php echo $id; ?>').countdown('<?php echo $year; ?>/<?php echo $month; ?>/<?php echo $day; ?> <?php echo $hour; ?>:<?php echo $minute; ?>:00', function(event){
					var $this = $(this).html(event.strftime(''
					// + '<span>%w</span> weeks '
					+ '<span><span>%D</span> day%!D</span> '
					+ '<span><span>%H</span> hour%!H</span> '
					+ '<span><span>%M</span> minute%!M</span> '
					+ '<span><span>%S</span> second%!S</span>'));
				});
			});
		})(jQuery);
	</script>
<?php }