<?php
/**
 * @package Serene
 * @since Serene 1.0
 */
?>
		<footer id="main-footer">
			<?php get_sidebar( 'footer' ); ?>
			<p id="footer-info">
				<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'Serene' ), 'Serene', '<a href="http://www.elegantthemes.com/" rel="designer">Elegant Themes</a>' ); ?>
			</p>
		</footer> <!-- #main-footer -->
	</div> <!-- #container -->

	<?php wp_footer(); ?>
</body>
</html>