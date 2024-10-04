<?php
/**
 * Template part for displaying a message that posts cannot be found
 * @subpackage One Login Business
 * @since 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'one-login-business' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf(esc_html( 'Ready to publish your first post? Get started here.', 'one-login-business' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'one-login-business' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</section>