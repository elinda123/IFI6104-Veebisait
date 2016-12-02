<?php
/**
 * The sidebar for the WooCommerce shop page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package relia
 */
if (!is_active_sidebar('sidebar-shop')) {
    return;
}
?>

<div class="col-sm-3" id="relia-sidebar">
    <div id="secondary" class="widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar-shop'); ?>
    </div>
</div>