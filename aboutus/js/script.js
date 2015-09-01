/*
    =================================================================
    MAIN JAVASCRIPT
    =================================================================
    @project         Smultron
    @date            2014-12-10
    @company         Smultron
    =================================================================
*/

/*global $, document, window, setInterval, clearInterval, setTimeout, clearTimeout, google*/

// @prepros-prepend "plugins.js"

(function ($) {

window.Smultron = {
    init: function () {
        var self = this;

        $('body').addClass('no-dragging');

        this.eucookie();
        this.navigation();
        this.morphNavigation();
        this.headerSetup();
        this.testimonials();
        this.contact();
        this.popups();
        this.hashNav();
        this.scrollSpy();

        if (! window.smultron.isMobile) {
            this.waypoints();
        }

        this.isMobile = window.smultron.isMobile;

        new this.ui.DragGallery( $('.portfolioGallery'), {
            rowCount: 2,
            isMobile: self.isMobile
        } );
        new this.ui.DragGallery( $('.teamGallery'), {
            rowCount: 1,
            isMobile: self.isMobile
        } );
    },

    ui: {},

    eucookie: function () {
        function SetCookie (c_name,value,expiredays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + expiredays);
            document.cookie = c_name + "=" + escape(value) + ";path=/" + ((expiredays==null) ? "" : ";expires=" + exdate.toGMTString());
        }

        if ( document.cookie.indexOf("eucookie") === -1 ) {
            $('.euCookies').show();
        }

        $('.js-closeCookie').on('click', function () {
            SetCookie('eucookie','eucookie',365*10);
            $('.euCookies').slideUp(300, function () {
                $(this).remove();
            });
        });
    },

    navigation: function () {
        var navi1 = $('.naviHead'),
            navTrigger1 = $('#navTrigger1');

        navTrigger1.on('click', function (e) {
            e.preventDefault();

            if (! navi1.hasClass('expanded')) {
                navi1.addClass('expanded');
            } else {
                navi1.removeClass('expanded');
            }
        });

        navi1.on('click', 'li a', function () {
            navi1.removeClass('expanded');
        });

        $('.menu a').on('click', function () {
            if ( $(window).width() < 768 ) {
                $('.expanded').removeClass('expanded');
                $('body').removeClass('fixexpanded');
            }
        });
    },

    morphNavigation: function () {
        var self = this;

        var fixedNav = $('.fixedNav');

        var morphEl = $('#morphShape').get(0),
            s = Snap( $(morphEl).find('svg').get(0) ),
            path = s.select( 'path' ),
            initialPath = path.attr('d'),
            pathOpen = morphEl.getAttribute( 'data-morph-open' ),
            isAnimating = false;

        var navContainer = $('.fixedNav .navContainer');

        $('#navTrigger2').on('click', function (e) {
            e.preventDefault();

            if (fixedNav.hasClass('expanded')) {
                fixedNav.removeClass('expanded');
                $('body').removeClass('fixexpanded');

                path.animate( { 'path' : initialPath }, 400, mina.easeinout, function() { isAnimating = false; } );
            } else {
                fixedNav.addClass('expanded');
                $('body').addClass('fixexpanded');

                path.animate( { 'path' : pathOpen }, 400, mina.easeinout, function() { isAnimating = false; } );
            }
        });
    },

    hashNav: function () {
        var self = this;
        var fixedNav = $('.fixedNav');

        $('body').on('click', 'a[href^="#"]', function (e) {
            e.preventDefault();
            var me = $(this);

            var thisHash = me.attr('href');
            var target = $(thisHash);

            var additionalOffset = fixedNav.hasClass('expanded') ? 76 : 0;

            if (thisHash === '#co_robimy' || thisHash === '#whatwedo') {
                additionalOffset = 0;
            }

            if (target.length) {
                self.scrolling = true;
                TweenLite.to('body, html', 1, {
                    scrollTop: target.offset().top - additionalOffset,
                    onComplete: function () {
                        window.location.hash = thisHash;
                        $('html, body').scrollTop(target.offset().top - additionalOffset);
                        self.scrolling = false;
                    }
                });
            }
        });

        $('#homeTrigger').on('click', function (e) {
            e.preventDefault();
            TweenLite.to('body, html', 1, {
                scrollTop: 0,
                onComplete: function () {
                    window.location.hash = '';
                }
            });
        });
    },

    waypoints: function () {
        var self = this;
        var ico1 = $('.whatwedo #frontend'),
            ico2 = $('.whatwedo #backend'),
            ico3 = $('.whatwedo #mobi'),
            contactData = $('.contactData'),
            contactForm = $('.contactForm'),

            content = $('main');
            testimonials = $('.testimonials');

        ico1.waypoint({
            handler: function (direction) {
                ico1.find('i').addClass('animated fadeInLeft');
                ico1.find('.animc').addClass('animated fadeInRight');
            },
            offset: '80%'
        });

        ico2.waypoint({
            handler: function (direction) {
                ico2.find('i').addClass('animated fadeInLeft');
                ico2.find('.animc').addClass('animated fadeInRight');
            },
            offset: '80%'
        });

        ico3.waypoint({
            handler: function (direction) {
                ico3.find('i').addClass('animated fadeInLeft');
                ico3.find('.animc').addClass('animated fadeInRight');
            },
            offset: '80%'
        });

        contactData.waypoint({
            handler: function (direction) {
                contactData.addClass('animated fadeInLeft');
                contactForm.addClass('animated fadeInRight');
            },
            offset: '67%'
        });
    },

    scrollSpy: function () {
        var self = this;
        var items = ['.whatwedo', '.projects', '.team', '.contact'],
            offsets = [],
            navItems = $('.fixedNav .menu a'),
            currentIndex = 0;

        navItems.on('click', function () {
            navItems.removeClass('current');
            $(this).addClass('current');
        });


        function countOffsets () {
            offsets = [];
            items.forEach(function (item, index) {
                offsets.push( $(item).offset().top - 100 );
            });
        }
        countOffsets();

        function updateSpy (st) {
            var newIndex = '';
            offsets.forEach(function(offset, index) {
                if (st > offset) {
                    newIndex = index
                }
                if (st < offsets[0]) {
                    currentIndex = '';
                    navItems.removeClass('current');
                }
            });

            if (newIndex !== currentIndex) {
                currentIndex = newIndex;
                navItems.removeClass('current');
                navItems.eq(newIndex).addClass('current');
            }
        }

        $(window).on('resize', countOffsets);
        $(window).on('scroll', function () {
            var st = $(window).scrollTop();
            if (! self.scrolling) {
                updateSpy(st);
            }
        });
    },

    headerSetup: function () {
        // console.log('header setup');
        var header = $('.pageHeader'),
        	eucookie = $('.euCookies'),
            resizeTimer = '',
            fixedNav = $('.fixedNav'),
            offTop = 0;

        function doIt () {
            var wh = $(window).height(),
                ww = $(window).width(),
                euch = 0;

            if (eucookie) {
            	euch = eucookie.height();
            }

            // if (ww >= 650) {
            //     offTop = wh > 400 ? (wh + euch) : 400;
            //     header.css({
            //         height: wh > 400 ? wh : 400
            //     });
            // } else {
            //     header.removeAttr('style');
            //     offTop = header.outerHeight() + euch;
            // }

            offTop = wh > 400 ? (wh + euch) : 400;
            header.css({
                height: wh > 400 ? wh : 400
            });
        }
        doIt();

        $('.whatwedoSimple-item').on('mouseenter', function () {
            var me = $(this);
            if (! me.hasClass('hovered')) {
                me.addClass('hovered');
            }
        });

        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(doIt, 300);
        });

        function fixNav () {
            var st = $(window).scrollTop();
            if (st > offTop && ! fixedNav.hasClass('fixed')) {
                fixedNav.addClass('fixed');
            }
            if (st <= offTop && fixedNav.hasClass('fixed')) {
                fixedNav.removeClass('fixed');
            }
        };

        fixNav();
        $(window).on('scroll', function () {
            fixNav();
        });
    },

    testimonials: function () {
        var self = this;
        self.tcarousel = $('.testimonialsList');
        self.tcarousel.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 12000,
            autoplaySpeed: 1000,
            navSpeed: 1000,
            autoHeight: false,
            mouseDrag: false
        });
        // self.tcarousel.trigger('stop.owl.autoplay');
    },

    contact: function () {
        var gmap = $('#gmap');
        var mapStyle = [
            {
                "stylers": [
                    { "visibility": "on" }, { "hue": "#0091ff" }, { "lightness": 45 }, { "saturation": -51 }
                ]
            }
        ];

        if (gmap.length) {
            var mapConfig = {
                mapStyles: mapStyle,
                lat: 50.063879,
                lng: 19.937382,
                markers: [
                    {
                        lat: 50.063879,
                        lng: 19.937382
                    }
                ],
                disableDefaultUI: false,
                scrollwheel: false,
                infoWindowTemplate: 'Smultron Software House<br />Sławkowska 12, Kraków',
                icon: '/wp-content/themes/smultron2014/img/ico-marker.png'
            }
            new PUI.Gmap(gmap, mapConfig);
        }
    },

    popups: function () {
        $('.popup').magnificPopup({
            type: 'ajax',
            callbacks: {
                parseAjax: function (mfpResponse) {
                    // mfpResponse.data = $(mfpResponse.data).find('#ajaxContent');
                },
                updateStatus: function( data ) {
                    if( data.status === 'ready' ) {
                        if ( $( '.jobForm' ).length > 0 ) {
                            $( '[type="file"]' ).on( 'change', AddNextFileInput );
                            $( '.jobForm' ).find('form').each(function(index, el) {
                                PrepereForms( $( el ) );
                            });
                            $( '.js-file-input-delete' ).on( 'click', DeleteFileInput );
                        }
                    }
                }
            }
        });
    },
};



