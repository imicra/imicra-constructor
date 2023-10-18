<?php
/**
 * Admin Area functions.
 *
 * @package imicra
 */

/**
 * Admin functions.
 */
// require_once dirname( __FILE__ ) . '/admin-functions.php';

/**
 * Blocks cpt.
 */
require_once dirname( __FILE__ ) . '/blocks.php';

/**
 * Admin Menu.
 */
require_once dirname( __FILE__ ) . '/admin-menu.php';

/**
 * image Media Uploader field in the Taxonomy.
 */
// require_once dirname( __FILE__ ) . '/taxonomy-thumbnail/taxonomy-thumbnail.php';

/**
 * Admin scripts.
 */
function imicra_admin_scripts() {
  wp_enqueue_media();

  wp_enqueue_script( 'imicra-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery' ), _S_VERSION, true );
}
// add_action( 'admin_enqueue_scripts', 'imicra_admin_scripts' );
