<h2 class="clear demo-categories">
  <?php esc_html_e( 'Our categories', 'istore' ); ?>
</h2>								
<?php echo do_shortcode( '[product_categories number="4" parent="0"]' ); ?>								
<h2 class="clear demo-products">
  <?php esc_html_e( 'Sale products', 'istore' ); ?>
</h2>								
<?php echo do_shortcode( '[sale_products per_page="5" columns="5"]' ); ?>								
<h2 class="clear demo-products">
  <?php esc_html_e( 'Recent products', 'istore' ); ?>
</h2>								
<?php echo do_shortcode( '[recent_products per_page="8" columns="4"]' ); ?>
