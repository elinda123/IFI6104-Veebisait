<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
<!--        <h1>CONTENT-PAGE-HOME.PHP</h1>    -->
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'relia' ),
                        'after'  => '</div>',
                ) );
            ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
            <?php
                    edit_post_link(
                            sprintf(
                                    /* translators: %s: Name of current post */
                                    esc_html__( 'Edit %s', 'relia' ),
                                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                            ),
                            '<span class="edit-link">',
                            '</span>'
                    );
            ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
