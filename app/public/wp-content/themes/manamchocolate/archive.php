<?php
/**
 * The template for displaying archive pages
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
	<?php if ( have_posts() ) : ?>

		<header class="page-header archive-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>

		<div class="posts-list archive-posts-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<header class="entry-header">
						<?php
						the_title(
							sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
							'</a></h2>'
						);
						?>
						<div class="entry-meta">
							<span class="posted-on">
								<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
							</span>
						</div>
					</header>

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>

					<footer class="entry-footer">
						<a href="<?php the_permalink(); ?>" class="read-more-link">
							<?php esc_html_e( 'Read More', 'manamchocolate' ); ?> &rarr;
						</a>
					</footer>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<?php
		the_posts_pagination(
			array(
				'prev_text' => '&larr; ' . esc_html__( 'Previous', 'manamchocolate' ),
				'next_text' => esc_html__( 'Next', 'manamchocolate' ) . ' &rarr;',
			)
		);
		?>

	<?php else : ?>

		<section class="no-results not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'manamchocolate' ); ?></h1>
			</header>
			<div class="page-content">
				<p><?php esc_html_e( 'No posts found in this archive.', 'manamchocolate' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</section>

	<?php endif; ?>
</main><!-- #primary -->

<?php
get_footer();

