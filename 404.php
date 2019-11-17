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
                <div class="col-md-6 content_main error_404">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>404 Error&#58; Not Found</h2>
                            <p>Sorry, but the page you are trying to reach is unavailable or does not exist.</p>
                            <form class="search_form search-form" role="search" method="GET" action="<?php echo home_url( '/' ); ?>">
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="..." value="<?php echo get_search_query(); ?>" name="s">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
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