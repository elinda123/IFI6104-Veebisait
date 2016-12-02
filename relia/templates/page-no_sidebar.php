<?php
/*
Template Name: No Sidebar
*/
get_header(); ?>

<div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            
            <div class="container">
        
                <div class="row">

                    <div class="col-sm-12">
                    
                        <div class="row">
                            
                            <?php if( have_posts() ) : ?>

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <div class="col-sm-12">

                                        <h2 class="page-title">
                                            <?php the_title(); ?>
                                        </h2>

                                        <hr>

                                        <?php the_content(); ?>

                                    </div>

                                <?php endwhile; ?>

                            <?php endif; ?>
                            
                        </div>
                        
                    </div>
                    
                </div>
            
            </div>

        </main><!-- #main -->
        
    </div><!-- #primary -->

<?php get_footer(); ?>