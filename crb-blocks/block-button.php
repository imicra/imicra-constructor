<?php
/**
 * Display Section with specific design.
 *
 * Template name: Блок Кнопка CTA
 * Template Post Type: blocks
 * 
 * @package imicra
 */

$prefix = 'imicra';
$text = carbon_get_post_meta( $args, $prefix . '_block_button_text' );
?>
<section class="block-button pt-3 pb-3 pb-md-5">
  <div class="container-fluid site-wrapper">
    <div class="row">
      <div class="col">
        <div class="text-center pb-3 pb-md-5">
          <button class="btn btn-primary h3 shadow-lg">
            <span class="px-3">
              <?php echo wp_kses_post( $text ); ?>
            </span>
          </button>
        </div>
      </div>
    </div><!-- .row -->
  </div>
</section>