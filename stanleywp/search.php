<?php
/**
 * Search Template
 *
 *
 * @file           search.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Search_Results_.28search.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div id="ww">
  <div class="container">
   <div class="row">
    <div class="col-lg-8 col-lg-offset-2 centered">

        <div id="content">
            <h6><?php _e('We found','gents'); ?> 
			<?php
                $allsearch = &new WP_Query("s=$s&showposts=-1");
                $key = esc_html($s, 1);
                $count = $allsearch->post_count;
                _e(' &#8211; ', 'gents');
                echo $count . ' ';
                _e('articles for ', 'gents');
                _e('<span class="post-search-terms">', 'gents');
                echo $key;
                _e('</span><!-- end of .post-search-terms -->', 'gents');
                wp_reset_query();
            ?>
            </h6>


<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
          
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
    $title  = get_the_title();
    $keys= explode(" ",$s);
    $title  = preg_replace('/('.implode('|', $keys) .')/iu',
        '<strong class="search-excerpt">\0</strong>',
        $title);
?>
                <header>
                <h1 class="search-page-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'gents'), the_title_attribute('echo=0')); ?>"><?php echo $title; ?></a></h1>
                </header>
                                
                <section class="post-entry">
                    <?php the_content(__('Read more &raquo;', 'gents')); ?>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'gents'), 'after' => '</div><!-- end of .pagination -->')); ?>
                </section><!-- end of .post-entry -->
                
                <footer class="article-footer">
                <div class="post-data"> 
					<?php edit_post_link(__('Edit', 'gents'), '', ' &#124; '); ?>  
					<?php comments_popup_link(__('No Comments <i class="icon-arrow-down"></i>', 'gents'), __('1 Comment <i class="icon-arrow-down"></i>', 'gents'), __('% Comments <i class="icon-arrow-down"></i>', 'gents')); ?>
                </div><!-- end of .post-data --> 
                </footer> 

                <br>
                <hr>           
            
            </article><!-- end of #post-<?php the_ID(); ?> -->
            
			<?php comments_template( '', true ); ?>
            
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
      
        </div><!-- end of #content -->
    </div><!-- /col-lg-8 -->
         </div><!-- /row -->
       </div> <!-- /container -->
     </div><!-- /ww -->


<?php get_footer(); ?>