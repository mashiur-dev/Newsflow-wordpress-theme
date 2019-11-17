<footer class="footer_area">
        <div class="container">
            <div class="row hidden-xs hidden-sm">
                <div class="col-md-12 nfcustom_ads">
                    <?php
                    global $newsflow_options;
                    echo $newsflow_options['ad-at-footer'];
                    ?>
                </div>
            </div>
        </div>
        <!-----------------------------
          Footer top post list
          http://eisabainyo.net/weblog/2010/03/10/display-5-latest-posts-in-each-category-in-wordpress/
        ------------------------------>
        <div class="footer_top_postslist hidden-xs">
            <div class="container">
                <div class="row">
                   
                    <?php
                    $cat_args = array(
                      'orderby' => 'name',
                      'order' => 'ASC',
                      'child_of' => 0
                    );
                    $categories=get_categories($cat_args);
                    $rand_keys = array_rand($categories, 6); // 5 is the number of categories you want
                    foreach ($rand_keys as $key) {

                        $post_args = array(
                          'numberposts' => 1,
                          'category' => $categories[$key]->term_id 
                        );

                        $posts = get_posts($post_args);

                        foreach($posts as $post) {
                        ?>
                            <div class="col-md-2 col-sm-4">
                                <div class="single_box_big">
                                    <a class="thumb_content" href="">
                                        <?php the_post_thumbnail("list-post-thumb"); ?>
                                        <span><?php echo $categories[$key]->cat_name; ?></span>
                                    </a>
                                    <div class="box_content">
                                        <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>

        <!-----------------------------
          Footer Middle
        ------------------------------>
        <div class="footer_middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4"> 
                        <div class="footer_contact">
                            
                            <div class="footer_address_info">
                                <!-- sidebar:: nf_sidebar_3-->
                                <?php
                                if ( is_active_sidebar( 'nf_sidebar_3' ) ) {
                                    dynamic_sidebar( 'nf_sidebar_3' );
                                }
                                ?>
                            </div> 
                            
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <!-- sidebar:: nf_sidebar_4-->
                        <?php
                        if ( is_active_sidebar( 'nf_sidebar_4' ) ) {
                            dynamic_sidebar( 'nf_sidebar_4' );
                        }
                        ?>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="tags_item">
                            <ul>
                                <?php
                                $args = array( 
                                    'orderby'                  => 'name',
                                    'order'                    => 'ASC', 
                                    'public'                   => true,
                                ); 

                                $categories = get_categories( $args );

                                foreach ( $categories as $category ) {
                                     echo '<li><a href="' . get_category_link( $category ) . '">' . $category->name . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-----------------------------
          Footer bottom
        ------------------------------>
        <div class="footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="copyright_text">
                        <?php if(!empty($newsflow_options['footer-copyright'])){ echo $newsflow_options['footer-copyright']; } ?> <span>Developed With <i class="fa fa-heart-o"></i> by <a href="">StylishCreativity</a></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs">
                        <?php wp_nav_menu(array('theme_location' => 'newsflow-top-but-menu', 'menu_class' => 'footer_bottom_links notlist')); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>