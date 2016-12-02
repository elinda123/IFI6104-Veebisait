<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="top-info">
		<div class="post-content clearfix">
			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="entry-content clearfix">
			<?php
				printf( '<a href="%s">%s</a>',
					esc_url( serene_get_link_url() ),
					esc_html( serene_get_link_url() )
				);
			?>
			</div>
		</div> <!-- .post-content -->

		<?php serene_post_meta_info(); ?>
	</div> <!-- .top-info -->

	<?php if ( is_single() ) : ?>

	<div class="bottom-info"<?php echo serene_get_post_background(); ?>>
		<div class="post-content">
			<?php et_postinfo_meta(); ?>

			<div class="entry-content clearfix">
			<?php
				the_content();

				wp_link_pages( array(
					'before'         => '<p><strong>' . esc_attr__( 'Pages', 'Serene' ) . ':</strong> ',
					'after'          => '</p>',
					'next_or_number' => 'number',
				) );

				the_tags( '<ul class="et-tags clearfix"><li>', '</li><li>', '</li></ul>' );

				edit_post_link( esc_attr__( 'Edit this post', 'Serene' ) );
			?>
			</div>
		</div> <!-- .post-content -->
	</div> <!-- .bottom-info -->

	<?php else : ?>

	<div class="et-link-icon"></div>

	<?php endif; ?>
</article>