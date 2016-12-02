<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Deadline
 */

?>

	<footer class="site-footer" role="contentinfo">
	
		<?php
		$footer_branding = get_theme_mod( 'deadline_footer_branding', 0 );
		$footer_logo_img = esc_attr( get_theme_mod( 'deadline_footer_logo' ) );
		?>
		
		<?php if ( has_nav_menu( 'footer' ) || !empty ( $footer_logo_img ) ) { ?>
		
		<div class="wrapper wrapper-footer ">
			
			<?php if ( !empty ( $footer_logo_img ) ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $footer_logo_img ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-site-footer" /></a>
			<?php } ?>

			<nav id="hermes-nav-footer-copy" aria-label="Footer Navigation">

				<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'menu_id' => 'menu-site-footer', 'sort_column' => 'menu_order', 'depth' => '1', 'theme_location' => 'footer', 'after' => '') ); ?>

			</nav><!-- #hermes-nav-footer-copy -->
			
		</div><!-- .wrapper .wrapper-footer -->
		
		<?php }	?>
		
		<div class="wrapper wrapper-copy">
			<p class="copy"><?php esc_attr_e('Copyright &copy;','deadline');?> <?php echo date("Y",time()); ?> <?php bloginfo('name'); ?>. <?php esc_attr_e('All Rights Reserved', 'deadline');?>. <span class="theme-credit"><?php printf( esc_html__( 'Theme by %1$s', 'deadline' ), '<a href="http://www.ilovewp.com/" rel="designer">ilovewp</a>' ); ?></span></p>
		</div><!-- .wrapper .wrapper-copy -->
	
	</footer><!-- .site-footer -->

</div><!-- end #container -->

<?php wp_footer(); ?>

</body>
</html>