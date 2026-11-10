<?php
/**
 * The template for displaying authentic product search results pages
 *
 * Exact reference parity recreation for Manam Chocolate:
 * - Editorial search header with query feedback and refine search input
 * - In-banner/top breadcrumb (Home / Search)
 * - Exact toolbar with uppercase product count (e.g. 24 PRODUCTS) and SORT BY selector
 * - 4-column responsive WooCommerce product grid matching collection archive
 * - Card layout utilizing authentic content-product template (image hover flip, cacao badges, pricing)
 * - Authentic editorial No-Results state with helpful search keyword suggestions
 *
 * @package ManamChocolate
 * @version 5.10.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $wp_query;
$search_query   = get_search_query();
$trimmed_query  = trim( $search_query );
$total_products = $wp_query->found_posts;
$home_url       = home_url( '/' );

// Determine current sorting
$current_orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : 'menu_order';
?>

<main id="primary" class="site-main site-search-page">

	<!-- 1. SEARCH PAGE EDITORIAL HEADER -->
	<header class="search-page-header">
		<div class="site-container">
			<nav class="search-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
				<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
				<span class="breadcrumb-separator">/</span>
				<span class="breadcrumb-current"><?php esc_html_e( 'Search', 'manamchocolate' ); ?></span>
			</nav>

			<h1 class="search-page-title">
				<?php if ( ! empty( $trimmed_query ) ) : ?>
					<?php
					/* translators: %s: search query */
					printf( esc_html__( 'SEARCH RESULTS: “%s”', 'manamchocolate' ), esc_html( $trimmed_query ) );
					?>
				<?php else : ?>
					<?php esc_html_e( 'SEARCH OUR CHOCOLATES', 'manamchocolate' ); ?>
				<?php endif; ?>
			</h1>

			<!-- Refine Query Bar -->
			<div class="search-refine-bar">
				<form role="search" method="get" class="search-refine-form" action="<?php echo esc_url( $home_url ); ?>">
					<div class="search-refine-input-wrap">
						<svg focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
							<path d="M21.4502 21.4502L16.1608 16.5115M17.9502 11.4767C17.9502 14.943 15.0961 17.7531 11.5752 17.7531C8.05438 17.7531 5.2002 14.943 5.2002 11.4767C5.2002 8.01026 8.05438 5.2002 11.5752 5.2002C15.0961 5.2002 17.9502 8.01026 17.9502 11.4767Z" stroke-linecap="round"/>
						</svg>
						<input type="search" name="s" class="search-refine-input" placeholder="<?php esc_attr_e( 'What are you looking for?', 'manamchocolate' ); ?>" value="<?php echo esc_attr( $trimmed_query ); ?>" autocomplete="off" />
						<button type="submit" class="search-refine-submit"><?php esc_html_e( 'Search', 'manamchocolate' ); ?></button>
					</div>
				</form>
			</div>
		</div>
	</header>

	<!-- 2. MAIN SEARCH RESULTS CONTENT -->
	<div class="site-container search-main-container">

		<?php if ( have_posts() && $total_products > 0 ) : ?>

			<!-- TOOLBAR: Count & Sorting Selector -->
			<div class="search-facet-meta-bar">
				<div class="meta-bar-left">
					<span class="product-facet__count" role="status">
						<?php
						echo esc_html( sprintf( _n( '%d PRODUCT', '%d PRODUCTS', $total_products, 'manamchocolate' ), $total_products ) );
						?>
					</span>
				</div>

				<div class="product-facet__meta-bar-item product-facet__meta-bar-item--sort">
					<label for="search-sort-select" class="sort-by-label"><?php esc_html_e( 'SORT BY', 'manamchocolate' ); ?></label>
					<div class="sort-select-wrapper">
						<select id="search-sort-select" class="shop-sort-select" onchange="if (this.value) window.location.href=this.value;">
							<?php
							$base_search_url = add_query_arg(
								array(
									's'         => $trimmed_query,
									'post_type' => 'product',
								),
								$home_url
							);

							$sort_options = array(
								'menu_order' => __( 'Featured / Default', 'manamchocolate' ),
								'date'       => __( 'Date: New to Old', 'manamchocolate' ),
								'price'      => __( 'Price: Low to High', 'manamchocolate' ),
								'price-desc' => __( 'Price: High to Low', 'manamchocolate' ),
								'title'      => __( 'Alphabetically: A-Z', 'manamchocolate' ),
								'title-desc' => __( 'Alphabetically: Z-A', 'manamchocolate' ),
							);

							foreach ( $sort_options as $opt_key => $opt_label ) :
								$opt_url  = add_query_arg( 'orderby', $opt_key, $base_search_url );
								$selected = ( $current_orderby === $opt_key ) ? 'selected' : '';
								?>
								<option value="<?php echo esc_url( $opt_url ); ?>" <?php echo $selected; ?>>
									<?php echo esc_html( $opt_label ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<!-- 4-COLUMN PRODUCT GRID -->
			<div class="search-product-grid-wrap">
				<ul class="products products-grid columns-4" role="list">
					<?php
					while ( have_posts() ) :
						the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					?>
				</ul>
			</div>

			<!-- PAGINATION -->
			<?php
			$total_pages = $wp_query->max_num_pages;
			if ( $total_pages > 1 ) :
				?>
				<nav class="search-pagination" aria-label="<?php esc_attr_e( 'Search Results Pagination', 'manamchocolate' ); ?>">
					<?php
					echo paginate_links(
						array(
							'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
							'format'    => '',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $total_pages,
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						)
					);
					?>
				</nav>
			<?php endif; ?>

		<?php else : ?>

			<!-- AUTHENTIC NO-RESULTS STATE -->
			<div class="search-no-results-box" role="status">
				<div class="no-results-inner">
					<div class="no-results-icon" aria-hidden="true">
						<svg width="48" height="48" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.2">
							<path d="M21.4502 21.4502L16.1608 16.5115M17.9502 11.4767C17.9502 14.943 15.0961 17.7531 11.5752 17.7531C8.05438 17.7531 5.2002 14.943 5.2002 11.4767C5.2002 8.01026 8.05438 5.2002 11.5752 5.2002C15.0961 5.2002 17.9502 8.01026 17.9502 11.4767Z" stroke-linecap="round"/>
						</svg>
					</div>

					<h2 class="no-results-title">
						<?php
						if ( ! empty( $trimmed_query ) ) {
							/* translators: %s: search query */
							printf( esc_html__( 'No results could be found for “%s”', 'manamchocolate' ), esc_html( $trimmed_query ) );
						} else {
							esc_html_e( 'Please enter a search term above', 'manamchocolate' );
						}
						?>
					</h2>

					<p class="no-results-desc">
						<?php esc_html_e( 'Check your spelling or explore our popular categories and craft chocolate collections below:', 'manamchocolate' ); ?>
					</p>

					<!-- Popular Search Suggestion Pills -->
					<div class="no-results-pills">
						<a href="<?php echo esc_url( add_query_arg( array( 's' => 'Tablet', 'post_type' => 'product' ), $home_url ) ); ?>" class="search-suggestion-pill">
							<?php esc_html_e( 'Tablets', 'manamchocolate' ); ?>
						</a>
						<a href="<?php echo esc_url( add_query_arg( array( 's' => 'Dark Chocolate', 'post_type' => 'product' ), $home_url ) ); ?>" class="search-suggestion-pill">
							<?php esc_html_e( 'Dark Chocolate', 'manamchocolate' ); ?>
						</a>
						<a href="<?php echo esc_url( add_query_arg( array( 's' => 'Milk Chocolate', 'post_type' => 'product' ), $home_url ) ); ?>" class="search-suggestion-pill">
							<?php esc_html_e( 'Milk Chocolate', 'manamchocolate' ); ?>
						</a>
						<a href="<?php echo esc_url( add_query_arg( array( 's' => 'Gift', 'post_type' => 'product' ), $home_url ) ); ?>" class="search-suggestion-pill">
							<?php esc_html_e( 'Gifting Collections', 'manamchocolate' ); ?>
						</a>
						<a href="<?php echo esc_url( add_query_arg( array( 's' => 'Baking', 'post_type' => 'product' ), $home_url ) ); ?>" class="search-suggestion-pill">
							<?php esc_html_e( 'Baking & Pantry', 'manamchocolate' ); ?>
						</a>
					</div>

					<div class="no-results-action">
						<a href="<?php echo esc_url( home_url( '/product-category/tablet-collection/' ) ); ?>" class="btn-browse-catalogue">
							<?php esc_html_e( 'Explore All Chocolates', 'manamchocolate' ); ?>
						</a>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</div><!-- .search-main-container -->

</main><!-- #primary -->

<?php
get_footer();
