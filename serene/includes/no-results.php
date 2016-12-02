<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
?>


	<h1><?php esc_html_e( 'No Results Found', 'Serene' ); ?></h1>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'Serene' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'Serene' ); ?></p>
	<?php get_search_form(); ?>

<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'Serene' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>