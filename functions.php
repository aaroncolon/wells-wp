<?php
/**
 * Wells functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wells
 */

if ( ! defined( 'WELLS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'WELLS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wells_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wells_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Wells, use a find and replace
		 * to change 'wells' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wells', get_template_directory() . '/languages' );

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
		add_image_size( 'sm', 300, 300 );
		add_image_size( 'md', 600, 600 );
		add_image_size( 'lg', 1000, 1000);
		add_image_size( 'xl', 1500, 1500 );
		add_image_size( 'xxl', 2000, 2000 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'wells' ),
				'secondary-menu' => esc_html__( 'Secondary', 'wells' ),
				'mobile-menu' => esc_html__( 'Mobile', 'wells' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wells_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'wells_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wells_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wells_content_width', 640 );
}
add_action( 'after_setup_theme', 'wells_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wells_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wells' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wells' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wells_widgets_init' );

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Enqueue scripts and styles.
 */
function wells_scripts() {
	wp_enqueue_style( 'royalslider-css', get_template_directory_uri() . '/js/dist/royalslider/royalslider.css', array(), '9.5.9' );
	wp_enqueue_style( 'royalslider-theme-css', get_template_directory_uri() . '/js/dist/royalslider/skins/universal/rs-universal.css', array(), '9.5.9' );

	wp_enqueue_style( 'wells-style', get_stylesheet_uri(), array(), WELLS_VERSION );
	wp_style_add_data( 'wells-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'wells-style', wells_get_customizer_css() );

	// wp_enqueue_script( 'wells-utilities', get_template_directory_uri() . '/js/Utilities.js', array(), WELLS_VERSION, true );
	// wp_enqueue_script( 'wells-site-height', get_template_directory_uri() . '/js/siteHeight.js', array(), WELLS_VERSION, true );
	// wp_enqueue_script( 'wells-navigation', get_template_directory_uri() . '/js/navigation.js', array(), WELLS_VERSION, true );
	// wp_enqueue_script( 'wells-navigation-folders', get_template_directory_uri() . '/js/navigationFolders.js', array('jquery'), WELLS_VERSION, true );
	// wp_enqueue_script( 'wells-main', get_template_directory_uri() . '/js/main.js', array('jquery'), WELLS_VERSION, true );

	wp_enqueue_script( 'wells-js-detect', get_template_directory_uri() . '/js/js-detect.js', array(), WELLS_VERSION, false );
	wp_enqueue_script( 'wells-all', get_template_directory_uri() . '/js/dist/bundle.js', array('jquery'), WELLS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wells_scripts' );

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * ACF Functions
 */
require get_template_directory() . '/inc/acf-functions.php';

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

function dump($thing) {
	echo '<pre>';
		var_dump($thing);
	echo '</pre>';
}
