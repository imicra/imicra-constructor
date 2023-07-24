<?php
/**
 * File posts-testimonials.php.
 * 
 * Custom Post Type for Testimonials.
 * 
 * @package imicra
 */

function imicra_testimonials_posttypes() {
    
    $labels = array(
        'name'               => __( 'Отзывы', 'imicra' ),
        'singular_name'      => __( 'Отзыв', 'imicra' ),
        'menu_name'          => __( 'Отзывы', 'imicra' ),
        'name_admin_bar'     => __( 'Отзыв', 'imicra' ),
        'add_new'            => __( 'Добавить Отзыв', 'imicra' ),
        'add_new_item'       => __( 'Добавить новый Отзыв', 'imicra' ),
        'new_item'           => __( 'Новый Отзыв', 'imicra' ),
        'edit_item'          => __( 'Редактировать Отзыв', 'imicra' ),
        'view_item'          => __( 'Смотреть Отзыв', 'imicra' ),
        'all_items'          => __( 'Все Отзывы', 'imicra' ),
        'search_items'       => __( 'Искать Отзывы', 'imicra' ),
        'parent_item_colon'  => __( 'Родительские Отзывы:', 'imicra' ),
        'not_found'          => __( 'Не найдено Отзывов.', 'imicra' ),
        'not_found_in_trash' => __( 'Не найдено Отзывов в корзине.', 'imicra' ),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'menu_position'       => 35,
        'menu_icon'           => 'dashicons-id-alt',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'has_archive'         => false,
        'rewrite'             => array( 'slug' => 'testimonials' ),
        'query_var'           => false,
    );
    register_post_type( 'testimonials', $args );
}
add_action( 'init', 'imicra_testimonials_posttypes' );