<?php get_header(); ?>
    <!-- Content Area -->
    <section class="content_area">
        <div class="container">
            <div class="row">
                
                <!--------------------------------
                ***** Content Section ****** 
                ---------------------------------->
                <div class="col-md-6 content_main">
                   
                    <!------------------------
                     Top news - HOME 
                    -------------------------->
                    <div class="row top_news_box">
                        <div class="col-md-12">
                            <div class="box_title">
                                <h2>Top News</h2>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="top_news_inner">
                                <!-- Carousel -->
                                <div id="carousel-top-news" class="carousel slide" data-interval="5000" data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php
                                        $args = array(
                                            'cat'  => get_cat_ID('topnews'),
                                            'posts_per_page' => 10,
                                            'post_status'    => 'publish',
                                            'post_type'      => 'post',
                                            'order'          => 'DESC',
                                            'orderby'        => 'rand',
                                            'meta_query' => array( 
                                                array(
                                                    'key' => '_thumbnail_id'
                                                ) 
                                            )
                                        );
                                        $i = 0; // post counter
                                        $nfcsquery = new WP_Query( $args );
                                        if ( $nfcsquery->have_posts() ) :
                                        // Start the Loop.
                                        while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                                        ?>
                                        
                                        <div class="item<?php if( $i == 0 ){ echo " active"; } ?>">
                                            <?php the_post_thumbnail("headline-thumb"); ?>
                                            <div class="overlay"></div>
                                            <div class="top_news_content">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>"><h1><?php the_title(); ?></h1></a>
                                                <p><?php excerpt("15"); ?></p>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        $i++;
                                        endwhile;
                                        else :
                                        // If no content, include the "No posts found" template.
                                        wp_reset_postdata();
                                        endif;
                                        ?>
                                        
                                    </div>
                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-top-news" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-top-news" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        
                                        <?php
                                        $x = 0;
                                        if ( $nfcsquery->have_posts() ) :
                                        // Start the Loop.
                                        while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                                        ?>
                                        
                                        <li data-target="#carousel-top-news" data-slide-to="<?php echo $x; ?>" class="<?php if($x == 0){echo "active"; } ?>"></li>
                                        
                                        <?php
                                        $x++;
                                        endwhile;
                                        else :
                                        // If no content, include the "No posts found" template.
                                        wp_reset_postdata();
                                        endif;
                                        ?>
                                        
                                        
                                    </ol>
                                </div> 
                                
                            </div>
                             
                        </div>
                    </div>
                    
                    <!-----------------------------
                       Politics - Horizon Box 
                    ------------------------------>
                    <div class="row horizon_box box_wrap">
                        <?php $get_cat = get_cat_ID("politics"); ?>
                        
                        <div class="col-md-12">
                            <div class="box_title">
                                <h2>Politics</h2>
                                <a href="<?php  echo get_category_link($get_cat) ?>">View All</a>
                            </div>
                        </div>
                        
                        <?php
                        $args = array(
                            'cat'  => $get_cat,
                            'posts_per_page' => 4,
                            'post_status'    => 'publish',
                            'post_type'      => 'post',
                            'order'          => 'DESC',
                            //'orderby'        => 'most_recent',
                        );
                        ?>
                        
                        <div class="col-md-6 col-sm-6">
                            <?php
                            $i = 0; // post counter
                            $ids = array(); // post ids
                            $nfcsquery = new WP_Query( $args );
                            if ( $nfcsquery->have_posts() ) :
                            // Start the Loop.
                            while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                            ?>
                            <?php  if($i == 0) { ?>
                            <div class="single_box_big">
                                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail("headline-thumb"); ?></a>
                                <div class="box_content">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php echo the_title(); ?></h2></a>
                                    <p><?php excerpt("15"); ?></p>
                                </div>
                            </div>
                            <?php } else {
                                array_push( $ids, get_the_ID() );
                            
                            }?>
                            
                            <?php
                            $i++;
                            endwhile;
                            else :
                            // If no content, include the "No posts found" template.
                            wp_reset_postdata();
                            endif;
                            ?>
                            
                        </div>
                        
                        <div class="col-md-6 col-sm-6">
                            <?php foreach($ids as $id): ?>
                            <div class="single_box_small">
                                <div class="media">
                                  <?php if ( has_post_thumbnail($id) ) : ?>
                                  <div class="media-left">
                                    <a href="<?php echo esc_url( get_permalink($id) ); ?>">
                                      <img class="media-object" src="<?php echo esc_url(get_the_post_thumbnail_url($id,'headline-thumb')); ?>" alt="">
                                    </a>
                                  </div>
                                  <?php endif; ?>
                                  <div class="media-body box_content">
                                    <a href="<?php echo esc_url( get_permalink($id) ); ?>">
                                        <h2 class="media-heading"><?php echo the_title($id); ?></h2>
                                    </a>
                                  </div>
                                </div>
                            </div>
                            <?php 
                            endforeach; 
                            $ids = 0;
                            ?>
                        </div>
                        
                    </div>
                    
                    <!-----------------------------
                      Sports - Horizon Box
                    ------------------------------>
                    <div class="row horizon_box box_wrap">
                        <?php $get_cat = get_cat_ID("business"); ?>
                        
                        <div class="col-md-12">
                            <div class="box_title">
                                <h2>Business</h2>
                                <a href="<?php  echo get_category_link($get_cat) ?>">View All</a>
                            </div>
                        </div>
                        
                        
                        <?php
                        $args = array(
                            'cat'  => $get_cat,
                            'posts_per_page' => 4,
                            'post_status'    => 'publish',
                            'post_type'      => 'post',
                            'order'          => 'DESC',
                            //'orderby'        => 'most_recent',
                        );
                        ?>
                        
                        <div class="col-md-6 col-sm-6">
                            <?php
                            $i = 0; // post counter
                            $ids = array(); // post ids
                            $nfcsquery = new WP_Query( $args );
                            if ( $nfcsquery->have_posts() ) :
                            // Start the Loop.
                            while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                            ?>
                            <?php  if($i == 0) { ?>
                            <div class="single_box_big">
                                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail("headline-thumb"); ?></a>
                                <div class="box_content">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php echo the_title(); ?></h2></a>
                                    <p><?php excerpt("15"); ?></p>
                                </div>
                            </div>
                            <?php } else {
                                array_push( $ids, get_the_ID() );
                            
                            }?>
                            
                            <?php
                            $i++;
                            endwhile;
                            else :
                            // If no content, include the "No posts found" template.
                            wp_reset_postdata();
                            endif;
                            ?>
                            
                        </div>
                        
                        <div class="col-md-6 col-sm-6">
                            <?php foreach($ids as $id): ?>
                            <div class="single_box_small">
                                <div class="media">
                                  
                                  <?php if ( has_post_thumbnail($id) ) : ?>
                                  <div class="media-left">
                                    <a href="<?php echo esc_url( get_permalink($id) ); ?>">
                                      <img class="media-object" src="<?php echo esc_url(get_the_post_thumbnail_url($id,'headline-thumb')); ?>" alt="">
                                    </a>
                                  </div>
                                  <?php endif; ?>
                                  <div class="media-body box_content">
                                    <a href="<?php echo esc_url( get_permalink($id) ); ?>">
                                        <h2 class="media-heading"><?php echo the_title($id); ?></h2>
                                    </a>
                                  </div>
                                </div>
                            </div>
                            <?php 
                            endforeach; 
                            $ids = 0;
                            ?>
                        </div>
                    </div>
                    
                    <!-----------------------------
                    vertical Box 
                    ------------------------------>
                    <div class="row vertical_box">
                        <!-- Relationships - vertical Box -->
                        <div class="col-md-6 col-sm-6 box_wrap">
                            <?php $get_cat = get_cat_ID("sports"); ?>
                            
                            <div class="box_title">
                                <h2>Sports</h2>
                                <a href="<?php  echo get_category_link($get_cat) ?>">View All</a>
                            </div>
                            
                            <?php
                            $args = array(
                                'cat'  => $get_cat,
                                'posts_per_page' => 4,
                                'post_status'    => 'publish',
                                'post_type'      => 'post',
                                'order'          => 'DESC',
                            );
                            $i = 0; // post counter
                            $nfcsquery = new WP_Query( $args );
                            if ( $nfcsquery->have_posts() ) :
                            // Start the Loop.
                            while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                            ?>
                            
                            <?php if($i == 0) : ?>
                            <div class="single_box_big">
                                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail("headline-thumb"); ?></a>
                                <div class="box_content">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php echo the_title($id); ?></h2></a>
                                    <p><?php excerpt("15"); ?></p>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="single_box_small">
                                <div class="media">
                                  <?php if ( has_post_thumbnail($id) ) : ?>
                                  <div class="media-left">
                                    <a href="<?php echo esc_url( get_permalink($id) ); ?>">
                                      <img class="media-object" src="<?php echo esc_url(get_the_post_thumbnail_url($id,'headline-thumb')); ?>" alt="">
                                    </a>
                                  </div>
                                  <?php endif; ?>
                                  <div class="media-body box_content">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                        <h2 class="media-heading"><?php echo the_title($id); ?></h2>
                                    </a>
                                  </div>
                                </div>
                            </div>
                            <?php
                            endif;
                            
                            $i++;
                            endwhile;
                            else :
                            // If no content, include the "No posts found" template.
                            wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                        
                        <!-- Entertainment - vertical Box -->
                        <div class="col-md-6 col-sm-6 box_wrap">
                            <?php $get_cat = get_cat_ID("relationships"); ?>
                            <div class="box_title">
                                <h2>Relationship</h2>
                                <a href="<?php  echo get_category_link($get_cat) ?>">View All</a>
                            </div>
                            <?php
                            $args = array(
                                'cat'  => $get_cat,
                                'posts_per_page' => 4,
                                'post_status'    => 'publish',
                                'post_type'      => 'post',
                                'order'          => 'DESC',
                            );
                            $i = 0; // post counter
                            $nfcsquery = new WP_Query( $args );
                            if ( $nfcsquery->have_posts() ) :
                            // Start the Loop.
                            while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                            ?>
                            
                            <?php if($i == 0) : ?>
                            <div class="single_box_big">
                                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail("headline-thumb"); ?></a>
                                <div class="box_content">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php echo the_title($id); ?></h2></a>
                                    <p><?php excerpt("15"); ?></p>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="single_box_small">
                                <div class="media">
                                  <?php if ( has_post_thumbnail($id) ) : ?>
                                  <div class="media-left">
                                    <a href="<?php echo esc_url( get_permalink($id) ); ?>">
                                      <img class="media-object" src="<?php echo esc_url(get_the_post_thumbnail_url($id,'headline-thumb')); ?>" alt="">
                                    </a>
                                  </div>
                                  <?php endif; ?>
                                  <div class="media-body box_content">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                        <h2 class="media-heading"><?php echo the_title($id); ?></h2>
                                    </a>
                                  </div>
                                </div>
                            </div>
                            <?php
                            endif;
                            
                            $i++;
                            endwhile;
                            else :
                            // If no content, include the "No posts found" template.
                            wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    
                    
                    <!-----------------------------
                      vertical Box 
                    ------------------------------>
                    <div class="row vertical_box">
                        <!-- Business - vertical Box -->
                        <div class="col-md-6 col-sm-6 box_wrap">
                            <?php $get_cat = get_cat_ID("entertainment"); ?>
                            <div class="box_title">
                                <h2>Entertainment</h2>
                                <a href="<?php  echo get_category_link($get_cat) ?>">View All</a>
                            </div>
                            <div class="single_box_list list_first_item_thumb">
                                <ul>
                                   <?php
                                    $args = array(
                                        'cat'  => $get_cat,
                                        'posts_per_page' => 4,
                                        'post_status'    => 'publish',
                                        'post_type'      => 'post',
                                        'order'          => 'DESC',
                                    );
                                    $nflistpost = new WP_Query($args);
                                    $i = 0;
                                    while ( $nflistpost->have_posts() ) : $nflistpost->the_post(); ?>

                                    <?php if($i == 0) : ?>
                                    
                                    <li>
                                        <?php the_post_thumbnail("list-post-thumb") ?>
                                        <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
                                        <p><?php excerpt(20); ?></p>
                                    </li>
                                    
                                    <?php endif; ?>
                                    
                                    <li><a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a></li>
                                    <?php
                                    $i++;
                                    endwhile;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- City - vertical Box -->
                        <div class="col-md-6 col-sm-6 box_wrap">
                            <?php $get_cat = get_cat_ID("health"); ?>
                            <div class="box_title">
                                <h2>Health</h2>
                                <a href="<?php  echo get_category_link($get_cat) ?>">View All</a>
                            </div>
                            <div class="single_box_list list_first_item_thumb">
                                <ul>
                                   <?php
                                    $args = array(
                                        'cat'  => $get_cat,
                                        'posts_per_page' => 4,
                                        'post_status'    => 'publish',
                                        'post_type'      => 'post',
                                        'order'          => 'DESC',
                                    );
                                    $nflistpost = new WP_Query($args);
                                    $i = 0;
                                    while ( $nflistpost->have_posts() ) : $nflistpost->the_post(); ?>

                                    <?php if($i == 0) : ?>
                                    
                                    <li>
                                        <?php the_post_thumbnail("list-post-thumb") ?>
                                        <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
                                        <p><?php excerpt(20); ?></p>
                                    </li>
                                    
                                    <?php endif; ?>
                                    
                                    <li><a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a></li>
                                    <?php
                                    $i++;
                                    endwhile;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <?php do_shortcode('[snowreports post_cat="business"]'); ?>
                    
                    
  
                </div>
                
                <!--------------------------------
                *****Content sidebar first ****** 
                ---------------------------------->
                <?php echo get_sidebar(); ?>
                
            </div>
        </div>
    </section>
    <!-----------------------------
      Footer area
    ------------------------------>
<?php get_footer(); ?>