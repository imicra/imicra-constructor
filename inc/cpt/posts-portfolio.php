<?php
/**
 * File posts-portfolio.php.
 * 
 * Custom Post Type for Portfolio.
 * 
 * @package imicra
 */

function imicra_portfolio_posttypes() {
    
    $labels = array(
        'name'               => __( 'Наши работы', 'imicra' ),
        'singular_name'      => __( 'Portfolio item', 'imicra' ),
        'menu_name'          => __( 'Portfolio', 'imicra' ),
        'name_admin_bar'     => __( 'Portfolio', 'imicra' ),
        'add_new'            => __( 'Add New', 'imicra' ),
        'add_new_item'       => __( 'Add New Portfolio item', 'imicra' ),
        'new_item'           => __( 'New Portfolio item', 'imicra' ),
        'edit_item'          => __( 'Edit Portfolio item', 'imicra' ),
        'view_item'          => __( 'View Portfolio item', 'imicra' ),
        'all_items'          => __( 'All Portfolio items', 'imicra' ),
        'search_items'       => __( 'Search Portfolio items', 'imicra' ),
        'parent_item_colon'  => __( 'Parent Portfolio item:', 'imicra' ),
        'not_found'          => __( 'No Portfolio items found.', 'imicra' ),
        'not_found_in_trash' => __( 'No Portfolio items found in Trash.', 'imicra' ),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_rest'        => true,
        'menu_position'       => 32,
        'menu_icon'           => 'dashicons-format-gallery',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
        'taxonomies'          => array( 'portfolio-categories' ),
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'portfolio' ),
        'query_var'           => true,
    );
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'imicra_portfolio_posttypes' );

// Portfolio Taxonomies
function imicra_portfolio_taxonomies() {
	
  // Category
  $labels = array(
      'name'              => 'Категории Portfolio',
      'singular_name'     => 'Категория',
      'search_items'      => 'Найти Категорию',
      'all_items'         => 'Все Категории',
      'parent_item'       => 'Родитель Категории',
      'parent_item_colon' => 'Родитель Категории:',
      'edit_item'         => 'Редактировать Категорию',
      'update_item'       => 'Обновить Категорию',
      'add_new_item'      => 'Добавить Категорию',
      'new_item_name'     => 'Новая Категория',
      'menu_name'         => 'Категория',
  );

  $args = array(
      'labels'              => $labels,
      'public'              => true,
      'show_ui'             => true,
      'show_in_nav_menus'   => true,
      'show_in_rest'        => true,
      'hierarchical'        => true,
      'rewrite'             => array( 'slug' => 'portfolio-categories' ),
      'query_var'           => true,
      'meta_box_cb'         => 'post_categories_meta_box',
      'show_admin_column'   => true,
  );

  register_taxonomy( 'portfolio-categories', array( 'portfolio' ), $args );
}
add_action( 'init', 'imicra_portfolio_taxonomies' );