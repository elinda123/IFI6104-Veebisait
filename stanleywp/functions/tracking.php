<?php
/**
* Tracking
*/
if ( !function_exists('bi_header_tracking') ) {
	add_action('wp_head', 'bi_header_tracking');
	function bi_header_tracking() {
		if ( bi_get_data('tracking_header') ) {
			echo bi_get_data('tracking_header');
		}
	}
}

if ( !function_exists('bi_footer_tracking') ) {
	add_action('wp_footer', 'bi_footer_tracking');
	function bi_footer_tracking() {
		if ( bi_get_data('tracking_footer') ) {
			echo bi_get_data('tracking_footer');
		}
	}
}