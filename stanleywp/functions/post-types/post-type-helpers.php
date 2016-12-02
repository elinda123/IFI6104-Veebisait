<?php


/*
 * Create Arrays of Post Type Categories
 * @since 1.0
*/

function bi_posttype_cats($post_type) {
	
	if ( !post_type_exists( $post_type ) ) return;
	
	$post_type_cats = array();
	$post_type_cats_obj = get_terms( $post_type .'_cats' );
	$post_type_cats[''] = __('All','gents');
	foreach ( $post_type_cats_obj as $post_type_cat ) {
		$post_type_cats[$post_type_cat->term_id] = $post_type_cat->name;
	}
	return $post_type_cats;	
}



/*
 * Create Post Type Array for meta usage
 * @since 1.0
*/
if ( ! function_exists( 'bi_posttype_cats_meta_array' ) ) { 

	function bi_meta_term_array($taxonomy) {
		
		if ( ! taxonomy_exists($taxonomy) ) return;
		
		$terms = array();
		$terms_obj = get_terms( $taxonomy );
		
		$terms[] = array( 'name' => 'All', 'value' => 'all' );
		
		foreach ( $terms_obj as $term ) :
			$terms[] = array( 'name' => $term->name, 'value' => $term->term_id );
		endforeach;		
		
		return $terms;	
	}
	
}


/*
 * Displays Portfolio Categories For current postid
 * @since 1.0
*/

if ( ! function_exists('bi_portfolio_entry_cats') ) {
	function bi_portfolio_entry_cats($postid) {		
		$cats = get_the_terms( $postid, 'portfolio_category' );
		$output = '';	
		if( $cats ) {
			$output .= '<div class="portfolio-post-cats clearfix">';			
				foreach( $cats as $cat ) {
					$output .= '<a href="'. get_term_link($cat->slug, 'portfolio_category') .'" title="'. $cat->name .'">'. $cat->name .'<span>,</span></a>';
				}
			$output .='</div><!-- .portfolio-post-cats -->';
		}
		return $output;	
	}
}