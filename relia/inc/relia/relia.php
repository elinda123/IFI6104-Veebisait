<?php

/**
 * Enqueue scripts and styles.
 */
function relia_scripts() {
   
    wp_enqueue_style( 'relia-style', get_stylesheet_uri() );
    
    // Load Fonts from array
    $fonts = relia_fonts();
    
    // Primary Font Enqueue
    if( array_key_exists ( get_theme_mod('relia_font_primary', 'Dosis, sans-serif'), $fonts ) ) :
        wp_enqueue_style('relia-font-primary', '//fonts.googleapis.com/css?family=' . $fonts[ get_theme_mod('relia_font_primary', 'Dosis, sans-serif') ], array(), RELIA_VERSION );
    endif;
    
    // Secondary Font Enqueue
    if( array_key_exists ( get_theme_mod('relia_font_secondary', 'Abel, sans-serif'), $fonts ) ) :
        wp_enqueue_style('relia-font-secondary', '//fonts.googleapis.com/css?family=' . $fonts[ get_theme_mod('relia_font_secondary', 'Abel, sans-serif') ], array(), RELIA_VERSION );
    endif;
    
    // Body Font Enqueue
    if( array_key_exists ( get_theme_mod('relia_font_body', 'Open Sans, sans-serif'), $fonts ) ) :
        wp_enqueue_style('relia-font-body', '//fonts.googleapis.com/css?family=' . $fonts[ get_theme_mod('relia_font_body', 'Open Sans, sans-serif') ], array(), RELIA_VERSION );
    endif;
    
    // Enqueue stylesheets
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css', array(), RELIA_VERSION);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/inc/css/font-awesome.css', array(), RELIA_VERSION);
    wp_enqueue_style('slicknav', get_template_directory_uri() . '/inc/css/slicknav.min.css', array(), RELIA_VERSION);
    wp_enqueue_style('animatecss', get_template_directory_uri() . '/inc/css/animate.css', array(), RELIA_VERSION);
    wp_enqueue_style('relia-main-style', get_template_directory_uri() . '/inc/css/style.css', array(), RELIA_VERSION);
    
    // Skin Color Preset Enqueue
    if ( get_theme_mod( 'relia_color_skin_toggle', 'preset' ) == 'preset' ) :
        wp_enqueue_style('relia-template', get_template_directory_uri() . '/inc/css/temps/' . esc_attr( get_theme_mod( 'relia_preset_theme_color', 'gold' ) ) . '.css', array(), RELIA_VERSION);
    endif;
    
    // Enqueue scripts
    wp_enqueue_script('slicknav', get_template_directory_uri() . '/inc/js/jquery.slicknav.min.js', array('jquery'), RELIA_VERSION, true);
    wp_enqueue_script('wow', get_template_directory_uri() . '/inc/js/wow.min.js', array('jquery'), RELIA_VERSION, true);

    wp_enqueue_script('stellar', get_template_directory_uri() . '/inc/js/stellar.min.js', array('jquery'), RELIA_VERSION, true);

    wp_enqueue_script('relia-custom', get_template_directory_uri() . '/inc/js/custom.js', array('jquery'), RELIA_VERSION, true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) :
        wp_enqueue_script('comment-reply');
    endif;
    
}
add_action('wp_enqueue_scripts', 'relia_scripts');

