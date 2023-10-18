<?php
/**
 * Admin Area functions.
 *
 * @package imicra
 */

/**
 * Remove comments and posts menus from admin nav
 */
// Removes from admin menu
function imicra_remove_admin_menus() {
  remove_menu_page( 'edit-comments.php' );
  remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'imicra_remove_admin_menus' );

// Removes from post and pages
function remove_comment_support() {
  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'remove_comment_support', 100 );

// Removes from admin bar
function imicra_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'imicra_admin_bar_render' );

// Remove +New post in top Admin Menu Bar
function remove_default_post_type_menu_bar( $wp_admin_bar ) {
  $wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

// Remove Quick Draft Dashboard Widget
function remove_draft_widget() {
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

// remove posts from nav menus
function imicra_remove_posts_from_nav_menus( $args, $post_type ) {
  if ( 'post' == $post_type ) {
    $args['show_in_nav_menus'] = false;
  }
  return $args;
}
add_filter( 'register_post_type_args', 'imicra_remove_posts_from_nav_menus', 20, 2 );

// remove category from nav menus
function imicra_remove_catrgory_from_nav_menus( $args, $taxonomy, $object_type ) {
  if ( 'category' == $taxonomy || 'post_tag' == $taxonomy ) {
    $args['show_in_nav_menus'] = false;
  }
  return $args;
}
add_filter( 'register_taxonomy_args', 'imicra_remove_catrgory_from_nav_menus', 10, 3 );