Smultron.ui.DragGallery = function (el, conf) {
    var self = this;
    self.el = el;
    self.b = $('body');
    self.w = $(window);
    self.conf = {
        isMobile: conf.isMobile,
        showArrows: true,
        draggerWidth: 40,
        arrowWidth: 40,
        rowCount: 1
    };
    self.els = {
        // dragger: self.el.find('.dragGallery-dragger'),
        grid: self.el.find('.dragGallery-grid'),
        gridItems: self.el.find('.gridItem'),
        gridSubItems: self.el.find('.gridSubItem')
    };
    self.flags = {
        dragging: false,
        hasEmpty: self.els.gridItems.filter('.empty')
    };
    self.calcs = {
        offsetLeft: self.conf.showArrows ? self.conf.arrowWidth + (0.75 * self.conf.draggerWidth) : (0.75 * self.conf.draggerWidth),
        offsetRight: self.conf.showArrows ? self.conf.arrowWidth + (0.75 * self.conf.draggerWidth) : (0.75 * self.conf.draggerWidth),
        gridWidth: 0,
        itemsInRow: self.els.gridItems.length,
        subItemsLength: self.els.gridSubItems.length
    };

    $.extend(self.conf, conf);

    self.currentIndex = 0;

    self.scrollPosition = {
        value: self.calcs.offsetLeft
    };


    /**
    @function ? recalculate and reset grid after window resize
    */
    self.resize = function () {
        var resizeTimer;

        function doIt () {
            // kill tweens and reset scrollposition
            var itemsInRow = self.calcs.itemsInRow;
            TweenLite.killTweensOf(self.scrollPosition);
            self.calcs.scrollPosition = self.calcs.offsetLeft;
            self.calcs.windowWidth = self.w.width();

            if (self.calcs.windowWidth < 599 && self.flags.hasEmpty.length) {
                itemsInRow = self.calcs.itemsInRow - 1;
            }

            self.moveDragger({
                clientX: self.calcs.scrollPosition,
                duration: 0
            });

            self.calcs.draggerMax = self.w.width() - self.calcs.offsetRight;

            self.calcs.itemWidth = self.els.gridItems.eq(0).width();

            self.calcs.gridWidth = itemsInRow * self.calcs.itemWidth;
            self.els.grid.css({
                width: self.calcs.gridWidth
            });

            // hide controls when not needed
            if (self.calcs.windowWidth > self.calcs.gridWidth) {
                self.els.controls.hide();
            } else {
                self.els.controls.show();
            }
        }

        doIt();

        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(doIt, 250);
        });
    };


    /**
    @function responsible for moving the dragger and updating grid position
    @param {Object} conf - configuration obj with properties: clientX
    */
    self.moveDragger = function (conf) {
        TweenLite.to(self.scrollPosition, conf.duration, {
            value: Math.max(self.calcs.offsetLeft, Math.min(self.calcs.draggerMax, conf.clientX)),
            onUpdate: self.moveGrid
        });
    };


    /**
    @function ? move the grid
    */
    self.moveGrid = function () {
        self.gridOffset = -(self.scrollPosition.value - self.calcs.offsetLeft) * (self.calcs.gridWidth - self.w.width()) / (self.w.width() - self.calcs.offsetLeft - self.calcs.offsetRight);

        TweenLite.to(self.els.dragger, 0, {
            x: self.scrollPosition.value
        });

        TweenLite.to(self.els.grid, 0, {
            x: self.gridOffset
        });

        self.els.gridItems.each(function(e) {
            var me = $(this);
            var r = me.data("num") % self.calcs.itemsInRow * self.calcs.itemWidth + self.gridOffset;
            var n = 0;
            var h = 400;

            if (r > -h + n && r < self.w.width() - n) {
                if (me.attr("data-visible") == "0") {
                    me.attr("data-visible", "1"), TweenLite.killTweensOf(me);
                    var i = r > self.w.width() * .5 ? "left" : "right",
                        s = r > self.w.width() * .5 ? 90 : -90;
                    TweenLite.to(me.find('> *'), 0, {
                        rotationY: s,
                        alpha: .3,
                        transformPerspective: 800,
                        transformOrigin: i + " center"
                    }), TweenLite.to(me.find('> *'), .4, {
                        rotationY: 0,
                        alpha: 1,
                        transformPerspective: 800,
                        transformOrigin: i + " center",
                        delay: .12
                    })
                }
            } else me.attr("data-visible") == "1" && me.attr("data-visible", "0");
        });
    };


    /**
    @function ? moves the grid by specific amnt
    */
    self.slideGrid = function (direction) {
        TweenLite.killTweensOf(self.scrollPosition);

        var rowsCompensation = 1,
            gridWidth = self.calcs.gridWidth;

        if (self.conf.rowCount == 2 && self.w.height() < 580) {
            rowsCompensation = 0.5;

            // if (self.calcs.subItemsLength % 2 !== 0) {
            //  gridWidth = self.calcs.gridWidth - (0.5 * self.calcs.itemWidth);
            // }
        }

        var visibleItemsWidth = (Math.ceil(self.w.width() / self.calcs.itemWidth) - 1) * self.calcs.itemWidth;
        if (visibleItemsWidth == 0) {
            visibleItemsWidth = self.calcs.itemWidth;
        }
        var draggerToMove = self.scrollPosition.value + direction * rowsCompensation * ( visibleItemsWidth * (self.w.width() - self.calcs.offsetLeft - self.calcs.offsetRight) / (gridWidth - self.w.width()) );

        self.moveDragger({
            clientX: draggerToMove,
            duration: 0.8
        });
    };

    /**
    @function ? disables dragging state of dragger when triggered
    */
    self.mouseup = function () {
        self.w.off('.dragger');
        self.flags.dragging = false;
        self.b.removeClass('dragged').addClass('no-dragging');
    };

    self.build = function () {
        var buildCode = '<div class="dragControls">';

        buildCode += '<div class="dragGallery-dragger"></div><div class="dragGallery-track"></div>'

        if (self.conf.showArrows) {
            buildCode += '<div class="dragGallery-prev"></div><div class="dragGallery-next"></div>';
        }
        buildCode += '</div>';

        self.el.append(buildCode);

        self.els.dragger = self.el.find('.dragGallery-dragger');
        self.els.prev = self.el.find('.dragGallery-prev');
        self.els.next = self.el.find('.dragGallery-next');
        self.els.controls = self.el.find('.dragControls');

        self.els.gridItems.each(function () {
            var me = $(this),
                val = me.data('num') % self.calcs.itemsInRow * self.calcs.itemWidth;

            me.attr('data-visible', val > self.w.width() ? '0' : '1');
        });
    }



    /**
    @function ? init
    */
    self.init = function () {
        self.build();
        self.resize();

        // imitate dragger drag behavior
        if (self.conf.isMobile) {
            // imitate dragger drag behavior

            self.els.dragger.on('touchstart', function () {
                self.flags.dragging = true;
                self.b.addClass('dragged').removeClass('no-dragging');

                self.w.off('.dragger');

                self.w.on('touchmove.dragger', function (e) {
                    self.moveDragger({
                        clientX: e.originalEvent.touches[0].pageX,
                        duration: 0.8
                    });
                    return false;
                });

                self.w.on('selectionstart.dragger', function () {
                    return false;
                });

                self.w.on('touchend', self.mouseup);
            });
        } else {
            // imitate dragger drag behavior
            self.els.dragger.on('mousedown', function () {
                self.flags.dragging = true;
                self.b.addClass('dragged').removeClass('no-dragging');

                self.w.off('.dragger');

                self.w.on('mousemove.dragger', function (e) {
                    self.moveDragger({
                        clientX: e.clientX,
                        duration: 0.8
                    });
                    return false;
                });

                self.w.on('selectionstart.dragger', function () {
                    return false;
                });

                self.w.on('mouseup', self.mouseup);
            });
        }

        self.els.prev.on('click', function () {
            self.slideGrid(-1);
        });
        self.els.next.on('click', function () {
            self.slideGrid(1);
        });

        self.moveDragger({
            clientX: self.calcs.offsetLeft,
            duration: 0
        });

    };

    self.init();
}




