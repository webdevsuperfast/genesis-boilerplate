(function($){
	"use strict";

	$(document).ready(function(){

		//* Button Shortcode
		if($('.gb_button').length > 0) {
			$('.gb_button').each(function(index){
				var instance = $(this).data('instance');
				btnInstance(instance);
			});
		}

		function btnInstance(instance) {
			var obj = window['btn'+instance];

			var borderWidth = obj.borderWidth,
				padding = obj.padding,
				marginBottom = obj.marginBottom,
				borderRadius = obj.borderRadius,
				width = obj.width,
				hover = obj.hover,
				colorHover = obj.colorHover,
				borderColor = obj.borderColor,
				color = obj.color,
				backgroundColor = obj.backgroundColor,
				fontSize = obj.fontSize,
				tabletSize = obj.tabletSize;

			vein.inject(['#btn-'+instance+''], {
				'font-size' : ''+fontSize+'',
				'border-width' : ''+borderWidth+'',
				'padding' : ''+padding+'',
				'margin-bottom' : ''+marginBottom+'',
				'border-radius' : ''+borderRadius+'',
				'width' : ''+width+'',
				'color' : ''+color+'',
				'border-color' : ''+borderColor+'',
				'background-color' : ''+backgroundColor+''
			});

			// On Hover
			vein.inject(['#btn-'+instance+':hover'], {
				'background-color' : ''+hover+'',
				'border-color' : ''+hover+'',
				'color' : ''+colorHover+''
			});

			// Ghost Button
			vein.inject(['#btn-'+instance+'.btn.btn-ghost'], {
				'background-color' : 'transparent',
				'color' : ''+backgroundColor+''
			});

			vein.inject(['#btn-'+instance+'.btn.btn-ghost:hover'], {
				'border-color' : ''+hover+'',
				'background-color' : ''+hover+'',
				'color' : ''+colorHover+''
			});

			vein.inject([{
			    '@media (max-width: 991px)': ['#btn-'+instance+'']
			}], {
			    'font-size': ''+tabletSize+' !important'
			});

			vein.inject([{
			    '@media (max-width: 767px)': ['#btn-'+instance+'']
			}], {
			    'width': '100% !important'
			});
		}

		//* Content Box Shortcode
		if($('.gb_box').length > 0) {
			$('.gb_box').each(function(index){
				var instance = $(this).data('instance');
				boxInstance(instance);
			});
		}

		function boxInstance(instance) {
			var box = window['box' + instance];
			// console.log(box);

			var fontSize = box.fontSize,
				padding= box.padding,
				lineHeight = box.height,
				backgroundColor = box.backgroundColor,
				letterSpacing = box.letterSpacing,
				width = box.width,
				color = box.color,
				marginBottom = box.marginBottom,
				textAlign = box.textAlign,
				tabletWidth = box.tabletWidth;

			vein.inject(['#box-'+instance+''], {
				'font-size' : ''+fontSize+'',
				'padding' : ''+padding+' !important',
				'line-height' : ''+lineHeight+'',
				'background-color' : ''+backgroundColor+'',
				'letter-spacing' : ''+letterSpacing+'',
				'width' : ''+width+'',
				'color' : ''+color+'',
				'margin-bottom' : ''+marginBottom+'',
				'text-align' : ''+textAlign+''
			});

			vein.inject([{
			    '@media only screen  and (max-width: 991px)': ['#box-'+instance+'']
			}], {
			    'width': ''+tabletWidth+' !important'
			});

			vein.inject([{
			    '@media  only screen and (max-width: 767px)': ['#box-'+instance+'']
			}], {
			    'width': '100% !important',
			    'margin-left': '0'
			});
		}

		//* Text Shortcode
		if($('.gb_text').length > 0) {
			$('.gb_text').each(function(index){
				var instance = $(this).data('instance');
				textInstance(instance);
			});
		}

		function textInstance(instance) {
			var text = window['text' + instance];

			var fontSize = text.fontSize,
				lineHeight = text.lineHeight,
				marginBottom = text.marginBottom,
				letterSpacing = text.letterSpacing,
				color = text.color,
				textAlign = text.textAlign,
				tabletSize = text.tabletSize;

			vein.inject(['#gb_text-'+instance+''], {
				'font-size' : ''+fontSize+'',
				'line-height' : ''+lineHeight+'',
				'letter-spacing' : ''+letterSpacing+'',
				'color' : ''+color+'',
				'margin-bottom' : ''+marginBottom+'',
				'text-align' : ''+textAlign+''
			});

			vein.inject([{
			    '@media only screen  and (max-width: 991px)': ['#text-'+instance+'']
			}], {
			    'font-size': ''+tabletSize+' !important'
			});
		}

		// Testimonial
		function testimonialInstance(instance) {
			var obj = window['testimonial'+instance];

			var sid = obj.id,
				item = obj.slides,
				navigation = (obj.navigation === "true"),
				pagination = (obj.pagination === "true"),
				autoplay = (obj.autoplay === "true"),
				duration = obj.duration,
				speed = obj.speed,
				autoheight = (obj.autoheight === "true"),
				slidesTablet = obj.slidesTablet,
				slidesMobile = obj.slidesMobile;

			var owl = $('#'+sid);

			owl.owlCarousel({
				items: item,
				margin: 30,
				nav: navigation,
				dots: pagination,
				autoplay: autoplay,
				smartSpeed: duration,
				fluidSpeed: speed,
				loop: true,
				autoHeight: autoheight,
				responsive: {
				    0: {
				        items: slidesMobile,
				        nav: navigation
				    },
				    768: {
				        items: slidesTablet,
				        nav: navigation
				    },
				    992: {
				        items: item,
				        nav: navigation
				    }
				}
			});
		}

		if($('.gb_testimonial').length > 0) {
			$('.gb_testimonial').each(function(index){
				var instance = $(this).data('instance');
				testimonialInstance(instance);
			});
		}
	});

	// Window load event with minimum delay
	// @link https://css-tricks.com/snippets/jquery/window-load-event-with-minimum-delay/
	(function fn() {
		fn.now = +new Date;
		$(window).load(function() {
			if (+new Date - fn.now < 500) {
				setTimeout(fn, 500);
			}

		});
	})();
})(jQuery);
