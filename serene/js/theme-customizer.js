/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	$( '.meta-comments-count, .post:hover .meta-post-date' ).css( { '-webkit-transform' : 'none', 'transform' : 'none' } );

	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( '.meta-post-date, .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-handle, .footer-widget li:before, #mobile_menu ul li:before, #et_active_menu_item, .comment-reply-link, .form-submit input, .et-tags li' ).css( 'background-color', to );

			$( '.post-content > header p, .mobile_menu_bar' ).css( 'color', to );

			$( 'blockquote' ).css( 'border-color', to );
		} );
	} );
} )( jQuery );