window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60);
    };
})();

var Pcs = {
    pcs: [],

    Particle: function (type, bgc) {
        this.type = type;
        this.opacity = 0.3;
        this.rgb = bgc;
        this.bgc = 'rgba(' + bgc + ', ' + this.opacity + ')';
    },
    FPS: function (container) {
        this.counter = 0;
        this.container = container;

        this.tick = function () {
            this.counter++;
        };
        this.result = function () {
            this.container.html('FPS: ' + this.counter);
            this.counter = 0;
        };
        this.init = function () {
            var self = this;
            setInterval(function () {
                self.result.call(self);
            }, 1000);
        };
        this.init();
    },
    particleProto: {
        _getRandom: function () {
            return Math.random() * 2 - 1;
        },
        config: {
            speedFactor: 5
        },

        init: function () {
            this.x = Math.random() * Pcs.canvas.width;
            this.y = Math.random() * Pcs.canvas.height;
            this.r = 3;
            this.vx = this._getRandom() * this.config.speedFactor;
            this.vy = this._getRandom() * this.config.speedFactor;
            this.max_vx = this.vx * 10;
            this.max_vy = this.vy * 10;
            this.orig_vx = Math.abs(this.vx);
            this.orig_vy = Math.abs(this.vy);

            this.kicked = false;
            this.flykicked = false;

            // console.log(this.vx, this.vy);

            this.rot_val = this._getRandom();
            this.rdir = Math.random() > 0.5 ? 1 : -1;
            this.rot_speed = Math.random() * 0.02;
            this.lastTime = (new Date()).getTime();
        },

        draw: function () {
            Pcs.ctx.save();
            if (this.type == 0) {
                var side = 2 * this.r;
                var h = side * (Math.sqrt(3)/2);
                Pcs.ctx.save();
                Pcs.ctx.translate(this.x, this.y);
                Pcs.ctx.rotate(this.rdir * this.rot_val);
                Pcs.ctx.beginPath();
                Pcs.ctx.moveTo(0, -(2/3) * h);
                Pcs.ctx.lineTo(-0.5 * side, (1/3) * h);
                Pcs.ctx.lineTo(0.5 * side, (1/3) * h);
                Pcs.ctx.lineTo(0, -(2/3) * h);
                Pcs.ctx.closePath();
                Pcs.ctx.fillStyle = this.bgc;
            }
            if (this.type == 1) {
                Pcs.ctx.translate(this.x, this.y);
                Pcs.ctx.rotate(this.rdir * this.rot_val);
                Pcs.ctx.beginPath();
                Pcs.ctx.rect(-1 * this.r, -1 * this.r, this.r * 2, this.r * 2);
                Pcs.ctx.closePath();
                Pcs.ctx.fillStyle = this.bgc;
            }
            if (this.type == 2) {
                Pcs.ctx.beginPath();
                Pcs.ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
                Pcs.ctx.closePath();
                Pcs.ctx.fillStyle = this.bgc;
            }
            Pcs.ctx.fill();
            Pcs.ctx.restore();
        },

        update: function () {
            this.now = (new Date()).getTime();
            this.dt = (this.now - this.lastTime) / 1000;
            if (this.flykicked) {
                this.x += (this.new_x - this.x) / 10;
                this.y += (this.new_y - this.y) / 10;
            } else {
                this.x += (this.vx * this.dt);
                this.y += (this.vy * this.dt);
            }

            // if ( (this.new_x - this.x) < 1 || (this.new_y - this.y) < 1 ) {
            //     this.flykicked = false;
            // }

            this.lastTime = this.now;

            this.rot_val += this.rot_speed;
            if (this.rot_val >= 2 * Math.PI) {
                this.rot_val = 0;
            }

            var xDist = Math.abs(this.x - Pcs.cX),
                yDist = Math.abs(this.y - Pcs.cY);

            if (xDist < 20 && yDist < 20) {
                // this.r = 10;
                this.opacity = 1;
                this.bgc = 'rgba(' + this.rgb + ', ' + this.opacity + ')';
            } else {
                if (this.r < Pcs.maxR[this.type]) {
                    this.r += this.r * 0.02;
                }
                if (this.r > Pcs.maxR[this.type]) {
                    this.r -= this.r * 0.02;
                }
            }

            if (this.opacity < Pcs.opacity[this.type]) {
                this.opacity = this.opacity + 0.02;
                this.bgc = 'rgba(' + this.rgb + ', ' + this.opacity + ')';
            }
            if (this.opacity > Pcs.opacity[this.type]) {
                this.opacity = this.opacity - 0.02;
                this.bgc = 'rgba(' + this.rgb + ', ' + this.opacity + ')';
            }

            if (this.x < 0 || this.x > Pcs.cWidth) {
                this.vx *= -1;
            }
            if (this.y < 0 || this.y > Pcs.cHeight) {
                this.vy *= -1;
            }

            if ((this.x < -25 || this.x > Pcs.cWidth + 25) || (this.y < -25 || this.y > Pcs.cHeight + 25)) {
                this.init();
            }
        }
    },
    createParticles: function (howmany, type, bgc) {
        var self = this;

        for (var i = 0; i < howmany; i++) {
            var p = new self.Particle(type, bgc);
            p.init();
            self.pcs.push(p);
        }
    },
    updateParticles: function () {
        var self = this;
        // self.fps.tick();
        self.ctx.clearRect(0, 0, self.canvas.width, self.canvas.height);

        for (var i = 0; i < self.pcs.length; i++) {
            self.pcs[i].update()
            self.pcs[i].draw();
        }

        requestAnimFrame(function () {
            self.updateParticles.call(self);
        });
    },
    loop: function () {
        var self = this;

        requestAnimFrame(function () {
            self.updateParticles.call(self);
        });
    },
    destroy: function () {
        this.pcs = [];
    },
    updateCanvas: function () {
        var self = this,
            canvas = $(self.canvas);

        canvas.attr('width', $(window).width());
        canvas.attr('height', $(window).height());

        self.cWidth = self.canvas.width;
        self.cHeight = self.canvas.height;

        $.each(self.pcs, function (index, el) {
            el.init();
        });
    },
    interact: function () {
        var self = this;
        self.maxR = [3, 3, 3];
        self.opacity = [0.3, 0.3, 0.3];
        // self.minopacity = [0.1, 0.1, 0.1];

        $('.whatwedoSimple-item').on('mouseenter', function (e) {
             var me = $(this),
                 type = me.data('type');

             me.addClass('active');
             // self.maxR[type] = 10;
             self.opacity = [0.1, 0.1, 0.1];
             self.opacity[type] = 1;
        });

        $('.whatwedoSimple-item').on('mouseleave', function () {
             var me = $(this),
                 type = me.data('type');

             me.removeClass('active');
             // self.maxR[type] = 3;
             // self.opacity[type] = 0.3;
             self.opacity = [0.3, 0.3, 0.3];
        });

        $('body').on('mousemove', function (e) {
            self.last_cX = self.cX || 0;
            self.last_cY = self.cY || 0;

            self.cX = e.pageX;
            self.cY = e.pageY;

            self.dX = self.cX - self.last_cX;
            self.dY = self.cY - self.last_cY;
        });
    },

    init: function () {
        var self = this,
            resizeTimer;

        self.canvas = document.getElementById('pixie');
        self.ctx = document.getElementById('pixie').getContext('2d');

        self.updateCanvas();
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                self.updateCanvas.call(self);
            }, 200);
        });

        $.extend(this.Particle.prototype, this.particleProto);

        // self.createParticles(175, 0, '#552820');
        self.createParticles(175, 0, '228, 78, 39');
        // self.createParticles(175, 1, '#224155');
        self.createParticles(175, 1, '52, 155, 163');
        // self.createParticles(175, 2, '#494d1c');
        self.createParticles(175, 2, '186, 198, 25');
        // self.fps = new self.FPS( $('#fps') );
        self.interact();
        self.loop();
    },
};



