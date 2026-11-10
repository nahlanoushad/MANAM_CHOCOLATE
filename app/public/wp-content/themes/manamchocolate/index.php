<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (along with style.css).
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

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<div class="posts-list">
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
							<span class="byline">
								<?php esc_html_e( 'by', 'manamchocolate' ); ?>
								<span class="author vcard">
									<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
										<?php echo esc_html( get_the_author() ); ?>
									</a>
								</span>
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
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'manamchocolate' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</section>

	<?php endif; ?>
</main><!-- #primary -->

<?php
get_footer();

