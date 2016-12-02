<?php
/**
 * Registers custom taxomies for use with this theme
 *
 * @package WordPress
*/

add_action( 'init', 'bi_register_taxonomies' );

if ( !function_exists('bi_register_taxonomies') ) {
	
	function bi_register_taxonomies() {

		//portfolio
		$portfolio_post_type_name = bi_get_data('portfolio_post_type_name') ? bi_get_data('portfolio_post_type_name') : __('Portfolio','gents');
		$portfolio_tax_slug = bi_get_data('portfolio_tax_slug') ? bi_get_data('portfolio_tax_slug') : 'portfolio-category';

			// Portfolio taxonomies
		register_taxonomy('portfolio_cats','portfolio',array(
			'hierarchical' => true,
			'labels' => apply_filters('bi_portfolio_tax_labels', array(
				'name' => $portfolio_post_type_name . ' ' . __( 'Categories', 'gents' ),
				'singular_name' => $portfolio_post_type_name . ' '. __( 'Category', 'gents' ),
				'search_items' =>  __( 'Search Categories', 'gents' ),
				'all_items' => __( 'All Categories', 'gents' ),
				'parent_item' => __( 'Parent Category', 'gents' ),
				'parent_item_colon' => __( 'Parent Category:', 'gents' ),
				'edit_item' => __( 'Edit  Category', 'gents' ),
				'update_item' => __( 'Update Category', 'gents' ),
				'add_new_item' => __( 'Add New  Category', 'gents' ),
				'new_item_name' => __( 'New Category Name', 'gents' ),
				'choose_from_most_used'	=> __( 'Choose from the most used categories', 'gents' )
				)
			),
			'query_var' => true,
			'rewrite' => array( 'slug' => $portfolio_tax_slug ),
		));
		
	
	}
	
} ?>