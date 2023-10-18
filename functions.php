<?php
/**
 * imicra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package imicra
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'imicra_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function imicra_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on imicra, use a find and replace
		 * to change 'imicra' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'imicra', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Главное меню', 'imicra' ),
				// 'social' => esc_html__( 'Соц. меню', 'imicra' ),
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
				'imicra_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Disable the block-based widgets editor.
		 */
		remove_theme_support( 'widgets-block-editor' );

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
add_action( 'after_setup_theme', 'imicra_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function imicra_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'imicra_content_width', 640 );
}
add_action( 'after_setup_theme', 'imicra_content_width', 0 );

/**
 * Register custom fonts.
 */
function imicra_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'imicra' );

	if ( 'off' !== $open_sans ) {
		$font_families = array();

		$font_families[] = 'Open Sans:300,400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,cyrillic' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function imicra_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'imicra-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'imicra_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function imicra_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'imicra' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'imicra' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'imicra_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function imicra_scripts() {
	$min = imicra_maybe_minified();

	wp_enqueue_style( 'imicra-fonts', imicra_fonts_url(), array(), null );

	wp_enqueue_style( 'imicra-style-libs', get_template_directory_uri() . '/assets/css/libs.min.css', array(), _S_VERSION );

	wp_enqueue_style( 'imicra-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), _S_VERSION );

	wp_enqueue_script( 'imicra-scripts-libs', get_template_directory_uri() . '/assets/js/libs.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'imicra-scripts', get_template_directory_uri() . "/assets/js/scripts{$min}.js", array(), _S_VERSION, true );

	// wp_enqueue_script( 'imicra-wc', get_template_directory_uri() . "/assets/js/woocommerce.js", array( 'jquery' ), _S_VERSION, true );

	wp_localize_script( 'imicra-scripts', 'imicra',
		array(
			'debug' => SCRIPT_DEBUG,
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'imicra_scripts' );

/**
 * Return .min if SCRIPT_DEBUG is not defined.
 *
 * @return string .min if SCRIPT_DEBUG is not defined.
 */
function imicra_maybe_minified() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
 * чтобы она не тормозила, когда долго не заходил и зашел...
 * Все проверки будут происходить незаметно через крон или при заходе на страницу: "Консоль > Обновления".
 *
 * @see https://wp-kama.ru/filecode/wp-includes/update.php
 * @author Kama (https://wp-kama.ru)
 * @link https://wp-kama.ru/id_8514/uskoryaem-adminku-wordpress-otklyuchaem-proverki-obnovlenij.html
 * @version 1.1
 */
if ( is_admin() ) {
	// отключим проверку обновлений при любом заходе в админку...
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );

	/**
	 * отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
	 * эта проверка происходит раз в неделю...
	 * @see https://wp-kama.ru/function/wp_check_browser_version
	 */
	add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_empty_array' );
}

/**
 * Disables the default WordPress option of converting emoticons to image smilies
 */
add_filter( 'option_use_smilies', '__return_false' );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Clean head.
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
// meta rel='dns-prefetch' href='//s.w.org'
// remove_action( 'wp_head', 'wp_resource_hints', 2 );

/**
 * Remove extra global-styles-inline-css.
 */
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

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
 * Theme functions.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Admin functions.
 */
require get_template_directory() . '/inc/admin/admin.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/cpt/general.php';

/**
 * Carbon Fields.
 */
require get_stylesheet_directory() . '/inc/crb-fields.php';

/**
 * Load SVG icon functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom Walker Nav Menu.
 */
require get_template_directory() . '/inc/custom-walker-nav-menu.php';

/**
 * Admin functions.
 */
require get_template_directory() . '/inc/forms-actions.php';

/**
 * Bootstrap Walker Nav Menu.
 */
// require get_template_directory() . '/inc/bootstrap-walker-nav-menu.php';

/**
 * Bootstrap 4 Breadcrumb.
 */
require get_template_directory() . '/inc/bootstrap-breadcrumb.php';

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
