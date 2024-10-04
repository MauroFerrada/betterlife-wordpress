<?php
/**
 * One Login Business functions and definitions
 *
 * @subpackage One Login Business
 * @since 1.0
 */

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function one_login_business_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
if ( ! function_exists( 'one_login_business_sanitize_integer' ) ) {
	function one_login_business_sanitize_integer( $input ) {
		return (int) $input;
	}
}
function one_login_business_sanitize_phone_number( $phone ) {
  return preg_replace( '/[^\d+]/', '', $phone );
}
function one_login_business_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<div class="link-more text-center"><a href="%1$s" class="more-link py-2 px-4">%2$s</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'one-login-business' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'one_login_business_excerpt_more' );

function one_login_business_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function one_login_business_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// post format functions
function one_login_business_get_attachment(){
	$output ='';
    if(has_post_thumbnail()):
		 $output =wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	else:
		$attachments = get_posts(array(
		'post_type' => 'attachment',
		'posts_per_page' => 1,
		'post_parent' => get_the_ID()
	));
		if ($attachments):
			foreach ($attachments as $attachment):
				$output = wp_get_attachment_url($attachment -> ID);
			endforeach;
		endif;
		wp_reset_postdata();
	endif;
	return $output;
	}
//media post format
function one_login_business_get_media($type = array()){
	$content = apply_filters( 'the_content', get_the_content() );
  	$output = false;

  // Only get audio from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $output = get_media_embedded_in_content( $content, $type );
    return $output;
  }

}
function one_login_business_sanitize_select( $input, $setting ){  
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function one_login_business_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function one_login_business_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function one_login_business_callback_sanitize_switch( $value ) {
	
	// Switch values must be equal to 1 of off. Off is indicator and should not be translated.
	return ( ( isset( $value ) && $value == 1 ) ? 1 : 'off' );

}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'one_login_business_loop_columns');
	if (!function_exists('one_login_business_loop_columns')) {
		function one_login_business_loop_columns() {
		return 3; // 3 products per row
	}
}

function one_login_business_setup() {
	
	load_theme_textdomain( 'one-login-business', get_template_directory() . '/languages' );
	add_theme_support( 'align-wide' );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background', $defaults = array(
	    'default-color'          => '',
	    'default-image'          => '',
	    'default-repeat'         => '',
	    'default-position-x'     => '',
	    'default-attachment'     => '',
	    'wp-head-callback'       => '_custom_background_cb',
	    'admin-head-callback'    => '',
	    'admin-preview-callback' => ''
	));

	add_image_size( 'one-login-business-featured-image', 2000, 1200, true );

	add_image_size( 'one-login-business-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'one-login-business' ),
		'footer'	=> __('Footer Menu', 'one-login-business'),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio','quote',) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', one_login_business_fonts_url() ) );

}
add_action( 'after_setup_theme', 'one_login_business_setup' );

function one_login_business_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'one-login-business' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'one-login-business' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'one-login-business' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'one-login-business' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'one-login-business' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'one-login-business' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'one-login-business' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'one-login-business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'one_login_business_widgets_init' );

function one_login_business_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Poppins:200,200i,300,300i,400,400i,500,500i,700i,800i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

//Enqueue scripts and styles.
function one_login_business_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'one-login-business-fonts', one_login_business_fonts_url(), array(), null );
	
	//Bootstarp 
	wp_enqueue_style( 'bootstrap-style', esc_url( get_template_directory_uri() ).'/assets/css/bootstrap.css' );	
	
	// Theme stylesheet.
	wp_enqueue_style( 'one-login-business-style', get_stylesheet_uri() );

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'one-login-business-style',$one_login_business_custom_style );

	//font-awesome
	wp_enqueue_style( 'font-awesome-style', esc_url( get_template_directory_uri() ).'/assets/css/fontawesome-all.css' );

	//Block Style
	wp_enqueue_style( 'one-login-business-block-style', esc_url( get_template_directory_uri() ).'/assets/css/blocks.css' );

	wp_enqueue_script( 'one-login-business-custom.js', get_theme_file_uri( '/assets/js/one-login-business-custom.js' ), array( 'jquery' ), true );
	
	wp_enqueue_script( 'bootstrap.js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'one_login_business_scripts' );

function one_login_business_enqueue_admin_script( $hook ) {
	
	// Admin JS
	wp_enqueue_script( 'one-login-business-admin.js', get_theme_file_uri( '/assets/js/one-login-business-admin.js' ), array( 'jquery' ), true );

	wp_localize_script('one-login-business-admin.js', 'one_login_business_scripts_localize',
        array(
            'ajax_url' => esc_url(admin_url('admin-ajax.php'))
        )
    );
}
add_action( 'admin_enqueue_scripts', 'one_login_business_enqueue_admin_script' );

function one_login_business_fonts_scripts() {
	$headings_font = esc_html(get_theme_mod('one_login_business_headings_text'));
	$body_font = esc_html(get_theme_mod('one_login_business_body_text'));

	if( $headings_font ) {
		wp_enqueue_style( 'one-login-business-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
	} else {
		wp_enqueue_style( 'one-login-business-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $body_font ) {
		wp_enqueue_style( 'one-login-business-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
	} else {
		wp_enqueue_style( 'one-login-business-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'one_login_business_fonts_scripts' );

// Enqueue editor styles for Gutenberg
function one_login_business_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'one-login-business-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'one-login-business-fonts', one_login_business_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'one_login_business_editor_styles' );

function one_login_business_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'one_login_business_front_page_template' );

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );

require get_parent_theme_file_path( '/inc/typofont.php' );

function one_login_business_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
        wp_safe_redirect( admin_url("themes.php?page=one-login-business-guide-page") );
    }
}
add_action('after_setup_theme', 'one_login_business_notice');

function one_login_business_add_new_page() {
  $edit_page = admin_url().'post-new.php?post_type=page';
  echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

  exit;
}
add_action( 'wp_ajax_one_login_business_add_new_page','one_login_business_add_new_page' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'one_login_business_customize_controls_register_scripts' );

function one_login_business_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'one-login-business-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}