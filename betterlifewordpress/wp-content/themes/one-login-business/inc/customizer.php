<?php
/**
 * One Login Business: Customizer
 *
 * @subpackage One Login Business
 * @since 1.0
 */

function one_login_business_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// fontawesome icon-picker

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );



  	require get_parent_theme_file_path( 'inc/switch/control_switch.php' );

  	require get_parent_theme_file_path( 'inc/custom-control.php' );



	$wp_customize->add_section( 'one_login_business_typography_settings', array(
		'title'       => __( 'Typography', 'one-login-business' ),
		'priority'       => 2,
	) );

	$font_choices = array(
			'' => 'Select',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
			'Droid Sans:400,700' => 'Droid Sans',
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Arvo:400,700,400italic,700italic' => 'Arvo',
			'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif',
			'PT Sans:400,700,400italic,700italic' => 'PT Sans',
			'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
			'Arimo:400,700,400italic,700italic' => 'Arimo',
			'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
			'Bitter:400,700,400italic' => 'Bitter',
			'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
			'Roboto:400,400italic,700,700italic' => 'Roboto',
			'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
			'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
			'Roboto Slab:400,700' => 'Roboto Slab',
			'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
			'Rokkitt:400' => 'Rokkitt',
		);

	$wp_customize->add_setting( 'one_login_business_section_typo_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_typo_heading', array(
		'label'       => esc_html__( 'Typography Settings', 'one-login-business' ),
		'section'     => 'one_login_business_typography_settings',
		'settings'    => 'one_login_business_section_typo_heading',
	) ) );

	$wp_customize->add_setting( 'one_login_business_headings_text', array(
		'sanitize_callback' => 'one_login_business_sanitize_fonts',
	));

	$wp_customize->add_control( 'one_login_business_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'one-login-business'),
		'section' => 'one_login_business_typography_settings',
		'choices' => $font_choices
		
	));

	$wp_customize->add_setting( 'one_login_business_body_text', array(
		'sanitize_callback' => 'one_login_business_sanitize_fonts'
	));

	$wp_customize->add_control( 'one_login_business_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'one-login-business' ),
		'section' => 'one_login_business_typography_settings',
		'choices' => $font_choices
	) );

 	$wp_customize->add_section('one_login_business_pro', array(
        'title'    => __('UPGRADE BUSINESS PREMIUM', 'one-login-business'),
        'priority' => 1,
    ));

    $wp_customize->add_setting('one_login_business_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new One_Login_Business_Pro_Control($wp_customize, 'one_login_business_pro', array(
        'label'    => __('BUSINESS PREMIUM', 'one-login-business'),
        'section'  => 'one_login_business_pro',
        'settings' => 'one_login_business_pro',
        'priority' => 1,
    )));

	// Theme General Settings
    $wp_customize->add_section('one_login_business_theme_settings',array(
        'title' => __('Theme General Settings', 'one-login-business'),
        'priority' => 1,
    ) );
    $wp_customize->add_setting(
		'one_login_business_sticky_header',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_sticky_header',
			array(
				'settings'        => 'one_login_business_sticky_header',
				'section'         => 'one_login_business_theme_settings',
				'label'           => __( 'Show Sticky Header', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);
	
	$wp_customize->add_setting(
		'one_login_business_theme_loader',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_theme_loader',
			array(
				'settings'        => 'one_login_business_theme_loader',
				'section'         => 'one_login_business_theme_settings',
				'label'           => __( 'Show Site Loader', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('one_login_business_menu_text_transform',array(
        'default' => 'UPPERCASE',
        'sanitize_callback' => 'one_login_business_sanitize_choices'
	));
	$wp_customize->add_control('one_login_business_menu_text_transform',array(
        'type' => 'select',
        'label' => __('Menus Text Transform','one-login-business'),
        'section' => 'one_login_business_theme_settings',
        'choices' => array(
            'CAPITALISE' => __('CAPITALISE','one-login-business'),
            'UPPERCASE' => __('UPPERCASE','one-login-business'),
            'LOWERCASE' => __('LOWERCASE','one-login-business'),
        ),
	) );

	$wp_customize->add_setting( 'one_login_business_section_scroll_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_scroll_heading', array(
		'label'       => esc_html__( 'Scroll Top Settings', 'one-login-business' ),
		'section'     => 'one_login_business_theme_settings',
		'settings'    => 'one_login_business_section_scroll_heading',
	) ) );

	$wp_customize->add_setting(
		'one_login_business_scroll_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_scroll_enable',
			array(
				'settings'        => 'one_login_business_scroll_enable',
				'section'         => 'one_login_business_theme_settings',
				'label'           => __( 'Hide Scroll Top', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('one_login_business_scroll_options',array(
        'default' => 'right_align',
        'sanitize_callback' => 'one_login_business_sanitize_choices'
	));
	$wp_customize->add_control('one_login_business_scroll_options',array(
        'type' => 'select',
        'label' => __('Scroll Top Alignment','one-login-business'),
        'section' => 'one_login_business_theme_settings',
        'choices' => array(
            'right_align' => __('Right Align','one-login-business'),
            'center_align' => __('Center Align','one-login-business'),
            'left_align' => __('Left Align','one-login-business'),
        ),
	) );

	$wp_customize->add_setting('one_login_business_scroll_top_icon',array(
		'default'	=> 'fas fa-chevron-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new One_Login_Business_Fontawesome_Icon_Chooser(
        $wp_customize,'one_login_business_scroll_top_icon',array(
		'label'	=> __('Add Scroll Top Icon','one-login-business'),
		'transport' => 'refresh',
		'section'	=> 'one_login_business_theme_settings',
		'setting'	=> 'one_login_business_scroll_top_icon',
		'type'		=> 'icon'
	)));
	if ( class_exists( 'WooCommerce' ) ) { 	
	$wp_customize->add_section('one_login_business_woocommerce_settings',array(
        'title' => __('WooCommerce Settings', 'one-login-business'),
        'priority'=> 1,
    ) );

	$wp_customize->add_setting( 'one_login_business_section_shoppage_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_shoppage_heading', array(
		'label'       => esc_html__( 'Shop Page Settings', 'one-login-business' ),
		'section'     => 'one_login_business_woocommerce_settings',
		'settings'    => 'one_login_business_section_shoppage_heading',
	) ) );

	$wp_customize->add_setting(
		'one_login_business_shop_page_sidebar',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_shop_page_sidebar',
			array(
				'settings'        => 'one_login_business_shop_page_sidebar',
				'section'         => 'one_login_business_woocommerce_settings',
				'label'           => __( 'Hide Shop Page Sidebar', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting(
		'one_login_business_wocommerce_single_page_sidebar',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_wocommerce_single_page_sidebar',
			array(
				'settings'        => 'one_login_business_wocommerce_single_page_sidebar',
				'section'         => 'one_login_business_woocommerce_settings',
				'label'           => __( 'Hide Single Product Page Sidebar', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);
}
	//theme width

	$wp_customize->add_section('one_login_business_theme_width_settings',array(
        'title' => __('Theme Width Option', 'one-login-business'),
        'priority'=> 1,
    ) );

	$wp_customize->add_setting('one_login_business_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'one_login_business_sanitize_choices'
	));
	$wp_customize->add_control('one_login_business_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','one-login-business'),
        'section' => 'one_login_business_theme_width_settings',
        'choices' => array(
            'full_width' => __('Fullwidth','one-login-business'),
            'container' => __('Container','one-login-business'),
            'container_fluid' => __('Container Fluid','one-login-business'),
        ),
	) );
	//button
	$wp_customize->add_section('one_login_business_button_options',array(
        'title' => __('Button settings', 'one-login-business'),
        'priority' => 1,
    ) );
    $wp_customize->add_setting( 'one_login_business_section_talk_button_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_talk_button_heading', array(
		'label'       => esc_html__( 'Header Button', 'one-login-business' ),
		 'description' => __( 'Change the button layout from below options', 'one-login-business' ),
		'section'     => 'one_login_business_button_options',
		'settings'    => 'one_login_business_section_talk_button_heading',
	) ) );
    $wp_customize->add_setting( 'one_login_business_header_button_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'one_login_business_header_button_color', array(
	    'label' => esc_html__( 'Button Text Color','one-login-business' ),
	    'section' => 'one_login_business_button_options',
	    'settings' => 'one_login_business_header_button_color',
  	)));
  	$wp_customize->add_setting( 'one_login_business_header_border_button_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'one_login_business_header_border_button_color', array(
	    'label' => esc_html__( 'Button Border Color','one-login-business' ),
	    'section' => 'one_login_business_button_options',
	    'settings' => 'one_login_business_header_border_button_color',
  	)));
  	$wp_customize->add_setting( 'one_login_business_header_button_bg_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'one_login_business_header_button_bg_color', array(
	    'label' => esc_html__( 'Button Bg Color','one-login-business' ),
	    'section' => 'one_login_business_button_options',
	    'settings' => 'one_login_business_header_button_bg_color',
  	)));
	$wp_customize->add_setting('one_login_business_header_button_border_radius',array(
		'default'=> 25,
		'transport' => 'refresh',
		'sanitize_callback' => 'one_login_business_sanitize_integer'
	));
	$wp_customize->add_control(new One_Login_Business_Slider_Custom_Control( $wp_customize, 'one_login_business_header_button_border_radius',array(
		'label' => esc_html__( 'Border Radius','one-login-business' ),
		'section'=> 'one_login_business_button_options',
		'settings'=>'one_login_business_header_button_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 30,
        ),
	)));
    $wp_customize->add_setting( 'one_login_business_section_button_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_button_heading', array(
		'label'       => esc_html__( 'Theme Button', 'one-login-business' ),
		 'description' => __( 'Change the button layout from below options', 'one-login-business' ),
		'section'     => 'one_login_business_button_options',
		'settings'    => 'one_login_business_section_button_heading',
	) ) );
    $wp_customize->add_setting( 'one_login_business_theme_button_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'one_login_business_theme_button_color', array(
	    'label' => esc_html__( 'Button Color','one-login-business' ),
	    'section' => 'one_login_business_button_options',
	    'settings' => 'one_login_business_theme_button_color',
  	)));

	$wp_customize->add_setting('one_login_business_button_border_radius',array(
		'default'=> 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'one_login_business_sanitize_integer'
	));
	$wp_customize->add_control(new One_Login_Business_Slider_Custom_Control( $wp_customize, 'one_login_business_button_border_radius',array(
		'label' => esc_html__( 'Border Radius','one-login-business' ),
		'section'=> 'one_login_business_button_options',
		'settings'=>'one_login_business_button_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 30,
        ),
	)));
	//post layout
    $wp_customize->add_section('one_login_business_layout',array(
        'title' => __('Post Layout', 'one-login-business'), 
        'priority'=> 1,       
    ) );

    $wp_customize->add_setting( 'one_login_business_section_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_post_heading', array(
		'label'       => esc_html__( 'Post Structure', 'one-login-business' ),
		 'description' => __( 'Change the post layout from below options', 'one-login-business' ),
		'section'     => 'one_login_business_layout',
		'settings'    => 'one_login_business_section_post_heading',
	) ) );

	$wp_customize->add_setting(
		'one_login_business_single_post_sidebar',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_single_post_sidebar',
			array(
				'settings'        => 'one_login_business_single_post_sidebar',
				'section'         => 'one_login_business_layout',
				'label'           => __( 'Show Single Post Fullwidth', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);
    $wp_customize->add_setting( 'one_login_business_post_option',
			array(
				'default' => 'two_column',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new One_Login_Business_Radio_Image_Control( $wp_customize, 'one_login_business_post_option',
			array(
				'type'=>'select',
				'label' => __( 'select Post Page Layout', 'one-login-business' ),
				'section' => 'one_login_business_layout',
				'choices' => array(
					'one_column' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'One Column', 'one-login-business' )
					),
					'two_column' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Two Column', 'one-login-business' )
					),
					'three_column' => array(
						'image' => get_template_directory_uri().'/assets/images/3column.jpg',
						'name' => __( 'Three Column', 'one-login-business' )
					),
					'four_column' => array(
						'image' => get_template_directory_uri().'/assets/images/4column.jpg',
						'name' => __( 'Four Column', 'one-login-business' )
					),
					'grid_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/grid-sidebar.jpg',
						'name' => __( 'Grid-Sidebar Layout', 'one-login-business' )
					),
					'grid_post' => array(
						'image' => get_template_directory_uri().'/assets/images/grid.jpg',
						'name' => __( 'Grid Layout', 'one-login-business' )
					)
				)
			)
		) );

    $wp_customize->add_setting('one_login_business_grid_column',array(
		'default' => '3_column',
		'sanitize_callback' => 'one_login_business_sanitize_select'
	));
	$wp_customize->add_control('one_login_business_grid_column',array(
		'label' => esc_html__('Grid Post Per Row','one-login-business'),
		'section' => 'one_login_business_layout',
		'setting' => 'one_login_business_grid_column',
		'type' => 'radio',
        'choices' => array(
            '1_column' => __('1','one-login-business'),
            '2_column' => __('2','one-login-business'),
            '3_column' => __('3','one-login-business'),
            '4_column' => __('4','one-login-business'),
            '5_column' => __('6','one-login-business'),
        ),
	));

	$wp_customize->add_setting('one_login_business_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_date',
			array(
				'settings'        => 'one_login_business_date',
				'section'         => 'one_login_business_layout',
				'label'           => __( 'Hide Date', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->selective_refresh->add_partial( 'one_login_business_date', array(
		'selector' => '.date-box',
		'render_callback' => 'one_login_business_customize_partial_one_login_business_date',
	) );

	$wp_customize->add_setting('one_login_business_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_admin',
			array(
				'settings'        => 'one_login_business_admin',
				'section'         => 'one_login_business_layout',
				'label'           => __( 'Hide Author/Admin', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->selective_refresh->add_partial( 'one_login_business_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'one_login_business_customize_partial_one_login_business_admin',
	) );

	$wp_customize->add_setting('one_login_business_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_comment',
			array(
				'settings'        => 'one_login_business_comment',
				'section'         => 'one_login_business_layout',
				'label'           => __( 'Hide Comment', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->selective_refresh->add_partial( 'one_login_business_comment', array(
		'selector' => '.entry-comments',
		'render_callback' => 'one_login_business_customize_partial_one_login_business_comment',
	) );


	//Top Bar
  	$wp_customize->add_section('one_login_business_topbar',array(
    	'title' => esc_html__('Topbar Section','one-login-business'),
    	'priority'  => 2,
  	));

  	$wp_customize->add_setting( 'one_login_business_section_contact_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_contact_heading', array(
			'label'       => esc_html__( 'Topbar Settings', 'one-login-business' ),	
			'description' => esc_html__('Add topbar content','one-login-business'),	
			'section'     => 'one_login_business_topbar',
			'settings'    => 'one_login_business_section_contact_heading',
		) ) );

  	$wp_customize->add_setting('one_login_business_call1',array(
    	'default' => '',
    	'sanitize_callback' => 'one_login_business_sanitize_phone_number',
  	));
  	$wp_customize->add_control('one_login_business_call1',array(
    	'label' => esc_html__('Phone Number','one-login-business'),
    	'section' => 'one_login_business_topbar',
    	'type'  => 'text',
    	
  	));

  	$wp_customize->add_setting('one_login_business_mail1',array(
    	'default' => '',
    	'sanitize_callback' => 'sanitize_email',
  	));
  	$wp_customize->add_control('one_login_business_mail1',array(
    	'label' => esc_html__('Mail','one-login-business'),
    	'section' => 'one_login_business_topbar',
    	'type'  => 'text',
    	
  	));

  	$wp_customize->add_setting('one_login_business_time1',array(
    	'default' => '',
    	'sanitize_callback' => 'sanitize_text_field',
  	));
  	$wp_customize->add_control('one_login_business_time1',array(
    	'label' => esc_html__('Timing','one-login-business'),
    	'section' => 'one_login_business_topbar',
    	'type'  => 'text',
    	
  	));

	$wp_customize->add_setting('one_login_business_free1',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('one_login_business_free1',array(
		'label' => esc_html__('Button text','one-login-business'),
		'section' => 'one_login_business_topbar',
		'type'  => 'text',
		
	));

	$wp_customize->add_setting('one_login_business_free',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	)); 
	$wp_customize->add_control('one_login_business_free',array(
		'label' => esc_html__('Add Link','one-login-business'),
		'section' => 'one_login_business_topbar',
		'setting' => 'one_login_business_free',
		'type'  => 'url',
		
	));

	// Social Media
    $wp_customize->add_section('one_login_business_urls',array(
        'title' => __('Social Media', 'one-login-business'),
        'priority'=> 2,
    ) );

     $wp_customize->add_setting( 'one_login_business_section_social_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
	$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_social_heading', array(
		'label'       => esc_html__( 'Social Media Settings', 'one-login-business' ),
		'description' => __( 'Add social media links in the below feilds', 'one-login-business' ),			
		'section'     => 'one_login_business_urls',
		'settings'    => 'one_login_business_section_social_heading',
	) ) );

	$wp_customize->add_setting(
		'header_social_icon_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'header_social_icon_enable',
			array(
				'settings'        => 'header_social_icon_enable',
				'section'         => 'one_login_business_urls',
				'label'           => __( 'Check to show social fields', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

    $wp_customize->add_setting('one_login_business_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new One_Login_Business_Fontawesome_Icon_Chooser(
        $wp_customize,'one_login_business_twitter_icon',array(
		'label'	=> __('Add Twitter Icon','one-login-business'),
		'transport' => 'refresh',
		'section'	=> 'one_login_business_urls',
		'setting'	=> 'one_login_business_twitter_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('one_login_business_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('one_login_business_twitter',array(
		'label' => esc_html__('Twitter URL','one-login-business'),
		'section' => 'one_login_business_urls',
		'setting' => 'one_login_business_twitter',
		'type'    => 'url'
	));

	$wp_customize->add_setting(
		'one_login_business_header_twt_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_header_twt_target',
			array(
				'settings'        => 'one_login_business_header_twt_target',
				'section'         => 'one_login_business_urls',
				'label'           => __( 'Open link in a new tab', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('one_login_business_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new One_Login_Business_Fontawesome_Icon_Chooser(
        $wp_customize,'one_login_business_linkedin_icon',array(
		'label'	=> __('Add Linkedin Icon','one-login-business'),
		'transport' => 'refresh',
		'section'	=> 'one_login_business_urls',
		'setting'	=> 'one_login_business_linkedin_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('one_login_business_linkedin',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('one_login_business_linkedin',array(
		'label' => esc_html__('Linkedin URL','one-login-business'),
		'section' => 'one_login_business_urls',
		'setting' => 'one_login_business_linkedin',
		'type'    => 'url'
	));

	$wp_customize->add_setting(
		'one_login_business_header_linkedin_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_header_linkedin_target',
			array(
				'settings'        => 'one_login_business_header_linkedin_target',
				'section'         => 'one_login_business_urls',
				'label'           => __( 'Open link in a new tab', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('one_login_business_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new One_Login_Business_Fontawesome_Icon_Chooser(
        $wp_customize,'one_login_business_youtube_icon',array(
		'label'	=> __('Add Youtube Icon','one-login-business'),
		'transport' => 'refresh',
		'section'	=> 'one_login_business_urls',
		'setting'	=> 'one_login_business_youtube_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('one_login_business_youtube',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('one_login_business_youtube',array(
		'label' => esc_html__('Youtube URL','one-login-business'),
		'section' => 'one_login_business_urls',
		'setting' => 'one_login_business_youtube',
		'type'    => 'url'
	));

	$wp_customize->add_setting(
		'one_login_business_header_youtube_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_header_youtube_target',
			array(
				'settings'        => 'one_login_business_header_youtube_target',
				'section'         => 'one_login_business_urls',
				'label'           => __( 'Open link in a new tab', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('one_login_business_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new One_Login_Business_Fontawesome_Icon_Chooser(
        $wp_customize,'one_login_business_instagram_icon',array(
		'label'	=> __('Add Instagram Icon','one-login-business'),
		'transport' => 'refresh',
		'section'	=> 'one_login_business_urls',
		'setting'	=> 'one_login_business_instagram_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('one_login_business_instagram',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('one_login_business_instagram',array(
		'label' => esc_html__('Instagram URL','one-login-business'),
		'section' => 'one_login_business_urls',
		'setting' => 'one_login_business_instagram',
		'type'    => 'url'
	));

	$wp_customize->add_setting(
		'one_login_business_header_instagram_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_header_instagram_target',
			array(
				'settings'        => 'one_login_business_header_instagram_target',
				'section'         => 'one_login_business_urls',
				'label'           => __( 'Open link in a new tab', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);


	//home page slider
	$wp_customize->add_section( 'one_login_business_slidersettings' , array(
    	'title'      => esc_html__( 'Slider Settings', 'one-login-business' ),
    	'priority'=> 2,
	) );

	$wp_customize->add_setting( 'one_login_business_section_slide_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_slide_heading', array(
			'label'       => esc_html__( 'Slider Settings', 'one-login-business' ),	
			'section'     => 'one_login_business_slidersettings',
			'settings'    => 'one_login_business_section_slide_heading',
		) ) );

		$wp_customize->add_setting(
		'one_login_business_hide_show',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_hide_show',
			array(
				'settings'        => 'one_login_business_hide_show',
				'section'         => 'one_login_business_slidersettings',
				'label'           => __( 'Check To Hide Slider', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'one_login_business_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'one_login_business_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'one_login_business_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'one-login-business' ),
			'section'  => 'one_login_business_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}
	$wp_customize->add_setting('one_login_business_slider_content_alignment',array(
        'default' => 'CENTER-ALIGN',
        'sanitize_callback' => 'one_login_business_sanitize_choices'
	));
	$wp_customize->add_control('one_login_business_slider_content_alignment',array(
        'type' => 'select',
        'label' => __('Slider Content Alignment','one-login-business'),
        'section' => 'one_login_business_slidersettings',
        'choices' => array(
            'LEFT-ALIGN' => __('LEFT-ALIGN','one-login-business'),
            'CENTER-ALIGN' => __('CENTER-ALIGN','one-login-business'),
            'RIGHT-ALIGN' => __('RIGHT-ALIGN','one-login-business'),),
	) );

	
	// OUR services
	$wp_customize->add_section('one_login_business_service',array(
		'title' => esc_html__('Our Services','one-login-business'),
		'priority'=> 2,
	));

	$wp_customize->add_setting( 'one_login_business_section_service_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_service_heading', array(
			'label'       => esc_html__( 'Services Settings', 'one-login-business' ),	
			'section'     => 'one_login_business_service',
			'settings'    => 'one_login_business_section_service_heading',
		) ) );
		$wp_customize->add_setting(
		'one_login_business_service_hide_show',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_service_hide_show',
			array(
				'settings'        => 'one_login_business_service_hide_show',
				'section'         => 'one_login_business_service',
				'label'           => __( 'Check To Hide Services ', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);


	$wp_customize->add_setting('one_login_business_our_services_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('one_login_business_our_services_title',array(
		'label' => esc_html__('Section Title','one-login-business'),
		'section' => 'one_login_business_service',
		'setting' => 'one_login_business_our_services_title',
		'type'    => 'text',
		
	));

	$wp_customize->add_setting('one_login_business_our_services_subtitle',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('one_login_business_our_services_subtitle',array(
		'label' => esc_html__('Section Sub-title','one-login-business'),
		'section' => 'one_login_business_service',
		'setting' => 'one_login_business_our_services_subtitle',
		'type'    => 'text',
		
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	  $default = $category->slug;
	  $i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('one_login_business_category_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'one_login_business_sanitize_choices',
	));
	$wp_customize->add_control('one_login_business_category_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display Post','one-login-business'),
		'section' => 'one_login_business_service',
		
	));

	//Footer
    $wp_customize->add_section( 'one_login_business_footer', array(
    	'title'      => esc_html__( 'Footer Text', 'one-login-business' ),
		'priority'   => 2,
	) );
    $wp_customize->add_setting( 'one_login_business_section_footer_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new One_Login_Business_Customizer_Customcontrol_Section_Heading( $wp_customize, 'one_login_business_section_footer_heading', array(
			'label'       => esc_html__( 'Footer Settings', 'one-login-business' ),	
			'section'     => 'one_login_business_footer',
			'settings'    => 'one_login_business_section_footer_heading',
		) ) );
    $wp_customize->add_setting('one_login_business_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('one_login_business_footer_copy',array(
		'label'	=> esc_html__('Footer Text','one-login-business'),
		'section'	=> 'one_login_business_footer',
		'setting'	=> 'one_login_business_footer_copy',
		'type'		=> 'text'
	));

	//Logo
    $wp_customize->add_setting('one_login_business_logo_title',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_logo_title',
			array(
				'settings'        => 'one_login_business_logo_title',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Title', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('one_login_business_logo_text',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'one_login_business_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new One_Login_Business_Customizer_Customcontrol_Switch(
			$wp_customize,
			'one_login_business_logo_text',
			array(
				'settings'        => 'one_login_business_logo_text',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Tagline', 'one-login-business' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'one-login-business' ),
					'off'    => __( 'Off', 'one-login-business' ),
				),
				'active_callback' => '',
			)
		)
	);

	//Logo
    $wp_customize->add_setting('one_login_business_logo_max_height',array(
		'default'=> '50',
		'transport' => 'refresh',
		'sanitize_callback' => 'one_login_business_sanitize_integer'
	));
	$wp_customize->add_control(new One_Login_Business_Slider_Custom_Control( $wp_customize, 'one_login_business_logo_max_height',array(
		'label'	=> esc_html__('Logo Width','one-login-business'),
		'section'=> 'title_tagline',
		'settings'=>'one_login_business_logo_max_height',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'one_login_business_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'one_login_business_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'one_login_business_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'one_login_business_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'one-login-business' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'one-login-business' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'one_login_business_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'one_login_business_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'one_login_business_customize_register' );

function one_login_business_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

function one_login_business_customize_partial_blogname() {
	bloginfo( 'name' );
}

function one_login_business_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function one_login_business_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function one_login_business_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('ONE_LOGIN_BUSINESS_PRO_LINK',__('https://www.ovationthemes.com/products/wordpress-business-theme/','one-login-business'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('One_Login_Business_Pro_Control')):
    class One_Login_Business_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md-2 col-sm-6 upsell-btn">
                <a href="<?php echo esc_url( ONE_LOGIN_BUSINESS_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE BUSINESS PREMIUM','one-login-business');?> </a>
	        </div>
            <div class="col-md-4 col-sm-6">
                <img class="one_login_business_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md-3 col-sm-6">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('BUSINESS PREMIUM - Features', 'one-login-business'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'one-login-business');?> </li>
                    <li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'one-login-business');?> </li>
                   	<li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'one-login-business');?> </li>
                   	<li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'one-login-business');?> </li>
                   	<li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'one-login-business');?> </li>
                   	<li class="upsell-one_login_business"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'one-login-business');?> </li>                    
                </ul>
        	</div>
		    <div class="col-md-2 col-sm-6 upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( ONE_LOGIN_BUSINESS_PRO_LINK ); ?>" target="_blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE BUSINESS PREMIUM','one-login-business');?> </a>
		    </div>
			<p><?php printf(__('Please review us if you love our product on %1$sWordPress.org%2$s. </br></br>  Thank You', 'one-login-business'), '<a target="_blank" href="https://wordpress.org/support/theme/one-login-business/reviews/">', '</a>');
            ?></p>
        </label>
    <?php } }
endif;