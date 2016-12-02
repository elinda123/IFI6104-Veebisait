<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

    <div class="container">

        <div class="row">
        
            <?php if ( get_theme_mod( 'relia_shop_sidebar_location', 'right' ) == 'left' ) : ?>
                <?php get_sidebar( 'shop' ); ?>
            <?php endif; ?>
            
            <div class="col-sm-<?php echo relia_shop_width(); ?> relia-shop-body">
            
                <?php
                        /**
                         * woocommerce_before_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         */
                        do_action( 'woocommerce_before_main_content' );
                ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                                <?php wc_get_template_part( 'content', 'single-product' ); ?>

                        <?php endwhile; // end of the loop. ?>

                <?php
                        /**
                         * woocommerce_after_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action( 'woocommerce_after_main_content' );
                ?>

                <?php
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        // do_action( 'woocommerce_sidebar' );
                ?>
        
            </div>
            
            <?php if ( get_theme_mod( 'relia_shop_sidebar_location', 'right' ) == 'right' ) : ?>
                <?php get_sidebar( 'shop' ); ?>
            <?php endif; ?>
                
        </div>    

    </div>

<?php get_footer( 'shop' ); ?>
