<?php
/**
 * Add an image Media Uploader field to the Category.
 *
 * @package Thebuilt
 */

$taxnames = array(
  'custom_cat',
);

foreach ( $taxnames as $taxname ) {
  /**
   * Add a form field in the new Taxonomy page.
   */
  add_action("{$taxname}_add_form_fields", 'add_taxonomy_image', 10, 2 );
  /**
   * Edit the form field.
   */
  add_action("{$taxname}_edit_form_fields", 'update_taxonomy_image', 10, 2 );
  /**
   * Save the form field.
   */
  add_action("create_{$taxname}", 'save_taxonomy_image', 10, 2 );
  /**
   * Update the form field value.
   */
  add_action("edited_{$taxname}", 'updated_taxonomy_image', 10, 2 );
  /**
   * Image column added to category admin screen.
   */
  add_filter( "manage_edit-{$taxname}_columns", 'imicra_register_taxonomy_column' );
  /**
   * Image column value added to category admin screen.
   */
  add_action( "manage_{$taxname}_custom_column", 'imicra_add_value_taxonomy_column' , 10, 3);
}
