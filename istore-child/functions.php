<?php
/**
 * Function describe for iStore child
 * 
 * @package istore-child
 */
 
function istore_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'istore-style' for the iStore theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'istore_enqueue_styles' );
?>