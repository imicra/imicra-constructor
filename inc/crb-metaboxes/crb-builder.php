<?php
/**
 * crb metaboxes for crb-builder.php.
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function crb_builder() {
  $prefix = 'imicra';

  /**
   * Content
   */
  Container::make( 'post_meta', 'Конструктор дизайна' )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'templates/crb-builder.php' )
    ->add_fields( array(
      Field::make( 'complex', $prefix . '_crb_blocks', __( 'Блоки' ) )
        ->set_collapsed( true )
        ->add_fields( 'crb_blocks', __( 'Выбрать блок' ), array(
          Field::make( 'association', $prefix . '_crb_block', __( 'Название блока' ) )
            ->set_required( true )
            ->set_help_text( 'Выбрать Блок (обязательно)' )
            ->set_max( 1 )
            ->set_types( array(
              array(
                'type'      => 'post',
                'post_type' => 'blocks',
              )
            ) ),
      ) )
    ));
}
add_action( 'carbon_fields_register_fields', 'crb_builder' );
