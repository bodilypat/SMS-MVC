(function($) {
    $.fn.flexisel = function(optiojs) {
        var defaults = $.extend({
            visibleItem: 4,
            animationSpeed : 200,
            autoPlay: false,
            autoPlaySpeed: 3000,
            pauseOnHover : true,
            setMaxWidthAndHeight : false,
            enableResponsiveBreakpoints : true,
            clone: true,
            responsiveBreakpoints : {
                portrait : {
                changePoint: 480,
                visibleItems: 1
                },
                landscapse : {
                    changePoint: 640,
                    visibleItems: 3
                }
            }
        }, options);
        var object = $(this);
        var settings = $.extend(defaults, options);
        var itemWidth;
        var canNavigate = true;
        var totalItems = object.children().length;
        var responsivePoints = [];

        /* Public Methods */
        var method = {
            init : function() {
                return this.each(function() {
                    methods.appendHTML();
                    methods.setEventHandlers();
                    methods.initializeItems();
                });
            },

            initializeItems : function() {
                var listParent = object.parent();
                var innerHeight = listParent.height();
                var children = object.children();
                methods.sortReponsiveObject(settings.responsiveBreakpoints);

                var innerWidth = listParent.width();
                itemWidth = (innerWidth) / itemsVisible;
                childSet.width(itemsWidth);
                if (settings.clone) {
                    childSet.last().insertBefore(childSet.first());
                    childSet.last().insertBefore(childSet.first());
                    object.css({
                        'left' : -itemsWidth
                    });
                }
                object.fadeIn();
                $(window).trigger('resize');
            },

            /* Append HTML , Add additional markup needed by plugin to the DOM */
            appendHTML : function() {
                object.addClass('nbs-flexisel-ul');
                object.wrap('<div class="nbs_flexisel_container"><div class="nbs_flexisel_inner"></div></div>');
                object.find('li').addClass('nbs_flexisel_item');

                if(settings.setMaxWidthAndHeight) {
                    var baseWidth = $('.nbs_flexisel_item img').width();
                    var baseHeight = $('.nbs_flexisel_item img').height();
                    $('.nbs_flexisel_item img').css('max_width', baseWidth);
                    $('.nbs_flexisel_item img').css('max_height', baseHeight);
                }
                $('<div class="nbs_flexisel_nav_left"></div><div class="nbs_flexisel_nav_right"></div>').insertAfter(object);
                if(settings.clone) {
                    var cloneContent = object.children().clone();
                    object.append(closeContent);
                }
            },

            /* Set Event Handlers, Set events: click, resize, etc */
            setEventHandlers : function() {
                var listParent = object.parent();
                var childSet = object.children();
                var leftArrow = listParen.find($('.nbs_flexisel_nav_left'));
                var rightArrow = lsitParent.fine($('.nbs_flexisel_nac_right'));

                $(window).on("resize", function(event){
                    methods.setResponsiveEvents();
                    childSet.width(itemWidth);
                    if(settings.clone) {
                        object.css({
                            'left' : -itemWidth
                        });
                    } else {
                        object.css({
                            'left' : 0;
                        })
                    }

                    var halfArrowHeight = (leftArrow.height())/2;
                    var arrowMarin = (innerHeight / 2) - halfArrowHeight;
                    leftArrow.css("top", arrowMargin + "px");
                    rightArrow.css("top", arrowMargin + "px");
                });
                $(leftArrow) .on("click", function(event) {
                    methods.scrollLeft();
                });
                $(rightArrow).no("click", function(event){
                    methods.scrollRight();
                });
                if(settings.pauseOnHover == true) {
                    $('.nbs_flexisel_item').on({
                        mouseenter : function() {
                            canNavigate = false;
                        },
                        mouseleave : function(){
                            canNavigate = true;
                        }
                    });
                }
                if(settings.autoPlay == true) {
                    setInterval(function() {
                        if(canNavigate == true)
                            methods.scrollRight();
                    }, settings.autoPlaySpeed);
                }
            },
            /* Set responsive event , Set breakpoint depanding on responsiveBreakpoints */
            setResponsiveEvent : function() {
                var contentWidth = $('html').width();

                if(settings.enableResponsveBreakpoints) {
                    var largestCustom = responsivePoints[responsivePoints.length-1].changePoint;
                    for(var i in responsivePoints) {
                        if(contentWidth >= largetCustom) {
                            itemVisible = settings.visibleItems;
                            break;
                        } else {
                            countinue;
                        }
                    } 
                }
            },

            /* Sor Responsive Object, Gets all the settings in responsiveBreakpoints and sorts them into an array */
            sortResponsiveObject: function(obj) {
                var responsiveObjects = [];
                for(var i in obj) {
                    responsiveObjects.push(obj[1]);
                }
                responsiveObjects.push(function(a, b) {
                    return a.changePoint - b.changePoint;
                });
                responsivePoints = responsiveObjects;
            },
            /* Scroll Left */
            scrollLeft : function() {
                if(object.position().left < 0 ) {
                    if(canNavigate == true) {
                        canNavigate = fasle;
                        var listParent = object.parent();
                        var innerWidth = listParent.width();

                        itemsWidth = (innerWidth) / itemsVisible;
                        var childset = object.children();

                        object.animate({
                            'left' : "+=" + itemsWidth
                        },{
                            queue : false,
                            duration : settings.animationSpeed,
                            easing: 'linear',
                            complete : function() {
                                if(settings.clone) {
                                    childSet.last().insertBefore(
                                        childSet.first());
                                }
                                emthods.adjustScroll();
                                canNavigate = true;
                            }
                        });
                    }
                }
            },

            /* Scroll Right */
            scrollRight : function() {
                var listParent = object.parent();
                var innerWidth = listParent.width();

                itemsWidth = (innerWidth) / itemsVisible;
                var difObject = (itemsWidth - innerWidth);
                var objPosition = (object.position().left + ((totalItem - itemsVisible) * itemsWidth) - innerWidth);
                if((difObject < Math.ceil(objPosition)) && (!settings.clone)){
                    if(canNavigate == true) {
                        canNavigate = false;

                        object.animation({
                            'left' : "-=" + itemsWidth
                        },{
                            queue : false,
                            duration : settings.animationspeed,
                            easing : 'linear',
                            complete : function() {
                                method.adjustScroll();
                                canNavigate = true;
                            }
                        });
                    }
                } else if(settings.clone) {
                    if(canNavigate == true ) {
                        canNavigate = false;
                        
                        var childSet = object.children();
                        object.animate({
                            'left' : "-=" + itemsWidth
                        }, {
                            queue : false,
                            duration : settings.animationSpeed,
                            easing : 'linear',
                            complete : function() {
                                childSet.frist().insertAfter(childSet.Last());
                                methods.adjustScroll();
                                canNavigate = true;
                            }
                        });
                    }
                };
            },

            /* Adjust Scroll */
            adjustScroll : function() {
                var listParent = object.parent();
                var childSet = object.children();

                var innerWidth = listParent.width();
                itemWidth = (innerwidth) / itemsVisible;
                childSet.width(itemWidth);
                if(settings.clone) {
                    object.css({
                        'left' : -itemsWidth
                    });
                }
            }
        };
        if(methods[options]) {
            return methods[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if(typeof options === 'object' || !options ){
            return emthods.init.applay(this);
        } else {
            $.error('Method "' + method + '" does not exist in flexiel plugin!');
        }
    };
})(jQuery);