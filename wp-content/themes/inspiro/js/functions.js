/**
 * Theme functions file
 */
(function ($) {
    'use strict';

    $.fn.magnificPopupCallbackforPortfolios = function(){
        this.magnificPopup({
            disableOn: function() { if( $(window).width() < 0) { return false; } return true; },
            type: 'image',
            gallery: {
                enabled: true,
            },
            iframe: {
                patterns: {
                    youtu: {
                        index: 'youtu.be',
                        id: function( url ) {
                            // Capture everything after the hostname, excluding possible querystrings.
                            var m = url.match( /^.+youtu.be\/([^?]+)/ );

                            if ( null !== m ) {
                                return m[1];
                            }

                            return null;
                        },
                        // Use the captured video ID in an embed URL.
                        // Add/remove querystrings as desired.
                        src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0'
                    }
                }
            },
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            callbacks: {
                change: function() {
                    if(this.currItem.type === 'inline'){
                        $(this.content).find('video')[0].play();
                    }
                },

                beforeClose: function () {
                   if (this.currItem.type === 'inline') {
                       var $video = $(this.content).find('video');

                       if ($video.length) {
                           var videoElement = $video[0];

                           var currentSrc = videoElement.currentSrc;
                           videoElement.pause();
                           videoElement.currentTime = 0;
                           videoElement.src = '';
                           videoElement.src = currentSrc;
                       }
                   }
               },
            }
        });
    };

    var $document = $(document);
    var $window = $(window);


    /**
     * Document ready (jQuery)
     */
    $(function () {
        /**
         * Header style.
         */
        if ($('.slides > li, .single .has-post-cover, .page .has-post-cover, .portfolio-with-post-cover, .blog-with-post-cover').length) {
            $('.navbar').addClass('page-with-cover');
        } else {
            $('.navbar').removeClass('page-with-cover');
        }


        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'animation': {
                'height': 'show'
            },
            'animationOut': {
               'height': 'hide'
           }
        });




        $('<span class="child-arrow">&#62279;</span>')
            .click(function(e){
                e.preventDefault();

                var $li = $(this).closest('li'),
                    $sub = $li.find('> ul');

                if ( $sub.is(':visible') ) {
                    $sub.slideUp();
                    $li.removeClass('open');
                } else {
                    $sub.slideDown();
                    $li.addClass('open');
                }
            })
            .appendTo('.side-nav .navbar-nav li.menu-item-has-children > a');



        /**
         * Activate main slider.
         */
        $('#slider').sllider();


        /**
         * Search form in header.
         */
        $(".sb-search").sbSearch();

        /**
         * FitVids - Responsive Videos in posts
         */
        $(".wpzlb-layout, .entry-content, .video_cover, .featured_page_content").fitVids();




        /**
         * Masonry on Posts
         */
        var $grid = $('#portfolio-masonry .portfolio-grid').masonry({
            itemSelector: '.portfolio_item',
            columnWidth: '.portfolio_item'
        });

        $('.entry-cover').find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();

        $('.portfolio-showcase .portfolio_item').find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();

        $('.portfolio-archive .portfolio_item').find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();

        // layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry('layout');
        }).done(function(){
            $grid.find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();
        });

        /**
         *
         */
        $.fn.fullWidthContent();
        $.fn.responsiveSliderImages();
        $.fn.paralised();
        $.fn.sideNav();
        $.fn.singlePageWidgetBackground();
        $.fn.singleportfolio();

        /**
         * Portfolio items popover.
         */
        $('.portfolio-archive .portfolio_item').thumbnailPopover();
        $('.portfolio-showcase .portfolio_item').thumbnailPopover();
        $('.carousel_widget_wrapper .portfolio_item').thumbnailPopover();

        /**
         * Isotope filter for Portfolio Isotope template.
         */
        $('.portfolio-taxonomies-filter-by').portfolioIsotopeFilter();

        /**
         * Clickable divs.
         */
        $('.clickable').on('click', function () {
            window.location.href = $(this).data('href');
        });

        /**
         * Portfolio infinite loading support.
         */
        var $folioitems = $('.portfolio-grid');
        if (typeof wpz_currPage != 'undefined' && wpz_currPage < wpz_maxPages) {
            $('.navigation').empty().append('<a class="btn btn-primary" id="load-more" href="#">Load More&hellip;</a>');

            $('#load-more').on('click', function (e) {
                e.preventDefault();
                if (wpz_currPage < wpz_maxPages) {
                    $(this).text('Loading...');
                    wpz_currPage++;

                    $.get( wpz_pagingURL.replace('%page%', wpz_currPage ) , function (data) {
                        var $newItems = $('.portfolio-grid article', data);


                        if ($folioitems.parent().is('#portfolio-masonry')) {
                            $grid.append($newItems).masonry('appended', $newItems);

                            $newItems.imagesLoaded().progress(function () {
                                $grid.masonry('layout');
                            }).done(function(){
                                $grid.find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();
                            });
                        } else {
                            $newItems.addClass('hidden').hide();
                            $folioitems.append($newItems);
                            $folioitems.find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();
                            $folioitems.find('article.hidden').fadeIn().removeClass('hidden');
                        }

                        if ((wpz_currPage + 1) <= wpz_maxPages) {
                            $('#load-more').text('Load More\u2026');
                        } else {
                            $('#load-more').animate({height: 'hide', opacity: 'hide'}, 'slow', function () {
                                $(this).remove();
                            });
                        }
                    });
                }
            });
        }
    });



    $.fn.singleportfolio = function () {
        var $singlePort = $('.full-noslider');
        $singlePort.each(function (i) {
            var $this = $(this);

            $window.on('resize focus', dynamicHeightSingle);

            dynamicHeightSingle();

            function dynamicHeightSingle() {
                var height = $(window).height() - $('.full-noslider').offset().top - parseInt($('.full-noslider').css('padding-top'), 10);

                /* use different min-height for different borwser widths */
                if (height < 300) {
                    height = 300;
                } else if (height < 500 && $window.width() > 768) {
                    height = 500;
                }

                $this.find('.entry-cover').height(height);
            }

        });
    };



    $.fn.thumbnailPopover = function () {
        return this.on('mousemove', function (event) {
            var $this = $(this);
            var $popoverContent = $this.find('.entry-thumbnail-popover-content');

            var itemHeight = $this.outerHeight();
            var contentHeight = $popoverContent.outerHeight();
            var y = event.pageY - $this.offset().top;

            if (contentHeight <= itemHeight) {
                $popoverContent.addClass('popover-content--animated');
                $popoverContent.css('bottom', '');
                return;
            }

            $popoverContent.removeClass('popover-content--animated');

            $popoverContent.css({
                'bottom': (1 - y / itemHeight) * (itemHeight - contentHeight)
            });
        });
    };

    $.fn.sllider = function () {
        var countedElements = parseInt($(this).data('posts'), 10);
        return this.each(function () {
            var $this = $(this);
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            var handHeldDevice = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(userAgent));

            $this.flexslider({
                controlNav: false,
                directionNav: zoomOptions.slideshow_arrows,
                animationLoop: true,
                useCSS: true,
                smoothHeight: false,
                touch: countedElements > 1 ? true : false,
                keyboard: false,
                pauseOnAction: true,
                slideshow: !!zoomOptions.slideshow_auto,
                animationSpeed: 300,
                animation: zoomOptions.slideshow_effect.toLowerCase(),
                slideshowSpeed: parseInt(zoomOptions.slideshow_speed, 10),
                start: videoBackground,
                before: videoBackground
            });

            $this.find('.wpzoom-button-video-background-play').on('click', function(e){
                e.preventDefault();
                $(e.currentTarget).parents('li').background('play');
                $this.find('.wpzoom-button-video-background-pause').show();
                $(this).hide();
            });
            $this.find('.wpzoom-button-video-background-pause').on('click', function(e){
                e.preventDefault();
                $(e.currentTarget).parents('li').background('pause');
                $this.find('.wpzoom-button-video-background-play').show();
                $(this).hide();
            });
            $this.find('.wpzoom-button-sound-background-mute').on('click', function(e){
                e.preventDefault();
                $(e.currentTarget).parents('li').background('mute');
                $this.find('.wpzoom-button-sound-background-unmute').show();
                $(this).hide();
            });
            $this.find('.wpzoom-button-sound-background-unmute').on('click', function(e){
                e.preventDefault();
                $(e.currentTarget).parents('li').background('unmute');
                $this.find('.wpzoom-button-sound-background-mute').show();
                $(this).hide();
            });

            $this.find('.popup-video').each(function(){
                var $popupinstance = $(this);
                var $type = $popupinstance.data('popup-type');
                $(this).magnificPopup({
                    disableOn: function() { if( $(window).width() < 0) { return false; } return true; },
                    type: $type,
                    iframe: {
                        patterns: {
                            youtu: {
                                index: 'youtu.be',
                                id: function( url ) {

                                    // Capture everything after the hostname, excluding possible querystrings.
                                    var m = url.match( /^.+youtu.be\/([^?]+)/ );

                                    if ( null !== m ) {

                                        return m[1];

                                    }

                                    return null;

                                },
                                // Use the captured video ID in an embed URL.
                                // Add/remove querystrings as desired.
                                src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0'
                            }
                        }
                    },
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                    callbacks: {
                        beforeOpen : function(first){

                            if( $this.data('flexslider') && $this.data('flexslider').playing){
                                $this.flexslider('pause');
                            }

                            $this.find('.flex-active-slide').background('pause');
                        },
                        open : function(){
                            if($type === 'inline'){
                                var container = $.magnificPopup.instance.contentContainer.first();
                                container.find('video')[0].play();
                            }
                        },
                        beforeClose : function(){
                            if($type === 'inline'){
                                var $video = $(this.content).find('video');

                                if ($video.length) {
                                    var videoElement = $video[0];

                                    var currentSrc = videoElement.currentSrc;
                                    videoElement.pause();
                                    videoElement.currentTime = 0;
                                    videoElement.src = '';
                                    videoElement.src = currentSrc;
                                }
                            }
                        },
                        afterClose: function(){

                            if( $this.data('flexslider') && $this.data('flexslider').playing){
                                $this.flexslider('play');
                            }

                            $this.find('.flex-active-slide').background('play');
                        }
                    }
                });
            });


            $('#slider .slides .li-wrap').css({'margin-top':0,'opacity':0});

            $window.on('resize focus', dynamicHeight);

            dynamicHeight();

            $('#scroll-to-content').on('click', function () {
                $('html, body').animate({
                    scrollTop: $('#slider').offset().top + $('#slider').outerHeight()
                }, 600);
            });

            function dynamicHeight() {
                var height = $(window).height() - $('#slider').offset().top - parseInt($('#slider').css('padding-top'), 10);

                /* use different min-height for different borwser widths */
                if (height < 300) {
                    height = 300;
                } else if (height < 500 && $window.width() > 768) {
                    height = 500;
                }

                $this.find('.slides, .slides > li').height(height);
            }



            function videoBackground(slider) {

                var $slides = slider.find('.slides > li');
                var $currentSlide = $slides.not('.clone').eq(slider.currentSlide);
                var $nextSlide = $slides.not('.clone').eq(slider.animatingTo);

                if($currentSlide.attr('data-background-options') || $nextSlide.attr('data-background-options')) {

                    if($currentSlide.data('fsBackground')){
                        if($currentSlide.data('fsBackground').playing){
                            $currentSlide.background('pause');
                        }
                        $currentSlide.background('unload');
                    }

                    if($nextSlide.data('fsBackground')){
                        $nextSlide.background('load', $nextSlide.data('backgroundOptions').source);
                    } else {
                        $nextSlide.background();
                    }

                    var backgroundAutoplay = $nextSlide.data('fsBackground').autoPlay;
                    var backgroundMute = $nextSlide.data('fsBackground').mute;

                    if(!handHeldDevice){
                        $nextSlide.find('.wpzoom-button-video-background-play')[backgroundAutoplay ? 'hide' : 'show']();
                        $nextSlide.find('.wpzoom-button-video-background-pause')[backgroundAutoplay ? 'show': 'hide']();
                        $nextSlide.find('.wpzoom-button-sound-background-mute')[backgroundMute ? 'hide' : 'show']();
                        $nextSlide.find('.wpzoom-button-sound-background-unmute')[backgroundMute ? 'show': 'hide']();
                    }
                }


                if (slider.vars.animation == 'swing' && typeof slider.direction !== 'undefined') {
                    if (slider.count == slider.currentSlide + 1 && slider.direction == 'next') {
                        $nextSlide = $nextSlide.add(slider.find('.clone:last'));
                    } else if (slider.currentSlide == 0 && slider.direction == 'prev') {
                        $nextSlide = $nextSlide.add(slider.find('.clone:first'));
                    } else {
                        slider.find('.clone .li-wrap').css({ 'margin-top': 0, 'opacity': 0 });
                    }
                }

               /* Text animation for slide that is dissapearing */
               $currentSlide.find('.li-wrap').stop().animate({'margin-top': 0, 'opacity': 0}, 800);

               /* Text animation for slide that is appearing */
               $nextSlide.find('.li-wrap').stop(true, true).css('opacity', 0).animate({'margin-top': '50px', 'opacity': 1}, 800);

            }

        });
    };




    /**
     * Simple Parallax plugin.
     */
    $.fn.paralised = function () {
        var features = {
            bind: !!(function () {
            }.bind),
            rAF: !!(window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame)
        };

        if (typeof features === 'undefined' || !features.rAF || !features.bind) return;

        /**
         * Handles debouncing of events via requestAnimationFrame
         * @see http://www.html5rocks.com/en/tutorials/speed/animations/
         * @param {Function} callback The callback to handle whichever event
         */
        function Debouncer(e) {
            this.callback = e;
            this.ticking = false
        }

        Debouncer.prototype = {
            constructor: Debouncer, update: function () {
                this.callback && this.callback();
                this.ticking = false
            }, requestTick: function () {
                if (!this.ticking) {
                    requestAnimationFrame(this.rafCallback || (this.rafCallback = this.update.bind(this)));
                    this.ticking = true
                }
            }, handleEvent: function () {
                this.requestTick()
            }
        }

        var debouncer = new Debouncer(update.bind(this));

        $(window).on('scroll', debouncer.handleEvent.bind(debouncer));
        debouncer.handleEvent();

        function update() {
            var scrollPos = $(document).scrollTop();

            var $postCover = $('.has-post-cover .entry-cover');
            var $singlePage = $('.featured_page_wrap--with-background');

            if ($postCover.length) {
                var $postCover = $('.entry-cover');
                var postCoverBottom = $postCover.position().top + $postCover.outerHeight();

                if (scrollPos < postCoverBottom) {
                    var x = easeOutSine(scrollPos, 0, 1, postCoverBottom);

                    $postCover.find('.entry-header').css({
                        'bottom': 30 * (1 - x),
                        'opacity': 1 - easeInQuad(scrollPos, 0, 1, postCoverBottom)
                    });
                }
            }

            $singlePage.each(function (i) {
                var $this = $(this);
                var bottom = $this.position().top + $this.outerHeight();

                var inViewport = (scrollPos + $window.height()) > $this.position().top && scrollPos < bottom;

                if (!inViewport) return;

                var x = easeOutSine(scrollPos + $window.height() - $this.position().top, -1, 2, bottom);

                $this.find('.wpzoom-singlepage').css({
                    '-webkit-transform': 'translateY(' + (-x * 80) + 'px)',
                        'moz-transform': 'translateY(' + (-x * 80) + 'px)',
                            'transform': 'translateY(' + (-x * 80) + 'px)'
                });
            });
        }

        function easeOutSine(t, b, c, d) {
            return c * Math.sin(t / d * (Math.PI / 2)) + b;
        }

        function easeInQuad(t, b, c, d) {
            return c * (t /= d) * t + b;
        }
    };

    $.fn.portfolioIsotopeFilter = function () {
        return this.each(function () {
            var $this = $(this);
            var $taxs = $this.find('li');
            var $portfolio = $('.portfolio-grid');



            $(window).load(function () {
                $portfolio.fadeIn().isotope({
                    layoutMode: 'fitRows',
                    itemSelector: 'article'
                }).isotope('layout');
            });


            $portfolio.find('.portfolio-popup-video').magnificPopupCallbackforPortfolios();

            var tax_filter_regex = /cat-item-([0-9]+)/gi;

            $taxs.on('click', function (event) {
                event.preventDefault();

                $this = $(this);

                $taxs.removeClass('current-cat');
                $this.addClass('current-cat');

                var catID = tax_filter_regex.exec($this.attr('class'));
                tax_filter_regex.lastIndex = 0;

                var filter;
                if (catID === null) {
                    filter = '.type-portfolio_item';
                } else {
                    filter = '.portfolio_' + catID[1] + '_item';
                }

                $portfolio.isotope({
                    'filter': filter
                });
            });
        });
    };

    $.fn.fullWidthContent = function () {
        $(window).on('resize', update);

        function update() {
            var windowWidth = $(window).width();
            var containerWidth = $('.entry-content').width();
            var marginLeft = (windowWidth - containerWidth) / 2;

            $('.fullimg').css({
                'width': windowWidth,
                'margin-left': -marginLeft
            });

            $('.fullimg .wp-caption').css({
                'width': windowWidth
            });
        }

        update();
    };

    $.fn.responsiveSliderImages = function () {
        $(window).on('resize orientationchange', update);

        function update() {
            var windowWidth = $(window).width();

            if (windowWidth <= 680) {
                $('#slider .slides li').each(function () {
                    var bgurl = $(this).css('background-image').match(/^url\(['"]?(.+)["']?\)$/);
                    var smallimg = $(this).data('smallimg');

                    if (bgurl) {
                        bgurl = bgurl[1];
                    }

                    if (bgurl == smallimg) return;

                    $(this).css('background-image', 'url("' + smallimg + '")');
                });
            }

            if (windowWidth > 680) {
                $('#slider .slides li').each(function () {
                    var bgurl = $(this).css('background-image').match(/^url\(['"]?(.+)["']?\)$/);
                    var bigimg = $(this).data('bigimg');

                    if (bgurl) {
                        bgurl = bgurl[1];
                    }

                    if (bgurl == bigimg) return;

                    $(this).css('background-image', 'url("' + bigimg + '")');
                });
            }
        }

        update();
    };

    $.fn.sideNav = function() {
        var wasPlaying = false;

        function toggleNav() {
            $('body').toggleClass('side-nav-open').addClass('side-nav-transitioning');

            var flex = $('#slider').data('flexslider');
            if (flex) {
                if ($('body').hasClass('side-nav-open')) {
                    wasPlaying = flex.playing;
                    if (flex.playing)  {
                        flex.pause();
                    }
                } else {
                    if (wasPlaying) {
                        flex.play();
                    }
                }
            }

            var called = false;
            $('.site').one('transitionend', function () {
                $('body').removeClass('side-nav-transitioning');
                called = true;
            });

            setTimeout(function() {
                if (!called) {
                    $('body').removeClass('side-nav-transitioning');
                }

                $window.trigger('resize');
            }, 230);
        }

        /* touchstart: do not allow scrolling main section then overlay is enabled (this is done via css) */
        $('.navbar-toggle, .side-nav-overlay').on('click touchend', function (event) {
            if ($(document.body).hasClass('side-nav-transitioning')) {
                return;
            }

            toggleNav();
        });

        /* allow closing sidenav with escape key */
        $document.keyup(function (event) {
            if (event.keyCode == 27 && $('body').hasClass('side-nav-open')) {
                toggleNav();
            }
        });

        /**
         * ScrollFix
         *
         * https://github.com/joelambert/ScrollFix
         */
        $('.side-nav__scrollable-container').on('touchstart', function (event) {
            var startTopScroll = this.scrollTop;

            if (startTopScroll <= 0) {
                this.scrollTop = 1;
            }

            if (startTopScroll + this.offsetHeight >= this.scrollHeight) {
                this.scrollTop = this.scrollHeight - this.offsetHeight - 1;
            }
        });
    };

    $.fn.singlePageWidgetBackground = function() {
        $('.featured_page_wrap[data-background]').each(function () {
            var $this = $(this);
            $this.css('background-image', 'url(' + $this.data('background') + ')');
            $this.addClass('featured_page_wrap--with-background');
        });
    };

    $.fn.sbSearch = function() {

    /* allow closing sidenav with escape key */
    $document.keydown(function (event) {

        if (event.keyCode == 27 && $('#sb-search').hasClass('sb-search-open')) {
            $( "#sb-search" ).removeClass( "sb-search-open" )
        }

    });

       return this.each(function() {
           new UISearch( this );
       });
    };


})(jQuery);