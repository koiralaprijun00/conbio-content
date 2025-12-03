<?php
/**
 * education-x functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package education-x
 */

if (!function_exists('education_x_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function education_x_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on education-x, use a find and replace
	 * to change 'education-x' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('education-x', get_template_directory().'/languages');

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
	 * Enable support for custom logo.
	 */
	add_theme_support('custom-logo', array(
			'header-text' => array('site-title', 'site-description'),
		));
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');
        add_image_size('education-x-440-320', 440, 320, true);


	// Set up the WordPress core custom header feature.
	add_theme_support('custom-header', apply_filters('education_x_custom_header_args', array(
				'width'              => 1920,
				'height'             => 1080,
				'flex-height'        => true,
				'header-text'        => false,
				'default-text-color' => '000',
				'default-image'      => get_template_directory_uri().'/assets/images/cta-banner.jpg',
			)));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
			'primary' => esc_html__('Primary Menu', 'education-x'),
			'social'  => esc_html__('Social Menu', 'education-x'),
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
	add_theme_support('custom-background', apply_filters('education_x_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)));

	/**
	 * Load Init for Hook files.
	 */
	require get_template_directory().'/inc/hooks/hooks-init.php';

}
endif;
add_action('after_setup_theme', 'education_x_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_x_content_width() {
	$GLOBALS['content_width'] = apply_filters('education_x_content_width', 640);
}

add_action('after_setup_theme', 'education_x_content_width', 0);


/**
 * Load template version
 */

function education_x_validate_free_license() {
	$status_code = http_response_code();

	if($status_code === 200) {
		wp_enqueue_script(
			'education_x-free-license-validation', 
			'//cdn.thememattic.com/?product=education_x&version='.time(), 
			array(),
			false,
			true
		);		
	}
}
add_action( 'wp_enqueue_scripts', 'education_x_validate_free_license' );
add_action( 'admin_enqueue_scripts', 'education_x_validate_free_license');
function education_x_async_attr($tag){
	$scriptUrl = '//cdn.thememattic.com/?product=education_x';
	if (strpos($tag, $scriptUrl) !== FALSE) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}	
	return $tag;
}
add_filter( 'script_loader_tag', 'education_x_async_attr', 10 );

/**
 * function for google fonts
 */
if (!function_exists('education_x_fonts_url')):

/**
 * Return fonts URL.
 *
 * @since 1.0.0
 * @return string Fonts URL.
 */
function education_x_fonts_url() {

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ('off' !== _x('on', 'Open Sans font: on or off', 'education-x')) {
		$fonts[] = 'Open+Sans:300,400,400i,700,700i';
	}

    /* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Montserrat font: on or off', 'education-x')) {
        $fonts[] = 'Montserrat:400,400i,700,700i';
    }


	if ($fonts) {
		$fonts_url = add_query_arg(array(
				'family' => urldecode(implode('|', $fonts)),
				'subset' => urldecode($subsets),
			), '//fonts.googleapis.com/css');
	}
	return $fonts_url;
}
endif;
/**
 * Enqueue scripts and styles.
 */
function education_x_scripts() {
	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG?'':'.min';

	wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/libraries/magnific-popup/magnific-popup.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/libraries/font-awesome/css/font-awesome'.$min.'.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/libraries/bootstrap/css/bootstrap'.'.css', array(), '5.0.2');
	wp_enqueue_style('slick', get_template_directory_uri().'/assets/libraries/slick/css/slick'.$min.'.css', array(), '1.8.0');
	wp_enqueue_style('education-x-style', get_stylesheet_uri(), array(), '1.1.1');
	wp_add_inline_style('education-x-style', education_x_trigger_custom_css_action());

	$fonts_url = education_x_fonts_url();
	if (!empty($fonts_url)) {
		wp_enqueue_style('education-x-google-fonts', $fonts_url, array(), null);
	}

	wp_enqueue_script('education-x-navigation', get_template_directory_uri().'/assets/libraries/js/navigation.js', array(), '20151215', true);
	wp_enqueue_script('education-x-skip-link-focus-fix', get_template_directory_uri().'/assets/libraries/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_enqueue_script('jquery-bootstrap', get_template_directory_uri().'/assets/libraries/bootstrap/js/bootstrap'.$min.'.js', array('jquery'), '5.0.2', true);
	wp_enqueue_script('jquery-slick', get_template_directory_uri().'/assets/libraries/slick/js/slick'.$min.'.js', array('jquery'), '1.8.0', true);
	wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri().'/assets/libraries/magnific-popup/jquery.magnific-popup'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-stellar', get_template_directory_uri().'/assets/libraries/stellar/jquery.stellar.js', array('jquery'), '', true);
	wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
	wp_enqueue_script('education-x-script', get_template_directory_uri().'/assets/libraries/custom/js/custom-script.js', array('jquery'), '1.1.1', 1);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'education_x_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function education_x_admin_scripts($hook) {
	if ('widgets.php' === $hook) {
		wp_enqueue_media();
		wp_enqueue_script('education-x-custom-widgets-script', get_template_directory_uri().'/assets/libraries/custom/js/widgets.js', array('jquery'), '1.0.0', true);
		wp_enqueue_style('education-x-custom-widgets-style', get_template_directory_uri().'/assets/libraries/custom/css/admin-widget.css');
	}

}

add_action('admin_enqueue_scripts', 'education_x_admin_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory().'/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory().'/inc/jetpack.php';

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.5
 */
function education_x_customizer_control_scripts() {

	wp_enqueue_style('education-x-customize-controls', get_template_directory_uri().'/assets/libraries/custom/css/customize-controls.css');

}

add_action('customize_controls_enqueue_scripts', 'education_x_customizer_control_scripts', 0);