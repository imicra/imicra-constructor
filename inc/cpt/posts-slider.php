<?php
/**
 * File posts-slider.php.
 * 
 * Custom Post Type for Slider on front page.
 * 
 * @package imicra
 */

function imicra_slider_posttypes() {
    
    $labels = array(
        'name'               => 'Слайдер',
        'singular_name'      => 'Слайдер',
        'menu_name'          => 'Слайдер',
        'name_admin_bar'     => 'Слайдер',
        'add_new'            => 'Добавить Слайд',
        'add_new_item'       => 'Добавить Новый Слайд',
        'new_item'           => 'Новый Слайд',
        'edit_item'          => 'Редактировать Слайд',
        'view_item'          => 'Смотреть Слайд',
        'all_items'          => 'Все Слайды',
        'search_items'       => 'Искать Слайды',
        'parent_item_colon'  => 'Родительский Слайд:',
        'not_found'          => 'Не найдено Слайдов.',
        'not_found_in_trash' => 'Не найдено Слайдов в корзине.',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-slides',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
        'has_archive'         => false,
        'rewrite'             => array( 'slug' => 'slider' ),
        'query_var'           => false,
    );
    register_post_type( 'slider', $args );
}
add_action( 'init', 'imicra_slider_posttypes' );