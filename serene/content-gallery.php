<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo serene_get_post_background(); ?>>
	<?php serene_gallery_images(); ?>

	<?php serene_post_meta_info(); ?>

	<div class="post-content clearfix">
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php et_postinfo_meta(); ?>
		<div class="entry-content clearfix">
		<?php
			if ( is_single() ) :
				the_content();

				wp_link_pages( array(
					'before'         => '<p><strong>' . esc_attr__( 'Pages', 'Serene' ) . ':</strong> ',
					'after'          => '</p>',
					'next_or_number' => 'number',
				) );

				the_tags( '<ul class="et-tags clearfix"><li>', '</li><li>', '</li></ul>' );

				edit_post_link( esc_attr__( 'Edit this post', 'Serene' ) );
			else :
				if ( false === ( $show_content = get_theme_mod( 'show_content' ) ) || '' === $show_content ) {
					the_excerpt();
				} else {
					the_content();
				}
			endif;
		?>
		</div>
	</div> <!-- .post-content -->
</article>