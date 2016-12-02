<?php
$footer_sidebars = array( 'footer-area-1', 'footer-area-2', 'footer-area-3' );
$any_widget_area_active = is_active_sidebar( $footer_sidebars[0] ) || is_active_sidebar( $footer_sidebars[1] ) || is_active_sidebar( $footer_sidebars[2] );

?>

<div id="footer-widgets" class="clearfix">
<?php
	if ( $any_widget_area_active ) {
		foreach ( $footer_sidebars as $key => $footer_sidebar ) {
			if ( is_active_sidebar( $footer_sidebar ) ) {
				echo '<div class="footer-widget' . (  2 == $key ? ' last' : '' ) . '">';
				dynamic_sidebar( $footer_sidebar );
				echo '</div> <!-- end .footer-widget -->';
			}
		}
	}
?>
</div> <!-- #footer-widgets -->