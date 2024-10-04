<?php

add_action( 'admin_menu', 'one_login_business_gettingstarted' );
function one_login_business_gettingstarted() {    	
	add_theme_page( esc_html__('Theme Documentation', 'one-login-business'), esc_html__('Theme Documentation', 'one-login-business'), 'edit_theme_options', 'one-login-business-guide-page', 'one_login_business_guide');   
}

function one_login_business_admin_theme_style() {
   wp_enqueue_style('one-login-business-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'one_login_business_admin_theme_style');

if ( ! defined( 'ONE_LOGIN_BUSINESS_SUPPORT' ) ) {
define('ONE_LOGIN_BUSINESS_SUPPORT',__('https://wordpress.org/support/theme/one-login-business','one-login-business'));
}
if ( ! defined( 'ONE_LOGIN_BUSINESS_REVIEW' ) ) {
define('ONE_LOGIN_BUSINESS_REVIEW',__('https://wordpress.org/support/theme/one-login-business/reviews/#new-post','one-login-business'));
}
if ( ! defined( 'ONE_LOGIN_BUSINESS_LIVE_DEMO' ) ) {
define('ONE_LOGIN_BUSINESS_LIVE_DEMO',__('https://trial.ovationthemes.com/ovation-one-login-business-pro/','one-login-business'));
}
if ( ! defined( 'ONE_LOGIN_BUSINESS_BUY_PRO' ) ) {
define('ONE_LOGIN_BUSINESS_BUY_PRO',__('https://www.ovationthemes.com/products/wordpress-business-theme/','one-login-business'));
}
if ( ! defined( 'ONE_LOGIN_BUSINESS_PRO_DOC' ) ) {
define('ONE_LOGIN_BUSINESS_PRO_DOC',__('https://trial.ovationthemes.com/docs/ot-one-login-business-pro/','one-login-business'));
}
if ( ! defined( 'ONE_LOGIN_BUSINESS_THEME_NAME' ) ) {
define('ONE_LOGIN_BUSINESS_THEME_NAME',__('Premium Login Business Theme','one-login-business'));
}

/**
 * Theme Info Page
 */
function one_login_business_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( '' ); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'one-login-business'); ?><?php echo esc_html($theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( ONE_LOGIN_BUSINESS_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'one-login-business'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( ONE_LOGIN_BUSINESS_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'one-login-business'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','one-login-business'); ?></h3>
					<p><?php esc_html_e('To step the One Login Business theme follow the below steps.','one-login-business'); ?></p>

					<h4><?php esc_html_e('1. Setup Logo','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','one-login-business'); ?></a>

					<h4><?php esc_html_e('2. Setup Topbar','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Topbar Section >> Add your phone number and email address.','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=one_login_business_topbar') ); ?>" target="_blank"><?php esc_html_e('Add Topbar','one-login-business'); ?></a>

					<h4><?php esc_html_e('3. Setup Menus','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','one-login-business'); ?></a>

					<h4><?php esc_html_e('4. Setup Social Icons','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Social Media >> Add social links.','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=one_login_business_social_icons') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','one-login-business'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4. >> ','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','one-login-business'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer Text','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Footer Text >> Add copyright text. >> ','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=one_login_business_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','one-login-business'); ?></a>

					<h3><?php esc_html_e('Setup Home Page','one-login-business'); ?></h3>
					<p><?php esc_html_e('To step the home page follow the below steps.','one-login-business'); ?></p>

					<h4><?php esc_html_e('1. Setup Page','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates. >> Publish it.','one-login-business'); ?></p>
					<a class="dashboard_add_new_page button-primary"><?php esc_html_e('Add New Page','one-login-business'); ?></a>

					<h4><?php esc_html_e('2. Setup Slider','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','one-login-business'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Slider Settings >> Select post.','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=one_login_business_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Add Slider','one-login-business'); ?></a>

					<h4><?php esc_html_e('3. Setup Services','one-login-business'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','one-login-business'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Our Services >> Select post','one-login-business'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=one_login_business_service') ); ?>" target="_blank"><?php esc_html_e('Add Services Post','one-login-business'); ?></a>
				</div>
          	</div>
			<div class="col-md-3">
				<h3><?php echo esc_html(ONE_LOGIN_BUSINESS_THEME_NAME); ?></h3>
				<img class="one_login_business_img_responsive" style="width: 100%;" src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( ONE_LOGIN_BUSINESS_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'one-login-business'); ?></a>
					<a class="button-primary buynow" href="<?php echo esc_url( ONE_LOGIN_BUSINESS_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'one-login-business'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( ONE_LOGIN_BUSINESS_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'one-login-business'); ?></a>
					<hr>
				</div>
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
		</div>
	</div>

<?php }?>
