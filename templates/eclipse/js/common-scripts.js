var Script = function () {

//    sidebar dropdown menu

    jQuery('#sidebar .parent > a').click(function () {
        var last = jQuery('.sub-menu.open', jQuery('#sidebar'));
        //last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
    });

//    sidebar toggle

    jQuery('.icon-reorder').click(function () {
        if (jQuery('#sidebar > ul').is(":visible") === true) {
            jQuery('#main-content').css({
                'margin-left': '0px'
            });
            jQuery('#sidebar').css({
                'margin-left': '-180px'
            });
            jQuery('#sidebar > ul').hide();
            jQuery("#container").addClass("sidebar-closed");
        } else {
            jQuery('#main-content').css({
                'margin-left': '180px'
            });
            jQuery('#sidebar > ul').show();
            jQuery('#sidebar').css({
                'margin-left': '0'
            });
            jQuery("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    jQuery(".sidebar-scroll").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', background: '#404040', cursorborder: ''});

    jQuery("html").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '8', cursorborderradius: '0px', background: '#404040', cursorborder: '', zindex: '1000'});


// theme switcher

    var scrollHeight = '60px';
    jQuery('#theme-change').click(function () {
        if (jQuery(this).attr("opened") && !jQuery(this).attr("opening") && !jQuery(this).attr("closing")) {
            jQuery(this).removeAttr("opened");
            jQuery(this).attr("closing", "1");

            jQuery("#theme-change").css("overflow", "hidden").animate({
                width: '20px',
                height: '22px',
                'padding-top': '3px'
            }, {
                complete: function () {
                    jQuery(this).removeAttr("closing");
                    jQuery("#theme-change .settings").hide();
                }
            });
        } else if (!jQuery(this).attr("closing") && !jQuery(this).attr("opening")) {
            jQuery(this).attr("opening", "1");
            jQuery("#theme-change").css("overflow", "visible").animate({
                width: '226px',
                height: scrollHeight,
                'padding-top': '3px'
            }, {
                complete: function () {
                    jQuery(this).removeAttr("opening");
                    jQuery(this).attr("opened", 1);
                }
            });
            jQuery("#theme-change .settings").show();
        }
    });

    jQuery('#theme-change .colors span').click(function () {
        var color = jQuery(this).attr("data-style");
        setColor(color);
    });

    jQuery('#theme-change .layout input').change(function () {
        setLayout();
    });

    var setColor = function (color) {
        jQuery('#style_color').attr("href", "css/style-" + color + ".css");
    }

// widget tools

    jQuery('.widget .tools .icon-chevron-down, .widget .tools .icon-chevron-up').click(function () {
        var el = jQuery(this).parents(".widget").children(".widget-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.widget .tools .icon-remove').click(function () {
        jQuery(this).parents(".widget").parent().remove();
    });
    
//    tool tips

    jQuery('.element').tooltip();

    jQuery('.tooltips').tooltip();

//    popovers

    jQuery('.popovers').popover();

// scroller

    jQuery('.scroller').slimscroll({
        height: 'auto'
    });


}();