<?php
/**
 * @package Serene
 * @since Serene 1.0
 */

if ( ! isset( $content_width ) ) $content_width = 960;

if ( ! function_exists( 'et_setup_serene_theme' ) ){
	function et_setup_serene_theme(){
		$template_directory = get_template_directory();

		load_theme_textdomain( 'Serene', $template_directory . '/languages' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array(
			'video', 'audio', 'quote', 'gallery', 'link'
		) );

		add_theme_support( 'custom-background', array(
			'default-color' => '#F1F1F1',
		) );

		add_theme_support( 'infinite-scroll', array(
			'container' => 'main-content',
		) );

		add_image_size( 'serene-featured-image', 1280, 540, true );

		register_nav_menus(
			array(
				'primary-menu' => __( 'Primary Menu', 'Serene' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'et_setup_serene_theme' );

function et_widget_areas_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Area #1', 'Serene' ),
		'id'            => 'footer-area-1',
		'before_widget' => '<div id="%1$s" class="f_widget %2$s">',
		'after_widget'  => '</div> <!--.f_widget -->',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area #2', 'Serene' ),
		'id'            => 'footer-area-2',
		'before_widget' => '<div id="%1$s" class="f_widget %2$s">',
		'after_widget'  => '</div> <!--.f_widget -->',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area #3', 'Serene' ),
		'id'            => 'footer-area-3',
		'before_widget' => '<div id="%1$s" class="f_widget %2$s">',
		'after_widget'  => '</div> <!--.f_widget -->',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'et_widget_areas_init' );

function serene_custom_excerpt_length( $length ) {
	return 90;
}
add_filter( 'excerpt_length', 'serene_custom_excerpt_length', 999 );

function serene_excerpt_more( $more ) {
	return sprintf( '...<a class="read-more" href="%s">%s</a>',
		get_permalink( get_the_ID() ),
		esc_html__( 'read more', 'Serene' )
	);
}
add_filter( 'excerpt_more', 'serene_excerpt_more' );

if ( ! function_exists( 'et_serene_fonts_url' ) ) :
function et_serene_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Raleway, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$raleway = _x( 'on', 'Raleway font: on or off', 'Serene' );

	if ( 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:400,200,100,500,700,800,900';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext',
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
endif;

function et_load_serene_scripts() {
	$template_dir = get_template_directory_uri();

	$theme_version = et_get_theme_version();

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'serene-superfish', $template_dir . '/js/superfish.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'serene-fitvids', $template_dir . '/js/jquery.fitvids.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'serene-flexslider', $template_dir . '/js/jquery.flexslider.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'serene-custom-script', $template_dir . '/js/custom.js', array( 'jquery' ), $theme_version, true );

	wp_enqueue_style( 'serene-elegant-font', $template_dir . '/css/elegant-font.css' );

	/*
	 * Loads the main stylesheet.
	 */
	wp_enqueue_style( 'serene-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'et_load_serene_scripts' );

if ( ! function_exists( 'et_get_theme_version' ) ) :
function et_get_theme_version() {
	$theme_info = wp_get_theme();

	if ( is_child_theme() ) {
		$theme_info = wp_get_theme( $theme_info->parent_theme );
	}

	$theme_version = $theme_info->display( 'Version' );

	return $theme_version;
}
endif;

function et_serene_load_fonts() {
	$fonts_url = et_serene_fonts_url();
	if ( ! empty( $fonts_url ) )
		wp_enqueue_style( 'serene-fonts', esc_url_raw( $fonts_url ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'et_serene_load_fonts' );

function et_add_viewport_meta() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />';
}
add_action( 'wp_head', 'et_add_viewport_meta' );

function et_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'Serene' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'et_wp_title', 10, 2 );

if ( ! function_exists( 'et_get_the_author_posts_link' ) ) :
function et_get_the_author_posts_link() {
	global $authordata;

	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
		esc_attr( sprintf( __( 'Posts by %s', 'Serene' ), get_the_author() ) ),
		get_the_author()
	);
	return apply_filters( 'the_author_posts_link', $link );
}
endif;

if ( ! function_exists( 'et_get_comments_popup_link' ) ) :
function et_get_comments_popup_link( $zero = false, $one = false, $more = false ) {
	$id = get_the_ID();
	$number = get_comments_number( $id );

	if ( 0 == $number && ! comments_open() && ! pings_open() ) return;

	if ( $number > 1 )
		$output = str_replace( '%', number_format_i18n( $number ), ( false === $more ) ? __( '% Comments', 'Serene' ) : $more );
	elseif ( $number == 0 )
		$output = ( false === $zero ) ? __( 'No Comments', 'Serene' ) : $zero;
	else // must be one
		$output = ( false === $one ) ? __( '1 Comment', 'Serene' ) : $one;

	return '<span class="comments-number">' . '<a href="' . esc_url( get_permalink() . '#respond' ) . '">' . apply_filters('comments_number', $output, $number) . '</a>' . '</span>';
}
endif;

if ( ! function_exists( 'et_postinfo_meta' ) ) :
function et_postinfo_meta() {
	echo '<p class="meta-info">';

	// Translators: 1 is author, 2 is category list.
	printf( __( 'Posted by %1$s in %2$s', 'Serene' ),
		et_get_the_author_posts_link(),
		get_the_category_list(', ')
	);

	echo '</p> <!-- .meta-info -->';
}
endif;

if ( ! function_exists( 'et_custom_comments_display' ) ) :
function et_custom_comments_display( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
			<div class="comment_avatar">
				<?php echo get_avatar( $comment, $size = '75' ); ?>
			</div> <!-- end .comment_avatar -->

			<div class="comment_postinfo">
				<?php printf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
				<span class="comment_date">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'Serene' ), get_comment_date(), get_comment_time() );
					?>
				</span>
				<?php edit_comment_link( esc_html__( '(Edit)', 'Serene' ), ' ' ); ?>
			</div> <!-- end .comment_postinfo -->

			<div class="comment_area">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'Serene' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-content clearfix">
					<?php comment_text(); ?>

					<?php
						$et_comment_reply_link = get_comment_reply_link( array_merge( $args, array(
							'reply_text' => esc_attr__( 'Reply', 'Serene' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) );
						if ( $et_comment_reply_link )
							echo '<div class="reply-container">' . $et_comment_reply_link . '</div>';
					?>
				</div> <!-- end comment-content-->
			</div> <!-- end comment_area-->
		</article> <!-- end comment-body -->
<?php }
endif;

function et_add_mobile_navigation(){
	echo '<div id="et_mobile_nav_menu">' . '<a href="#" class="mobile_nav closed">' . '<span>' . esc_html__( 'Navigation Menu', 'Serene' ) . '</span>' . '<span class="icon_menu mobile_menu_bar"></span>' . '</a>' . '</div>';
}
add_action( 'et_header_top', 'et_add_mobile_navigation' );

function et_serene_customize_register( $wp_customize ) {
	$tags_options = array();
	$tags = get_tags();

	if ( $tags ) {
		foreach ( $tags as $tag ) {
			$tags_options[$tag->term_id] = $tag->name;
		}
	}

	$wp_customize->add_section( 'et_theme_settings' , array(
		'title'    => __( 'Theme Settings', 'Serene' ),
		'priority' => 60,
	) );

	$wp_customize->add_setting( 'accent_color', array(
		'default'    => '#fbad18',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'		=> __( 'Accent Color', 'Serene' ),
		'section'	=> 'et_theme_settings',
		'settings'	=> 'accent_color',
	) ) );

	$wp_customize->add_setting( 'facebook_url', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'facebook_url', array(
		'label'	  => __( 'Facebook Profile URL', 'Serene' ),
		'section' => 'et_theme_settings',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'twitter_url', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'twitter_url', array(
		'label'	  => __( 'Twitter Profile URL', 'Serene' ),
		'section' => 'et_theme_settings',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'google_url', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'google_url', array(
		'label'	  => __( 'Google+ Profile URL', 'Serene' ),
		'section' => 'et_theme_settings',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'show_content', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'show_content', array(
		'label'	  => __( 'Display full content of posts on index pages', 'Serene' ),
		'section' => 'et_theme_settings',
		'type'    => 'checkbox',
	) );
}
add_action( 'customize_register', 'et_serene_customize_register' );

function serene_customize_preview_js() {
	wp_enqueue_script( 'serene-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'serene_customize_preview_js' );

function serene_add_customizer_css(){ ?>
	<style>
		.meta-post-date, .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-handle, .footer-widget li:before, #mobile_menu ul li:before, #et_active_menu_item, .comment-reply-link, .form-submit input, .et-tags li { background-color: <?php echo esc_html( get_theme_mod( 'accent_color', '#fbad18' ) ); ?>; }
		.post-content > header p, .mobile_menu_bar { color: <?php echo esc_html( get_theme_mod( 'accent_color', '#fbad18' ) ); ?>; }
		blockquote { border-color: <?php echo esc_html( get_theme_mod( 'accent_color', '#fbad18' ) ); ?>; }
	</style>
<?php }
add_action( 'wp_head', 'serene_add_customizer_css' );
add_action( 'customize_controls_print_styles', 'serene_add_customizer_css' );

if ( ! function_exists( 'serene_gallery_images' ) ) :
function serene_gallery_images() {
	$output = $images_ids = '';

	if ( function_exists( 'get_post_galleries' ) ) {
		$galleries = get_post_galleries( get_the_ID(), false );

		if ( empty( $galleries ) ) return false;

		if ( isset( $galleries[0]['ids'] ) ) {
			foreach ( $galleries as $gallery ) {
				// Grabs all attachments ids from one or multiple galleries in the post
				$images_ids .= ( '' !== $images_ids ? ',' : '' ) . $gallery['ids'];
			}

			$attachments_ids = explode( ',', $images_ids );
			// Removes duplicate attachments ids
			$attachments_ids = array_unique( $attachments_ids );
		} else {
			$attachments_ids = get_posts( array(
				'fields'         => 'ids',
				'numberposts'    => 999,
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
				'post_mime_type' => 'image',
				'post_parent'    => get_the_ID(),
				'post_type'      => 'attachment',
			) );
		}
	} else {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", get_the_content(), $match );
		$atts = shortcode_parse_atts( $match[3] );

		if ( isset( $atts['ids'] ) )
			$attachments_ids = explode( ',', $atts['ids'] );
		else
			return false;
	}

	echo '<div class="et-gallery-slider flexslider">';
	echo '	<ul class="et-gallery-slides">';
	foreach ( $attachments_ids as $attachment_id ) {
		printf( '<li class="et-gallery-slide"><a href="%s">%s</a></li>',
			esc_url( get_permalink() ),
			wp_get_attachment_image( $attachment_id, 'serene-featured-image' )
		);
	}
	echo '	</ul> <!-- .et-gallery-slides -->';
	echo '</div> <!-- .et-gallery-slider -->';

	return $output;
}
endif;

if ( ! function_exists( 'serene_get_link_url' ) ) :
function serene_get_link_url() {
	if ( '' !== ( $link_url = get_post_meta( get_the_ID(), '_format_link_url', true ) ) )
		return $link_url;

	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

/**
 * Extract and return the first blockquote from content.
 */
if ( ! function_exists( 'serene_get_blockquote_in_content' ) ) :
function serene_get_blockquote_in_content() {
	remove_filter( 'the_content', 'serene_remove_blockquote_from_content' );

	$content = apply_filters( 'the_content', get_the_content() );

	add_filter( 'the_content', 'serene_remove_blockquote_from_content' );

	if ( preg_match( '/<blockquote>(.+?)<\/blockquote>/is', $content, $matches ) )
		return $matches[0];
	else
		return false;
}
endif;

function serene_remove_blockquote_from_content( $content ) {
	if ( 'quote' !== get_post_format() )
		return $content;

	$content = preg_replace( '/<blockquote>(.+?)<\/blockquote>/is', '', $content, 1 );

	return $content;
}
add_filter( 'the_content', 'serene_remove_blockquote_from_content' );

function serene_video_embed_html( $video ) {
	return "<div class='et_post_video'>{$video}</div>";
}
add_filter( 'embed_oembed_html', 'serene_video_embed_html' );

if ( ! function_exists( 'et_get_first_video' ) ) :
function et_get_first_video() {
	$first_oembed  = '';
	$custom_fields = get_post_custom();

	foreach ( $custom_fields as $key => $custom_field ) {
		if ( 0 !== strpos( $key, '_oembed_' ) ) continue;

		$first_oembed = $custom_field[0];

		$video_width  = (int) apply_filters( 'serene_video_width', 1280 );
		$video_height = (int) apply_filters( 'serene_video_height', 540 );

		$first_oembed = preg_replace( '/<embed /', '<embed wmode="transparent" ', $first_oembed );
		$first_oembed = preg_replace( '/<\/object>/','<param name="wmode" value="transparent" /></object>', $first_oembed );

		$first_oembed = preg_replace( "/width=\"[0-9]*\"/", "width={$video_width}", $first_oembed );
		$first_oembed = preg_replace( "/height=\"[0-9]*\"/", "height={$video_height}", $first_oembed );

		break;
	}

	return ( '' !== $first_oembed ) ? $first_oembed : false;
}
endif;

function serene_add_post_meta_box() {
	add_meta_box( 'et_settings_meta_box', __( 'Post Settings', 'Serene' ), 'serene_single_settings_meta_box', 'post', 'normal', 'high' );
	add_meta_box( 'et_settings_meta_box', __( 'Page Settings', 'Serene' ), 'serene_single_settings_meta_box', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'serene_add_post_meta_box' );

if ( ! function_exists( 'serene_single_settings_meta_box' ) ) :
function serene_single_settings_meta_box( $post ) {
	$post_id = get_the_ID();
	$layouts = array(
		'dark'  => __( 'Dark', 'Serene' ),
		'light' => __( 'Light', 'Serene' ),
	);
	$post_bg_color = '' !== ( $bg_color = get_post_meta( $post_id, '_et_post_bg_color', true ) )
		? $bg_color
		: '#ffffff';
	$post_bg_layout = '' !== ( $layout = get_post_meta( $post_id, '_et_post_bg_layout', true ) )
		? $layout
		: 'dark';

	wp_nonce_field( basename( __FILE__ ), 'et_settings_nonce' );

	if ( 'post' === $post->post_type ) : ?>
	<p class="et_link_settings et_post_format_setting" style="display: none;">
		<label for="et_post_link_url" style="display: block; font-weight: bold; margin-bottom: 5px;"><?php esc_html_e( 'URL', 'Serene' ); ?>: </label>
		<input id="et_post_link_url" name="et_post_link_url" class="regular-text" type="text" value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_format_link_url', true ) ); ?>" />
	</p>
	<p>
		<label for="et_post_bg_color" style="display: block; font-weight: bold; margin-bottom: 5px;"><?php esc_html_e( 'Background Color', 'Serene' ); ?>: </label>
		<input id="et_post_bg_color" name="et_post_bg_color" class="color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e( 'Hex Value', 'Serene' ); ?>" value="<?php echo esc_attr( $post_bg_color ); ?>" data-default-color="#ffffff" />
		<br/>
		<small><?php esc_html_e( 'Here you can set a background color for the post.', 'Serene' ); ?></small>
	</p>
	<p>
		<label for="et_post_bg_layout" style="font-weight: bold; margin-bottom: 5px;"><?php esc_html_e( 'Post Text Color', 'Serene' ); ?>: </label>
		<select id="et_post_bg_layout" name="et_post_bg_layout">
	<?php
		foreach ( $layouts as $layout_name => $layout_title )
			printf( '<option value="%s"%s>%s</option>',
				esc_attr( $layout_name ),
				selected( $layout_name, $post_bg_layout, false ),
				esc_html( $layout_title )
			);
	?>
		</select>
	</p>
	<?php else : ?>
	<p>
		<label for="et_page_subtitle" style="font-weight: bold; margin-bottom: 5px;"><?php esc_html_e( 'Page Subtitle', 'Serene' ); ?>: </label>
		<input id="et_page_subtitle" name="et_page_subtitle" type="text" class="regular-text" value="<?php echo esc_attr( get_post_meta( $post_id, '_et_page_subtitle', true ) ); ?>" />
	</p>
	<?php endif; ?>
<?php
}
endif;

function serene_metabox_settings_save_details( $post_id, $post ){
	global $pagenow;

	if ( 'post.php' != $pagenow ) return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	if ( ! isset( $_POST['et_settings_nonce'] ) || ! wp_verify_nonce( $_POST['et_settings_nonce'], basename( __FILE__ ) ) )
        return $post_id;

	if ( isset( $_POST['et_post_bg_color'] ) )
		update_post_meta( $post_id, '_et_post_bg_color', sanitize_text_field( $_POST['et_post_bg_color'] ) );
	else
		delete_post_meta( $post_id, '_et_post_bg_color' );

	if ( isset( $_POST['et_post_bg_layout'] ) )
		update_post_meta( $post_id, '_et_post_bg_layout', sanitize_text_field( $_POST['et_post_bg_layout'] ) );
	else
		delete_post_meta( $post_id, '_et_post_bg_layout' );

	if ( isset( $_POST['et_page_subtitle'] ) )
		update_post_meta( $post_id, '_et_page_subtitle', sanitize_text_field( $_POST['et_page_subtitle'] ) );
	else
		delete_post_meta( $post_id, '_et_page_subtitle' );

	if ( isset( $_POST['et_post_link_url'] ) )
		update_post_meta( $post_id, '_format_link_url', esc_url_raw( $_POST['et_post_link_url'] ) );
	else
		delete_post_meta( $post_id, '_format_link_url' );
}
add_action( 'save_post', 'serene_metabox_settings_save_details', 10, 2 );

function serene_post_admin_scripts_styles( $hook ) {
	global $typenow;

	if ( ! in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) return;

	if ( ! isset( $typenow ) && 'post' !== $typenow ) return;

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'et-admin-post-script', get_template_directory_uri() . '/js/admin_post_settings.js', array( 'jquery' ) );
}
add_action( 'admin_enqueue_scripts', 'serene_post_admin_scripts_styles' );

function serene_post_class( $post_class ) {
	$post_bg_color  = '' !== ( $bg_color = get_post_meta( get_the_ID(), '_et_post_bg_color', true ) )
		? $bg_color
		: '#ffffff';
	$post_bg_layout = '' !== ( $layout = get_post_meta( get_the_ID(), '_et_post_bg_layout', true ) )
		? $layout
		: 'dark';

	if ( '' == get_the_post_thumbnail() && 'gallery' !== get_post_format() )
		$post_class[] = 'et-no-image';

	$post_class[] = 'et-bg-layout-' . $post_bg_layout;

	if ( '#ffffff' === $post_bg_color )
		$post_class[] = 'et-white-bg';

	return $post_class;
}
add_filter( 'post_class', 'serene_post_class' );

if ( ! function_exists( 'serene_get_post_background' ) ) :
function serene_get_post_background() {
	$style = '';
	$post_bg_color = '' !== ( $bg_color = get_post_meta( get_the_ID(), '_et_post_bg_color', true ) )
		? $bg_color
		: '#ffffff';

	if ( '#ffffff' !== $post_bg_color )
		$style = sprintf( ' style="background-color: %s;"',
			esc_attr( $post_bg_color )
		);

	return $style;
}
endif;

/**
 * Removes galleries on single gallery posts, since we display images from all
 * galleries on top of the page
 */
function serene_delete_post_gallery( $content ) {
	if ( is_single() && is_main_query() && has_post_format( 'gallery' ) ) :
		$regex = get_shortcode_regex();
		preg_match_all( "/{$regex}/s", $content, $matches );

		// $matches[2] holds an array of shortcodes names in the post
		foreach ( $matches[2] as $key => $shortcode_match ) {
			if ( 'gallery' === $shortcode_match )
				$content = str_replace( $matches[0][$key], '', $content );
		}
	endif;

	return $content;
}
add_filter( 'the_content', 'serene_delete_post_gallery' );

if ( ! function_exists( 'serene_post_meta_info' ) ) :
function serene_post_meta_info() { ?>
	<div class="meta-date">
		<div class="meta-date-wrap">
		<?php
			printf( '<span class="meta-post-date"><strong>%s.</strong>%s</span> <a href="%s"><div class="meta-comments-count"><span aria-hidden="true" class="icon_comment_alt"></span>%s</div></a>',
				get_the_time( _x( 'M', 'post info month name', 'Serene' ) ),
				get_the_time( _x( 'd', 'post info day', 'Serene' ) ),
				esc_url( get_permalink() ),
				sprintf( _n( '1', '%1$s', get_comments_number(), 'Serene'), number_format_i18n( get_comments_number() ) )
			);
		?>
		</div>
	</div>
<?php }
endif;

if ( ! function_exists( 'serene_blockquote_color' ) ) :
function serene_blockquote_color() {
	$post_bg_color  = '' !== ( $bg_color = get_post_meta( get_the_ID(), '_et_post_bg_color', true ) )
		? $bg_color
		: '#666';

	if ( '#ffffff' === $post_bg_color )
		$post_bg_color = '#666';

	printf( ' style="color: %s;"',
		esc_attr( $post_bg_color )
	);
}
endif;