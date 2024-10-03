<?php 

$fitness_insight_custom_style= "";

// logo max height
$fitness_insight_logo_max_height = get_theme_mod('fitness_insight_logo_max_height','100');

if($fitness_insight_logo_max_height != false){

$fitness_insight_custom_style .='.custom-logo-link img{';

	$fitness_insight_custom_style .='max-height: '.esc_html($fitness_insight_logo_max_height).'px;';
	
$fitness_insight_custom_style .='}';
}

// theme-Width 

$fitness_insight_theme_width = get_theme_mod( 'fitness_insight_width_options','full_width');

if($fitness_insight_theme_width == 'full_width'){

$fitness_insight_custom_style .='body{';

	$fitness_insight_custom_style .='max-width: 100%;';

$fitness_insight_custom_style .='}';

}else if($fitness_insight_theme_width == 'container'){

$fitness_insight_custom_style .='body{';

	$fitness_insight_custom_style .='width: 100%; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='@media screen and (min-width: 601px){';

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 720px;';
    
$fitness_insight_custom_style .='} }';

$fitness_insight_custom_style .='@media screen and (min-width: 992px){';

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 960px;';
    
$fitness_insight_custom_style .='} }';

$fitness_insight_custom_style .='@media screen and (min-width: 1200px){';

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 1140px;';
    
$fitness_insight_custom_style .='} }';

$fitness_insight_custom_style .='@media screen and (min-width: 1400px){';

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 1320px;';
    
$fitness_insight_custom_style .='} }';

$fitness_insight_custom_style .='@media screen and (max-width:600px){';

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$fitness_insight_custom_style .='} }';

}else if($fitness_insight_theme_width == 'container_fluid'){

$fitness_insight_custom_style .='body{';

	$fitness_insight_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='@media screen and (max-width:600px){';

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$fitness_insight_custom_style .='} }';
}

// Scroll-top-position 

$fitness_insight_scroll_options = get_theme_mod( 'fitness_insight_scroll_options','right_align');

if($fitness_insight_scroll_options == 'right_align'){

$fitness_insight_custom_style .='.scroll-top button{';

	$fitness_insight_custom_style .='';

$fitness_insight_custom_style .='}';

}else if($fitness_insight_scroll_options == 'center_align'){

$fitness_insight_custom_style .='.scroll-top button{';

	$fitness_insight_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

$fitness_insight_custom_style .='}';

}else if($fitness_insight_scroll_options == 'left_align'){

$fitness_insight_custom_style .='.scroll-top button{';

	$fitness_insight_custom_style .='right: auto; left:5%; margin: 0 auto';

$fitness_insight_custom_style .='}';
}

 // slider content alignment

$fitness_insight_slider_content_alignment = get_theme_mod( 'fitness_insight_slider_content_alignment','LEFT-ALIGN');

if($fitness_insight_slider_content_alignment == 'LEFT-ALIGN'){

$fitness_insight_custom_style .='#slider .carousel-caption{';

	$fitness_insight_custom_style .='text-align:left; right: 50%; left: 15%;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='@media screen and (max-width:1199px){';

$fitness_insight_custom_style .='#slider .carousel-caption{';

    $fitness_insight_custom_style .='right: 30%; left: 20%';
    
$fitness_insight_custom_style .='} }';

$fitness_insight_custom_style .='@media screen and (max-width:991px){';

$fitness_insight_custom_style .='#slider .carousel-caption{';

    $fitness_insight_custom_style .='right: 20%; left: 20%';
    
$fitness_insight_custom_style .='} }';


}else if($fitness_insight_slider_content_alignment == 'CENTER-ALIGN'){

$fitness_insight_custom_style .='#slider .carousel-caption{';

	$fitness_insight_custom_style .='text-align:center; right: 15%; left: 15%;';

$fitness_insight_custom_style .='}';


}else if($fitness_insight_slider_content_alignment == 'RIGHT-ALIGN'){

$fitness_insight_custom_style .='#slider .carousel-caption{';

	$fitness_insight_custom_style .='text-align:right; right: 15%; left: 50%;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='@media screen and (max-width:1199px){';

$fitness_insight_custom_style .='#slider .carousel-caption{';

    $fitness_insight_custom_style .='left: 30%; right: 20%';
    
$fitness_insight_custom_style .='} }';

$fitness_insight_custom_style .='@media screen and (max-width:991px){';

$fitness_insight_custom_style .='#slider .carousel-caption{';

    $fitness_insight_custom_style .='left: 20%; right: 20%';
    
$fitness_insight_custom_style .='} }';

}

//sticky-header
	if (false === get_option('fitness_insight_sticky_header')) {
	    add_option('fitness_insight_sticky_header', 'off');
	}

	// Define the custom CSS based on the 'fitness_insight_sticky_header' option

	if (get_option('fitness_insight_sticky_header', 'off') !== 'on') {
	    $fitness_insight_custom_style .= '.fixed_header.fixed {';
	    $fitness_insight_custom_style .= 'position: static;';
	    $fitness_insight_custom_style .= '}';
	}

	if (get_option('fitness_insight_sticky_header', 'off') !== 'off') {
	    $fitness_insight_custom_style .= '.fixed_header.fixed {';
	    $fitness_insight_custom_style .= 'position: fixed; background: var(--theme-primary-color);';
	    $fitness_insight_custom_style .= '}';

	    $fitness_insight_custom_style .= '.admin-bar .fixed {';
	    $fitness_insight_custom_style .= ' margin-top: 32px;';
	    $fitness_insight_custom_style .= '}';
	}

//related products
if( get_option( 'fitness_insight_related_product',true) != 'on') {

$fitness_insight_custom_style .='.related.products{';

	$fitness_insight_custom_style .='display: none;';
	
$fitness_insight_custom_style .='}';
}

if( get_option( 'fitness_insight_related_product',true) != 'off') {

$fitness_insight_custom_style .='.related.products{';

	$fitness_insight_custom_style .='display: block;';
	
$fitness_insight_custom_style .='}';
}

//text-transform

$fitness_insight_text_transform = get_theme_mod( 'fitness_insight_menu_text_transform','CAPITALISE');
if($fitness_insight_text_transform == 'CAPITALISE'){

$fitness_insight_custom_style .='nav#top_gb_menu ul li a{';

	$fitness_insight_custom_style .='text-transform: capitalize ;';

$fitness_insight_custom_style .='}';

}else if($fitness_insight_text_transform == 'UPPERCASE'){

$fitness_insight_custom_style .='nav#top_gb_menu ul li a{';

	$fitness_insight_custom_style .='text-transform: uppercase ; font-size: 12px;';

$fitness_insight_custom_style .='}';

}else if($fitness_insight_text_transform == 'LOWERCASE'){

$fitness_insight_custom_style .='nav#top_gb_menu ul li a{';

	$fitness_insight_custom_style .='text-transform: lowercase ;';

$fitness_insight_custom_style .='}';
}
// footer text alignment
$fitness_insight_footer_content_alignment = get_theme_mod( 'fitness_insight_footer_content_alignment','CENTER-ALIGN');

if($fitness_insight_footer_content_alignment == 'LEFT-ALIGN'){

$fitness_insight_custom_style .='.site-info{';

	$fitness_insight_custom_style .='text-align:left; padding-left: 30px;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='.site-info a{';

	$fitness_insight_custom_style .='padding-left: 30px;';

$fitness_insight_custom_style .='}';


}else if($fitness_insight_footer_content_alignment == 'CENTER-ALIGN'){

$fitness_insight_custom_style .='.site-info{';

	$fitness_insight_custom_style .='text-align:center;';

$fitness_insight_custom_style .='}';


}else if($fitness_insight_footer_content_alignment == 'RIGHT-ALIGN'){

$fitness_insight_custom_style .='.site-info{';

	$fitness_insight_custom_style .='text-align:right; padding-right: 30px;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='.site-info a{';

	$fitness_insight_custom_style .='padding-right: 30px;';

$fitness_insight_custom_style .='}';

}

// slider button
$mobile_button_setting = get_option('fitness_insight_slider_button_mobile_show_hide', '1');
$main_button_setting = get_option('fitness_insight_slider_button_show_hide', '1');

$fitness_insight_custom_style .= '#slider .home-btn {';

if ($main_button_setting == 'off') {
    $fitness_insight_custom_style .= 'display: none;';
}

$fitness_insight_custom_style .= '}';

// Add media query for mobile devices
$fitness_insight_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_button_setting == 'off' || $mobile_button_setting == 'off') {
    $fitness_insight_custom_style .= '#slider .home-btn { display: none; }';
}
$fitness_insight_custom_style .= '}';


// scroll button
$mobile_scroll_setting = get_option('fitness_insight_scroll_enable_mobile', '1');
$main_scroll_setting = get_option('fitness_insight_scroll_enable', '1');

$fitness_insight_custom_style .= '.scrollup {';

if ($main_scroll_setting == 'off') {
    $fitness_insight_custom_style .= 'display: none;';
}

$fitness_insight_custom_style .= '}';

// Add media query for mobile devices
$fitness_insight_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_scroll_setting == 'off' || $mobile_scroll_setting == 'off') {
    $fitness_insight_custom_style .= '.scrollup { display: none; }';
}
$fitness_insight_custom_style .= '}';

// theme breadcrumb
$mobile_breadcrumb_setting = get_option('fitness_insight_enable_breadcrumb_mobile', '1');
$main_breadcrumb_setting = get_option('fitness_insight_enable_breadcrumb', '1');

$fitness_insight_custom_style .= '.archieve_breadcrumb {';

if ($main_breadcrumb_setting == 'off') {
    $fitness_insight_custom_style .= 'display: none;';
}

$fitness_insight_custom_style .= '}';

// Add media query for mobile devices
$fitness_insight_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_breadcrumb_setting == 'off' || $mobile_breadcrumb_setting == 'off') {
    $fitness_insight_custom_style .= '.archieve_breadcrumb { display: none; }';
}
$fitness_insight_custom_style .= '}';

// single post and page breadcrumb
$mobile_single_breadcrumb_setting = get_option('fitness_insight_single_enable_breadcrumb_mobile', '1');
$main_single_breadcrumb_setting = get_option('fitness_insight_single_enable_breadcrumb', '1');

$fitness_insight_custom_style .= '.single_breadcrumb {';

if ($main_single_breadcrumb_setting == 'off') {
    $fitness_insight_custom_style .= 'display: none;';
}

$fitness_insight_custom_style .= '}';

// Add media query for mobile devices
$fitness_insight_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_single_breadcrumb_setting == 'off' || $mobile_single_breadcrumb_setting == 'off') {
    $fitness_insight_custom_style .= '.single_breadcrumb { display: none; }';
}
$fitness_insight_custom_style .= '}';

// woocommerce breadcrumb
$mobile_woo_breadcrumb_setting = get_option('fitness_insight_woocommerce_enable_breadcrumb_mobile', '1');
$main_woo_breadcrumb_setting = get_option('fitness_insight_woocommerce_enable_breadcrumb', '1');

$fitness_insight_custom_style .= '.woocommerce-breadcrumb {';

if ($main_woo_breadcrumb_setting == 'off') {
    $fitness_insight_custom_style .= 'display: none;';
}

$fitness_insight_custom_style .= '}';

// Add media query for mobile devices
$fitness_insight_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_woo_breadcrumb_setting == 'off' || $mobile_woo_breadcrumb_setting == 'off') {
    $fitness_insight_custom_style .= '.woocommerce-breadcrumb { display: none; }';
}
$fitness_insight_custom_style .= '}';


