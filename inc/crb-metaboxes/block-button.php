<?php
/**
 * crb metaboxes for crb-blocks.
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function crb_blocks_button() {
  $prefix = 'imicra';

  /**
   * View
   */
  Container::make( 'post_meta', 'Дизайн' )
    ->where( 'post_type', '=', 'blocks' )
    ->where( 'post_template', '=', 'crb-blocks/block-button.php' )
    ->set_priority( 'high' )
    ->add_fields( array(
      Field::make( 'html', $prefix . '_block_button_design', __( 'Дизайн блока' ) )
        ->set_html( sprintf( '<h2>Дизайн блока</h2><img src="%s">', get_template_directory_uri() . '/inc/crb-metaboxes/blocks-images/block_hero.png' ) )
    ));
  
  /**
   * Content
   */
  Container::make( 'post_meta', 'Кнопка CTA' )
    ->where( 'post_type', '=', 'blocks' )
    ->where( 'post_template', '=', 'crb-blocks/block-button.php' )
    ->add_fields( array(
      Field::make( 'text', $prefix . '_block_button_text', __( 'Текст кнопки' ) ),
    ));
}
add_action( 'carbon_fields_register_fields', 'crb_blocks_button' );
