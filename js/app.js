// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function() {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

(function($) {
    "use strict";
    $(document).ready(function() {
        // SlickNav.js
        $('.nav-primary .genesis-nav-menu').slicknav({
            prependTo: '.nav-primary .wrap',
            allowParentLinks: true
        });

        // Fixes issue with jeet.gs
        if ($('.gallery').length > 0) {
            $('.gallery').find('br').detach();
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