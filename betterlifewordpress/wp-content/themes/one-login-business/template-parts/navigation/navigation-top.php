<?php
/**
 * Displays top navigation
 *
 * @subpackage One Login Business
 * @since 1.0
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'one-login-business' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
			esc_html_e( 'Menu', 'one-login-business' );
		?>
	</button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>
	
</nav>