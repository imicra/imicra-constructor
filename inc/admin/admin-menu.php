<?php
/**
 * Admin Menu.
 *
 * @package imicra
 */

function imicra_add_admin_page() {
  // Create imicra Admin Page
  add_menu_page( 'Настройки сайта', wp_get_theme()->get( 'Name' ), 'manage_options', 'imicra_settings', 'imicra_theme_admin_page_cb', 'dashicons-admin-generic', 110 );

  // Create imicra Admin Sub Page
  add_submenu_page( 'imicra_settings', 'Основные настройки сайта', 'Основные', 'manage_options', 'imicra_settings', 'imicra_theme_admin_page_cb' );

  // Activate Custom Settings
  add_action( 'admin_init', 'imicra_theme_general_settings' );
}
add_action( 'admin_menu', 'imicra_add_admin_page' );

/**
 * General Page Settings
 */
function imicra_theme_general_settings() {
  register_setting( 'imicra-settings-general', 'imicra_mail' );

  add_settings_section( 'imicra_general_options', 'Главные настройки', 'imicra_general_options_cb', 'imicra_settings' );

  add_settings_field( 'rights-mail', 'Почтовый ящик для форм', 'imicra_mail_name_cb', 'imicra_settings', 'imicra_general_options' );
}

function imicra_general_options_cb() {
  echo 'Настройки главных опций сайта';
}

function imicra_mail_name_cb() {
  $imicra_mail = esc_attr( get_option( 'imicra_mail' ) );
  echo '<input type="text" name="imicra_mail" value="' . $imicra_mail . '" />';
}

/**
 * Display pages
 */
// General Page
function imicra_theme_admin_page_cb() {
  require_once( get_template_directory() . '/inc/admin/templates/menu-general.php' );
}

// Other Settings Page
require_once( get_template_directory() . '/inc/admin/templates/other-opt.php' );
