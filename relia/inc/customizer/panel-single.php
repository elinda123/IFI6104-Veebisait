<?php

// ---------------------------------------------
// Single Post Panel
// ---------------------------------------------
$wp_customize->add_panel( 'relia_single_post_panel', array (
    'title'                 => __( 'Single Post', 'relia' ),
    'description'           => __( 'Customize the appearance of the Single Post', 'relia' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Layout Section
// ---------------------------------------------

$wp_customize->add_section( 'relia_single_post_layout_section', array (
    'title'                 => __( 'Layout', 'relia' ),
    'description'           => __( 'Customize the layout of your single post template', 'relia' ),
    'panel'                 => 'relia_single_post_panel',
) );

// ---------------------------------------------
// relia_single_post_layout_section
// ---------------------------------------------
    
    // Display Post Date?
    $wp_customize->add_setting( 'relia_single_show_date', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'relia_single_show_date', array(
        'label'                 => __( 'Post Date', 'relia' ),
        'section'               => 'relia_single_post_layout_section',
        'type'                  => 'radio',
        'choices'   => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
        )
    ));
    
    // Display Post Author?
    $wp_customize->add_setting( 'relia_single_show_author', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'relia_single_show_author', array(
        'label'                 => __( 'Post Author', 'relia' ),
        'section'               => 'relia_single_post_layout_section',
        'type'                  => 'radio',
        'choices'   => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
        )
    ));

    // Display Post Categories / Tags?
    $wp_customize->add_setting( 'relia_single_show_cat_tags', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide'
    ) );
    $wp_customize->add_control( 'relia_single_show_cat_tags', array(
        'label'                 => __( 'Post Categories / Tags', 'relia' ),
        'section'               => 'relia_single_post_layout_section',
        'type'                  => 'radio',
        'choices'   => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
        )
    ));
