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
                <div class="col-md-6 content_main">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box_title">
                                <h2>
                                <?php// $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                                <?php /* If this is a category archive */ if (is_category()) { ?>
                                <?php echo single_cat_title(); ?>
                                <?php /* If this is a tag archive */
                                } elseif( is_tag() ) { ?>
                                <?php _e('Archive for the'); ?> <?php single_tag_title(); ?> Tag
                                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                                <?php _e('Archive for'); ?> <?php the_time('F jS, Y'); ?>
                                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                                <?php _e('Archive for'); ?> <?php the_time('F, Y'); ?>
                                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                                <?php _e('Archive for'); ?> <?php the_time('Y'); ?>
                                <?php /* If this is a search */ } elseif (is_search()) { ?>
                                <?php echo $wp_query->found_posts; ?> <?php _e('Search Results For'); ?> <span>" <?php the_search_query(); ?> "</span>
                                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                                <?php _e('Author Archive'); ?>
                                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                                <?php _e('Blog Archives'); ?>
                                <?php } ?>
                                </h2>
                            </div>

                            <!-- post content - horizone Box -->
                            <div class="list_post_content">
                            
                                <?php
                                if ( have_posts() ) :
                                    //run a loop count to get the first post
                                    $i = 0;
                                    // Start the Loop.
                                    while ( have_posts() ) : the_post();
                                ?>

                                <div class="list_single_post <?php  if ( get_previous_posts_link() == null && $i == 0 && !is_single() ){echo "list_first_post";} ?>" id="post-<?php the_ID(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <a class="thumb_content" href="<?php echo esc_url( get_permalink() ); ?>">
                                        <?php the_post_thumbnail("list-post-thumb"); ?>
                                        <span><?php  $category = get_the_category(); echo $category[0]->cat_name; ?></span>
                                    </a>
                                    <?php endif; ?>
                                    <div class="box_content">
                                        <a class="post_title" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
                                        <div class="post_info">
                                            <span class="post_time">On <?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></span>
                                            <span class="posted_in">In <?php the_category( ', ' ); ?></span>
                                        </div>
                                        <?php 
                                        if(is_single()){
                                            the_content(); 
                                        }else{
                                            excerpt(30);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <?php
                                    $i++;
                                    endwhile;
                                else :
                                    // If no content, include the "No posts found" template.
                                    get_template_part( 'content-error');
                                endif;
                                ?>

                                <div class="list_post_pagination">
                                    <?php newsflow_bootstrap_pagination(); ?>
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