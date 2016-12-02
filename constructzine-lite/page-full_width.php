<?php
/*
* 	Template Name: Full Width
*
*/

get_header();?>

	<div id="main-content">

		<div class="inner cf">

			<div class="blog-left ti-cl-full-width">


				<?php

				if ( have_posts() ) {

					while ( have_posts() ) {

						the_post();

						$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>



						<article class="single-margin-top">

							<h1 class="post-title"><?php the_title(); ?></h1>

							<div class="single-post-image">

								<?php

								if ( $featured_image != null ) {
									?>

									<div class="asd"
									     style="background-image: url('<?php echo $featured_image[0]; ?>');">

									</div>

								<?php
								}

								?>

							</div>
							<!--/.single-post-image-->

							<div class="post-entry">

								<?php the_content(); ?>

							</div>
							<!--/.post-entry-->

							<?php

							wp_link_pages( array(

								'before'      => '<div class="post-links"><span class="post-links-title">' . __( 'Pages:', 'constructzine-lite' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',

							) );

							?>


						</article><!--/article-->



					<?php
					}

				} else {

					echo __( 'No posts found', 'constructzine-lite' );

				}

				?>


			</div>
			<!--/.blog-left-->

		</div>

	</div>

<?php get_footer(); ?>