WebFontConfig = {
    google: { families: [ 'Work+Sans:300,400' ] }
};
var $source = webfont.src;
(function() {
    var wf = document.createElement('script');
    wf.src = $source;
    wf.type = 'text/javascript';
    wf.async = 'true';

    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();

(function($){
	$(document).ready(function(){
        $('.gallery').find('br').detach();
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
