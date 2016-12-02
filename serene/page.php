<?php
/**
 * @package Serene
 * @since Serene 1.0
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( '' != get_the_post_thumbnail() ) : ?>
	<div class="main-image">
		<?php the_post_thumbnail( 'serene-featured-image' ); ?>
	</div> <!-- .main-image -->
	<?php endif; ?>

	<div class="post-content clearfix">
		<header>
			<h1 class="title"><?php the_title(); ?></h1>

	<?php
		if ( '' !== ( $description = get_post_meta( get_the_ID(), '_et_page_subtitle', true ) ) )
			printf( '<p>%s</p>', esc_html( $description ) );
	?>
		</header>

		<div class="entry-content clearfix">
		<?php
			while ( have_posts() ) : the_post();
				the_content();
				wp_link_pages( array(
					'before'         => '<p><strong>' . esc_attr__( 'Pages', 'Serene' ) . ':</strong> ',
					'after'          => '</p>',
					'next_or_number' => 'number',
				) );
			endwhile; // end of the loop.
		?>
		</div>

		<?php edit_post_link( esc_attr__( 'Edit this post', 'Serene' ) ); ?>
	</div> <!-- .post-content -->

</article>

<?php comments_template( '', true ); ?>

<?php get_footer(); ?>