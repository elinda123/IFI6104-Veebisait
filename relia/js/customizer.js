/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( 'h1.header-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( 'p.header-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
        
        // ---------------------------------------------------------------------
        // HEADER --------------------------------------------------------------
        // ---------------------------------------------------------------------
       
        // Header Background Color
        wp.customize( 'relia_header_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'header#masthead section.page-header-block' ).css( 'background-color', to );
		} );
	} );
        
        // Use Logo or Site Title
	wp.customize( 'relia_logo_or_title', function( value ) {
		value.bind( function( to ) {
                    
                        if ( to === 'title' ) {
                            $( 'section.page-header-block h1.header-title' ).removeClass( 'relia-hidden' );
                            $( 'section.page-header-block img.header-logo' ).addClass( 'relia-hidden' );
                        } else {
                            $( 'section.page-header-block img.header-logo' ).removeClass( 'relia-hidden' );
                            $( 'section.page-header-block h1.header-title' ).addClass( 'relia-hidden' );
                        }
                        
		} );
	} );
        
        // Header Logo Size (Height)
	wp.customize( 'relia_logo_size', function( value ) {
		value.bind( function( to ) {
                    $( 'section.page-header-block img.header-logo' ).css( 'height', to );
		} );
	} );
        
        // Show or Hide the Site Tagline
	wp.customize( 'relia_tagline_toggle', function( value ) {
		value.bind( function( to ) {
                    
                        if ( to === 'show' ) {
                            $( 'section.page-header-block p.header-description' ).removeClass( 'relia-hidden' );
                        } else {
                            $( 'section.page-header-block p.header-description' ).addClass( 'relia-hidden' );
                        }
                        
		} );
	} );
        
        // ---------------------------------------------------------------------
        // FOOTER --------------------------------------------------------------
        // ---------------------------------------------------------------------
        
        // Footer Background Color
        wp.customize( 'relia_footer_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'footer.site-footer' ).css( 'background-color', to );
		} );
	} );
        
        // ---------------------------------------------------------------------
        // JUMBOTRON -----------------------------------------------------------
        // ---------------------------------------------------------------------
        
	// Main Jumbotron Heading
	wp.customize( 'relia_jumbotron_heading', function( value ) {
		value.bind( function( to ) {
                    
                    if ( $( '.hero-overlay h2' ).length ) {
                        $( '.hero-overlay h2' ).text( to );
                    } else {
                        $( '#slider-content-overlay h2' ).text( to );
                    }
                    
		} );
	} );
	
        // Jumbotron Heading Font Size
	wp.customize( 'relia_jumbotron_heading_size', function( value ) {
		value.bind( function( to ) {
                    
                    if ( $( '.hero-overlay h2' ).length ) {
                        $( '.hero-overlay h2' ).css( 'font-size', to + 'px' );
                    } else {
                        $( '#slider-content-overlay h2' ).css( 'font-size', to + 'px' );
                    }
                    
		} );
	} );
        
	// Jumbotron Button 1 Text
	wp.customize( 'relia_jumbotron_button_1_text', function( value ) {
		value.bind( function( to ) {
			$( 'div.big-hero-buttons a:first-child button' ).text( to );
		} );
	} );
        
	// Jumbotron Button 1 External URL
	wp.customize( 'relia_jumbotron_button_1_url', function( value ) {
		value.bind( function( to ) {
			$( 'div.big-hero-buttons a:first-child' ).attr( 'href', to );
		} );
	} );

    	// Jumbotron Button 2 Text
	wp.customize( 'relia_jumbotron_button_2_text', function( value ) {
		value.bind( function( to ) {
			$( 'div.big-hero-buttons a:last-child button' ).text( to );
		} );
	} );
    
	// Jumbotron Button 2 External URL
	wp.customize( 'relia_jumbotron_button_2_url', function( value ) {
		value.bind( function( to ) {
			$( 'div.big-hero-buttons a:last-child' ).attr( 'href', to );
		} );
	} );
        
        // Jumbotron Button Font Size
        wp.customize( 'relia_jumbotron_button_size', function( value ) {
		value.bind( function( to ) {
                    
                    $( 'div.big-hero-buttons button' ).css( 'font-size', to + 'px' );

		} );
	} );
        
        // ---------------------------------------------------------------------
        // FEATURES SECTION ----------------------------------------------------
        // ---------------------------------------------------------------------
        
        // Features Heading
	wp.customize( 'relia_features_heading', function( value ) {
		value.bind( function( to ) {
			$( 'section.features-section h2' ).text( to );
		} );
	} );        
        
        // CTA 1 - Icon
	wp.customize( 'relia_features_cta_1_icon', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-1 i' ).removeClass().addClass( 'fa ' + to );
		} );
	} );
        
        // CTA 1 - Title
	wp.customize( 'relia_features_cta_1_title', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-1 h3' ).text( to );
		} );
	} );
        
        // CTA 1 - Tagline
	wp.customize( 'relia_features_cta_1_tagline', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-1 p' ).text( to );
		} );
	} );
        
        // CTA 2 - Icon
	wp.customize( 'relia_features_cta_2_icon', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-2 i' ).removeClass().addClass( 'fa ' + to );
		} );
	} );

        // CTA 2 - Title
	wp.customize( 'relia_features_cta_2_title', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-2 h3' ).text( to );
		} );
	} );

        // CTA 2 - Tagline
	wp.customize( 'relia_features_cta_2_tagline', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-2 p' ).text( to );
		} );
	} );

        // CTA 3 - Icon
	wp.customize( 'relia_features_cta_3_icon', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-3 i' ).removeClass().addClass( 'fa ' + to );
		} );
	} );
        
        // CTA 3 - Title
	wp.customize( 'relia_features_cta_3_title', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-3 h3' ).text( to );
		} );
	} );

        // CTA 3 - Tagline
	wp.customize( 'relia_features_cta_3_tagline', function( value ) {
		value.bind( function( to ) {
			$( 'div.feature-cta.cta-3 p' ).text( to );
		} );
	} );

        // ---------------------------------------------------------------------
        // FOOTER SECTION ------------------------------------------------------
        // ---------------------------------------------------------------------

        // Footer Copyright
	wp.customize( 'relia_footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( 'footer.site-footer div.site-info' ).text( '@ ' + to + ' 2015' );
		} );
	} );

        // Social Icon - Facebook
	wp.customize( 'relia_include_icon_facebook', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-facebook' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-facebook' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );
        
        // Social Icon - Twitter
	wp.customize( 'relia_include_icon_twitter', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-twitter' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-twitter' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );

        // Social Icon - Google+
	wp.customize( 'relia_include_icon_google', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-google' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-google' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );

        // Social Icon - LinkedIn
	wp.customize( 'relia_include_icon_linkedin', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-linkedin' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-linkedin' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );

        // Social Icon - YouTube
	wp.customize( 'relia_include_icon_youtube', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-youtube' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-youtube' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );

        // Social Icon - Vimeo
	wp.customize( 'relia_include_icon_vimeo', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-vimeo' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-vimeo' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );

        // Social Icon - Music
	wp.customize( 'relia_include_icon_music', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-music' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-music' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );

        // Social Icon - Instagram
	wp.customize( 'relia_include_icon_instagram', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-instagram' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-instagram' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );
        
        // Social Icon - Pinterest
	wp.customize( 'relia_include_icon_pinterest', function( value ) {
		value.bind( function( to ) {
                    if( to == '' ) {
                        $( 'footer.site-footer a.link-pinterest' ).fadeOut();
                    } else {
                        $( 'footer.site-footer a.link-pinterest' ).attr( 'href', to ).fadeIn();
                    }
		} );
	} );
        
        // Payment Icon - Visa
	wp.customize( 'relia_include_cc_visa', function( value ) {
		value.bind( function( to ) {
                    if( to ) {
                        $( 'div.payment-icons i.fa-cc-visa' ).fadeIn();
                    } else {
                        $( 'div.payment-icons i.fa-cc-visa' ).fadeOut();
                    }
		} );
	} );
        
        // Payment Icon - MasterCard
	wp.customize( 'relia_include_cc_mastercard', function( value ) {
		value.bind( function( to ) {
                    if( to ) {
                        $( 'div.payment-icons i.fa-cc-mastercard' ).fadeIn();
                    } else {
                        $( 'div.payment-icons i.fa-cc-mastercard' ).fadeOut();
                    }
		} );
	} );

        // Payment Icon - American Express
	wp.customize( 'relia_include_cc_amex', function( value ) {
		value.bind( function( to ) {
                    if( to ) {
                        $( 'div.payment-icons i.fa-cc-amex' ).fadeIn();
                    } else {
                        $( 'div.payment-icons i.fa-cc-amex' ).fadeOut();
                    }
		} );
	} );
        
        // Payment Icon - PayPal
	wp.customize( 'relia_include_cc_paypal', function( value ) {
		value.bind( function( to ) {
                    if( to ) {
                        $( 'div.payment-icons i.fa-cc-paypal' ).fadeIn();
                    } else {
                        $( 'div.payment-icons i.fa-cc-paypal' ).fadeOut();
                    }
		} );
	} );

        // Color Skin Selection
	wp.customize( 'theme_color', function( value ) {
		value.bind( function( to ) {
			$( 'head link#relia-template-css' ).attr( "href", "wp-content/themes/relia/inc/css/temps/" + to + ".css" );
		} );
	} );
        
        // ---------------------------------------------------------------------
        // ARTICLES SECTION ----------------------------------------------------
        // ---------------------------------------------------------------------
        
        // Articles Section Heading
	wp.customize( 'relia_articles_heading', function( value ) {
		value.bind( function( to ) {
			$( '.recent-article h2.page-content-title' ).text( to );
		} );
	} );     
        
        // ---------------------------------------------------------------------
        // TYPOGRAPHY SECTION ----------------------------------------------------
        // ---------------------------------------------------------------------
        
        // Site Title Font Size
        	wp.customize( 'relia_title_font_size', function( value ) {
		value.bind( function( to ) {
                    
                    $( 'h1.header-title' ).css( 'font-size', to + 'px' );

		} );
	} );
        
        // Featured Product Banner Heading Size
        	wp.customize( 'relia_menu_bar_item_size', function( value ) {
		value.bind( function( to ) {
                    
                    $( 'ul#primary-menu > li > a, ul.slicknav_nav > li > a' ).css( 'font-size', to + 'px' );

		} );
	} );
        
        // ---------------------------------------------------------------------
        // BLOG LAYOUT ---------------------------------------------------------
        // ---------------------------------------------------------------------        
        
        // Read More Text
        wp.customize( 'relia_blog_read_more', function( value ) {
		value.bind( function( to ) {
			$( 'a.blog-post-read-more' ).text( to );
		} );
	} );     
        
        // ---------------------------------------------------------------------
        // WOOCOMMERCE ---------------------------------------------------------
        // ---------------------------------------------------------------------        
        
        // WooCommerce Sidebar
        wp.customize( 'relia_shop_sidebar_location', function( value ) {
		value.bind( function( to ) {
                    
                    var sidebar = $( 'body.woocommerce div#relia-sidebar' );
                    
                    if ( to === 'left' ) {
                        
                        $( 'body.woocommerce div#relia-sidebar' ).remove();
                        $( 'body.woocommerce div.relia-shop-body' ).before(sidebar);
                        
                    } else {
                        
                        $( 'body.woocommerce div#relia-sidebar' ).remove();
                        $( 'body.woocommerce div.relia-shop-body' ).after(sidebar);
                        
                    }

		} );
	} );

} )( jQuery );
