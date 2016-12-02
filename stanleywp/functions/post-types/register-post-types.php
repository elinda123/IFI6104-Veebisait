<?php
/**
 * Registers custom post types for use with this theme
 *
 * @package WordPress
*/

add_action( 'init', 'bi_create_post_types' );

if ( !function_exists('bi_create_post_types') ) {
	
	function bi_create_post_types() {
	
	
		/******* Portfolio Post Type *******/
	
		$portfolio_slug = ( bi_get_data('portfolio_post_type_slug') ) ? bi_get_data('portfolio_post_type_slug') : 'portfolio';
		$portfolio_post_type_name = ( bi_get_data('portfolio_post_type_name') ) ? bi_get_data('portfolio_post_type_name') : __('Portfolio','gents');
		$portfolio_labels = array( 'name' => $portfolio_post_type_name );
		
		register_post_type( 'Portfolio',
			array(
			  'labels' => apply_filters('bi_portfolio_labels', $portfolio_labels),
			  'public' => true,
			  'has_archive' => false,
			  'supports' => array('title','editor','thumbnail','revisions','comments','custom-fields'),
			  'query_var' => true,
			  'rewrite' => array( 'slug' => $portfolio_slug ),
			  'menu_icon' => get_template_directory_uri() . '/images/admin/icon-portfolio.png',
			)
		  );
	
	}
}