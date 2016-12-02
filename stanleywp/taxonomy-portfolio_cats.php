<?php
/**
 * @package WordPress
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : ?>


   <div class="container pt">

      <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
           <h1><?php echo single_term_title(); ?></h1>
           <hr>
           <?php if(category_description()) { ?>
           <?php echo category_description( ); ?>
           <?php } ?>
       </div>
   </div>

   <div class="row mt centered">

    <?php while (have_posts()) : the_post(); ?>

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
<?php wp_reset_query(); ?>

</div>


<?php endif; ?>
<?php get_footer(); ?>