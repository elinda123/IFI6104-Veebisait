<?php
/**
 * Adds taxonomy filters to the admin pages
 *
 * @package WordPress
*/

if ( ! function_exists('bi_add_taxonomy_filters') ) :

	function bi_add_taxonomy_filters() {
		global $typenow;
	
		if( $typenow == 'portfolio' ){
			
			if( $typenow == 'portfolio') { $taxonomies = array('portfolio_cats'); }
			
	 
			foreach ($taxonomies as $tax_slug) {
				$tax_obj = get_taxonomy($tax_slug);
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if(count($terms) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>All Categories</option>";
					foreach ($terms as $term) { 
						echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
					}
					echo "</select>";
				}
			}
		}
	}
	add_action( 'restrict_manage_posts', 'bi_add_taxonomy_filters' );

endif;