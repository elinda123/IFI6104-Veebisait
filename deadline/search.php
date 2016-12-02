<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Deadline
 */

get_header(); ?>

	<div id="site-main">

		<div class="wrapper wrapper-main clearfix">
		
			<main id="site-content" class="site-main" role="main">
			
				<div class="site-content-wrapper clearfix">

					<div class="ilovewp-page-intro ilovewp-archive-intro">					
						<h1 class="title-page"><?php printf( esc_html__( 'Search Results for: %s', 'deadline' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						<?php get_search_form(); ?>						
					</div><!-- .ilovewp-page-intro -->
					
					<?php if ( have_posts() ) : ?>
					
					<?php /* Start the Loop */ ?>
					<ul id="recent-posts" class="ilovewp-posts ilovewp-posts-archive">
					<?php while ( have_posts() ) : the_post(); ?>
		
						<?php
		
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
						?>
		
					<?php endwhile; ?>
					
					</ul><!-- .ilovewp-posts .ilovewp-posts-archive -->
		
					<?php 
					$args['prev_text'] = '<span class="nav-link-label"><span class="genericon genericon-previous" aria-hidden="true"></span></span>' . __('Older Posts', 'deadline');
					$args['next_text'] = __('Newer Posts', 'deadline') . '<span class="nav-link-label"><span class="genericon genericon-next" aria-hidden="true"></span></span>';
					the_posts_navigation($args); ?>
		
				<?php else : ?>
		
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
		
				<?php endif; ?>
					
				</div><!-- .site-content-wrapper .clearfix -->
				
			</main><!-- #site-content -->
			
			<?php get_sidebar(); ?>
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>