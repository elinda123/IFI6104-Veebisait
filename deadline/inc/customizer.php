<?php
/**
 * Deadline Theme Customizer.
 *
 * @package Deadline
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Deadline 1.0
 *
 * @see deadline_header_style()
 */
function deadline_custom_header_and_background() {
	$color_scheme             = deadline_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[4], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Deadline.
	 *
	 * @since Deadline 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'deadline_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

}
add_action( 'after_setup_theme', 'deadline_custom_header_and_background' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function deadline_customize_register( $wp_customize ) {

	$color_scheme = deadline_get_color_scheme();
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'color_scheme', array(
			'default'           => 'default',
			'sanitize_callback' => 'deadline_sanitize_color_scheme',
		) );
	
		$wp_customize->add_control( 'color_scheme', array(
			'label'    => __( 'Base Color Scheme', 'deadline' ),
			'section'  => 'colors',
			'type'     => 'select',
			'choices'  => deadline_get_color_scheme_choices(),
			'priority' => 1,
		) );
	
		// Add page background color setting and control.
		$wp_customize->add_setting( 'page_background_color', array(
			'default'           => $color_scheme[1],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
			'label'       => __( 'Page Background Color', 'deadline' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'header_background_color', array(
			'default'           => $color_scheme[2],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'       => __( 'Header Background Color', 'deadline' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_background_color', array(
			'default'           => $color_scheme[7],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
			'label'       => __( 'Footer Background Color', 'deadline' ),
			'section'     => 'colors',
		) ) );
	
		// Remove the core header textcolor control, as it shares the main text color.
		$wp_customize->remove_control( 'header_textcolor' );
	
		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color', array(
			'default'           => $color_scheme[3],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'       => __( 'Link Color', 'deadline' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color_hover', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hover', array(
			'label'       => __( 'Link Color :hover', 'deadline' ),
			'section'     => 'colors',
		) ) );
	
		// Add main text color setting and control.
		$wp_customize->add_setting( 'main_text_color', array(
			'default'           => $color_scheme[5],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
			'label'       => __( 'Main Text Color', 'deadline' ),
			'section'     => 'colors',
		) ) );
	
		// Add secondary text color setting and control.
		$wp_customize->add_setting( 'secondary_text_color', array(
			'default'           => $color_scheme[6],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
			'label'       => __( 'Secondary Text Color', 'deadline' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'main_menu_background_color', array(
			'default'           => $color_scheme[8],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_background_color', array(
			'label'       => __( 'Main Menu Background Color', 'deadline' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'highlight_background_color', array(
			'default'           => $color_scheme[9],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_background_color', array(
			'label'       => __( 'Highlight Background Color', 'deadline' ),
			'section'     => 'colors',
		) ) );

	$wp_customize->add_panel( 'deadline_panel', array(
		'priority'       => 130,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'deadline' ),
		'description'    => esc_html__( 'Deadline Theme Options', 'deadline' ),
	) );

	$wp_customize->add_section( 'deadline_front_page', array(
		'title'		  => esc_html__( 'Front Page', 'deadline' ),
		'panel'		  => 'deadline_panel',
	) );

		// Featured Posts checkbox
		$wp_customize->add_setting( 'deadline_front_featured_posts', array(
			'default'           => 1,
			'sanitize_callback' => 'deadline_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'deadline_front_featured_posts', array(
			'label'             => esc_html__( 'Show Featured Posts Section on the Front Page', 'deadline' ),
			'section'           => 'deadline_front_page',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'deadline_front_featured_posts_date', array(
			'default'           => 0,
			'sanitize_callback' => 'deadline_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'deadline_front_featured_posts_date', array(
			'label'             => esc_html__( 'Show the post dates for the Featured Posts', 'deadline' ),
			'section'           => 'deadline_front_page',
			'type'              => 'checkbox',
		) );

		// Featured Posts Options
		$wp_customize->add_setting( 'deadline_featured_term_1', array(
			'default'           => 'featured',
			'sanitize_callback' => 'deadline_sanitize_terms',
		) );

		$wp_customize->add_control( 'deadline_featured_term_1', array(
			'label'             => esc_html__( 'Front Page: Featured Tag', 'deadline' ),
			'description'		=> sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Post Tags</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=post_tag' ) ) ),
			'section'           => 'deadline_front_page',
			'type'              => 'select',
			'choices' 			=> deadline_get_terms(),
		) );

		// Featured Categories checkbox
		$wp_customize->add_setting( 'deadline_front_featured_categories', array(
			'default'           => 0,
			'sanitize_callback' => 'deadline_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'deadline_front_featured_categories', array(
			'label'             => esc_html__( 'Show Featured Categories Section on the Front Page', 'deadline' ),
			'section'           => 'deadline_front_page',
			'type'              => 'checkbox',
		) );
		
		$wp_customize->add_setting( 'deadline_front_featured_categories_date', array(
			'default'           => 0,
			'sanitize_callback' => 'deadline_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'deadline_front_featured_categories_date', array(
			'label'             => esc_html__( 'Show the post dates for the Featured Categories', 'deadline' ),
			'section'           => 'deadline_front_page',
			'type'              => 'checkbox',
		) );

		// Featured Categories
		$wp_customize->add_setting( 'deadline_featured_category_1', array(
			'default'           => 'none',
			'sanitize_callback' => 'deadline_sanitize_categories',
		) );

		$wp_customize->add_control( 'deadline_featured_category_1', array(
			'label'             => esc_html__( 'Front Page: Featured Category #1', 'deadline' ),
			'description'		=> sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'deadline_front_page',
			'type'              => 'select',
			'choices' 			=> deadline_get_categories(),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_color_1', array(
			'default'           => 'black',
			'sanitize_callback' => 'deadline_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'deadline_featured_category_color_1', array(
		'label'       => esc_html__( 'Featured Category #1 Color Style', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'deadline' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'deadline' ),
			'blue' => esc_html__( 'Blue', 'deadline' ),
			'green' => esc_html__( 'Green', 'deadline' ),
			'red' => esc_html__( 'Red', 'deadline' ),
			'yellow'   => esc_html__( 'Yellow', 'deadline' ),
		),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_layout_1', array(
			'default'           => 'default',
			'sanitize_callback' => 'deadline_sanitize_widget_layout'
		) );

		$wp_customize->add_control( 'deadline_featured_category_layout_1', array(
		'label'       => esc_html__( 'Featured Category #1 Layout', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the layout for the category.', 'deadline' ),
		'choices'     => array(
			'default' => esc_html__( 'Default', 'deadline' ),
			'reverted' => esc_html__( 'Reverted', 'deadline' )
		),
		) );
		
		$wp_customize->add_setting( 'deadline_featured_category_2', array(
			'default'           => 'none',
			'sanitize_callback' => 'deadline_sanitize_categories',
		) );

		$wp_customize->add_control( 'deadline_featured_category_2', array(
			'label'             => esc_html__( 'Front Page: Featured Category #2', 'deadline' ),
			'description'		=> sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'deadline_front_page',
			'type'              => 'select',
			'choices' 			=> deadline_get_categories(),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_color_2', array(
			'default'           => 'black',
			'sanitize_callback' => 'deadline_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'deadline_featured_category_color_2', array(
		'label'       => esc_html__( 'Featured Category #2 Color Style', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'deadline' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'deadline' ),
			'blue' => esc_html__( 'Blue', 'deadline' ),
			'green' => esc_html__( 'Green', 'deadline' ),
			'red' => esc_html__( 'Red', 'deadline' ),
			'yellow'   => esc_html__( 'Yellow', 'deadline' ),
		),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_layout_2', array(
			'default'           => 'default',
			'sanitize_callback' => 'deadline_sanitize_widget_layout'
		) );

		$wp_customize->add_control( 'deadline_featured_category_layout_2', array(
		'label'       => esc_html__( 'Featured Category #2 Layout', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the layout for the category.', 'deadline' ),
		'choices'     => array(
			'default' => esc_html__( 'Default', 'deadline' ),
			'reverted' => esc_html__( 'Reverted', 'deadline' )
		),
		) );
		
		$wp_customize->add_setting( 'deadline_featured_category_3', array(
			'default'           => 'none',
			'sanitize_callback' => 'deadline_sanitize_categories',
		) );

		$wp_customize->add_control( 'deadline_featured_category_3', array(
			'label'             => esc_html__( 'Front Page: Featured Category #3', 'deadline' ),
			'description'		=> sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'deadline_front_page',
			'type'              => 'select',
			'choices' 			=> deadline_get_categories(),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_color_3', array(
			'default'           => 'black',
			'sanitize_callback' => 'deadline_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'deadline_featured_category_color_3', array(
		'label'       => esc_html__( 'Featured Category #3 Color Style', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'deadline' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'deadline' ),
			'blue' => esc_html__( 'Blue', 'deadline' ),
			'green' => esc_html__( 'Green', 'deadline' ),
			'red' => esc_html__( 'Red', 'deadline' ),
			'yellow'   => esc_html__( 'Yellow', 'deadline' ),
		),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_layout_3', array(
			'default'           => 'default',
			'sanitize_callback' => 'deadline_sanitize_widget_layout'
		) );

		$wp_customize->add_control( 'deadline_featured_category_layout_3', array(
		'label'       => esc_html__( 'Featured Category #3 Layout', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the layout for the category.', 'deadline' ),
		'choices'     => array(
			'default' => esc_html__( 'Default', 'deadline' ),
			'reverted' => esc_html__( 'Reverted', 'deadline' )
		),
		) );
		
		$wp_customize->add_setting( 'deadline_featured_category_4', array(
			'default'           => 'none',
			'sanitize_callback' => 'deadline_sanitize_categories',
		) );

		$wp_customize->add_control( 'deadline_featured_category_4', array(
			'label'             => esc_html__( 'Front Page: Featured Category #4', 'deadline' ),
			'description'		=> sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'deadline_front_page',
			'type'              => 'select',
			'choices' 			=> deadline_get_categories(),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_color_4', array(
			'default'           => 'black',
			'sanitize_callback' => 'deadline_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'deadline_featured_category_color_4', array(
		'label'       => esc_html__( 'Featured Category #4 Color Style', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'deadline' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'deadline' ),
			'blue' => esc_html__( 'Blue', 'deadline' ),
			'green' => esc_html__( 'Green', 'deadline' ),
			'red' => esc_html__( 'Red', 'deadline' ),
			'yellow'   => esc_html__( 'Yellow', 'deadline' ),
		),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_layout_4', array(
			'default'           => 'default',
			'sanitize_callback' => 'deadline_sanitize_widget_layout'
		) );

		$wp_customize->add_control( 'deadline_featured_category_layout_4', array(
		'label'       => esc_html__( 'Featured Category #4 Layout', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the layout for the category.', 'deadline' ),
		'choices'     => array(
			'default' => esc_html__( 'Default', 'deadline' ),
			'reverted' => esc_html__( 'Reverted', 'deadline' )
		),
		) );
		
		$wp_customize->add_setting( 'deadline_featured_category_5', array(
			'default'           => 'none',
			'sanitize_callback' => 'deadline_sanitize_categories',
		) );

		$wp_customize->add_control( 'deadline_featured_category_5', array(
			'label'             => esc_html__( 'Front Page: Featured Category #5', 'deadline' ),
			'description'		=> sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'deadline' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'deadline_front_page',
			'type'              => 'select',
			'choices' 			=> deadline_get_categories(),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_color_5', array(
			'default'           => 'black',
			'sanitize_callback' => 'deadline_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'deadline_featured_category_color_5', array(
		'label'       => esc_html__( 'Featured Category #5 Color Style', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'deadline' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'deadline' ),
			'blue' => esc_html__( 'Blue', 'deadline' ),
			'green' => esc_html__( 'Green', 'deadline' ),
			'red' => esc_html__( 'Red', 'deadline' ),
			'yellow'   => esc_html__( 'Yellow', 'deadline' ),
		),
		) );

		$wp_customize->add_setting( 'deadline_featured_category_layout_5', array(
			'default'           => 'default',
			'sanitize_callback' => 'deadline_sanitize_widget_layout'
		) );

		$wp_customize->add_control( 'deadline_featured_category_layout_5', array(
		'label'       => esc_html__( 'Featured Category #5 Layout', 'deadline' ),
		'section'     => 'deadline_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the layout for the category.', 'deadline' ),
		'choices'     => array(
			'default' => esc_html__( 'Default', 'deadline' ),
			'reverted' => esc_html__( 'Reverted', 'deadline' )
		),
		) );

	$wp_customize->add_section( 'deadline_footer_settings', array(
		'title'	=> esc_html__( 'Footer', 'deadline' ),
		'panel'	=> 'deadline_panel',
	) );

		// Display site title in the footer checkbox.
		$wp_customize->add_setting( 'deadline_footer_branding', array(
			'default'           => '0',
			'sanitize_callback' => 'deadline_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'deadline_footer_branding', array(
			'label'             => esc_html__( 'Show uploaded logo in the footer.', 'deadline' ),
			'section'           => 'deadline_footer_settings',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting('deadline_footer_logo', array(
			'transport'			=> 'refresh',
			'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
			'deadline_footer_logo',
			array(
				'label'		=> __( 'Footer Logo Image', 'deadline' ),
				'section'	=> 'deadline_footer_settings',
			)
		) );

	return $wp_customize;

}
add_action( 'customize_register', 'deadline_customize_register' );


if ( ! function_exists( 'deadline_get_terms' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function deadline_get_terms() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'deadline' ) );

	// Post Tags
	$type_terms = get_terms( 'post_tag' );
	if ( ! empty( $type_terms ) ) {
		$type_slugs = wp_list_pluck( $type_terms, 'slug' );
		$type_names = wp_list_pluck( $type_terms, 'name' );
		$type_list = array_combine( $type_slugs, $type_names );
		$choices = array_merge(
			$choices,
			$type_list
		);
	}

	return apply_filters( 'deadline_get_terms', $choices );
}
endif;

if ( ! function_exists( 'deadline_sanitize_terms' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function deadline_sanitize_terms( $value ) {

	$choices = deadline_get_terms();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'deadline_get_categories' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function deadline_get_categories() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'deadline' ) );

	// Categories
	$type_terms = get_terms( 'category' );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'name', 'term_id' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'deadline_get_categories', $choices );
}
endif;

