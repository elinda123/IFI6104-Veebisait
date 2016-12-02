<?php
/**
 * @package Serene
 * @since Serene 1.0
 */

get_header();

while ( have_posts() ) : the_post();
	get_template_part( 'content', get_post_format() );
endwhile;

comments_template( '', true );

get_footer(); ?>