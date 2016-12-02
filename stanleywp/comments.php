<?php
/**
 * Comments Template
 *
 *
 * @file           comments.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2010 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Comments_.28comments.php.29
 * @since          available since Release 1.0
 */
?>
<?php if ( post_password_required() )
    return; ?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <i class="icon-comments-alt"></i>
            <span>
                <?php
                    printf( _nx( 'One Comment', '%1$s Comments', '', 'comments title', 'wpex' ),
                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                ?>
            </span>
        </h2>

        <ol class="comment-list">
            <?php wp_list_comments( array( 'callback' => 'gents_comment', 'style' => 'ol' ) ); ?>
        </ol><!-- .comment-list -->

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation row clr" role="navigation">
            <h4 class="assistive-text section-heading heading"><span><?php _e( 'Comment navigation', 'wpex' ); ?></span></h4>
            <div class="nav-previous span_12 col clr-margin"><?php previous_comments_link( __( '&larr; Older Comments', 'wpex' ) ); ?></div>
            <div class="nav-next span_12 col"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wpex' ) ); ?></div>
        </nav>
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'wpex' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php comment_form(
        $fields =  array(
            'title_reply' => '<span>'. __( 'Leave a Reply', 'wpex') .'</span>'
        ) ); ?>

</div><!-- #comments -->