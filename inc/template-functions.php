<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package imicra
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function imicra_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( imicra_is_frontpage() ) {
		$classes[] = 'frontpage';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'imicra_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function imicra_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'imicra_pingback_header' );

/**
 * Checks to see if we're on the homepage or not.
 */
function imicra_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Change Sender Name and Email Address
 */
// Function to change email address
function imicra_sender_email( $original_email_address ) {
	return 'noreply@' . $_SERVER['SERVER_NAME'];
}
add_filter( 'wp_mail_from', 'imicra_sender_email' );

// Function to change sender name
function imicra_sender_name( $original_email_from ) {
	return get_bloginfo( 'name' );
}
// add_filter( 'wp_mail_from_name', 'imicra_sender_name' );

/**
 * Add bootstrap class in Nav Menu item.
 */
function imicra_menu_item_css_classes( $classes, $item, $args, $depth ) {
	if( $args->theme_location === 'header-main' ) {
		$classes[] = 'nav-item';
  }
  
  if ( in_array( 'current-menu-item', $classes ) && $args->theme_location === 'header-main' ) {
    $classes[] = 'active';
  }

	return $classes;
}
// add_filter( 'nav_menu_css_class', 'imicra_menu_item_css_classes', 10, 4 );

/**
 * Disable Editor for specific page templates
 * @link https://wordpress.stackexchange.com/questions/256071/disable-wp-editor-for-specific-page-templates
 */
function imicra_remove_editor() {
  if ( isset( $_GET['post'] ) ) {
      $id = $_GET['post'];
      $template = get_post_meta( $id, '_wp_page_template', true );

      switch ( $template ) {
          case 'templates/crb-builder.php':
            remove_post_type_support( 'page', 'editor' );
            remove_post_type_support( 'page', 'thumbnail' );
					break;

          default :
          // Don't remove any other template.
          break;
      }
  }
}
add_action( 'init', 'imicra_remove_editor' );

/**
 * Disable standard editor and Gutenberg for the homepage
 */
function imicra_hide_editor( $use_block_editor, $post_type ) {
  if ( (int) get_option( 'page_on_front' ) == get_the_ID() ) {
    remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'page', 'thumbnail' );

    return false;
  }

  return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'imicra_hide_editor', 10, 2 );

/**
 * Use a Non-Breaking Space in WYSIWYG
 */
function allow_nbsp_in_tinymce( $init ) {
  $init['entities'] = '160,nbsp,38,amp,60,lt,62,gt';   
  $init['entity_encoding'] = 'named';
  
  return $init;
}
add_filter( 'tiny_mce_before_init', 'allow_nbsp_in_tinymce' );

/**
 * Allow SVG through WordPress Media Uploader
 */
function imicra_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';

  return $mimes;
}
add_filter('upload_mimes', 'imicra_mime_types');

function restrict_upload_mimes() {
  if (current_user_can( 'administrator') && !defined('ALLOW_UNFILTERED_UPLOADS')){
      define('ALLOW_UNFILTERED_UPLOADS', true);
  }
}
add_action( 'admin_init', 'restrict_upload_mimes', 1 );
