<?php 

	$one_login_business_custom_style= "";

	/*---------------------------Width -------------------*/
	
	$one_login_business_theme_width = get_theme_mod( 'one_login_business_width_options','full_width');

    if($one_login_business_theme_width == 'full_width'){

		$one_login_business_custom_style .='body{';

			$one_login_business_custom_style .='max-width: 100%;';

		$one_login_business_custom_style .='}';

	}else if($one_login_business_theme_width == 'container'){

		$one_login_business_custom_style .='body{';

			$one_login_business_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';

		$one_login_business_custom_style .='}';

	}else if($one_login_business_theme_width == 'container_fluid'){

		$one_login_business_custom_style .='body{';

			$one_login_business_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

		$one_login_business_custom_style .='}';
	}
	/*---------------------------Scroll-top-position -------------------*/
	
	$one_login_business_scroll_options = get_theme_mod( 'one_login_business_scroll_options','right_align');

    if($one_login_business_scroll_options == 'right_align'){

		$one_login_business_custom_style .='.scroll-top button{';

			$one_login_business_custom_style .='';

		$one_login_business_custom_style .='}';

	}else if($one_login_business_scroll_options == 'center_align'){

		$one_login_business_custom_style .='.scroll-top button{';

			$one_login_business_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

		$one_login_business_custom_style .='}';

	}else if($one_login_business_scroll_options == 'left_align'){

		$one_login_business_custom_style .='.scroll-top button{';

			$one_login_business_custom_style .='right: auto; left:5%; margin: 0 auto';

		$one_login_business_custom_style .='}';
	}

			/*---------------------------text-transform-------------------*/

	$one_login_business_text_transform = get_theme_mod( 'one_login_business_menu_text_transform','UPPERCASE');
    if($one_login_business_text_transform == 'CAPITALISE'){

		$one_login_business_custom_style .='#header .nav ul {';

			$one_login_business_custom_style .='text-transform: capitalize ; font-size: 14px;';

		$one_login_business_custom_style .='}';

	}else if($one_login_business_text_transform == 'UPPERCASE'){

		$one_login_business_custom_style .='#header .nav ul{';

			$one_login_business_custom_style .='text-transform: uppercase ; font-size: 14px;';

		$one_login_business_custom_style .='}';

	}else if($one_login_business_text_transform == 'LOWERCASE'){

		$one_login_business_custom_style .='#header .nav ul{';

			$one_login_business_custom_style .='text-transform: lowercase ; font-size: 14px;';

		$one_login_business_custom_style .='}';
	}

			/*-------------------------Slider-content-alignment-------------------*/

		$one_login_business_slider_content_alignment = get_theme_mod( 'one_login_business_slider_content_alignment','CENTER-ALIGN');

		 if($one_login_business_slider_content_alignment == 'LEFT-ALIGN'){

				$one_login_business_custom_style .='.slider-inner{';

					$one_login_business_custom_style .='text-align:left;';

				$one_login_business_custom_style .='}';


			}else if($one_login_business_slider_content_alignment == 'CENTER-ALIGN'){

				$one_login_business_custom_style .='.slider-inner{';

					$one_login_business_custom_style .='text-align:center;';

				$one_login_business_custom_style .='}';


			}else if($one_login_business_slider_content_alignment == 'RIGHT-ALIGN'){

				$one_login_business_custom_style .='.slider-inner{';

					$one_login_business_custom_style .='text-align:right;';

				$one_login_business_custom_style .='}';

			}

	/*---------------------------Logo -------------------*/


	$one_login_business_logo_max_height = get_theme_mod('one_login_business_logo_max_height','50');

	if($one_login_business_logo_max_height != false){

		$one_login_business_custom_style .='.custom-logo-link img{';

			$one_login_business_custom_style .='max-width: '.esc_html($one_login_business_logo_max_height).'px;';
			
		$one_login_business_custom_style .='}';
	}

		//---------sticky header---------
			if( get_option( 'one_login_business_sticky_header',true) != 'on') {

		$one_login_business_custom_style .='.fixed_header.fixed{';

			$one_login_business_custom_style .='position: static;';
			
		$one_login_business_custom_style .='}';
	}

	if( get_option( 'one_login_business_sticky_header',true) != 'off') {

		$one_login_business_custom_style .='.fixed_header.fixed{';

			$one_login_business_custom_style .='position: fixed;';
			
		$one_login_business_custom_style .='}';
	}

	//---------------------theme-button-color-------------//

	$one_login_business_theme_button_color = get_theme_mod('one_login_business_theme_button_color');

			if($one_login_business_theme_button_color != false){

		$one_login_business_custom_style .='button,input[type="button"],input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,button.search-submit,a.more-link,a.added_to_cart.wc-forward,.site-footer .search-form .search-submit,.prev.page-numbers, .next.page-numbers, .page-numbers.current, .toggle-menu button,#slider1 .more-btn a{';

			$one_login_business_custom_style .='background-color: '.esc_attr($one_login_business_theme_button_color).';';

		$one_login_business_custom_style .='}';
	}
	$one_login_business_button_border = get_theme_mod('one_login_business_button_border_radius','0');
		
		if($one_login_business_button_border != false){

				$one_login_business_custom_style .='button,input[type="button"],input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,button.search-submit,a.more-link,a.added_to_cart.wc-forward,.site-footer .search-form .search-submit,#sidebar input[type="search"], input[type="search"], .prev.page-numbers, .next.page-numbers,#slider1 .more-btn a{';

		$one_login_business_custom_style .='border-radius: '.esc_attr(

			$one_login_business_button_border).'px;';
				
				$one_login_business_custom_style .='}';
		}


//--------------header-button------------
	$one_login_business_header_button_color = get_theme_mod('one_login_business_header_button_color');

			if($one_login_business_header_button_color != false){

		$one_login_business_custom_style .='.lets-talk a{';

			$one_login_business_custom_style .='color: '.esc_attr($one_login_business_header_button_color).';';

		$one_login_business_custom_style .='}';
	}

	$one_login_business_header_button_bg_color = get_theme_mod('one_login_business_header_button_bg_color');

			if($one_login_business_header_button_bg_color != false){

		$one_login_business_custom_style .='.lets-talk a{';

			$one_login_business_custom_style .='background: '.esc_attr($one_login_business_header_button_bg_color).';';

		$one_login_business_custom_style .='}';
	}

	$one_login_business_header_border_button_color = get_theme_mod('one_login_business_header_border_button_color');

			if($one_login_business_header_border_button_color != false){

		$one_login_business_custom_style .='.lets-talk a{';

			$one_login_business_custom_style .='border-color: '.esc_attr($one_login_business_header_border_button_color).';';

		$one_login_business_custom_style .='}';
	}
	$one_login_business_header_button_border_radius = get_theme_mod('one_login_business_header_button_border_radius','25');
		
		if($one_login_business_header_button_border_radius != false){

				$one_login_business_custom_style .='.lets-talk a{';

		$one_login_business_custom_style .='border-radius: '.esc_attr(

			$one_login_business_header_button_border_radius).'px;';
				
				$one_login_business_custom_style .='}';
		}