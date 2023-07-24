<?php
/**
 * The header section for pages
 *
 * @package imicra
 */

?>
<div class="page-header container-fluid section-bg-gradient">
  <div class="row site-wrapper mx-auto">
    <div class="col py-5">
      <?php
      $title = '';

      if ( is_post_type_archive() ) :
        $post_type = get_post_type_object( get_post_type( $post ) );
        $post_type_title = $post_type->labels->name;

        $title = $post_type_title;

      elseif ( is_tax() ) :
        global $wp_query;
        $tax = $wp_query->get_queried_object();

        $title = $tax->name;

      elseif ( is_home() ) :
        $title = single_post_title( '', false );

      elseif ( is_singular( 'post' ) || is_category() ) :
        $title = 'Новости';

      elseif ( is_search() ) :
        $title = 'Поиск';

      elseif ( is_404() ) :
        $title = 'Поиск';

      else :
        $title = get_the_title( get_the_ID() );

      endif;
      ?>
      <h1 class="page-header__title h2 text-white font-weight-bold py-2 py-md-4 mb-0"><?php echo $title; ?></h1>
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->