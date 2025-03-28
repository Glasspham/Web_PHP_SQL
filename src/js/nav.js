/* dCodes Framework: (c) TemplateAccess */
(function ($) {
    $.fn.dcMegaMenu = function (options) {
        var defaults = { classParent: "dc-mega", classContainer: "sub-container", classSubParent: "mega-hdr", classSubLink: "mega-hdr", classWidget: "dc-extra", rowItems: 3, speed: "fast", effect: "fade", event: "hover", fullWidth: false, onLoad: function () {}, beforeOpen: function () {}, beforeClose: function () {} };
        var options = $.extend(defaults, options);
        var $dcMegaMenuObj = this;
        return $dcMegaMenuObj.each(function (options) {
            var clSubParent = defaults.classSubParent;
            var clSubLink = defaults.classSubLink;
            var clParent = defaults.classParent;
            var clContainer = defaults.classContainer;
            var clWidget = defaults.classWidget;
            megaSetup();
            function megaOver() {
                var subNav = $(".sub", this);
                $(this).addClass("mega-hover");
                if (defaults.effect == "fade") {
                    $(subNav).fadeIn(defaults.speed);
                }
                if (defaults.effect == "slide") {
                    $(subNav).show(defaults.speed);
                }
                defaults.beforeOpen.call(this);
            }
            function megaAction(obj) {
                var subNav = $(".sub", obj);
                $(obj).addClass("mega-hover");
                if (defaults.effect == "fade") {
                    $(subNav).fadeIn(defaults.speed);
                }
                if (defaults.effect == "slide") {
                    $(subNav).show(defaults.speed);
                }
                defaults.beforeOpen.call(this);
            }
            function megaOut() {
                var subNav = $(".sub", this);
                $(this).removeClass("mega-hover");
                $(subNav).hide();
                defaults.beforeClose.call(this);
            }
            function megaActionClose(obj) {
                var subNav = $(".sub", obj);
                $(obj).removeClass("mega-hover");
                $(subNav).hide();
                defaults.beforeClose.call(this);
            }
            function megaReset() {
                $("li", $dcMegaMenuObj).removeClass("mega-hover");
                $(".sub", $dcMegaMenuObj).hide();
            }
            function megaSetup() {
                $arrow = '<span class="dc-mega-icon"></span>';
                var clParentLi = clParent + "-li";
                var menuWidth = $dcMegaMenuObj.outerWidth();
                $("> li", $dcMegaMenuObj).each(function () {
                    var $mainSub = $("> ul", this);
                    var $primaryLink = $("> a", this);
                    if ($mainSub.length) {
                        $primaryLink.addClass(clParent).append($arrow);
                        $mainSub.addClass("sub").wrap('<div class="' + clContainer + '" />');
                        var pos = $(this).position();
                        pl = pos.left;
                        if ($("ul", $mainSub).length) {
                            $(this).addClass(clParentLi);
                            $("." + clContainer, this).addClass("mega");
                            $("> li", $mainSub).each(function () {
                                if (!$(this).hasClass(clWidget)) {
                                    $(this).addClass("mega-unit");
                                    if ($("> ul", this).length) {
                                        $(this).addClass(clSubParent);
                                        $("> a", this).addClass(clSubParent + "-a");
                                    } else {
                                        $(this).addClass(clSubLink);
                                        $("> a", this).addClass(clSubLink + "-a");
                                    }
                                }
                            });
                            var hdrs = $(".mega-unit", this);
                            rowSize = parseInt(defaults.rowItems);
                            for (var i = 0; i < hdrs.length; i += rowSize) {
                                hdrs.slice(i, i + rowSize).wrapAll('<div class="row" />');
                            }
                            $mainSub.show();
                            var pw = $(this).width();
                            var pr = pl + pw;
                            var mr = menuWidth - pr;
                            var subw = $mainSub.outerWidth();
                            var totw = $mainSub.parent("." + clContainer).outerWidth();
                            var cpad = totw - subw;
                            if (defaults.fullWidth == true) {
                                var fw = menuWidth - cpad;
                                $mainSub.parent("." + clContainer).css({ width: fw + "px" });
                                $dcMegaMenuObj.addClass("full-width");
                            }
                            var iw = $(".mega-unit", $mainSub).outerWidth(true);
                            var rowItems = $(".row:eq(0) .mega-unit", $mainSub).length;
                            var inneriw = iw * rowItems;
                            var totiw = inneriw + cpad;
                            $(".row", this).each(function () {
                                $(".mega-unit:last", this).addClass("last");
                                var maxValue = undefined;
                                $(".mega-unit > a", this).each(function () {
                                    var val = parseInt($(this).height());
                                    if (maxValue === undefined || maxValue < val) {
                                        maxValue = val;
                                    }
                                });
                                $(".mega-unit > a", this).css("height", maxValue + "px");
                                $(this).css("width", inneriw + "px");
                            });
                            if (defaults.fullWidth == true) {
                                params = { left: 0 };
                            } else {
                                var ml = mr < ml ? ml + ml - mr : (totiw - pw) / 2;
                                var subLeft = pl - ml;
                                var params = { left: pl + "px", marginLeft: -ml + "px" };
                                if (subLeft < 0) {
                                    params = { left: 0 };
                                } else if (mr < ml) {
                                    params = { right: 0 };
                                }
                            }
                            $("." + clContainer, this).css(params);
                            $(".row", $mainSub).each(function () {
                                var rh = $(this).height();
                                $(".mega-unit", this).css({ height: rh + "px" });
                                $(this)
                                    .parent(".row")
                                    .css({ height: rh + "px" });
                            });
                            $mainSub.hide();
                        } else {
                            $("." + clContainer, this)
                                .addClass("non-mega")
                                .css("left", pl + "px");
                        }
                    }
                });
                var menuHeight = $("> li > a", $dcMegaMenuObj).outerHeight(true);
                $("." + clContainer, $dcMegaMenuObj)
                    .css({ top: menuHeight + "px" })
                    .css("z-index", "1000");
                if (defaults.event == "hover") {
                    var config = { sensitivity: 2, interval: 100, over: megaOver, timeout: 400, out: megaOut };
                    $("li", $dcMegaMenuObj).hoverIntent(config);
                }
                if (defaults.event == "click") {
                    $("body").mouseup(function (e) {
                        if (!$(e.target).parents(".mega-hover").length) {
                            megaReset();
                        }
                    });
                    $("> li > a." + clParent, $dcMegaMenuObj).click(function (e) {
                        var $parentLi = $(this).parent();
                        if ($parentLi.hasClass("mega-hover")) {
                            megaActionClose($parentLi);
                        } else {
                            megaAction($parentLi);
                        }
                        e.preventDefault();
                    });
                }
                defaults.onLoad.call(this);
            }
        });
    };
})(jQuery);
