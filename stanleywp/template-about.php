<?php
/**
 * @package WordPress
 * Template Name: About
 */
?>

<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

  <?php if($post->post_content=="") : ?>

<?php else : ?>

  <!-- +++++ Welcome Section +++++ -->
  <div id="ww">
      <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 centered">
        <?php if ( has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail(); ?>
                  <?php endif; ?>
          <?php if( rwmb_meta( 'wtf_about_title' ) !== '' ) { ?>
          <?php echo rwmb_meta( 'wtf_about_title' ); ?>
          <?php } ?>  
           <?php the_content(); ?>
        
        </div><!-- /col-lg-8 -->
      </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /ww -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endwhile; ?>	


<div class="container pt">

<!-- Columns Section -->
<?php if( rwmb_meta( 'wtf_about_col' ) !== '' ) { ?>
<div class="row mt centered">
    <?php 
    $about_col = rwmb_meta( 'wtf_about_col' );
    foreach ( $about_col as $value ) { ?>

    <div class="col-lg-3">
      <?php echo $value; ?>
    </div>

    <?php } ?>
  </div><!-- /row -->
<?php } ?> 



<div class="row mt">

<!-- About Left Text-->
<?php if( rwmb_meta( 'wtf_about_left_txt' ) !== '' ) { ?>
<div class="col-lg-6">
      <?php echo rwmb_meta( 'wtf_about_left_txt' ); ?>
    </div><!-- /colg-lg-6 --> 
<?php } ?>  


<!-- About Right Text-->
<?php if( rwmb_meta( 'wtf_about_right_txt' ) !== '' ) { ?>
<div class="col-lg-6">
      <?php echo rwmb_meta( 'wtf_about_right_txt' ); ?>
    </div><!-- /colg-lg-6 --> 
<?php } ?>  


</div><!-- /row -->

</div><!-- /container -->





<?php get_footer(); ?>