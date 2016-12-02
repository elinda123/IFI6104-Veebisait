<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo serene_get_post_background(); ?>>

	<?php if ( '' != get_the_post_thumbnail() || 'video' === get_post_format() ) : ?>

	<div class="main-image<?php if ( '' == get_the_post_thumbnail() && 'video' === get_post_format() ) echo ' et_video_only'; ?>">

		<?php if ( 'video' === get_post_format() && false !== ( $first_video = et_get_first_video() ) ) : ?>
		<div class="et-video-container">
			<?php echo $first_video; ?>
		</div>
		<?php endif; ?>

		<?php if ( ! is_single() || ! 'video' !== get_post_format() ) : ?>
		<a href="<?php the_permalink(); ?>" class="et-main-image-link">
		<?php endif; ?>

			<?php the_post_thumbnail( 'serene-featured-image' ); ?>

			<?php serene_post_meta_info(); ?>

		<?php if ( isset( $first_video ) && $first_video ) : ?>
			<span class="et-play-video"></span>
		<?php endif; ?>

		<?php if ( ! is_single() || ! 'video' !== get_post_format() ) : ?>
		</a>
		<?php endif; ?>

	</div> <!-- .main-image -->

	<?php endif; ?>

	<div class="post-content clearfix">
		<?php if ( is_single() ) : ?>
		<h1 class="title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>

		<?php et_postinfo_meta(); ?>

		<div class="entry-content clearfix">
		<?php
		if ( is_single() ) {
			the_content();

			wp_link_pages( array(
				'before'         => '<p><strong>' . esc_attr__( 'Pages', 'Serene' ) . ':</strong> ',
				'after'          => '</p>',
				'next_or_number' => 'number',
			) );

			the_tags( '<ul class="et-tags clearfix"><li>', '</li><li>', '</li></ul>' );

			edit_post_link( esc_attr__( 'Edit this post', 'Serene' ) );
		} else {
			if ( false === ( $show_content = get_theme_mod( 'show_content' ) ) || '' === $show_content ) {
				the_excerpt();
			} else {
				the_content();
			}
		}
		?>
		</div>
	</div> <!-- .post-content -->

	<?php
	if ( '' == get_the_post_thumbnail() )
		serene_post_meta_info();
	?>

</article>