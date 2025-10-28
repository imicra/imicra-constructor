<?php
/**
 * Common blocks.
 *
 * @package imicra
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function imicra_common_block() {
	$prefix = 'imicra';

  /**
   * Common
   */
	Container::make( 'theme_options', 'imicra_common_blocks', __( 'Настройки темы' ) )
		->set_page_parent( 'imicra_settings' )
		->add_tab( __( 'Основные' ), array(
			Field::make( 'text', $prefix . '_site_phone', __( 'Телефон' ) ),
			Field::make( 'text', $prefix . '_site_rights', __( 'Копирайт сайта' ) ),
		) );
}
add_action( 'carbon_fields_register_fields', 'imicra_common_block' );
