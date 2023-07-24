<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package imicra
 */

get_header();

get_template_part( 'template-parts/header/header', 'page' );
?>

	<main id="primary" class="site-main">
		<div class="container-fluid site-wrapper">
			<div class="row">
				<div class="col-md-8 order-2">

					<?php
					if ( have_posts() ) :

						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile; // End of the loop.

						the_posts_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );
			
					endif;
					?>

				</div><!-- .col -->
				<div class="col-md-4 order-1">

					<?php
					get_sidebar();
					?>

				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container-fluid -->
	</main><!-- #main -->

<?php
get_footer();