<?php
/**
 * The template used for displaying featured categories on the Front Page.
 *
 * @package Deadline
 */
?>

<?php
	
	$x = 0;
	$max = 5;
	
	while ($x < $max) { 
		$x++;

		$array_categories[$x]['id'] = get_theme_mod( 'deadline_featured_category_' . $x, 0 );
		$array_categories[$x]['color'] = get_theme_mod( 'deadline_featured_category_color_' . $x, 'black' );
		$array_categories[$x]['layout'] = get_theme_mod( 'deadline_featured_category_layout_' . $x, 'default' );

	}
	
	foreach ( $array_categories as $array_category ) {
	
		if ( $array_category['id'] == 0 ) {
			continue;
		}
		
		$custom_loop = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 5,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'cat' 		 	 => absint($array_category['id'])
		) );
	
		?>

		<?php if ( $custom_loop->have_posts() ) : $i = 0; $m = 0; ?>
		
			<div class="widget clearfix">
			
				<div class="ilovewp-featured-category featured-category-layout-<?php if ( $array_category['layout'] == 'reverted' ) { echo '2'; } else { echo '1'; } ?>">
				
					<p class="widget-title<?php if ( $array_category['color'] != 'black' ) { echo ' title-' . $array_category['color']; } ?>"><a href="<?php echo esc_url( get_category_link($array_category['id']) ); ?>" title="<?php echo get_cat_name($array_category['id']); ?>"><?php echo get_cat_name($array_category['id']); ?></a></p>
					
					<div class="ilovewp-columns ilovewp-columns-2 clearfix">
					
						<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?>
				
						<?php if ($i === 1) { ?>
		
						<div class="ilovewp-column ilovewp-column-1">
						
							<div class="ilovewp-column-wrapper">
								<div class="ilovewp-post ilovewp-post-main">
								
									<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-cover">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail(); ?>
										</a>
									</div><!-- .post-cover -->
									<?php endif; ?>
									<div class="post-preview">
										<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<?php if ( 1 == get_theme_mod( 'deadline_front_featured_categories_date', 0 ) ) { ?>
										<p class="post-meta">
											<span class="posted-on"><span class="genericon genericon-time" aria-hidden="true"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
										</p><!-- .post-meta -->
										<?php } ?>
									</div><!-- .post-preview -->
								
								</div><!-- .ilovewp-post .ilovewp-post-main -->
							</div><!-- .ilovewp-column-wrapper -->
						
						</div><!-- .ilovewp-column .ilovewp-column-1 -->
		
						<div class="ilovewp-column ilovewp-column-2">
						
							<div class="ilovewp-column-wrapper">
						
								<ul class="ilovewp-posts">
									<?php } else { $m++; ?>
									<li class="ilovewp-post ilovewp-post-simple">
										<?php if ( 1 == get_theme_mod( 'deadline_front_featured_categories_date', 0 ) ) { ?>
										<p class="post-meta">
											<span class="posted-on"><span class="genericon genericon-time" aria-hidden="true"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
										</p><!-- .post-meta -->
										<?php } ?>
										<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									</li>
									<?php } ?>
									
									<?php endwhile; ?>
								</ul><!-- .ilovewp-posts -->
							
							</div><!-- .ilovewp-column-wrapper -->
						
						</div><!-- .ilovewp-column .ilovewp-column-2 -->
		
					</div><!-- .ilovewp-columns .ilovewp-columns-2 -->
					
				</div><!-- .ilovewp-featured-category .featured-category-layout-1 -->
			
			</div><!-- .widget -->
		
			<?php wp_reset_postdata(); ?>
		
		<?php else : ?>
		
			<?php if ( current_user_can( 'publish_posts' ) ) : ?>
		
			<div class="widget clearfix">
			
				<p class="widget-title"><?php _e('Featured Category Not Configured Yet','deadline'); ?></p>
				
			</div><!-- .widget -->
		
			<?php endif; ?>
		
		<?php endif; ?>
		
		<?php

	} // end foreach