function relia_render_homepage() { ?>

    <?php relia_homepage_widgets(); ?>

    <?php if ( get_theme_mod( 'relia_features_list_bool', 'show' ) == 'show' ) : ?>
    
        <section class="features-section">
        
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-sm-12">
                        <h2><?php echo esc_attr( get_theme_mod( 'relia_features_heading', __( 'Features', 'relia' )  ) ); ?></h2>
                    </div>
                    
                </div>
            </div>
            
            <div class="container">
                <div class="row">
                    
                    <?php for ( $index = 1; $index < 4; $index++) : ?>
                        
                        <div class="col-sm-4">
                            <div class="feature-cta cta-<?php echo $index; ?> wow fadeInUp">
                                <i class="fa <?php echo esc_attr( get_theme_mod( 'relia_features_cta_' . $index . '_icon', 'fa-star'  ) ); ?>"></i>
                                <h3>
                                    <?php echo esc_attr( get_theme_mod( 'relia_features_cta_' . $index . '_title', __( 'CTA Title', 'relia' )  ) ); ?>
                                </h3>
                                <p>
                                    <?php echo esc_attr( get_theme_mod( 'relia_features_cta_' . $index . '_tagline', __( 'Description', 'relia' )  ) ); ?>
                                </p>
                            </div>
                        </div>
                    
                    <?php endfor; ?>
                    
                </div>
            </div>
            
        </section>

    <?php endif; ?>

    <?php if ( get_theme_mod( 'relia_recent_articles_bool', 'show' ) == 'show' ) : ?>
    
        <section class="recent-articles-section">
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-12 recent-article wow fadeInDown">
                        <h2 class="page-content-title">
                            <?php echo esc_attr( get_theme_mod( 'relia_articles_heading', __( 'Homepage Articles', 'relia' )  ) ); ?>
                        </h2>
                        <hr>
                    </div>
                    
                    <?php 
                        $recents = wp_get_recent_posts( array(
                            'numberposts'   => 3,
                            'post_type'     => 'post',
                            'post_status'   => 'publish',
                        ) );
                    ?>
                    
                    <?php $article_1_ID = get_theme_mod( 'relia_articles_content', 'featured' ) == 'recent' ? $recents[0]["ID"] : get_theme_mod( 'relia_featured_article_1', null ); ?>
                    <div class="col-sm-4 recent-article wow fadeInUp">
                        <h4>
                            <?php echo $article_1_ID == null ? 'Select a post or page in the Customizer' : get_the_title( $article_1_ID ); ?>
                        </h4>
                        <p>
                            <?php echo $article_1_ID == null ? 'The selected post or page content will appear here.' : wp_trim_words( wp_strip_all_tags( apply_filters( 'the_content', get_post_field( 'post_content', $article_1_ID ) ) ), 50 ); ?>
                        </p>
                        <h5>
                            <a href="<?php echo $article_1_ID == null ? '#' : get_permalink( $article_1_ID ); ?>">
                                <?php echo esc_html( get_theme_mod( 'relia_homepage_articles_read_more', __( 'Read More', 'relia' ) ) ); ?>
                            </a>
                        </h5>
                    </div>
                    
                    <?php $article_2_ID = get_theme_mod( 'relia_articles_content', 'featured' ) == 'recent' ? $recents[1]["ID"] : get_theme_mod( 'relia_featured_article_2', null ); ?>
                    <div class="col-sm-4 recent-article wow fadeInUp">
                        <h4>
                            <?php echo $article_2_ID == null ? 'Select a post or page in the Customizer' : get_the_title( $article_2_ID ); ?>
                        </h4>
                        <p>
                            <?php echo $article_2_ID == null ? 'The selected post or page content will appear here.' : wp_trim_words( wp_strip_all_tags( apply_filters( 'the_content', get_post_field( 'post_content', $article_2_ID ) ) ), 50 ); ?>
                        </p>
                        <h5>
                            <a href="<?php echo $article_2_ID == null ? '#' : get_permalink( $article_2_ID ); ?>">
                                <?php echo esc_html( get_theme_mod( 'relia_homepage_articles_read_more', __( 'Read More', 'relia' ) ) ); ?>
                            </a>
                        </h5>
                    </div>
                    
                   <?php $article_3_ID = get_theme_mod( 'relia_articles_content', 'featured' ) == 'recent' ? $recents[2]["ID"] : get_theme_mod( 'relia_featured_article_3', null ); ?>
                    <div class="col-sm-4 recent-article wow fadeInUp">
                        <h4>
                            <?php echo $article_3_ID == null ? 'Select a post or page in the Customizer' : get_the_title( $article_3_ID ); ?>
                        </h4>
                        <p>
                            <?php echo $article_3_ID == null ? 'The selected post or page content will appear here.' : wp_trim_words( wp_strip_all_tags( apply_filters( 'the_content', get_post_field( 'post_content', $article_3_ID ) ) ), 50 ); ?>
                        </p>
                        <h5>
                            <a href="<?php echo $article_3_ID == null ? '#' : get_permalink( $article_3_ID ); ?>">
                                <?php echo esc_html( get_theme_mod( 'relia_homepage_articles_read_more', __( 'Read More', 'relia' ) ) ); ?>
                            </a>
                        </h5>
                    </div>
                    
                    <?php wp_reset_postdata(); ?>
                    
                </div>
            </div>
        </section>

    <?php endif; 
    
}
add_action( 'relia_homepage', 'relia_render_homepage' );

