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
                                <div class="thumb_content">
                                <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail("list-post-thumb");
                                }
                                ?>
                                </div>
                                <div class="box_content">
                                    <div class="post_content_inner">
                                        <?php  the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                endwhile;
                            else :
                                // If no content, include the "No posts found" template.
                                get_template_part( 'content-error');
                            endif;
                            ?>

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