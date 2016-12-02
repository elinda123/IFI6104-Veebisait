<?php
/**
 * @package Serene
 * @since Serene 1.0
 */

get_header();

if ( have_posts() ) : ?>

<div id="main-content">

<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile; ?>

</div> <!-- #main-content -->

<?php
	get_template_part( 'includes/navigation', 'index' );
else:
	get_template_part( 'includes/no-results', 'index' );
endif;

get_footer(); ?>