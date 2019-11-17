<!--------------------------------
*****Content sidebar first ****** 
---------------------------------->

<div class="col-md-3 content_side_first">
    <!-----------------------------
      Latest news - sidebar Box 
    ------------------------------>
    <div class="sidebar_latest_news">
        <div class="box_title">
            <h2>Latest News</h2>
        </div>
        <div class="single_box_list sidebar_count_arrow">
            <ul>
                <?php
                $args = array(
                    'posts_per_page' => 12,
                    'post_status'    => 'publish',
                    'post_type'      => 'post',
                    'orderby'        => 'most_recent',
	                'order'          => 'DESC',
                    //'offset'         => 1,
                    'ignore_sticky_posts' => true,
                    
                );
                $nfcsquery = new WP_Query( $args );
                if ( $nfcsquery->have_posts() ) :
                // Start the Loop.
                while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                ?>
                
                <li><a href="<?php echo esc_url( get_permalink() ); ?>"><h2><span><?php if( strtotime( $post->post_date ) > strtotime(date( 'Y-m-d' )) ){ the_time('g:i a'); }else{ the_time('M j'); } ?></span><?php the_title(); ?></h2></a></li>
                
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

    <!-----------------------------
      sidebar - ads Box 
    ------------------------------>
    <div class="visible-md visible-lg sidebar_ads">
        <img src="https://placeimg.com/300/300/arch" alt="">
    </div>
    <!-- sidebar:: nf_sidebar_2-->
    <?php
    if ( is_active_sidebar( 'nf_sidebar_2' ) ) {
        dynamic_sidebar( 'nf_sidebar_2' );
    }
    ?>

    <!-----------------------------
      Sponsored - sidebar Box 
    ------------------------------>
    <div class="sidebar_sponsored_news">
        <?php $get_cat = get_category_by_slug("sponsored"); ?>
        <div class="box_title">
            <h2>sponsored</h2>
            <a href="<?php  echo get_category_link($get_cat->cat_ID); ?>">View All</a>
        </div>
        <div class="single_box_list list_first_item_thumb">
            <ul>
               <?php
                $args = array(
                    'cat'  => $get_cat->cat_ID,
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'post_type'      => 'post',
                    'order'          => 'DESC',
                    //'ignore_sticky_posts' => true,
                );
                
                $nftrending = new WP_Query( $args );
                $i = 0;
                if ( $nfcsquery->have_posts() ) :
                while ( $nftrending->have_posts() ) : $nftrending->the_post(); ?>
                
                <?php if($i == 0) : ?>
                <li>
                    <?php the_post_thumbnail("list-post-thumb") ?>
                    <!--<img src="http://via.placeholder.com/300x100/eee/111" alt="">-->
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
                    <p><?php excerpt(20); ?></p>
                </li>
                <?php endif; ?>
                <li><a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a></li>
                
                <?php
                $i++;
                endwhile;
                else :
                // If no content, include the "No posts found" template.
                wp_reset_postdata();
                endif;
                ?>
                
            </ul>
        </div>
    </div>



</div>

