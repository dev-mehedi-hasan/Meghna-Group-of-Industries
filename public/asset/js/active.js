(function($) {
    $('.preloader').delay(500).fadeOut('slow');
    setTimeout(function() {
        $('body').removeClass('no-scroll');
    }, 500);
})(jQuery);