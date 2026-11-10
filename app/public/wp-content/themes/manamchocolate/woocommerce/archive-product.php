<?php
/**
 * The Template for displaying product archives, including the main shop page and category archives.
 *
 * Exact reference parity implementation for Manam Chocolate:
 * - Bespoke photographic collection banner with built-in typographic campaign artwork
 * - In-banner floating breadcrumb on top-left (e.g. Home / Tablet Collection)
 * - Clean layout without intrusive category pills or dark overlay tint
 * - Uppercase product count (e.g. 28 PRODUCTS, 20 PRODUCTS) and SORT BY selector
 * - 3-column product grid alongside vertical filter accordion sidebar (ORIGINS, CACAO PERCENTAGE, AWARD WINNING)
 * - High-fidelity responsive mobile filter drawer
 *
 * @package ManamChocolate
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked manamchocolate_woocommerce_wrapper_before - 10 (outputs opening <main> tag)
 */
do_action( 'woocommerce_before_main_content' );

// 1. Determine collection context
$is_cat       = is_product_category();
$current_term = $is_cat ? get_queried_object() : null;
$theme_uri    = get_template_directory_uri();
$home_url     = home_url( '/' );
$shop_url     = wc_get_page_permalink( 'shop' );

// Determine Title & Description
if ( $is_cat && $current_term ) {
	$page_title   = $current_term->name;
	$page_desc    = term_description( $current_term->term_id, 'product_cat' );
	$current_slug = $current_term->slug;
} elseif ( is_search() ) {
	$page_title   = sprintf( __( 'Search Results: “%s”', 'manamchocolate' ), get_search_query() );
	$page_desc    = '';
	$current_slug = '';
} else {
	$page_title   = __( 'All Chocolates & Collections', 'manamchocolate' );
	$page_desc    = '';
	$current_slug = '';
}

// Filter sidebar is exclusive to tablet-collection per original reference website
$has_filter_sidebar = ( 'tablet-collection' === $current_slug );

// Special title display for Diwali
if ( 'diwali-2026' === $current_slug ) {
	$breadcrumb_title = 'Homecoming Edit DIWALI 2026';
} else {
	$breadcrumb_title = $page_title;
}

// Map collection banner images (desktop & mobile)
$banner_maps = array(
	'tablet-collection'       => array(
		'desktop' => $theme_uri . '/assets/images/banner-tablet-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-tablet-collection-mobile.jpg',
	),
	'diwali-2026'             => array(
		'desktop' => $theme_uri . '/assets/images/banner-diwali-2026-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-diwali-2026-mobile.jpg',
	),
	'indulgence-collection'   => array(
		'desktop' => $theme_uri . '/assets/images/banner-indulgence-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-indulgence-collection-mobile.jpg',
	),
	'the-snacking-collection' => array(
		'desktop' => $theme_uri . '/assets/images/banner-snacking-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-snacking-collection-mobile.jpg',
	),
	'gifting'                 => array(
		'desktop' => $theme_uri . '/assets/images/banner-gifting-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-gifting-collection-mobile.jpg',
	),
	'baking'                  => array(
		'desktop' => $theme_uri . '/assets/images/banner-baking-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-baking-collection-mobile.jpg',
	),
	'pantry-collection'       => array(
		'desktop' => $theme_uri . '/assets/images/banner-pantry-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-pantry-collection-mobile.jpg',
	),
	'award-winning'           => array(
		'desktop' => $theme_uri . '/assets/images/banner-award-winning-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-award-winning-mobile.jpg',
	),
	'birthdays-anniversaries' => array(
		'desktop' => $theme_uri . '/assets/images/banner-gifting-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-gifting-collection-mobile.jpg',
	),
	'hosting-celebrations'    => array(
		'desktop' => $theme_uri . '/assets/images/banner-gifting-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-gifting-collection-mobile.jpg',
	),
	'preferences-lifestyle'   => array(
		'desktop' => $theme_uri . '/assets/images/banner-gifting-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-gifting-collection-mobile.jpg',
	),
	'favours'                 => array(
		'desktop' => $theme_uri . '/assets/images/banner-gifting-collection-desktop.jpg',
		'mobile'  => $theme_uri . '/assets/images/banner-gifting-collection-mobile.jpg',
	),
);