function relia_render_jumbotron(){
    
    if ( get_theme_mod( 'relia_slider_bool', 'show' ) == 'show' ) : ?>

        <section class="main-page-content">

            <div class="container-fluid">

                <div class="row">

                    <?php if( get_theme_mod( 'relia_jumbotron_type', 'static') == 'slider' ) : ?>
                    
                    <?php else : ?>
                    
                        <?php if ( get_theme_mod( 'relia_static_jumbotron_type', 'image' ) == 'image' ) : ?>
                            <div data-stellar-background-ratio="0.7" class="col-md-12 hero-banner parallax-window" style="background-image: url(<?php echo esc_url( get_theme_mod( 'relia_jumbotron_static_image', get_template_directory_uri() . '/inc/images/relia_hero.jpg' ) ); ?>)">
                        <?php else : ?>
                            <div class="col-md-12 hero-banner" style="background-color: <?php echo esc_attr( get_theme_mod( 'relia_jumbotron_static_color', '#1c1c1c') ); ?>;">
                        <?php endif; ?>        

                                <div class="hero-overlay">
                                    
                                    <div class="content-wrapper">
                                    
                                        <h2 class="wow fadeInDown"><?php echo esc_attr( get_theme_mod( 'relia_jumbotron_heading', __( 'Featured Product', 'relia' ) ) ); ?></h2>
                                        <div class="big-hero-buttons wow fadeInUp">
                                            
                                            
                                            <?php if( get_theme_mod( 'relia_jumbotron_button_1_text', __( 'View Collection', 'relia' ) ) ) : ?>
                                            <a href="
                                                <?php if ( get_theme_mod( 'relia_jumbotron_button_1_url', null ) == false ) : ?>
                                                    <?php echo get_theme_mod( 'relia_jumbotron_button_1_internal', null ) == null ? '#' : esc_url( get_permalink( get_theme_mod( 'relia_jumbotron_button_1_internal', null ) ) ); ?>
                                                <?php else : ?>
                                                    <?php echo get_theme_mod( 'relia_jumbotron_button_1_url', null ) == null ? '#' : esc_url( get_theme_mod( 'relia_jumbotron_button_1_url', null ) ); ?>
                                                <?php endif; ?>
                                               ">
                                                <button class="dark-btn">
                                                    <?php echo esc_html( get_theme_mod( 'relia_jumbotron_button_1_text', __( 'View Collection', 'relia' ) ) ); ?>
                                                </button>
                                            </a>
                                            <?php endif; ?>
                                            
                                            <?php if( get_theme_mod( 'relia_jumbotron_button_2_text', __( 'View Collection', 'relia' ) ) ) : ?>
                                            <a href="
                                                <?php if ( get_theme_mod( 'relia_jumbotron_button_2_url', null ) == false ) : ?>
                                                    <?php echo get_theme_mod( 'relia_jumbotron_button_2_internal', null ) == null ? '#' : esc_url( get_permalink( get_theme_mod( 'relia_jumbotron_button_2_internal', null ) ) ); ?>
                                                <?php else : ?>
                                                    <?php echo get_theme_mod( 'relia_jumbotron_button_2_url', null ) == null ? '#' : esc_url( get_theme_mod( 'relia_jumbotron_button_2_url', null ) ); ?>
                                                <?php endif; ?>
                                               ">
                                                <button class="dark-btn">
                                                    <?php echo esc_attr( get_theme_mod( 'relia_jumbotron_button_2_text', __( 'Back Us On Kickstarter', 'relia' ) ) ); ?>
                                                </button>
                                            </a>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                    
                                </div>

                            </div>

                    <?php endif; ?>
                            
                </div>

            </div>

        </section>

    <?php endif;
    
}
add_action( 'relia_jumbotron', 'relia_render_jumbotron' );

