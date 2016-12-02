<?php
/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package relia
 */

$width = 9;             // Single Sidebar
if ( is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ) :
    $width = 6;         // Dual Sidebars
else:
    if ( ( ! is_active_sidebar( 'sidebar-left' ) && !is_active_sidebar( 'sidebar-right' ) ) ) :
        $width = 12;    // No Sidebar
    endif;
endif;

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main relia-blog" role="main">

        <div class="container blog-index-content">

            <div class="row">

                <?php if ( is_active_sidebar('sidebar-left') ) : ?>

                    <?php get_sidebar( 'left' ); ?>

                <?php endif; ?>
                
                <div class="col-sm-<?php echo $width; ?>">
                
                    <div class="row">
                        
                        <div class="col-sm-12">

                            <h2 class="wow fadeInDown">
                                <?php echo esc_attr( get_theme_mod( 'relia_blog_roll_title', __( 'News', 'relia' ) ) ); ?>
                            </h2>

                        </div>

                        <?php if ( have_posts() ) : ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                    if (has_post_thumbnail(get_the_ID())) :
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                                    else:
                                        $image = get_template_directory_uri() . '/inc/images/blog-post-default-bg.jpg';
                                    endif;
                                ?>

                                <div class="col-sm-<?php echo $width == 6 ? '12' : '4'; ?> blog-roll-post wow fadeIn">

                                    <article data-link="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                        <div class="blog-post-image" style="background-image: url(<?php echo has_post_thumbnail(get_the_ID()) ? $image[0] : $image; ?>);">

                                        </div>   

                                        <div class="blog-post-overlay">

                                            <h2 class="post-title"><?php the_title(); ?></h2>
                                           
                                            <?php if ( get_theme_mod( 'relia_blog_show_date', 'show' ) == 'show' || get_theme_mod('relia_blog_show_author', 'show') == 'show' ) : ?>
                                                <p class="post-meta">
                                                    <?php echo get_theme_mod( 'relia_blog_show_date', 'show' ) == 'show' ? relia_posted_on() : ''; ?>
                                                    <?php if ( get_theme_mod( 'relia_blog_show_author', 'show' ) == 'show' ) : ?>    
                                                        by <span class="post-author"><?php echo the_author_posts_link(); ?></span>
                                                    <?php endif; ?>
                                                </p>
                                            <?php endif; ?>
                                            
                                            <div class="post-content">
                                                <?php $content = get_the_content(); ?>
                                                <?php echo wp_trim_words(strip_tags($content), 30); ?>
                                            </div>

                                            <a class="blog-post-read-more" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"><?php echo esc_html( get_theme_mod( 'relia_blog_read_more', __( 'Read More', 'relia' ) ) ); ?></a>

                                        </div>

                                    </article>

                                </div>

                            <?php endwhile; ?>

                        <?php else : ?>

                            <?php get_template_part('template-parts/content', 'none'); ?>

                        <?php endif; ?>

                    </div>
                    
                </div>

                <?php if ( is_active_sidebar('sidebar-right') ) : ?>

                    <?php get_sidebar( 'right' ); ?>

                <?php endif; ?>
                
            </div> <!-- row -->
        </div> <!-- .container-fluid -->
    </main> <!-- #main -->
</div> <!-- #primary -->

<?php get_footer(); ?>      