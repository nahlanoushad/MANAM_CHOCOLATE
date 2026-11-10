<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ManamChocolate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main site-container error-404 not-found">
	<div class="error-404-container">
		<header class="page-header">
			<span class="error-code">404</span>
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'manamchocolate' ); ?></h1>
		</header>

		<div class="page-content">
			<p>
				<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching for what you need or return to the homepage.', 'manamchocolate' ); ?>
			</p>

			<div class="error-actions">
				<?php get_search_form(); ?>

				<div class="back-home-wrapper">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
						&larr; <?php esc_html_e( 'Return to Homepage', 'manamchocolate' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</main><!-- #primary -->

<?php
get_footer();

