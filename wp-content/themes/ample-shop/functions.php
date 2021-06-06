<?php
/**
 * Ample Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ample_Shop
 */

if ( ! function_exists( 'ample_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ample_shop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ample Shop, use a find and replace
		 * to change 'ample-shop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ample-shop' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ample-shop' ),
			'cat-id' => esc_html__( 'Categories Menu', 'ample-shop' ),
		) );

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

        add_image_size( 'ample-magazine-shop', 801, 801 );


        // Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ample_shop_custom_background_args', array(
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
	}
endif;
add_action( 'after_setup_theme', 'ample_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ample_shop_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ample_shop_content_width', 640 );
}
add_action( 'after_setup_theme', 'ample_shop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ample_shop_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar Widgets', 'ample-shop' ),
        'id'            => 'shop-widget',
        'description'   => esc_html__( 'Add widgets For Shop Front Page Area.', 'ample-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>'
    ) );

    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ample-shop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ample-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Section with No Sidebar  ', 'ample-shop' ),
		'id'            => 'home-sections-1',
		'description'   => esc_html__( 'Add  widgets here what you want in home widgets.', 'ample-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="head-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Section ', 'ample-shop' ),
		'id'            => 'home-sections',
		'description'   => esc_html__( 'Add  widgets here what you want in home widgets.', 'ample-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="head-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Section with No Sidebar  ', 'ample-shop' ),
		'id'            => 'home-sections-2',
		'description'   => esc_html__( 'Add  widgets here what you want in home widgets.', 'ample-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="head-title"><span>',
		'after_title'   => '</span></h3>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Area Section 1  ', 'ample-shop' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add  widgets here what you want in home widgets.', 'ample-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>'
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Area Section 2  ', 'ample-shop' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add  widgets here what you want in home widgets.', 'ample-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>'
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Area Section 3  ', 'ample-shop' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add  widgets here what you want in home widgets.', 'ample-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>'
    ) );

	
}
add_action( 'widgets_init', 'ample_shop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ample_shop_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri().'/assets/css/slick.css' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/assets/css/slick-theme.css' );
	wp_enqueue_style( 'owl.carousel.min', get_template_directory_uri().'/assets/css/owl.carousel.min.css' );
    wp_enqueue_style( 'owl.theme.default', get_template_directory_uri().'/assets/css/owl.theme.default.css' );
	wp_enqueue_style( 'owl.transitions', get_template_directory_uri().'/assets/css/owl.transitions.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri().'/assets/css/animate.css' );
	wp_enqueue_style( 'ample-shop-style', get_stylesheet_uri() );
    wp_enqueue_style( 'ample-shop-media', get_template_directory_uri().'/assets/css/media.css' );


    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '20151215', true );
    wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array('jquery'), '4.5.0' );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'ample-shop-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'ample-shop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ample-shop-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ample_shop_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

//File loader
require get_template_directory() . '/inc/file-loader.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}



if (!function_exists('ample_shop_widgets_backend_enqueue')) :
	function ample_shop_widgets_backend_enqueue($hook)
	{
		if ('widgets.php' != $hook) {
			return;
		}
		wp_register_script('ample-shop-custom-widgets', get_template_directory_uri() . '/assets/js/widgets.js', array('jquery'), true);
		wp_enqueue_media();
		wp_enqueue_script('ample-shop-custom-widgets');
		wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'ample-shop-style-admin', get_template_directory_uri() . '/assets/css/repeater-admin.css');
	}

	add_action('admin_enqueue_scripts', 'ample_shop_widgets_backend_enqueue');
endif;






/* =============================hook for breadcumb ==================================================*/

if (!function_exists('ample_shop_breadcrumb_type')) :

    function ample_shop_breadcrumb_type($post_id)
    {


        if (function_exists('bcn_display')) {


            ?>

            <div class="page-title">
                <div class="<?php $section_option_layout = ample_shop_get_option('ample_shop_site_layout_options');
                if($section_option_layout =='boxed'){ echo esc_attr('container'); }else{ echo esc_attr('container-fluid');} ?> ">


                    <?php
                    echo "<div class='breadcrumbs'><div id='cwp-breadcrumbs' class='cwp-breadcrumbs'>";
                    bcn_display();
                    echo "</div></div>";
                    ?>
                </div>
            </div>
            <?php
        }
    }
endif;

add_action('ample_shop_breadcrumb_type', 'ample_shop_breadcrumb_type', 10, 1);