if ( ! function_exists( 'deadline_sanitize_categories' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function deadline_sanitize_categories( $value ) {

	$choices = deadline_get_categories();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'deadline_sanitize_checkbox' ) ) :
/**
 * Sanitize the checkbox.
 *
 * @param  mixed 	$input.
 * @return boolean	(true|false).
 */
function deadline_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
endif;

if ( ! function_exists( 'deadline_sanitize_widget_style' ) ) :
/**
 * Sanitize the Featured Category color style.
 *
 * @param  boolean	$input.
 * @return boolean	(true|false).
 */
function deadline_sanitize_widget_style( $input ) {
	$choices = array( 'black', 'blue', 'green', 'red', 'yellow' );

	if ( ! in_array( $input, $choices ) ) {
		$input = 'black';
	}

	return $input;
}
endif;

if ( ! function_exists( 'deadline_sanitize_widget_layout' ) ) :
/**
 * Sanitize the Featured Category layout.
 *
 * @param  boolean	$input.
 * @return boolean	(true|false).
 */
function deadline_sanitize_widget_layout( $input ) {
	$choices = array( 'default', 'reverted' );

	if ( ! in_array( $input, $choices ) ) {
		$input = 'default';
	}

	return $input;
}
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function deadline_customize_preview_js() {
	wp_enqueue_script( 'deadline_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160513', true );
}
add_action( 'customize_preview_init', 'deadline_customize_preview_js' );

/**
 * Registers color schemes for Deadline.
 *
 * Can be filtered with {@see 'deadline_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Deadline 1.0
 *
 * @return array An associative array of color scheme options.
 */
function deadline_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Deadline.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Deadline 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	 
	return apply_filters( 'deadline_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'deadline' ),
			'colors' => array(
				'#ececec', // [0] background color 
				'#ffffff', // [1] content container background color
				'#151313', // [2] header background color 
				'#007ac9', // [3] link color
				'#e95445', // [4] link :hover color
				'#393939', // [5] main text color
				'#888888', // [6] secondary text color
				'#1a1a1a', // [7] footer background color
				'#f4ce21', // [8] main menu background color
				'#f4ce21', // [9] highlight background color
			),
		),
	) );
}

