<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

    <title>
        <?php
        global $page, $paged;

        wp_title('|', true, 'right');

        bloginfo('name');

        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() ))
            echo " | $site_description";

        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', tk_theme_name), max($paged, $page));
        ?>
    </title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
                <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />


	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />



	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



        <?php
                    $colors = get_theme_option(tk_theme_name.'_general_colors');

                    if($colors == 'default') {
                        $textshadow = '555555';
                        $color = 'bt-time.png';
                        $small_text_shadow = '7d7d7d';
                    } elseif($colors == 'blue') {
                        $textshadow ='4388a8';
                        $color = 'bt-time_blue.png';
                        $small_text_shadow = '59b7e3';
                    } elseif($colors =='green') {
                        $textshadow = '4a8656';
                        $color = 'bt-time_green.png';
                        $small_text_shadow = '63b775';
                    } elseif($colors == 'grey') {
                        $textshadow = '989898';
                        $small_text_shadow = 'cdcdcd';
                        $color = 'bt-time_grey.png';
                    } elseif($colors == 'orange') {
                        $textshadow = 'ae733a';
                        $small_text_shadow = 'eb9a4c';
                        $color = 'bt-time_orange.png';
                    } elseif($colors == 'red') {
                        $small_text_shadow = 'eb6e4d';
                        $textshadow = 'ae523a';
                        $color = 'bt-time_red.png';
                    } else {
                        $textshadow = '555555';
                        $color = 'bt-time.png';
                        $small_text_shadow = '7d7d7d';
                    }

        ?>


        <style type="text/css">

            .time-one {
                background:url("<?php echo get_template_directory_uri(); ?>/style/img/<?php echo $color; ?>") no-repeat top left !important;
            }

            .time-one span {
                text-shadow:0 1px #<?php echo $textshadow; ?>;
            }

            .time-one p {
                 text-shadow:0 1px #<?php echo $small_text_shadow; ?>;
            }


        </style>
<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->




<?php

        /*************************************************************/
        /*Test user agent and load css for it***************************/
        /*************************************************************/

        $prefix = 'tk_';
        $ua = $_SERVER["HTTP_USER_AGENT"];

        // Macintosh
        $mac = strpos($ua, 'Macintosh') ? true : false;

        // Windows
        $win = strpos($ua, 'Windows') ? true : false;


        $browser = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($browser, 'Safari')) {
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-safari.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'Firefox')) {
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-firefox.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'MSIE 8.0')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie8.css" type="text/css" />
                <script src="<?php echo get_template_directory_uri(); ?>/script/respond/respond.src.js"></script>
            <?php
        }

        if (strpos($browser, 'MSIE 9.0')) {
            ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie9.css" type="text/css" />
            <?php
        }


        if (strpos($browser, 'pera')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/opera.css" type="text/css" />
            <?php
            if(!empty($win)) {
                if($win == Windows) { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-opera.css" type="text/css" />
                <?php
                }
            }
        }
?>



        <?php

        /*************************************************************/
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/


            wp_enqueue_script('jquery');
            wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js' );
            wp_enqueue_script('pirobox', get_template_directory_uri().'/script/pirobox/js/pirobox.js' );
            wp_enqueue_script('jscolor', get_template_directory_uri().'/script/jscolor/jscolor.js' );
            wp_enqueue_script('counter', get_template_directory_uri().'/script/countdown/jquery.countdown.js' );

            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        ?>

        <?php $favicon = get_theme_option(tk_theme_name.'_general_favicon'); if(empty($favicon)) { $favicon = get_template_directory_uri()."/style/img/favicon.ico"; }?>
        <link rel="shortcut icon" href="<?php echo $favicon;?>" />


        <?php

         $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');

         if( isset ($g_analitics) && $g_analitics != ''){
             echo $g_analitics;
         }

        ?>


<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>


<div id="container">


    <div class="bg-grow left"></div>

    <!-- HEADER -->
    <div class="header left">

        <div class="border-colors left"></div><!--/border-colors-->

        <div class="wrapper">


            <!--LOGO-->
            <div class="logo left">
           <?php
                $logo = get_option(tk_theme_name.'_general_header_logo');
                if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }
                $logo_catchline = get_theme_option(tk_theme_name.'_general_logo_catchline');
             ?>
             <img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/>
                <?php if(!empty($logo_catchline)) { ?><span><?php echo $logo_catchline; ?></span><?php } ?>
            </div><!--/logo-->

            <?php
                $twitter_username = get_theme_option(tk_theme_name.'_general_twitter_username');
                $facebook_username = get_theme_option(tk_theme_name.'_general_facebook_username');
                $plus_username = get_theme_option(tk_theme_name.'_general_plus_username');
                $rss_link = get_theme_option(tk_theme_name.'_general_rss_link');
                $pinterest_username = get_theme_option(tk_theme_name.'_general_pinterest_username');

            ?>


            <div class="header-links right">
                <ul>
                    <?php if($twitter_username || $facebook_username || $plus_username || $rss_link || $pinterest_username) { ?>  <li><?php _e('Follow us on :', tk_theme_name); ?></li><?php } ?>
                    <?php if($twitter_username) { ?><li><a href="http://twitter.com/<?php echo $twitter_username; ?>"><div class="header-copy-icon1 left"></div></a></li><?php } ?>
                    <?php if($facebook_username) { ?><li><a href="http://facebook.com/<?php echo $facebook_username; ?>"><div class="header-copy-icon2 left"></div></a></li><?php } ?>
                    <?php if($plus_username) { ?><li><a href="https://plus.google.com/<?php echo $plus_username; ?>"><div class="header-copy-icon3 left"></div></a></li><?php } ?>
                    <?php if($rss_link) { ?><li><a href="<?php echo $rss_link; ?>"><div class="header-copy-icon4 left"></div></a></li><?php } ?>
                    <?php if($pinterest_username) { ?><li><a href="http://pinterest.com/<?php echo $pinterest_username; ?>"><div class="header-copy-icon5 left"></div></a></li><?php } ?>
                </ul>
            </div><!--/header-links-->

        </div><!--/wrapper-->
    </div><!--/header-->