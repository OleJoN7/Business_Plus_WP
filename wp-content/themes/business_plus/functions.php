<?php
/**
 * business_plus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package business_plus
 */

if (!function_exists('business_plus_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function business_plus_setup()
    {
        add_theme_support('custom-logo');
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on business_plus, use a find and replace
         * to change 'business_plus' to the name of your theme in all the template files.
         */
        load_theme_textdomain('business_plus', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'header-menu' => esc_html__('Primary', 'business_plus'),
            'footer-menu' => esc_html__( 'Footer menu', 'business_plus' ),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('business_plus_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'business_plus_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_plus_content_width()
{
    $GLOBALS['content_width'] = apply_filters('business_plus_content_width', 640);
}

add_action('after_setup_theme', 'business_plus_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_plus_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'business_plus'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'business_plus'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'business_plus_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function business_plus_scripts()
{

    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css', array(), false);

    wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/node_modules/font-awesome/css/font-awesome.min.css', array(), false);

    wp_enqueue_style('lightSlider-css', get_template_directory_uri() . '/node_modules/lightslider/dist/css/lightslider.min.css', array(), false);

    wp_enqueue_style('business_plus-style', get_stylesheet_uri());

    wp_enqueue_script('business_plus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), false);

    wp_enqueue_script('business_plus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), false);

    wp_enqueue_script('jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.min.js', array('jquery'), false);

    wp_enqueue_script('tether', get_template_directory_uri() . '/node_modules/tether/dist/js/tether.min.js', array(), false);

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array(), false);

    wp_enqueue_script('lightSlider-js', get_template_directory_uri() . '/node_modules/lightslider/dist/js/lightslider.min.js', array(), false);


    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), false);

}

add_action('wp_enqueue_scripts', 'business_plus_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//---------Control number of posts in different pages---

function custom_posts_per_page($query)
{
    if (is_home()) {
        $query->set('posts_per_page', 3);
    }
    if (is_search()) {
        $query->set('posts_per_page', 5);
    }
    if (is_archive()) {
        $query->set('posts_per_page', 5);
    }//endif
}

add_action('pre_get_posts', 'custom_posts_per_page');

//-----Control number of posts in different pages--END------

// ----- CUSTOMIZER--------------
// ------Customizer Panel--------

function business_blog_customize($wp_customize)
{

    $wp_customize->add_panel('Custom_Sections Changes', array(
        'title' => __('Custom_Sections Changes'),
        'description' => __('Custom_Sections Changes'),
        'priority' => 10,
    ));
// ------Customizer Panel ENd--------

//    ---------------CUSTOM Header------------------------------
    $wp_customize->add_section('Custom Header', array(
        'title' => __('Custom Header'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));

    $wp_customize->add_setting('custom-header-bg_settings');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom-header-bg_settings', array(
        'label' => __('Background Image'),
        'section' => 'Custom Header',
        'settings' => 'custom-header-bg_settings'
    )));

    //    ---------------CUSTOM Header END----------------------

//    -------------WELCOME SECTION-------------------------------

    $wp_customize->add_section('Welcome Section', array(
        'title' => __('Welcome Section'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));
    $wp_customize->add_setting('welcome-phone_settings', array(
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'welcome-phone_settings', array(
        'label' => __('Contact Phone'),
        'section' => 'Welcome Section',
        'settings' => 'welcome-slider-customtext_settings',
    )));
    $wp_customize->add_setting('welcome-slider-customtext_settings', array(
        'default' => 'Type Custom Text',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'welcome-slider-customtext_settings', array(
        'label' => __('Slider Custom Text'),
        'section' => 'Welcome Section',
        'settings' => 'welcome-slider-customtext_settings',
    )));

    $wp_customize->add_setting('welcome-bg_settings');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'welcome-bg_settings', array(
        'label' => __('Background Image'),
        'section' => 'Welcome Section',
        'settings' => 'welcome-bg_settings',
    )));

//    ----------ABOUT Section----------------------

    $wp_customize->add_section('About Section', array(
        'title' => __('About Section'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));
    $wp_customize->add_setting('about_title_settings', array(
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'about_title_settings', array(
        'label' => __('About Title'),
        'section' => 'About Section',
        'settings' => 'about_title_settings',
    )));
    $wp_customize->add_setting('about_subtitle_settings', array(
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'about_subtitle_settings', array(
        'label' => __('About SubTitle'),
        'section' => 'About Section',
        'settings' => 'about_subtitle_settings',
    )));
    $wp_customize->add_setting('about_article_settings', array(
        'default' => 'Type your text',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'about_article_settings', array(
        'label' => __('Text'),
        'section' => 'About Section',
        'settings' => 'about_article_settings',
        'type' => 'textarea'
    )));
    $wp_customize->add_setting('about_link_settings');

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'about_link_settings', array(
        'label' => __('About Page Link'),
        'section' => 'About Section',
        'settings' => 'about_link_settings',
        'type' => 'dropdown-pages'
    )));

    //    ----------ABOUT Section END----------------------

    //    ----------Services Section-----------------------
    $wp_customize->add_section('Services Section', array(
        'title' => __('Services Section'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('services_title_settings', array(
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'services_title_settings', array(
        'label' => __('Services Title'),
        'section' => 'Services Section',
        'settings' => 'services_title_settings',
    )));


    $wp_customize->add_setting('services_subtitle_settings', array(
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'services_subtitle_settings', array(
        'label' => __('Services SubTitle'),
        'section' => 'Services Section',
        'settings' => 'services_subtitle_settings',
    )));


    $wp_customize->add_setting('service_1', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'service_1', array(
        'label' => __('Service 1', 'businessplus'),
        'section' => 'Services Section',
        'settings' => 'service_1'
    )));


    $wp_customize->add_setting('service_2', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'service_2', array(
        'label' => __('Service 2', 'businessplus'),
        'section' => 'Services Section',
        'settings' => 'service_2'
    )));


    $wp_customize->add_setting('service_3', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'service_3', array(
        'label' => __('Service 3', 'businessplus'),
        'section' => 'Services Section',
        'settings' => 'service_3'
    )));


    $wp_customize->add_setting('service_4', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'service_4', array(
        'label' => __('Service 4', 'businessplus'),
        'section' => 'Services Section',
        'settings' => 'service_4'
    )));

    $wp_customize->add_setting('services_bg_settings',array (
        'default'=> '#eaeff3',
        'transport' => 'refresh',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'services_bg_settings', array(
        'label' => __('Section background-color'),
        'section' => 'Services Section',
        'settings' => 'services_bg_settings'
    )));

    $wp_customize->add_setting('services_link_settings');

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'services_link_settings', array(
        'label' => __('Services Page Link'),
        'section' => 'Services Section',
        'settings' => 'services_link_settings',
        'type' => 'dropdown-pages'
    )));

    //----------Services Section End-----------------

    //----------Clients Section---------------------

    $wp_customize->add_section('Clients Section', array(
        'title' => __('Clients Section'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('clients_title_settings', array(
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'clients_title_settings', array(
        'label' => __('Clients Title'),
        'section' => 'Clients Section',
        'settings' => 'clients_title_settings',
    )));


    $wp_customize->add_setting('clients_subtitle_settings', array(
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'clients_subtitle_settings', array(
        'label' => __('Clients SubTitle'),
        'section' => 'Clients Section',
        'settings' => 'clients_subtitle_settings',
    )));

    //-----------CLients Section End-----------------

//    ----------NEWS SECTION-----------------------

    $wp_customize->add_section('News Section', array(
        'title' => __('News Section'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('news_title_settings',array (
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'news_title_settings', array(
        'label' => __('News Title'),
        'section' => 'News Section',
        'settings' => 'news_title_settings',
    )));


    $wp_customize->add_setting('news_subtitle_settings',array (
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'news_subtitle_settings', array(
        'label' => __('News SubTitle'),
        'section' => 'News Section',
        'settings' => 'news_subtitle_settings',
    )));
    $wp_customize->add_setting('news_bg_settings',array (
        'default'=> '#eaeff3',
        'transport' => 'refresh',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'news_bg_settings', array(
        'label' => __('Section background-color'),
        'section' => 'News Section',
        'settings' => 'news_bg_settings',
    )));

    $wp_customize->add_setting('news_link_settings');

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'news_link_settings', array(
        'label' => __('Blog Page Link'),
        'section' => 'News Section',
        'settings' => 'news_link_settings',
        'type' => 'dropdown-pages'
    )));

//    --------NEWS SECTION END---------------------


//    ---------PARTNERS SEction---------------------

    $wp_customize->add_section('Partners Section', array(
        'title' => __('Partners Section'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('partners_title_settings',array (
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'partners_title_settings', array(
        'label' => __('Partners Title'),
        'section' => 'Partners Section',
        'settings' => 'partners_title_settings',
    )));


    $wp_customize->add_setting('partners_subtitle_settings',array (
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'partners_subtitle_settings', array(
        'label' => __('Partners SubTitle'),
        'section' => 'Partners Section',
        'settings' => 'partners_subtitle_settings',
    )));


//     ---------PARTNERS SEction END--------------------

//    ------------BLOG PAGE ----------------------------

    $wp_customize->add_section('Blog-Page', array(
        'title' => __('Blog-Page'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('blog_title_settings',array (
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_title_settings', array(
        'label' => __('Blog-Page Title'),
        'section' => 'Blog-Page',
        'settings' => 'blog_title_settings',
    )));


    $wp_customize->add_setting('blog_subtitle_settings',array (
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_subtitle_settings', array(
        'label' => __('Blog-Page SubTitle'),
        'section' => 'Blog-Page',
        'settings' => 'blog_subtitle_settings',
    )));

//-----------BLOG PAGE END------------------------------

//    ----------BLOG POST ------------------------------

    $wp_customize->add_section('Blog-Post', array(
        'title' => __('Blog-Post'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('blog_post_title_settings',array (
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_post_title_settings', array(
        'label' => __('Blog-Post Title'),
        'section' => 'Blog-Post',
        'settings' => 'blog_post_title_settings',
    )));


    $wp_customize->add_setting('blog_post_subtitle_settings',array (
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_post_subtitle_settings', array(
        'label' => __('Blog-Post SubTitle'),
        'section' => 'Blog-Post',
        'settings' => 'blog_post_subtitle_settings',
    )));

//    Commments Blog post-------------------

    $wp_customize->add_section('Comments Section', array(
        'title' => __('Comments'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));


    $wp_customize->add_setting('comments_title_settings',array (
        'default' => 'Type your title',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'comments_title_settings', array(
        'label' => __('Comments Section Title'),
        'section' => 'Comments Section',
        'settings' => 'comments_title_settings',
    )));


    $wp_customize->add_setting('comments_subtitle_settings',array (
        'default' => 'Type your subtitle',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'comments_subtitle_settings', array(
        'label' => __('Comments Section SubTitle'),
        'section' => 'Comments Section',
        'settings' => 'comments_subtitle_settings',
    )));

    //    Commments Blog post END-------------------

    //    ----------BLOG POST END------------------------------





//    -------------Footer-------------------------------

    $wp_customize->add_section('Footer', array(
        'title' => __('Footer'),
        'priority' => 30,
        'panel' => 'Custom_Sections Changes'
    ));
    $wp_customize->add_setting('footer_bg_settings',array (
        'default'=> '#2a2b2c',
        'transport' => 'refresh',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_settings', array(
        'label' => __('Section background-color'),
        'section' => 'Footer',
        'settings' => 'footer_bg_settings'
    )));

    $wp_customize->add_setting('social_links_facebook', array(
            'default'			=> 'https://facebook.com',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control('social_links_facebook', array(
            'settings'		=> 'social_links_facebook',
            'section'		=> 'Footer',
            'type'			=> 'url',
            'label'	        => __( 'Facebook Url' )
        )
    );
    $wp_customize->add_setting ('social_links_twitter', array(
            'default'			=> 'https://twitter.com',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control ('social_links_twittwer', array(
            'settings'		=> 'social_links_twitter',
            'section'		=> 'Footer',
            'type'			=> 'url',
            'label'	        => __( 'Twitter Url' )
        )
    );
    $wp_customize->add_setting ('social_links_google', array(
            'default'			=> 'https://google.com',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control ('social_links_google', array(
            'settings'		=> 'social_links_google',
            'section'		=> 'Footer',
            'type'			=> 'url',
            'label'	        => __( 'Google+ Url' )
        )
    );

    $wp_customize->add_setting ('social_links_linkedin', array(
            'default'			=> 'https://linkedin.com',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control ('social_links_linkedin', array(
            'settings'		=> 'social_links_linkedin',
            'section'		=> 'Footer',
            'type'			=> 'url',
            'label'	        => __( 'Linkedin Url' )
        )
    );


//    -------------Footer END---------------------------


}

add_action('customize_register', 'business_blog_customize');

function css()
{
    ?>
    <style type="text/css">
        .welcome-section {
            background: url('<?php echo get_theme_mod('welcome-bg_settings'); ?>') 50% no-repeat;
            background-size: cover;
        }
        .custom-header {
            background: url('<?php echo get_theme_mod('custom-header-bg_settings'); ?>') 50% no-repeat;
            background-size: cover;
        }

        .services-section {
            background-color:<?php echo get_theme_mod('services_bg_settings'); ?>;
        }

        .news-section {
            background-color:<?php echo get_theme_mod('news_bg_settings'); ?>;
        }

        .main-footer {
            background-color:<?php echo get_theme_mod('footer_bg_settings'); ?>;
        }

    </style>
    <?php
}

add_action('wp_head', 'css');

//-----Custom Post types------------------
function custom_post_type()
{
    $args = array(
        'label' => 'Slider',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'slides'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
    );
    register_post_type('slides', $args);

    $services = array(
        'label' => 'Services',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'services'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
    );
    register_post_type('services', $services);

    $clients = array(
        'label' => 'Clients Slider',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'clients_slides'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
    );
    register_post_type('clients_slides', $clients);

    $partners = array(
        'label' => 'Partners Slider',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'partners_slides'),
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
    );
    register_post_type('partners_slides', $partners);
}

add_action('init', 'custom_post_type');

//----------Add .is-checked class ------when on page-------------

function special_nav_class($classes)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'is-checked';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'special_nav_class');

//Exclude to show posts from category NEWS in BLOG PAGE

function exclude_category( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-3' );
    }
}
add_action( 'pre_get_posts', 'exclude_category' );

//--Add class to the_excerpt() and the_content()------------------

add_filter( "the_excerpt", "add_class_to_excerpt" );

function add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="post-text-wrap"', $excerpt);
}

add_filter( "the_content", "add_class_to_content" );

function add_class_to_content( $excerpt ) {
    return str_replace('<p', '<p class="post-content-wrap"', $excerpt);
}
