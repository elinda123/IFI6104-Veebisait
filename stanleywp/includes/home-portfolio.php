<?php
/**
 * File used for homepage recent portfolio
 *
 * @package WordPress
 */

//get and set portfolio category
$home_portfolio_cat = ( bi_get_data('home_portfolio_cat') != 'Select' ) ? bi_get_data('home_portfolio_cat') : NULL;

//tax query
if( $home_portfolio_cat ) {
	$portfolio_tax_query = array(
		array(
     'taxonomy' => 'portfolio_cats',
     'field' => 'slug',
     'terms' => $home_portfolio_cat
     )
		);
} else { $portfolio_tax_query = NULL; }

//query post types
$home_portfolio_query = new WP_Query(
	array(
		'post_type' => bi_get_data('home_post_type','portfolio'),
		'showposts' =>  bi_get_data('home_portfolio_count','4'),
		'tax_query' => $portfolio_tax_query,
		'no_found_rows' => true,
   )
  );

if ( $home_portfolio_query->posts ) :
	
 ?>     

<!-- +++++ Projects Section +++++ -->

<div class="container pt">
  <div class="row mt centered">
    
    <?php $home_portfolio_title = bi_get_data('home_portfolio_title') ? bi_get_data('home_portfolio_title') : __('Recent Work','gents'); ?>
    
    <?php
    $count=0;
    while ( $home_portfolio_query->have_posts() ) : $home_portfolio_query->the_post();
    $count++
    
    ?>
    <!-- PORTFOLIO ITEM -->      

    <div class="col-lg-4">
     <?php if ( has_post_thumbnail()) : ?>
     <a class="zoom green" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
      <?php the_post_thumbnail(); ?>
    </a>
  <?php endif; ?>

  <?php if(bi_get_data('project_title', '1')) {?>
  <p><?php the_title(); ?></p>
  <?php } ?>
</div> <!-- /col -->

<?php endwhile; ?>
</div><!-- /row -->
</div><!-- /container -->  

<?php endif; wp_reset_postdata(); ?>