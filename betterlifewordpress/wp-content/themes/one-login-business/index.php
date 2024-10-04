<?php
/**
 * The main template file
 * @subpackage One Login Business
 * @since 1.0
 */

get_header(); ?>

<main id="content">
	<div class="container">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><span><?php single_post_title(); ?></span></h1>
			</header>
		<?php else : ?>
			<header class="page-header">
				<h2 class="page-title"><span><?php esc_html_e( 'Posts', 'one-login-business' ); ?></span></h2>
			</header>
		<?php endif; ?>

		<div class="content-area">
			<div id="main" class="site-main" role="main">		
		    	<div class="row m-0">				
					<?php
					get_template_part( 'template-parts/post/post-layout' );
					?>
				</div>	
			</div>
		</div>
	</div>
</main>

<?php get_footer();