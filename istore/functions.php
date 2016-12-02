<?php
/**
 * Function describe for iStore 
 * 
 * @package istore
 */

include_once( trailingslashit( get_stylesheet_directory() ) . 'lib/custom-config.php' );
 
add_action( 'wp_enqueue_scripts', 'istore_enqueue_styles', 999 );
function istore_enqueue_styles() {
  $parent_style = 'istore-parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'istore-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}


function istore_theme_setup() {
    
    load_child_theme_textdomain( 'istore', get_stylesheet_directory() . '/languages' );
    		
		// Add Custom Background Support
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );
		
		// Add Custom logo Support
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		) );
    // add new theme option to customizer
    if ( ! class_exists( 'Kirki' ) ) {
    	return;
    }
    Kirki::add_field( 'istore_settings', array(
  		'type'        => 'code',
  		'settings'    => 'header-banner',
  		'label'       => __( 'Header Banner', 'istore' ),
  		'help'        => __( 'Add your HTML code with your banner.', 'istore' ),
  		'section'     => 'layout_section',
  		'choices'     => array(
      	'language' => 'html',
      	'theme'    => 'monokai',
      	'height'   => 100,
      ),
  		'default'     => '',
  		'priority'    => 10,
  	) ); 
}
add_action( 'after_setup_theme', 'istore_theme_setup' );

function istore_custom_remove( $wp_customize ) {
    
    $wp_customize->remove_control( 'header-logo' );
    $wp_customize->remove_control( 'infobox-text-right' );
    $wp_customize->remove_section( 'site_bg_section' );
}

add_action( 'customize_register', 'istore_custom_remove', 100);

// Load theme info page.
if ( is_admin() ) {
	include_once(trailingslashit( get_template_directory() ) . 'lib/welcome/welcome-screen.php');
}


