<?php

// ---------------------------------------------
// Theme Branding Panel
// ---------------------------------------------

$wp_customize->add_panel( 'relia_branding_panel', array (
    'title'                 => __( 'Theme Branding', 'relia' ),
    'description'           => __( 'Customize the theme branding', 'relia' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Smartcat Branding Section
// ---------------------------------------------

$wp_customize->add_section( 'relia_smartcat_branding_section', array (
    'title'                 => __( 'Smartcat Branding', 'relia' ),
    'description'           => __( 'Use the settings below to set the visibility of the Smartcat branding', 'relia' ),
    'panel'                 => 'relia_branding_panel',
) );
