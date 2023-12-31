<?php
/**
 * File posts-blocks.php.
 * 
 * @package imicra
 */

function imicra_blocks_posttypes() {
    $singular_name = 'Блок';
    $plural_name = 'Блоки';
    $variant_name = 'Блоков';

    register_post_type( 'blocks', array(
        'labels'              => array(
            'name'               => sprintf( '%s дизайна', $plural_name ),
            'singular_name'      => $singular_name,
            'menu_name'          => $plural_name,
            'name_admin_bar'     => $plural_name,
            'add_new'            => sprintf( 'Добавить %s', $singular_name ),
            'add_new_item'       => sprintf( 'Добавить Новый %s', $singular_name ),
            'new_item'           => sprintf( 'Новый %s', $singular_name ),
            'edit_item'          => sprintf( 'Редактировать %s', $singular_name ),
            'view_item'          => sprintf( 'Смотреть %s', $singular_name ),
            'all_items'          => sprintf( 'Все %s', $plural_name ),
            'search_items'       => sprintf( 'Искать %s', $plural_name ),
            'parent_item_colon'  => sprintf( 'Родительский %s:', $singular_name ),
            'not_found'          => sprintf( 'Не найдено %s.', $variant_name ),
            'not_found_in_trash' => sprintf( 'Не найдено %s в корзине.', $variant_name ),
        ),
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-welcome-widgets-menus',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title' ),
        'has_archive'         => false,
        'query_var'           => false,
    ) );
}
add_action( 'init', 'imicra_blocks_posttypes' );
