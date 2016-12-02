<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
if ( post_password_required() )
	return;
?>
<!-- You can start editing here. -->

<?php if ( comments_open() || ( ! comments_open() && 0 != get_comments_number() ) ) : ?>
<section id="comment-wrap">
	<?php if ( have_comments() ) : ?>
		<h1 id="comments" class="page_title"><?php printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'Serene'), number_format_i18n( get_comments_number() ) ); ?></h1>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="comment_navigation_top clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Serene' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Serene' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist clearfix">
			<?php wp_list_comments( array( 'callback' => 'et_custom_comments_display' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="comment_navigation_bottom clearfix">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Serene' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Serene' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
	<?php else : // this is displayed if there are no comments so far ?>
	   <div id="comment-section" class="nocomments">
		  <?php if ('open' == $post->comment_status) : ?>
			 <!-- If comments are open, but there are no comments. -->

		  <?php else : // comments are closed ?>
			 <!-- If comments are closed. -->

		  <?php endif; ?>
	   </div>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
	<?php
		comment_form( array(
			'title_reply' => __( 'Submit a Comment', 'Serene' ),
		) );
	?>
	<?php else: ?>

	<?php endif; // if you delete this the sky will fall on your head ?>

</section>
<?php endif; ?>