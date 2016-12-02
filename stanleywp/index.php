<?php
/**
 * Index Template
 *
 *
 * @file           index.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Index_.28index.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>
   <?php global $more; $more = 0; ?>


   <?php
   global $wp_query;
   if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
  } elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }
  query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );
  ?>   


  <?php if (have_posts()) : ?>

  <?php
  $c = 0; 
  $color_id = 'grey';
  ?>

  <?php while (have_posts()) : the_post(); ?>

  <?php
         $c++; // increment the counter
         if( $c % 2 != 0) {
          $color_id = 'grey';
        } else {
          $color_id = 'white'; }
          ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

           <div id="<?php echo $color_id ?>">
            <div class="container">
              <div class="row">
                <div class="col-lg-8 col-lg-offset-2">

                  <section class="post-meta">          
                      <p class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?><ba><?php the_author_meta( 'display_name' ); ?></ba></p>
                         <p><bd><time class="post-date"><?php the_date(); ?></time></bd></p>                
                  </section><!-- end of .post-meta -->


                  <section class="post-entry">
                    <?php if ( has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                      <?php the_post_thumbnail(); ?>
                    </a>
                  <?php endif; ?>

                  <header>
                    <h4 class="post-title"><?php the_title(); ?></h4>
                  </header>


                  <?php the_content(); ?>

                  <?php custom_link_pages(array(
                    'before' => '<nav class="pagination"><ul>' . __(''),
                    'after' => '</ul></nav>',
                            'next_or_number' => 'next_and_number', # activate parameter overloading
                            'nextpagelink' => __('&rarr;'),
                            'previouspagelink' => __('&larr;'),
                            'pagelink' => '%',
                            'echo' => 1 )
                            ); ?>

                          </section><!-- end of .post-entry -->  

                        </div>

                      </div><!-- /row -->
                    </div> <!-- /container -->
                  </div> 


                </article><!-- end of #post-<?php the_ID(); ?> -->



              <?php endwhile; ?> 

              <?php if (  $wp_query->max_num_pages > 1 ) : ?>
              <div class="container">

              <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                  <hr>
              <nav>
                <ul class="pager">
                 <li class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'gents' ) ); ?></li>
                 <li class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'gents' ) ); ?></li>
               </ul><!-- end of .navigation -->
             </nav>
           </div>
         </div>
       </div>
           <?php endif; ?>

         <?php else : ?>

         <article id="post-not-found" class="hentry clearfix">
          <div class="container">
              <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
          <header>
           <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gents'); ?></h1>
         </header>
         <section>
           <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gents'); ?></p>
         </section>
         <footer>
           <h6><?php _e( 'You can return', 'gents' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'gents' ); ?>"><?php _e( '&#9166; Home', 'gents' ); ?></a> <?php _e( 'or search for the page you were looking for', 'gents' ); ?></h6>
           <?php get_search_form(); ?>
         </footer>
         </div>
         </div>
       </div>
       </article>

     <?php endif; ?>  


   </div> <!-- /col-lg-8 -->

   <?php get_footer(); ?>