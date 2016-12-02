(function($){
	"use strict";

	$(document).ready(function(){
		var $main_menu    = $( '#main-header .nav' ),
			$format_video = $( '.format-video' ),
			$featured     = $( '.et-gallery-slider' ),
			$comment_form = $( '#commentform' ),
			$top_menu     = $( '#top-menu' );

		$main_menu.superfish({
			delay:       300,                            // one second delay on mouseout
			animation:   { height : 'show' },  // fade-in and slide-down animation
			speed:       'fast',                          // faster animation speed
			autoArrows:  true,                           // disable generation of arrow mark-up
			dropShadows: false                            // disable drop shadows
		});

		$format_video.find( '.main-image' ).fitVids();

		$format_video.find( '.et-main-image-link' ).click( function() {
			var $this_el = $(this),
				$video_container = $this_el.siblings( '.et-video-container' );

			if ( $video_container.length ) {
				$this_el.animate( { 'opacity' : 0 }, 500, function() {
					$(this).css( 'display', 'none' );
					$video_container.show();
				} );

				$this_el.siblings( '.et-play-video, .meta-date' ).animate( { 'opacity' : 0 }, 500, function() {
					$(this).css( 'display', 'none' );
				} );

				return false;
			}
		} );

		if ( $featured.length ){
			$featured.flexslider( {
				slideshow  : false,
				selector   : '.et-gallery-slides > li',
				controlNav : false
			} );
		}

		$comment_form.find('input:text, input#email, input#url, textarea').each(function(index,domEle){
			var $et_current_input = jQuery(domEle),
				$et_comment_label = $et_current_input.siblings('label'),
				et_comment_label_value = $et_current_input.siblings('label').text();
			if ( $et_comment_label.length ) {
				$et_comment_label.hide();
				if ( $et_current_input.siblings('span.required') ) {
					et_comment_label_value += $et_current_input.siblings('span.required').text();
					$et_current_input.siblings('span.required').hide();
				}
				$et_current_input.val(et_comment_label_value);
			}
		}).bind('focus',function(){
			var et_label_text = jQuery(this).siblings('label').text();
			if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
			if (jQuery(this).val() === et_label_text) jQuery(this).val("");
		}).bind('blur',function(){
			var et_label_text = jQuery(this).siblings('label').text();
			if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
			if (jQuery(this).val() === "") jQuery(this).val( et_label_text );
		});

		// remove placeholder text before form submission
		$comment_form.submit(function(){
			$comment_form.find('input:text, input#email, input#url, textarea').each(function(index,domEle){
				var $et_current_input = jQuery(domEle),
					$et_comment_label = $et_current_input.siblings('label'),
					et_comment_label_value = $et_current_input.siblings('label').text();

				if ( $et_comment_label.length && $et_comment_label.is(':hidden') ) {
					if ( $et_comment_label.text() == $et_current_input.val() )
						$et_current_input.val( '' );
				}
			});
		});

		et_duplicate_menu( $('#main-header ul.nav'), $('#main-header .mobile_nav'), 'mobile_menu', 'et_mobile_menu' );

		function et_duplicate_menu( menu, append_to, menu_id, menu_class ){
			var $cloned_nav;

			menu.clone().attr('id',menu_id).removeClass().attr('class',menu_class).appendTo( append_to );
			$cloned_nav = append_to.find('> ul');
			$cloned_nav.find('.menu_slide').remove();
			$cloned_nav.find('li:first').addClass('et_first_mobile_item');

			append_to.click( function(){
				if ( $(this).hasClass('closed') ){
					$(this).removeClass( 'closed' ).addClass( 'opened' );
					$cloned_nav.slideDown( 500 );
				} else {
					$(this).removeClass( 'opened' ).addClass( 'closed' );
					$cloned_nav.slideUp( 500 );
				}
				return false;
			} );

			append_to.find('a').click( function(event){
				event.stopPropagation();
			} );
		}

		$top_menu.append( '<span id="et_active_menu_item"></span>' );

		var $current_item_border = $( '#et_active_menu_item' ),
			$current_menu_item   = $top_menu.find( '> ul > .current-menu-item, > ul > .current-menu-ancestor' ),
			current_item_width,
			current_item_position;

		function et_highlight_current_menu_item( $element, animation ) {
			if ( $element.length ) {
				current_item_width    = $element.width();
				current_item_position = $element.position().left;

				if ( ! animation ) {
					$current_item_border.css( { 'left' : current_item_position, 'width' : current_item_width } );
				} else {
					$current_item_border.stop( true, true ).animate( { 'left' : current_item_position }, 250, function() {
						$(this).animate( { 'width' : current_item_width }, 250 );
					} );
				}
			}
		}

		et_highlight_current_menu_item( $current_menu_item, false );

		$top_menu.find( '> ul > li' ).hover( function() {
			et_highlight_current_menu_item( $(this), true );
		} );

		$top_menu.find( '> ul' ).mouseleave( function() {
			et_highlight_current_menu_item( $current_menu_item, true );
		} );
	} );
})(jQuery)