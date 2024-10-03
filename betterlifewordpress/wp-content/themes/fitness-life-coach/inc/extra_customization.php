<?php 

$fitness_insight_custom_style= "";

 // slider content alignment

$fitness_insight_slider_content_alignment = get_theme_mod( 'fitness_insight_slider_content_alignment','LEFT-ALIGN');

if($fitness_insight_slider_content_alignment == 'LEFT-ALIGN'){

$fitness_insight_custom_style .='#slider .carousel-caption{';

	$fitness_insight_custom_style .='text-align:left; right: 50%; left: 15%;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='@media screen and (max-width:1199px){';

$fitness_insight_custom_style .='#slider .carousel-caption{';

    $fitness_insight_custom_style .='right: 40%; left: 20%';
    
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

	$fitness_insight_custom_style .='text-align:right; right: 15%; left: 40%;';

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
    $fitness_insight_custom_style .= 'position: fixed; background: var(--theme-primary-color); padding: 1rem;';
    $fitness_insight_custom_style .= '}';

    $fitness_insight_custom_style .= '.admin-bar .fixed {';
    $fitness_insight_custom_style .= ' margin-top: 32px;';
    $fitness_insight_custom_style .= '}';

    $fitness_insight_custom_style .= '.page-template-custom-home-page .fixed .gb_nav_menu ul li a:hover {';
    $fitness_insight_custom_style .= ' color:#222222';
    $fitness_insight_custom_style .= '}';
}

// slider button
$mobile_button_setting = get_option('fitness_insight_slider_button_mobile_show_hide', '1');
$main_button_setting = get_option('fitness_insight_slider_button_show_hide', '1');

$fitness_insight_custom_style .= '#slider .slider-btn {';

if ($main_button_setting == 'off') {
    $fitness_insight_custom_style .= 'display: none;';
}

$fitness_insight_custom_style .= '}';

// Add media query for mobile devices
$fitness_insight_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_button_setting == 'off' || $mobile_button_setting == 'off') {
    $fitness_insight_custom_style .= '#slider .slider-btn { display: none; }';
}
$fitness_insight_custom_style .= '}';


// theme-Width 

$fitness_insight_theme_width = get_theme_mod( 'fitness_insight_width_options','full_width');

if($fitness_insight_theme_width == 'full_width'){

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 100%;';

$fitness_insight_custom_style .='}';

}else if($fitness_insight_theme_width == 'container'){

$fitness_insight_custom_style .='body{';

    $fitness_insight_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';

$fitness_insight_custom_style .='}';

$fitness_insight_custom_style .='body.page-template-custom-home-page{';

    $fitness_insight_custom_style .='position: relative;';

$fitness_insight_custom_style .='}';

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

//colors
$color = get_theme_mod('fitness_life_coach_primary_color', '#fc3c2a');
$color_second = get_theme_mod('fitness_life_coach_second_color', '#fd7669');
$color_heading = get_theme_mod('fitness_life_coach_heading_color', '#000');
$color_text = get_theme_mod('fitness_life_coach_text_color', '#8a8a8a');
$color_fade = get_theme_mod('fitness_life_coach_primary_fade', '#ffe7e5');
$color_footer_bg = get_theme_mod('fitness_life_coach_footer_bg', '#000');


$fitness_insight_custom_style .= ":root {";
    $fitness_insight_custom_style .= "--theme-primary-color: {$color};";
    $fitness_insight_custom_style .= "--theme-second-color: {$color_second};";
    $fitness_insight_custom_style .= "--theme-heading-color: {$color_heading};";
    $fitness_insight_custom_style .= "--theme-text-color: {$color_text};";
    $fitness_insight_custom_style .= "--theme-primary-fade: {$color_fade};";
    $fitness_insight_custom_style .= "--theme-footer-color: {$color_footer_bg};";
$fitness_insight_custom_style .= "}";