$current_banner = isset( $banner_maps[ $current_slug ] ) ? $banner_maps[ $current_slug ] : array(
	'desktop' => $theme_uri . '/assets/images/banner-tablet-collection-desktop.jpg',
	'mobile'  => $theme_uri . '/assets/images/banner-tablet-collection-mobile.jpg',
);

// Active filters count
// Retrieve dynamic counts for the current collection
$filter_counts = manamchocolate_get_collection_filter_counts( $current_term ? $current_term->term_id : 0 );

$origins_list = $filter_counts['origins'];
$cacao_list   = $filter_counts['cacao_percentage'];
$award_list   = $filter_counts['award_winning'];
$pref_list    = $filter_counts['preference_based'];
$vegan_list   = $filter_counts['vegan'];
$price_min    = $filter_counts['price_min'];
$price_max    = $filter_counts['price_max'];

// Active filters
$active_origins = ! empty( $_GET['filter_origin'] ) ? explode( ',', wc_clean( wp_unslash( $_GET['filter_origin'] ) ) ) : array();
$active_cacao   = ! empty( $_GET['filter_cacao_percentage'] ) ? explode( ',', wc_clean( wp_unslash( $_GET['filter_cacao_percentage'] ) ) ) : array();
$active_awards  = ! empty( $_GET['filter_award_winning'] ) ? explode( ',', wc_clean( wp_unslash( $_GET['filter_award_winning'] ) ) ) : array();
$active_prefs   = ! empty( $_GET['filter_preference'] ) ? explode( ',', wc_clean( wp_unslash( $_GET['filter_preference'] ) ) ) : array();
$active_vegans  = ! empty( $_GET['filter_vegan'] ) ? explode( ',', wc_clean( wp_unslash( $_GET['filter_vegan'] ) ) ) : array();

// Active filters count
$active_filters_count = count( $active_origins ) + count( $active_cacao ) + count( $active_awards ) + count( $active_prefs ) + count( $active_vegans );
if ( isset( $_GET['min_price'] ) && (float)$_GET['min_price'] > 0 ) $active_filters_count++;
if ( isset( $_GET['max_price'] ) && (float)$_GET['max_price'] < 10000 ) $active_filters_count++;

// Current sorting
$current_orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : 'menu_order';
?>

<!-- 1. AUTHENTIC FULL-WIDTH COLLECTION HERO BANNER -->
<section class="collection-hero-banner" aria-label="<?php echo esc_attr( $page_title ); ?>">
	<picture class="collection-banner-picture">
		<source media="(max-width: 740px)" srcset="<?php echo esc_url( $current_banner['mobile'] ); ?>">
		<img
			src="<?php echo esc_url( $current_banner['desktop'] ); ?>"
			alt="<?php echo esc_attr( $page_title ); ?>"
			class="collection-banner-img"
			loading="eager"
			fetchpriority="high"
		>
	</picture>

	<div class="site-container collection-banner-inner">
		<!-- Floating In-Banner Breadcrumb (Top-Left) -->
		<nav class="collection-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php echo esc_html( $breadcrumb_title ); ?></span>
		</nav>

		<!-- Accessible Hidden Title for SEO/Assistive Tech -->
		<h1 class="visually-hidden"><?php echo esc_html( $page_title ); ?></h1>
	</div>
</section>

