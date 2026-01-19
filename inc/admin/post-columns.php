<?php
/**
 * Posts table's columns.
 *
 * @package imicra
 */

/**
 * Add custom columns in posts table.
 */
function imicra_manage_post_columns( $columns ) {
  $new_columns = array(
		'_tpl' => 'Шаблон',
	);

  return array_slice( $columns, 0, 2 ) + $new_columns  + $columns;
}
add_filter( 'manage_' . 'post' . '_posts_columns', 'imicra_manage_post_columns' );
add_filter( 'manage_' . 'page' . '_posts_columns', 'imicra_manage_post_columns' );


/**
 * Collect Columns in Posts Table with data.
 */
function imicra_manage_post_custom_column( $column, $post_id ) {
  if ( '_tpl' === $column ) {
    $tpl = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = get_page_templates( $post_id, 'post' );

    foreach ( $templates as $name => $path ) {
      if ( $path == $tpl ) {
        echo $name;
      }
    }
	}
}
add_action( 'manage_' . 'post' . '_posts_custom_column', 'imicra_manage_post_custom_column', 10, 2 );
add_action( 'manage_' . 'page' . '_posts_custom_column', 'imicra_manage_post_custom_column', 10, 2 );
