<?php
/**
 * Template part for displaying the "Featured In" homepage section
 *
 * Implements:
 * - Section Subheading: "FEATURED IN"
 * - 6 Verified Publication Links & Mastheads:
 *   1. TIME
 *   2. Travel + Leisure
 *   3. The Hindu
 *   4. The Week
 *   5. Condé Nast Traveler
 *   6. Forbes
 * - Synchronized Editorial Quote Carousel
 * - Authentic vermilion quotation accent (#E9510C)
 * - Desktop Prev / Next arrow controls
 * - Mobile 6-dot navigation & touch swipe support
 *
 * @package ManamChocolate
 * @since 1.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
$theme_dir = get_template_directory();

$featured_editorial_items = array(
	array(
		'id'          => 'time',
		'name'        => 'TIME',
		'badge'       => "World's Greatest Places",
		'logo'        => 'press-logo-time.png',
		'width'       => 1022,
		'height'      => 1146,
		'url'         => 'https://time.com/6992360/manam-chocolate/',
		'quote'       => 'Muppala takes the family tradition forward to contemplate the future of Indian craft chocolate. In contrast to Swiss and Belgian chocolates, which are widely seen as the gold standard, “we have an origin story here,” he says.',
		'author'      => 'TIME',
		'style_class' => 'pub-time',
	),
	array(
		'id'          => 'travel-leisure',
		'name'        => 'Travel + Leisure',
		'badge'       => '',
		'logo'        => 'press-logo-travel-leisure.png',
		'width'       => 451,
		'height'      => 141,
		'url'         => 'https://www.travelandleisureasia.com/in/dining/manam',
		'quote'       => 'Farmers are at the heart of the Manam Karkhana. One can pick single farm bars where farmers like GVS Prasad and GP Rao have dedicated tablets made from cacao that they grow.',
		'author'      => 'Travel + Leisure',
		'style_class' => 'pub-travel-leisure',
	),
	array(
		'id'          => 'the-hindu',
		'name'        => 'The Hindu',
		'badge'       => '',
		'logo'        => 'press-logo-the-hindu.png',
		'width'       => 451,
		'height'      => 141,
		'url'         => 'https://www.thehindu.com/food/features/manam-in-hyderabad-is-on-a-quest-to-craft-indias-best-chocolate/article67167222.ece',
		'quote'       => 'Manam in Hyderabad is on a quest to craft India’s best chocolate.',
		'author'      => 'The Hindu',
		'style_class' => 'pub-the-hindu',
	),
	array(
		'id'          => 'the-week',
		'name'        => 'The Week',
		'badge'       => '',
		'logo'        => 'press-logo-the-week.png',
		'width'       => 451,
		'height'      => 141,
		'url'         => 'https://www.theweek.in/leisure/lifestyle/2023/09/04/for-the-love-of-chocolate-how-a-hyderabad-brand-is-changing-the-taste-of-cacao-farmers-in-godavari-region.html',
		'quote'       => 'Manam promises to revolutionalise the way a craft chocolate is perceived in India',
		'author'      => 'The Week',
		'style_class' => 'pub-the-week',
	),
	array(
		'id'          => 'conde-nast',
		'name'        => 'Condé Nast Traveler',
		'badge'       => '',
		'logo'        => 'press-logo-cnt.png',
		'width'       => 451,
		'height'      => 141,
		'url'         => 'https://www.cntraveller.in/story/this-new-hyderabad-based-craft-chocolate-bean-to-bar-brand-melds-tech-and-tradition/',
		'quote'       => 'Manam Chocolate is building a world of fine Indian cacao confections by starting right at the source.',
		'author'      => 'Condé Nast Traveler',
		'style_class' => 'pub-conde-nast',
	),
	array(
		'id'          => 'forbes',
		'name'        => 'Forbes',
		'badge'       => '',
		'logo'        => 'press-logo-forbes.png',
		'width'       => 187,
		'height'      => 50,
		'url'         => 'https://www.forbesindia.com/article/lifes/indian-luxe-chocolates-are-having-a-moment-under-the-sun/89679/1',
		'quote'       => 'Manam\'s store was vindicated in the aftermath of its launch when the police had to shut down its 10,000 sq ft chocolateries-cafe in Hyderabad’s Banjara Hills for three days due to crowding and the ensuing traffic jam.',
		'author'      => 'Forbes',
		'style_class' => 'pub-forbes',
	),
);
?>

<section class="homepage-section featured-in-section" id="featured-in" aria-labelledby="featured-in-heading">
	<div class="featured-in-color-wrapper">
		<div class="site-container">

			<!-- Header -->
			<header class="section-header featured-in-header" data-reveal="up">
				<h2 id="featured-in-heading" class="featured-in-title">
					<?php esc_html_e( 'FEATURED IN', 'manamchocolate' ); ?>
				</h2>
			</header>

			<!-- Publication Logos / Mastheads Row -->
			<div class="featured-in-logos-container" data-reveal="up">
				<div class="featured-in-logos-scroller hide-scrollbar" role="region" aria-label="<?php esc_attr_e( 'Publications', 'manamchocolate' ); ?>">
					<div class="featured-in-logos-list">
						<?php foreach ( $featured_editorial_items as $index => $item ) :
							$logo_rel = '/assets/images/press-logos/' . $item['logo'];
							$has_logo = file_exists( $theme_dir . $logo_rel );
						?>
							<a
								href="<?php echo esc_url( $item['url'] ); ?>"
								class="featured-logo-item <?php echo 0 === $index ? 'is-active' : ''; ?>"
								data-slide-index="<?php echo esc_attr( $index ); ?>"
								target="_blank"
								rel="noopener noreferrer"
								title="<?php echo esc_attr( sprintf( __( 'Read about Manam Chocolate in %s (opens in new tab)', 'manamchocolate' ), $item['name'] ) ); ?>"
								aria-label="<?php echo esc_attr( sprintf( __( 'Read about Manam Chocolate in %s (opens in new tab)', 'manamchocolate' ), $item['name'] ) ); ?>"
							>
								<?php if ( $has_logo ) : ?>
									<img
										src="<?php echo esc_url( $theme_uri . $logo_rel ); ?>"
										alt="<?php echo esc_attr( $item['name'] ); ?>"
										width="<?php echo esc_attr( $item['width'] ); ?>"
										height="<?php echo esc_attr( $item['height'] ); ?>"
										loading="lazy"
										class="featured-logo-img pub-logo-<?php echo esc_attr( $item['id'] ); ?>"
									/>
								<?php else : ?>
									<span class="featured-logo-wordmark <?php echo esc_attr( $item['style_class'] ); ?>">
										<?php if ( ! empty( $item['badge'] ) ) : ?>
											<span class="wordmark-badge"><?php echo esc_html( $item['badge'] ); ?></span>
										<?php endif; ?>
										<span class="wordmark-text"><?php echo esc_html( $item['name'] ); ?></span>
									</span>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div><!-- .featured-in-logos-list -->
				</div><!-- .featured-in-logos-scroller -->
			</div><!-- .featured-in-logos-container -->

			<!-- Editorial Quotes Carousel -->
			<div class="featured-quotes-carousel" id="featured-quotes-carousel" data-total-slides="<?php echo esc_attr( count( $featured_editorial_items ) ); ?>" data-reveal="fade">
				<div class="featured-quotes-wrapper">
					<?php foreach ( $featured_editorial_items as $index => $item ) : ?>
						<article
							class="featured-quote-item <?php echo 0 === $index ? 'is-active' : ''; ?>"
							id="featured-quote-<?php echo esc_attr( $index ); ?>"
							data-index="<?php echo esc_attr( $index ); ?>"
							role="tabpanel"
							aria-label="<?php echo esc_attr( sprintf( __( 'Quote %d of %d: %s', 'manamchocolate' ), $index + 1, count( $featured_editorial_items ), $item['name'] ) ); ?>"
							<?php echo 0 !== $index ? 'hidden' : ''; ?>
						>
							<div class="featured-quote-layout">
								<!-- Decorative Vermilion Quote Mark -->
								<div class="featured-quote-mark-wrap" aria-hidden="true">
									<svg class="featured-quote-mark-icon" width="60" height="48" viewBox="0 0 60 48" fill="none" focusable="false">
										<path d="M0 48V28.8C0 12.8 9.6 3.2 24 0L27.2 6.4C19.2 8.8 14.4 14.4 13.6 20.8H26.4V48H0ZM33.6 48V28.8C33.6 12.8 43.2 3.2 57.6 0L60.8 6.4C52.8 8.8 48 14.4 47.2 20.8H60V48H33.6Z" fill="#E9510C"/>
									</svg>
								</div>

								<!-- Quote Content & Author -->
								<div class="featured-quote-content-wrap">
									<blockquote class="featured-quote-content">
										<p class="featured-quote-text">
											<?php echo esc_html( $item['quote'] ); ?>
										</p>
									</blockquote>
									<p class="featured-quote-author">
										<?php echo esc_html( $item['author'] ); ?>
									</p>
								</div>
							</div><!-- .featured-quote-layout -->
						</article><!-- .featured-quote-item -->
					<?php endforeach; ?>
				</div><!-- .featured-quotes-wrapper -->

				<!-- Navigation Controls -->
				<div class="featured-quotes-nav">
					<!-- Desktop Arrows -->
					<div class="featured-nav-arrows">
						<button
							type="button"
							class="featured-nav-arrow featured-nav-prev"
							id="featured-nav-prev"
							aria-label="<?php esc_attr_e( 'Previous testimonial', 'manamchocolate' ); ?>"
						>
							<svg focusable="false" width="17" height="14" viewBox="0 0 17 14" fill="none" aria-hidden="true">
								<path d="M17 7H2M8 1L2 7l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>

						<button
							type="button"
							class="featured-nav-arrow featured-nav-next"
							id="featured-nav-next"
							aria-label="<?php esc_attr_e( 'Next testimonial', 'manamchocolate' ); ?>"
						>
							<svg focusable="false" width="17" height="14" viewBox="0 0 17 14" fill="none" aria-hidden="true">
								<path d="M0 7h15M9 1l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div><!-- .featured-nav-arrows -->

					<!-- Mobile Page Dots -->
					<div class="featured-dots-nav" role="tablist" aria-label="<?php esc_attr_e( 'Featured In pagination', 'manamchocolate' ); ?>">
						<?php foreach ( $featured_editorial_items as $index => $item ) : ?>
							<button
								type="button"
								class="featured-dot-btn <?php echo 0 === $index ? 'is-active' : ''; ?>"
								data-index="<?php echo esc_attr( $index ); ?>"
								aria-label="<?php echo esc_attr( sprintf( __( 'Go to quote %d (%s)', 'manamchocolate' ), $index + 1, $item['name'] ) ); ?>"
								aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
								role="tab"
							></button>
						<?php endforeach; ?>
					</div><!-- .featured-dots-nav -->
				</div><!-- .featured-quotes-nav -->

			</div><!-- .featured-quotes-carousel -->

		</div><!-- .site-container -->
	</div><!-- .featured-in-color-wrapper -->
</section><!-- .featured-in-section -->

