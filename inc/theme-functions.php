<?php
/**
 * Theme functions
 *
 * @package imicra
 */

/**
 * var_dump prettify
 */
function imicra_var_dump( $arg, $format = true ) {
  if ( $format ) {
    echo '<pre>';
    var_dump( $arg );
    echo '</pre>';
  } else {
    var_dump( $arg );
  }
}

/*
 * Convert user-inputted phone number to consistently formatted HTML link.
 * Source https://gist.github.com/RadGH/7580023f71e8d4fbf356
 * 
 * +7 (901) 200–36–06
 * //+7–912–171–29–27
 * 
format_phone( $input, $html = true )
  Converts any phone number to a 10-digit phone number.
  
    - If $html is true (default), the returned value will be an HTML-formatted phone number, including "tel:+" in the link.
    - If a pattern match is not found, the original string will be returned without HTML formatting.
    
  Example:
    <?php var_dump(format_phone("My phone number is: 1 (5411) 23-45-67 ext. 3999. Thank you.")); ?>
    
  Output - With HTML [default] (white space added manually)
      <a href="tel:+15552931039">1 (5411) 23-45-67</a>
    
  Output - No HTML
      tel:+15552931039
*/
function imicra_format_phone( $string, $html = true ) {
	// Pattern to collect digits from a phone number, and optional extension
	// Extensions can be identified using: + - x ex ex. ext ext. extension extension.
  // Now (should) function with country codes!
	$pattern = '/\+?([0-9]{0,3})?[^0-9]*([0-9]{0,3})[^0-9]*([0-9]{0,3})[^0-9]*([0-9]{0,3})[^0-9]*([0-9]{0,3})?[^0-9]*$/i';
  
  if ( preg_match($pattern, $string, $matches) ) {
	  // Input: "7 (901) 232-45-67"
	  // 1 => 7
	  // 2 => 901
	  // 3 => 232
	  // 4 => 45
		// 5 => 67
	  $result = array();

	  $countrycode = ( '8' == $matches[1] ) ? 7 : $matches[1];
	  // Output (HTML):
	  // <a href="tel+15411234567">1 (5411) 23-45-67</a>
	  // Output (Raw):
	  // tel:+15552931039
    if ( $html ) { $result[] = sprintf('<a href="tel:+%s%s%s%s%s">', $countrycode, $matches[2], $matches[3], $matches[4], $matches[5]); }
    if ( $html ) { $result[] = sprintf('+%s (%s) %s-%s-%s', $countrycode, $matches[2], $matches[3], $matches[4], $matches[5]); }
    if ( $html ) { $result[] = sprintf('</a>'); }
    if ( ! $html ) { $result[] = sprintf('tel:+%s%s%s%s%s', $countrycode, $matches[2], $matches[3], $matches[4], $matches[5]); }

	  return implode($result);
  }
  
  // Pattern not found
  return esc_html($string); // The phone number isn't valid, but that's ok. Keep the original.
}

/**
 * Remove tag p from wpautop.
 */
function im_wpautop( $string ) {
  return preg_replace( array( '/<p>/', '/<\/p>/' ), array( '', '' ), wpautop( $string ) );
}

/**
 * Function to get post ID given the post title.
 */
function imicra_get_post_id_by_title( string $title = '', string $post_type = 'post' ): int {
  $posts = get_posts(
      array(
          'post_type'              => $post_type,
          'title'                  => $title,
          'numberposts'            => 1,
          'update_post_term_cache' => false,
          'update_post_meta_cache' => false,
          'orderby'                => 'post_date ID',
          'order'                  => 'ASC',
          'fields'                 => 'ids'
      )
  );

  return empty( $posts ) ? get_the_ID() : $posts[0];
}