<!--------------------------------
*****Content sidebar second ****** 
---------------------------------->
<div class="col-md-3 content_side_second">

    <!-----------------------------
      Social Networks links - sidebar Box 
    ------------------------------>
    <div class="sidebar_search hidden-xs hidden-sm">
        <div class="box_title">
            <h2>Search</h2>
        </div>
        <form class="search_form search-form" role="search" method="GET" action="<?php echo home_url( '/' ); ?>">
            <div class="input-group">
                <input type="text" class="form-control" aria-label="..." value="<?php echo get_search_query(); ?>" name="s">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>


    <!-----------------------------
      Social Networks links - sidebar Box 
    ------------------------------>
    <?php
    global $newsflow_options;
    ?>
    <div class="sidebar_social_list">
        <div class="box_title">
            <h2>Connect with us</h2>
        </div>
        <ul>
            <?php if(!empty($newsflow_options['facebook_link'])) : ?>
            <li class="facebook"><a href="<?php echo $newsflow_options['facebook_link'] ?>" target="_blank"><i class="fa fa-facebook"></i><span>Like</span></a></li>
            <?php endif; ?>
            <?php if(!empty($newsflow_options['twitter_link'])) : ?>
            <li class="twitter"><a href="https://twitter.com/<?php echo $newsflow_options['twitter_link']; ?>" target="_blank"><i class="fa fa-twitter"></i><span>Follow</span></a></li>
            <?php endif; ?>
            <?php if(!empty($newsflow_options['google_link'])) : ?>
            <li class="google-plus"><a href="<?php echo $newsflow_options['google_link'] ?>" target="_blank"><i class="fa fa-google-plus"></i><span>Follow</span></a></li>
            <?php endif; ?>
            <?php if(!empty($newsflow_options['youtube_link'])) : ?>
            <li class="youtube"><a href="<?php echo $newsflow_options['youtube_link'] ?>" target="_blank"><i class="fa fa-youtube"></i><span>Subscribe</span></a></li>
            <?php endif; ?>
            <?php if(!empty($newsflow_options['linkedin_link'])) : ?>
            <li class="linkedin"><a href="<?php echo $newsflow_options['linkedin_link'] ?>" target="_blank"><i class="fa fa-linkedin"></i><span>Follow</span></a></li>
            <?php endif; ?>
            <?php if(!empty($newsflow_options['pinterest_link'])) : ?>
            <li class="pinterest"><a href="<?php echo $newsflow_options['pinterest_link'] ?>" target="_blank"><i class="fa fa-pinterest"></i><span>Follow</span></a></li>
            <?php endif; ?>
        </ul>

    </div>
    
    <!-- sidebar:: nf_sidebar_1-->
    <?php
    if ( is_active_sidebar( 'nf_sidebar_1' ) ) {
        dynamic_sidebar( 'nf_sidebar_1' );
    }
    ?>
    
    <!-----------------------------
      Most Commented news - sidebar Box 
    ------------------------------>
    <div class="sidebar_mostcommonted_news">
        <div class="box_title">
            <h2>Most Commented</h2>
        </div>
        <div class="single_box_list sidebar_count_arrow">
            <ul>
                <?php
                $args = array(
                    'posts_per_page' => 10,
                    'post_status'    => 'publish',
                    'post_type'      => 'post',
                    'orderby'        => 'comment_count',
	                'order'          => 'DESC',
                    //'offset'         => 1,
                    'ignore_sticky_posts' => true,
                    
                );
                $nfcsquery = new WP_Query( $args );
                if ( $nfcsquery->have_posts() ) :
                // Start the Loop.
                while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
                ?>
                
                <li><a href="<?php echo esc_url( get_permalink() ); ?>"><h2><span><?php comments_number( 'no responses', '1', '%' ); ?></span> <?php the_title(); ?></h2></a></li>
                
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

    <!-----------------------------
      Trending news - sidebar Box 
    ------------------------------>
    <div class="sidebar_trending_news">
        <div class="box_title">
            <h2>Trending</h2>
        </div>
        <div class="single_box_list list_first_item_thumb">
            <ul>
                
                <?php 
                $nftrending = new WP_Query( 
                    array(
                        'posts_per_page' => 8,
                        'meta_key' => 'nfwp_post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'date_query' => array(
                            array(
                                'year' => date('Y') ,
                                'week' => date('W') ,
                            )
                        ),
                        'ignore_sticky_posts' => true,
                    )
                );
                $i = 0;
                while ( $nftrending->have_posts() ) : $nftrending->the_post(); ?>
                
                <?php if($i == 0) : ?>
                <li>
                    <?php the_post_thumbnail("list-post-thumb") ?>
                    <!--<img src="http://via.placeholder.com/300x100/eee/111" alt="">-->
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
    <!-- sidebar:: nf_sidebar_5-->
    <?php
    if ( is_active_sidebar( 'nf_sidebar_5' ) ) {
        dynamic_sidebar( 'nf_sidebar_5' );
    }
    ?>  
</div>