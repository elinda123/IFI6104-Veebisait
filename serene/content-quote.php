<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="top-info"<?php serene_blockquote_color(); ?>>
		<div class="post-content clearfix">
			<div class="entry-content clearfix">
				<?php echo serene_get_blockquote_in_content(); ?>
			</div>
		</div> <!-- .post-content -->

		<?php serene_post_meta_info(); ?>

		<?php if ( ! is_single() ) : ?>
		<a href="<?php the_permalink(); ?>" class="et-quote-more-link"><?php esc_html_e( 'Read More', 'Serene' ); ?></a>
		<?php endif; ?>
	</div> <!-- .top-info -->

	<?php if ( is_single() ) : ?>

	<div class="bottom-info"<?php echo serene_get_post_background(); ?>>
		<div class="post-content">
			<h1 class="title"><?php the_title(); ?></h1>

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

	<?php endif; ?>
</article>