<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
if (has_post_thumbnail(get_the_ID())) :
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
else:
    $image = get_template_directory_uri() . '/inc/images/blog-post-default-bg.jpg';
endif;
?>

<div class="col-sm-4 blog-roll-post wow fadeIn">

    <article data-link="<?php echo get_the_permalink( get_the_ID() ); ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="blog-post-image" style="background-image: url(<?php echo has_post_thumbnail(get_the_ID()) ? $image[0] : $image; ?>);">

        </div>   

        <div class="blog-post-overlay">

            <h2 class="post-title"><?php the_title(); ?></h2>
            <?php if ( get_theme_mod( 'relia_blog_show_date', 'show' ) == 'show' || get_theme_mod('relia_blog_show_author', 'show') == 'show' ) : ?>
                <p class="post-meta">
                    <?php echo get_theme_mod( 'relia_blog_show_date', 'show' ) == 'show' ? relia_posted_on() : ''; ?>
                    <?php if ( get_theme_mod( 'relia_blog_show_author', 'show' ) == 'show' ) : ?>    
                        <?php _e( 'by', 'relia'); ?> <span class="post-author"><?php echo the_author_posts_link(); ?></span>
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