<?php
/**
 * Template Name: Collections Directory
 *
 * Displays the complete Manam Chocolate collections directory.
 * Visual grid showcasing each collection with banner images, titles, descriptions, item counts, and direct links.
 *
 * @package ManamChocolate
 * @since 1.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri = get_template_directory_uri();
$home_url  = home_url( '/' );

$theme_dir = get_template_directory();

$collections_list = array(
	array(
		'slug'        => 'tablet-collection',
		'name'        => __( 'Tablet Collection', 'manamchocolate' ),
		'description' => __( 'Single Origin & Single Farm Indian craft chocolate tablets expressing the distinct terroir of Indian cacao.', 'manamchocolate' ),
		'image'       => file_exists( $theme_dir . '/assets/images/collection-tablets.png' )
			? $theme_uri . '/assets/images/collection-tablets.png'
			: $theme_uri . '/assets/images/collection-tablets.svg',
	),
	array(
		'slug'        => 'indulgence-collection',
		'name'        => __( 'Indulgence Collection', 'manamchocolate' ),
		'description' => __( 'Fine thins, bonbons, palettes, and handcrafted confections made for pure moments of indulgence.', 'manamchocolate' ),
		'image'       => file_exists( $theme_dir . '/assets/images/collection-indulgence.jpg' )
			? $theme_uri . '/assets/images/collection-indulgence.jpg'
			: $theme_uri . '/assets/images/collection-indulgence.svg',
	),
	array(
		'slug'        => 'the-snacking-collection',
		'name'        => __( 'The Snacking Collection', 'manamchocolate' ),
		'description' => __( 'Everyday bites, crunchy chocolate clusters, roasted barks, dragees, and sea salt cacao nibs.', 'manamchocolate' ),
		'image'       => file_exists( $theme_dir . '/assets/images/collection-snacking.png' )
			? $theme_uri . '/assets/images/collection-snacking.png'
			: $theme_uri . '/assets/images/collection-snacking.svg',
	),
	array(
		'slug'        => 'gifting',
		'name'        => __( 'Gifting', 'manamchocolate' ),
		'description' => __( 'Signature celebration tins, curated tablet libraries, and festive luxury hampers for memorable gifting.', 'manamchocolate' ),
		'image'       => file_exists( $theme_dir . '/assets/images/collection-gifting.webp' )
			? $theme_uri . '/assets/images/collection-gifting.webp'
			: $theme_uri . '/assets/images/collection-gifting.svg',
	),
	array(
		'slug'        => 'pantry-collection',
		'name'        => __( 'Pantry Collection', 'manamchocolate' ),
		'description' => __( 'Artisanal drinking chocolate mixes, roasted cacao nibs, and chef-grade baking chocolate essentials.', 'manamchocolate' ),
		'image'       => file_exists( $theme_dir . '/assets/images/collection-pantry.jpg' )
			? $theme_uri . '/assets/images/collection-pantry.jpg'
			: $theme_uri . '/assets/images/collection-pantry.svg',
	),
	array(
		'slug'        => 'award-winning',
		'name'        => __( 'Award Winning', 'manamchocolate' ),
		'description' => __( 'Our globally celebrated tablets and creations recognized at the International Chocolate Awards.', 'manamchocolate' ),
		'image'       => file_exists( $theme_dir . '/assets/images/collection-tablets.png' )
			? $theme_uri . '/assets/images/collection-tablets.png'
			: $theme_uri . '/assets/images/collection-tablets.svg',
	),
);
?>

<main id="primary" class="site-main collections-directory-main">

	<!-- Hero Header -->
	<section class="collections-dir-hero">
		<div class="site-container collections-dir-hero-inner" data-reveal="up">
			<nav class="collection-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
				<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
				<span class="breadcrumb-separator">/</span>
				<span class="breadcrumb-current"><?php esc_html_e( 'Collections', 'manamchocolate' ); ?></span>
			</nav>

			<h1 class="collections-dir-title"><?php esc_html_e( 'EXPLORE OUR COLLECTIONS', 'manamchocolate' ); ?></h1>
			<p class="collections-dir-lead">
				<?php esc_html_e( 'Discover endless expressions of Indian Cacao across craft tablets, confections, everyday snacking, celebratory gifts, and artisanal pantry essentials.', 'manamchocolate' ); ?>
			</p>
		</div>
	</section>

	<!-- Visual Collections Grid -->
	<section class="collections-dir-grid-section">
		<div class="site-container">
			<div class="collections-dir-grid" data-reveal-group>
				<?php
				foreach ( $collections_list as $col ) :
					$term_obj = get_term_by( 'slug', $col['slug'], 'product_cat' );
					$term_url = $term_obj ? get_term_link( $term_obj ) : home_url( '/shop/?filter_cat=' . $col['slug'] );
					$term_count = $term_obj ? $term_obj->count : 0;
					?>
					<article class="col-dir-card" data-reveal="up">
						<a href="<?php echo esc_url( $term_url ); ?>" class="col-dir-card-link">
							<div class="col-dir-card-image-wrap">
								<img
									src="<?php echo esc_url( $col['image'] ); ?>"
									alt="<?php echo esc_attr( $col['name'] ); ?>"
									width="800"
									height="500"
									loading="lazy"
									class="col-dir-img"
								/>
								<div class="col-dir-count-badge">
									<?php
									printf(
										/* translators: %d: count */
										_n( '%d product', '%d products', $term_count, 'manamchocolate' ),
										$term_count
									);
									?>
								</div>
							</div>

							<div class="col-dir-card-info">
								<h2 class="col-dir-name"><?php echo esc_html( $col['name'] ); ?></h2>
								<p class="col-dir-desc"><?php echo esc_html( $col['description'] ); ?></p>
								<div class="col-dir-cta">
									<span><?php esc_html_e( 'Explore Collection', 'manamchocolate' ); ?></span>
									<svg class="col-dir-arrow" width="14" height="14" viewBox="0 0 12 12" fill="none" aria-hidden="true">
										<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="currentColor"/>
									</svg>
								</div>
							</div>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();

