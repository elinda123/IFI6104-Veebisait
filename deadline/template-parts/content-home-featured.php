<?php
/**
 * The template used for displaying featured posts on the Front Page.
 *
 * @package Deadline
 */
?>

<?php
	
	$featured_tag = get_theme_mod( 'deadline_featured_term_1', 'featured' );
	
	$custom_loop = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'tag' 		 	 => sanitize_text_field($featured_tag)
	) );
?>

<?php if ( $custom_loop->have_posts() ) : $i = 0; $m = 0; ?>

	<div id="ilovewp-featured-posts">
	
		<p class="widget-title"><?php _e('Featured Posts','deadline'); ?></p>
		
		<ul class="ilovewp-posts clearfix">

		<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?>

		<?php if ($i === 1) { ?>

			<?php $classes = array('ilovewp-post','ilovewp-featured-post','featured-post-main'); ?>
			
			<li <?php post_class($classes); ?>>
				<div class="ilovewp-post-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-cover">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('deadline-large-thumbnail'); ?></a>
					</div><!-- .post-cover -->
					<?php endif; ?>
					<div class="post-preview">
						<div class="post-preview-wrapper">
							<span class="post-meta-category"><?php the_category(', '); ?></span>
							<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php if ( 1 == get_theme_mod( 'deadline_front_featured_posts_date', 0 ) ) { ?>
							<p class="post-meta">
								<span class="posted-on"><span class="genericon genericon-time" aria-hidden="true"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
							</p><!-- .post-meta -->
							<?php } ?>
						</div><!-- .post-preview-wrapper -->
					</div><!-- .post-preview -->
				</div><!-- .ilovewp-post-wrapper -->
			</li><!-- .ilovewp-post .ilovewp-featured-post .featured-post-main -->
		
		<?php } else { $m++; ?>

			<?php $classes = array('ilovewp-post','ilovewp-featured-post','featured-post-simple','featured-post-simple-'.$m); ?>
			<li <?php post_class($classes); ?>>
				<div class="ilovewp-post-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-cover">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('deadline-small-thumbnail'); ?></a>
						<span class="post-meta-category"><?php the_category(', '); ?></span>
					</div><!-- .post-cover -->
					<?php endif; ?>
					<div class="post-preview">
						<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<?php if ( 1 == get_theme_mod( 'deadline_front_featured_posts_date', 0 ) ) { ?>
						<p class="post-meta">
							<span class="posted-on"><span class="genericon genericon-time" aria-hidden="true"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
						</p><!-- .post-meta -->
						<?php } ?>
					</div><!-- .post-preview -->
				</div><!-- .ilovewp-post-wrapper -->
			</li><!-- .ilovewp-post .ilovewp-featured-post .featured-post-simple .featured-post-simple-<?php echo $m; ?> -->
		
		<?php } ?>
		
		<?php endwhile; ?>
		
		<?php wp_reset_postdata(); ?>

		</ul><!-- .ilovewp-posts .clearfix -->
	</div><!-- #ilovewp-featured-posts -->

<?php else : ?>

	<?php if ( current_user_can( 'publish_posts' ) ) : ?>

		<div id="ilovewp-featured-posts">

			<div class="ilovewp-page-intro">
				<h1 class="title-page"><?php esc_html_e( 'No Featured Posts Found', 'deadline' ); ?></h1>
				<div class="taxonomy-description">

					<p><?php printf( esc_html__( 'This section will display your featured posts. Configure (or disable) it via the Customizer.', 'deadline' ) ); ?><br>
					<?php printf( wp_kses( __( 'You can mark your posts with a "Featured" tag on the Edit Post page. <a href="%1$s">Get started here</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php' ) ) ); ?></p>
					<p><strong><?php printf( esc_html__( 'Important: This message is NOT visible to site visitors, only to admins and editors.', 'deadline' ) ); ?></strong></p>

				</div><!-- .taxonomy-description -->
			</div><!-- .ilovewp-page-intro -->

		</div><!-- #ilovewp-featured-posts -->

	<?php endif; ?>

<?php endif; ?>