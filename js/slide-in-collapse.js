/* Collapsible contact section on the front page */
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var contentbook = this.nextElementSibling;
        if (contentbook.style.maxHeight){
            contentbook.style.maxHeight = null;
        } else {
            contentbook.style.maxHeight = contentbook.scrollHeight + "px";
        }
    });
}

var atag = document.querySelector('#atag');

atag.addEventListener('click', on_click);

function on_click() {
    var elem = document.querySelector('#atag .fas');
    elem.classList.toggle("fa-chevron-circle-down");
    elem.classList.toggle("fa-chevron-circle-right");
} 

(function($) {

    /**
     * Copyright 2019, ParsonsHosting
     * Licensed under the MIT license.
     *
     * @author Chris Parsons
     * @desc A small plugin that checks whether elements are within
     *     the user visible viewport of a web browser.
     *     only accounts for vertical position, not horizontal.
     */

    $.fn.visible = function(partial) {

        var $t            = $(this),
            $w            = $(window),
            viewTop       = $w.scrollTop(),
            viewBottom    = viewTop + $w.height(),
            _top          = $t.offset().top,
            _bottom       = _top + $t.height(),
            compareTop    = partial === true ? _bottom : _top,
            compareBottom = partial === true ? _top : _bottom;

        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };

    $(window).scroll(function(event) {
        $('.module-one').each(function(i, el) {
            var el = $(el);
            if(el.visible(true)){
                el.addClass("animate-one");
            }
        });
    });

    $(window).scroll(function(event) {
        $('.module-two').each(function(i, el) {
            var el = $(el);
            if(el.visible(true)){
                el.addClass("animate-two");
            }
        });

        $('.module-three').each(function(i, el) {
            var el = $(el);
            if(el.visible(true)){
                el.addClass("animate-three");
            }
        });
    });

    $(window).scroll(function(event) {
        $('.module-three').each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("animate-three");
            }
        });
    });

    $(window).scroll(function(event) {
        $('.module-four').each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("animate-four");
            }
        });
    });

    $(window).scroll(function(event) {
        $('.module-five').each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("animate-five");
            }
        });
    });

    $(window).scroll(function(event) {
        $('.module-six').each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("animate-six");
            }
        });
    });

   $(window).scroll(function(event) {
        $('.module-seven').each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("animate-seven");
            }
        });
    });

   $(window).scroll(function(event) {
        $('.module-eight').each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("animate-eight");
            }
        });
    });

})(jQuery);

