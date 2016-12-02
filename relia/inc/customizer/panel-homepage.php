<?php

// ---------------------------------------------
// Homepage Panel
// ---------------------------------------------
$wp_customize->add_panel( 'relia_homepage_panel', array (
    'title'                 => __( 'Homepage', 'relia' ),
    'description'           => __( 'Customize the appearance of your homepage', 'relia' ),
    'priority'              => 10
) );

    // ---------------------------------------------
    // Homepage Widget A
    // ---------------------------------------------
    $wp_customize->add_section( 'relia_home_widget_area_a_section', array(
        'title'                 => __( 'Homepage Widget Area A', 'relia'),
        'panel'                 => 'relia_homepage_panel'
    ) );

        // Toggle Visibility of Widget Area A
        $wp_customize->add_setting( 'relia_toggle_widget_area_a', array (
            'default'               => 'on',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'relia_sanitize_widget_area_toggle',
        ) );
        $wp_customize->add_control( 'relia_toggle_widget_area_a', array(
            'type'                  => 'radio',
            'section'               => 'relia_home_widget_area_a_section',
            'label'                 => __( 'Show Home Page Widget Area A?', 'relia' ),
            'choices'               => array(
                'on'            => __( 'Visible', 'relia' ),
                'off'           => __( 'Hidden', 'relia' ),
        ) ) );

    
