<?php
             require( '../../../../wp-load.php' );
?>
<?php wp_list_comments( $args ); ?>
<?php wp_link_pages( $args ); ?>
<?php register_sidebar( $args ); ?>
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>></div>
<?php language_attributes(); ?>
<?php dynamic_sidebar( $index ); ?>
<?php comments_template( $file, $separate_comments ); ?>
<?php comment_form(); ?>
<?php posts_nav_link() ?>
<?php next_posts_link() ?>
<?php  paginate_comments_links() ?>
<?php if ( ! isset( $content_width ) ) $content_width = 900; ?>
<?php add_editor_style() ?>
<?php add_theme_support( 'custom-header')  ?>
<?php the_post_thumbnail()  ?>
