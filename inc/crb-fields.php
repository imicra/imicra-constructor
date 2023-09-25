<?php
/**
 * Carbon Fields
 */

/**
 * Carbon.
 */
function crb_load() {
  require_once dirname( __DIR__ ) . '/vendor/autoload.php';
  \Carbon_Fields\Carbon_Fields::boot();
  
  new \Carbon_Fields_Yoast\Carbon_Fields_Yoast;

  // include here file for metabox in widgets
}
add_action( 'after_setup_theme', 'crb_load' );

require_once dirname( __FILE__ ) . '/crb-metaboxes/block-button.php';
require_once dirname( __FILE__ ) . '/crb-metaboxes/crb-builder.php';

/**
 * Carbon Fields Yoast
 */
function crb_enqueue_admin_scripts() {
	wp_enqueue_script( 'crb-yoast', get_stylesheet_directory_uri() . '/assets/js/crb-yoast.js', array( 'carbon-fields-yoast' ) );
}
// add_action( 'admin_enqueue_scripts', 'crb_enqueue_admin_scripts' );