$(document).ready(function() {
    Smultron.init();

    if (! window.smultron.isMobile) {
        Pcs.init();
    }

    PrepereForms( '#fContact' );
});



































    function PrepereForms ( form_el ) {
        $( form_el ).validVal( {
            validate : {
                onKeyup: true
            },
            form: {
                onInvalid: function( $fields, language ) {
                    $fields.each( function(){
                        $( this ).addClass( 'invalid' );

                    } );
                },
                onValid: function( $fields, language ) {
                    $( '.spinner' ).addClass( 'active' );
                    if ( window.FormData === undefined && ( $( form_el ).find( '[type="file"]' ).filter( function (){ return this.value } ).length !== 0 ) ) {
                        //console.log( 'iframe' )
                        $( $( form_el ).find( 'iframe' )[ 0 ] ).off().on( 'load', function(){
                            $( '.spinner' ).removeClass( 'active' );
                            var IS_JSON = true;
                            try {
                                var ret = $.parseJSON( uploadDone( $( this ).attr( 'id' ) ) );
                            }
                            catch( err ) {
                                IS_JSON = false;
                            }
                            if ( IS_JSON && ret.res == 1 ) {
                                CleanFileInputs( form_el );
                                $( form_el ).trigger( 'resetForm' );
                                DisplayFeedBack( form_el.find( '.form-feedback' ), ret.feedback );
                            }
                            else {
                                DisplayFeedBack( form_el.find( '.form-feedback' ), AjaxOptions.FailureMessage, 'error' );
                            }

                        });
                    }
                    else {
                        AjaxMailer( $( this ) );
                    }
                }
            }
        })

        if ( window.FormData !== undefined || ( $( form_el ).find( '[type="file"]:empty' ).length == 0 ) ) {
            $( form_el ).on( 'click', '[type="submit"]', function( e ) {
                e.preventDefault();
                $( this ).closest( 'form' ).triggerHandler( "submitForm.vv" );
            });
        }
    }


    function AjaxMailer( form ) {
        form.find( '.form-feedback' ).removeClass( 'active' );

        if ( window.FormData !== undefined ) {
            //console.log( 'FormData' );
            var ContentType = false;
            var data = new FormData();
            var file_input = form.find( '[type="file"]' );
            var files = new Array();
            if ( file_input.length > 0 ) {
				$( file_input ).each( function( index, input ) {
                    $( $( input )[0].files ).each( function( i, file ) {
                        files.push( file );
                    });
                } );
                $( files ).each(function(index, file) {
    				data.append( 'file_' + index, file );
                });
            }

            var other_data = form.serializeArray();

            $.each( other_data,function( key,input ){
                data.append( input.name, input.value );
            });

        }
        else {
            //console.log( 'ajax clasic' );
            var ContentType = 'application/x-www-form-urlencoded; charset=UTF-8';
            var data = form.serialize();
            data = data  +'&action=custom_contact_mailer';
        }

        //console.log( data )

        $.ajax({
            dataType: "json",
            cache: false,
            type: "POST",
            contentType: ContentType,
            processData: false,
            url: AjaxOptions.AjaxUrl,
            data: data,
            success: function( ret ) {
                if ( ret.res == 1 ) {
                    $( form ).trigger( 'resetForm' );
                    CleanFileInputs( form );
                }
                DisplayFeedBack( form.find( '.form-feedback' ), ret.feedback );
            },
            error: function(ret){
                DisplayFeedBack( form.find( '.form-feedback' ),  AjaxOptions.FailureMessage, 'error' );
            },
            complete: function (ret) {
                $( '.spinner' ).removeClass( 'active' );
            }
        });
    }

    function uploadDone( name ) {
       var frame = getFrameByName(name);
       if (frame) {
         ret = frame.document.getElementsByTagName("body")[0].innerHTML;
         return ret;
      }
    }

    function getFrameByName( name ) {
        for ( var i = 0; i < frames.length; i++ ) {
            if ( frames[ i ].name == name ) {
                return frames[ i ];
            }
        }
        return null;
    }


    function AddNextFileInput() {
        var next_number = $( this ).data( 'number' ) + 1;
        var next_input  = $( this ).siblings( '[data-number]' );

        var current_input = $( this );

        // ciężar pliku
        var feedback_element = $( this ).closest( 'form' ).find( '.form-feedback' );
        $( $( this )[ 0 ].files ).each(function(index, el) {
            if ( el[ 'size' ] > 20000000 ) {
                DisplayFeedBack( feedback_element, 'Za duży plik.', 'error' );
                current_input.val( '' );
            }
        });

        if ( $( this ).val() && next_input.length == 0 ) {

            var new_input =  $( '<div class="fileInputCont"><span class="js-file-input-delete" title="Usuń załącznik">×</span><div class="fileInput"><span class="file-input-label"><i class="ico-file"></i><span>dodaj załącznik</span></span><input type="file" name="file_' + next_number + '" data-number="' + next_number + '" class="upload" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.pdf"/></div></div>' )
            new_input.find( '[type="file"]' ).on( 'change', AddNextFileInput );
            new_input.find( '.js-file-input-delete' ).on( 'click', DeleteFileInput );
            new_input.insertAfter( $( this ).closest( '.fileInputCont' ) )
        }
        if ( $( this ).val() ) {
            $( this ).prop( 'disabled', true ).css( 'cursor', 'default' );
            $( this ).siblings( '.file-input-label' ).find( 'span' ).text( $( this ).val().split(/[\\/]/).pop() );
            $( '.upload:disabled' ).closest( '.fileInputCont' ).addClass( 'deletable' );
        }
        else {
            $( this ).siblings( '.file-input-label' ).find( 'span' ).text( 'dodaj załącznik' );
        }
    }

    function DeleteFileInput () {
        $( this ).closest( '.fileInputCont' ).remove();
    }

    function DisplayFeedBack( feedback_element, feedback_message, feedback_class ) {

        if ( feedback_class == null ) {
            feedback_class = 'active';
        }
        else {
            feedback_class = feedback_class + ' active';
        }

        feedback_element.text( feedback_message ).addClass( feedback_class  ).animate( { height: '2em' } );
        setTimeout( function() {
            feedback_element.animate(
                { height: 0 },
                function(){
                    $( this ).text( '' ).removeClass( feedback_class )
                }
            );
        }, 6000 );
    }

    function CleanFileInputs ( form ) {
        if ( $( form ).find( '.fileInputCont' ).length > 0 ) {
            $( form ).find( '.fileInputCont:not(:first-child)' ).each( function( index, el ) {
                $( el ).remove();
            });
            $( form ).find( '.fileInputCont:first-child').removeClass( 'deletable' );
            $( form ).find( '.fileInputCont:first-child').find( '.upload' ).prop( 'disabled', false ).val( '' )
            $( form ).find( '.fileInputCont:first-child .file-input-label span' ).text( 'dodaj załącznik' )
        }
    }


})(jQuery);