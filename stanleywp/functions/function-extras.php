<?php
function bootstrap_scripts()
{
	// Register the scripts for this theme:
	wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	wp_register_script( 'hover-script', get_template_directory_uri() . '/js/hover.zoom.js', array( 'jquery' ) );
	wp_register_script( 'main-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );

	//  enqueue the script:
	wp_enqueue_script( 'bootstrap-script' );
	wp_enqueue_script( 'hover-script' );
	wp_enqueue_script( 'main-script' );
}
add_action( 'wp_enqueue_scripts', 'bootstrap_scripts' );


function bootstrap_styles()
{
	// Register the style like this for a theme:
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.0.3', 'all' );
	wp_register_style( 'wpbase', get_template_directory_uri() . '/css/wpbase.min.css', array(), '3.0.3', 'all' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.0.3', 'all' );
	wp_register_style( 'magnific', get_template_directory_uri() . '/css/magnific.css', array(), '0.9.4', 'all' );
	wp_register_style( 'theme-style', get_stylesheet_uri(), false, '3.0.3' );


	//  enqueue the style:
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'wpbase' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'magnific' );
	wp_enqueue_style( 'theme-style' );
	
}
add_action( 'wp_enqueue_scripts', 'bootstrap_styles' );


  function load_fonts() {
            wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Montserrat:400,700');
            wp_enqueue_style( 'googleFonts');
        }
 
    add_action('wp_print_styles', 'load_fonts');


?>
<?php
// Custom Bootstrap Menu
add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){

		add_action( 'init', 'register_menu' );

		function register_menu(){
			register_nav_menu( 'top-bar', 'Top Menu' ); 
		}

		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth ) {

				$indent = str_repeat( "\t", $depth );
				$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) ) 
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) ) 
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
					unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);

			}

		}

	}

	endif;
?>
<?php
// Put post thumbnails into rss feed
	function wpfme_feed_post_thumbnail($content) {
		global $post;
		if(has_post_thumbnail($post->ID)) {
			$content = '' . $content;
		}
		return $content;
	}
	add_filter('the_excerpt_rss', 'wpfme_feed_post_thumbnail');
	add_filter('the_content_feed', 'wpfme_feed_post_thumbnail');
?>
<?php
// Custom Pagination
	function custom_link_pages($args = '') {
		$defaults = array(
			'before' => '<li>' . __('Pages:'), 'after' => '</li>',
			'link_before' => '', 'link_after' => '',
			'next_or_number' => 'number', 'nextpagelink' => __('Next page'),
			'previouspagelink' => __('Previous page'), 'pagelink' => '%',
			'echo' => 1
			);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;
		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
					$j = str_replace('%',$i,$pagelink);
					$output .= ' ';
					if ( ($i != $page) || ((!$more) && ($page==1)) ) {
						$output .= '<li>' . _wp_link_page($i);
					} elseif ( $i == $page ) {
						$output .= '<li><a href="#">';
					}
					$output .= $link_before . $j . $link_after;
					if ( ($i != $page) || ( $i == $page ) || ((!$more) && ($page==1)) )
						$output .= '</a></li>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page($i);
						$output .= $link_before. $previouspagelink . $link_after . '</a></li>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page($i);
						$output .= $link_before. $nextpagelink . $link_after . '</a></li>';
					}
					$output .= $after;
				}
			}
		}

		if ( $echo )
			echo $output;

		return $output;
	}

// Custom Next/Previous Page
	add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');
/**
 * Add prev and next links to a numbered link list
 */
function wp_link_pages_args_prevnext_add($args)
{
	global $page, $numpages, $more, $pagenow;

	if (!$args['next_or_number'] == 'next_and_number')
        return $args; # exit early

    $args['next_or_number'] = 'number'; # keep numbering for the main part
    if (!$more)
        return $args; # exit early

    if($page-1) # there is a previous page
    $args['before'] .= '<li>' . _wp_link_page($page-1)
    . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a></li>'
    ;

    if ($page<$numpages) # there is a next page
    $args['after'] = '<li>' . _wp_link_page($page+1)
    . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a></li>'
    . $args['after']
    ;

    return $args;
}
?>
<?php
// make tags into a bootstrap button
function add_class_the_tags($html){
	$postid = get_the_ID();
	$html = str_replace('<a','<a class="tags"',$html);
	return $html;
}
add_filter('the_tags','add_class_the_tags',10,1);
?>
<?php
// adds the magnific jQuery code
function insert_magnific_js() {
	?>
	<script type="text/javascript">
    // <![CDATA[
    jQuery(document).ready(function($){
    	$("a[rel='magnific']").magnificPopup({
    		type:'image'
    	});
    });  
    // ]]>
    </script>
    <?php
}
add_action( 'wp_head', 'insert_magnific_js' );
?>
<?php
// automatically add magnific rel attributes to embedded images
function insert_magnific_rel($content) {
	$pattern = '/<a(.*?)href="(.*?).(bmp|gif|jpeg|jpg|png)"(.*?)>/i';
	$replacement = '<a$1href="$2.$3" rel=\'magnific\'$4>';
	$content = preg_replace( $pattern, $replacement, $content );
	return $content;
}
add_filter( 'the_content', 'insert_magnific_rel' );
?>
<?php
//add svg support to WordPress uploader
function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
?>