// ---------------------------------------------
// Features Section
// ---------------------------------------------
$wp_customize->add_section( 'relia_features_section', array(
    'title'                 => __( 'Feature List CTAs', 'relia' ),
    'description'           => __( 'Customize the 3 icons CTAs that appear in the Features section', 'relia' ),
    'panel'                 => 'relia_homepage_panel'
) );

    // ---------------------------------------------
    // Features Section Heading
    // ---------------------------------------------

    // Show Feature List Section?
    $wp_customize->add_setting( 'relia_features_list_bool', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'relia_features_list_bool', array(
        'type'                  => 'radio',
        'section'               => 'relia_features_section',
        'label'                 => __( 'Show the Features List Section?', 'relia' ),
        'choices'               => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
    ) ) );

    // Features Section Heading
    $wp_customize->add_setting( 'relia_features_heading', array (
        'default'               => 'Features',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_heading', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'Features Section Heading', 'relia' ),
    ) );
    
    // ---------------------------------------------
    // CTA 1
    // ---------------------------------------------
   
    // CTA 1 - Icon
    $wp_customize->add_setting( 'relia_features_cta_1_icon', array (
        'default'               => 'fa-star',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_icon',
    ) );
    $wp_customize->add_control( 'relia_features_cta_1_icon', array(
        'type'                  => 'select',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 1 - Icon', 'relia' ),
        'choices'               => relia_icons(),
    ) );
    
    // CTA 1 - Title
    $wp_customize->add_setting( 'relia_features_cta_1_title', array (
        'default'               => __( 'CTA Title', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_cta_1_title', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 1 - Title', 'relia' ),
    ) );
    
    // CTA 1 - Tagline
    $wp_customize->add_setting( 'relia_features_cta_1_tagline', array (
        'default'               => __( 'Description', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_cta_1_tagline', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 1 - Tagline', 'relia' ),
    ) );
    
    // ---------------------------------------------
    // CTA 2
    // ---------------------------------------------
    
    // CTA 2 - Icon
    $wp_customize->add_setting( 'relia_features_cta_2_icon', array (
        'default'               => 'fa-star',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_icon',
    ) );
    $wp_customize->add_control( 'relia_features_cta_2_icon', array(
        'type'                  => 'select',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 2 - Icon', 'relia' ),
        'choices'               => relia_icons(),
    ) );
    
    // CTA 2 - Title
    $wp_customize->add_setting( 'relia_features_cta_2_title', array (
        'default'               => __( 'CTA Title', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_cta_2_title', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 2 - Title', 'relia' ),
    ) );
    
    // CTA 2 - Tagline
    $wp_customize->add_setting( 'relia_features_cta_2_tagline', array (
        'default'               => __( 'Description', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_cta_2_tagline', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 2 - Tagline', 'relia' ),
    ) );
    
    // ---------------------------------------------
    // CTA 3
    // ---------------------------------------------
    
    // CTA 3 - Icon
    $wp_customize->add_setting( 'relia_features_cta_3_icon', array (
        'default'               => 'fa-star',
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_icon',
    ) );
    $wp_customize->add_control( 'relia_features_cta_3_icon', array(
        'type'                  => 'select',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 3 - Icon', 'relia' ),
        'choices'               => relia_icons(),
    ) );
    
    // CTA 3 - Title
    $wp_customize->add_setting( 'relia_features_cta_3_title', array (
        'default'               => __( 'CTA Title', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_cta_3_title', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 3 - Title', 'relia' ),
    ) );
    
    // CTA 3 - Tagline
    $wp_customize->add_setting( 'relia_features_cta_3_tagline', array (
        'default'               => __( 'Description', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_features_cta_3_tagline', array(
        'type'                  => 'text',
        'section'               => 'relia_features_section',
        'label'                 => __( 'CTA 3 - Tagline', 'relia' ),
    ) );
    
// ---------------------------------------------
// Featured or Recent Articles Section
// ---------------------------------------------
$wp_customize->add_section( 'relia_articles_section', array(
    'title'                 => __( 'Homepage Articles', 'relia'),
    'description'           => __( 'Customize the section where recent or featured articles are displayed on the homepage', 'relia' ),
    'panel'                 => 'relia_homepage_panel'
) );

// ---------------------------------------------
// Featured or Recent Articles Section - Settings & Controls
// ---------------------------------------------

    // Show Recent / Featured Articles Section?
    $wp_customize->add_setting( 'relia_recent_articles_bool', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'relia_recent_articles_bool', array(
        'type'                  => 'radio',
        'section'               => 'relia_articles_section',
        'label'                 => __( 'Show the Homepage Articles Section?', 'relia' ),
        'choices'               => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
    ) ) );

    // Articles Section Heading
    $wp_customize->add_setting( 'relia_articles_heading', array (
        'default'               => __( 'Homepage Articles', 'relia' ),
        'transport'             => 'postMessage',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_articles_heading', array(
        'type'                  => 'text',
        'section'               => 'relia_articles_section',
        'label'                 => __( 'Articles Section Heading', 'relia' ),
    ) );
    
    // Read More Link Text
    $wp_customize->add_setting( 'relia_homepage_articles_read_more', array (
        'default'               => __( 'Read More', 'relia' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_homepage_articles_read_more', array(
        'type'                  => 'text',
        'section'               => 'relia_articles_section',
        'label'                 => __( '"Read More" Link Text', 'relia' ),
    ) );

    
    
    // Featured or Recent 
    $wp_customize->add_setting( 'relia_articles_content', array (
        'default'               => 'featured',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_articles_switch',
    ) );
    $wp_customize->add_control( 'relia_articles_content', array(
        'type'                  => 'radio',
        'section'               => 'relia_articles_section',
        'label'                 => __( 'Articles to be Displayed', 'relia' ),
        'description'           => __( 'Specify whether you would like to select 3 articles to feature or automatically display the most recent articles', 'relia' ),
        'choices'               => array(
            'recent'            => __( 'Show Most Recent', 'relia' ),
            'featured'          => __( 'Use Featured', 'relia' ),
    ) ) );
    
    // Featured Article 1
    $wp_customize->add_setting( 'relia_featured_article_1', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_post',
    ) );
    $wp_customize->add_control( 'relia_featured_article_1', array(
        'type'                  => 'select',
        'section'               => 'relia_articles_section',
        'label'                 => __( 'Featured Article 1', 'relia' ),
        'choices'               => relia_all_posts_array(),
    ) );
    
    // Featured Article 2
    $wp_customize->add_setting( 'relia_featured_article_2', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_post',
    ) );
    $wp_customize->add_control( 'relia_featured_article_2', array(
        'type'                  => 'select',
        'section'               => 'relia_articles_section',
        'label'                 => __( 'Featured Article 2', 'relia' ),
        'choices'               => relia_all_posts_array(),
    ) );
    
    // Featured Article 3
    $wp_customize->add_setting( 'relia_featured_article_3', array (
        'default'               => null,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_post',
    ) );
    $wp_customize->add_control( 'relia_featured_article_3', array(
        'type'                  => 'select',
        'section'               => 'relia_articles_section',
        'label'                 => __( 'Featured Article 3', 'relia' ),
        'choices'               => relia_all_posts_array(),
    ) );
    
    
// ---------------------------------------------
// relia_static_front_page_section
// ---------------------------------------------
$wp_customize->add_section( 'static_front_page', array (
    'title'     => __( 'Homepage Content', 'relia' ),
    'panel'     => 'relia_homepage_panel',
) );
    
    // Featured Content Title
    $wp_customize->add_setting( 'relia_homepage_content_title', array (
        'default'               => __( 'Featured Content', 'relia' ),
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_text',
    ) );
    $wp_customize->add_control( 'relia_homepage_content_title', array(
        'type'                  => 'text',
        'section'               => 'static_front_page',
        'label'                 => __( 'Frontpage content title', 'relia' ),
    ) );
    
    // Show or Hide Featured Content Title
    $wp_customize->add_setting( 'relia_homepage_content_title_toggle', array (
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'relia_sanitize_show_hide',
    ) );
    $wp_customize->add_control( 'relia_homepage_content_title_toggle', array(
        'type'                  => 'radio',
        'section'               => 'static_front_page',
        'label'                 => __( 'Show the frontpage content title?', 'relia' ),
        'choices'               => array(
            'show'              => __( 'Show', 'relia' ),
            'hide'              => __( 'Hide', 'relia' ),
    ) ) );