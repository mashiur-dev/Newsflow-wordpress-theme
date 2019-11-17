<?php 
/**
 * Template Name: Home Template
 *
 * @package WordPress
 * @subpackage newsflow
 */

get_header(); 
?>
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
                    <div class="row hidden-xs hidden-sm">
                        <div class="col-md-12 nfcustom_ads">
                            <br>
                            <?php
                            echo $newsflow_options['ad-after-topnews'];
                            ?>
                        </div>
                    </div>
                    
                    <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                    ?>
                    
                    <?php the_content(); ?>
                    
                    <?php
                        endwhile;
                    else :
                        // If no content, include the "No posts found" template.
                        get_template_part( 'content-error');
                    endif;
                    ?>
                    
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