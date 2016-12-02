<?php
/**
 * Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        StanleyWP 
 * @author         Brad Williams & Carlos Alvarez 
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Functions_File
 * @since          available since Release 1.0
 */
?>
<?php
/**
 * Fire up the engines boys and girls let's start theme setup.
 */
add_action('after_setup_theme', 'gents_setup');

if (!function_exists('gents_setup')):

    function gents_setup() {

        global $content_width;

        /**
         * Global content width.
         */
        if (!isset($content_width))
            $content_width = 550;

        /**
         * Responsive is now available for translations.
         * Add your files into /languages/ directory.
		 * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
         */
	    load_theme_textdomain('gents', get_template_directory().'/languages');

            $locale = get_locale();
            $locale_file = get_template_directory().'/languages/$locale.php';
            if (is_readable( $locale_file))
	            require_once( $locale_file);
						
        /**
         * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
        add_editor_style();

        /**
         * This feature enables post and comment RSS feed links to head.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
         */
        add_theme_support('automatic-feed-links');

        /**
         * This feature enables post-thumbnail support for a theme.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */

        add_theme_support('post-thumbnails');


        $options = get_option('gents_theme_options');    
    }

endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function gents_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'gents_page_menu_args' );

/**
 * Remove div from wp_page_menu() and replace with ul.
 */
function gents_wp_page_menu ($page_markup) {
    preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
        $divclass = $matches[1];
        $replace = array('<div class="'.$divclass.'">', '</div>');
        $new_markup = str_replace($replace, '', $page_markup);
        $new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
        return $new_markup; }

add_filter('wp_page_menu', 'gents_wp_page_menu');

/**
 * Filter 'get_comments_number'
 * 
 * Filter 'get_comments_number' to display correct 
 * number of comments (count only comments, not 
 * trackbacks/pingbacks)
 *
 * Courtesy of Chip Bennett
 */
function gents_comment_count( $count ) {  
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
add_filter('get_comments_number', 'gents_comment_count', 0);

/**
 * wp_list_comments() Pings Callback
 * 
 * wp_list_comments() Callback function for 
 * Pings (Trackbacks/Pingbacks)
 */
function gents_comment_list_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }

/**
 * Sets the post excerpt length to 40 characters.
 * Next few lines are adopted from Coraline
 */
function gents_excerpt_length($length) {
    return 40;
}

add_filter('excerpt_length', 'gents_excerpt_length');

/**
 * Returns a "Read more" link for excerpts
 */
function gents_read_more() {
    return ' <a href="' . get_permalink() . '">' . __('<div class="read-more"><p>Read more &#8250;</p></div><!-- end of .read-more -->', 'gents') . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and gents_read_more_link().
 */
function gents_auto_excerpt_more($more) {
    return gents_read_more();
}

add_filter('excerpt_more', 'gents_auto_excerpt_more');

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
function gents_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= gents_read_more();
    }
    return $output;
}

add_filter('get_the_excerpt', 'gents_custom_excerpt_more');

/**
 * Custom Read More Button
 */

function my_more_link( $more_link, $more_link_text ) {
    
    $read_more_text = bi_get_data('read_more_text', '' );
            
    return str_replace( $more_link_text, '<p><a href="' . get_permalink() . '" class="readmore">'.$read_more_text.' </a> </p>', $more_link );
}

add_filter( 'the_content_more_link', 'my_more_link', 10, 2 );


/**
 * This function removes inline styles set by WordPress gallery.
 */
function gents_remove_gallery_css($css) {
    return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
}

add_filter('gallery_style', 'gents_remove_gallery_css');


/**
 * This function removes default styles set by WordPress recent comments widget.
 */
function gents_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'gents_remove_recent_comments_style' );


/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Courtesy of Dimox
 *
 * bbPress compatibility patch by Dan Smith
 */
