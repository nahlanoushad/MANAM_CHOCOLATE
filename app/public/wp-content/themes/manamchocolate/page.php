<?php
/**
 * The template for displaying all single pages
 *
 * @package ManamChocolate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main site-container">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail page-thumbnail">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'manamchocolate' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>

		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	endwhile;
	?>
</main><!-- #primary -->

<?php
get_footer();

