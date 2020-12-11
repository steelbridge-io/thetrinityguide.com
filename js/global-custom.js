/**
 * Custom js that is needed or used globally
 *
 * */

(function($) {

    $.fn.visible = function(partial) {

        var $t = $(this),
            $w = $(window),
            viewTop = $w.scrollTop(),
            viewBottom = viewTop + $w.height(),
            _top = $t.offset().top,
            _bottom = _top + $t.height(),
            compareTop = partial === true ? _bottom : _top,
            compareBottom = partial === true ? _top : _bottom;

        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
    };


        $(window).scroll(function (event) {
            $('.footer-grow-module').each(function (i, el) {
                var el = $(el);
                if (el.visible(true)) {
                    el.addClass("grow-one");
                }
            });
        });

    })(jQuery);


(function($) {

    // Fade effect for nav MailChimp CTA
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 250) {
            $(".top").fadeOut("slow");
        } else {
            $(".top").fadeIn("slow");
        }

    });
    
})(jQuery);

(function($) {

    $('.home').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');
    $('.home').find('img:not([alt])').attr('alt', 'Slamon and Steelhead Guided Fishing | thetrinityguide.com');
    $('.fishing_report').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');
    $('.featuredpost').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');
    $('.content').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');
    $('.wp-block-image').find('img:not([title])').attr('title', 'The Trinity Guide Content Imgae');
    $('.footer-widgets').find('img:not([title])').attr('title', 'The Trinity Guide Content Imgae');
    $('.has-post-thumbnail').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');
    $('.entry-content').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');
    $('.entry-image-link').find('img:not([title])').attr('title', 'The Triity Guide Content Image');
    $('.widget-wrap').find('img:not([title])').attr('title', 'The Trinity Guide Content Image');

})(jQuery);



