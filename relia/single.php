<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package relia
 */

get_header(); ?>

    <div id="primary" class="content-area">
        
        <main id="main" class="site-main" role="main">

            <div class="container">

                <div class="row">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="col-sm-12">
                            <?php get_template_part( 'template-parts/content', 'single' ); ?>
                        </div>

                        <div class="col-sm-12">
                            <?php the_post_navigation(); ?>
                            <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>
                        </div>
                            
                    <?php endwhile; // End of the loop. ?>

                </div><!-- row -->

            </div><!-- container --> 

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>
