<?php
/**
 * Blocks cpt.
 *
 * @package imicra
 */

/**
 * Add custom columns in posts table.
 */
function imicra_manage_blocks_columns( $columns ) {
  $new_columns = array(
		'blocks_tpl' => 'Шаблон',
	);

  return array_slice( $columns, 0, 2 ) + $new_columns  + $columns;
}
add_filter( 'manage_' . 'blocks' . '_posts_columns', 'imicra_manage_blocks_columns' );


/**
 * Collect Columns in Posts Table with data.
 */
function imicra_manage_blocks_custom_column( $column, $post_id ) {
  if ( 'blocks_tpl' === $column ) {
    $tpl = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = get_page_templates( $post_id, 'blocks' );

    foreach ( $templates as $name => $path ) {
      if ( $path == $tpl ) {
        echo $name;
      }
    }
	}
}
add_action( 'manage_' . 'blocks' . '_posts_custom_column', 'imicra_manage_blocks_custom_column', 10, 2 );
