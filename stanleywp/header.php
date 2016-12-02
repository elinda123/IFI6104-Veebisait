<?php
/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php if( bi_get_data('custom_favicon') !== '' ) : ?>
        <link rel="icon" type="image/png" href="<?php echo bi_get_data('custom_favicon'); ?>" />
    <?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php get_template_directory_uri();?>/js/html5shiv.js"></script>
      <script src="<?php get_template_directory_uri();?>/js/respond.min.js"></script>
    <![endif]-->

<?php wp_head(); ?> 

</head>

<body <?php body_class(); ?>>
                 
<?php gents_container(); // before container hook ?>

         
    <?php gents_header(); // before header hook ?>
    <header>
   
    <?php gents_in_header(); // header hook ?>

<nav role="navigation">
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
           <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

           <?php if( bi_get_data('custom_logo') !== '' ) { ?>
            <div id="logo"><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home">
                <img src="<?php echo bi_get_data('custom_logo'); ?>" alt="<?php bloginfo( 'name' ) ?>" />
            </a></div>
            <?php } else { ?>
            <?php if (is_front_page()) { ?>
            <a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><b><?php bloginfo( 'name' ) ?></b></a>
            <?php } else { ?>
            <a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><b><?php bloginfo( 'name' ) ?></b></a>
            <?php } } ?>
        </div>
          <div class="navbar-collapse collapse navbar-responsive-collapse">
			   <?php

                $args = array(
                    'theme_location' => 'top-bar',
                    'depth'      => 2,
                    'container'  => false,
                    'menu_class'     => 'nav navbar-nav navbar-right',
                    'walker'     => new Bootstrap_Walker_Nav_Menu()
                );

                wp_nav_menu($args);

            ?>

          </div>
        </div>
     </div>           
</nav>
           
 
    </header><!-- end of header -->
    <?php gents_header_end(); // after header hook ?>
    
	<?php gents_wrapper(); // before wrapper ?>
    
        <div id="wrapper" class="clearfix">
    
    <?php gents_in_wrapper(); // wrapper hook ?>