function relia_render_footer() { ?>
    
    <div class="wow fadeIn">

        <div class="social-icons">
            
            <?php if( get_theme_mod( 'relia_include_icon_facebook', 'http://facebook.com' ) ) : ?>
                <a class="link-facebook" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_facebook', "http://facebook.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-facebook"></i>
                </a>
            <?php endif; ?>

            <?php if( get_theme_mod( 'relia_include_icon_twitter', 'http://twitter.com' ) ) : ?>
                <a class="link-twitter" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_twitter', "http://twitter.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-twitter"></i>
                </a>
            <?php endif; ?>

            <?php if( get_theme_mod( 'relia_include_icon_google', 'http://plus.google.com' ) ) : ?>
                <a class="link-google" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_google', "http://plus.google.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-google-plus"></i>
                </a>
            <?php endif; ?>

            <?php if( get_theme_mod( 'relia_include_icon_linkedin', 'http://linkedin.com' ) ) : ?>
                <a class="link-linkedin" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_linkedin', "http://linkedin.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-linkedin-square"></i>
                </a>
            <?php endif; ?>

            <?php if( get_theme_mod( 'relia_include_icon_youtube', 'http://youtube.com' ) ) : ?>
                <a class="link-youtube" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_youtube', "http://youtube.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-youtube"></i>
                </a>
            <?php endif; ?>
            
            <?php if( get_theme_mod( 'relia_include_icon_vimeo', 'http://vimeo.com' ) ) : ?>
                <a class="link-vimeo" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_vimeo', "http://vimeo.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-vimeo-square"></i>
                </a>
            <?php endif; ?>

            <?php if( get_theme_mod( 'relia_include_icon_music', 'http://itunes.com' ) ) : ?>
                <a class="link-music" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_music', "http://itunes.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-music"></i>
                </a>
            <?php endif; ?>
            
            <?php if( get_theme_mod( 'relia_include_icon_instagram', 'http://instagram.com' ) ) : ?>
                <a class="link-instagram" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_instagram', "http://instagram.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-instagram"></i>
                </a>
            <?php endif; ?>
            
            <?php if( get_theme_mod( 'relia_include_icon_pinterest', 'http://pinterest.com' ) ) : ?>
                <a class="link-pinterest" href="<?php echo esc_url( get_theme_mod( 'relia_include_icon_pinterest', "http://pinterest.com" ) ); ?>" target="_BLANK">
                    <i class="fa fa-pinterest"></i>
                </a>
            <?php endif; ?>

        </div>

        <p class="footer">
            Designed by Smartcat <img src="<?php echo get_template_directory_uri() . "/inc/images/smartcat-30x33.png"; ?>" alt="Smartcat">
        </p>
        
        <div class="payment-icons">

            <?php if ( get_theme_mod( 'relia_include_cc_visa', true ) ) : ?>
                <i class="fa fa-cc-visa"></i>
            <?php endif; ?>

            <?php if ( get_theme_mod( 'relia_include_cc_mastercard', true ) ) : ?>
                <i class="fa fa-cc-mastercard"></i>
            <?php endif; ?>

            <?php if ( get_theme_mod( 'relia_include_cc_amex', true ) ) : ?>
                <i class="fa fa-cc-amex"></i>
            <?php endif; ?>

            <?php if ( get_theme_mod( 'relia_include_cc_paypal', true ) ) : ?>
                <i class="fa fa-cc-paypal"></i>
            <?php endif; ?>

        </div>

        <div class="site-info">
            @ <?php echo esc_attr( get_theme_mod( 'relia_footer_copyright', __( 'Company Name', 'relia' )  ) ); ?>
            <?php echo ' ' . date( 'Y' ); ?>
        </div>

    </div>

    <?php
}
add_action( 'relia_footer', 'relia_render_footer' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function relia_widgets_init() {

        register_sidebar( array(
            'name'          => esc_html__( 'Homepage A', 'relia' ),
            'id'            => 'sidebar-front',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-sm-4">',
            'after_widget'  => '</div></aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'relia' ),
		'id'            => 'sidebar-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

        register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'relia' ),
		'id'            => 'sidebar-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

        register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'relia' ),
		'id'            => 'sidebar-shop',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        
}
add_action( 'widgets_init', 'relia_widgets_init' );

function relia_main_width() {
    
    if( is_active_sidebar('sidebar-left') && is_active_sidebar('sidebar-right') ) :
        $width = 6;
    elseif( is_active_sidebar('sidebar-left') || is_active_sidebar('sidebar-right') ) :
        $width = 9;
    else:
        $width = 12;
    endif;
    
    return $width;
    
}

function relia_shop_width() {
    
    if( is_active_sidebar('sidebar-shop') ) :
        $width = 9;
    else:
        $width = 12;
    endif;
    
    return $width;
    
}

function relia_custom_css() { ?>
    <style type="text/css">
        
        body {
            font-size: <?php echo esc_attr( get_theme_mod( 'relia_body_font_size', '16') ); ?>px;
            font-family: <?php echo esc_attr( get_theme_mod( 'relia_font_body', 'Open Sans, sans-serif' ) ); ?>;
        }
        
        /* Header Bar Title */
        h1.header-title {
            font-size: <?php echo esc_attr( get_theme_mod( 'relia_title_font_size', '36') ); ?>px;
        }
    
        ul#primary-menu > li > a,
        ul.slicknav_nav > li > a {
            font-size: <?php echo esc_attr( get_theme_mod( 'relia_menu_bar_item_size', '14' ) ); ?>px;
        }
        
        /* Light Coloured Nav Items Toggle*/
        <?php if ( get_theme_mod( 'relia_light_menu_item_toggle', 'dark' ) == 'bright' ) : ?>
            
            ul#primary-menu li a,
            ul.slicknav_nav a {
                color: #efefef;
            }
            
            ul.slicknav_nav a:hover {
                color: #fff;
            }
            
        <?php endif; ?>
        
        
        /* Primary Font Rules */
        h1, h2, h3, h4, h5, h6,
        h1.header-title,
        div.hero-overlay h2,
        button.dark-btn,
        address,
        div#search-form h4,
        p.footer,
        .front-page-content div.hero-overlay h2,
        .front-page-content h2.feature-content-title,
        section.features-section h2,
        section.features-section .feature-cta h3,
        section.features-section .feature-cta p,
        .recent-article h4,
        .recent-article h5 a,
        footer.entry-footer span.edit-link a,
        h2.comments-title,
        div#search-form form.search-form input[type="submit"],
        .woocommerce .woocommerce-message a.button,
        .woocommerce button.button,
        a.button.add_to_cart_button,
        li.product a.added_to_cart,
        ul.products li.product h3,
        aside.widget_search input.search-field,
        aside.widget ul li a,
        h2.widget-title,
        .blog-post-overlay h2.post-title,
        .blog-index-content h2,
        p.form-submit input,
        div#comments div#respond h3,
        div.comment-metadata span.edit-link a,
        div.reply a,
        .archive .entry-content,
        .type-event header.post-header div.location,
        .type-event header.post-header div.date,
        .relia-service.col-sm-4 p,
        .relia-contact-info .row .col-sm-4 > div,
        .relia-pricing-table .subtitle,
        .relia-pricing-table .description,
        form#relia-contact-form label
        {
            font-family: <?php echo esc_attr( get_theme_mod( 'relia_font_primary', 'Dosis, sans-serif' ) ); ?>;
        }
        aside.widget.woocommerce a.button,
        .woocommerce input[type="submit"] { font-family: <?php echo esc_attr( get_theme_mod( 'relia_font_primary', 'Dosis, sans-serif' ) ); ?> !important; }
        
        
        /* Secondary Font Rules */
        p.header-description,
        .woocommerce div#reviews h3,
        .woocommerce-tabs ul.wc-tabs li,
        div.panel.wc-tab p,
        div.panel.wc-tab h2, 
        div.related.products h2,
        .woocommerce .product_meta,
        .woocommerce .quantity .qty,
        .woocommerce .woocommerce-review-link,
        .woocommerce .summary p,
        .woocommerce .product .onsale,
        .woocommerce ul.products li.product .price,
        p.woocommerce-result-count,
        nav.woocommerce-breadcrumb,
        aside.widget.woocommerce,
        aside.widget_text p,
        aside.widget_tag_cloud div.tagcloud a,
        aside.widget table th,
        aside.widget table td,
        aside.widget table caption,
        aside.widget ul li,
        .woocommerce div.cart-collaterals h2,
        .woocommerce a.added_to_cart,
        .woocommerce .woocommerce-message,
        div.homepage-page-content div.pagination-links,
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
        a.blog-post-read-more,
        div#comments div#respond form p 
        div.comment-metadata a,
        li.comment div.comment-author span.says,
        li.comment div.comment-author b,
        div.nav-links a,
        p.post-meta,
        div.entry-meta,
        footer.entry-footer,
        div#search-form form.search-form input[type="search"],
        ul.slicknav_nav > li > ul > li a,
        ul.slicknav_nav > li > a,
        ul#primary-menu li ul li a,
        ul#primary-menu li a,
        a.relia-cart,
        dl dd,
        dl dt,
        td, 
        th,
        form#relia-contact-form input[type="text"],
        form#relia-contact-form textarea,
        #relia-contact-form input.relia-button,
        #relia-contact-form .mail-sent,
        #relia-contact-form .mail-not-sent,
        .relia-callout a.relia-button,
        .relia-pricing-table .price,
        ul#relia-testimonials .testimonial-author,
        a.apply.secondary-button,
        .news-item div.date
        {
            font-family: <?php echo esc_attr( get_theme_mod( 'relia_font_secondary', 'Abel, sans-serif' ) ); ?>;
        }
        
        .recent-article h5 a {
            font-family: <?php echo esc_attr( get_theme_mod( 'relia_font_secondary', 'Abel, sans-serif' ) ); ?> !important;
        }
        
        <?php if ( get_theme_mod( 'relia_single_show_cat_tags', 'show' ) == 'hide' ) : ?>
            .single-post .cat-links,
            .single-post .tags-links {
                display: none !important;
            }
        <?php endif; ?>
            
        header#masthead section.page-header-block {
            background-color: <?php echo esc_attr( get_theme_mod( 'relia_header_background_color', '#1c1c1c' ) ); ?>;
        }
        
        footer.site-footer {
            background-color: <?php echo esc_attr( get_theme_mod( 'relia_footer_background_color', '#1c1c1c' ) ); ?>;
        }

        div.col-md-12.hero-banner {
            height: <?php echo esc_attr( get_theme_mod( 'relia_slider_height', 600 ) ) . 'px'; ?>;
        }

        div#slider-content-overlay,
        div.col-md-12.hero-banner .hero-overlay {
            background-color: rgba(0,0,0,<?php echo esc_attr( get_theme_mod( 'relia_slider_dark_tint', .5 ) ); ?>);
        }

        div.hero-overlay h2,
        div#slider-content-overlay h2 { font-size: <?php echo esc_attr( get_theme_mod( 'relia_jumbotron_heading_size', 50 ) ) . 'px'; ?>; }

        div.big-hero-buttons button { font-size: <?php echo esc_attr( get_theme_mod( 'relia_jumbotron_button_size', 14 ) ) . 'px'; ?>; }
        
        <?php $front = get_option('show_on_front'); ?>
        
        <?php if ( $front == 'posts' ) : ?>
        .front-page-content{ border-top: none !important }
        <?php endif; ?>
            
    </style>
    <?php 
}
add_action('wp_head', 'relia_custom_css');

function relia_homepage_widgets() { ?>
    
    <!-- Homepage Area A -->
    <?php if ( get_theme_mod( 'relia_toggle_widget_area_a', 'on' ) == 'on' ) : ?>
    
        <?php if ( ! is_active_sidebar( 'sidebar-front' ) ) : ?>

            <section class="main-page-content front-page-widget area-a">

                <div class="container">

                    <div class="row">

                        <div class="col-sm-12">

                            <h2 class="widget-title">
                                <?php _e( 'Homepage A Widget', 'relia' ); ?>
                            </h2>
                            <div class="textwidget">
                                <?php _e( 'You can enable/disable this widget from Customizer - Frontpage - Homepage Widget A. You can also set the background image to your preference. This is a widget placeholder, and you can add any widget to it from Customizer - Widgets.', 'relia' ); ?>
                            </div>

                        </div>

                    </div>

                </div>

            </section>

        <?php else : ?>

            <?php get_sidebar( 'front' ); ?>

        <?php endif; ?>
    
    <?php endif; ?>

    
<?php }