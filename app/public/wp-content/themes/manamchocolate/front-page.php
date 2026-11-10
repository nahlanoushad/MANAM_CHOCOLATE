<?php
/**
 * The template for displaying the custom front page
 *
 * Implements:
 * SECTION 0: Promotional Hero Slideshow (Diwali 2026 - Homecoming Edit)
 * SECTION 1: Explore Our Collections (5 collection cards)
 * SECTION 2: Brand Introduction / Hero Section (Born in Nature. Crafted by Manam.)
 * SECTION 3: Discover Products (Tabs: Favourite, Gifting, Maker Recommended)
 * SECTION 4: Our Craft (Before the Bean. Beyond the Bar.)
 * SECTION 5: Featured In (Editorial Quotations)
 * SECTION 6: Manam Chocolate Karkhana (Flagship Experiential Space Showcase)
 *
 * @package ManamChocolate
 * @since 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri = get_template_directory_uri();
$theme_dir = get_template_directory();
$home_url  = home_url( '/' );

// Build Hero Promotional Slides array (Discovered from official reference website)
$s1_desktop_file = file_exists( $theme_dir . '/assets/images/hero/hero-slide-01-desktop.jpg' )
	? $theme_uri . '/assets/images/hero/hero-slide-01-desktop.jpg'
	: $theme_uri . '/assets/images/hero-desktop.jpg';
$s1_mobile_file  = file_exists( $theme_dir . '/assets/images/hero/hero-slide-01-mobile.jpg' )
	? $theme_uri . '/assets/images/hero/hero-slide-01-mobile.jpg'
	: $theme_uri . '/assets/images/hero-mobile.jpg';

$s2_desktop_file = file_exists( $theme_dir . '/assets/images/hero/hero-slide-02-desktop.jpg' )
	? $theme_uri . '/assets/images/hero/hero-slide-02-desktop.jpg'
	: '';
$s2_mobile_file  = file_exists( $theme_dir . '/assets/images/hero/hero-slide-02-mobile.jpg' )
	? $theme_uri . '/assets/images/hero/hero-slide-02-mobile.jpg'
	: '';

$hero_slides = array(
	1 => array(
		'id'         => 'hero-slide-1',
		'campaign'   => __( 'Diwali 2026 - Homecoming Edit', 'manamchocolate' ),
		'link'       => $home_url . 'product-category/diwali-2026/',
		'desktop'    => $s1_desktop_file,
		'mobile'     => $s1_mobile_file,
		'alt'        => __( 'Manam Chocolate Diwali 2026 - Homecoming Edit Campaign - Order Now', 'manamchocolate' ),
		'loading'    => 'eager',
		'fetchprior' => 'high',
	),
);

if ( ! empty( $s2_desktop_file ) && ! empty( $s2_mobile_file ) ) {
	$hero_slides[2] = array(
		'id'         => 'hero-slide-2',
		'campaign'   => __( 'Diwali 2026 - Indian Craft Chocolate Edition', 'manamchocolate' ),
		'link'       => $home_url . 'product-category/diwali-2026/',
		'desktop'    => $s2_desktop_file,
		'mobile'     => $s2_mobile_file,
		'alt'        => __( 'Manam Chocolate Diwali 2026 - Indian Craft Chocolate Edition - Order Now', 'manamchocolate' ),
		'loading'    => 'lazy',
		'fetchprior' => 'auto',
	);
}
?>

<main id="primary" class="site-main front-page-main">

	<!-- ======================================================================
	     HOMEPAGE SECTION 0: PROMOTIONAL HERO BANNER SLIDESHOW
	     ====================================================================== -->
	<section
		class="homepage-section hero-promotional-section"
		id="hero-promotional-slideshow"
		aria-label="<?php esc_attr_e( 'Promotional Hero Slideshow', 'manamchocolate' ); ?>"
		data-autoplay="true"
		data-interval="5000"
		data-total-slides="<?php echo esc_attr( count( $hero_slides ) ); ?>"
	>
		<div class="hero-slides-wrapper" id="hero-slides-wrapper">
			<?php foreach ( $hero_slides as $index => $slide ) :
				$is_active = ( 1 === $index );
			?>
				<div
					class="hero-slide<?php echo $is_active ? ' is-active' : ''; ?>"
					id="<?php echo esc_attr( $slide['id'] ); ?>"
					data-slide-index="<?php echo esc_attr( $index - 1 ); ?>"
					role="group"
					aria-roledescription="slide"
					aria-label="<?php echo esc_attr( sprintf( __( 'Slide %d of %d: %s', 'manamchocolate' ), $index, count( $hero_slides ), $slide['campaign'] ) ); ?>"
					<?php echo ! $is_active ? 'aria-hidden="true"' : 'aria-hidden="false"'; ?>
				>
					<a
						href="<?php echo esc_url( $slide['link'] ); ?>"
						class="hero-promotional-link"
						aria-label="<?php echo esc_attr( $slide['alt'] ); ?>"
					>
						<span class="screen-reader-text"><?php echo esc_html( $slide['alt'] ); ?></span>
						<div class="hero-promotional-visual-wrap">
							<picture class="hero-picture">
								<source media="(max-width: 767px)" srcset="<?php echo esc_url( $slide['mobile'] ); ?>" width="1000" height="1400">
								<img
									src="<?php echo esc_url( $slide['desktop'] ); ?>"
									alt="<?php echo esc_attr( $slide['alt'] ); ?>"
									width="2160"
									height="1080"
									loading="<?php echo esc_attr( $slide['loading'] ); ?>"
									fetchpriority="<?php echo esc_attr( $slide['fetchprior'] ); ?>"
									class="hero-img"
								/>
							</picture>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( count( $hero_slides ) > 1 ) : ?>
			<!-- Slide Progress Bar Navigation -->
			<nav class="hero-slideshow-nav" role="tablist" aria-label="<?php esc_attr_e( 'Hero Slideshow Pagination', 'manamchocolate' ); ?>">
				<?php foreach ( $hero_slides as $index => $slide ) :
					$is_active = ( 1 === $index );
				?>
					<button
						type="button"
						class="hero-progress-btn<?php echo $is_active ? ' is-active' : ''; ?>"
						id="hero-tab-<?php echo esc_attr( $index - 1 ); ?>"
						role="tab"
						aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
						aria-current="<?php echo $is_active ? 'true' : 'false'; ?>"
						aria-controls="<?php echo esc_attr( $slide['id'] ); ?>"
						data-slide-target="<?php echo esc_attr( $index - 1 ); ?>"
						aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %d: %s', 'manamchocolate' ), $index, $slide['campaign'] ) ); ?>"
					>
						<span class="hero-progress-bar-fill" aria-hidden="true"></span>
					</button>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>
	</section>

	<!-- ======================================================================
	     HOMEPAGE SECTION 1: EXPLORE OUR COLLECTIONS
	     ====================================================================== -->
	<section class="homepage-section collections-section" aria-labelledby="collections-heading">
		<div class="site-container">
			<header class="section-header collections-header" data-reveal="up">
				<span class="section-subtitle"><?php esc_html_e( 'Explore Our', 'manamchocolate' ); ?></span>
				<h2 id="collections-heading" class="section-title"><?php esc_html_e( 'Collections', 'manamchocolate' ); ?></h2>
			</header>

			<div class="collections-grid" data-reveal-group>
				<!-- Card 1: Gifting Collection (Featured Highlight) -->
				<article class="collection-card collection-card--highlight" data-reveal="up">
					<?php
					$gift_term = get_term_by( 'slug', 'gifting', 'product_cat' );
					$gift_url  = $gift_term ? get_term_link( $gift_term ) : $home_url . 'product-category/gifting/';
					$gift_img  = file_exists( get_template_directory() . '/assets/images/collection-gifting.webp' )
						? $theme_uri . '/assets/images/collection-gifting.webp'
						: $theme_uri . '/assets/images/collection-gifting.svg';
					?>
					<a href="<?php echo esc_url( $gift_url ); ?>" class="collection-card-link">
						<div class="collection-card-image-wrap">
							<img
								src="<?php echo esc_url( $gift_img ); ?>"
								alt="<?php esc_attr_e( 'Manam Curated Gifting Collection', 'manamchocolate' ); ?>"
								width="1000"
								height="603"
								loading="lazy"
								class="collection-img"
							/>
						</div>
						<div class="collection-card-info">
							<h3 class="collection-name"><?php esc_html_e( 'Gifting Collection', 'manamchocolate' ); ?></h3>
							<span class="collection-action">
								<span><?php esc_html_e( 'Explore', 'manamchocolate' ); ?></span>
								<svg class="collection-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
									<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="currentColor"/>
								</svg>
							</span>
						</div>
					</a>
				</article>

				<!-- Card 2: Tablet Collection -->
				<article class="collection-card" data-reveal="up">
					<?php
					$tablet_term = get_term_by( 'slug', 'tablet-collection', 'product_cat' );
					$tablet_url  = $tablet_term ? get_term_link( $tablet_term ) : $home_url . 'product-category/tablet-collection/';
					$tablet_img  = file_exists( get_template_directory() . '/assets/images/collection-tablets.png' )
						? $theme_uri . '/assets/images/collection-tablets.png'
						: $theme_uri . '/assets/images/collection-tablets.svg';
					?>
					<a href="<?php echo esc_url( $tablet_url ); ?>" class="collection-card-link">
						<div class="collection-card-image-wrap">
							<img
								src="<?php echo esc_url( $tablet_img ); ?>"
								alt="<?php esc_attr_e( 'Manam Single-Origin Craft Chocolate Tablets', 'manamchocolate' ); ?>"
								width="1240"
								height="746"
								loading="lazy"
								class="collection-img"
							/>
						</div>
						<div class="collection-card-info">
							<h3 class="collection-name"><?php esc_html_e( 'Tablet Collection', 'manamchocolate' ); ?></h3>
							<span class="collection-action">
								<span><?php esc_html_e( 'Explore', 'manamchocolate' ); ?></span>
								<svg class="collection-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
									<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="currentColor"/>
								</svg>
							</span>
						</div>
					</a>
				</article>

				<!-- Card 3: Indulgence Collection -->
				<article class="collection-card" data-reveal="up">
					<?php
					$ind_term = get_term_by( 'slug', 'indulgence-collection', 'product_cat' );
					$ind_url  = $ind_term ? get_term_link( $ind_term ) : $home_url . 'product-category/indulgence-collection/';
					$ind_img  = file_exists( get_template_directory() . '/assets/images/collection-indulgence.jpg' )
						? $theme_uri . '/assets/images/collection-indulgence.jpg'
						: $theme_uri . '/assets/images/collection-indulgence.svg';
					?>
					<a href="<?php echo esc_url( $ind_url ); ?>" class="collection-card-link">
						<div class="collection-card-image-wrap">
							<img
								src="<?php echo esc_url( $ind_img ); ?>"
								alt="<?php esc_attr_e( 'Manam Artisanal Bonbons and Palettes Collection', 'manamchocolate' ); ?>"
								width="1240"
								height="752"
								loading="lazy"
								class="collection-img"
							/>
						</div>
						<div class="collection-card-info">
							<h3 class="collection-name"><?php esc_html_e( 'Indulgence Collection', 'manamchocolate' ); ?></h3>
							<span class="collection-action">
								<span><?php esc_html_e( 'Explore', 'manamchocolate' ); ?></span>
								<svg class="collection-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
									<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="currentColor"/>
								</svg>
							</span>
						</div>
					</a>
				</article>

				<!-- Card 4: Snacking Collection -->
				<article class="collection-card" data-reveal="up">
					<?php
					$snack_term = get_term_by( 'slug', 'the-snacking-collection', 'product_cat' );
					$snack_url  = $snack_term ? get_term_link( $snack_term ) : $home_url . 'product-category/the-snacking-collection/';
					$snack_img  = file_exists( get_template_directory() . '/assets/images/collection-snacking.png' )
						? $theme_uri . '/assets/images/collection-snacking.png'
						: $theme_uri . '/assets/images/collection-snacking.svg';
					?>
					<a href="<?php echo esc_url( $snack_url ); ?>" class="collection-card-link">
						<div class="collection-card-image-wrap">
							<img
								src="<?php echo esc_url( $snack_img ); ?>"
								alt="<?php esc_attr_e( 'Manam Chocolate Barks, Clusters and Dragees Snacking Collection', 'manamchocolate' ); ?>"
								width="1240"
								height="746"
								loading="lazy"
								class="collection-img"
							/>
						</div>
						<div class="collection-card-info">
							<h3 class="collection-name"><?php esc_html_e( 'Snacking Collection', 'manamchocolate' ); ?></h3>
							<span class="collection-action">
								<span><?php esc_html_e( 'Explore', 'manamchocolate' ); ?></span>
								<svg class="collection-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
									<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="currentColor"/>
								</svg>
							</span>
						</div>
					</a>
				</article>

				<!-- Card 5: Pantry Collection -->
				<article class="collection-card" data-reveal="up">
					<?php
					$pantry_term = get_term_by( 'slug', 'pantry-collection', 'product_cat' );
					$pantry_url  = $pantry_term ? get_term_link( $pantry_term ) : $home_url . 'product-category/pantry-collection/';
					$pantry_img  = file_exists( get_template_directory() . '/assets/images/collection-pantry.jpg' )
						? $theme_uri . '/assets/images/collection-pantry.jpg'
						: $theme_uri . '/assets/images/collection-pantry.svg';
					?>
					<a href="<?php echo esc_url( $pantry_url ); ?>" class="collection-card-link">
						<div class="collection-card-image-wrap">
							<img
								src="<?php echo esc_url( $pantry_img ); ?>"
								alt="<?php esc_attr_e( 'Manam Chocolate Spreads and Drinking Chocolate Pantry Collection', 'manamchocolate' ); ?>"
								width="800"
								height="550"
								loading="lazy"
								class="collection-img"
							/>
						</div>
						<div class="collection-card-info">
							<h3 class="collection-name"><?php esc_html_e( 'Pantry Collection', 'manamchocolate' ); ?></h3>
							<span class="collection-action">
								<span><?php esc_html_e( 'Explore', 'manamchocolate' ); ?></span>
								<svg class="collection-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
									<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="currentColor"/>
								</svg>
							</span>
						</div>
					</a>
				</article>
			</div><!-- .collections-grid -->
		</div><!-- .site-container -->
	</section>

	<!-- ======================================================================
	     HOMEPAGE SECTION 2: BRAND INTRODUCTION / HERO SECTION
	     ====================================================================== -->
	<section class="homepage-section brand-intro-section" aria-labelledby="brand-intro-heading">
		<!-- Large Featured Visual Area -->
		<div class="brand-intro-visual-wrap" data-reveal="scale">
			<picture>
				<source media="(max-width: 999px)" srcset="<?php echo esc_url( $theme_uri . '/assets/images/brand-cacao-story-mobile.jpg' ); ?>" width="780" height="548">
				<img
					src="<?php echo esc_url( $theme_uri . '/assets/images/brand-cacao-story.jpg' ); ?>"
					alt="<?php esc_attr_e( 'Botanical cacao groves in West Godavari, India - Born in Nature, Crafted by Manam', 'manamchocolate' ); ?>"
					width="1920"
					height="1440"
					loading="lazy"
					class="brand-intro-visual"
				/>
			</picture>
		</div>

		<!-- Brand Introduction Text Container -->
		<div class="brand-intro-content-container">
			<div class="site-container brand-intro-inner">
				<div class="brand-intro-text-box" data-reveal="up">
					<h2 id="brand-intro-heading" class="brand-intro-title">
						<?php esc_html_e( 'BORN IN NATURE. CRAFTED BY MANAM.', 'manamchocolate' ); ?>
					</h2>
					<div class="brand-intro-body">
						<p class="brand-intro-lead">
							<?php esc_html_e( 'We are farmers, fermenters, chocolate makers, chocolatiers and storytellers from India, in search of a distinct identity for chocolate that we can proudly call our own.', 'manamchocolate' ); ?>
						</p>
						<p class="brand-intro-text">
							<?php esc_html_e( 'In our pursuit, we are expressing the true flavours of Indian Cacao in endless interpretations of chocolate.', 'manamchocolate' ); ?>
						</p>
					</div>
					<div class="brand-intro-action">
						<a href="<?php echo esc_url( $home_url . 'about-us' ); ?>" class="btn-primary brand-story-btn">
							<?php esc_html_e( 'Our Story', 'manamchocolate' ); ?>
						</a>
					</div>
				</div><!-- .brand-intro-text-box -->
			</div><!-- .site-container -->
		</div><!-- .brand-intro-content-container -->
	</section>

	<!-- ======================================================================
	     HOMEPAGE SECTION 3: DISCOVER PRODUCTS (FAVOURITE, GIFTING, MAKER RECOMMENDED)
	     ====================================================================== -->
	<?php get_template_part( 'template-parts/home/section', 'discover' ); ?>

	<!-- ======================================================================
	     HOMEPAGE SECTION 4: OUR CRAFT (BEFORE THE BEAN. BEYOND THE BAR.)
	     ====================================================================== -->
	<?php get_template_part( 'template-parts/home/section', 'craft' ); ?>

	<!-- ======================================================================
	     HOMEPAGE SECTION 5: FEATURED IN (EDITORIAL QUOTATIONS)
	     ====================================================================== -->
	<?php get_template_part( 'template-parts/home/section', 'featured-in' ); ?>

	<!-- ======================================================================
	     HOMEPAGE SECTION 6: MANAM CHOCOLATE KARKHANA (VISUAL SHOWCASE)
	     ====================================================================== -->
	<?php get_template_part( 'template-parts/home/section', 'karkhana' ); ?>

</main><!-- #primary -->

<?php
get_footer();
