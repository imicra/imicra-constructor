<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package imicra
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function imicra_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'imicra_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function imicra_woocommerce_scripts() {
	wp_enqueue_style( 'imicra-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.min.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'imicra-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'imicra_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function imicra_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'imicra_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function imicra_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'imicra_woocommerce_related_products_args' );

/**
 * Localization weight units.
 */
function imicra_localize_weight_units( $weight ) {
	if ( strpos( $weight, ' g' ) ) {
		$weight = str_replace( 'g', 'г', $weight );
	}

	if ( strpos( $weight, 'kg' ) ) {
		$weight = str_replace( 'kg', 'кг', $weight );
	}

	return $weight;
}
add_filter( 'woocommerce_format_weight', 'imicra_localize_weight_units' );

/**
 * Localization dimensions units.
 */
function imicra_localize_dimensions_units( $dimensions ) {
	if ( strpos( $dimensions, 'mm' ) ) {
		$dimensions = str_replace( 'mm', 'мм', $dimensions );
	}

	if ( strpos( $dimensions, 'cm' ) ) {
		$dimensions = str_replace( 'cm', 'см', $dimensions );
	}

	if ( strpos( $dimensions, ' m' ) ) {
		$dimensions = str_replace( ' m', ' м', $dimensions );
	}

	return $dimensions;
}
add_filter( 'woocommerce_format_dimensions', 'imicra_localize_dimensions_units' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'imicra_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function imicra_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'imicra_woocommerce_wrapper_before' );

if ( ! function_exists( 'imicra_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function imicra_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'imicra_woocommerce_wrapper_after' );

/**
 * Customize Checkout's fiels.
 */
function imicra_override_checkout_fields( $fields ) {
	unset( $fields['order']['order_comments'] );

	return $fields;
}
add_action( 'woocommerce_checkout_fields', 'imicra_override_checkout_fields' );

/**
 * Customize default address fiels.
 */
function imicra_disable_address_fields_validation( $fields ) {
	$fields['address_1']['required'] = false;
	$fields['city']['required'] = false;

	unset( $fields['country'] );
	unset( $fields['state'] );
	unset( $fields['postcode'] );

	return $fields;
}
add_filter( 'woocommerce_default_address_fields' , 'imicra_disable_address_fields_validation' );

/**
 * Remove "(optional)" from non required fields.
 */
function remove_checkout_optional_fields_label( $field, $key, $args, $value ) {
	// Only on checkout page
	if( is_checkout() && ! is_wc_endpoint_url() ) {
			$optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
			$field = str_replace( $optional, '', $field );
	}
	
	return $field;
}
add_filter( 'woocommerce_form_field' , 'remove_checkout_optional_fields_label', 10, 4 );

/**
 * Remove Additional information title on checkout
 */
add_action( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

/**
 * Chckout pages terms checkbox by default is checked.
 */
function imicra_terms_is_checked_default() {
	return 1;
}
add_filter( 'woocommerce_terms_is_checked_default', 'imicra_terms_is_checked_default' );

/**
 * Add Inline Field Error Notifications at Checkout
 */ 
function imicra_checkout_fields_in_label_error( $field, $key, $args, $value ) {
	if ( strpos( $field, '</span>' ) !== false && $args['required'] ) {
		 $error = '<span class="error" style="visibility: hidden;">';
		 $error .= sprintf( __( '%s is a required field.', 'woocommerce' ), $args['label'] );
		 $error .= '</span>';
		 $field = substr_replace( $field, $error, strpos( $field, '</span>' ), 0);
	}
	
	return $field;
}
add_filter( 'woocommerce_form_field', 'imicra_checkout_fields_in_label_error', 10, 4 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'imicra_woocommerce_header_cart' ) ) {
			imicra_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'imicra_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function imicra_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		imicra_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'imicra_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'imicra_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function imicra_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'imicra' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'imicra' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

/**
 * Ajax add to cart for single product
 */
function imicra_ajax_add_to_cart_cb() {
	$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_POST['quantity'] ) );
	$variation_id      = absint( $_POST['variation_id'] );
	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
	$product_status    = get_post_status( $product_id );

	if ( $passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status ) {
		
		do_action( 'woocommerce_ajax_added_to_cart', $product_id );

		if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
		}

		WC_AJAX :: get_refreshed_fragments();

	} else {

		$data = array(
			'error'       => true,
			'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
		);

		echo wp_send_json( $data );
	}

	wp_die();
}
add_action( 'wp_ajax_imicra_ajax_add_to_cart', 'imicra_ajax_add_to_cart_cb' );
add_action( 'wp_ajax_nopriv_imicra_ajax_add_to_cart', 'imicra_ajax_add_to_cart_cb' );

if ( ! function_exists( 'imicra_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function imicra_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php imicra_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}
