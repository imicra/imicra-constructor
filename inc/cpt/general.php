<?php
/**
 * Define Allowed Files to be included.
 * 
 * @package imicra
 */

function imicra_filter_cpt( $array ) {
	return array_merge( $array, array(
		'cpt/posts-blocks',
	) );
}
add_filter( 'imicra_filter_cpt', 'imicra_filter_cpt' );

/**
 * Include files.
 */
function imicra_include_cpt() {
	$imicra_allowed_phps = array();
	$imicra_allowed_phps = apply_filters( 'imicra_filter_cpt', $imicra_allowed_phps );
	foreach ( $imicra_allowed_phps as $file ) {
		$imicra_file_to_include = get_template_directory() . '/inc/' . $file . '.php';
		if ( file_exists( $imicra_file_to_include ) ) {
			include_once( $imicra_file_to_include );
		}
	}
}
add_action( 'after_setup_theme', 'imicra_include_cpt' );