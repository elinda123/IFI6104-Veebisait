<?php
/**
 * relia Theme Customizer.
 *
 * @package relia
 */


function relia_enqueue_customizer_styles() {
    wp_enqueue_script( 'relia-customizer-js', get_template_directory_uri() . '/inc/js/customizer.js', array( 'jquery', 'customize-controls' ), false, true );
    wp_enqueue_style('relia-customizer-css', get_template_directory_uri() . '/inc/css/customizer.css', array(), RELIA_VERSION);
}
add_action( 'customize_controls_enqueue_scripts', 'relia_enqueue_customizer_styles' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function relia_customize_register( $wp_customize ) {
    
    // Resets
    $wp_customize->remove_section( 'static_front_page' );
    
    // General Panel
    require('customizer/panel-general.php');

    // Jumbotron Panel
    require('customizer/panel-jumbotron.php');
    
    // Homepage Panel
    require('customizer/panel-homepage.php');
    
    // Appearance Panel
    require('customizer/panel-appearance.php');
    
    // Single Post
    require('customizer/panel-single.php');
    
    // Blog
    require('customizer/panel-blog.php');
    
    // Theme Branding Panel
    require('customizer/panel-branding.php');
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'relia_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function relia_customize_preview_js() {
	wp_enqueue_script( 'relia_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), RELIA_VERSION, true );
}
add_action( 'customize_preview_init', 'relia_customize_preview_js' );

function relia_icons() {
    
    return array( 
        'fa fa-star' => __( 'Select One', 'relia'), 
        'fa fa-500px' => __( ' 500px', 'relia'), 
        'fa fa-amazon' => __( ' amazon', 'relia'), 
        'fa fa-balance-scale' => __( ' balance-scale', 'relia'), 'fa fa-battery-0' => __( ' battery-0', 'relia'), 'fa fa-battery-1' => __( ' battery-1', 'relia'), 'fa fa-battery-2' => __( ' battery-2', 'relia'), 'fa fa-battery-3' => __( ' battery-3', 'relia'), 'fa fa-battery-4' => __( ' battery-4', 'relia'), 'fa fa-battery-empty' => __( ' battery-empty', 'relia'), 'fa fa-battery-full' => __( ' battery-full', 'relia'), 'fa fa-battery-half' => __( ' battery-half', 'relia'), 'fa fa-battery-quarter' => __( ' battery-quarter', 'relia'), 'fa fa-battery-three-quarters' => __( ' battery-three-quarters', 'relia'), 'fa fa-black-tie' => __( ' black-tie', 'relia'), 'fa fa-calendar-check-o' => __( ' calendar-check-o', 'relia'), 'fa fa-calendar-minus-o' => __( ' calendar-minus-o', 'relia'), 'fa fa-calendar-plus-o' => __( ' calendar-plus-o', 'relia'), 'fa fa-calendar-times-o' => __( ' calendar-times-o', 'relia'), 'fa fa-cc-diners-club' => __( ' cc-diners-club', 'relia'), 'fa fa-cc-jcb' => __( ' cc-jcb', 'relia'), 'fa fa-chrome' => __( ' chrome', 'relia'), 'fa fa-clone' => __( ' clone', 'relia'), 'fa fa-commenting' => __( ' commenting', 'relia'), 'fa fa-commenting-o' => __( ' commenting-o', 'relia'), 'fa fa-contao' => __( ' contao', 'relia'), 'fa fa-creative-commons' => __( ' creative-commons', 'relia'), 'fa fa-expeditedssl' => __( ' expeditedssl', 'relia'), 'fa fa-firefox' => __( ' firefox', 'relia'), 'fa fa-fonticons' => __( ' fonticons', 'relia'), 'fa fa-genderless' => __( ' genderless', 'relia'), 'fa fa-get-pocket' => __( ' get-pocket', 'relia'), 'fa fa-gg' => __( ' gg', 'relia'), 'fa fa-gg-circle' => __( ' gg-circle', 'relia'), 'fa fa-hand-grab-o' => __( ' hand-grab-o', 'relia'), 'fa fa-hand-lizard-o' => __( ' hand-lizard-o', 'relia'), 'fa fa-hand-paper-o' => __( ' hand-paper-o', 'relia'), 'fa fa-hand-peace-o' => __( ' hand-peace-o', 'relia'), 'fa fa-hand-pointer-o' => __( ' hand-pointer-o', 'relia'), 'fa fa-hand-rock-o' => __( ' hand-rock-o', 'relia'), 'fa fa-hand-scissors-o' => __( ' hand-scissors-o', 'relia'), 'fa fa-hand-spock-o' => __( ' hand-spock-o', 'relia'), 'fa fa-hand-stop-o' => __( ' hand-stop-o', 'relia'), 'fa fa-hourglass' => __( ' hourglass', 'relia'), 'fa fa-hourglass-1' => __( ' hourglass-1', 'relia'), 'fa fa-hourglass-2' => __( ' hourglass-2', 'relia'), 'fa fa-hourglass-3' => __( ' hourglass-3', 'relia'), 'fa fa-hourglass-end' => __( ' hourglass-end', 'relia'), 'fa fa-hourglass-half' => __( ' hourglass-half', 'relia'), 'fa fa-hourglass-o' => __( ' hourglass-o', 'relia'), 'fa fa-hourglass-start' => __( ' hourglass-start', 'relia'), 'fa fa-houzz' => __( ' houzz', 'relia'), 'fa fa-i-cursor' => __( ' i-cursor', 'relia'), 'fa fa-industry' => __( ' industry', 'relia'), 'fa fa-internet-explorer' => __( ' internet-explorer', 'relia'), 'fa fa-map' => __( ' map', 'relia'), 'fa fa-map-o' => __( ' map-o', 'relia'), 'fa fa-map-pin' => __( ' map-pin', 'relia'), 'fa fa-map-signs' => __( ' map-signs', 'relia'), 'fa fa-mouse-pointer' => __( ' mouse-pointer', 'relia'), 'fa fa-object-group' => __( ' object-group', 'relia'), 'fa fa-object-ungroup' => __( ' object-ungroup', 'relia'), 'fa fa-odnoklassniki' => __( ' odnoklassniki', 'relia'), 'fa fa-odnoklassniki-square' => __( ' odnoklassniki-square', 'relia'), 'fa fa-opencart' => __( ' opencart', 'relia'), 'fa fa-opera' => __( ' opera', 'relia'), 'fa fa-optin-monster' => __( ' optin-monster', 'relia'), 'fa fa-registered' => __( ' registered', 'relia'), 'fa fa-safari' => __( ' safari', 'relia'), 'fa fa-sticky-note' => __( ' sticky-note', 'relia'), 'fa fa-sticky-note-o' => __( ' sticky-note-o', 'relia'), 'fa fa-television' => __( ' television', 'relia'), 'fa fa-trademark' => __( ' trademark', 'relia'), 'fa fa-tripadvisor' => __( ' tripadvisor', 'relia'), 'fa fa-tv' => __( ' tv', 'relia'), 'fa fa-vimeo' => __( ' vimeo', 'relia'), 'fa fa-wikipedia-w' => __( ' wikipedia-w', 'relia'), 'fa fa-y-combinator' => __( ' y-combinator', 'relia'), 'fa fa-yc' => __( ' yc', 'relia'), 'fa fa-adjust' => __( ' adjust', 'relia'), 'fa fa-anchor' => __( ' anchor', 'relia'), 'fa fa-archive' => __( ' archive', 'relia'), 'fa fa-area-chart' => __( ' area-chart', 'relia'), 'fa fa-arrows' => __( ' arrows', 'relia'), 'fa fa-arrows-h' => __( ' arrows-h', 'relia'), 'fa fa-arrows-v' => __( ' arrows-v', 'relia'), 'fa fa-asterisk' => __( ' asterisk', 'relia'), 'fa fa-at' => __( ' at', 'relia'), 'fa fa-automobile' => __( ' automobile', 'relia'), 'fa fa-balance-scale' => __( ' balance-scale', 'relia'), 'fa fa-ban' => __( ' ban', 'relia'), 'fa fa-bank' => __( ' bank', 'relia'), 'fa fa-bar-chart' => __( ' bar-chart', 'relia'), 'fa fa-bar-chart-o' => __( ' bar-chart-o', 'relia'), 'fa fa-barcode' => __( ' barcode', 'relia'), 'fa fa-bars' => __( ' bars', 'relia'), 'fa fa-battery-0' => __( ' battery-0', 'relia'), 'fa fa-battery-1' => __( ' battery-1', 'relia'), 'fa fa-battery-2' => __( ' battery-2', 'relia'), 'fa fa-battery-3' => __( ' battery-3', 'relia'), 'fa fa-battery-4' => __( ' battery-4', 'relia'), 'fa fa-battery-empty' => __( ' battery-empty', 'relia'), 'fa fa-battery-full' => __( ' battery-full', 'relia'), 'fa fa-battery-half' => __( ' battery-half', 'relia'), 'fa fa-battery-quarter' => __( ' battery-quarter', 'relia'), 'fa fa-battery-three-quarters' => __( ' battery-three-quarters', 'relia'), 'fa fa-bed' => __( ' bed', 'relia'), 'fa fa-beer' => __( ' beer', 'relia'), 'fa fa-bell' => __( ' bell', 'relia'), 'fa fa-bell-o' => __( ' bell-o', 'relia'), 'fa fa-bell-slash' => __( ' bell-slash', 'relia'), 'fa fa-bell-slash-o' => __( ' bell-slash-o', 'relia'), 'fa fa-bicycle' => __( ' bicycle', 'relia'), 'fa fa-binoculars' => __( ' binoculars', 'relia'), 'fa fa-birthday-cake' => __( ' birthday-cake', 'relia'), 'fa fa-bolt' => __( ' bolt', 'relia'), 'fa fa-bomb' => __( ' bomb', 'relia'), 'fa fa-book' => __( ' book', 'relia'), 'fa fa-bookmark' => __( ' bookmark', 'relia'), 'fa fa-bookmark-o' => __( ' bookmark-o', 'relia'), 'fa fa-briefcase' => __( ' briefcase', 'relia'), 'fa fa-bug' => __( ' bug', 'relia'), 'fa fa-building' => __( ' building', 'relia'), 'fa fa-building-o' => __( ' building-o', 'relia'), 'fa fa-bullhorn' => __( ' bullhorn', 'relia'), 'fa fa-bullseye' => __( ' bullseye', 'relia'), 'fa fa-bus' => __( ' bus', 'relia'), 'fa fa-cab' => __( ' cab', 'relia'), 'fa fa-calculator' => __( ' calculator', 'relia'), 'fa fa-calendar' => __( ' calendar', 'relia'), 'fa fa-calendar-check-o' => __( ' calendar-check-o', 'relia'), 'fa fa-calendar-minus-o' => __( ' calendar-minus-o', 'relia'), 'fa fa-calendar-o' => __( ' calendar-o', 'relia'), 'fa fa-calendar-plus-o' => __( ' calendar-plus-o', 'relia'), 'fa fa-calendar-times-o' => __( ' calendar-times-o', 'relia'), 'fa fa-camera' => __( ' camera', 'relia'), 'fa fa-camera-retro' => __( ' camera-retro', 'relia'), 'fa fa-car' => __( ' car', 'relia'), 'fa fa-caret-square-o-down' => __( ' caret-square-o-down', 'relia'), 'fa fa-caret-square-o-left' => __( ' caret-square-o-left', 'relia'), 'fa fa-caret-square-o-right' => __( ' caret-square-o-right', 'relia'), 'fa fa-caret-square-o-up' => __( ' caret-square-o-up', 'relia'), 'fa fa-cart-arrow-down' => __( ' cart-arrow-down', 'relia'), 'fa fa-cart-plus' => __( ' cart-plus', 'relia'), 'fa fa-cc' => __( ' cc', 'relia'), 'fa fa-certificate' => __( ' certificate', 'relia'), 'fa fa-check' => __( ' check', 'relia'), 'fa fa-check-circle' => __( ' check-circle', 'relia'), 'fa fa-check-circle-o' => __( ' check-circle-o', 'relia'), 'fa fa-check-square' => __( ' check-square', 'relia'), 'fa fa-check-square-o' => __( ' check-square-o', 'relia'), 'fa fa-child' => __( ' child', 'relia'), 'fa fa-circle' => __( ' circle', 'relia'), 'fa fa-circle-o' => __( ' circle-o', 'relia'), 'fa fa-circle-o-notch' => __( ' circle-o-notch', 'relia'), 'fa fa-circle-thin' => __( ' circle-thin', 'relia'), 'fa fa-clock-o' => __( ' clock-o', 'relia'), 'fa fa-clone' => __( ' clone', 'relia'), 'fa fa-close' => __( ' close', 'relia'), 'fa fa-cloud' => __( ' cloud', 'relia'), 'fa fa-cloud-download' => __( ' cloud-download', 'relia'), 'fa fa-cloud-upload' => __( ' cloud-upload', 'relia'), 'fa fa-code' => __( ' code', 'relia'), 'fa fa-code-fork' => __( ' code-fork', 'relia'), 'fa fa-coffee' => __( ' coffee', 'relia'), 'fa fa-cog' => __( ' cog', 'relia'), 'fa fa-cogs' => __( ' cogs', 'relia'), 'fa fa-comment' => __( ' comment', 'relia'), 'fa fa-comment-o' => __( ' comment-o', 'relia'), 'fa fa-commenting' => __( ' commenting', 'relia'), 'fa fa-commenting-o' => __( ' commenting-o', 'relia'), 'fa fa-comments' => __( ' comments', 'relia'), 'fa fa-comments-o' => __( ' comments-o', 'relia'), 'fa fa-compass' => __( ' compass', 'relia'), 'fa fa-copyright' => __( ' copyright', 'relia'), 'fa fa-creative-commons' => __( ' creative-commons', 'relia'), 'fa fa-credit-card' => __( ' credit-card', 'relia'), 'fa fa-crop' => __( ' crop', 'relia'), 'fa fa-crosshairs' => __( ' crosshairs', 'relia'), 'fa fa-cube' => __( ' cube', 'relia'), 'fa fa-cubes' => __( ' cubes', 'relia'), 'fa fa-cutlery' => __( ' cutlery', 'relia'), 'fa fa-dashboard' => __( ' dashboard', 'relia'), 'fa fa-database' => __( ' database', 'relia'), 'fa fa-desktop' => __( ' desktop', 'relia'), 'fa fa-diamond' => __( ' diamond', 'relia'), 'fa fa-dot-circle-o' => __( ' dot-circle-o', 'relia'), 'fa fa-download' => __( ' download', 'relia'), 'fa fa-edit' => __( ' edit', 'relia'), 'fa fa-ellipsis-h' => __( ' ellipsis-h', 'relia'), 'fa fa-ellipsis-v' => __( ' ellipsis-v', 'relia'), 'fa fa-envelope' => __( ' envelope', 'relia'), 'fa fa-envelope-o' => __( ' envelope-o', 'relia'), 'fa fa-envelope-square' => __( ' envelope-square', 'relia'), 'fa fa-eraser' => __( ' eraser', 'relia'), 'fa fa-exchange' => __( ' exchange', 'relia'), 'fa fa-exclamation' => __( ' exclamation', 'relia'), 'fa fa-exclamation-circle' => __( ' exclamation-circle', 'relia'), 'fa fa-exclamation-triangle' => __( ' exclamation-triangle', 'relia'), 'fa fa-external-link' => __( ' external-link', 'relia'), 'fa fa-external-link-square' => __( ' external-link-square', 'relia'), 'fa fa-eye' => __( ' eye', 'relia'), 'fa fa-eye-slash' => __( ' eye-slash', 'relia'), 'fa fa-eyedropper' => __( ' eyedropper', 'relia'), 'fa fa-fax' => __( ' fax', 'relia'), 'fa fa-feed' => __( ' feed', 'relia'), 'fa fa-female' => __( ' female', 'relia'), 'fa fa-fighter-jet' => __( ' fighter-jet', 'relia'), 'fa fa-file-archive-o' => __( ' file-archive-o', 'relia'), 'fa fa-file-audio-o' => __( ' file-audio-o', 'relia'), 'fa fa-file-code-o' => __( ' file-code-o', 'relia'), 'fa fa-file-excel-o' => __( ' file-excel-o', 'relia'), 'fa fa-file-image-o' => __( ' file-image-o', 'relia'), 'fa fa-file-movie-o' => __( ' file-movie-o', 'relia'), 'fa fa-file-pdf-o' => __( ' file-pdf-o', 'relia'), 'fa fa-file-photo-o' => __( ' file-photo-o', 'relia'), 'fa fa-file-picture-o' => __( ' file-picture-o', 'relia'), 'fa fa-file-powerpoint-o' => __( ' file-powerpoint-o', 'relia'), 'fa fa-file-sound-o' => __( ' file-sound-o', 'relia'), 'fa fa-file-video-o' => __( ' file-video-o', 'relia'), 'fa fa-file-word-o' => __( ' file-word-o', 'relia'), 'fa fa-file-zip-o' => __( ' file-zip-o', 'relia'), 'fa fa-film' => __( ' film', 'relia'), 'fa fa-filter' => __( ' filter', 'relia'), 'fa fa-fire' => __( ' fire', 'relia'), 'fa fa-fire-extinguisher' => __( ' fire-extinguisher', 'relia'), 'fa fa-flag' => __( ' flag', 'relia'), 'fa fa-flag-checkered' => __( ' flag-checkered', 'relia'), 'fa fa-flag-o' => __( ' flag-o', 'relia'), 'fa fa-flash' => __( ' flash', 'relia'), 'fa fa-flask' => __( ' flask', 'relia'), 'fa fa-folder' => __( ' folder', 'relia'), 'fa fa-folder-o' => __( ' folder-o', 'relia'), 'fa fa-folder-open' => __( ' folder-open', 'relia'), 'fa fa-folder-open-o' => __( ' folder-open-o', 'relia'), 'fa fa-frown-o' => __( ' frown-o', 'relia'), 'fa fa-futbol-o' => __( ' futbol-o', 'relia'), 'fa fa-gamepad' => __( ' gamepad', 'relia'), 'fa fa-gavel' => __( ' gavel', 'relia'), 'fa fa-gear' => __( ' gear', 'relia'), 'fa fa-gears' => __( ' gears', 'relia'), 'fa fa-gift' => __( ' gift', 'relia'), 'fa fa-glass' => __( ' glass', 'relia'), 'fa fa-globe' => __( ' globe', 'relia'), 'fa fa-graduation-cap' => __( ' graduation-cap', 'relia'), 'fa fa-group' => __( ' group', 'relia'), 'fa fa-hand-grab-o' => __( ' hand-grab-o', 'relia'), 'fa fa-hand-lizard-o' => __( ' hand-lizard-o', 'relia'), 'fa fa-hand-paper-o' => __( ' hand-paper-o', 'relia'), 'fa fa-hand-peace-o' => __( ' hand-peace-o', 'relia'), 'fa fa-hand-pointer-o' => __( ' hand-pointer-o', 'relia'), 'fa fa-hand-rock-o' => __( ' hand-rock-o', 'relia'), 'fa fa-hand-scissors-o' => __( ' hand-scissors-o', 'relia'), 'fa fa-hand-spock-o' => __( ' hand-spock-o', 'relia'), 'fa fa-hand-stop-o' => __( ' hand-stop-o', 'relia'), 'fa fa-hdd-o' => __( ' hdd-o', 'relia'), 'fa fa-headphones' => __( ' headphones', 'relia'), 'fa fa-heart' => __( ' heart', 'relia'), 'fa fa-heart-o' => __( ' heart-o', 'relia'), 'fa fa-heartbeat' => __( ' heartbeat', 'relia'), 'fa fa-history' => __( ' history', 'relia'), 'fa fa-home' => __( ' home', 'relia'), 'fa fa-hotel' => __( ' hotel', 'relia'), 'fa fa-hourglass' => __( ' hourglass', 'relia'), 'fa fa-hourglass-1' => __( ' hourglass-1', 'relia'), 'fa fa-hourglass-2' => __( ' hourglass-2', 'relia'), 'fa fa-hourglass-3' => __( ' hourglass-3', 'relia'), 'fa fa-hourglass-end' => __( ' hourglass-end', 'relia'), 'fa fa-hourglass-half' => __( ' hourglass-half', 'relia'), 'fa fa-hourglass-o' => __( ' hourglass-o', 'relia'), 'fa fa-hourglass-start' => __( ' hourglass-start', 'relia'), 'fa fa-i-cursor' => __( ' i-cursor', 'relia'), 'fa fa-image' => __( ' image', 'relia'), 'fa fa-inbox' => __( ' inbox', 'relia'), 'fa fa-industry' => __( ' industry', 'relia'), 'fa fa-info' => __( ' info', 'relia'), 'fa fa-info-circle' => __( ' info-circle', 'relia'), 'fa fa-institution' => __( ' institution', 'relia'), 'fa fa-key' => __( ' key', 'relia'), 'fa fa-keyboard-o' => __( ' keyboard-o', 'relia'), 'fa fa-language' => __( ' language', 'relia'), 'fa fa-laptop' => __( ' laptop', 'relia'), 'fa fa-leaf' => __( ' leaf', 'relia'), 'fa fa-legal' => __( ' legal', 'relia'), 'fa fa-lemon-o' => __( ' lemon-o', 'relia'), 'fa fa-level-down' => __( ' level-down', 'relia'), 'fa fa-level-up' => __( ' level-up', 'relia'), 'fa fa-life-bouy' => __( ' life-bouy', 'relia'), 'fa fa-life-buoy' => __( ' life-buoy', 'relia'), 'fa fa-life-ring' => __( ' life-ring', 'relia'), 'fa fa-life-saver' => __( ' life-saver', 'relia'), 'fa fa-lightbulb-o' => __( ' lightbulb-o', 'relia'), 'fa fa-line-chart' => __( ' line-chart', 'relia'), 'fa fa-location-arrow' => __( ' location-arrow', 'relia'), 'fa fa-lock' => __( ' lock', 'relia'), 'fa fa-magic' => __( ' magic', 'relia'), 'fa fa-magnet' => __( ' magnet', 'relia'), 'fa fa-mail-forward' => __( ' mail-forward', 'relia'), 'fa fa-mail-reply' => __( ' mail-reply', 'relia'), 'fa fa-mail-reply-all' => __( ' mail-reply-all', 'relia'), 'fa fa-male' => __( ' male', 'relia'), 'fa fa-map' => __( ' map', 'relia'), 'fa fa-map-marker' => __( ' map-marker', 'relia'), 'fa fa-map-o' => __( ' map-o', 'relia'), 'fa fa-map-pin' => __( ' map-pin', 'relia'), 'fa fa-map-signs' => __( ' map-signs', 'relia'), 'fa fa-meh-o' => __( ' meh-o', 'relia'), 'fa fa-microphone' => __( ' microphone', 'relia'), 'fa fa-microphone-slash' => __( ' microphone-slash', 'relia'), 'fa fa-minus' => __( ' minus', 'relia'), 'fa fa-minus-circle' => __( ' minus-circle', 'relia'), 'fa fa-minus-square' => __( ' minus-square', 'relia'), 'fa fa-minus-square-o' => __( ' minus-square-o', 'relia'), 'fa fa-mobile' => __( ' mobile', 'relia'), 'fa fa-mobile-phone' => __( ' mobile-phone', 'relia'), 'fa fa-money' => __( ' money', 'relia'), 'fa fa-moon-o' => __( ' moon-o', 'relia'), 'fa fa-mortar-board' => __( ' mortar-board', 'relia'), 'fa fa-motorcycle' => __( ' motorcycle', 'relia'), 'fa fa-mouse-pointer' => __( ' mouse-pointer', 'relia'), 'fa fa-music' => __( ' music', 'relia'), 'fa fa-navicon' => __( ' navicon', 'relia'), 'fa fa-newspaper-o' => __( ' newspaper-o', 'relia'), 'fa fa-object-group' => __( ' object-group', 'relia'), 'fa fa-object-ungroup' => __( ' object-ungroup', 'relia'), 'fa fa-paint-brush' => __( ' paint-brush', 'relia'), 'fa fa-paper-plane' => __( ' paper-plane', 'relia'), 'fa fa-paper-plane-o' => __( ' paper-plane-o', 'relia'), 'fa fa-paw' => __( ' paw', 'relia'), 'fa fa-pencil' => __( ' pencil', 'relia'), 'fa fa-pencil-square' => __( ' pencil-square', 'relia'), 'fa fa-pencil-square-o' => __( ' pencil-square-o', 'relia'), 'fa fa-phone' => __( ' phone', 'relia'), 'fa fa-phone-square' => __( ' phone-square', 'relia'), 'fa fa-photo' => __( ' photo', 'relia'), 'fa fa-picture-o' => __( ' picture-o', 'relia'), 'fa fa-pie-chart' => __( ' pie-chart', 'relia'), 'fa fa-plane' => __( ' plane', 'relia'), 'fa fa-plug' => __( ' plug', 'relia'), 'fa fa-plus' => __( ' plus', 'relia'), 'fa fa-plus-circle' => __( ' plus-circle', 'relia'), 'fa fa-plus-square' => __( ' plus-square', 'relia'), 'fa fa-plus-square-o' => __( ' plus-square-o', 'relia'), 'fa fa-power-off' => __( ' power-off', 'relia'), 'fa fa-print' => __( ' print', 'relia'), 'fa fa-puzzle-piece' => __( ' puzzle-piece', 'relia'), 'fa fa-qrcode' => __( ' qrcode', 'relia'), 'fa fa-question' => __( ' question', 'relia'), 'fa fa-question-circle' => __( ' question-circle', 'relia'), 'fa fa-quote-left' => __( ' quote-left', 'relia'), 'fa fa-quote-right' => __( ' quote-right', 'relia'), 'fa fa-random' => __( ' random', 'relia'), 'fa fa-recycle' => __( ' recycle', 'relia'), 'fa fa-refresh' => __( ' refresh', 'relia'), 'fa fa-registered' => __( ' registered', 'relia'), 'fa fa-remove' => __( ' remove', 'relia'), 'fa fa-reorder' => __( ' reorder', 'relia'), 'fa fa-reply' => __( ' reply', 'relia'), 'fa fa-reply-all' => __( ' reply-all', 'relia'), 'fa fa-retweet' => __( ' retweet', 'relia'), 'fa fa-road' => __( ' road', 'relia'), 'fa fa-rocket' => __( ' rocket', 'relia'), 'fa fa-rss' => __( ' rss', 'relia'), 'fa fa-rss-square' => __( ' rss-square', 'relia'), 'fa fa-search' => __( ' search', 'relia'), 'fa fa-search-minus' => __( ' search-minus', 'relia'), 'fa fa-search-plus' => __( ' search-plus', 'relia'), 'fa fa-send' => __( ' send', 'relia'), 'fa fa-send-o' => __( ' send-o', 'relia'), 'fa fa-server' => __( ' server', 'relia'), 'fa fa-share' => __( ' share', 'relia'), 'fa fa-share-alt' => __( ' share-alt', 'relia'), 'fa fa-share-alt-square' => __( ' share-alt-square', 'relia'), 'fa fa-share-square' => __( ' share-square', 'relia'), 'fa fa-share-square-o' => __( ' share-square-o', 'relia'), 'fa fa-shield' => __( ' shield', 'relia'), 'fa fa-ship' => __( ' ship', 'relia'), 'fa fa-shopping-cart' => __( ' shopping-cart', 'relia'), 'fa fa-sign-in' => __( ' sign-in', 'relia'), 'fa fa-sign-out' => __( ' sign-out', 'relia'), 'fa fa-signal' => __( ' signal', 'relia'), 'fa fa-sitemap' => __( ' sitemap', 'relia'), 'fa fa-sliders' => __( ' sliders', 'relia'), 'fa fa-smile-o' => __( ' smile-o', 'relia'), 'fa fa-soccer-ball-o' => __( ' soccer-ball-o', 'relia'), 'fa fa-sort' => __( ' sort', 'relia'), 'fa fa-sort-alpha-asc' => __( ' sort-alpha-asc', 'relia'), 'fa fa-sort-alpha-desc' => __( ' sort-alpha-desc', 'relia'), 'fa fa-sort-amount-asc' => __( ' sort-amount-asc', 'relia'), 'fa fa-sort-amount-desc' => __( ' sort-amount-desc', 'relia'), 'fa fa-sort-asc' => __( ' sort-asc', 'relia'), 'fa fa-sort-desc' => __( ' sort-desc', 'relia'), 'fa fa-sort-down' => __( ' sort-down', 'relia'), 'fa fa-sort-numeric-asc' => __( ' sort-numeric-asc', 'relia'), 'fa fa-sort-numeric-desc' => __( ' sort-numeric-desc', 'relia'), 'fa fa-sort-up' => __( ' sort-up', 'relia'), 'fa fa-space-shuttle' => __( ' space-shuttle', 'relia'), 'fa fa-spinner' => __( ' spinner', 'relia'), 'fa fa-spoon' => __( ' spoon', 'relia'), 'fa fa-square' => __( ' square', 'relia'), 'fa fa-square-o' => __( ' square-o', 'relia'), 'fa fa-star' => __( ' star', 'relia'), 'fa fa-star-half' => __( ' star-half', 'relia'), 'fa fa-star-half-empty' => __( ' star-half-empty', 'relia'), 'fa fa-star-half-full' => __( ' star-half-full', 'relia'), 'fa fa-star-half-o' => __( ' star-half-o', 'relia'), 'fa fa-star-o' => __( ' star-o', 'relia'), 'fa fa-sticky-note' => __( ' sticky-note', 'relia'), 'fa fa-sticky-note-o' => __( ' sticky-note-o', 'relia'), 'fa fa-street-view' => __( ' street-view', 'relia'), 'fa fa-suitcase' => __( ' suitcase', 'relia'), 'fa fa-sun-o' => __( ' sun-o', 'relia'), 'fa fa-support' => __( ' support', 'relia'), 'fa fa-tablet' => __( ' tablet', 'relia'), 'fa fa-tachometer' => __( ' tachometer', 'relia'), 'fa fa-tag' => __( ' tag', 'relia'), 'fa fa-tags' => __( ' tags', 'relia'), 'fa fa-tasks' => __( ' tasks', 'relia'), 'fa fa-taxi' => __( ' taxi', 'relia'), 'fa fa-television' => __( ' television', 'relia'), 'fa fa-terminal' => __( ' terminal', 'relia'), 'fa fa-thumb-tack' => __( ' thumb-tack', 'relia'), 'fa fa-thumbs-down' => __( ' thumbs-down', 'relia'), 'fa fa-thumbs-o-down' => __( ' thumbs-o-down', 'relia'), 'fa fa-thumbs-o-up' => __( ' thumbs-o-up', 'relia'), 'fa fa-thumbs-up' => __( ' thumbs-up', 'relia'), 'fa fa-ticket' => __( ' ticket', 'relia'), 'fa fa-times' => __( ' times', 'relia'), 'fa fa-times-circle' => __( ' times-circle', 'relia'), 'fa fa-times-circle-o' => __( ' times-circle-o', 'relia'), 'fa fa-tint' => __( ' tint', 'relia'), 'fa fa-toggle-down' => __( ' toggle-down', 'relia'), 'fa fa-toggle-left' => __( ' toggle-left', 'relia'), 'fa fa-toggle-off' => __( ' toggle-off', 'relia'), 'fa fa-toggle-on' => __( ' toggle-on', 'relia'), 'fa fa-toggle-right' => __( ' toggle-right', 'relia'), 'fa fa-toggle-up' => __( ' toggle-up', 'relia'), 'fa fa-trademark' => __( ' trademark', 'relia'), 'fa fa-trash' => __( ' trash', 'relia'), 'fa fa-trash-o' => __( ' trash-o', 'relia'), 'fa fa-tree' => __( ' tree', 'relia'), 'fa fa-trophy' => __( ' trophy', 'relia'), 'fa fa-truck' => __( ' truck', 'relia'), 'fa fa-tty' => __( ' tty', 'relia'), 'fa fa-tv' => __( ' tv', 'relia'), 'fa fa-umbrella' => __( ' umbrella', 'relia'), 'fa fa-university' => __( ' university', 'relia'), 'fa fa-unlock' => __( ' unlock', 'relia'), 'fa fa-unlock-alt' => __( ' unlock-alt', 'relia'), 'fa fa-unsorted' => __( ' unsorted', 'relia'), 'fa fa-upload' => __( ' upload', 'relia'), 'fa fa-user' => __( ' user', 'relia'), 'fa fa-user-plus' => __( ' user-plus', 'relia'), 'fa fa-user-secret' => __( ' user-secret', 'relia'), 'fa fa-user-times' => __( ' user-times', 'relia'), 'fa fa-users' => __( ' users', 'relia'), 'fa fa-video-camera' => __( ' video-camera', 'relia'), 'fa fa-volume-down' => __( ' volume-down', 'relia'), 'fa fa-volume-off' => __( ' volume-off', 'relia'), 'fa fa-volume-up' => __( ' volume-up', 'relia'), 'fa fa-warning' => __( ' warning', 'relia'), 'fa fa-wheelchair' => __( ' wheelchair', 'relia'), 'fa fa-wifi' => __( ' wifi', 'relia'), 'fa fa-wrench' => __( ' wrench', 'relia'), 'fa fa-hand-grab-o' => __( ' hand-grab-o', 'relia'), 'fa fa-hand-lizard-o' => __( ' hand-lizard-o', 'relia'), 'fa fa-hand-o-down' => __( ' hand-o-down', 'relia'), 'fa fa-hand-o-left' => __( ' hand-o-left', 'relia'), 'fa fa-hand-o-right' => __( ' hand-o-right', 'relia'), 'fa fa-hand-o-up' => __( ' hand-o-up', 'relia'), 'fa fa-hand-paper-o' => __( ' hand-paper-o', 'relia'), 'fa fa-hand-peace-o' => __( ' hand-peace-o', 'relia'), 'fa fa-hand-pointer-o' => __( ' hand-pointer-o', 'relia'), 'fa fa-hand-rock-o' => __( ' hand-rock-o', 'relia'), 'fa fa-hand-scissors-o' => __( ' hand-scissors-o', 'relia'), 'fa fa-hand-spock-o' => __( ' hand-spock-o', 'relia'), 'fa fa-hand-stop-o' => __( ' hand-stop-o', 'relia'), 'fa fa-thumbs-down' => __( ' thumbs-down', 'relia'), 'fa fa-thumbs-o-down' => __( ' thumbs-o-down', 'relia'), 'fa fa-thumbs-o-up' => __( ' thumbs-o-up', 'relia'), 'fa fa-thumbs-up' => __( ' thumbs-up', 'relia'), 'fa fa-ambulance' => __( ' ambulance', 'relia'), 'fa fa-automobile' => __( ' automobile', 'relia'), 'fa fa-bicycle' => __( ' bicycle', 'relia'), 'fa fa-bus' => __( ' bus', 'relia'), 'fa fa-cab' => __( ' cab', 'relia'), 'fa fa-car' => __( ' car', 'relia'), 'fa fa-fighter-jet' => __( ' fighter-jet', 'relia'), 'fa fa-motorcycle' => __( ' motorcycle', 'relia'), 'fa fa-plane' => __( ' plane', 'relia'), 'fa fa-rocket' => __( ' rocket', 'relia'), 'fa fa-ship' => __( ' ship', 'relia'), 'fa fa-space-shuttle' => __( ' space-shuttle', 'relia'), 'fa fa-subway' => __( ' subway', 'relia'), 'fa fa-taxi' => __( ' taxi', 'relia'), 'fa fa-train' => __( ' train', 'relia'), 'fa fa-truck' => __( ' truck', 'relia'), 'fa fa-wheelchair' => __( ' wheelchair', 'relia'), 'fa fa-genderless' => __( ' genderless', 'relia'), 'fa fa-intersex' => __( ' intersex', 'relia'), 'fa fa-mars' => __( ' mars', 'relia'), 'fa fa-mars-double' => __( ' mars-double', 'relia'), 'fa fa-mars-stroke' => __( ' mars-stroke', 'relia'), 'fa fa-mars-stroke-h' => __( ' mars-stroke-h', 'relia'), 'fa fa-mars-stroke-v' => __( ' mars-stroke-v', 'relia'), 'fa fa-mercury' => __( ' mercury', 'relia'), 'fa fa-neuter' => __( ' neuter', 'relia'), 'fa fa-transgender' => __( ' transgender', 'relia'), 'fa fa-transgender-alt' => __( ' transgender-alt', 'relia'), 'fa fa-venus' => __( ' venus', 'relia'), 'fa fa-venus-double' => __( ' venus-double', 'relia'), 'fa fa-venus-mars' => __( ' venus-mars', 'relia'), 'fa fa-file' => __( ' file', 'relia'), 'fa fa-file-archive-o' => __( ' file-archive-o', 'relia'), 'fa fa-file-audio-o' => __( ' file-audio-o', 'relia'), 'fa fa-file-code-o' => __( ' file-code-o', 'relia'), 'fa fa-file-excel-o' => __( ' file-excel-o', 'relia'), 'fa fa-file-image-o' => __( ' file-image-o', 'relia'), 'fa fa-file-movie-o' => __( ' file-movie-o', 'relia'), 'fa fa-file-o' => __( ' file-o', 'relia'), 'fa fa-file-pdf-o' => __( ' file-pdf-o', 'relia'), 'fa fa-file-photo-o' => __( ' file-photo-o', 'relia'), 'fa fa-file-picture-o' => __( ' file-picture-o', 'relia'), 'fa fa-file-powerpoint-o' => __( ' file-powerpoint-o', 'relia'), 'fa fa-file-sound-o' => __( ' file-sound-o', 'relia'), 'fa fa-file-text' => __( ' file-text', 'relia'), 'fa fa-file-text-o' => __( ' file-text-o', 'relia'), 'fa fa-file-video-o' => __( ' file-video-o', 'relia'), 'fa fa-file-word-o' => __( ' file-word-o', 'relia'), 'fa fa-file-zip-o' => __( ' file-zip-o', 'relia'), 'fa fa-circle-o-notch' => __( ' circle-o-notch', 'relia'), 'fa fa-cog' => __( ' cog', 'relia'), 'fa fa-gear' => __( ' gear', 'relia'), 'fa fa-refresh' => __( ' refresh', 'relia'), 'fa fa-spinner' => __( ' spinner', 'relia'), 'fa fa-check-square' => __( ' check-square', 'relia'), 'fa fa-check-square-o' => __( ' check-square-o', 'relia'), 'fa fa-circle' => __( ' circle', 'relia'), 'fa fa-circle-o' => __( ' circle-o', 'relia'), 'fa fa-dot-circle-o' => __( ' dot-circle-o', 'relia'), 'fa fa-minus-square' => __( ' minus-square', 'relia'), 'fa fa-minus-square-o' => __( ' minus-square-o', 'relia'), 'fa fa-plus-square' => __( ' plus-square', 'relia'), 'fa fa-plus-square-o' => __( ' plus-square-o', 'relia'), 'fa fa-square' => __( ' square', 'relia'), 'fa fa-square-o' => __( ' square-o', 'relia'), 'fa fa-cc-amex' => __( ' cc-amex', 'relia'), 'fa fa-cc-diners-club' => __( ' cc-diners-club', 'relia'), 'fa fa-cc-discover' => __( ' cc-discover', 'relia'), 'fa fa-cc-jcb' => __( ' cc-jcb', 'relia'), 'fa fa-cc-mastercard' => __( ' cc-mastercard', 'relia'), 'fa fa-cc-paypal' => __( ' cc-paypal', 'relia'), 'fa fa-cc-stripe' => __( ' cc-stripe', 'relia'), 'fa fa-cc-visa' => __( ' cc-visa', 'relia'), 'fa fa-credit-card' => __( ' credit-card', 'relia'), 'fa fa-google-wallet' => __( ' google-wallet', 'relia'), 'fa fa-paypal' => __( ' paypal', 'relia'), 'fa fa-area-chart' => __( ' area-chart', 'relia'), 'fa fa-bar-chart' => __( ' bar-chart', 'relia'), 'fa fa-bar-chart-o' => __( ' bar-chart-o', 'relia'), 'fa fa-line-chart' => __( ' line-chart', 'relia'), 'fa fa-pie-chart' => __( ' pie-chart', 'relia'), 'fa fa-bitcoin' => __( ' bitcoin', 'relia'), 'fa fa-btc' => __( ' btc', 'relia'), 'fa fa-cny' => __( ' cny', 'relia'), 'fa fa-dollar' => __( ' dollar', 'relia'), 'fa fa-eur' => __( ' eur', 'relia'), 'fa fa-euro' => __( ' euro', 'relia'), 'fa fa-gbp' => __( ' gbp', 'relia'), 'fa fa-gg' => __( ' gg', 'relia'), 'fa fa-gg-circle' => __( ' gg-circle', 'relia'), 'fa fa-ils' => __( ' ils', 'relia'), 'fa fa-inr' => __( ' inr', 'relia'), 'fa fa-jpy' => __( ' jpy', 'relia'), 'fa fa-krw' => __( ' krw', 'relia'), 'fa fa-money' => __( ' money', 'relia'), 'fa fa-rmb' => __( ' rmb', 'relia'), 'fa fa-rouble' => __( ' rouble', 'relia'), 'fa fa-rub' => __( ' rub', 'relia'), 'fa fa-ruble' => __( ' ruble', 'relia'), 'fa fa-rupee' => __( ' rupee', 'relia'), 'fa fa-shekel' => __( ' shekel', 'relia'), 'fa fa-sheqel' => __( ' sheqel', 'relia'), 'fa fa-try' => __( ' try', 'relia'), 'fa fa-turkish-lira' => __( ' turkish-lira', 'relia'), 'fa fa-usd' => __( ' usd', 'relia'), 'fa fa-won' => __( ' won', 'relia'), 'fa fa-yen' => __( ' yen', 'relia'), 'fa fa-align-center' => __( ' align-center', 'relia'), 'fa fa-align-justify' => __( ' align-justify', 'relia'), 'fa fa-align-left' => __( ' align-left', 'relia'), 'fa fa-align-right' => __( ' align-right', 'relia'), 'fa fa-bold' => __( ' bold', 'relia'), 'fa fa-chain' => __( ' chain', 'relia'), 'fa fa-chain-broken' => __( ' chain-broken', 'relia'), 'fa fa-clipboard' => __( ' clipboard', 'relia'), 'fa fa-columns' => __( ' columns', 'relia'), 'fa fa-copy' => __( ' copy', 'relia'), 'fa fa-cut' => __( ' cut', 'relia'), 'fa fa-dedent' => __( ' dedent', 'relia'), 'fa fa-eraser' => __( ' eraser', 'relia'), 'fa fa-file' => __( ' file', 'relia'), 'fa fa-file-o' => __( ' file-o', 'relia'), 'fa fa-file-text' => __( ' file-text', 'relia'), 'fa fa-file-text-o' => __( ' file-text-o', 'relia'), 'fa fa-files-o' => __( ' files-o', 'relia'), 'fa fa-floppy-o' => __( ' floppy-o', 'relia'), 'fa fa-font' => __( ' font', 'relia'), 'fa fa-header' => __( ' header', 'relia'), 'fa fa-indent' => __( ' indent', 'relia'), 'fa fa-italic' => __( ' italic', 'relia'), 'fa fa-link' => __( ' link', 'relia'), 'fa fa-list' => __( ' list', 'relia'), 'fa fa-list-alt' => __( ' list-alt', 'relia'), 'fa fa-list-ol' => __( ' list-ol', 'relia'), 'fa fa-list-ul' => __( ' list-ul', 'relia'), 'fa fa-outdent' => __( ' outdent', 'relia'), 'fa fa-paperclip' => __( ' paperclip', 'relia'), 'fa fa-paragraph' => __( ' paragraph', 'relia'), 'fa fa-paste' => __( ' paste', 'relia'), 'fa fa-repeat' => __( ' repeat', 'relia'), 'fa fa-rotate-left' => __( ' rotate-left', 'relia'), 'fa fa-rotate-right' => __( ' rotate-right', 'relia'), 'fa fa-save' => __( ' save', 'relia'), 'fa fa-scissors' => __( ' scissors', 'relia'), 'fa fa-strikethrough' => __( ' strikethrough', 'relia'), 'fa fa-subscript' => __( ' subscript', 'relia'), 'fa fa-superscript' => __( ' superscript', 'relia'), 'fa fa-table' => __( ' table', 'relia'), 'fa fa-text-height' => __( ' text-height', 'relia'), 'fa fa-text-width' => __( ' text-width', 'relia'), 'fa fa-th' => __( ' th', 'relia'), 'fa fa-th-large' => __( ' th-large', 'relia'), 'fa fa-th-list' => __( ' th-list', 'relia'), 'fa fa-underline' => __( ' underline', 'relia'), 'fa fa-undo' => __( ' undo', 'relia'), 'fa fa-unlink' => __( ' unlink', 'relia'), 'fa fa-angle-double-down' => __( ' angle-double-down', 'relia'), 'fa fa-angle-double-left' => __( ' angle-double-left', 'relia'), 'fa fa-angle-double-right' => __( ' angle-double-right', 'relia'), 'fa fa-angle-double-up' => __( ' angle-double-up', 'relia'), 'fa fa-angle-down' => __( ' angle-down', 'relia'), 'fa fa-angle-left' => __( ' angle-left', 'relia'), 'fa fa-angle-right' => __( ' angle-right', 'relia'), 'fa fa-angle-up' => __( ' angle-up', 'relia'), 'fa fa-arrow-circle-down' => __( ' arrow-circle-down', 'relia'), 'fa fa-arrow-circle-left' => __( ' arrow-circle-left', 'relia'), 'fa fa-arrow-circle-o-down' => __( ' arrow-circle-o-down', 'relia'), 'fa fa-arrow-circle-o-left' => __( ' arrow-circle-o-left', 'relia'), 'fa fa-arrow-circle-o-right' => __( ' arrow-circle-o-right', 'relia'), 'fa fa-arrow-circle-o-up' => __( ' arrow-circle-o-up', 'relia'), 'fa fa-arrow-circle-right' => __( ' arrow-circle-right', 'relia'), 'fa fa-arrow-circle-up' => __( ' arrow-circle-up', 'relia'), 'fa fa-arrow-down' => __( ' arrow-down', 'relia'), 'fa fa-arrow-left' => __( ' arrow-left', 'relia'), 'fa fa-arrow-right' => __( ' arrow-right', 'relia'), 'fa fa-arrow-up' => __( ' arrow-up', 'relia'), 'fa fa-arrows' => __( ' arrows', 'relia'), 'fa fa-arrows-alt' => __( ' arrows-alt', 'relia'), 'fa fa-arrows-h' => __( ' arrows-h', 'relia'), 'fa fa-arrows-v' => __( ' arrows-v', 'relia'), 'fa fa-caret-down' => __( ' caret-down', 'relia'), 'fa fa-caret-left' => __( ' caret-left', 'relia'), 'fa fa-caret-right' => __( ' caret-right', 'relia'), 'fa fa-caret-square-o-down' => __( ' caret-square-o-down', 'relia'), 'fa fa-caret-square-o-left' => __( ' caret-square-o-left', 'relia'), 'fa fa-caret-square-o-right' => __( ' caret-square-o-right', 'relia'), 'fa fa-caret-square-o-up' => __( ' caret-square-o-up', 'relia'), 'fa fa-caret-up' => __( ' caret-up', 'relia'), 'fa fa-chevron-circle-down' => __( ' chevron-circle-down', 'relia'), 'fa fa-chevron-circle-left' => __( ' chevron-circle-left', 'relia'), 'fa fa-chevron-circle-right' => __( ' chevron-circle-right', 'relia'), 'fa fa-chevron-circle-up' => __( ' chevron-circle-up', 'relia'), 'fa fa-chevron-down' => __( ' chevron-down', 'relia'), 'fa fa-chevron-left' => __( ' chevron-left', 'relia'), 'fa fa-chevron-right' => __( ' chevron-right', 'relia'), 'fa fa-chevron-up' => __( ' chevron-up', 'relia'), 'fa fa-exchange' => __( ' exchange', 'relia'), 'fa fa-hand-o-down' => __( ' hand-o-down', 'relia'), 'fa fa-hand-o-left' => __( ' hand-o-left', 'relia'), 'fa fa-hand-o-right' => __( ' hand-o-right', 'relia'), 'fa fa-hand-o-up' => __( ' hand-o-up', 'relia'), 'fa fa-long-arrow-down' => __( ' long-arrow-down', 'relia'), 'fa fa-long-arrow-left' => __( ' long-arrow-left', 'relia'), 'fa fa-long-arrow-right' => __( ' long-arrow-right', 'relia'), 'fa fa-long-arrow-up' => __( ' long-arrow-up', 'relia'), 'fa fa-toggle-down' => __( ' toggle-down', 'relia'), 'fa fa-toggle-left' => __( ' toggle-left', 'relia'), 'fa fa-toggle-right' => __( ' toggle-right', 'relia'), 'fa fa-toggle-up' => __( ' toggle-up', 'relia'), 'fa fa-arrows-alt' => __( ' arrows-alt', 'relia'), 'fa fa-backward' => __( ' backward', 'relia'), 'fa fa-compress' => __( ' compress', 'relia'), 'fa fa-eject' => __( ' eject', 'relia'), 'fa fa-expand' => __( ' expand', 'relia'), 'fa fa-fast-backward' => __( ' fast-backward', 'relia'), 'fa fa-fast-forward' => __( ' fast-forward', 'relia'), 'fa fa-forward' => __( ' forward', 'relia'), 'fa fa-pause' => __( ' pause', 'relia'), 'fa fa-play' => __( ' play', 'relia'), 'fa fa-play-circle' => __( ' play-circle', 'relia'), 'fa fa-play-circle-o' => __( ' play-circle-o', 'relia'), 'fa fa-random' => __( ' random', 'relia'), 'fa fa-step-backward' => __( ' step-backward', 'relia'), 'fa fa-step-forward' => __( ' step-forward', 'relia'), 'fa fa-stop' => __( ' stop', 'relia'), 'fa fa-youtube-play' => __( ' youtube-play', 'relia'), 'fa fa-500px' => __( ' 500px', 'relia'), 'fa fa-adn' => __( ' adn', 'relia'), 'fa fa-amazon' => __( ' amazon', 'relia'), 'fa fa-android' => __( ' android', 'relia'), 'fa fa-angellist' => __( ' angellist', 'relia'), 'fa fa-apple' => __( ' apple', 'relia'), 'fa fa-behance' => __( ' behance', 'relia'), 'fa fa-behance-square' => __( ' behance-square', 'relia'), 'fa fa-bitbucket' => __( ' bitbucket', 'relia'), 'fa fa-bitbucket-square' => __( ' bitbucket-square', 'relia'), 'fa fa-bitcoin' => __( ' bitcoin', 'relia'), 'fa fa-black-tie' => __( ' black-tie', 'relia'), 'fa fa-btc' => __( ' btc', 'relia'), 'fa fa-buysellads' => __( ' buysellads', 'relia'), 'fa fa-cc-amex' => __( ' cc-amex', 'relia'), 'fa fa-cc-diners-club' => __( ' cc-diners-club', 'relia'), 'fa fa-cc-discover' => __( ' cc-discover', 'relia'), 'fa fa-cc-jcb' => __( ' cc-jcb', 'relia'), 'fa fa-cc-mastercard' => __( ' cc-mastercard', 'relia'), 'fa fa-cc-paypal' => __( ' cc-paypal', 'relia'), 'fa fa-cc-stripe' => __( ' cc-stripe', 'relia'), 'fa fa-cc-visa' => __( ' cc-visa', 'relia'), 'fa fa-chrome' => __( ' chrome', 'relia'), 'fa fa-codepen' => __( ' codepen', 'relia'), 'fa fa-connectdevelop' => __( ' connectdevelop', 'relia'), 'fa fa-contao' => __( ' contao', 'relia'), 'fa fa-css3' => __( ' css3', 'relia'), 'fa fa-dashcube' => __( ' dashcube', 'relia'), 'fa fa-delicious' => __( ' delicious', 'relia'), 'fa fa-deviantart' => __( ' deviantart', 'relia'), 'fa fa-digg' => __( ' digg', 'relia'), 'fa fa-dribbble' => __( ' dribbble', 'relia'), 'fa fa-dropbox' => __( ' dropbox', 'relia'), 'fa fa-drupal' => __( ' drupal', 'relia'), 'fa fa-empire' => __( ' empire', 'relia'), 'fa fa-expeditedssl' => __( ' expeditedssl', 'relia'), 'fa fa-facebook' => __( ' facebook', 'relia'), 'fa fa-facebook-f' => __( ' facebook-f', 'relia'), 'fa fa-facebook-official' => __( ' facebook-official', 'relia'), 'fa fa-facebook-square' => __( ' facebook-square', 'relia'), 'fa fa-firefox' => __( ' firefox', 'relia'), 'fa fa-flickr' => __( ' flickr', 'relia'), 'fa fa-fonticons' => __( ' fonticons', 'relia'), 'fa fa-forumbee' => __( ' forumbee', 'relia'), 'fa fa-foursquare' => __( ' foursquare', 'relia'), 'fa fa-ge' => __( ' ge', 'relia'), 'fa fa-get-pocket' => __( ' get-pocket', 'relia'), 'fa fa-gg' => __( ' gg', 'relia'), 'fa fa-gg-circle' => __( ' gg-circle', 'relia'), 'fa fa-git' => __( ' git', 'relia'), 'fa fa-git-square' => __( ' git-square', 'relia'), 'fa fa-github' => __( ' github', 'relia'), 'fa fa-github-alt' => __( ' github-alt', 'relia'), 'fa fa-github-square' => __( ' github-square', 'relia'), 'fa fa-gittip' => __( ' gittip', 'relia'), 'fa fa-google' => __( ' google', 'relia'), 'fa fa-google-plus' => __( ' google-plus', 'relia'), 'fa fa-google-plus-square' => __( ' google-plus-square', 'relia'), 'fa fa-google-wallet' => __( ' google-wallet', 'relia'), 'fa fa-gratipay' => __( ' gratipay', 'relia'), 'fa fa-hacker-news' => __( ' hacker-news', 'relia'), 'fa fa-houzz' => __( ' houzz', 'relia'), 'fa fa-html5' => __( ' html5', 'relia'), 'fa fa-instagram' => __( ' instagram', 'relia'), 'fa fa-internet-explorer' => __( ' internet-explorer', 'relia'), 'fa fa-ioxhost' => __( ' ioxhost', 'relia'), 'fa fa-joomla' => __( ' joomla', 'relia'), 'fa fa-jsfiddle' => __( ' jsfiddle', 'relia'), 'fa fa-lastfm' => __( ' lastfm', 'relia'), 'fa fa-lastfm-square' => __( ' lastfm-square', 'relia'), 'fa fa-leanpub' => __( ' leanpub', 'relia'), 'fa fa-linkedin' => __( ' linkedin', 'relia'), 'fa fa-linkedin-square' => __( ' linkedin-square', 'relia'), 'fa fa-linux' => __( ' linux', 'relia'), 'fa fa-maxcdn' => __( ' maxcdn', 'relia'), 'fa fa-meanpath' => __( ' meanpath', 'relia'), 'fa fa-medium' => __( ' medium', 'relia'), 'fa fa-odnoklassniki' => __( ' odnoklassniki', 'relia'), 'fa fa-odnoklassniki-square' => __( ' odnoklassniki-square', 'relia'), 'fa fa-opencart' => __( ' opencart', 'relia'), 'fa fa-openid' => __( ' openid', 'relia'), 'fa fa-opera' => __( ' opera', 'relia'), 'fa fa-optin-monster' => __( ' optin-monster', 'relia'), 'fa fa-pagelines' => __( ' pagelines', 'relia'), 'fa fa-paypal' => __( ' paypal', 'relia'), 'fa fa-pied-piper' => __( ' pied-piper', 'relia'), 'fa fa-pied-piper-alt' => __( ' pied-piper-alt', 'relia'), 'fa fa-pinterest' => __( ' pinterest', 'relia'), 'fa fa-pinterest-p' => __( ' pinterest-p', 'relia'), 'fa fa-pinterest-square' => __( ' pinterest-square', 'relia'), 'fa fa-qq' => __( ' qq', 'relia'), 'fa fa-ra' => __( ' ra', 'relia'), 'fa fa-rebel' => __( ' rebel', 'relia'), 'fa fa-reddit' => __( ' reddit', 'relia'), 'fa fa-reddit-square' => __( ' reddit-square', 'relia'), 'fa fa-renren' => __( ' renren', 'relia'), 'fa fa-safari' => __( ' safari', 'relia'), 'fa fa-sellsy' => __( ' sellsy', 'relia'), 'fa fa-share-alt' => __( ' share-alt', 'relia'), 'fa fa-share-alt-square' => __( ' share-alt-square', 'relia'), 'fa fa-shirtsinbulk' => __( ' shirtsinbulk', 'relia'), 'fa fa-simplybuilt' => __( ' simplybuilt', 'relia'), 'fa fa-skyatlas' => __( ' skyatlas', 'relia'), 'fa fa-skype' => __( ' skype', 'relia'), 'fa fa-slack' => __( ' slack', 'relia'), 'fa fa-slideshare' => __( ' slideshare', 'relia'), 'fa fa-soundcloud' => __( ' soundcloud', 'relia'), 'fa fa-spotify' => __( ' spotify', 'relia'), 'fa fa-stack-exchange' => __( ' stack-exchange', 'relia'), 'fa fa-stack-overflow' => __( ' stack-overflow', 'relia'), 'fa fa-steam' => __( ' steam', 'relia'), 'fa fa-steam-square' => __( ' steam-square', 'relia'), 'fa fa-stumbleupon' => __( ' stumbleupon', 'relia'), 'fa fa-stumbleupon-circle' => __( ' stumbleupon-circle', 'relia'), 'fa fa-tencent-weibo' => __( ' tencent-weibo', 'relia'), 'fa fa-trello' => __( ' trello', 'relia'), 'fa fa-tripadvisor' => __( ' tripadvisor', 'relia'), 'fa fa-tumblr' => __( ' tumblr', 'relia'), 'fa fa-tumblr-square' => __( ' tumblr-square', 'relia'), 'fa fa-twitch' => __( ' twitch', 'relia'), 'fa fa-twitter' => __( ' twitter', 'relia'), 'fa fa-twitter-square' => __( ' twitter-square', 'relia'), 'fa fa-viacoin' => __( ' viacoin', 'relia'), 'fa fa-vimeo' => __( ' vimeo', 'relia'), 'fa fa-vimeo-square' => __( ' vimeo-square', 'relia'), 'fa fa-vine' => __( ' vine', 'relia'), 'fa fa-vk' => __( ' vk', 'relia'), 'fa fa-wechat' => __( ' wechat', 'relia'), 'fa fa-weibo' => __( ' weibo', 'relia'), 'fa fa-weixin' => __( ' weixin', 'relia'), 'fa fa-whatsapp' => __( ' whatsapp', 'relia'), 'fa fa-wikipedia-w' => __( ' wikipedia-w', 'relia'), 'fa fa-windows' => __( ' windows', 'relia'), 'fa fa-wordpress' => __( ' wordpress', 'relia'), 'fa fa-xing' => __( ' xing', 'relia'), 'fa fa-xing-square' => __( ' xing-square', 'relia'), 'fa fa-y-combinator' => __( ' y-combinator', 'relia'), 'fa fa-y-combinator-square' => __( ' y-combinator-square', 'relia'), 'fa fa-yahoo' => __( ' yahoo', 'relia'), 'fa fa-yc' => __( ' yc', 'relia'), 'fa fa-yc-square' => __( ' yc-square', 'relia'), 'fa fa-yelp' => __( ' yelp', 'relia'), 'fa fa-youtube' => __( ' youtube', 'relia'), 'fa fa-youtube-play' => __( ' youtube-play', 'relia'), 'fa fa-youtube-square' => __( ' youtube-square', 'relia'), 'fa fa-ambulance' => __( ' ambulance', 'relia'), 'fa fa-h-square' => __( ' h-square', 'relia'), 'fa fa-heart' => __( ' heart', 'relia'), 'fa fa-heart-o' => __( ' heart-o', 'relia'), 'fa fa-heartbeat' => __( ' heartbeat', 'relia'), 'fa fa-hospital-o' => __( ' hospital-o', 'relia'), 'fa fa-medkit' => __( ' medkit', 'relia'), 'fa fa-plus-square' => __( ' plus-square', 'relia'), 'fa fa-stethoscope' => __( ' stethoscope', 'relia'), 'fa fa-user-md' => __( ' user-md', 'relia'), 'fa fa-wheelchair' => __( ' wheelchair', 'relia') );
}

function relia_all_posts_array() {
    
    $posts = get_posts( array(
        'post_type'        => 'post',
        'posts_per_page'   => -1,
        'post_status'      => 'publish',
        'orderby'          => 'title',
        'order'             => 'ASC',
    ));

    $posts_array = array();

    foreach ( $posts as $post ) :
        
        if ( ! empty( $post->ID ) ) :
            $posts_array[ $post->ID ] = $post->post_title;
        endif;
        
    endforeach;
    
    return $posts_array;
    
}

function relia_fonts(){
    
    $font_family_array = array(
        
        'Abel, sans-serif'                                  => 'Abel',
        'Dosis, sans-serif'                                 => 'Dosis:200,300,400',
        'Open Sans, sans-serif'                             => 'Open+Sans:300,400italic,400',
        
        'Impact, Charcoal, sans-serif'                      => 'Impact',
        'Lucida Console, Monaco, monospace'                 => 'Lucida Console',
        'Lucida Sans Unicode, Lucida Grande, sans-serif'    => 'Lucida Sans Unicode',
        'MS Sans Serif, Geneva, sans-serif'                 => 'MS Sans Serif',
        'MS Serif, New York, serif'                         => 'MS Serif',
        'Palatino Linotype, Book Antiqua, Palatino, serif'  => 'Palatino Linotype',
        'Voltaire, sans-serif'                              => 'Voltaire',
        'Bangers, cursive'                                  => 'Bangers',
        'Lobster Two, cursive'                              => 'Lobster+Two',
        'Josefin Sans, sans-serif'                          => 'Josefin+Sans:300,400,600,700',
        'Montserrat, sans-serif'                            => 'Montserrat:400,700',
        'Poiret One, cursive'                               => 'Poiret+One',
        'Source Sans Pro, sans-serif'                       => 'Source+Sans+Pro:200,400,600',
        'Lato, sans-serif'                                  => 'Lato:100,300,400,700,900,300italic,400italic',
        'Raleway, sans-serif'                               => 'Raleway:200,400,300,500,700',
        'Shadows Into Light, cursive'                       => 'Shadows+Into+Light',
        'Orbitron, sans-serif'                              => 'Orbitron',
        'PT Sans Narrow, sans-serif'                        => 'PT+Sans+Narrow',
        'Lora, serif'                                       => 'Lora',
        'Oswald, sans-serif'                                => 'Oswald:300',
        'Titillium Web, sans-serif'                         => 'Titillium+Web:400,200,300,600,700,200italic,300italic,400italic,600italic,700italic',
        'Teko, sans-serif'                                  => 'Teko:300,400,600',
        'Roboto, sans-serif'                                => 'Roboto:100,300,400,500',
        
    );
    
    return $font_family_array;
}

// SANITIZATION CALLBACKS

function relia_sanitize( $input ) {
    return $input;
}

function relia_sanitize_integer( $input ) {
    return intval( $input );
}

function relia_sanitize_decimal( $input ) {
    return $input > 1.0 || $input < .0 ? null : $input;
}

function relia_sanitize_text( $input ) {
    return sanitize_text_field( $input );
}

function relia_sanitize_icon( $input ) {
    return $input;
}

function relia_sanitize_post( $input ) {
    return $input;
}

function relia_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function relia_sanitize_widget_area_toggle( $input ) {
    $valid_keys = array(
        'on'            => __( 'Visible', 'relia' ),
        'off'           => __( 'Hidden', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
}

function relia_sanitize_nav_link_toggle( $input ) {
    $valid_keys = array(
        'dark'          => __('Dark Links', 'relia'),
        'bright'        => __('Bright Links', 'relia'),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }  
}

function relia_sanitize_shop_sidebar( $input ) {
    $valid_keys = array(
        'left'  => __( 'Left Side', 'relia' ),
        'right' => __( 'Right Side', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }   
}

function relia_sanitize_skin( $input ) {

    return $input;
}

function relia_sanitize_articles_switch( $input ) {
    $valid_keys = array(
        'recent'    => __( 'Show Most Recent', 'relia' ),
        'featured'  => __( 'Use Featured', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';  
    }
}

function relia_sanitize_logo_or_title_switch( $input ) {
    $valid_keys = array(
        'title'             => __( 'Use Site Title', 'relia' ),
        'logo'              => __( 'Use Logo', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';  
    }
}

function relia_sanitize_show_hide( $input ) {
    $valid_keys = array(
        'show'              => __( 'Show', 'relia' ),
        'hide'              => __( 'Hide', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';  
    }
}

function relia_sanitize_static_background_toggle( $input ) {
    $valid_keys = array(
        'image'             => __( 'Use a background image', 'relia' ),
        'color'              => __( 'Use a solid color background', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';  
    }
}

function relia_sanitize_jumbotron_type( $input ) {
    $valid_keys = array(
        'slider'            => __( 'Slider', 'relia' ),
        'static'            => __( 'Static Image', 'relia' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';  
    }
}


