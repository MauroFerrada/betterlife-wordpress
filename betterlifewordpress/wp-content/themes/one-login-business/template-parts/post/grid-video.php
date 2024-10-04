<?php
/**
 * Template part for displaying posts
 * @subpackage One Login Business
 * @since 1.0
 */
?>

<?php $post_option = get_theme_mod( 'one_login_business_grid_column','3_column');
    if($post_option == '1_column'){ ?>
    <div class="col-lg-12 col-md-12">
<?php }else if($post_option == '2_column'){ ?>
    <div class="col-lg-6 col-md-6">
<?php }else if($post_option == '3_column'){ ?>
    <div class="col-lg-4 col-md-4">
<?php }else if($post_option == '4_column'){ ?>
    <div class="col-lg-3 col-md-3">
<?php }else if($post_option == '5_column'){ ?>
    <div class="col-lg-2 col-md-2">
<?php }?>
<?php
  $video = one_login_business_get_media(array('video', 'object', 'embed', 'iframe'));
?>
	<div id="Category-section" class="entry-content">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="postbox smallpostimage">
				<h4><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title();?></a></h4>
				<?php
      			if ( ! is_single() ) {
        		// If not a single post, highlight the video file.
        			if ( ! empty( $video ) ) {
          				foreach ( $video as $video_html ) {
            				echo '<div class="entry-video">';
            				echo $video_html;
            				echo '</div>';
          				}
        			};
      			};
     			?>
	        	<div class="overlay">
	        		<div class="date-box">
	        			<?php if( get_option('one_login_business_date',false) != '1'){ ?>
	        			<span class=""><i class="far fa-calendar-alt"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
	        			<?php }?>
	        			<?php if( get_option('one_login_business_admin',false) != '1'){ ?>
	        			<span class="entry-author"><i class="far fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
	        			<?php }?>
	        			<?php if( get_option('one_login_business_comment',false) != '1'){ ?>
	      				<span class="entry-comments"><i class="fas fa-comments"></i> <?php comments_number( __('0 Comments','one-login-business'), __('0 Comments','one-login-business'), __('% Comments','one-login-business')); ?></span>
	      				<?php }?>
	    			</div>
	        		<p><?php the_excerpt();?></p>
	        	</div>
		      	<div class="clearfix"></div> 
		  	</div>
		</div>
	</div>
</div>