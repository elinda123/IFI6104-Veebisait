<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package relia
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'relia' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
            
            <?php if ( get_theme_mod( 'relia_header_background_type', 'image' ) == 'image' ) : ?>
                <section class="page-header-block" style="background-image: url('<?php echo esc_url( get_theme_mod( 'relia_header_image', get_template_directory_uri() . '/inc/images/page-header-bg.jpg' ) ); ?>');">
            <?php else : ?>
                <section class="page-header-block">
            <?php endif; ?>
                
                <div class="container">

                    <div class="row">

                        <div class="col-md-12 align-left">
                            
                            <h1 class="header-title wow fadeIn <?php echo get_theme_mod( 'relia_logo_or_title', 'title' ) == 'title' ? '' : 'relia-hidden' ; ?>">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                            </h1>
                            
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'relia_header_logo', get_template_directory_uri() . '/inc/images/relia-logo.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" 
                                style="height: <?php echo esc_attr( get_theme_mod( 'relia_logo_size', 50 ) ); ?>px; width: auto;"
                                class="header-logo wow fadeIn <?php echo get_theme_mod( 'relia_logo_or_title', 'title' ) == 'logo' ? '' : 'relia-hidden' ; ?>"></a>

                            <p class="header-description wow fadeIn <?php echo get_theme_mod( 'relia_tagline_toggle', 'show' ) == 'show' ? '' : 'relia-hidden' ; ?>">
                                <?php bloginfo( 'description' ); ?>
                            </p>

                            <div class="search-and-cart fadeInRight <?php echo is_front_page() ? 'wow' : ''; ?>">
                               
                                <?php if( class_exists( 'WooCommerce' ) && get_theme_mod( 'relia_shopping_cart_toggle', 'show') == 'show' ) : ?>

                                    <?php if( WC()->cart->get_cart_contents_count() > 0 ) : ?>
                                        <a class="relia-cart" href="<?php echo WC()->cart->get_cart_url() ; ?>">
                                            <span class="cart-total"><?php _e( 'Items in Cart', 'relia' ); ?> : </span>
                                            <?php echo WC()->cart->get_cart_contents_count(); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if( get_theme_mod( 'relia_search_toggle', 'show') == 'show' ) : ?>
                                        <i class="fa fa-search"></i>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo WC()->cart->get_cart_url() ; ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                    
                                <?php else : ?>

                                    <?php if( get_theme_mod( 'relia_search_toggle', 'show') == 'show' ) : ?>
                                        <i class="fa fa-search"></i>                            
                                    <?php endif; ?>
    
                                <?php endif; ?>
                                
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            
            <section id="search-background">
                <div id="search-form" class="wow fadeInUp">

                    <?php get_search_form(); ?>

                </div>
            </section>
            
            <nav class="main-nav main-navigation">
                <div class="container">
                    
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                    
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

                    <?php else : ?>
                    
                        <div class="menu-testing-menu-container">
                            
                            <ul id="primary-menu" class="menu">
                                
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    
                                    <a href="<?php echo admin_url( 'nav-menus.php' ); ?>">
                                       <?php _e( 'ADD A PRIMARY MENU', 'relia' ); ?> ?
                                    </a>
                                    
                                </li>
                                
                            </ul>
                            
                        </div>
                    
                    <?php endif; ?>
                    
                </div>
            </nav>
            
	</header><!-- #masthead -->

	<div id="content" class="site-content">
