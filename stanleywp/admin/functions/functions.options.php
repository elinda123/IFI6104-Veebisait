<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
			$categories_tmp 	= array_unshift($of_categories, "Select a category:");
     

		//Access the WordPress Pages via an Array
			$of_pages 			= array();
			$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
			foreach ($of_pages_obj as $of_page) {
				$of_pages[$of_page->ID] = $of_page->post_name; }
				$of_pages_tmp 		= array_unshift($of_pages, "Select a page:"); 
      

		//Testing 
				$of_options_select 	= array("one","two","three","four","five"); 
				$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

				$font_size = array( 'select', '12px', '13px', '14px' );
				$font_style = array( "normal", "italic", "bold", "bold italic");

		//Sample Homepage blocks for the layout manager (sorter)
				$of_options_homepage_blocks = array(
			"enabled"	=> array (
				"placebo"	=> "placebo", //REQUIRED!
				"home_static_page"	=> "Page Content",
					
			),
			"disabled"	=> array (
				"placebo"	=> "placebo", //REQUIRED!
				"home_portfolio"	=> "Portfolio",			
			),
		);


		//Stylesheets Reader
				$alt_stylesheet_path = LAYOUT_PATH;
				$alt_stylesheets = array();

				if ( is_dir($alt_stylesheet_path) ) 
				{
					if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
					{ 
						while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
						{
							if(stristr($alt_stylesheet_file, ".css") !== false)
							{
								$alt_stylesheets[] = $alt_stylesheet_file;
							}
						}    
					}
				}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) { 
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}    
			}
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		$menu_color = array( 'Default', 'Inverse' );
		// Homepage Latest Blog or Featured Image
		$hp_array = array('featured' => __('Featured Hero Unit', 'gents'),'latest' => __('Latest Blog Post', 'gents'));
		// Buttons
		$btn_color = array("default" => "Default Gray","primary" => "Primary","info" => "Info","success" => "Success","warning" => "Warning","danger" => "Danger","inverse" => "Inverse");
		$btn_size = array("xs" => "Extra Small","sm" => "Small","default" => "Medium","lg" => "Large");
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

// Set the Options Array
		global $of_options;
		$of_options = array();

		$of_options[] = array( "name"	=> __( 'General', 'gents' ),
			"type"	=> "heading",
			);

		$of_options[] = array( "name"	=> __( 'Favicon', 'gents' ),
			"desc"	=> __( 'Upload or past the URL for your custom favicon.', 'gents' ),
			"id"	=> "custom_favicon",
			"std"	=> "",
			"type"	=> "media");

		// Header
		$of_options[] = array( "name"	=> __( 'Header', 'gents' ),
			"type"	=> "heading");


		$of_options[] = array( "name"	=> __( 'Main Logo', 'gents' ),
			"desc"	=> __( 'Use this field to upload your custom logo for use in the theme header. (Recommended 200px x 40px)', 'gents' ),
			"id"	=> "custom_logo",
			"std"	=> "",
			"type"	=> "media",
			);
	

		//Homepage					
		$of_options[] = array( "name"	=> __( 'Homepage', 'gents' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Homepage Layout Manager', 'gents' ),
			"desc"	=> __( 'Organize how you want the layout to appear on the homepage.', 'gents' ),
			"id"	=> "homepage_blocks",
			"std"	=> $of_options_homepage_blocks,
			"type"	=> "sorter");


		$of_options[] = array( 	"name"	=> "",
							"desc"	=> "",
							"id"	=> "subheading",
							"std"	=> "<h3 style=\"margin: 0;\">". __( 'Portfolio', 'gents' ) ."</h3>",
							"icon"	=> true,
							"type"	=> "info"
					);
							

			$of_options[] = array( "name"	=> __( 'Portfolio Items', 'gents' ),
							"desc"	=> __( 'Enter the number of portfolio items to display on the homepage. -1 for all items.', 'gents' ),
							"id"	=> "home_portfolio_count",
							"std"	=> "3",
							"type"	=> "text");

				//Blog				
		$of_options[] = array( "name"	=> __( 'Blog', 'gents' ),
			"type"	=> "heading");


		$of_options[] = array( 	"name" 		=> "Read More Text",
			"desc" 		=> "This is the text that will replace Read More.",
			"id" 		=> "read_more_text",
			"std" 		=> "Read More",
			"type" 		=> "text"
			);


		$of_options[] = array( "name"	=> __( 'Display Tags', 'gents' ),
			"desc"	=> __( 'Select to enable/disable the post tags.', 'gents' ),
			"id"	=> "enable_disable_tags",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'gents' ),
			"off"	=> __( 'Disable', 'gents' ),
			"type"	=> "switch");


			//Portfolio					
		$of_options[] = array( "name"	=> __( 'Portfolio', 'gents' ),
			"type"	=> "heading");



		$of_options[] = array( "name"	=> __( 'Display Project Titles', 'gents' ),
			"desc"	=> __( 'Select to enable/disable the project titles.', 'gents' ),
			"id"	=> "project_title",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'gents' ),
			"off"	=> __( 'Disable', 'gents' ),
			"type"	=> "switch");


		//Post Types
		$of_options[] = array( "name"	=> __( 'Post Types', 'reponsive' ),
							"type"	=> "heading");
							
								
		$of_options[] = array( "name"	=> __( 'Portfolio Name', 'reponsive' ),
							"desc"	=> __( 'Enter a custom name for your portfolio post type.', 'reponsive' ),
							"id"	=> "portfolio_post_type_name",
							"std"	=> "Portfolio",
							"type"	=> "text");
							
		$of_options[] = array( "name"	=> __( 'Portfolio Slug', 'reponsive' ),
							"desc"	=> __( 'Enter a custom slug for your portfolio post type. Go <strong>save your permalinks</strong> after changing this.', 'reponsive' ),
							"id"	=> "portfolio_post_type_slug",
							"std"	=> "portfolio",
							"type"	=> "text");
							

		$of_options[] = array( "name"	=> __( 'Tracking', 'gents' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Header Tracking Code', 'gents' ),
			"desc"	=> __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme.', 'gents' ),
			"id"	=> "tracking_header",
			"std"	=> "",
			"type"	=> "textarea");    

		$of_options[] = array( "name"	=> __( 'Footer Tracking Code', 'gents' ),
			"desc"	=> __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'gents' ),
			"id"	=> "tracking_footer",
			"std"	=> "",
			"type"	=> "textarea");

		//Custom CSS
		$of_options[] = array( "name"	=> __( 'Custom CSS', 'gents' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Custom CSS', 'gents' ),
			"desc"	=> __( 'Quickly add some CSS to your theme by adding it to this block.', 'gents' ),
			"id"	=> "custom_css_box",
			"std"	=> "",
			"type"	=> "textarea"); 

	// Backup Options
		$of_options[] = array( 	"name" 		=> "Backup Options",
			"type" 		=> "heading",
			);

		$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
			"id" 		=> "of_backup",
			"std" 		=> "",
			"type" 		=> "backup",
			"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
			);

		$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
			"id" 		=> "of_transfer",
			"std" 		=> "",
			"type" 		=> "transfer",
			"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
			);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