function gents_breadcrumb_lists() {

    $chevron = '<span class="divider">/</span>';
    $name = __('Home','gents'); //text for the 'Home' link
    $currentBefore = '<li class="active">';
    $currentAfter = '</li>';

    echo '<ul class="breadcrumb">';

    global $post;
    $home = home_url();
    echo '<li><a href="' . $home . '">' . $name . '</a></li>';

    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ''));
        echo $currentBefore . 'Archive by category &#39;';
        single_cat_title();
        echo '&#39;' . $currentAfter;
    } elseif (is_day()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $chevron . '</li>  ';
        echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ';
        echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif (is_month()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
        echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif (is_year()) {
        echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif (is_single()) {
        $pid = $post->ID;
        $pdata = get_the_category($pid);
        $adata = get_post($pid);
        if(!empty($pdata)){
            echo '<li>' .get_category_parents($pdata[0]->cat_ID, TRUE, ' '). '</li> ';
            echo $currentBefore;
        }
        echo $adata->post_title;
        echo $currentAfter;
    } elseif (is_page() && !$post->post_parent) {
        echo $currentBefore;
        the_title();
        echo $currentAfter;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumb_lists = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumb_lists[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumb_lists = array_reverse($breadcrumb_lists);
        foreach ($breadcrumb_lists as $crumb)
            echo $crumb . ' ' . $chevron . ' ';
        echo $currentBefore;
        the_title();
        echo $currentAfter;
    } elseif (is_search()) {
        echo $currentBefore . __('Search results for &#39;','gents') . get_search_query() . __('&#39;','gents') . $currentAfter;
    } elseif (is_tag()) {
        echo $currentBefore . __('Posts tagged &#39;','gents');
        single_tag_title();
        echo '&#39;' . $currentAfter;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $currentBefore . __('Articles posted by ','gents') . $userdata->display_name . $currentAfter;
    } elseif (is_404()) {
        echo $currentBefore . __('Error 404','gents') . $currentAfter;
    }

    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo __('Page','gents') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }

    echo '</ul>';
}


    /**
     * A safe way of adding javascripts to a WordPress generated page.
     */
    if (!is_admin())
        add_action('wp_enqueue_scripts', 'gents_js');

    if (!function_exists('gents_js')) {

        function gents_js() {
			// JS at the bottom for fast page loading. 
			// except for Modernizr which enables HTML5 elements & feature detects.
			wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '2.6.2', false);
            wp_enqueue_script('magnific', get_template_directory_uri() . '/js/magnific.min.js', array('jquery'), '0.9.4', false);
        }

    }

    /**
     * A comment reply.
     */
        function gents_enqueue_comment_reply() {
    if ( is_singular() && comments_open() && get_option('thread_comments')) { 
            wp_enqueue_script('comment-reply'); 
        }
    }

    add_action( 'wp_enqueue_scripts', 'gents_enqueue_comment_reply' );
	
    /**
     * Where the post has no post title, but must still display a link to the single-page post view.
     */
    add_filter('the_title', 'gents_title');

    function gents_title($title) {
        if ($title == '') {
            return __('Untitled','gents');
        } else {
            return $title;
        }
    }

    /**
     * WordPress Widgets start right here.
     */
    function gents_widgets_init() {

          register_sidebar(array(
            'name' => __('Left Footer', 'gents'),
            'description' => __('footer.php', 'gents'),
            'id' => 'footer-left',
            'before_title' => '<div class="footer-title"><h4>',
            'after_title' => '</h4></div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

          register_sidebar(array(
            'name' => __('Middle Footer', 'gents'),
            'description' => __('footer.php', 'gents'),
            'id' => 'footer-middle',
            'before_title' => '<div class="footer-title"><h4>',
            'after_title' => '</h4></div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));

          register_sidebar(array(
            'name' => __('Right Footer', 'gents'),
            'description' => __('footer.php', 'gents'),
            'id' => 'footer-right',
            'before_title' => '<div class="footer-title"><h4>',
            'after_title' => '</h4></div>',
            'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
            'after_widget' => '</div>'
        ));
    }
	
    add_action('widgets_init', 'gents_widgets_init');
?>