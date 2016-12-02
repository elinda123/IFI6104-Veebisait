jQuery(document).ready(function($) { 
    'use strict';

    var $document = $(document);
    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {

        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'delay' : 0,
            'animation': {
                'height': 'show'
            }
        });

    });

        $("#menu-main-slide").mmenu({
            "slidingSubmenus": false,
            "offCanvas": {
               "position": "right"
            },
            "extensions": [
                "theme-dark",
                "pageshadow",
                "border-full"
            ]

        })

    function mobileadjust() {
        
        var windowWidth = $(window).width();

        if( typeof window.orientation === 'undefined' ) {
            $('#menu-main-menu').removeAttr('style');
         }

        if( windowWidth < 769 ) {
            $('#menu-main-menu').addClass('mobile-menu');
         }
 
    }
    
    mobileadjust();

    $(window).resize(function() {
        mobileadjust();
    });

});