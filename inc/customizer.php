<?php
/**
 * imicra Theme Customizer
 *
 * @package imicra
 */

/* Include customizer repeater */
// require_once get_template_directory() . '/inc/customizer-repeater/functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function imicra_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'imicra_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'imicra_customize_partial_blogdescription',
			)
		);
	}

	// customize defaults
	$wp_customize->remove_control( 'blogname' );
	$wp_customize->remove_control( 'blogdescription' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'header_image' );
	// $wp_customize->get_section( 'header_image' )->priority = 30;
	$wp_customize->get_control( 'custom_logo' )->section = 'imicra_header_section';

	/**
	 * Header Section
	 */
	$wp_customize->add_section( 'imicra_header_section', array(
		'title'	      => __( 'Хэдер', 'imicra' ),
		'priority'    => 20,
	) );

	// sample repeater
	// $wp_customize->add_setting( 'imicra_sample_repeater', array(
	// 	'sanitize_callback' => 'imicra_sanitize_repeater',
	// ) );

	// $wp_customize->add_control( new Imicra_General_Repeater( $wp_customize, 'imicra_sample_repeater', array(
	// 	'label'    => esc_html__( 'Добавить элемент', 'imicra' ),
	// 	'section'  => 'imicra_header_section',
	// 	'priority' => 20,
		// 'imicra_image_control'     => true,
		// 'imicra_icon_control'      => true,
		// 'imicra_title_control'     => true,
		// 'imicra_subtitle_control'  => true,
		// 'imicra_text_control'      => true,
		// 'imicra_link_control'      => true,
		// 'imicra_page_control'      => true,
		// 'imicra_shortcode_control' => true
	// ) ) );
}
add_action( 'customize_register', 'imicra_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function imicra_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function imicra_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Sanitize variables to allow HTML tags
 *
 * @param string $input Text to sanitize.
 */
function imicra_sanitize_input( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Check if the current page is frontpage
 */
function imicra_is_front_page() {
	if ( 'page' == get_option( 'show_on_front' ) && is_front_page() ) {
		return true;
	}
	return false;
}

/**
 * Sanitize Number
 */
function imicra_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function imicra_customize_preview_js() {
	wp_enqueue_script( 'imicra-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'imicra_customize_preview_js' );

/* Include customizer Custom Styles */
require_once get_template_directory() . '/inc/custom-styles.php';