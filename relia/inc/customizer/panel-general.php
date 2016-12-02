<?php

// ---------------------------------------------
// General Panel
// ---------------------------------------------
$wp_customize->add_panel( 'relia_general_panel', array (
    'title' => __( 'General', 'relia' ),
    'description' => __( 'General settings for your site, such as title, favicon and more', 'relia' ),
    'priority' => 10
) );

// ---------------------------------------------
// Header Section
// ---------------------------------------------
$wp_customize->add_section( 'relia_header_section', array(
    'title'                 => __( 'Header', 'relia'),
    'description'           => __( 'Customize the contents of the site header', 'relia' ),
    'panel'                 => 'relia_general_panel'
) );

// ---------------------------------------------
// Header Section - Settings & Controls
// ---------------------------------------------

    // Use Image or Colour for Header Background? 
    $wp_customize->add_setting( 'relia_header_background_type', array (
        'default'               => 'image',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_static_background_toggle',
    ) );
    $wp_customize->add_control( 'relia_header_background_type', array(
        'type'                  => 'radio',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Image or Color', 'relia' ),
        'description'           => __( 'Specify whether you would like the background of the header to be solid colour or an image', 'relia' ),
        'choices'               => array(
            'image'             => __( 'Use a background image', 'relia' ),
            'color'             => __( 'Use a solid color background', 'relia' ),
    ) ) );
    
    // Header Background Image
    $wp_customize->add_setting( 'relia_header_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/page-header-bg.jpg',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'relia_header_image', array (
        'mime_type'             => 'image',
        'settings'              => 'relia_header_image',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Header Background Image', 'relia' ),
        'description'           => __( 'Select the image file that you would like to use as the header background', 'relia' ),        
    ) ) );
    
    // Header Background Color
    $wp_customize->add_setting( 'relia_header_background_color', array (
        'default'               => '#1c1c1c',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_skin'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'relia_header_background_color', array(
        'label'                 => __( 'Header Background Color', 'relia' ),
        'section'               => 'relia_header_section',
        'settings'              => 'relia_header_background_color',
    ) ) );
    
    // Use Logo or Title
    $wp_customize->add_setting( 'relia_logo_or_title', array (
        'default'               => 'title',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_logo_or_title_switch',
    ) );
    $wp_customize->add_control( 'relia_logo_or_title', array(
        'type'                  => 'radio',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Use Logo or Title in Header?', 'relia' ),
        'description'           => __( 'Specify whether you would like a logo to appear instead of the site title', 'relia' ),
        'choices'               => array(
            'title'             => __( 'Use Site Title', 'relia' ),
            'logo'              => __( 'Use Logo', 'relia' ),
    ) ) );

    // Header Logo Image
    $wp_customize->add_setting( 'relia_header_logo', array (
        'default'               => get_template_directory_uri() . '/inc/images/relia-logo.png',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'relia_header_logo', array (
        'mime_type'             => 'image',
        'settings'              => 'relia_header_logo',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Logo', 'relia' ),
        'description'           => __( 'If you would like to use a logo instead of the site title, you may upload it here', 'relia' ),        
    ) ) );
    
    // Header Logo Size (Height)
    $wp_customize->add_setting( 'relia_logo_size', array (
        'default'               => 50,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_integer',
    ) );
    $wp_customize->add_control( 'relia_logo_size', array(
        'type'                  => 'range',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Logo Height', 'relia' ),
        'description'           => __( 'Adjust the height of your logo. Aspect ratio will be maintained automatically', 'relia' ),
        'input_attrs'           => array(
            'min' => 50,
            'max' => 200,
            'step' => 10,
    ) ) );
    
    // Show or Hide Tagline
    $wp_customize->add_setting( 'relia_tagline_toggle', array (
        'default'               => 'show',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'relia_tagline_toggle', array(
        'type'                  => 'radio',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Show or Hide the Site Tagline?', 'relia' ),
        'description'           => __( 'Specify whether the site tagline should appear below the title/logo', 'relia' ),
        'choices'               => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
    ) ) );
    
    // Show or Hide Search Icon
    $wp_customize->add_setting( 'relia_search_toggle', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'relia_search_toggle', array(
        'type'                  => 'radio',
        'section'               => 'relia_header_section',
        'label'                 => __( 'Show or Hide the Search icon?', 'relia' ),
        'description'           => __( 'Specify whether the magnifying glass icon should appear in the header', 'relia' ),
        'choices'               => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
    ) ) );

    // Show or Hide Shopping Cart
    if( class_exists( 'WooCommerce' ) ) :
    
        $wp_customize->add_setting( 'relia_shopping_cart_toggle', array (
            'default'               => 'show',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'relia_sanitize_show_hide',
        ) );
        $wp_customize->add_control( 'relia_shopping_cart_toggle', array(
            'type'                  => 'radio',
            'section'               => 'relia_header_section',
            'label'                 => __( 'Show or Hide the Shopping Cart icon?', 'relia' ),
            'description'           => __( 'Specify whether the WooCommerce cart icon should appear in the header', 'relia' ),
            'choices'               => array(
                'show'              => __( 'Show', 'relia' ),
                'hide'              => __( 'Hide', 'relia' ),
        ) ) );
    
    endif;
    
