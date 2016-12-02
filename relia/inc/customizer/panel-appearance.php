<?php

// ---------------------------------------------
// Appearance Panel
// ---------------------------------------------
$wp_customize->add_panel( 'relia_appearance_panel', array (
    'title'                     => __( 'Appearance', 'relia' ),
    'description'               => __( 'Customize your site colors, fonts and other appearance settings', 'relia' ),
    'priority'                  => 10
) );

// ---------------------------------------------
// Color Section
// ---------------------------------------------
$wp_customize->add_section( 'relia_color_section', array (
    'title'                     => __( 'Skin Color', 'relia' ),
    'panel'                     => 'relia_appearance_panel',
) );

// ---------------------------------------------
// Color Section - Settings & Controls
// ---------------------------------------------
    
    // Preset Color
    $wp_customize->add_setting('relia_preset_theme_color', array(
        'default'               => 'gold',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text'
    ));
    $wp_customize->add_control('relia_preset_theme_color', array(
        'type'                  => 'radio',
        'section'               => 'relia_color_section',
        'label'                 => __('Preset Skin Color', 'relia'),
        'description'           => __('Select the main theme color from a preset', 'relia'),
        'choices'   => array(
            'gold'      => __('Gold', 'relia'),
            'green'     => __('Green', 'relia'),
            'teal'      => __('Teal', 'relia'),
            'blue'      => __('Blue', 'relia'),
            'purple'    => __('Purple', 'relia'),
            'red'       => __('Red', 'relia'),
        )
    ));
    
    // Menu Bar Link Item Brightness
    $wp_customize->add_setting('relia_light_menu_item_toggle', array(
        'default'               => 'dark',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_nav_link_toggle'
    ));
    $wp_customize->add_control('relia_light_menu_item_toggle', array(
        'type'                  => 'radio',
        'section'               => 'relia_color_section',
        'label'                 => __('Dark or Light navigation links?', 'relia'),
        'description'           => __('This allows you to set the nav links to either light or dark, helpful for maintaining visibility with certain colors', 'relia'),
        'choices'   => array(
            'dark'          => __('Dark Links', 'relia'),
            'bright'        => __('Bright Links', 'relia'),
        )
    ));
    
// ---------------------------------------------
// Fonts Section
// ---------------------------------------------
$wp_customize->add_section('relia_fonts_section', array(
    'title'     => __('Fonts', 'relia'),
    'panel'     => 'relia_appearance_panel',
));
    
// ---------------------------------------------
// Fonts Section - Settings & Controls
// ---------------------------------------------

    // Primary Font
    $wp_customize->add_setting('relia_font_primary', array(
        'default'               => 'Dosis, sans-serif',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text'
    ));
    $wp_customize->add_control('relia_font_primary', array(
        'type'                  => 'select',
        'section'               => 'relia_fonts_section',
        'label'                 => __('Primary Font', 'relia'),
        'description'           => __('Select the primary font of the theme', 'relia'),
        'choices'               => relia_fonts()
    ));

    // Secondary Font
    $wp_customize->add_setting('relia_font_secondary', array(
        'default'               => 'Abel, sans-serif',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text'
    ));
    $wp_customize->add_control('relia_font_secondary', array(
        'type'                  => 'select',
        'section'               => 'relia_fonts_section',
        'label'                 => __('Secondary Font', 'relia'),
        'description'           => __('Select the secondary font of the theme', 'relia'),
        'choices'               => relia_fonts()
    ));
    
    // Body Font
    $wp_customize->add_setting('relia_font_body', array(
        'default' => 'Open Sans, sans-serif',
        'transport' => 'refresh',
        'sanitize_callback' => 'relia_sanitize_text'
    ));
    $wp_customize->add_control('relia_font_body', array(
        'type'                  => 'select',
        'section'               => 'relia_fonts_section',
        'label'                 => __('Body Font', 'relia'),
        'description'           => __('Select the secondary font of the theme', 'relia'),
        'choices'               => relia_fonts()
    ));
    
    // Theme Title Font Size
    $wp_customize->add_setting( 'relia_title_font_size', array (
        'default'               => 36,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_integer',
    ) );
    $wp_customize->add_control( 'relia_title_font_size', array(
        'type'                  => 'number',
        'section'               => 'relia_fonts_section',
        'label'                 => __( 'Site Title Font Size', 'relia' ),
        'description'           => __( 'Adjust the font size of the site title in pixels', 'relia' ),
        'input_attrs'           => array(
            'min' => 26,
            'max' => 60,
            'step' => 2,
    ) ) );
    
    // Body Font Size
    $wp_customize->add_setting( 'relia_body_font_size', array (
        'default'               => 16,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_integer',
    ) );
    $wp_customize->add_control( 'relia_body_font_size', array(
        'type'                  => 'number',
        'section'               => 'relia_fonts_section',
        'label'                 => __( 'Body Text Font Size', 'relia' ),
        'description'           => __( 'Adjust the font size of most generic text content in pixels', 'relia' ),
        'input_attrs'           => array(
            'min' => 8,
            'max' => 22,
            'step' => 2,
    ) ) );
    
    // Menu Bar Item Font Size
    $wp_customize->add_setting( 'relia_menu_bar_item_size', array (
        'default'               => 14,
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_integer',
    ) );
    $wp_customize->add_control( 'relia_menu_bar_item_size', array(
        'type'                  => 'number',
        'section'               => 'relia_fonts_section',
        'label'                 => __( 'Main Navigation Menu Font Size', 'relia' ),
        'description'           => __( 'Applies to the top level menu bar items (does not affect sub-items)', 'relia' ),
        'input_attrs'           => array(
            'min' => 8,
            'max' => 24,
            'step' => 2,
    ) ) );
    
// ---------------------------------------------
// Sidebars Section
// ---------------------------------------------
$wp_customize->add_section('relia_sidebars_section', array(
    'title' => __('Sidebars', 'relia'),
    'panel' => 'relia_appearance_panel',
));

    // Single Posts Sidebar 
    $wp_customize->add_setting('relia_sidebar_option_post', array(
        'default'               => 'right',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text'
    ));
    $wp_customize->add_control('relia_sidebar_option_post', array(
        'type' => 'select',
        'section' => 'relia_sidebars_section',
        'label' => __('Sidebar on Single Posts', 'relia'),
        'description' => __('You can select on/off to display/hide the sidebar on Single Posts', 'relia'),
        // 'description' => __('Choose whether Single Posts have a sidebar, and where it will appear', 'relia'),
        'choices' => array(
            'left'              => 'Left Sidebar',
            'right'             => 'Right Sidebar',
            'both'              => 'Left & Right',
            'none'              => 'No Sidebar',
    ) ) );
    
    // Blog & Archive Sidebar 
    $wp_customize->add_setting('relia_sidebar_option_blog', array(
        'default'               => 'right',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text'
    ));
    $wp_customize->add_control('relia_sidebar_option_blog', array(
        'type' => 'select',
        'section' => 'relia_sidebars_section',
        'label' => __('Sidebar on Blog & Archive Pages', 'relia'),
        'description' => __('You can select on/off to display/hide the sidebar on Post pages', 'relia'),
        // 'description' => __('Choose whether Blog & Archive pages have a sidebar, and where it will appear', 'relia'),
        'choices' => array(
            'left'              => 'Left Sidebar',
            'right'             => 'Right Sidebar',
            'both'              => 'Left & Right',
            'none'              => 'No Sidebar',
    ) ) );