<?php
/**
 * Template part for displaying single posts.
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

?>  

<div class="row">
    
    <?php if ( is_active_sidebar('sidebar-left') ) : ?>

        <?php get_sidebar( 'left' ); ?>

    <?php endif; ?>
    
    <div class="col-sm-<?php echo $width; ?>"> 

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="post-header">

                <h2 class="post-title"><?php the_title(); ?></h2>
                <?php if ( get_theme_mod( 'relia_single_show_date', 'show' ) == 'show' || get_theme_mod( 'relia_single_show_author', 'show' ) == 'show' ) : ?>
                    <p class="post-meta">
                        <?php echo get_theme_mod( 'relia_single_show_date', 'show' ) == 'show' ? relia_posted_on() : ''; ?>
                        <?php if ( get_theme_mod( 'relia_single_show_author', 'show' ) == 'show' ) : ?>    
                            by <span class="post-author"><?php echo the_author_posts_link(); ?></span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>

            </header>

            <div class="post-content">

                <?php the_post_thumbnail(); the_content(); ?>
                <?php
                    wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'relia' ),
                            'after'  => '</div>',
                    ) );
                ?>

            </div>

            <footer class="entry-footer">
                <?php relia_entry_footer(); ?>
            </footer>

        </article>

    </div>
    
    <?php if ( is_active_sidebar('sidebar-right') ) : ?>

        <?php get_sidebar( 'right' ); ?>

    <?php endif; ?>

</div>


