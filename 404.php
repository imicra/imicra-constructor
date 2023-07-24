<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Извините. Такой страницы не существует.', 'imicra' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'Обычно такое происходит при неверно введенном адресе страницы. Можете воспользоваться одной из ссылок ниже или поиском.', 'imicra' ); ?></p>

								<?php
								get_search_form();

								the_widget( 'WP_Widget_Recent_Posts' );
								?>

								<div class="widget widget_categories">
									<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'imicra' ); ?></h2>
									<ul>
										<?php
										wp_list_categories(
											array(
												'orderby'    => 'count',
												'order'      => 'DESC',
												'show_count' => 1,
												'title_li'   => '',
												'number'     => 10,
											)
										);
										?>
									</ul>
								</div><!-- .widget -->

								<?php
								/* translators: %1$s: smiley */
								$imicra_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'imicra' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$imicra_archive_content" );

								the_widget( 'WP_Widget_Tag_Cloud' );
								?>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->

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