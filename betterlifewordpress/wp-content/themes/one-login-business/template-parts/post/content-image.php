<?php
/**
 * Template part for displaying posts
 * @subpackage One Login Business
 * @since 1.0
 */
?>
<?php
	$featured_image=one_login_business_get_attachment();	
?>
<div id="Category-section" class="entry-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="postbox smallpostimage">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<div class="box-content text-center">
		    	<?php echo ('<img src="'.$featured_image.'">'); ?>	
	        </div>
        	<div class="overlay">
        		<div class="date-box">
        			<?php if( get_option('one_login_business_date',false) != '1'){ ?>
        				<span><i class="far fa-calendar-alt"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
        			<?php }?>
        			<?php if( get_option('one_login_business_admin',false) != '1'){ ?>
        				<span class="entry-author"><i class="far fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
        			<?php }?>
        			<?php if( get_option('one_login_business_comment',false) != '1'){ ?>
      					<span class="entry-comments"><i class="fas fa-comments"></i> <?php comments_number( __('0 Comments','one-login-business'), __('0 Comments','one-login-business'), __('% Comments','one-login-business')); ?></span>
      				<?php }?>
    			</div>
        		
        	</div>
	      	<div class="clearfix"></div> 
	  	</div>
	</div>
</div>