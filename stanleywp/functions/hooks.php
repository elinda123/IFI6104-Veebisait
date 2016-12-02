<?php
/**
 * Theme's Action Hooks
 *
 *
 * @file           hooks.php
 * @package        WordPress 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Plugin_API/Hooks
 * @since          available since Release 1.0
 */
?>
<?php

/**
 * Just after opening <body> tag
 *
 * @see header.php
 */
function gents_container() {
    do_action('gents_container');
}

/**
 * Just after closing </div><!-- end of #container -->
 *
 * @see footer.php
 */
function gents_container_end() {
    do_action('gents_container_end');
}

/**
 * Just after opening <div id="container">
 *
 * @see header.php
 */
function gents_header() {
    do_action('gents_header');
}

/**
 * Just after opening <div id="header">
 *
 * @see header.php
 */
function gents_in_header() {
    do_action('gents_in_header');
}

/**
 * Just after closing </div><!-- end of #header -->
 *
 * @see header.php
 */
function gents_header_end() {
    do_action('gents_header_end');
}

/**
 * Just before opening <div id="wrapper">
 *
 * @see header.php
 */
function gents_wrapper() {
    do_action('gents_wrapper');
}

/**
 * Just after opening <div id="wrapper">
 *
 * @see header.php
 */
function gents_in_wrapper() {
    do_action('gents_in_wrapper');
}

/**
 * Just after closing </div><!-- end of #wrapper -->
 *
 * @see header.php
 */
function gents_wrapper_end() {
    do_action('gents_wrapper_end');
}

/**
 * Just before opening <div id="widgets">
 *
 * @see sidebar.php
 */
function gents_widgets() {
    do_action('gents_widgets');
}

/**
 * Just after closing </div><!-- end of #widgets -->
 *
 * @see sidebar.php
 */
function gents_widgets_end() {
    do_action('gents_widgets_end');
}

?>