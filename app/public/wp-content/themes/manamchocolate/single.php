<?php
/**
 * The template for displaying all single posts
 *
 * @package ManamChocolate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main site-container single-post-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>

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
					<?php if ( has_category() ) : ?>
						<span class="cat-links">
							<?php esc_html_e( 'in', 'manamchocolate' ); ?>
							<?php the_category( ', ' ); ?>
						</span>
					<?php endif; ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail post-hero-thumbnail">
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

			<footer class="entry-footer">
				<?php
				$manamchocolate_tags = get_the_tag_list( '', ', ' );
				if ( $manamchocolate_tags ) :
					?>
					<div class="tags-links">
						<strong><?php esc_html_e( 'Tags:', 'manamchocolate' ); ?></strong>
						<?php echo $manamchocolate_tags; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endif; ?>
			</footer>
		</article>

		<?php
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Post', 'manamchocolate' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Post', 'manamchocolate' ) . '</span> <span class="nav-title">%title</span>',
			)
		);

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	endwhile;
	?>
</main><!-- #primary -->

<?php
get_footer();

