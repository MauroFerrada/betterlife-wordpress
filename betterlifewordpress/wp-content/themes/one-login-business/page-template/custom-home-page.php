<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>
<main id="content" class="middle-align">
   <?php if( get_option('one_login_business_hide_show',false) != '1'){ ?>
    <section id="slider1">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $one_login_business_pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'one_login_business_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $one_login_business_pages[] = $mod;
            }
          }
          if( !empty($one_login_business_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $one_login_business_pages,
              'orderby' => 'post__in',
               'meta_query' => array(
                  array(
                   'key' => '_thumbnail_id',
                   'compare' => 'EXISTS'
                  ),
              )
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <a href="<?php the_permalink(); ?>"><img src="<?php echo (the_post_thumbnail_url('full')); ?>"/></a>
              <div class="carousel-caption">
                <div class="inner_carousel slider-inner">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                  <p><?php $one_login_business_excerpt = get_the_excerpt(); echo esc_html( one_login_business_string_limit_words( $one_login_business_excerpt, 35 )); ?></p>
                  <div class="more-btn">              
                    <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','one-login-business'); ?><i class="fas fa-angle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-angle-left"></i></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-angle-right"></i></span>
        </a>
      </div>   
      <div class="clearfix"></div>
    </section>
  <?php }
  else{
    echo '<div class="gap_slider"></div>';
  } ?>

 <?php if( get_option('one_login_business_service_hide_show',false) != '1'){ ?>
  <?php if( get_theme_mod( 'one_login_business_our_services_title','' ) != ''|| get_theme_mod( 'one_login_business_category_setting','' ) != ''|| get_theme_mod( 'one_login_business_our_services_subtitle','' ) != '') { ?>
    <section id="our-services">
      <div class="container"> 
            <?php if( get_theme_mod('one_login_business_our_services_title') != ''){ ?>
              <h3><?php echo esc_html(get_theme_mod('one_login_business_our_services_title','')); ?></h3>
              <h5><?php echo esc_html(get_theme_mod('one_login_business_our_services_subtitle','')); ?></h5>
            <?php }?>
          <div class="row">
            <?php
            $catData1=  get_theme_mod('one_login_business_category_setting');if($catData1){
            $page_query = new WP_Query(array( 'category_name' => esc_html($catData1 ,'one-login-business')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>  
              	<div class="col-lg-3 col-md-3 ">
  	                <div class="service-box">
                      <img src="<?php echo (the_post_thumbnail_url('full')); ?>"/>
                      <div class="service-content">
                        <a href="<?php the_permalink(); ?>"><h4><?php the_title();?></h4></a><hr>
                        <p><?php the_excerpt(); ?></p>
                    	</div>
  	                </div>   
                  </div>   
                <?php endwhile; 
              wp_reset_postdata();
            }?>
          </div>
        <div class="clearfix"></div>
      </div>
    </section>
  <?php }?>
<?php }?>
</main>
<?php get_footer(); ?>