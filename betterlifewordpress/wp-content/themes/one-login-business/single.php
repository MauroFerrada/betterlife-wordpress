<?php
/**
 * The template for displaying all single posts
 * @subpackage One Login Business
 * @since 1.0
 */

get_header(); ?>

<?php
	$post_sidebar = get_option( 'one_login_business_single_post_sidebar' );
	if ( '1' == $post_sidebar ) {
	$column = 'col-lg-12 col-md-12';
	} else { 
	$column = 'col-lg-8 col-md-8';
	}
?>

<main id="content">
	<div class="container">
		<div class="content-area entry-content">
			<div id="main" class="site-main" role="main">
		       	<div class="row m-0">
		    		<div class="content_area <?php echo esc_html( $column ); ?>">
				    	<section id="post_section" class="">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/single-page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'one-login-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'one-login-business' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'one-login-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'one-login-business' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<?php if ( '1' != $post_sidebar ) {?>
						<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer();
