<?php

/* 
 * Template Name: Relia Frontpage
 */

get_header();
?>
<?php $front = get_option('show_on_front'); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        
        <?php do_action( 'relia_homepage' ); ?>
        
            <div class="container-fluid front-page-content">

                <div class="row">

                    <div class="col-sm-12">


                    </div>

                    <div class="container">

                        <div class="row">

                            <div class="homepage-page-content col-sm-12">

                                <?php if (have_posts()) : ?>

                                    <?php if (is_home() && !is_front_page()) : ?>

                                        <header>
                                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                        </header>

                                    <?php endif; ?>



                                    <?php /* Start the Loop */ ?>
                                    <?php while (have_posts()) : the_post(); ?>

                                        <?php get_template_part('template-parts/content-page-home', get_post_format()); ?>

                                    <?php endwhile; ?>


                                <?php else : ?>

                                    <?php get_template_part('template-parts/content', 'none'); ?>

                                <?php endif; ?>

                            </div>

                        </div><!-- row -->
                    </div><!-- container-->  
                </div> <!-- row -->
            </div><!-- container-fluid -->    
            
    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>      

