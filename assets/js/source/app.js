(function($){
	$(document).ready(function(){
		$('.gallery').find('br').detach();

		// Mobile Menu
		if ( $.isEmptyObject(slick) ) {
			return false;
		} else {
			var menu = slick.menu,
				label = slick.label,
				prepend = slick.prepend,
				close = slick.close,
				open = slick.open;

			if ($(menu).length > 0 && $('.landing-page').length == 0) {
				$(menu).slicknav({
					label: label,
					prependTo: prepend,
					closedSymbol: close,
					openedSymbol: open
				});
			}
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
			// Do stuffs right here
		});
	})();
})(jQuery);