//colors
$color = get_theme_mod('fitness_insight_primary_color', '#fe7d15');
$color_second = get_theme_mod('fitness_insight_second_color', '#fd5e48');
$color_third = get_theme_mod('fitness_insight_third_color', '#f2bb1e');
$color_heading = get_theme_mod('fitness_insight_heading_color', '#2c2c2c');
$color_text = get_theme_mod('fitness_insight_text_color', '#666c6e');
$color_fade = get_theme_mod('fitness_insight_primary_fade', '#f5e3b2');
$color_footer_bg = get_theme_mod('fitness_insight_footer_bg', '#2c2c2c');
$color_post_bg = get_theme_mod('fitness_insight_post_bg', '#ffffff');


$fitness_insight_custom_style .= ":root {";
    $fitness_insight_custom_style .= "--theme-primary-color: {$color};";
    $fitness_insight_custom_style .= "--theme-second-color: {$color_second};";
    $fitness_insight_custom_style .= "--theme-third-color: {$color_third};";
    $fitness_insight_custom_style .= "--theme-heading-color: {$color_heading};";
    $fitness_insight_custom_style .= "--theme-text-color: {$color_text};";
    $fitness_insight_custom_style .= "--theme-primary-fade: {$color_fade};";
    $fitness_insight_custom_style .= "--theme-footer-color: {$color_footer_bg};";
    $fitness_insight_custom_style .= "--post-bg-color: {$color_post_bg};";
$fitness_insight_custom_style .= "}";