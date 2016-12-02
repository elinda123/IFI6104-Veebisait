<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deadline
 */

?>

<?php $classes = array('ilovewp-post','ilovewp-post-archive', 'clearfix'); ?>

<li <?php post_class($classes); ?>>

	<article id="post-<?php the_ID(); ?>">
	
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-cover-wrapper">
			<div class="post-cover">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
				</a>
				<span class="post-meta-category"><?php the_category(', '); ?></span>
			</div><!-- .post-cover -->
		</div><!-- .post-cover-wrapper -->
		<?php endif; ?>
	
		<div class="post-preview">
			<p class="post-meta">
				<?php
				if ( is_sticky() ) { 
					echo '<span class="sticky-post">';
					_e('Sticky','deadline'); 
					echo '</span>'; 
				}
				?><span class="posted-on"><span class="genericon genericon-time" aria-hidden="true"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a></time></span>
			</p><!-- .post-meta -->
			<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
		</div><!-- .post-preview -->
	
	</article><!-- #post-<?php the_ID(); ?> -->

</li><!-- .ilovewp-post .ilovewp-post-archive -->