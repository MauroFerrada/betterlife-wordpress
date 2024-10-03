<?php
/**
 * Fitness Insight functions and definitions
 *
 * @subpackage Fitness Insight
 * @since 1.0
 */

//woocommerce//
//shop page no of columns
function fitness_insight_woocommerce_loop_columns() {
	
	$retrun = get_theme_mod( 'fitness_insight_archieve_item_columns', 3 );
    
    return $retrun;
}
add_filter( 'loop_shop_columns', 'fitness_insight_woocommerce_loop_columns' );
function fitness_insight_woocommerce_products_per_page() {

		$retrun = get_theme_mod( 'fitness_insight_archieve_shop_perpage', 6 );
    
    return $retrun;
}
add_filter( 'loop_shop_per_page', 'fitness_insight_woocommerce_products_per_page' );
// related products
function fitness_insight_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod( 'fitness_insight_related_shop_perpage', 3 ),
        'columns'        => get_theme_mod( 'fitness_insight_related_item_columns', 3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'fitness_insight_related_products_args' );

// breadcrumb seperator
function fitness_insight_woocommerce_breadcrumb_separator($fitness_insight_defaults) {
    $fitness_insight_separator = get_theme_mod('woocommerce_breadcrumb_separator', ' / ');

    // Update the separator
    $fitness_insight_defaults['delimiter'] = $fitness_insight_separator;

    return $fitness_insight_defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'fitness_insight_woocommerce_breadcrumb_separator');

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($fitness_insight_classes, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $fitness_insight_classes = array_merge(['wow','zoomIn'], $fitness_insight_classes);
	    }
	    return $fitness_insight_classes;
	},10,3);
}
//woocommerce-end//

// Get start function

