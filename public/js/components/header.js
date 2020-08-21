$(document).ready(function() {
    var init = 0;
    var ls = $(this).scrollTop();
    
    $(this).on('scroll', function() {
        var $h = $('header');
        var hh = $h.height() + 1; // Inaccuracy compensation
        var sd = $(this).scrollTop();
        var hp = $h.css("top");

        var s = hh / 25;
        var dif = ls - sd;
        
        hp = parseFloat(hp.substring(0, hp.length - 2));
        
        if (dif > 0) {
            if ((hp + s) < init) {
                $h.css({top: (hp + s) + 'px'});
            }
            else if ((hp + s) >= init) {
                $h.css({top: init + 'px'});
            }
        }
        else {
            if ((hp - s) > -hh) {
                $h.css({top: (hp - s) + 'px'});
            }
            else if ((hp - s) <= -hh) {
                $h.css({top: -hh  + 'px'});
            }
        }

        ls = sd;
    });

    $('#navbarToggle').on('click', function () {
        var $nav = $('#collapsibleNavbar');

        if ($nav.hasClass("coll-show")) {
            $nav.removeClass("coll-show");
        }
        else {
            $nav.addClass("coll-show");
            window.setTimeout(function () {$('header').css({top: init + 'px'});}, 50);
        }
    });

    $('#searchToggle').on('click', function () {
        var $nav = $('#collapsibleSearch');

        if ($nav.hasClass("coll-show")) {
            $nav.removeClass("coll-show");
        }
        else {
            $nav.addClass("coll-show");
            window.setTimeout(function () {$('header').css({top: init + 'px'});}, 50);
        }
    });
});