<!-- 2. MAIN SHOP CONTENT CONTAINER -->
<div class="site-container shop-main-container">

	<!-- 3. MAIN FACET LAYOUT: Sidebar + Product Grid -->
	<div class="product-facet-layout <?php echo $has_filter_sidebar ? 'has-sidebar' : 'no-sidebar'; ?>">

		<?php if ( $has_filter_sidebar ) : ?>
		<!-- DESKTOP FILTER SIDEBAR (EXACT 6 REFERENCE GROUPS) -->
		<aside class="product-facet__sidebar" aria-label="<?php esc_attr_e( 'Product Filters', 'manamchocolate' ); ?>">
			<div class="product-facet__filters-header">
				<p class="heading h5 filter-sidebar-title"><?php esc_html_e( 'Filters', 'manamchocolate' ); ?></p>
				<?php if ( $active_filters_count > 0 ) : ?>
					<a href="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>" class="filter-clear-all-btn">
						<?php esc_html_e( 'Clear all', 'manamchocolate' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Filter Accordion Groups (Exact Reference Order) -->
			<div class="product-facet__filter-list filter-accordion-list">

				<!-- 1. ORIGINS -->
				<?php
				$is_open_origins = ! empty( $active_origins );
				?>
				<div class="product-facet__filter-item filter-group" data-filter="origin">
					<button type="button" class="collapsible-toggle filter-group-header" aria-expanded="<?php echo $is_open_origins ? 'true' : 'false'; ?>">
						<span><?php esc_html_e( 'ORIGINS', 'manamchocolate' ); ?></span>
						<svg focusable="false" width="12" height="8" class="icon icon--chevron chevron-toggle" viewBox="0 0 12 8"><path fill="none" d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1"></path></svg>
					</button>
					<div class="filter-group-content" style="<?php echo $is_open_origins ? 'display: block;' : 'display: none;'; ?>">
						<ul class="filter-options-list">
							<?php foreach ( $origins_list as $oname => $ocount ) :
								$oslug = sanitize_title( $oname );
								$is_checked = in_array( $oslug, $active_origins, true );
								$toggle_url = manamchocolate_get_filter_url( 'filter_origin', $oslug );
								?>
								<li class="filter-option-item">
									<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
										<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
										<span class="option-label"><?php echo esc_html( $oname ); ?></span>
										<span class="option-count">(<?php echo esc_html( $ocount ); ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- 2. CACAO PERCENTAGE (Default Expanded per Reference Screenshot) -->
				<?php
				$is_open_cacao = true; // Default expanded on reference
				?>
				<div class="product-facet__filter-item filter-group" data-filter="cacao">
					<button type="button" class="collapsible-toggle filter-group-header" aria-expanded="<?php echo $is_open_cacao ? 'true' : 'false'; ?>">
						<span><?php esc_html_e( 'CACAO PERCENTAGE', 'manamchocolate' ); ?></span>
						<svg focusable="false" width="12" height="8" class="icon icon--chevron chevron-toggle" viewBox="0 0 12 8"><path fill="none" d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1"></path></svg>
					</button>
					<div class="filter-group-content" style="<?php echo $is_open_cacao ? 'display: block;' : 'display: none;'; ?>">
						<ul class="filter-options-list">
							<?php foreach ( $cacao_list as $cname => $ccount ) :
								$cslug = sanitize_title( $cname );
								$is_checked = in_array( $cslug, $active_cacao, true );
								$toggle_url = manamchocolate_get_filter_url( 'filter_cacao_percentage', $cslug );
								?>
								<li class="filter-option-item">
									<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
										<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
										<span class="option-label"><?php echo esc_html( $cname ); ?></span>
										<span class="option-count">(<?php echo esc_html( $ccount ); ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- 3. AWARD WINNING -->
				<?php
				$is_open_award = ! empty( $active_awards );
				?>
				<div class="product-facet__filter-item filter-group" data-filter="award">
					<button type="button" class="collapsible-toggle filter-group-header" aria-expanded="<?php echo $is_open_award ? 'true' : 'false'; ?>">
						<span><?php esc_html_e( 'AWARD WINNING', 'manamchocolate' ); ?></span>
						<svg focusable="false" width="12" height="8" class="icon icon--chevron chevron-toggle" viewBox="0 0 12 8"><path fill="none" d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1"></path></svg>
					</button>
					<div class="filter-group-content" style="<?php echo $is_open_award ? 'display: block;' : 'display: none;'; ?>">
						<ul class="filter-options-list">
							<?php foreach ( $award_list as $aname => $acount ) :
								$aslug = sanitize_title( $aname );
								$is_checked = in_array( $aslug, $active_awards, true );
								$toggle_url = manamchocolate_get_filter_url( 'filter_award_winning', $aslug );
								?>
								<li class="filter-option-item">
									<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
										<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
										<span class="option-label"><?php echo esc_html( $aname ); ?></span>
										<span class="option-count">(<?php echo esc_html( $acount ); ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- 4. PREFERENCE BASED -->
				<?php
				$is_open_pref = ! empty( $active_prefs );
				?>
				<div class="product-facet__filter-item filter-group" data-filter="preference">
					<button type="button" class="collapsible-toggle filter-group-header" aria-expanded="<?php echo $is_open_pref ? 'true' : 'false'; ?>">
						<span><?php esc_html_e( 'PREFERENCE BASED', 'manamchocolate' ); ?></span>
						<svg focusable="false" width="12" height="8" class="icon icon--chevron chevron-toggle" viewBox="0 0 12 8"><path fill="none" d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1"></path></svg>
					</button>
					<div class="filter-group-content" style="<?php echo $is_open_pref ? 'display: block;' : 'display: none;'; ?>">
						<ul class="filter-options-list">
							<?php foreach ( $pref_list as $pname => $pcount ) :
								$pslug = sanitize_title( $pname );
								$is_checked = in_array( $pslug, $active_prefs, true );
								$toggle_url = manamchocolate_get_filter_url( 'filter_preference', $pslug );
								?>
								<li class="filter-option-item">
									<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
										<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
										<span class="option-label"><?php echo esc_html( $pname ); ?></span>
										<span class="option-count">(<?php echo esc_html( $pcount ); ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- 5. VEGAN -->
				<?php
				$is_open_vegan = ! empty( $active_vegans );
				?>
				<div class="product-facet__filter-item filter-group" data-filter="vegan">
					<button type="button" class="collapsible-toggle filter-group-header" aria-expanded="<?php echo $is_open_vegan ? 'true' : 'false'; ?>">
						<span><?php esc_html_e( 'VEGAN', 'manamchocolate' ); ?></span>
						<svg focusable="false" width="12" height="8" class="icon icon--chevron chevron-toggle" viewBox="0 0 12 8"><path fill="none" d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1"></path></svg>
					</button>
					<div class="filter-group-content" style="<?php echo $is_open_vegan ? 'display: block;' : 'display: none;'; ?>">
						<ul class="filter-options-list">
							<?php foreach ( $vegan_list as $vname => $vcount ) :
								$vslug = sanitize_title( $vname );
								$is_checked = in_array( $vslug, $active_vegans, true );
								$toggle_url = manamchocolate_get_filter_url( 'filter_vegan', $vslug );
								?>
								<li class="filter-option-item">
									<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
										<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
										<span class="option-label"><?php echo esc_html( $vname ); ?></span>
										<span class="option-count">(<?php echo esc_html( $vcount ); ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- 6. PRICE RANGE (Interactive Dual Slider & Inputs) -->
				<?php
				$cur_min = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : $price_min;
				$cur_max = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : $price_max;
				$is_open_price = ( isset( $_GET['min_price'] ) || isset( $_GET['max_price'] ) );
				?>
				<div class="product-facet__filter-item filter-group" data-filter="price">
					<button type="button" class="collapsible-toggle filter-group-header" aria-expanded="<?php echo $is_open_price ? 'true' : 'false'; ?>">
						<span><?php esc_html_e( 'PRICE RANGE', 'manamchocolate' ); ?></span>
						<svg focusable="false" width="12" height="8" class="icon icon--chevron chevron-toggle" viewBox="0 0 12 8"><path fill="none" d="M1 1l5 5 5-5" stroke="currentColor" stroke-width="1"></path></svg>
					</button>
					<div class="filter-group-content" style="<?php echo $is_open_price ? 'display: block;' : 'display: none;'; ?>">
						<form method="get" class="price-range-form" action="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>">
							<!-- Preserve existing query args -->
							<?php foreach ( $_GET as $g_key => $g_val ) :
								if ( in_array( $g_key, array( 'min_price', 'max_price', 'paged' ), true ) ) {
									continue;
								}
								echo '<input type="hidden" name="' . esc_attr( $g_key ) . '" value="' . esc_attr( $g_val ) . '">';
							endforeach; ?>

							<!-- Dual Range Slider Controls -->
							<div class="price-range__slider-wrap">
								<div class="price-range__track-bar">
									<div class="price-range__highlight" id="price-range-highlight"></div>
								</div>
								<input type="range" class="price-range-slider range-min" min="<?php echo esc_attr( $price_min ); ?>" max="<?php echo esc_attr( $price_max ); ?>" value="<?php echo esc_attr( $cur_min ); ?>" step="10" aria-label="<?php esc_attr_e( 'Minimum price slider', 'manamchocolate' ); ?>">
								<input type="range" class="price-range-slider range-max" min="<?php echo esc_attr( $price_min ); ?>" max="<?php echo esc_attr( $price_max ); ?>" value="<?php echo esc_attr( $cur_max ); ?>" step="10" aria-label="<?php esc_attr_e( 'Maximum price slider', 'manamchocolate' ); ?>">
							</div>

							<!-- Price Number Inputs Row -->
							<div class="price-inputs-row">
								<div class="price-input-field">
									<span class="currency-symbol">₹</span>
									<input type="number" name="min_price" id="price-input-min" placeholder="<?php echo esc_attr( $price_min ); ?>" value="<?php echo isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : ''; ?>" min="<?php echo esc_attr( $price_min ); ?>" max="<?php echo esc_attr( $price_max ); ?>" step="10">
								</div>
								<span class="price-separator"><?php esc_html_e( 'to', 'manamchocolate' ); ?></span>
								<div class="price-input-field">
									<span class="currency-symbol">₹</span>
									<input type="number" name="max_price" id="price-input-max" placeholder="<?php echo esc_attr( $price_max ); ?>" value="<?php echo isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : ''; ?>" min="<?php echo esc_attr( $price_min ); ?>" max="<?php echo esc_attr( $price_max ); ?>" step="10">
								</div>
							</div>

							<button type="submit" class="btn-price-apply"><?php esc_html_e( 'Apply', 'manamchocolate' ); ?></button>
						</form>
					</div>
				</div>

			</div><!-- .filter-accordion-list -->
		</aside><!-- .product-facet__sidebar -->
		<?php endif; ?>

		<!-- PRODUCT LOOP & GRID AREA (EXACT 3-COLUMN LAYOUT) -->
		<section class="product-facet__product-area">

			<!-- TOOLBAR: Count & Sorting (Aligned with Filters header) -->
			<div class="product-facet__meta-bar">
				<div class="meta-bar-left">
					<span class="product-facet__count" role="status">
						<?php
						global $wp_query;
						$total = $wp_query->found_posts;
						echo esc_html( sprintf( _n( '%d PRODUCT', '%d PRODUCTS', $total, 'manamchocolate' ), $total ) );
						?>
					</span>

					<?php if ( $has_filter_sidebar ) : ?>
					<!-- Mobile Filter Toggle Button -->
					<button type="button" class="mobile-filter-trigger-btn" id="mobile-filter-trigger" aria-controls="mobile-filter-drawer" aria-expanded="false">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
							<path d="M0 4h16M0 12h16" stroke="currentColor" stroke-width="1.5"></path>
							<circle cx="5" cy="4" r="2.5" fill="#FAF6F0" stroke="currentColor" stroke-width="1.5"></circle>
							<circle cx="11" cy="12" r="2.5" fill="#FAF6F0" stroke="currentColor" stroke-width="1.5"></circle>
						</svg>
						<span><?php esc_html_e( 'Filters', 'manamchocolate' ); ?></span>
						<?php if ( $active_filters_count > 0 ) : ?>
							<span class="filter-active-count-badge"><?php echo esc_html( $active_filters_count ); ?></span>
						<?php endif; ?>
					</button>
					<?php endif; ?>
				</div>

				<!-- Sort By Controls -->
				<div class="product-facet__meta-bar-item product-facet__meta-bar-item--sort">
					<label for="shop-sort-select" class="sort-by-label"><?php esc_html_e( 'SORT BY', 'manamchocolate' ); ?></label>
					<div class="sort-select-wrapper">
						<select id="shop-sort-select" class="shop-sort-select" onchange="if (this.value) window.location.href=this.value;">
							<?php
							$sort_options = array(
								'menu_order' => __( 'Featured / Default', 'manamchocolate' ),
								'popularity' => __( 'Best selling', 'manamchocolate' ),
								'price'      => __( 'Price, low to high', 'manamchocolate' ),
								'price-desc' => __( 'Price, high to low', 'manamchocolate' ),
								'date'       => __( 'Newest', 'manamchocolate' ),
							);
							$current_sort = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : 'menu_order';
							foreach ( $sort_options as $s_val => $s_label ) {
								$s_url = add_query_arg( 'orderby', $s_val, remove_query_arg( 'paged' ) );
								$selected = ( $current_sort === $s_val ) ? 'selected' : '';
								echo '<option value="' . esc_url( $s_url ) . '" ' . $selected . '>' . esc_html( $s_label ) . '</option>';
							}
							?>
						</select>
						<svg class="sort-chevron-icon" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true">
							<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				</div>
			</div>
			<?php if ( woocommerce_product_loop() ) : ?>
				<ul class="products columns-3 product-facet__product-list" data-reveal-group>
					<?php
					while ( have_posts() ) :
						the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					?>
				</ul>

				<!-- Pagination -->
				<div class="shop-pagination-wrap">
					<?php woocommerce_pagination(); ?>
				</div>

			<?php else : ?>
				<!-- EMPTY STATE: No Products Found -->
				<div class="no-products-found-card">
					<div class="no-products-icon">
						<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
							<line x1="9" y1="9" x2="9.01" y2="9"></line>
							<line x1="15" y1="9" x2="15.01" y2="9"></line>
						</svg>
					</div>
					<h3 class="no-products-title"><?php esc_html_e( 'No chocolates found', 'manamchocolate' ); ?></h3>
					<p class="no-products-message">
						<?php esc_html_e( 'We couldn\'t find any products matching your selected filter criteria. Try clearing some filters or browse our full collection.', 'manamchocolate' ); ?>
					</p>
					<div class="no-products-actions">
						<a href="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>" class="btn-primary">
							<?php esc_html_e( 'Clear All Filters', 'manamchocolate' ); ?>
						</a>
						<a href="<?php echo esc_url( $shop_url ); ?>" class="btn-secondary">
							<?php esc_html_e( 'View All Chocolates', 'manamchocolate' ); ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
		</section>

	</div><!-- .product-facet-layout -->

</div><!-- .site-container -->

<?php if ( $has_filter_sidebar ) : ?>
<!-- 4. MOBILE FILTER DRAWER OVERLAY -->
<div id="mobile-filter-drawer" class="mobile-filter-drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Filter Chocolates', 'manamchocolate' ); ?>" hidden>
	<div class="mobile-filter-backdrop" id="mobile-filter-backdrop"></div>
	<div class="mobile-filter-panel">
		<div class="mobile-filter-panel-header">
			<h4 class="mobile-filter-panel-title"><?php esc_html_e( 'Filters', 'manamchocolate' ); ?></h4>
			<button type="button" class="mobile-filter-close-btn" id="mobile-filter-close" aria-label="<?php esc_attr_e( 'Close Filters', 'manamchocolate' ); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button>
		</div>

		<div class="mobile-filter-panel-body">
			<?php if ( $active_filters_count > 0 ) : ?>
				<div class="mobile-filter-clear-bar">
					<a href="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>" class="filter-clear-all-btn">
						<?php esc_html_e( 'Clear all filters', 'manamchocolate' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="mobile-filter-accordion-wrap">
				<!-- Origins -->
				<div class="mobile-filter-section">
					<h5 class="mobile-filter-subheading"><?php esc_html_e( 'ORIGINS', 'manamchocolate' ); ?></h5>
					<ul class="filter-options-list">
						<?php foreach ( $origins_list as $oname => $ocount ) :
							$oslug = sanitize_title( $oname );
							$is_checked = in_array( $oslug, $active_origins, true );
							$toggle_url = manamchocolate_get_filter_url( 'filter_origin', $oslug );
							?>
							<li class="filter-option-item">
								<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
									<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
									<span class="option-label"><?php echo esc_html( $oname ); ?></span>
									<span class="option-count">(<?php echo esc_html( $ocount ); ?>)</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Cacao Percentage -->
				<div class="mobile-filter-section">
					<h5 class="mobile-filter-subheading"><?php esc_html_e( 'CACAO PERCENTAGE', 'manamchocolate' ); ?></h5>
					<ul class="filter-options-list">
						<?php foreach ( $cacao_list as $cname => $ccount ) :
							$cslug = sanitize_title( $cname );
							$is_checked = in_array( $cslug, $active_cacao, true );
							$toggle_url = manamchocolate_get_filter_url( 'filter_cacao_percentage', $cslug );
							?>
							<li class="filter-option-item">
								<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
									<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
									<span class="option-label"><?php echo esc_html( $cname ); ?></span>
									<span class="option-count">(<?php echo esc_html( $ccount ); ?>)</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Award Winning -->
				<div class="mobile-filter-section">
					<h5 class="mobile-filter-subheading"><?php esc_html_e( 'AWARD WINNING', 'manamchocolate' ); ?></h5>
					<ul class="filter-options-list">
						<?php foreach ( $award_list as $aname => $acount ) :
							$aslug = sanitize_title( $aname );
							$is_checked = in_array( $aslug, $active_awards, true );
							$toggle_url = manamchocolate_get_filter_url( 'filter_award_winning', $aslug );
							?>
							<li class="filter-option-item">
								<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
									<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
									<span class="option-label"><?php echo esc_html( $aname ); ?></span>
									<span class="option-count">(<?php echo esc_html( $acount ); ?>)</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Preference Based -->
				<div class="mobile-filter-section">
					<h5 class="mobile-filter-subheading"><?php esc_html_e( 'PREFERENCE BASED', 'manamchocolate' ); ?></h5>
					<ul class="filter-options-list">
						<?php foreach ( $pref_list as $pname => $pcount ) :
							$pslug = sanitize_title( $pname );
							$is_checked = in_array( $pslug, $active_prefs, true );
							$toggle_url = manamchocolate_get_filter_url( 'filter_preference', $pslug );
							?>
							<li class="filter-option-item">
								<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
									<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
									<span class="option-label"><?php echo esc_html( $pname ); ?></span>
									<span class="option-count">(<?php echo esc_html( $pcount ); ?>)</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Vegan -->
				<div class="mobile-filter-section">
					<h5 class="mobile-filter-subheading"><?php esc_html_e( 'VEGAN', 'manamchocolate' ); ?></h5>
					<ul class="filter-options-list">
						<?php foreach ( $vegan_list as $vname => $vcount ) :
							$vslug = sanitize_title( $vname );
							$is_checked = in_array( $vslug, $active_vegans, true );
							$toggle_url = manamchocolate_get_filter_url( 'filter_vegan', $vslug );
							?>
							<li class="filter-option-item">
								<a href="<?php echo esc_url( $toggle_url ); ?>" class="filter-checkbox-link <?php echo $is_checked ? 'is-active' : ''; ?>">
									<span class="custom-checkbox <?php echo $is_checked ? 'checked' : ''; ?>"></span>
									<span class="option-label"><?php echo esc_html( $vname ); ?></span>
									<span class="option-count">(<?php echo esc_html( $vcount ); ?>)</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Price Range -->
				<div class="mobile-filter-section">
					<h5 class="mobile-filter-subheading"><?php esc_html_e( 'PRICE RANGE', 'manamchocolate' ); ?></h5>
					<form method="get" class="price-range-form" action="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>">
						<?php foreach ( $_GET as $g_key => $g_val ) :
							if ( in_array( $g_key, array( 'min_price', 'max_price', 'paged' ), true ) ) continue;
							echo '<input type="hidden" name="' . esc_attr( $g_key ) . '" value="' . esc_attr( $g_val ) . '">';
						endforeach; ?>
						<div class="price-inputs-row">
							<div class="price-input-field">
								<span class="currency-symbol">₹</span>
								<input type="number" name="min_price" placeholder="<?php echo esc_attr( $price_min ); ?>" value="<?php echo isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : ''; ?>" min="<?php echo esc_attr( $price_min ); ?>" max="<?php echo esc_attr( $price_max ); ?>">
							</div>
							<span class="price-separator">to</span>
							<div class="price-input-field">
								<span class="currency-symbol">₹</span>
								<input type="number" name="max_price" placeholder="<?php echo esc_attr( $price_max ); ?>" value="<?php echo isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : ''; ?>" min="<?php echo esc_attr( $price_min ); ?>" max="<?php echo esc_attr( $price_max ); ?>">
							</div>
						</div>
						<button type="submit" class="btn-price-apply" style="margin-top: 10px; width: 100%;"><?php esc_html_e( 'Apply Price Filter', 'manamchocolate' ); ?></button>
					</form>
				</div>
			</div>
		</div>

		<div class="mobile-filter-panel-footer">
			<button type="button" class="btn-primary btn-block" id="mobile-filter-apply-btn">
				<?php esc_html_e( 'Apply Filters', 'manamchocolate' ); ?>
			</button>
		</div>
	</div>
</div>
<?php endif; ?>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked manamchocolate_woocommerce_wrapper_after - 10 (outputs closing </main> tag)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
