<?php
/**
 * @package Serene
 * @since Serene 1.0
 */

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
	return;
}

if ( function_exists( 'wp_pagenavi' ) ) {
	wp_pagenavi();
	return;
}
?>

<div class="et-pagination clearfix">
	<div class="alignleft"><?php next_posts_link( esc_html__( '&lt;', 'Serene' ) ); ?></div>
	<div class="alignright"><?php previous_posts_link( esc_html__( '&gt;', 'Serene' ) ); ?></div>
</div>