// Enqueue scripts and styles
function fitness_insight_enqueue_admin_script($hook) {
    // Admin JS
    wp_enqueue_script('fitness-insight-admin-js', get_theme_file_uri('/assets/js/fitness-insight-admin.js'), array('jquery'), true);
    wp_localize_script(
		'fitness-insight-admin-js',
		'fitness_insight',
		array(
			'admin_ajax'	=>	admin_url('admin-ajax.php'),
			'wpnonce'			=>	wp_create_nonce('fitness_insight_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('fitness-insight-admin-js');

    wp_localize_script( 'fitness-insight-admin-js', 'fitness_insight_scripts_localize',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action('admin_enqueue_scripts', 'fitness_insight_enqueue_admin_script');

//dismiss function 
add_action( 'wp_ajax_fitness_insight_dismissed_notice_handler', 'fitness_insight_ajax_notice_dismiss_fuction' );

function fitness_insight_ajax_notice_dismiss_fuction() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'fitness_insight_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

//get start box
function fitness_insight_custom_admin_notice() {
    // Check if the notice is dismissed
    if ( ! get_option('dismissed-get_started_notice', FALSE ) )  {
        // Check if not on the theme documentation page
        $fitness_insight_current_screen = get_current_screen();
        if ($fitness_insight_current_screen && $fitness_insight_current_screen->id !== 'appearance_page_fitness-insight-guide-page') {
            $fitness_insight_theme = wp_get_theme();
            ?>
            <div class="notice notice-info is-dismissible" data-notice="get_started_notice">
                <div class="notice-div">
                    <div>
                        <p class="theme-name"><?php echo esc_html($fitness_insight_theme->get('Name')); ?></p>
                        <p><?php _e('For information and detailed instructions, check out our theme documentation.', 'fitness-insight'); ?></p>
                    </div>
                    <div class="notice-buttons-box">
                        <a class="button-primary livedemo" href="<?php echo esc_url( FITNESS_INSIGHT_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'fitness-insight'); ?></a>
                        <a class="button-primary buynow" href="<?php echo esc_url( FITNESS_INSIGHT_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'fitness-insight'); ?></a>
                        <a class="button-primary theme-install" href="themes.php?page=fitness-insight-guide-page"><?php _e('Begin Installation', 'fitness-insight'); ?></a> 
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
add_action('admin_notices', 'fitness_insight_custom_admin_notice');

//after switch theme
add_action('after_switch_theme', 'fitness_insight_after_switch_theme');
function fitness_insight_after_switch_theme () {
    update_option('dismissed-get_started_notice', FALSE );
}
//get-start-function-end//

// tag count
function fitness_insight_display_post_tag_count() {
    $fitness_insight_tags = get_the_tags();
    $fitness_insight_tag_count = ($fitness_insight_tags) ? count($fitness_insight_tags) : 0;
    $fitness_insight_tag_text = ($fitness_insight_tag_count === 1) ? 'tag' : 'tags';
    echo $fitness_insight_tag_count . ' ' . $fitness_insight_tag_text;
}

//media post format
function fitness_insight_get_media($fitness_insight_type = array()){
	$fitness_insight_content = apply_filters( 'the_content', get_the_content() );
  	$output = false;

  // Only get media from the content if a playlist isn't present.
  if ( false === strpos( $fitness_insight_content, 'wp-playlist-script' ) ) {
    $output = get_media_embedded_in_content( $fitness_insight_content, $fitness_insight_type );
    return $output;
  }
}

// excerpt function
function fitness_insight_custom_excerpt() {
    $fitness_insight_excerpt = get_the_excerpt();
    $fitness_insight_plain_text_excerpt = wp_strip_all_tags($fitness_insight_excerpt);
    
    // Get dynamic word limit from theme mod
    $fitness_insight_word_limit = esc_attr(get_theme_mod('fitness_insight_post_excerpt', '30'));
    
    // Limit the number of words
    $fitness_insight_limited_excerpt = implode(' ', array_slice(explode(' ', $fitness_insight_plain_text_excerpt), 0, $fitness_insight_word_limit));

    echo esc_html($fitness_insight_limited_excerpt);
}

// front page template
function fitness_insight_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'fitness_insight_front_page_template' );

//typography
function fitness_insight_fonts_scripts() {
	$headings_font = esc_html(get_theme_mod('fitness_insight_headings_text'));
	$body_font = esc_html(get_theme_mod('fitness_insight_body_text'));

	if( $headings_font ) {
		wp_enqueue_style( 'fitness-insight-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
	} else {
		wp_enqueue_style( 'fitness-insight-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $body_font ) {
		wp_enqueue_style( 'fitness-insight-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
	} else {
		wp_enqueue_style( 'fitness-insight-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'fitness_insight_fonts_scripts' );

// Footer Text
function fitness_insight_copyright_link() {
    $fitness_insight_footer_text = get_theme_mod('fitness_insight_footer_text', esc_html__('Fitness WordPress Theme', 'fitness-insight'));
    $fitness_insight_credit_link = esc_url('https://www.ovationthemes.com/products/free-fitness-wordpress-theme');

    echo '<a href="' . $fitness_insight_credit_link . '" target="_blank">' . esc_html($fitness_insight_footer_text) . '<span class="footer-copyright">' . esc_html__(' By Ovation Themes', 'fitness-insight') . '</span></a>';
}

// custom sanitizations
// dropdown
function fitness_insight_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
// slider custom control
if ( ! function_exists( 'fitness_insight_sanitize_integer' ) ) {
	function fitness_insight_sanitize_integer( $input ) {
		return (int) $input;
	}
}
// range contol
function fitness_insight_sanitize_number_absint( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
// select post page
function fitness_insight_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
// toggle switch
function fitness_insight_callback_sanitize_switch( $value ) {
	// Switch values must be equal to 1 of off. Off is indicator and should not be translated.
	return ( ( isset( $value ) && $value == 1 ) ? 1 : 'off' );
}
//choices control
function fitness_insight_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
// phone number
function fitness_insight_sanitize_phone_number( $phone ) {
  return preg_replace( '/[^\d+]/', '', $phone );
}
// Sanitize Sortable control.
function fitness_insight_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}

//theme setup
function fitness_insight_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( "wp-block-styles" );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'fitness-insight-featured-image', 2000, 1200, true );
	add_image_size( 'fitness-insight-thumbnail-avatar', 100, 100, true );

	define( 'THEME_DIR', dirname( __FILE__ ) );

	load_theme_textdomain( 'fitness-insight', get_template_directory() . '/languages' );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fitness-insight' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'      	=> 250,
		'height'      	=> 250,
		'flex-width'  	=> true,
		'flex-height'	=>true,
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
	add_editor_style( array( 'assets/css/editor-style.css', fitness_insight_fonts_url() ) );
}
add_action( 'after_setup_theme', 'fitness_insight_setup' );

// widget
function fitness_insight_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fitness-insight' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'fitness-insight' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'fitness-insight' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'fitness-insight' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'fitness-insight' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'fitness-insight' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'fitness-insight' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'fitness-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fitness_insight_widgets_init' );

// google fonts
function fitness_insight_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Yantramanav:wght@100;300;400;500;700;900';
	$font_family[] = 'Fira Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500';
	$font_family[] = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900';
	
	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

// Enqueue script and styles
function fitness_insight_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'fitness-insight-fonts', fitness_insight_fonts_url(), array());

	// Bootstarp
	wp_enqueue_style( 'bootstrap-style', esc_url( get_template_directory_uri() ).'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'fitness-insight-style', get_stylesheet_uri() );

	wp_style_add_data('fitness-insight-style', 'rtl', 'replace');


	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'fitness-insight-style',$fitness_insight_custom_style );

	// font-awesome
	wp_enqueue_style( 'font-awesome-style', esc_url( get_template_directory_uri() ).'/assets/css/fontawesome-all.css' );

	// Block Style
	wp_enqueue_style( 'fitness-insight-block-style', esc_url( get_template_directory_uri() ).'/assets/css/blocks.css' );

	// Custom JS
	wp_enqueue_script( 'fitness-insight-custom.js', get_theme_file_uri( '/assets/js/fitness-insight-custom.js' ), array( 'jquery' ), true );

	// Nav Focus JS
	wp_enqueue_script( 'fitness-insight-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	// Bootstarp JS
	wp_enqueue_script( 'bootstrap.js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (get_option('fitness_insight_animation_enable', false) !== 'off') {
		//wow.js
		wp_enqueue_script( 'fitness-insight-wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );

		//animate.css
		wp_enqueue_style( 'fitness-insight-animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'fitness_insight_scripts' );

function fitness_insight_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'fitness-insight-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'fitness-insight-fonts', fitness_insight_fonts_url(), array() );
}
add_action( 'enqueue_block_editor_assets', 'fitness_insight_block_editor_styles' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'fitness_insight_customize_controls_register_scripts' );

function fitness_insight_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'fitness-insight-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}

// enque files
require get_parent_theme_file_path( '/inc/custom-header.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/customizer.php' );
require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );
require get_parent_theme_file_path( '/inc/typofont.php' );
require get_parent_theme_file_path( '/inc/wptt-webfont-loader.php' );
require get_parent_theme_file_path( '/inc/breadcrumb.php' );
require get_parent_theme_file_path( 'inc/sortable/sortable_control.php' );