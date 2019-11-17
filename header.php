<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php if(is_front_page()) : ?>
    <title><?php bloginfo('name'); ?></title>
    <?php else: ?>
    <title><?php if(is_page() ||is_single() ){ ?> <?php wp_title(''); ?> | <?php }elseif( is_category() ||is_archive() ){?> Archives :: <?php  wp_title(''); ?> | <?php } bloginfo('name'); ?></title>
    <?php endif; ?>
    
    <?php wp_head(); 
    global $newsflow_options;
    ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1081709405175072";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!--<div id="preloader"> Preloader 
       <div class="spinner"></div>
    </div>-->
    <span id="scscrollto-top"></span><!-- Scroll to top -->
   <!-- Header Area -->
    <header class="header_area">
        <!-- Header Area -->
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 hidden-xs header_top_left">
                        <div class="col-md-9 col-sm-8">
                            <?php wp_nav_menu(array('theme_location' => 'newsflow-top-but-menu', 'menu_class' => 'notlist')); ?>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <p><?php the_time("l, j F"); ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 hidden-xs hidden-sm header_top_right">
                        <?php if(!empty($newsflow_options['facebook_link'])) : ?>
                        <div class="fb-like" data-href="<?php echo$newsflow_options['facebook_link']; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        <?php endif; ?>
                        <?php if(!empty($newsflow_options['twitter_link'])) : ?>
                        <a href="https://twitter.com/<?php echo $newsflow_options['twitter_link']; ?>" class="twitter-follow-button" data-show-screen-name="false" data-show-count="true">Follow @<?php echo $newsflow_options['twitter_link']; ?></a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Middle -->
        <div class="header_middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-8 col-xs-6">
                        <div class="site_logo">
                            <?php 
                                $newsflow_custom_logo_id = get_theme_mod( 'custom_logo' );
                                $newsflow_logoimage = wp_get_attachment_image_src( $newsflow_custom_logo_id, 'full' );
                            
                                if (  has_custom_logo() )  {
                                    echo '<a href="'. get_home_url().'"><img src="'. esc_url( $newsflow_logoimage[0] ) .'"></a>';
                                } else { ?>
                                    <a href="<?php echo get_home_url(); ?>"><h2><?php bloginfo('name'); ?></h2></a>
                                    <p><?php bloginfo( 'description' ); ?></p>
                                <?php }
                            ?>
                            
                            
                        </div>
                    </div>
                    <div class="visible-sm visible-xs col-sm-4 col-xs-6">
                        <form class="search_form search-form" role="search" method="GET" action="<?php echo home_url( '/' ); ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="..." value="<?php echo get_search_query(); ?>" name="s">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 hidden-sm hidden-xs">
                        <div class="nfcustom_ads">
                            <?php echo $newsflow_options['ad-header-right'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main nav menu -->
        <nav class="header_main_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="main_nav_wrap">
                            <?php
                            if ( function_exists('newsflow_default_main_menu') ) {
                                wp_nav_menu(array('theme_location' => 'newsflow-main-menu', 'menu_class' => 'main_menu notlist', 'fallback_cb' => 'newsflow_default_main_menu'));
                            }
                            else {
                                newsflow_default_main_menu();
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Header bottom -->
        <div class="header_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="news_ticker_translate">
                            <div class="col-md-9 col-sm-9 breaking_news_ticker">
                                <span class="breaking_news_arrow">Breaking news</span>
                                <div id="news_tickers">
                                    <ul>
                                        <?php
                                        $args = array(
                                            'cat'  => get_cat_ID('breaking'),
                                            'posts_per_page' => 10,
                                            'post_status'    => 'publish',
                                            'post_type'      => 'post',
                                            'order'          => 'DESC',
                                            'orderby'        => 'most_recent',
                                        );
                                        $nfcsquery = new WP_Query( $args );
                                        if ( $nfcsquery->have_posts() ) :
                                        // Start the Loop.
                                        while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                                        ?>
                                        
                                        <li><span><?php the_time('M j, g:i a') ?></span><a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank"><?php the_title(); ?></a></li>
                                        
                                        
                                        <?php
                                        endwhile;
                                        else :
                                        // If no content, include the "No posts found" template.
                                        wp_reset_postdata();
                                        endif;
                                        ?>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 hidden-xs">
                                <div id="newsflow_google_translate"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>