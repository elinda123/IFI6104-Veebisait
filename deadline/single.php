<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Deadline
 */

get_header(); ?>

	<div id="site-main">

		<div class="wrapper wrapper-main clearfix">
		
			<main id="site-content" class="site-main" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>
				
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="thumbnail-post-intro">
					<?php the_post_thumbnail('deadline-large-thumbnail'); ?>
				</div><!-- .thumbnail-post-intro -->
				<?php endif; ?>
				
				<div class="site-content-wrapper clearfix">

					<?php get_template_part( 'template-parts/content', 'single' ); ?>
					
					<?php 
					$args['prev_text'] = '<span class="nav-link-label"><span class="genericon genericon-previous" aria-hidden="true"></span></span>' . '%title';
					$args['next_text'] = '%title' . '<span class="nav-link-label"><span class="genericon genericon-next" aria-hidden="true"></span></span>';
					echo get_the_post_navigation($args); ?>
					
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>
					
				</div><!-- .site-content-wrapper .clearfix -->
				
				<?php endwhile; // End of the loop. ?>
			
			</main><!-- #site-content -->
			
			<?php get_sidebar(); ?>
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>