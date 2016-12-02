<?php
/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package relia
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        
        <?php $front = get_option('show_on_front'); ?>
        
        <?php if ( $front != 'posts' ) : 
            do_action( 'relia_jumbotron' );
            do_action( 'relia_homepage' ); 
        else :
             do_action( 'relia_jumbotron' );
        endif; ?>
        
            <div class="container-fluid front-page-content">

                <div class="row">

                    <div class="col-sm-12">

                        <h2 class="wow fadeInDown feature-content-title">

                            <?php if ( get_theme_mod( 'relia_homepage_content_title_toggle', 'show' ) == 'show' ) : ?>    

                                <?php echo esc_attr( get_theme_mod( 'relia_homepage_content_title', __( 'Featured Content', 'relia' ) ) ); ?>

                            <?php endif; ?>
                            
                        </h2>

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


                                    <?php echo $front == 'posts' ? '<div class="relia-blog-content">' : ''; ?>

                                    <?php /* Start the Loop */ ?>
                                    <?php while (have_posts()) : the_post(); ?>

                                        <?php
                                            if ($front == 'posts') :
                                                get_template_part('template-parts/content-blog', get_post_format());
                                            else:
                                                get_template_part('template-parts/content-page-home', get_post_format());
                                            endif;
                                        ?>

                                    <?php endwhile; ?>

                                    <?php echo $front == 'posts' ? '</div>' : ''; ?>

                                    <?php if ($front == 'posts') : ?>
                                        <div class="col-sm-4">
                                            <div>
                                                <div class="pagination-links"> 
                                                    <?php echo paginate_links(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

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