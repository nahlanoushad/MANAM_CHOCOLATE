<?php
/**
 * Template Name: Press / In the News Page
 * Description: Recreates the authentic Manam Chocolate Media / In the News editorial page.
 *
 * Implements:
 * - Floating Breadcrumbs: "Home / In the News"
 * - Authentic Page Header: "In the News" (HeroinePro-Regular, 44px, #282828)
 * - 13 Verified Editorial Features in exact reference order:
 *     1. TIME Magazine (World's Greatest Places 2024)
 *     2. The Week (Craft chocolate perceived in India)
 *     3. India Today (Retail and experiential store)
 *     4. Homegrown (Beauty & The Bean)
 *     5. Condé Nast Traveller (Starting right at the source)
 *     6. The Hindu (Quest to craft India's best chocolate)
 *     7. Travel + Leisure (Farmers are at the heart of Karkhana)
 *     8. Mid-Day (Progressive farmers harvesting cacao)
 *     9. The Indian Express (The great Indian chocolate factory)
 *     10. Harper's Bazaar (Celebration of Indian mangoes)
 *     11. LBB Hyderabad (Explore the Art of Chocolate Making)
 *     12. ThePrint (Putting Indian cacao on world map)
 *     13. Fortune India (Crafting India's Chocolate Story)
 * - Proportional high-resolution imagery and authentic publication logos
 * - Verified live external publication links opening in new tab
 * - Responsive alternating editorial layout matching the reference store
 *
 * @package ManamChocolate
 * @version 5.13.0
 */

get_header();

$theme_uri      = get_template_directory_uri();
$home_url       = home_url( '/' );
$press_articles = manamchocolate_get_press_articles();
?>

<main id="primary" class="site-main press-page-main">

	<!-- 1. BREADCRUMBS -->
	<nav class="product-breadcrumbs press-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
		<div class="site-container">
			<ol class="breadcrumb-list">
				<li class="breadcrumb-item"><a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a></li>
				<li class="breadcrumb-separator">/</li>
				<li class="breadcrumb-item breadcrumb-current" aria-current="page"><?php esc_html_e( 'In the News', 'manamchocolate' ); ?></li>
			</ol>
		</div>
	</nav>

	<!-- 2. EDITORIAL PAGE HEADER -->
	<header class="press-page-header">
		<div class="site-container">
			<div class="press-header-content text-center" data-reveal="fade">
				<h1 class="press-page-title"><?php esc_html_e( 'In the News', 'manamchocolate' ); ?></h1>
			</div>
		</div>
	</header>

	<!-- 3. PRESS ARTICLES FEED -->
	<section class="press-feed-section" aria-label="<?php esc_attr_e( 'Press and Media Articles', 'manamchocolate' ); ?>">
		<div class="site-container">

			<?php if ( ! empty( $press_articles ) ) : ?>
				<div class="press-articles-list">
					<?php foreach ( $press_articles as $idx => $article ) : 
						$is_reversed = ( 0 === $idx % 2 );
					?>
						<article class="press-article-block <?php echo $is_reversed ? 'is-reversed' : 'is-normal'; ?>" id="<?php echo esc_attr( $article['id'] ); ?>" data-reveal="fade">
							<div class="press-article-grid">

								<!-- Editorial Image Column -->
								<div class="press-article-media">
									<div class="press-article-image-ratio">
										<img
											src="<?php echo esc_url( $article['feature_image'] ); ?>"
											alt="<?php echo esc_attr( $article['headline'] ); ?>"
											class="press-article-photo"
											loading="lazy"
										/>
									</div>
								</div>

								<!-- Editorial Content Column -->
								<div class="press-article-content">
									<div class="press-article-meta-header">
										<?php if ( ! empty( $article['logo'] ) ) : ?>
											<div class="press-article-logo-wrap">
												<img
													src="<?php echo esc_url( $article['logo'] ); ?>"
													alt="<?php echo esc_attr( $article['publication'] ); ?>"
													class="press-pub-logo"
													loading="lazy"
												/>
											</div>
										<?php endif; ?>
										<?php if ( ! empty( $article['date'] ) ) : ?>
											<time class="press-article-date"><?php echo esc_html( $article['date'] ); ?></time>
										<?php endif; ?>
									</div>

									<h2 class="press-article-headline">
										<?php if ( ! empty( $article['url'] ) && '#' !== $article['url'] && home_url( '/pages/press' ) !== $article['url'] ) : ?>
											<a href="<?php echo esc_url( $article['url'] ); ?>" target="_blank" rel="noopener noreferrer">
												<?php echo esc_html( $article['headline'] ); ?>
											</a>
										<?php else : ?>
											<?php echo esc_html( $article['headline'] ); ?>
										<?php endif; ?>
									</h2>

									<div class="press-article-description">
										<p><?php echo esc_html( $article['description'] ); ?></p>
									</div>

									<?php if ( ! empty( $article['url'] ) && '#' !== $article['url'] && home_url( '/pages/press' ) !== $article['url'] ) : ?>
										<div class="press-article-action">
											<a href="<?php echo esc_url( $article['url'] ); ?>" class="button button--secondary press-read-btn" target="_blank" rel="noopener noreferrer">
												<span><?php esc_html_e( 'Read Full Article', 'manamchocolate' ); ?></span>
											</a>
										</div>
									<?php endif; ?>
								</div>

							</div><!-- .press-article-grid -->
						</article><!-- .press-article-block -->
					<?php endforeach; ?>
				</div><!-- .press-articles-list -->
			<?php endif; ?>

		</div><!-- .site-container -->
	</section><!-- .press-feed-section -->

</main><!-- #primary -->

<?php
get_footer();