if ( ! function_exists( 'deadline_get_color_scheme' ) ) :
/**
 * Retrieves the current Deadline color scheme.
 *
 * Create your own deadline_get_color_scheme() function to override in a child theme.
 *
 * @since Deadline 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function deadline_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = deadline_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // deadline_get_color_scheme

if ( ! function_exists( 'deadline_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Deadline.
 *
 * Create your own deadline_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since Deadline 1.0
 *
 * @return array Array of color schemes.
 */
function deadline_get_color_scheme_choices() {
	$color_schemes                = deadline_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // deadline_get_color_scheme_choices


if ( ! function_exists( 'deadline_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for Deadline color schemes.
 *
 * Create your own deadline_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since Deadline 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function deadline_sanitize_color_scheme( $value ) {
	$color_schemes = deadline_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // deadline_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = deadline_get_color_scheme();

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'        		 => $color_scheme[0],
		'page_background_color'  		 => $color_scheme[1],
		'header_background_color' 		 => $color_scheme[2],
		'link_color'             		 => $color_scheme[3],
		'link_color_hover'        		 => $color_scheme[4],
		'main_text_color'         		 => $color_scheme[5],
		'secondary_text_color'    		 => $color_scheme[6],
		'footer_background_color' 		 => $color_scheme[7],
		'main_menu_background_color' 	 => $color_scheme[8],
		'highlight_background_color' 	 => $color_scheme[9],

	);

	$color_scheme_css = deadline_get_color_scheme_css( $colors );

	wp_add_inline_style( 'deadline-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'deadline_color_scheme_css' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Deadline 1.0
 */
function deadline_customize_control_js() {
	wp_enqueue_script( 'deadline-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160412', true );
	wp_localize_script( 'deadline-color-scheme-control', 'deadline_colorScheme', deadline_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'deadline_customize_control_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Deadline 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function deadline_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'        		=> '',
		'page_background_color'   		=> '',
		'header_background_color' 		=> '',
		'link_color'              		=> '',
		'link_color_hover'        		=> '',
		'main_text_color'         		=> '',
		'secondary_text_color'    		=> '',
		'footer_background_color' 		=> '',
		'main_menu_background_color' 	=> '',
		'highlight_background_color' 	=> '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Page Background Color */
	.site-content-wrapper {
		background-color: {$colors['page_background_color']};
	}

	/* Header Background Color */
	.site-header {
		background-color: {$colors['header_background_color']};
	}

	/* Footer Background Color */
	.site-footer {
		background-color: {$colors['footer_background_color']};
	}

	/* Link Color */
	a {
		color: {$colors['link_color']};
	}

	/* Link:hover Color */
	a:hover,
	a:focus {
		color: {$colors['link_color_hover']};
	}

	/* Main Text Color */
	body {
		color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */

	.post-meta,
	.ilovewp-post .post-meta {
		color: {$colors['secondary_text_color']};
	}

	/* Menu Background Color */
	#menu-main {
		background-color: {$colors['menu_main_background_color']};
	}

	/* Highlight Background Color */
	.post-meta-category a,
	.infinite-scroll #infinite-handle span,
	.post-cover:after {
		background-color: {$colors['highlight_background_color']};
	}

	.post-meta-category a:hover,
	.post-meta-category a:focus,
	.infinite-scroll #infinite-handle span:hover,
	.infinite-scroll #infinite-handle span:focus {
		color: {$colors['highlight_background_color']};
	}

CSS;
}


/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_page_background_color_css() {
	$color_scheme          = deadline_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = esc_attr( get_theme_mod( 'page_background_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.site-content-wrapper {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_header_background_color_css() {
	$color_scheme          = deadline_get_color_scheme();
	$default_color         = $color_scheme[1];
	$header_background_color = esc_attr( get_theme_mod( 'header_background_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $header_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Header Background Color */
		.site-header {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $header_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_header_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the footer background color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_footer_background_color_css() {
	$color_scheme          = deadline_get_color_scheme();
	$default_color         = $color_scheme[1];
	$footer_background_color = esc_attr( get_theme_mod( 'footer_background_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $footer_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Background Color */
		.site-footer {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $footer_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_footer_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Main Menu background color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_main_menu_background_color_css() {
	$color_scheme          = deadline_get_color_scheme();
	$default_color         = $color_scheme[8];
	$menu_background_color = esc_attr( get_theme_mod( 'main_menu_background_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $menu_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Menu Background Color */
		#menu-main {
			background-color: %1$s;
		}

		.site-header .wrapper-header a:hover,
		.site-header .wrapper-header a:focus,
		.site-footer a:hover,
		.site-footer a:focus {
			color: %1$s;
		}

	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $menu_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_main_menu_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Highlights background color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_highlight_background_color_css() {
	$color_scheme          = deadline_get_color_scheme();
	$default_color         = $color_scheme[9];
	$highlight_background_color = esc_attr( get_theme_mod( 'highlight_background_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $highlight_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Highlight Background Color */
		.post-meta-category a,
		.infinite-scroll #infinite-handle span,
		.post-cover:after {
			background-color: %1$s;
		}
		
		#ilovewp-featured-posts .featured-post-main .title-post a:hover,
		#ilovewp-featured-posts .featured-post-main .title-post a:focus,
		#ilovewp-featured-posts .featured-post-main .post-meta a:hover,
		#ilovewp-featured-posts .featured-post-main .post-meta a:focus,
		.post-meta-category a:hover,
		.post-meta-category a:focus,
		.infinite-scroll #infinite-handle span:hover,
		.infinite-scroll #infinite-handle span:focus {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $highlight_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_highlight_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_link_color_css() {
	$color_scheme    = deadline_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = esc_attr( get_theme_mod( 'link_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		a {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the link :hover color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_link_color_hover_css() {
	$color_scheme    = deadline_get_color_scheme();
	$default_color   = $color_scheme[3];
	$link_color = esc_attr( get_theme_mod( 'link_color_hover', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link:hover Color */
		a:hover,
		a:focus,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		h1 a:focus, h2 a:focus, h3 a:focus, h4 a:focus, h5 a:focus, h6 a:focus {
			color: %1$s;
		}

		.ilovewp-featured-category .ilovewp-post-simple .title-post:hover:after {
			background-color: %1$s;
		}

	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_link_color_hover_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_main_text_color_css() {
	$color_scheme    = deadline_get_color_scheme();
	$default_color   = $color_scheme[4];
	$main_text_color = esc_attr( get_theme_mod( 'main_text_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Text Color */
		body {
			color: %1$s
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $main_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Deadline 1.0
 *
 * @see wp_add_inline_style()
 */
function deadline_secondary_text_color_css() {
	$color_scheme    = deadline_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = esc_attr( get_theme_mod( 'secondary_text_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		.post-meta,
		.ilovewp-post .post-meta {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'deadline-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'deadline_secondary_text_color_css', 11 );