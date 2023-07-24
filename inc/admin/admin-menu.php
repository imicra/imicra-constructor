<?php
/**
 * Admin Menu.
 *
 * @package imicra
 */

function imicra_add_admin_page() {
  // Create imicra Admin Page
  add_menu_page( 'Настройки сайта', 'Imicra', 'manage_options', 'imicra_settings', 'imicra_theme_admin_page_cb', 'dashicons-admin-generic', 110 );

  // Create imicra Admin Sub Page
  add_submenu_page( 'imicra_settings', 'Основные настройки сайта', 'Основные', 'manage_options', 'imicra_settings', 'imicra_theme_admin_page_cb' );
  add_submenu_page( 'imicra_settings', 'Другие настройки сайта', 'Другие', 'manage_options', 'imicra_opt_settings', 'imicra_theme_settings_page_cb' );

  // Activate Custom Settings
  add_action( 'admin_init', 'imicra_theme_general_settings' );
}
add_action( 'admin_menu', 'imicra_add_admin_page' );

/**
 * General Page Settings
 */
function imicra_theme_general_settings() {
  register_setting( 'imicra-settings-general', 'imicra_mail' );
  register_setting( 'imicra-settings-general', 'imicra_rights' );
  register_setting( 'imicra-settings-general', 'imicra_portfolio_posts_per_page' );

  add_settings_section( 'imicra_general_options', 'Главные настройки', 'imicra_general_options_cb', 'imicra_settings' );

  add_settings_field( 'rights-mail', 'Почтовый ящик для форм', 'imicra_mail_name_cb', 'imicra_settings', 'imicra_general_options' );
  add_settings_field( 'rights-name', 'Копирайт', 'imicra_rights_name_cb', 'imicra_settings', 'imicra_general_options' );
  add_settings_field( 'portfolio-posts-per-page', 'На страницах галерей отображать не более', 'imicra_portfolio_posts_per_page_cb', 'imicra_settings', 'imicra_general_options' );
}

function imicra_general_options_cb() {
  echo 'Настройки главных опций сайта';
}

function imicra_mail_name_cb() {
  $imicra_mail = esc_attr( get_option( 'imicra_mail' ) );
  echo '<input type="text" name="imicra_mail" value="' . $imicra_mail . '" />';
}

function imicra_rights_name_cb() {
  $imicra_rights = esc_attr( get_option( 'imicra_rights' ) );
  echo '<input type="text" name="imicra_rights" value="' . $imicra_rights . '" placeholder="Imicra theme" />';
}

function imicra_portfolio_posts_per_page_cb() {
  $portfolio_posts_per_page = esc_attr( get_option( 'imicra_portfolio_posts_per_page' ) );
  echo '<input class="small-text" type="number" name="imicra_portfolio_posts_per_page" step="1" min="1" value="' . $portfolio_posts_per_page . '" /> записи';
}

/**
 * Display pages
 */
// General Page
function imicra_theme_admin_page_cb() {
  require_once( get_template_directory() . '/inc/admin/templates/menu-general.php' );
}

// Settings Page
function imicra_theme_settings_page_cb() {
  echo '<h1>Другие настройки сайта</h1>';
}