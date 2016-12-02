<?php

// ---------------------------------------------
// Blog Panel
// ---------------------------------------------
$wp_customize->add_panel( 'relia_blog_panel', array (
    'title'                 => __( 'Blog', 'relia' ),
    'description'           => __( 'Customize the appearance of the Blog', 'relia' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Layout Section
// ---------------------------------------------

$wp_customize->add_section( 'relia_blog_layout_section', array (
    'title'                 => __( 'Layout', 'relia' ),
    'description'           => __( 'Customize the layout of your blog template', 'relia' ),
    'panel'                 => 'relia_blog_panel',
) );

// ---------------------------------------------
// relia_blog_layout_section
// ---------------------------------------------

    // Blog Section Title
    $wp_customize->add_setting( 'relia_blog_roll_title', array (
        'default'               => __( 'News', 'relia' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_blog_roll_title', array(
        'type'                  => 'text',
        'section'               => 'relia_blog_layout_section',
        'label'                 => __( 'Blog Roll Title', 'relia' ),
    ) );

    // Read More Button Text
    $wp_customize->add_setting( 'relia_blog_read_more', array (
        'default'               => __( 'Read More', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_blog_read_more', array(
        'type'                  => 'text',
        'section'               => 'relia_blog_layout_section',
        'label'                 => __( '"Read More" Text', 'relia' ),
        'description'           => __( 'This is the link text to the post from the blog', 'relia' ),
    ) );
    
    // Display Post Date?
    $wp_customize->add_setting( 'relia_blog_show_date', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'relia_blog_show_date', array(
        'label'                 => __( 'Post Date', 'relia' ),
        'section'               => 'relia_blog_layout_section',
        'type'                  => 'radio',
        'choices'   => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
        )
    ));
    
    // Display Post Author?
    $wp_customize->add_setting( 'relia_blog_show_author', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'relia_blog_show_author', array(
        'label'                 => __( 'Post Author', 'relia' ),
        'section'               => 'relia_blog_layout_section',
        'type'                  => 'radio',
        'choices'   => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
        )
    ));
