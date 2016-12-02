<?php
/**
 * Pages Template
 *
 *
 * @file           page.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div id="ww">
  <div class="container">
   <div class="row">
    <div class="col-lg-8 col-lg-offset-2 centered">
      <?php if (have_posts()) : ?>

      <?php while (have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( has_post_thumbnail()) : ?>
        <?php the_post_thumbnail(); ?>
      <?php endif; ?>

      <header>
        <h1><?php the_title(); ?></h1>
      </header>

      <section class="post-entry">
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
                          
                          <footer class="article-footer">           
                            <div class="post-edit"><?php edit_post_link(__('Edit', 'gents')); ?></div> 
                          </footer>
                        </article><!-- end of #post-<?php the_ID(); ?> -->
                        
                      <?php endwhile; ?> 
                      
                      <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                      <nav class="navigation">
                       <div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'gents' ) ); ?></div>
                       <div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'gents' ) ); ?></div>
                     </nav><!-- end of .navigation -->
                   <?php endif; ?>

                 <?php else : ?>

                 <article id="post-not-found" class="hentry clearfix">
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

               </article>

             <?php endif; ?>  
           </div><!-- /col-lg-8 -->
         </div><!-- /row -->
       </div> <!-- /container -->
     </div><!-- /ww -->

     

     <?php get_footer(); ?>