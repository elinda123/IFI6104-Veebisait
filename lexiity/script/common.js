jQuery(document).ready(function(){

    // HOVER-IMAGES


        jQuery('.header-links ul li a').hover(function(){
           jQuery('div',this).stop().animate({top: '-16px'},300);
        },function(){
           jQuery('div',this).stop().animate({top: '0'},300);
        });

});
