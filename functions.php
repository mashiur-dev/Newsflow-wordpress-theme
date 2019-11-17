<?php

/**
 * News Flow functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package News_Flow
 */

if ( ! function_exists( 'newsflow_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newsflow_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on News Flow, use a find and replace
		 * to change 'newsflow' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newsflow', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        add_image_size( 'list-post-thumb', 600, 350, true );
        add_image_size( 'headline-thumb', 600, 300, true );
        
        /************************************
        * register sidebar widget
        *************************************/
        if(function_exists('register_sidebar')){
            function tnewsflow_widgets_init() {
                //sidebar right
                register_sidebar( 
                    array(
                    'name' => __( 'Sidebar Right', 'newsflow' ),
                    'id' => 'nf_sidebar_1',
                    'description' => __( 'This widgets will be shown on the right sidebar.', 'newsflow' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="box_title"><h2>',
                    'after_title'   => '</h2></div>',
                    )
                );
                //footer widget
                register_sidebar(
                    array(
                    'name' => __( 'Sidebar Right Bottom', 'newsflow' ),
                    'id' => 'nf_sidebar_5',
                    'description' => __( 'This widgets will be shown on the right sidebar bottom.', 'newsflow' ),
                    'before_widget' => '<div id="%1$s" class="list_item widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>',
                    )
                );
                //sidebar middle
                register_sidebar( 
                    array(
                    'name' => __( 'Sidebar Middle', 'newsflow' ),
                    'id' => 'nf_sidebar_2',
                    'description' => __( 'This widgets will be shown on the midddle sidebar.', 'newsflow' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="box_title"><h2>',
                    'after_title'   => '</h2></div>',
                    )
                );
                //footer widget
                register_sidebar( 
                    array(
                    'name' => __( 'Footer Widget 1', 'newsflow' ),
                    'id' => 'nf_sidebar_3',
                    'description' => __( 'This widgets will be shown on the footer.', 'newsflow' ),
                    'before_widget' => '<div id="%1$s" class="list_item widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>',
                    )
                );
                //footer widget
                register_sidebar(
                    array(
                    'name' => __( 'Footer Widget 2', 'newsflow' ),
                    'id' => 'nf_sidebar_4',
                    'description' => __( 'This widgets will be shown on the footer.', 'newsflow' ),
                    'before_widget' => '<div id="%1$s" class="list_item widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>',
                    )
                );
            }
            
            add_action( 'widgets_init', 'tnewsflow_widgets_init' );
        }
        
        
        
        /************************************
        * register nav menu with callback 
        *************************************/
        function newsflow_register_main_menu() {
            register_nav_menu( 'newsflow-main-menu', 'Main Menu');
            register_nav_menu( 'newsflow-top-but-menu', 'Secondary Menu');
        } 
        add_action('init', 'newsflow_register_main_menu');
        
        // Default menu
        function newsflow_default_main_menu() {
            echo '<ul class="main_menu notlist">';
            if ('page' != get_option('show_on_front')) {
                echo '<li><a href="'. home_url() . '/"><i class="fa fa-home"></i> Home</a></li>';
            }
            wp_list_pages('title_li=');
                echo '</ul>';
        }
        
        
        /************************************
        * add home link to begining of the nav
        *************************************/
        function nf_add_home_to_wp_menu( $items, $args ) {

            $new_links = array();

            $label = '<i class="fa fa-home"></i> Home';    // add your custom menu item content here

            // Create a nav_menu_item object
            $item = array(
                'title'            => $label,
                'menu_item_parent' => 0,
                'ID'               => '',
                'db_id'            => '',
                'url'              => home_url(),
                'classes'          => array( 'menu-item', 'home-link' )
            );

            $new_links[] = (object) $item; // Add the new menu item to our array

            // insert item
            $location = 0;   // insert at 3rd place
            array_splice( $items, $location, 0, $new_links );

            return $items;
        }
        add_filter( 'wp_nav_menu_objects', 'nf_add_home_to_wp_menu', 10, 2 );
        
        /************************************
        * add minimize system to menu base on width
        *************************************/
        function nf_add_minimize_to_wp_menu ( $items, $args ) {
            if( 'newsflow-main-menu' === $args -> theme_location ) {
            $items .= '<li class="more hidden_more" data-width="150"><a href="#">More</a><ul></ul></li>';

            }
        return $items;
        }
        add_filter('wp_nav_menu_items','nf_add_minimize_to_wp_menu',10,2);
        

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newsflow_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
        
        
        /************************************
        * create some regular cats
        *************************************/
        // Create the Headline category
        
        if ( term_exists( 'topnews', 'category' ) == 0 && term_exists( 'topnews', 'category' ) == null ) {
            wp_insert_category(
                array(
                'cat_name' => 'Top News - Slider', 
                'category_description' => 'Add all headline news here, Will show on the home page slider',
                'category_nicename' => 'topnews',
                //'category_parent' => ''
                )
            );
        }
        // Create the Breaking category
        if ( term_exists( 'breaking', 'category' ) == 0 && term_exists( 'breaking', 'category' ) == null ) {
            wp_insert_category(
                array(
                'cat_name' => 'Breaking', 
                'category_description' => 'Add all Breaking news here',
                'category_nicename' => 'breaking',
                //'category_parent' => ''
                )
            );
        }
        // Create the Breaking category
        if ( term_exists( 'sponsored', 'category' ) == 0 && term_exists( 'sponsored', 'category' ) == null ) {
            wp_insert_category(
                array(
                'cat_name' => 'Sponsored News', 
                'category_description' => 'Add all Sponsored news',
                'category_nicename' => 'sponsored'
                )
            );
        }
        
        
        /************************************
        * excerpt with numbers read more..
        *************************************/
        /*$excerpt = implode(" ",$excerpt).".... <a href='" .get_permalink($post->ID) ." ' class='".readmore."'>Read
        More</a>";*/
        function excerpt($num) {
        $limit = $num+1;
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt)."....";
        echo $excerpt;
        }
        
        function newsflow_excerpt_length( $length ) {
            return 20;
        }
        add_filter( 'excerpt_length', 'newsflow_excerpt_length', 999 );
        
        function newsflow_custom_excerpt_more( $more ) {
            return '.....';
        }
        add_filter( 'excerpt_more', 'newsflow_custom_excerpt_more', 999 );
        
        
        /************************************
        * add post view count meta to single post page
        *************************************/
        function nfwp_set_post_views($postID) {
            $count_key = 'nfwp_post_views_count';
            $count = get_post_meta($postID, $count_key, true);
            if($count==''){
                $count = 0;
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
            }else{
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
        }
        //To keep the count accurate, lets get rid of prefetching
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        
        //add tracker to single post
        function nfwp_track_post_views ($post_id) {
            if ( !is_single() ) return;
            if ( empty ( $post_id) ) {
                global $post;
                $post_id = $post->ID;    
            }
            nfwp_set_post_views($post_id);
        }
        add_action( 'wp_head', 'nfwp_track_post_views');
        
	}
endif;
add_action( 'after_setup_theme', 'newsflow_setup' );



/**
 * Enqueue scripts and styles.
 */
function newsflow_enqeues() {
	wp_enqueue_style('robotocon-opensanse-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600|Roboto+Condensed:300,400,700', array(), '1.0', 'all');
	//wp_enqueue_style('newsflow-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
	wp_enqueue_style('newsflow-font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css', array(), '4.7.0', 'all');
    //wp_enqueue_style('newsflow-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all');
    wp_enqueue_style('newsflow-bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css', array(), '3.3.7', 'all');
	wp_enqueue_style('newsflow-style', get_stylesheet_uri() );
	wp_enqueue_style('newsflow-main-style', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
	wp_enqueue_style('newsflow-responsive-style', get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all');

	wp_enqueue_script('jquery');
	wp_enqueue_script('newsflow-google-translte', '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', array(), '20120206', true);
	wp_enqueue_script('newsflow-bootstrapjs', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '20120207', true);
	wp_enqueue_script('newsflow-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '20120208', true);
	wp_enqueue_script('newsflow-main', get_template_directory_uri() . '/js/main.js', array(), '20120209', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsflow_enqeues' );


function newsflow_inline_enqeues(){ ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<?php }

add_action( 'wp_head', 'newsflow_inline_enqeues' );



/*
 * custom pagination with bootstrap .pagination class
 * source: http://www.ordinarycoder.com/paginate_links-class-ul-li-bootstrap/
 */
function newsflow_bootstrap_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('<span aria-hidden="true">&laquo;</span>'),
			'next_text'    => __('<span aria-hidden="true">&raquo;</span>'),
		)
	);

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

		$pagination = '<nav aria-label="Page navigation"><ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= "<li>$page</li>";
		}

		$pagination .= '</ul></nav>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}

/*************************************
 * custom postbox shortcode for home - horizon
 *****************************************/
function newsflow_postbox_horizon($atts){
    extract( shortcode_atts( array(
        'count' => 4,
        'post_cat' => '',
        
        
    ), $atts) );
    $i = 0;
    $get_cat = get_category_by_slug($post_cat);
    $nfcsquery = new WP_Query(
        array(
            'cat'  => $get_cat->cat_ID,
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'order'          => 'DESC',
        )
    );
    
    ?>
    <div class="row horizon_box box_wrap">
        <div class="col-md-12">
            <div class="box_title">
                <h2><?php echo $post_cat; ?></h2>
                <a href="<?php echo esc_url( get_category_link($get_cat->cat_ID) ); ?>">View All</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <?php
            $i = 0; // post counter
            $ids = array(); // post ids
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
    
    
<?php
    wp_reset_query();
}
add_shortcode('pbox_horizon', 'newsflow_postbox_horizon');


/*************************************
 * custom postbox shortcode for home - vertical
 *****************************************/
function newsflow_postbox_vertical($atts){
    extract( shortcode_atts( array(
        'count' => 4,
        'post_cat_one' => '',
        'post_cat_two' => '',
    ), $atts) );
    
    ?>
    
    <!-----------------------------
    vertical Box 
    ------------------------------>
    <div class="row vertical_box">
        <!-- Relationships - vertical Box -->
        <?php 
        $get_cat_1_exist = term_exists($post_cat_one, 'category');
        if ($get_cat_1_exist !== 0 && $get_cat_1_exist !== null):
        ?>
        <div class="col-md-6 col-sm-6 box_wrap">
            <?php $get_cat_1 = get_category_by_slug($post_cat_one); ?>
            <div class="box_title">
                <h2><?php echo $post_cat_one; ?></h2>
                <a href="<?php echo get_category_link($get_cat_1->cat_ID); ?>">View All</a>
            </div>
            

            <?php
            $args = array(
                'cat'  => $get_cat_1->cat_ID,
                'posts_per_page' => $count,
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'order'          => 'DESC',
            );
            $i = 0; // post counter
            $nfcsquery = new WP_Query( $args );
            if ( $nfcsquery->have_posts() ) :
            // Start the Loop.
            while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
            $id = get_the_ID();
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
        
        <?php else: ?>
        <h2>Wrong category slug for "post_cat_one", pls check!</h2>
        <?php endif; ?>
        
        
        <?php 
        $get_cat_2_exist = term_exists($post_cat_two, 'category');
        if ($get_cat_2_exist !== 0 && $get_cat_2_exist !== null):
        ?>
        <!-- Entertainment - vertical Box -->
        <div class="col-md-6 col-sm-6 box_wrap">
            <?php $get_cat_2 = get_category_by_slug($post_cat_two); ?>
            <div class="box_title">
                <h2><?php echo $post_cat_two; ?></h2>
                <a href="<?php echo get_category_link($get_cat_2->cat_ID); ?>">View All</a>
            </div>
            <?php
            $args = array(
                'cat'  => $get_cat_2->cat_ID,
                'posts_per_page' => $count,
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'order'          => 'DESC',
            );
            $i = 0; // post counter
            $nfcsquery = new WP_Query( $args );
            if ( $nfcsquery->have_posts() ) :
            // Start the Loop.
            while ( $nfcsquery->have_posts() ) : $nfcsquery->the_post();
            $id = get_the_ID();
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
        <?php else: ?>
        <h2>Wrong category slug for "post_cat_two", pls check!</h2>
        <?php endif; ?>
    </div>
    
<?php
    wp_reset_query();
}
add_shortcode('pbox_vertical', 'newsflow_postbox_vertical');


/*************************************
 * custom postbox shortcode for home - vertical list
 *****************************************/
function newsflow_listbox_vertical($atts){
    extract( shortcode_atts( array(
        'count' => 4,
        'post_cat_one' => '',
        'post_cat_two' => '',
    ), $atts) );
    
    ?>
    <!-----------------------------
      vertical Box 
    ------------------------------>
    <div class="row vertical_box">
        <!-- entertainment - vertical Box -->
        <?php 
        $get_cat_1_exist = term_exists($post_cat_one, 'category');
        if ($get_cat_1_exist !== 0 && $get_cat_1_exist !== null):
        ?>
        <div class="col-md-6 col-sm-6 box_wrap">
            <?php $get_cat_1 = get_category_by_slug($post_cat_one); ?>
            <div class="box_title">
                <h2><?php echo $post_cat_one; ?></h2>
                <a href="<?php echo get_category_link($get_cat_1->cat_ID); ?>">View All</a>
            </div>
            <div class="single_box_list list_first_item_thumb">
                <ul>
                   <?php
                    $args = array(
                        'cat'  => $get_cat_1->cat_ID,
                        'posts_per_page' => $count,
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
        <?php else: ?>
        <h2>Wrong category slug for "post_cat_one", pls check!</h2>
        <?php endif; ?>
        
        
        
        <?php 
        $get_cat_2_exist = term_exists($post_cat_two, 'category');
        if ($get_cat_2_exist !== 0 && $get_cat_2_exist !== null):
        ?>
        <!-- City - vertical Box -->
        <div class="col-md-6 col-sm-6 box_wrap">
            <?php $get_cat_2 = get_category_by_slug($post_cat_two); ?>
            <div class="box_title">
                <h2><?php echo $post_cat_two; ?></h2>
                <a href="<?php echo get_category_link($get_cat_2->cat_ID); ?>">View All</a>
            </div>
            <div class="single_box_list list_first_item_thumb">
                <ul>
                   <?php
                    $args = array(
                        'cat'  => $get_cat_2->cat_ID,
                        'posts_per_page' => $count,
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
        <?php else: ?>
        <h2>Wrong category slug for "post_cat_two", pls check!</h2>
        <?php endif; ?>
    </div>
    
    
<?php
wp_reset_query();
}
add_shortcode('listbox', 'newsflow_listbox_vertical');




function newsflow_html_text_shortcode($atts, $content = null){
    extract( shortcode_atts( array(
        'count' => 4,
        'post_cat' => '',
    ), $atts) );
?>


<div class="row horizon_box box_wrap">
    <div class="col-md-12">
        <?php echo $content; ?>
    </div>
</div>


<?php
}
add_shortcode('html_text', 'newsflow_html_text_shortcode');



/*********************************************************
*Insert ads after second paragraph of single post content.
******************************************************/
 

/*global $newsflow_options;

function newsflow_insert_post_ads( $content ) {
     
    $ad_code = '<div>'. $newsflow_options['ad-in-post'] .'</div><br>';
 
    if ( is_single() && ! is_admin() ) {
        return newsflow_insert_after_paragraph( $ad_code, 2, $content );
    }
     
    return $content;
}
add_filter( 'the_content', 'newsflow_insert_post_ads' );
// Parent Function that makes the magic happen
  
function newsflow_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {
 
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }
 
        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }
     
    return implode( '', $paragraphs );
}*/


/*
Activate redux freamwork
*/
if(!class_exists("ReduxFrameworkPlugin")){
    require_once(get_template_directory()."/inc/plugins/redux-framework/redux-framework.php");
    require_once(get_template_directory()."/inc/newsflow-options.php");
}







?>