// ---------------------------------------------
// Footer Section
// ---------------------------------------------
$wp_customize->add_section( 'relia_footer_section', array(
    'title'                 => __( 'Footer', 'relia'),
    'description'           => __( 'Customize the contents of the site footer', 'relia' ),
    'panel'                 => 'relia_general_panel'
) );

// ---------------------------------------------
// Footer Section - Settings & Controls
// ---------------------------------------------

    // Use Image or Colour for Footer Background? 
    $wp_customize->add_setting( 'relia_footer_background_type', array (
        'default'               => 'image',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_static_background_toggle',
    ) );
    $wp_customize->add_control( 'relia_footer_background_type', array(
        'type'                  => 'radio',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Image or Color', 'relia' ),
        'description'           => __( 'Specify whether you would like the background of the footer to be solid colour or an image', 'relia' ),
        'choices'               => array(
            'image'             => __( 'Use a background image', 'relia' ),
            'color'             => __( 'Use a solid color background', 'relia' ),
    ) ) );
    
    // Footer Background Image
    $wp_customize->add_setting( 'relia_footer_image', array (
        'default'               => get_template_directory_uri() . '/inc/images/page-header-bg.jpg',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'relia_footer_image', array (
        'mime_type'             => 'image',
        'settings'              => 'relia_footer_image',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Footer Background Image', 'relia' ),
        'description'           => __( 'Select the image file that you would like to use as the footer background', 'relia' ),        
    ) ) );
    
    // Footer Background Color
    $wp_customize->add_setting( 'relia_footer_background_color', array (
        'default'               => '#1c1c1c',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_skin'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'relia_footer_background_color', array(
        'label'                 => __( 'Footer Background Color', 'relia' ),
        'section'               => 'relia_footer_section',
        'settings'              => 'relia_footer_background_color',
    ) ) );
    
    // Footer Copyright Text
    $wp_customize->add_setting( 'relia_footer_copyright', array (
        'default'               => __( 'Company Name', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_footer_copyright', array(
        'type'                  => 'text',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Company Name for Copyright', 'relia' ),
    ) );
    
    // Social Icons - Include Facebook
    $wp_customize->add_setting( 'relia_include_icon_facebook', array (
        'default'               => 'http://facebook.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_facebook', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Facebook URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Social Icons - Include Twitter
    $wp_customize->add_setting( 'relia_include_icon_twitter', array (
        'default'               => 'http://twitter.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_twitter', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Twitter URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Social Icons - Include Google+
    $wp_customize->add_setting( 'relia_include_icon_google', array (
        'default'               => 'http://plus.google.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_google', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Google+ URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );

    // Social Icons - Include LinkedIn
    $wp_customize->add_setting( 'relia_include_icon_linkedin', array (
        'default'               => 'http://linkedin.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_linkedin', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'LinkedIn URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );

    // Social Icons - Include YouTube
    $wp_customize->add_setting( 'relia_include_icon_youtube', array (
        'default'               => 'http://youtube.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_youtube', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'YouTube URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Social Icons - Include Vimeo
    $wp_customize->add_setting( 'relia_include_icon_vimeo', array (
        'default'               => 'http://vimeo.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_vimeo', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Vimeo URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Social Icons - Include Music
    $wp_customize->add_setting( 'relia_include_icon_music', array (
        'default'               => 'http://itunes.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_music', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Music URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Social Icons - Include Instagram
    $wp_customize->add_setting( 'relia_include_icon_instagram', array (
        'default'               => 'http://instagram.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_instagram', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Instagram URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Social Icons - Include Pinterest
    $wp_customize->add_setting( 'relia_include_icon_pinterest', array (
        'default'               => 'http://pinterest.com',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_include_icon_pinterest', array(
        'type'                  => 'url',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Pinterest URL', 'relia' ),
        'description'           => __( 'When left blank, this icon will not be shown', 'relia' ),
    ) );
    
    // Payment Icons - Visa
    $wp_customize->add_setting( 'relia_include_cc_visa', array (
        'default'               => true,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'relia_include_cc_visa', array(
        'type'                  => 'checkbox',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Display Visa Icon?', 'relia' ),
    ) );
    
    // Payment Icons - MasterCard
    $wp_customize->add_setting( 'relia_include_cc_mastercard', array (
        'default'               => true,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'relia_include_cc_mastercard', array(
        'type'                  => 'checkbox',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Display MasterCard Icon?', 'relia' ),
    ) );
    
    // Payment Icons - American Express
    $wp_customize->add_setting( 'relia_include_cc_amex', array (
        'default'               => true,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'relia_include_cc_amex', array(
        'type'                  => 'checkbox',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Display American Express Icon?', 'relia' ),
    ) );
    
    // Payment Icons - PayPal
    $wp_customize->add_setting( 'relia_include_cc_paypal', array (
        'default'               => true,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'relia_include_cc_paypal', array(
        'type'                  => 'checkbox',
        'section'               => 'relia_footer_section',
        'label'                 => __( 'Display PayPal Icon?', 'relia' ),
    ) );
    