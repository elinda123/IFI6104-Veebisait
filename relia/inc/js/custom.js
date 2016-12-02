jQuery(function($) {

    new WOW().init();
    
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
    });

    $(function(){
        $('#primary-menu').slicknav({
            prependTo: 'nav.main-nav'
        });
        
    });

    $( "i.fa.fa-search" ).on( "click", function() {
        $( "#search-background" ).fadeIn(300);
    });

    $( "#search-background" ).on( "click", function( e ) {
        if ( $( e.target ).is('section')) {
            $(this).fadeOut(300);
        }
    });
    
    // Swap and move to (with easing) the hero image when a thumb is clicked
    $( "div.feature-thumbnails div img" ).on( "click", function( e ) {

        var hero = $( "div.hero-banner" ),
            thumb = $(this);
            target = $(this).hash;

        hero.fadeOut(500, function () {
            hero.css( "background-image", "url(" + thumb.attr( "src" ) + ")" );
            hero.fadeIn(500);
        });
        
        $( "html, body" ).stop().animate({
            'scrollTop': hero.offset().top
        }, 650, "swing", function () {
            window.location.hash = target;
        });      
    
    });

    // Navigate to a post from the blogroll when that post's div is clicked
    $( "div.blog-roll-post article" ).on( "click", function ( e ){
        window.location.href = $(this).attr("data-link");
    });



});