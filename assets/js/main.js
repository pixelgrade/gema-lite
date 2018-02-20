/**
 * jQuery plugin to make the main navigation WAI-ARIA compatible
 * Inspired by http://simplyaccessible.com/examples/css-menu/option-6/
 *
 * It needs jquery.hoverIntent
 */
(function($) {

    $.fn.ariaNavigation = function(settings) {

        //Map of all the alphanumeric keys so one can jump through submenus by typing the first letter
        //Also use the ESC key to close a submenu
        var keyCodeMap = {
                48: "0",
                49: "1",
                50: "2",
                51: "3",
                52: "4",
                53: "5",
                54: "6",
                55: "7",
                56: "8",
                57: "9",
                59: ";",
                65: "a",
                66: "b",
                67: "c",
                68: "d",
                69: "e",
                70: "f",
                71: "g",
                72: "h",
                73: "i",
                74: "j",
                75: "k",
                76: "l",
                77: "m",
                78: "n",
                79: "o",
                80: "p",
                81: "q",
                82: "r",
                83: "s",
                84: "t",
                85: "u",
                86: "v",
                87: "w",
                88: "x",
                89: "y",
                90: "z",
                96: "0",
                97: "1",
                98: "2",
                99: "3",
                100: "4",
                101: "5",
                102: "6",
                103: "7",
                104: "8",
                105: "9"
            },
            $nav = $(this),
            $allLinks = $nav.find('li.menu-item > a, li.page_item > a'),
            $topLevelLinks = $nav.find('> li > a'),
            subLevelLinks = $topLevelLinks.parent('li').find('ul').find('a');
        navWidth = $nav.outerWidth();

        //default settings
        settings = jQuery.extend({
            menuHoverClass: 'show-menu',
            topMenuHoverClass: 'hover'
        }, settings);


        /**
         *  First add the needed WAI-ARIA markup - supercharge the menu
         */

        // Add ARIA role to menubar and menu items
        //$nav.find( 'li' ).attr( 'role', 'menuitem' );

        $topLevelLinks.each(function() {
            //for regular sub-menus
            // Set tabIndex to -1 so that links can't receive focus until menu is open
            $(this).next('ul')
                .attr({
                    'aria-hidden': 'true',
                    'role': 'menu'
                })
                .find('a')
                .attr('tabIndex', -1);

            // Add aria-haspopup for appropriate items
            if ($(this).next('ul').length > 0) {
                $(this).parent('li').attr('aria-haspopup', 'true');
            }

            // Set tabIndex to -1 so that links can't receive focus until menu is open
            $(this).next('.menu-item-has-children').children('ul')
                .attr({
                    'aria-hidden': 'true',
                    'role': 'menu'
                })
                .find('a').attr('tabIndex', -1);

            $(this).next('.menu-item-has-children')
                .find('a').attr('tabIndex', -1);

            // Add aria-haspopup for appropriate items
            if ($(this).next('.sub-menu').length > 0)
                $(this).parent('li').attr('aria-haspopup', 'true');

            // Set tabIndex to -1 so that links can't receive focus until menu is open
            $(this).next('.page_item_has_children').children('ul')
                .attr({
                    'aria-hidden': 'true',
                    'role': 'menu'
                })
                .find('a').attr('tabIndex', -1);

            $(this).next('.page_item_has_children')
                .find('a').attr('tabIndex', -1);

            // Add aria-haspopup for appropriate items
            if ($(this).next('.children').length > 0)
                $(this).parent('li').attr('aria-haspopup', 'true');
        });


        /**
         * Now let's begin binding things to their proper events
         */

        // First, bind to the hover event
        // use hoverIntent to make sure we avoid flicker
        $allLinks.closest('li').hoverIntent({
            over: function() {
                //clean up first
                $(this).closest('ul')
                    .find('ul.' + settings.menuHoverClass)
                    .attr('aria-hidden', 'true')
                    .removeClass(settings.menuHoverClass)
                    .find('a')
                    .attr('tabIndex', -1);

                $(this).closest('ul')
                    .find('.' + settings.topMenuHoverClass)
                    .removeClass(settings.topMenuHoverClass);

                //now do things
                showSubMenu($(this));

            },
            out: function() {
                hideSubMenu($(this));
            },
            timeout: 10
        });

        // Secondly, bind to the focus event - very important for WAI-ARIA purposes
        $allLinks.focus(function() {
            //clean up first
            $(this).closest('ul')
                .find('ul.' + settings.menuHoverClass)
                .attr('aria-hidden', 'true')
                .removeClass(settings.menuHoverClass)
                .find('a')
                .attr('tabIndex', -1);

            $(this).closest('ul')
                .find('.' + settings.topMenuHoverClass)
                .removeClass(settings.topMenuHoverClass);

            //now do things
            showSubMenu($(this).closest('li'));

        });


        // Now bind arrow keys for navigating the menu

        // First the top level links (the permanent visible links)
        $topLevelLinks.keydown(function(e) {
            var $item = $(this);

            if (e.keyCode == 37) { //left arrow
                e.preventDefault();
                // This is the first item
                if ($item.parent('li').prev('li').length == 0) {
                    $item.parents('ul').find('> li').last().find('a').first().focus();
                } else {
                    $item.parent('li').prev('li').find('a').first().focus();
                }
            } else if (e.keyCode == 38) { //up arrow
                e.preventDefault();
                if ($item.parent('li').find('ul').length > 0) {
                    $item.parent('li').find('ul')
                        .attr('aria-hidden', 'false')
                        .addClass(settings.menuHoverClass)
                        .find('a').attr('tabIndex', 0)
                        .last().focus();
                }
            } else if (e.keyCode == 39) { //right arrow
                e.preventDefault();

                // This is the last item
                if ($item.parent('li').next('li').length == 0) {
                    $item.parents('ul').find('> li').first().find('a').first().focus();
                } else {
                    $item.parent('li').next('li').find('a').first().focus();
                }
            } else if (e.keyCode == 40) { //down arrow
                e.preventDefault();
                if ($item.parent('li').find('ul').length > 0) {
                    $item.parent('li').find('ul')
                        .attr('aria-hidden', 'false')
                        .addClass(settings.menuHoverClass)
                        .find('a').attr('tabIndex', 0)
                        .first().focus();
                }
            } else if (e.keyCode == 32) { //space key
                // If submenu is hidden, open it
                e.preventDefault();
                $item.parent('li').find('ul[aria-hidden=true]')
                    .attr('aria-hidden', 'false')
                    .addClass(settings.menuHoverClass)
                    .find('a').attr('tabIndex', 0)
                    .first().focus();
            } else if (e.keyCode == 27) { //escape key
                e.preventDefault();
                $('.' + settings.menuHoverClass)
                    .attr('aria-hidden', 'true')
                    .removeClass(settings.menuHoverClass)
                    .find('a')
                    .attr('tabIndex', -1);
            } else { //cycle through the child submenu items based on the first letter
                $item.parent('li').find('ul[aria-hidden=false] > li > a').each(function() {
                    if ($(this).text().substring(0, 1).toLowerCase() == keyCodeMap[e.keyCode]) {
                        $(this).focus();
                        return false;
                    }
                });
            }
        });

        // Now do the keys bind for the submenus links
        $(subLevelLinks).keydown(function(e) {
            var $item = $(this);

            if (e.keyCode == 38) { //up arrow
                e.preventDefault();
                // This is the first item
                if ($item.parent('li').prev('li').length == 0) {
                    $item.parents('ul').parents('li').find('a').first().focus();
                } else {
                    $item.parent('li').prev('li').find('a').first().focus();
                }
            } else if (e.keyCode == 39) { //right arrow
                e.preventDefault();

                //if it has sub-menus we should go into them
                if ($item.parent('li').hasClass('menu-item-has-children')) {
                    $item.next('ul').find('> li').first().find('a').first().focus();
                } else {
                    // This is the last item
                    if ($item.parent('li').next('li').length == 0) {
                        $item.closest('ul').closest('li').children('a').first().focus();
                    } else {
                        $item.parent('li').next('li').find('a').first().focus();
                    }
                }
            } else if (e.keyCode == 40) { //down arrow
                e.preventDefault();

                // This is the last item
                if ($item.parent('li').next('li').length == 0) {
                    $item.closest('ul').closest('li').children('a').first().focus();
                } else {
                    $item.parent('li').next('li').find('a').first().focus();
                }
            } else if (e.keyCode == 27 || e.keyCode == 37) { //escape key or left arrow => jump to the upper level links
                e.preventDefault();

                //focus on the upper level link
                $item.closest('ul').closest('li')
                    .children('a').first().focus();

            } else if (e.keyCode == 32) { //space key
                e.preventDefault();
                window.location = $item.attr('href');
            } else {

                //cycle through the menu items based on the first letter
                var found = false;
                $item.parent('li').nextAll('li').find('a').each(function() {
                    if ($(this).text().substring(0, 1).toLowerCase() == keyCodeMap[e.keyCode]) {
                        $(this).focus();
                        found = true;
                        return false;
                    }
                });

                if (!found) {
                    $item.parent('li').prevAll('li').find('a').each(function() {
                        if ($(this).text().substring(0, 1).toLowerCase() == keyCodeMap[e.keyCode]) {
                            $(this).focus();
                            return false;
                        }
                    });
                }
            }
        });


        // Hide menu if click or focus occurs outside of navigation
        $nav.find('a').last().keydown(function(e) {
            if (e.keyCode == 9) { //tab key
                // If the user tabs out of the navigation hide all menus
                hideSubMenus();
            }
        });

        //close all menus when pressing ESC key
        $(document).keydown(function(e) {
            if (e.keyCode == 27) { //esc key
                hideSubMenus();
            }
        });

        //close all menus on click outside
        $(document).click(function() {
            hideSubMenus();
        });

        $nav.on('click touchstart', function(e) {
            e.stopPropagation();
        });

        $nav.find('.menu-item-has-children > a, .page_item_has_children > a').on('touchstart', function(e) {

            var $item = $(this).parent();

            if (!$item.hasClass('hover')) {
                e.preventDefault();
                $item.addClass('hover');
                $item.siblings().removeClass('hover');
                return;
            } else {
                // $item.removeClass("hover");
            }

        });

        function getIOSVersion(ua) {
            ua = ua || navigator.userAgent;
            return parseFloat(
                ('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(ua) || [0, ''])[1])
                .replace('undefined', '3_2').replace('_', '.').replace('_', '')
            ) || false;
        }

        if (getIOSVersion()) {
            $nav.find('.menu-item--no-children > a').on('hover', function(e) {
                var el = $(this);
                var link = el.attr('href');
                window.location = link;
            });
        }

        $('body').on('touchstart', function() {
            $('.menu-item-has-children').removeClass('hover');
            $('.page_item_has_children').removeClass('hover');
        });

        function showSubMenu($item) {

            $item.addClass(settings.topMenuHoverClass);

            $item.find('.sub-menu, .children').first() //affect only the first ul found - the one with the submenus, ignore the mega menu items
                .attr('aria-hidden', 'false')
                .addClass(settings.menuHoverClass);

            $item.find('a').attr('tabIndex', 0); //set the tabIndex to 0 so we let the browser figure out the tab order

        }

        function hideSubMenu($item) {

            if ($item.hasClass('menu-item-has-children')) {
                $item.children('.sub-menu').css('left', '');
            }

            if ($item.hasClass('page_item_has_children')) {
                $item.children('.children').css('left', '');
            }

            $item.children('a').first().next('ul')
                .attr('aria-hidden', 'true')
                .removeClass(settings.menuHoverClass)
                .find('a')
                .attr('tabIndex', -1);

            //when dealing with first level submenus - they are wrapped
            $item.children('a').first().next('.sub-menu')
                .attr('aria-hidden', 'true')
                .removeClass(settings.menuHoverClass)
                .find('a')
                .attr('tabIndex', -1);

            $item.children('a').first().next('.children')
                .attr('aria-hidden', 'true')
                .removeClass(settings.menuHoverClass)
                .find('a')
                .attr('tabIndex', -1);

            $item.removeClass(settings.topMenuHoverClass);
        }

        function hideSubMenus() {

            $('.' + settings.menuHoverClass)
                .attr('aria-hidden', 'true')
                .removeClass(settings.menuHoverClass)
                .find('a')
                .attr('tabIndex', -1);

            $('.' + settings.topMenuHoverClass).removeClass(settings.topMenuHoverClass);

        }
    }

})(jQuery);
/*!
 * hoverIntent v1.8.0 // 2014.06.29 // jQuery v1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2014 Brian Cherne
 */
(function($) {
    $.fn.hoverIntent = function(handlerIn, handlerOut, selector) {
        var cfg = {
            interval: 100,
            sensitivity: 6,
            timeout: 0
        };
        if (typeof handlerIn === "object") {
            cfg = $.extend(cfg, handlerIn)
        } else {
            if ($.isFunction(handlerOut)) {
                cfg = $.extend(cfg, {
                    over: handlerIn,
                    out: handlerOut,
                    selector: selector
                })
            } else {
                cfg = $.extend(cfg, {
                    over: handlerIn,
                    out: handlerIn,
                    selector: handlerOut
                })
            }
        }
        var cX, cY, pX, pY;
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY
        };
        var compare = function(ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            if (Math.sqrt((pX - cX) * (pX - cX) + (pY - cY) * (pY - cY)) < cfg.sensitivity) {
                $(ob).off("mousemove.hoverIntent", track);
                ob.hoverIntent_s = true;
                return cfg.over.apply(ob, [ev])
            } else {
                pX = cX;
                pY = cY;
                ob.hoverIntent_t = setTimeout(function() {
                    compare(ev, ob)
                }, cfg.interval)
            }
        };
        var delay = function(ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = false;
            return cfg.out.apply(ob, [ev])
        };
        var handleHover = function(e) {
            var ev = $.extend({}, e);
            var ob = this;
            if (ob.hoverIntent_t) {
                ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t)
            }
            if (e.type === "mouseenter") {
                pX = ev.pageX;
                pY = ev.pageY;
                $(ob).on("mousemove.hoverIntent", track);
                if (!ob.hoverIntent_s) {
                    ob.hoverIntent_t = setTimeout(function() {
                        compare(ev, ob)
                    }, cfg.interval)
                }
            } else {
                $(ob).off("mousemove.hoverIntent", track);
                if (ob.hoverIntent_s) {
                    ob.hoverIntent_t = setTimeout(function() {
                        delay(ev, ob)
                    }, cfg.timeout)
                }
            }
        };
        return this.on({
            "mouseenter.hoverIntent": handleHover,
            "mouseleave.hoverIntent": handleHover
        }, cfg.selector)
    }
})(jQuery);
// /* ====== Smart Resize Logic ====== */
// It's best to debounce the resize event to a void performance hiccups
(function($, sr) {

    /**
     * debouncing function from John Hann
     * http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
     */
    var debounce = function(func, threshold, execAsap) {
        var timeout;

        return function debounced() {
            var obj = this,
                args = arguments;

            function delayed() {
                if (!execAsap) func.apply(obj, args);
                timeout = null;
            }

            if (timeout) clearTimeout(timeout);
            else if (execAsap) func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 200);
        };
    }
    // smartresize
    jQuery.fn[sr] = function(fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'smartresize');
(function($, undefined) {
    // /* ====== SHARED VARS  - jQuery ====== */
    // These depend on jQuery
    var $window = $(window),
        windowHeight = $window.height(),
        windowWidth = $window.width(),
        latestKnownScrollY = window.scrollY,
        ticking = false,
        isTouchDevice = !!('ontouchstart' in window),
        $body = $('body'),
        isWekbit = ('WebkitAppearance' in document.documentElement.style) ? true : false,
        isIE = typeof(is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window),
        isiele10 = navigator.userAgent.match(/msie (9|([1-9][0-9]))/i);
    var Grid = function() {

    };

    Grid.prototype.refresh = function() {
        this.alignTitles();
        this.addMargins();
        this.adjustCardMeta();
        this.offsetFirstColumn();
    };

    Grid.prototype.alignTitles = function() {

        $('.card-title-wrap').each(function(i, obj) {
            var $title = $(obj);
            $title.closest('.card__wrap').css('paddingBottom', $title.outerHeight() * 0.5);
        });

    };

    Grid.prototype.addMargins = function() {

        var $columns = $('.column'),
            $compare;

        $('.grid__item--mb').removeClass('grid__item--mb');

        $columns.each(function(i, column) {
            var $column = $(column);

            if (i % 2 == 1) {

                $column.children('.entry-card--portrait, .entry-card--text').each(function(j, obj) {
                    var $obj = $(obj);

                    if ($obj.is(':nth-child(2n+1)')) {
                        $compare = $columns.eq(i - 1);
                    } else {
                        $compare = $columns.eq(i + 1);
                    }

                    if (typeof $compare == "undefined") {
                        return;
                    }

                    var bottom = $obj.offset().top + $obj.outerHeight(),
                        $neighbour;

                    $compare.children().each(function(j, item) {
                        var $item = $(item),
                            thisBottom = $(item).offset().top + $(item).outerHeight();

                        if (thisBottom < bottom) {
                            $neighbour = $item;
                        } else {
                            return false;
                        }
                    });

                    if (typeof $neighbour !== "undefined") {
                        $neighbour.addClass('grid__item--mb');
                    }
                });
            }
        });
    };

    Grid.prototype.showCards = function($cards) {

        $cards.each(function(i, obj) {
            var $obj = $(obj);

            setTimeout(function() {
                $obj.addClass('is-visible');
            }, i * 150);

            setTimeout(function() {
                $obj.removeClass('ajax-loaded');
            }, 400 + i * 150);

            $obj.imagesLoaded(function() {

                var $img = $('<img>'),
                    $thumbnail = $obj.find('.card__image--large');

                $img.attr('src', $thumbnail.data('src'));

                $img.imagesLoaded(function() {
                    $obj.addClass('is-loaded');
                });

                $thumbnail.replaceWith($img);
            });
        });

    };

    Grid.prototype.adjustCardMeta = function() {

        if ($body.is('.singular') || windowWidth < 480) {
            $('.card__meta').attr('style', '');
        } else {
            $('.card--image').each(function(i, obj) {
                var $cardMeta = $(obj).find('.card__meta');
                $cardMeta.css('marginTop', -1 * $cardMeta.height());
            });
        }

    };

    Grid.prototype.offsetFirstColumn = function() {
        var $columns = $('.bricklayer-column');
        if ($columns.length > 1) {
            var height = $('.header .site-branding').outerHeight();
            $columns.css('marginTop', '').eq(1).css('marginTop', height);
        }
    };

    Logo = function() {

        this.$header = $('.header');
        this.$logo = $('.site-branding');
        this.$clone = null;
        this.distance = null;
        this.initialized = false;

    };

    Logo.prototype.adjustSiteTitle = function() {

        $('.site-title').each(function(i, obj) {
            var $title = $(obj).removeAttr('style').css('fontSize', ''),
                $branding = $title.closest('.site-branding'),
                $span = $title.find('span'),
                titleWidth = $title.width(),
                brandingHeight,
                spanWidth = $span.width(),
                fontSize = parseInt($title.css('fontSize', '').css('fontSize')),
                scaling = spanWidth / parseFloat(titleWidth),
                maxLines = $body.is('.singular') ? 3 : 2;

            /* if site title is too long use a smaller font size */
            if (spanWidth > titleWidth) {
                fontSize = parseInt(fontSize / scaling);
                $title.css('fontSize', fontSize);
            }

            var titleHeight = $title.outerHeight();

            if ($title.closest('.mobile-logo').length) {
                var mobileHeight = $('.mobile-logo').outerHeight();
                fontSize = parseInt(fontSize * mobileHeight / titleHeight);
                if (mobileHeight < titleHeight) {
                    $title.css('fontSize', fontSize);
                }
                return;
            }

            brandingHeight = $branding.outerHeight();

            /* if site title is too long use a smaller font size */
            if (brandingHeight < titleHeight) {
                fontSize = parseInt(fontSize * brandingHeight / titleHeight);
                $title.css('fontSize', fontSize);
                return;
            }

            /* if site title is too tall, again, use a smaller font size */
            var lineHeight = parseFloat($title.css('lineHeight')) / fontSize,
                lines = Math.round(titleHeight / fontSize / lineHeight);

            while (lines > maxLines) {
                fontSize = fontSize - 1;
                $title.css('fontSize', fontSize);
                titleHeight = $title.outerHeight();
                lines = titleHeight / fontSize / lineHeight;
            }
        });
    };

    Logo.prototype.adjustArchiveTitle = function() {

        $('.archive-title').each(function(i, obj) {
            var $title = $(obj).removeAttr('style').css('fontSize', ''),
                fontSize = parseInt($title.css('font-size')),
                $span = $title.find('span'),
                titleWidth = $title.width(),
                spanWidth = $span.width(),
                scaling = spanWidth / parseFloat(titleWidth);

            /* if site title is too long use a smaller font size */
            if (spanWidth > titleWidth) {
                fontSize = parseInt(fontSize / scaling);
                $title.css('fontSize', fontSize);
            }
        });

    };

    Logo.prototype.prepare = function(scrollY) {

        var that = this;

        scrollY = scrollY || (window.pageYOffset || document.documentElement.scrollTop) - (document.documentElement.clientTop || 0);

        if (that.$logo.length) {

            that.$logo.imagesLoaded(function() {

                if (that.$clone === null) {
                    that.$clone = that.$logo.clone().appendTo('.mobile-logo');
                } else {
                    that.$clone.removeAttr('style');
                }

                that.logoMid = that.$logo.offset().top + that.$logo.height() / 2;
                that.cloneMid = that.$clone.offset().top + that.$clone.height() / 2 - scrollY;
                that.distance = that.logoMid - that.cloneMid;

                that.initialized = true;

                that.update(scrollY);

                that.$clone.css('opacity', 1);

            });
        }
    };

    Logo.prototype.update = function(scrollY) {

        if (!this.initialized) {
            return;
        }

        if (this.distance < scrollY) {
            this.$clone.css('transform', 'none');
            return;
        }

        this.$clone.css('transform', 'translateY(' + (this.distance - scrollY) + 'px)');
    };

    /*!
     * pixelgradeTheme v1.0.1
     * Copyright (c) 2017 PixelGrade http://www.pixelgrade.com
     * Licensed under MIT http://www.opensource.org/licenses/mit-license.php/
     */
    var pixelgradeTheme = function() {

        var _this = this,
            windowWidth = window.innerWidth,
            windowHeight = window.innerHeight,
            lastScrollY = (window.pageYOffset || document.documentElement.scrollTop) - (document.documentElement.clientTop || 0),
            orientation = windowWidth > windowHeight ? 'landscape' : 'portrait';

        _this.ev = $({});
        _this.frameRendered = false;
        _this.debug = false;

        _this.log = function() {
            if (_this.debug) {
                console.log.apply(this, arguments)
            }
        };

        _this.getScroll = function() {
            return lastScrollY;
        };

        _this.getWindowWidth = function() {
            return windowWidth;
        };

        _this.getWindowHeight = function() {
            return windowHeight;
        };

        _this.getOrientation = function() {
            return orientation;
        };

        _this.onScroll = function() {
            if (_this.frameRendered === false) {
                return;
            }
            lastScrollY = (window.pageYOffset || document.documentElement.scrollTop) - (document.documentElement.clientTop || 0);
            _this.frameRendered = false;
        };

        _this.onResize = function() {
            windowWidth = window.innerWidth;
            windowHeight = window.innerHeight;

            var newOrientation = windowWidth > windowHeight ? 'landscape' : 'portrait';

            _this.debouncedResize();

            if (orientation !== newOrientation) {
                _this.debouncedOrientationChange();
            }

            orientation = newOrientation;
        };

        _this.debouncedResize = Util.debounce(function() {
            $(window).trigger('pxg:resize');
        }, 300);

        _this.debouncedOrientationChange = Util.debounce(function() {
            $(window).trigger('pxg:orientationchange');
        }, 300);

        _this.renderLoop = function() {
            if (_this.frameRendered === false) {
                _this.ev.trigger('render');
            }
            requestAnimationFrame(function() {
                _this.renderLoop();
                _this.frameRendered = true;
                _this.ev.trigger('afterRender');
            });
        };

        _this.eventHandlers = function() {
            $(document).ready(_this.onReady);
            $(window)
                .on('scroll', _this.onScroll)
                .on('resize', _this.onResize)
                .on('load', _this.onLoad);
        };

        _this.eventHandlers();
        _this.renderLoop();
    };

    pixelgradeTheme.prototype.onReady = function() {
        $('html').addClass('is-ready');
    };

    pixelgradeTheme.prototype.onLoad = function() {
        $('html').addClass('is-loaded');
    };

    var Util = {
        /**
         *
         * @returns {boolean}
         */
        isTouch: function() {
            return !!(
                "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch
            );
        },

        handleCustomCSS: function($container) {
            var $elements = typeof $container !== "undefined" ? $container.find("[data-css]") : $("[data-css]");

            if ($elements.length) {
                $elements.each(function(i, obj) {
                    var $element = $(obj),
                        css = $element.data('css');

                    if (typeof css !== "undefined") {
                        $element.replaceWith('<style type="text/css">' + css + '</style>');
                    }
                });
            }
        },


        /**
         * Search every image that is alone in a p tag and wrap it
         * in a figure element to behave like images with captions
         *
         * @param $container
         */
        unwrapImages: function($container) {

            $container = typeof $container !== "undefined" ? $container : $body;

            $container.find('p > img:first-child:last-child, p > a:first-child:last-child > img').each(function(i, obj) {
                var $obj = $(obj),
                    $image = $obj.closest('img'),
                    className = $image.attr('class'),
                    $p = $image.closest('p'),
                    $figure = $('<figure />').attr('class', className);

                if ($.trim($p.text()).length) {
                    return;
                }

                $figure.append($image.removeAttr('class'));
                $p.replaceWith($figure);
            });
        },

        wrapEmbeds: function($container) {
            $container = typeof $container !== "undefined" ? $container : $('body');
            $container.children('iframe, embed, object').wrap('<p>');
        },

        /**
         * Initialize video elements on demand from placeholders
         *
         * @param $container
         */
        handleVideos: function($container) {
            $container = typeof $container !== "undefined" ? $container : $body;

            $container.find('.video-placeholder').each(function(i, obj) {
                var $placeholder = $(obj),
                    video = document.createElement('video'),
                    $video = $(video).addClass('c-hero__video');

                // play as soon as possible
                video.onloadedmetadata = function() {
                    video.play();
                };

                video.src = $placeholder.data('src');
                video.poster = $placeholder.data('poster');
                video.muted = true;
                video.loop = true;

                $placeholder.replaceWith($video);
            });
        },

        smoothScrollTo: function(to, duration, easing) {
            to = to || 0;
            duration = duration || 1000;
            easing = easing || 'swing';

            $("html, body").stop().animate({
                scrollTop: to
            }, duration, easing);

        },

        // Returns a function, that, as long as it continues to be invoked, will not
        // be triggered. The function will be called after it stops being called for
        // N milliseconds. If `immediate` is passed, trigger the function on the
        // leading edge, instead of the trailing.
        debounce: function(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) {
                        func.apply(context, args);
                    }
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) {
                    func.apply(context, args);
                }
            };
        },

        // Returns a function, that, when invoked, will only be triggered at most once
        // during a given window of time. Normally, the throttled function will run
        // as much as it can, without ever going more than once per `wait` duration;
        // but if you'd like to disable the execution on the leading edge, pass
        // `{leading: false}`. To disable execution on the trailing edge, ditto.
        throttle: function(callback, limit) {
            var wait = false;
            return function() {
                if (!wait) {
                    callback.call();
                    wait = true;
                    setTimeout(function() {
                        wait = false;
                    }, limit);
                }
            }
        },

        mq: function(direction, string) {
            var $temp = $('<div class="u-mq-' + direction + '-' + string + '">').appendTo('body'),
                response = $temp.is(':visible');

            $temp.remove();
            return response;
        },

        below: function(string) {
            return this.mq('below', string);
        },

        above: function(string) {
            return this.mq('above', string);
        },

        getParamFromURL: function(param, url) {
            var parameters = (
                url.split('?')
            )[1];

            if (typeof parameters === "undefined") {
                return parameters;
            }

            parameters = parameters.split('&');

            for (var i = 0; i < parameters.length; i++) {
                var parameter = parameters[i].split('=');
                if (parameter[0] === param) {
                    return parameter[1];
                }
            }
        },

        reloadScript: function(filename) {
            var $old = $('script[src*="' + filename + '"]'),
                $new = $('<script>'),
                src = $old.attr('src');

            if (!$old.length) {
                return;
            }

            $old.replaceWith($new);
            $new.attr('src', src);
        },

        // here we change the link of the Edit button in the Admin Bar
        // to make sure it reflects the current page
        adminBarEditFix: function(id, editString, taxonomy) {
            // get the admin ajax url and clean it
            var baseEditURL = juliaStrings.ajaxurl.replace('admin-ajax.php', 'post.php'),
                baseEditTaxURL = juliaStrings.ajaxurl.replace('admin-ajax.php', 'edit-tags.php'),
                $editButton = $('#wp-admin-bar-edit a');

            if (!empty($editButton)) {
                if (id !== undefined && editString !== undefined) { //modify the current Edit button
                    if (!empty(taxonomy)) { //it seems we need to edit a taxonomy
                        $editButton.attr('href', baseEditTaxURL + '?tag_ID=' + id + '&taxonomy=' + taxonomy + '&action=edit');
                    } else {
                        $editButton.attr('href', baseEditURL + '?post=' + id + '&action=edit');
                    }
                    $editButton.html(editString);
                } else { // we have found an edit button but right now we don't need it anymore since we have no id
                    $('#wp-admin-bar-edit').remove();
                }
            } else { // upss ... no edit button
                // lets see if we need one
                if (id !== undefined && editString !== undefined) { //we do need one after all
                    //locate the New button because we need to add stuff after it
                    var $newButton = $('#wp-admin-bar-new-content');

                    if (!empty($newButton)) {
                        if (!empty(taxonomy)) { //it seems we need to generate a taxonomy edit thingy
                            $newButton.after('<li id="wp-admin-bar-edit"><a class="ab-item dJAX_internal" href="' + baseEditTaxURL + '?tag_ID=' + id + '&taxonomy=' + taxonomy + '&action=edit">' + editString + '</a></li>');
                        } else { //just a regular edit
                            $newButton.after('<li id="wp-admin-bar-edit"><a class="ab-item dJAX_internal" href="' + baseEditURL + '?post=' + id + '&action=edit">' + editString + '</a></li>');
                        }
                    }
                }
            }

            //Also we need to fix the (no-)customize-support class on body by running the WordPress inline script again
            // The original code is generated by the wp_customize_support_script() function in wp-includes/theme.php @3007
            var request, b = document.body,
                c = 'className',
                cs = 'customize-support',
                rcs = new RegExp('(^|\\s+)(no-)?' + cs + '(\\s+|$)');

            // No CORS request
            request = true;

            b[c] = b[c].replace(rcs, ' ');
            // The customizer requires postMessage and CORS (if the site is cross domain)
            b[c] += (window.postMessage && request ? ' ' : ' no-') + cs;

            //Plus, we need to change the url of the Customize button to the current url
            var $customizeButton = $('#wp-admin-bar-customize a'),
                baseCustomizeURL = juliaStrings.ajaxurl.replace('admin-ajax.php', 'customize.php');
            if (!empty($customizeButton)) {
                $customizeButton.attr('href', baseCustomizeURL + '?url=' + encodeURIComponent(window.location.href));
            }

        }

    };

    var HandleSubmenusOnTouch = (function() {

        var $theUsualSuspects,
            $theUsualAnchors,
            initialInit = false;

        function init() {
            if (initialInit || !isTouchDevice) return;

            $theUsualSuspects = $('li[class*=children]').removeClass('hover');
            $theUsualAnchors = $theUsualSuspects.find('> a');

            unbind();

            $theUsualAnchors.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                if ($(this).hasClass('active')) {
                    window.location.href = $(this).attr('href');
                }

                $theUsualAnchors.removeClass('active');
                $(this).addClass('active');

                // When a parent menu item is activated,
                // close other menu items on the same level
                $(this).parent().siblings().removeClass('hover');

                // Open the sub menu of this parent item
                $(this).parent().addClass('hover');
            });

            bindOuterNavClick();

            initialInit = true;
        }

        function unbind() {
            $theUsualAnchors.unbind();
            isHorizontalInitiated = false;
        }

        // When a sub menu is open, close it by a touch on
        // any other part of the viewport than navigation.
        // use case: normal, horizontal menu, touch events,
        // sub menus are not visible.
        function bindOuterNavClick() {
            $body.on('touchstart', function(e) {
                var container = $('.main-navigation');

                if (!container.is(e.target) // if the target of the click isn't the container...
                    &&
                    container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                    $theUsualSuspects.removeClass('hover').removeClass('active');
                }
            });
        }

        return {
            init: init
        }
    }());

    function checkForSmallImageOnSingle() {
        if (!$body.hasClass('singular') || $body.hasClass('no-featured-image')) {
            return;
        }

        if (windowWidth > 900) {
            if ($('.entry-featured img').width() < 500) {
                $body.addClass('has--small-featured-image');
                $('.post__content').css('paddingTop', $('.entry-featured').height() + 30);
            }
        } else {
            $('.post__content').removeAttr('style');
        }
    }

    var Gema = new pixelgradeTheme(),
        log = Gema.log,
        resizeEvent = 'ontouchstart' in window && 'onorientationchange' in window ? 'pxg:orientationchange' : 'pxg:resize',
        $html = $('html'),
        $body = $('body');

    window.bricklayer = null;

    Gema.init = function() {
        $body.toggleClass('is--webkit', isWekbit);
        $body.toggleClass('is--ie', isIE);
        $body.toggleClass('is--ie-le10', isiele10);

        Gema.Grid = new Grid();
        Gema.Logo = new Logo();

        checkForSmallImageOnSingle();

        HandleSubmenusOnTouch.init();

        $('ul.nav-menu').ariaNavigation();

        $('.grid, .site-header').css('opacity', 1);

        if ($body.is('.singular')) {
            prepareSingle();
        } else {
            prepareArchive();
        }

        Gema.adjustLayout();
    };

    Gema.onPostLoad = function(event, data) {
        var $elements = $(data.html).filter('.grid__item').addClass('ajax-loaded').each(function(i, obj) {
            if ($.fn.mediaelementplayer) {
                $(obj).find('audio, video').mediaelementplayer();
            }
        });

        $('.infinite-loader').remove();

        if ($('.grid').length && bricklayer !== null) {
            bricklayer.append($.makeArray($elements));
        }

        // Clean up the duplicate posts that are appended
        // by default by Jetpack's Infinite Scroll to div#main
        // (and also the corresponding HTML comments)
        $('#main').contents().each(function() {
            if ($(this).is('article') || this.nodeType === Node.COMMENT_NODE) {
                $(this).remove();
            }
        });

        Gema.adjustLayout();

        Gema.Grid.showCards($elements);
    };

    Gema.bindEvents = function() {

        $(window).on(resizeEvent, Gema.adjustLayout);
        $(window).on('load', Gema.adjustLayout);
        $(document.body).on('post-load', Gema.onPostLoad);

        Gema.ev.on('render', Gema.update);

        $('.overlay-toggle').on('touchstart click', toggleOverlay);
        $('.menu-toggle').on('touchstart click', toggleNav);
        $('.sidebar-toggle').on('touchstart click', toggleSidebar);

    }

    function toggleOverlay(e) {
        e.preventDefault();
        e.stopPropagation();

        $body.toggleClass('overlay-is-open');

        if ($body.hasClass('overlay-is-open')) {
            $body.width($body.width());
            $body.css('overflow', 'hidden');
        } else {
            $body.css('overflow', '');
        }
    }

    function toggleNav(e) {
        e.preventDefault();
        e.stopPropagation();

        if ($body.hasClass('nav-is-open')) {
            // closing the menu
            $('.menu-toggle').attr('aria-expanded', 'false');
        } else {
            // opening the menu
            $('.menu-toggle').attr('aria-expanded', 'true');
        }

        $body.toggleClass('nav-is-open');
    }

    function toggleSidebar(e) {
        e.preventDefault();
        e.stopPropagation();

        if ($body.hasClass('sidebar-is-open')) {
            //closing the sidebar
            $('.sidebar-toggle').attr('aria-expanded', 'false');
        } else {
            // opening the sidebar
            $('.sidebar-toggle').attr('aria-expanded', 'true');
        }

        $body.toggleClass('sidebar-is-open');
    }

    function prepareArchive() {

        var $cards = $('.card');

        if ($('.grid').length && bricklayer === null) {
            bricklayer = new Bricklayer(document.querySelector('.grid'));
            bricklayer.redraw();
        }

        Gema.Grid.showCards($cards);

        $body.css('opacity', 1);
    }

    function prepareSingle() {

        var $mobileHeader = $('.mobile-header-wrapper'),
            scrollTo;

        if ($mobileHeader.is(':visible')) {
            scrollTo = $('.content-area').offset().top - $mobileHeader.outerHeight();
            setTimeout(function() {
                window.scrollTo(0, scrollTo);
                $body.css('opacity', 1);
            });
        } else {
            $body.css('opacity', 1);
        }
    }

    Gema.hidePanels = function() {
        $body.removeClass('nav-is-open')
            .removeClass('sidebar-is-open')
            .removeClass('overlay-is-open')
            .css('width', '')
            .css('overflow', '');
    };

    Gema.update = function() {
        if (typeof Gema.Logo !== "undefined") {
            Gema.Logo.update(Gema.getScroll());
        }
    };

    Gema.adjustLayout = function() {

        if (Gema.getWindowWidth() > 900) {
            Gema.hidePanels();
        }

        // Single
        checkForSmallImageOnSingle();
        Gema.placeSidebar();

        // Archive
        Gema.Logo.adjustSiteTitle();
        Gema.Logo.adjustArchiveTitle();
        Gema.Logo.prepare();

        Gema.Grid.offsetFirstColumn();
        Gema.Grid.adjustCardMeta();
        Gema.Grid.alignTitles();
        Gema.Grid.addMargins();
    };

    Gema.placeSidebar = function() {

        if (!$body.hasClass('has-active-sidebar')) {
            return;
        }

        var $sidebar = $('.widget-area'),
            $content = $('.content-area');

        if (Gema.getWindowWidth() > 900) {

            if (!$sidebar.length) {
                return;
            }

            if ($body.hasClass('no-featured-image')) {
                $sidebar.addClass('is--placed').css('top', $('.site-main').css('padding-top'));
            } else {
                // If we are past the breakpoint
                var $featuredImage = $('.entry-featured'),
                    featuredImageBottom = $featuredImage.height() + parseInt($('.post__content').css('margin-top'), 10);

                // position: absolute; on the sidebar(via ".is--placed")
                // below the featured image;
                if (!$body.hasClass('has--small-featured-image')) {
                    $sidebar.addClass('is--placed').css('top', featuredImageBottom);
                } else {
                    $sidebar.addClass('is--placed').css('top', 108);
                }
            }

            // and set a height on the content so that everything seems in place.
            $content.css("minHeight", $sidebar.offset().top + $sidebar.height());
        } else {
            // Remove the height (possibly) set above.
            $content.removeAttr('style');
            $sidebar.css('top', '');
        }
    };

    $.Gema = Gema;
    $.Gema.init();
    Gema.bindEvents();

})(jQuery);