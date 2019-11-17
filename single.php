<?php get_header(); ?>
    <!-- Content Area -->
    <!-- Page Content Area -->
    <section class="content_area">
        <div class="container">
            <div class="row">
                <!-- content -->
                <!--------------------------------
                ***** Content Section ****** 
                ---------------------------------->
                <div class="col-md-6 content_main single_post_content">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ( have_posts() ) :
                                // Start the Loop.
                                while ( have_posts() ) : the_post();
                            ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class( array( 'single_box_big')); ?>>
                                
                                <?php if ( has_post_thumbnail() ) { ?>
                                
                                <div class="thumb_content">
                                <?php the_post_thumbnail("list-post-thumb"); ?>
                                <span><?php  $category = get_the_category(); echo $category[0]->cat_name; ?></span>
                                </div>
                                
                                <?php } ?>
                                
                                <h2 class="post_title"><?php  the_title(); ?></h2>
                                <div class="post_info">
                                    <span class="post_time">On <?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></span>
                                    <span class="posted_in">In <?php the_category( ', ' ); ?></span>
                                    <span><a href="#comments">Comments</a></span>
                                </div>
                                <div class="box_content">
                                    <div class="post_content_inner">
                                        <?php  the_content(); ?>
                                    </div>
                                    
                                    <?php if(is_single()) : ?>
                                    <div class="single_post_social_share">
                                        <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="http://twitter.com/share?url=<?php echo esc_url( get_permalink() ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink() ); ?>&media=&description=<?php bloginfo('description'); ?>" class="pinterest"><i class="fa fa-pinterest"></i></a>
                                        <a href="http://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                            <?php
                                endwhile;
                            else :
                                // If no content, include the "No posts found" template.
                                get_template_part( 'content-error');
                                
                            endif;
                            ?>
                            
                            <?php if(is_single()) : ?>
                            <div class="row nextprev_post_nav">
                                <div class="col-md-6">
                                    <div class="alignleft">
                                        <?php 
                                        // previous_post_link('%link', 'Link text here', set TURE to get post from same cat);
                                        previous_post_link('%link', 'Previous Post', false); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alignright">
                                        <?php next_post_link('%link', 'Next Post', false); ?> 
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            
                            <!-- Random post from same category -->
                            <?php
                                //get current post $category
                                $category = get_the_category(); 
                            ?>
                            <div class="footer_top_postslist">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box_title">
                                            <h2>Similar News</h2>
                                            <p>Read more from <strong><?php echo $category[0]->cat_name; ?></strong></p>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    
                                    query_posts(array(
                                      'orderby' => 'rand', 
                                      'category_name' => $category[0]->cat_name, 
                                      'posts_per_page' => 3
                                    )); 
                                    if (have_posts()) : while (have_posts()) : the_post(); 
                                    ?>
                                    
                                    <div class="col-md-4 col-sm-4">
                                        <div class="single_box_big">
                                           
                                            <?php if ( has_post_thumbnail() ) : ?>
                                            <a class="thumb_content" href="<?php echo esc_url( get_permalink() ); ?>">
                                            <?php the_post_thumbnail("list-post-thumb"); ?>
                                            <span><?php echo $category[0]->cat_name; ?></span>
                                            </a>
                                            <div class="box_content">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>"> <h2><?php  the_title(); ?></h2> </a>
                                            </div>
                                            <?php else : ?>
                                            <div class="box_content">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>"> <h2><?php  the_title(); ?></h2> </a>
                                                <?php excerpt("10"); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    endwhile; 
                                    endif; 
                                    wp_reset_query(); 
                                    ?>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- sidebar -->
                <?php echo get_sidebar(); ?>
            </div>
        </div>
    </section>
    <!-----------------------------
      Footer area
    ------------------------------>
<?php get_footer(); ?>