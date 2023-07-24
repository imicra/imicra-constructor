<?php
/**
 * The template for displaying page with custom design.
 *
 * Template name: Конструктор дизайна
 *
 * @package imicra
 */

$prefix = 'imicra';
$sections = carbon_get_the_post_meta( $prefix . '_crb_blocks' );

get_header();

get_template_part( 'template-parts/header/header', 'breadcrumb' );
?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			// echo '<pre>' . print_r( $sections, true ) . '</pre>';
			foreach ( $sections as $section ) {
				switch ( $section['_type'] ) {
					case 'crb_blocks':
						$block_id = $section['imicra_crb_block'][0]['id'];
						$block_template = get_page_template_slug( $block_id );
						locate_template( $block_template, true, false, $block_id );
						break;

					default:
						break;
				}
			}
			?>
		<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();
