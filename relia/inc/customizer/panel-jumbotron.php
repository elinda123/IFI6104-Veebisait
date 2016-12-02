<?php

// ---------------------------------------------
// Jumbotron Panel
// ---------------------------------------------
$wp_customize->add_panel( 'relia_jumbotron_panel', array (
    'title'                 => __( 'Jumbotron', 'relia' ),
    'description'           => __( 'Customize the appearance of the site Jumbotron. The jumbotron shows up on the Frontpage', 'relia' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Jumbotron Sections
// ---------------------------------------------

$wp_customize->add_section( 'relia_static_bg_section', array(
    'title'                 => __( 'Background Image', 'relia'),
    'description'           => __( 'Customize the large banner on your homepage', 'relia' ),
    'panel'                 => 'relia_jumbotron_panel'
) );
    
$wp_customize->add_section( 'relia_slide_settings_section', array (
    'title'                 => __( 'Jumbotron Settings', 'relia' ),
    'description'           => __( 'Adjust the slider speed & animation', 'relia' ),
    'panel'                 => 'relia_jumbotron_panel',
) );

// ---------------------------------------------
// relia_static_bg_section
// ---------------------------------------------

    // Use Image or Colour for Static Background? 
    $wp_customize->add_setting( 'relia_static_jumbotron_type', array (
        'default'               => 'image',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_static_background_toggle',
    ) );
    $wp_customize->add_control( 'relia_static_jumbotron_type', array(
        'type'                  => 'radio',
        'section'               => 'relia_static_bg_section',
        'label'                 => __( 'Image or Color', 'relia' ),
        'description'           => __( 'Specify whether you would like the background of the static jumbotron to be solid colour or a single image', 'relia' ),
        'choices'               => array(
            'image'             => __( 'Use a background image', 'relia' ),
            'color'              => __( 'Use a solid color background', 'relia' ),
    ) ) );

    // Static Jumbotron Image
    $wp_customize->add_setting( 'relia_jumbotron_static_image', array (
            'default'               => get_template_directory_uri() . '/inc/images/relia_hero.jpg',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'esc_url_raw',
        ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'relia_jumbotron_static_image', array (
        'mime_type'             => 'image',
        'settings'              => 'relia_jumbotron_static_image',
        'section'               => 'relia_static_bg_section',
        'label'                 => __( 'Static Background Image', 'relia' ),   
        'description'           => __( 'Select the image file that you would like to use as the homepage banner background', 'relia' ),
    ) ) );
    
    // Static Jumbotron Color
    $wp_customize->add_setting( 'relia_jumbotron_static_color', array (
        'default'               => '#1c1c1c',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'relia_jumbotron_static_color', array(
            'label'      => __( 'Static Background Color', 'relia' ),
            'section'    => 'relia_static_bg_section',
            'settings'   => 'relia_jumbotron_static_color',
    ) ) );
    
// ---------------------------------------------
// relia_slide_settings_section
// ---------------------------------------------
    
    // Display Jumbotron?
    $wp_customize->add_setting( 'relia_slider_bool', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'relia_slider_bool', array(
        'label'   => __( 'Display Jumbotron on Frontpage', 'relia' ),
        'section' => 'relia_slide_settings_section',
        'type'    => 'radio',
        'choices'    => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
        )
    ));
    
    // Jumbotron Height
    $wp_customize->add_setting( 'relia_slider_height', array (
        'default'               => 600,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_integer',
    ) );
    $wp_customize->add_control( 'relia_slider_height', array(
        'type'                  => 'number',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Jumbotron height', 'relia' ),
        'input_attrs'           => array(
            'min' => 1000,
            'max' => 300,
            'step' => 25,
    ) ) );
    
    // Slider Darkness Tint
    $wp_customize->add_setting( 'relia_slider_dark_tint', array (
        'default'               => .5,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_decimal',
    ) );
    $wp_customize->add_control( 'relia_slider_dark_tint', array(
        'type'                  => 'number',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Darkness Tint', 'relia' ),
        'description'           => __( 'Adjust the amount of dark tint to apply to slider images, from 0.0 for no tint to 1.0 for solid black, or anything in between', 'relia' ),
        'input_attrs'           => array(
            'min' => .0,
            'max' => 1.0,
            'step' => .05,
    ) ) );
    
    // Jumbotron Heading Text
    $wp_customize->add_setting( 'relia_jumbotron_heading', array (
        'default'               => __( 'Featured Product', 'relia' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_heading', array(
        'type'                  => 'text',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Main Jumbotron Heading', 'relia' ),
    ) );
    
    // Jumbotron Heading Font Size
    $wp_customize->add_setting( 'relia_jumbotron_heading_size', array (
        'default'               => 50,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_heading_size', array(
        'type'                  => 'number',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Jumbotron Heading Font Size', 'relia' ),
        'description'           => __( 'Adjust the font size of the jumbotron heading in pixels', 'relia' ),
        'input_attrs'           => array(
            'min' => 18,
            'max' => 72,
            'step' => 2,
    ) ) );
    
    // Jumbotron Button 1 - Text 
    $wp_customize->add_setting( 'relia_jumbotron_button_1_text', array (
        'default'               => __( 'View Collection', 'relia' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_1_text', array(
        'type'                  => 'text',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button 1 - Text', 'relia' ),
    ) );

    // Jumbotron Button 1 - Internal Link
    $wp_customize->add_setting( 'relia_jumbotron_button_1_internal', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_post',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_1_internal', array(
        'type'                  => 'select',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button 1 - Link to Post / Page', 'relia' ),
        'choices'               => relia_all_posts_array(),
    ) );
    
    // Jumbotron Button 1 - External URL
    $wp_customize->add_setting( 'relia_jumbotron_button_1_url', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_1_url', array(
        'type'                  => 'url',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button 1 - External URL', 'relia' ),
        'description'           => __( 'When not blank, forces Button 1 to link to an external URL instead of a specified post/page', 'relia' ),
    ) );

    // Jumbotron Button 2 - Text 
    $wp_customize->add_setting( 'relia_jumbotron_button_2_text', array (
        'default'               => __( 'Back Us On Kickstarter', 'relia' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_2_text', array(
        'type'                  => 'text',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button 2 - Text', 'relia' ),
    ) );

    // Jumbotron Button 2 - Internal Link
    $wp_customize->add_setting( 'relia_jumbotron_button_2_internal', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_post',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_2_internal', array(
        'type'                  => 'select',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button 2 - Link to Post / Page', 'relia' ),
        'choices'               => relia_all_posts_array(),
    ) );
    
    // Jumbotron Button 2 - External URL
    $wp_customize->add_setting( 'relia_jumbotron_button_2_url', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_2_url', array(
        'type'                  => 'url',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button 2 - External URL', 'relia' ),
        'description'           => __( 'When not blank, forces Button 1 to link to an external URL instead of a specified post/page', 'relia' ),
    ) );
    
    // Jumbotron Button Font Size
    $wp_customize->add_setting( 'relia_jumbotron_button_size', array (
        'default'               => 14,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_integer',
    ) );
    $wp_customize->add_control( 'relia_jumbotron_button_size', array(
        'type'                  => 'number',
        'section'               => 'relia_slide_settings_section',
        'label'                 => __( 'Button Font Size', 'relia' ),
        'input_attrs'           => array(
            'min' => 8,
            'max' => 40,
            'step' => 2,
    ) ) );