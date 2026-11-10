<?php
/**
 * Template Name: Store Locator Page
 * Description: Exact recreation of the official Manam Chocolate Store Locator and City Visit destinations.
 *
 * Implements:
 * - 5 Verified Official Retail Flagships & Beverage Bars
 * - City-specific dedicated views for Hyderabad (/pages/manam-chocolate-hyderabad/) and Delhi-NCR (/pages/manam-chocolate-delhi-store/)
 * - Authentic architectural & interior photography
 * - City filter controls (All Stores, Hyderabad, Delhi-NCR)
 * - Exact store descriptions, phone contacts, and Google Maps direction links
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

get_header();

$theme_uri = get_template_directory_uri();
$home_url  = home_url( '/' );

$all_stores = array(
	array(
		'id'          => 'delhi-eldeco',
		'city'        => 'delhi-ncr',
		'city_label'  => __( 'Delhi-NCR', 'manamchocolate' ),
		'name'        => __( 'Manam Chocolate, Delhi', 'manamchocolate' ),
		'type'        => __( 'Flagship Experiential Space', 'manamchocolate' ),
		'desc'        => __( 'An expansive experiential space, with a live chocolaterie, a bakery and patisserie, and a first of its kind Beverage Bar, here a world of endless Indian Craft Chocolate experiences comes to life, right in the heart of South Delhi.', 'manamchocolate' ),
		'address'     => 'Eldeco Center, Saket, New Delhi',
		'phone'       => '+918977760769',
		'phone_fmt'   => '+91 89777 60769',
		'image'       => $theme_uri . '/assets/images/experience-workshop-delhi.jpg',
		'map_url'     => 'https://maps.google.com/?q=Manam+Chocolate+Eldeco+Center+Saket+New+Delhi',
	),
	array(
		'id'          => 'hyderabad-karkhana',
		'city'        => 'hyderabad',
		'city_label'  => __( 'Hyderabad', 'manamchocolate' ),
		'name'        => __( 'Manam Chocolate Karkhana', 'manamchocolate' ),
		'type'        => __( '10,000 sq. ft. Flagship Factory & Café', 'manamchocolate' ),
		'desc'        => __( 'Spread over 10,000 sq. ft., the Manam Chocolate Karkhana is a one-of-its-kind immersive experiential space. It brings together retail and the craft of chocolate making and chocolatiering under one roof, inviting you to explore a distinct new Indian Craft Chocolate experience™.', 'manamchocolate' ),
		'address'     => 'Road No. 12, Banjara Hills, Hyderabad',
		'phone'       => '+918121031763',
		'phone_fmt'   => '+91 81210 31763',
		'image'       => $theme_uri . '/assets/images/experience-workshop-hyderabad.jpg',
		'map_url'     => 'https://maps.google.com/?q=Manam+Chocolate+Karkhana+Banjara+Hills+Hyderabad',
	),
	array(
		'id'          => 'hyderabad-beverage-bar',
		'city'        => 'hyderabad',
		'city_label'  => __( 'Hyderabad', 'manamchocolate' ),
		'name'        => __( 'Manam Chocolate Beverage Bar', 'manamchocolate' ),
		'type'        => __( 'Craft Beverage Bar', 'manamchocolate' ),
		'desc'        => __( 'Explore a range of refreshing, flavour-forward drinks, made with our signature Indian craft chocolate and served with a selection of sweet and savoury pairings.', 'manamchocolate' ),
		'address'     => 'Gate 6, Ground Floor, Elixir Tower, Sattva Knowledge City, Hyderabad',
		'phone'       => '+918977760767',
		'phone_fmt'   => '+91 89777 60767',
		'image'       => $theme_uri . '/assets/images/experience-karkhana-cafe.jpg',
		'map_url'     => 'https://maps.google.com/?q=Manam+Chocolate+Elixir+Tower+Sattva+Knowledge+City+Hyderabad',
	),
	array(
		'id'          => 'delhi-dlf-promenade',
		'city'        => 'delhi-ncr',
		'city_label'  => __( 'Delhi-NCR', 'manamchocolate' ),
		'name'        => __( 'Manam Chocolate Beverage Bar, DLF Promenade', 'manamchocolate' ),
		'type'        => __( 'Beverage Bar & Confectionery', 'manamchocolate' ),
		'desc'        => __( 'The capital’s first dedicated bar for Indian craft chocolate drinks, nestled within DLF Promenade in Vasant Kunj. Discover 24+ easy-to-enjoy beverages, alongside protein-forward beverages, fresh pastries, cookies, chocolate snacks and customisable drinks crafted around your favourite kind of chocolate.', 'manamchocolate' ),
		'address'     => 'GFK 17, Ground Floor, DLF Promenade Mall, Vasant Kunj, New Delhi (Next to Zara)',
		'phone'       => '+918121542288',
		'phone_fmt'   => '+91 81215 42288',
		'image'       => $theme_uri . '/assets/images/store-delhi-dlf-promenade.jpg',
		'map_url'     => 'https://maps.google.com/?q=Manam+Chocolate+DLF+Promenade+Vasant+Kunj+New+Delhi',
	),
	array(
		'id'          => 'gurgaon-ireo',
		'city'        => 'delhi-ncr',
		'city_label'  => __( 'Delhi-NCR', 'manamchocolate' ),
		'name'        => __( 'Manam Chocolate, Ireo Grand View', 'manamchocolate' ),
		'type'        => __( 'Store, Café & Beverage Bar', 'manamchocolate' ),
		'desc'        => __( 'Gurgaon’s first immersive craft chocolate experience space, with a live chocolatiering and pastry-making craftroom and a dedicated beverage bar. Discover an expansive collection of Indian craft chocolate, and a sunlit café that offers global and Indian soul food alongside desserts and fresh bakes.', 'manamchocolate' ),
		'address'     => 'No. 19, 1st Floor, IREO Grand View High Street, Gurgaon, Haryana',
		'phone'       => '+918121031767',
		'phone_fmt'   => '+91 81210 31767',
		'image'       => $theme_uri . '/assets/images/store-gurgaon-ireo-grandview.jpg',
		'map_url'     => 'https://maps.google.com/?q=Manam+Chocolate+IREO+Grand+View+High+Street+Gurgaon',
	),
);

global $post;
$current_slug = $post ? $post->post_name : '';
$is_hyderabad = ( 'manam-chocolate-hyderabad' === $current_slug || ( isset( $_GET['city'] ) && 'hyderabad' === $_GET['city'] ) );
$is_delhi     = ( 'manam-chocolate-delhi-store' === $current_slug || ( isset( $_GET['city'] ) && 'delhi-ncr' === $_GET['city'] ) );

if ( $is_hyderabad ) {
	$eyebrow_text    = __( 'VISIT MANAM', 'manamchocolate' );
	$main_title      = __( 'HYDERABAD', 'manamchocolate' );
	$subtitle_text   = __( 'Explore our 10,000 sq. ft. flagship Karkhana in Banjara Hills and our signature chocolate beverage bar at Sattva Knowledge City.', 'manamchocolate' );
	$breadcrumb_cur  = __( 'Hyderabad', 'manamchocolate' );
	$display_stores  = array_values( array_filter( $all_stores, function( $s ) { return 'hyderabad' === $s['city']; } ) );
	$active_tab      = 'hyderabad';
} elseif ( $is_delhi ) {
	$eyebrow_text    = __( 'VISIT MANAM', 'manamchocolate' );
	$main_title      = __( 'DELHI', 'manamchocolate' );
	$subtitle_text   = __( 'Experience our flagship experiential space at Eldeco Center Saket, DLF Promenade Vasant Kunj, and Ireo Grand View Gurgaon.', 'manamchocolate' );
	$breadcrumb_cur  = __( 'Delhi-NCR', 'manamchocolate' );
	$display_stores  = array_values( array_filter( $all_stores, function( $s ) { return 'delhi-ncr' === $s['city']; } ) );
	$active_tab      = 'delhi-ncr';
} else {
	$eyebrow_text    = __( 'RETAIL SPACES & EXPERIENCES', 'manamchocolate' );
	$main_title      = __( 'OUR STORES', 'manamchocolate' );
	$subtitle_text   = __( 'Visit our immersive chocolate spaces in Hyderabad and Delhi-NCR to explore single-origin tastings, fresh bakes, and signature drinking chocolate crafted on site.', 'manamchocolate' );
	$breadcrumb_cur  = __( 'Store Locator', 'manamchocolate' );
	$display_stores  = $all_stores;
	$active_tab      = 'all';
}
?>

<main id="primary" class="site-main store-locator-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<?php if ( $is_hyderabad || $is_delhi ) : ?>
				<a href="<?php echo esc_url( $home_url . 'store-locator/' ); ?>"><?php esc_html_e( 'Visit', 'manamchocolate' ); ?></a>
				<span class="breadcrumb-separator">/</span>
			<?php endif; ?>
			<span class="breadcrumb-current"><?php echo esc_html( $breadcrumb_cur ); ?></span>
		</nav>
	</div>

	<!-- 2. STORE LOCATOR HEADER -->
	<header class="store-locator-header text-center" data-reveal="up">
		<div class="site-container">
			<span class="store-eyebrow"><?php echo esc_html( $eyebrow_text ); ?></span>
			<h1 class="store-main-title"><?php echo esc_html( $main_title ); ?></h1>
			<p class="store-subtitle">
				<?php echo esc_html( $subtitle_text ); ?>
			</p>

			<!-- City Tabs Filter -->
			<div class="store-filter-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Filter stores by city', 'manamchocolate' ); ?>">
				<a href="<?php echo esc_url( $home_url . 'store-locator/' ); ?>" class="store-tab <?php echo 'all' === $active_tab ? 'is-active' : ''; ?>" role="tab" aria-selected="<?php echo 'all' === $active_tab ? 'true' : 'false'; ?>">
					<?php esc_html_e( 'All Stores (5)', 'manamchocolate' ); ?>
				</a>
				<a href="<?php echo esc_url( $home_url . 'pages/manam-chocolate-hyderabad/' ); ?>" class="store-tab <?php echo 'hyderabad' === $active_tab ? 'is-active' : ''; ?>" role="tab" aria-selected="<?php echo 'hyderabad' === $active_tab ? 'true' : 'false'; ?>">
					<?php esc_html_e( 'Hyderabad (2)', 'manamchocolate' ); ?>
				</a>
				<a href="<?php echo esc_url( $home_url . 'pages/manam-chocolate-delhi-store/' ); ?>" class="store-tab <?php echo 'delhi-ncr' === $active_tab ? 'is-active' : ''; ?>" role="tab" aria-selected="<?php echo 'delhi-ncr' === $active_tab ? 'true' : 'false'; ?>">
					<?php esc_html_e( 'Delhi-NCR (3)', 'manamchocolate' ); ?>
				</a>
			</div>
		</div>
	</header>

	<!-- 3. STORES LISTING SECTION -->
	<section class="store-locator-listing">
		<div class="site-container">
			<div class="store-cards-list">
				<?php foreach ( $display_stores as $index => $store ) : ?>
					<article class="store-item-card" data-city="<?php echo esc_attr( $store['city'] ); ?>" data-reveal="up">
						<div class="store-item-grid">
							<!-- Media Column -->
							<div class="store-item-media">
								<img
									src="<?php echo esc_url( $store['image'] ); ?>"
									alt="<?php echo esc_attr( $store['name'] ); ?>"
									class="store-card-img"
									width="1200"
									height="800"
									loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
								/>
								<span class="store-city-badge"><?php echo esc_html( $store['city_label'] ); ?></span>
							</div>

							<!-- Details Column -->
							<div class="store-item-content">
								<span class="store-type-label"><?php echo esc_html( $store['type'] ); ?></span>
								<h2 class="store-name"><?php echo esc_html( $store['name'] ); ?></h2>
								<p class="store-desc"><?php echo esc_html( $store['desc'] ); ?></p>

								<div class="store-meta-box">
									<div class="store-meta-row">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
										<span><?php echo esc_html( $store['address'] ); ?></span>
									</div>
									<div class="store-meta-row">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
										<a href="tel:<?php echo esc_attr( $store['phone'] ); ?>" class="store-phone-link"><?php echo esc_html( $store['phone_fmt'] ); ?></a>
									</div>
								</div>

								<div class="store-actions-row">
									<a href="<?php echo esc_url( $store['map_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="button button--primary store-direction-btn">
										<span><?php esc_html_e( 'GET DIRECTIONS', 'manamchocolate' ); ?></span>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
									</a>
								</div>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();
