<?php
/**
 * Display Section default on the Front Page
 *
 * @package imicra
 */

$prefix = 'imicra';
$section = carbon_get_post_meta( get_the_ID(), $prefix . '_crb_textarea' );

?>
<section>
  <div class="container-fluid site-wrapper">
    <div class="row">
      <div class="col">
        <?php if ( ! empty( $section ) ) : ?>
          <h2><?php echo wp_kses_post( $section ); ?></h2>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>