/*add custom body class for sidebar section*/




/*for sidebar adding options**/

function ample_shop_names( $classes ) {
    // add 'class-name' to the $classes array
    $sidebardesignlayout = esc_attr( get_post_meta(get_the_ID(), 'ample_shop_sidebar_layout', true) );
    if (is_singular() && $sidebardesignlayout != "default-sidebar")
    {
        $sidebardesignlayout = esc_attr( get_post_meta(get_the_ID(), 'ample_shop_sidebar_layout', true) );

    } else
    {
        $sidebardesignlayout = esc_attr(ample_shop_get_option('ample_shop_sidebar_layout_option' ));
    }

    $classes[] = $sidebardesignlayout;
    return $classes;

}
add_filter( 'body_class', 'ample_shop_names' );





if (!function_exists('ample_shop_social_sharing')) :
    function ample_shop_social_sharing($post_id)
    {
        $ample_shop_url = get_the_permalink($post_id);
        $ample_shop_title = get_the_title($post_id);
        $ample_shop_image = get_the_post_thumbnail_url($post_id);

        //sharing url
        $ample_shop_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $ample_shop_title . '&url=' . $ample_shop_url);
        $ample_shop_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?url=' . $ample_shop_url);
        $ample_shop_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $ample_shop_url . '&media=' . $ample_shop_image . '&description=' . $ample_shop_title);
        $ample_shop_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $ample_shop_title . '&url=' . $ample_shop_url);

        ?>

        <ul class="post-share">
            <li><a  href="<?php echo esc_url($ample_shop_facebook_sharing_url); ?>" aria-label="<?php  esc_attr_e('Facebook','ample-shop');?>" ><i class="fa fa-facebook"></i></a></li>
            <li><a   href="<?php echo esc_url($ample_shop_twitter_sharing_url); ?>" aria-label="<?php esc_attr_e('Twitter','ample-shop');?>" ><i class="fa fa-twitter"></i></a></li>
            <li><a   href="<?php echo esc_url($ample_shop_pinterest_sharing_url); ?>" aria-label="<?php  esc_attr_e('Pintrest','ample-shop');?>" ><i class="fa fa-pinterest"></i></a></li>
            <li><a  href="<?php echo esc_url($ample_shop_linkedin_sharing_url); ?>" aria-label="<?php  esc_attr_e('Linkdin','ample-shop');?>" ><i class="fa fa-linkedin"></i></a></li>
        </ul>
        <?php
    }
endif;
add_action('ample_shop_social_sharing', 'ample_shop_social_sharing', 10);




/* =====adding menu last and first class==========*/
function ample_shop_first_and_last_menu_class($items) {
    $items[1]->classes[] = 'first-menu';
    $items[count($items)]->classes[] = 'last-menu';
    return $items;
}
add_filter('wp_nav_menu_objects', 'ample_shop_first_and_last_menu_class');


/*for description highlight in menu */
/**
 * Add arrows to menu items
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/add-arrows-to-menu-items/
 *
 * @param string $item_output, HTML output for the menu item
 * @param object $item, menu item object
 * @param int $depth, depth in menu structure
 * @param object $args, arguments passed to wp_nav_menu()
 * @return string $item_output
 */

if (!function_exists('ample_shop_add_menu_description')) :
    function ample_shop_add_menu_description( $item_output, $item, $depth, $args ) {

        if( 'menu-1' == $args->theme_location  && $item->description )
            $item_output = str_replace( '</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output );

        return $item_output;


    }
endif;
add_filter( 'walker_nav_menu_start_el', 'ample_shop_add_menu_description', 10, 4 );





/*theme activation plugins*/
require get_template_directory() . '/library/TGM/class-tgm-plugin-activation.php';
require get_template_directory() . '/library/TGM/plugin-slug.php';





/**
 * Run ajax request.
 */
if ( ! function_exists('ample_shop_wp_pages_plucker') ) :

    /**
     * Sending pages with ids
     */
    function ample_shop_wp_pages_plucker()
    {
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );

        $ids = wp_list_pluck( $pages, 'post_title', 'ID' );

        return wp_send_json($ids);
    }

endif;
add_action( 'wp_ajax_ample_shop_wp_pages_plucker', 'ample_shop_wp_pages_plucker' );
add_action( 'wp_ajax_nopriv_ample_shop_wp_pages_plucker', 'ample_shop_wp_pages_plucker' );


//admin notice loader
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin-notice/class-notice-handler.php';
}