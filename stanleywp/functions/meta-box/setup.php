<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'wtf_';

global $meta_boxes;

$meta_boxes = array();

// Post Type name
	$portfolio_post_type_name = ( bi_get_data('portfolio_post_type_name') ) ? bi_get_data('portfolio_post_type_name') : __('Portfolio','gents');

	//Individual Portfolio
	$meta_boxes[] = array(
		'id'         => 'portfolio_metabox',
		'title'      => 'Options',
		'pages'      => array( 'portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __('Main Title','gents'),
				'desc' => __('This is the content that will be displayed at the very top. Optional.','gents'),
				'id' => $prefix . 'portfolio_top_title',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'std' => '<h3>PROJECT NAME</h3>',
			),
			array(
				'name'    => __( 'Show Categories', 'gents' ),
				'id'      => $prefix . 'port_cats',
				'type'    => 'radio',
				'options' => array(
					'value1' => __( 'Yes', 'gents' ),
					'value2' => __( 'No', 'gents' ),
				),
			),
			array(
				'name' => __( 'Images', 'gents' ),
				'id'   => "thickbox",
				'type' => 'thickbox_image',
			),
		
		),
	);


	// Portfolio Page
$meta_boxes[] = array(
	'title'  => __( 'Options', 'gents' ),
	'pages' => array('page'),
	'fields' => array(
			array(
				'name' => __('Title','gents'),
				'desc' => __('Enter the text to be displayed above the portfolio items. ','gents'),
				'id' => $prefix . 'portfolio_title',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'std'  => '<h3>LATEST WORKS</h3>',
			),

	),
	'only_on'    => array(
		'template' => array( 'template-portfolio.php' )
	),
);


// About
$meta_boxes[] = array(
	'title'  => __( 'Options', 'gents' ),
	'pages' => array('page'),
	'fields' => array(
			array(
				'name' => __('Title','gents'),
				'desc' => __('Enter the text to be displayed above the main content. ','gents'),
				'id' => $prefix . 'about_title',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'std'  => '<h1>About Stanley!</h1>',
			),
		
			array(
				'name' => __('Left Text','gents'),
				'desc' => __('Enter the text to be displayed under the columns on the left. Optional.','gents'),
				'id' => $prefix . 'about_left_txt',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'std'  => '<h4>THE THINKING</h4>
				<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>',
			),

			array(
				'name' => __('Right Text','gents'),
				'desc' => __('Enter the text to be displayed under the columns on the right. Optional.','gents'),
				'id' => $prefix . 'about_right_txt',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'std'  => '<h4>THE SKILLS</h4>
				Wordpress
				<div class="progress">
					<div class="progress-bar progress-bar-theme" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						<span class="sr-only">60% Complete</span>
					</div>
				</div>

				Photoshop
				<div class="progress">
					<div class="progress-bar progress-bar-theme" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						<span class="sr-only">80% Complete</span>
					</div>
				</div>
				
				HTML + CSS
				<div class="progress">
					<div class="progress-bar progress-bar-theme" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						<span class="sr-only">95% Complete</span>
					</div>
				</div>',
			),


			array(
				'name' => __('Column Content','gents'),
				'desc' => __('Enter the text to be displayed. Optional.','gents'),
				'id' => $prefix . 'about_col',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'clone' => true,
			),

	),
	'only_on'    => array(
		'template' => array( 'template-about.php' )
	),
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function wtf_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) ) {
		foreach ( $meta_boxes as $meta_box ) {
			if ( isset( $meta_box['only_on'] ) && ! rw_maybe_include( $meta_box['only_on'] ) ) {
				continue;
			}

			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'wtf_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions ) {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	foreach ( $conditions as $cond => $v ) {
		// Catch non-arrays too
		if ( ! is_array( $v ) ) {
			$v = array( $v );
		}

		switch ( $cond ) {
			case 'id':
				if ( in_array( $post_id, $v ) ) {
					return true;
				}
			break;
			case 'parent':
				$post_parent = $post->post_parent;
				if ( in_array( $post_parent, $v ) ) {
					return true;
				}
			break;
			case 'slug':
				$post_slug = $post->post_name;
				if ( in_array( $post_slug, $v ) ) {
					return true;
				}
			break;
			case 'template':
				$template = get_post_meta( $post_id, '_wp_page_template', true );
				if ( in_array( $template, $v ) ) {
					return true;
				}
			break;
		}
	}

	// If no condition matched
	return false;
}
?>