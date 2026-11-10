<?php
/**
 * Template part for displaying the "Discover" homepage section
 *
 * Implements:
 * - Section Heading: "DISCOVER"
 * - 3 Filter Tabs: Favourite, Gifting, Maker Recommended
 * - Dynamic WooCommerce Product Query (12 products, 4 per tab)
 * - Product Cards: 4:5 Image ratio, Title, Net Weight, MRP Price (Incl. of Taxes)
 * - Sold Out badge & disabled state for out-of-stock products
 * - Interactive carousel with prev/next navigation and mobile touch scroll
 * - Native WooCommerce AJAX Add-to-Cart integration
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri          = get_template_directory_uri();
$placeholder_image  = $theme_uri . '/assets/images/product-placeholder.svg';
$weight_unit        = get_option( 'woocommerce_weight_unit', 'g' );

$discover_tabs = array(
	'favourite'         => array(
		'label' => __( 'Favourite', 'manamchocolate' ),
		'slug'  => 'favourite',
	),
	'gifting'           => array(
		'label' => __( 'Gifting', 'manamchocolate' ),
		'slug'  => 'gifting',
	),
	'maker-recommended' => array(
		'label' => __( 'Maker Recommended', 'manamchocolate' ),
		'slug'  => 'maker-recommended',
	),
);

// Fallback static data if WooCommerce is inactive
$fallback_products = array(
	'favourite' => array(
		array(
			'id'        => 0,
			'title'     => "The Chocolatier's Thins Selection",
			'weight'    => '125',
			'price'     => '995',
			'in_stock'  => false,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'Almond Praline Cluster - 45% Milk',
			'weight'    => '200',
			'price'     => '725',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'Indian Origin Tablet No. 5 - 80% Dark',
			'weight'    => '80',
			'price'     => '495',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'Indian Origin Tablet No. 8 - 100% Dark',
			'weight'    => '80',
			'price'     => '525',
			'in_stock'  => true,
			'permalink' => '#',
		),
	),
	'gifting' => array(
		array(
			'id'        => 0,
			'title'     => "The Chocolatier's Celebration Tin - 1",
			'weight'    => '275',
			'price'     => '1700',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'The Tablet Library - 10 Pcs',
			'weight'    => '400',
			'price'     => '2920',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => "The Chocolatier's Celebration Tin - 2",
			'weight'    => '555',
			'price'     => '2845',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => "The Chocolatier's Celebration Tin - 3",
			'weight'    => '980',
			'price'     => '3865',
			'in_stock'  => true,
			'permalink' => '#',
		),
	),
	'maker-recommended' => array(
		array(
			'id'        => 0,
			'title'     => 'Indian Origin Tablet No. 3 - 67% Dark',
			'weight'    => '80',
			'price'     => '495',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'Nutty Praline Chocolate Barks - 45% Milk',
			'weight'    => '200',
			'price'     => '795',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'Sea Salt Cacao Nibs',
			'weight'    => '200',
			'price'     => '650',
			'in_stock'  => true,
			'permalink' => '#',
		),
		array(
			'id'        => 0,
			'title'     => 'Sweet Curry Leaf Shortbread Cookies - White Chocolate',
			'weight'    => '200',
			'price'     => '595',
			'in_stock'  => true,
			'permalink' => '#',
		),
	),
);
?>

<section class="homepage-section discover-section" id="discover-products" aria-labelledby="discover-heading">
	<div class="discover-section-inner">
		<!-- Discover Section Header & Navigation Tabs -->
		<header class="discover-header" data-reveal="up">
			<div class="site-container">
				<div class="discover-header-text">
					<h2 id="discover-heading" class="discover-title">
						<?php esc_html_e( 'DISCOVER', 'manamchocolate' ); ?><sup></sup>
					</h2>
				</div>

				<nav class="discover-tabs-nav" role="tablist" aria-label="<?php esc_attr_e( 'Discover Collections', 'manamchocolate' ); ?>">
					<div class="discover-tabs-nav-scroll hide-scrollbar">
						<?php
						$tab_index = 0;
						foreach ( $discover_tabs as $slug => $tab_info ) :
							$is_active   = ( 0 === $tab_index );
							$tab_btn_id  = 'discover-tab-btn-' . esc_attr( $slug );
							$tab_pane_id = 'discover-tab-pane-' . esc_attr( $slug );
							?>
							<button
								type="button"
								role="tab"
								id="<?php echo esc_attr( $tab_btn_id ); ?>"
								class="discover-tab-btn <?php echo $is_active ? 'active' : ''; ?>"
								aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
								aria-controls="<?php echo esc_attr( $tab_pane_id ); ?>"
								data-tab-slug="<?php echo esc_attr( $slug ); ?>"
								tabindex="<?php echo $is_active ? '0' : '-1'; ?>"
							>
								<span><?php echo esc_html( $tab_info['label'] ); ?></span>
							</button>
							<?php
							$tab_index++;
						endforeach;
						?>
					</div>
				</nav>
			</div><!-- .site-container -->
		</header><!-- .discover-header -->

		<!-- Discover Tab Panels -->
		<div class="discover-tabs-content" data-reveal="up">
			<?php
			$panel_index = 0;
			foreach ( $discover_tabs as $slug => $tab_info ) :
				$is_active   = ( 0 === $panel_index );
				$tab_btn_id  = 'discover-tab-btn-' . esc_attr( $slug );
				$tab_pane_id = 'discover-tab-pane-' . esc_attr( $slug );
				$slider_id   = 'discover-slider-' . esc_attr( $slug );

				// Fetch products dynamically from WooCommerce
				$products = array();
				if ( function_exists( 'wc_get_products' ) ) {
					$products = wc_get_products(
						array(
							'limit'    => 12,
							'status'   => 'publish',
							'tag'      => array( $slug ),
							'orderby'  => 'menu_order id',
							'order'    => 'ASC',
						)
					);
				}
				?>
				<div
					class="discover-tab-pane <?php echo $is_active ? 'active' : ''; ?>"
					id="<?php echo esc_attr( $tab_pane_id ); ?>"
					role="tabpanel"
					aria-labelledby="<?php echo esc_attr( $tab_btn_id ); ?>"
					<?php echo ! $is_active ? 'hidden' : ''; ?>
				>
					<div class="site-container discover-carousel-wrapper">
						<!-- Previous Arrow -->
						<button
							type="button"
							class="discover-nav-arrow discover-nav-prev"
							aria-label="<?php esc_attr_e( 'Previous products', 'manamchocolate' ); ?>"
							data-slider-target="<?php echo esc_attr( $slider_id ); ?>"
							disabled
						>
							<svg width="17" height="14" viewBox="0 0 17 14" fill="none" aria-hidden="true" focusable="false">
								<path d="M17 7H2M8 1L2 7l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>

						<!-- Product Track / Slider -->
						<div class="discover-products-slider hide-scrollbar" id="<?php echo esc_attr( $slider_id ); ?>">
							<div class="discover-products-grid">
								<?php
								if ( ! empty( $products ) ) :
									foreach ( $products as $product ) :
										$product_id   = $product->get_id();
										$title        = $product->get_name();
										$permalink    = $product->get_permalink();
										$in_stock     = $product->is_in_stock() && $product->is_purchasable();
										$weight_val   = $product->get_weight();
										$price_html   = $product->get_price_html();
										$has_thumb    = has_post_thumbnail( $product_id );
										$card_classes = 'product-item-card' . ( ! $in_stock ? ' is-sold-out' : '' );
										?>
										<article class="<?php echo esc_attr( $card_classes ); ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
											<div class="product-item-image-wrapper">
												<?php if ( ! $in_stock ) : ?>
													<div class="product-item-badge-list">
														<span class="product-badge badge-sold-out">
															<?php esc_html_e( 'Sold out', 'manamchocolate' ); ?>
														</span>
													</div>
												<?php endif; ?>

												<a href="<?php echo esc_url( $permalink ); ?>" class="product-item-image-link" tabindex="-1" aria-hidden="true">
													<div class="product-item-image-ratio">
														<?php
														$gallery_image_ids  = $product->get_gallery_image_ids();
														$secondary_image_id = ! empty( $gallery_image_ids ) ? $gallery_image_ids[0] : 0;

														if ( $has_thumb ) {
															echo $product->get_image(
																'woocommerce_thumbnail',
																array(
																	'class'   => 'product-primary-image',
																	'loading' => 'lazy',
																	'alt'     => esc_attr( $title ),
																)
															);
															if ( $secondary_image_id ) {
																echo wp_get_attachment_image(
																	$secondary_image_id,
																	'woocommerce_thumbnail',
																	false,
																	array(
																		'class'   => 'product-card-hover-img product-item-hover-image',
																		'loading' => 'lazy',
																		'alt'     => esc_attr( $title ),
																	)
																);
															}
														} else {
															?>
															<img
																src="<?php echo esc_url( $placeholder_image ); ?>"
																alt="<?php echo esc_attr( $title ); ?>"
																class="product-primary-image placeholder-image"
																width="800"
																height="1000"
																loading="lazy"
															/>
															<?php
														}
														?>
													</div>
												</a>

												<!-- Add to Cart / Action Button -->
												<div class="product-item-actions">
													<?php if ( $in_stock ) : ?>
														<button
															type="button"
															class="product-add-to-cart-btn btn-add-to-cart ajax_add_to_cart add_to_cart_button"
															data-product_id="<?php echo esc_attr( $product_id ); ?>"
															data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
															aria-label="<?php echo esc_attr( sprintf( __( 'Add “%s” to cart', 'manamchocolate' ), $title ) ); ?>"
														>
															<span class="btn-text">+ <?php esc_html_e( 'Add to cart', 'manamchocolate' ); ?></span>
															<span class="btn-loading-spinner" aria-hidden="true"></span>
														</button>
														<button
															type="button"
															class="product-quick-buy-btn btn-add-to-cart ajax_add_to_cart add_to_cart_button"
															data-product_id="<?php echo esc_attr( $product_id ); ?>"
															aria-label="<?php echo esc_attr( sprintf( __( 'Quick add “%s” to cart', 'manamchocolate' ), $title ) ); ?>"
														>
															<svg focusable="false" width="20" height="20" class="icon icon-quick-buy" fill="none" viewBox="0 0 24 24" aria-hidden="true">
																<path d="M14 4H5L4 20H20C19.7517 16.0273 19.375 10 19.375 10" stroke="currentColor" stroke-width="1.3"></path>
																<path d="M9 7V7C9 8.65685 10.3431 10 12 10V10C13.6569 10 15 8.65685 15 7V7" stroke="currentColor" stroke-width="1.3"></path>
																<path d="M20 0V8M16 4H24" stroke="currentColor" stroke-width="1.3"></path>
															</svg>
														</button>
													<?php else : ?>
														<button
															type="button"
															class="product-add-to-cart-btn is-disabled"
															disabled
															aria-disabled="true"
														>
															<span><?php esc_html_e( 'Sold out', 'manamchocolate' ); ?></span>
														</button>
													<?php endif; ?>
												</div>
											</div><!-- .product-item-image-wrapper -->

											<!-- Product Information -->
											<div class="product-item-info">
												<h3 class="product-item-title">
													<a href="<?php echo esc_url( $permalink ); ?>">
														<?php echo esc_html( $title ); ?>
													</a>
												</h3>

												<?php if ( ! empty( $weight_val ) ) : ?>
													<span class="product-item-weight">
														<?php echo esc_html( sprintf( __( 'Net Weight: %s%s', 'manamchocolate' ), $weight_val, $weight_unit ) ); ?>
													</span>
												<?php endif; ?>

												<div class="product-item-price-wrap">
													<span class="visually-hidden"><?php esc_html_e( 'Sale price', 'manamchocolate' ); ?></span>
													<span class="product-item-price">MRP <?php echo $price_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
													<span class="product-item-tax-note"><?php esc_html_e( '(Incl. of Taxes)', 'manamchocolate' ); ?></span>
												</div>
											</div><!-- .product-item-info -->
										</article><!-- .product-item-card -->
										<?php
									endforeach;
								else :
									// Fallback cards if products query is empty
									$tab_fallbacks = isset( $fallback_products[ $slug ] ) ? $fallback_products[ $slug ] : array();
									foreach ( $tab_fallbacks as $fb ) :
										?>
										<article class="product-item-card <?php echo ! $fb['in_stock'] ? 'is-sold-out' : ''; ?>">
											<div class="product-item-image-wrapper">
												<?php if ( ! $fb['in_stock'] ) : ?>
													<div class="product-item-badge-list">
														<span class="product-badge badge-sold-out">
															<?php esc_html_e( 'Sold out', 'manamchocolate' ); ?>
														</span>
													</div>
												<?php endif; ?>
												<div class="product-item-image-ratio">
													<img
														src="<?php echo esc_url( $placeholder_image ); ?>"
														alt="<?php echo esc_attr( $fb['title'] ); ?>"
														class="product-primary-image placeholder-image"
														width="800"
														height="1000"
														loading="lazy"
													/>
												</div>
											</div>
											<div class="product-item-info">
												<h3 class="product-item-title">
													<a href="<?php echo esc_url( $fb['permalink'] ); ?>">
														<?php echo esc_html( $fb['title'] ); ?>
													</a>
												</h3>
												<span class="product-item-weight">
													<?php echo esc_html( sprintf( __( 'Net Weight: %s%s', 'manamchocolate' ), $fb['weight'], $weight_unit ) ); ?>
												</span>
												<div class="product-item-price-wrap">
													<span class="product-item-price">MRP ₹<?php echo esc_html( $fb['price'] ); ?></span>
													<span class="product-item-tax-note"><?php esc_html_e( '(Incl. of Taxes)', 'manamchocolate' ); ?></span>
												</div>
											</div>
										</article>
										<?php
									endforeach;
								endif;
								?>
							</div><!-- .discover-products-grid -->
						</div><!-- .discover-products-slider -->

						<!-- Next Arrow -->
						<button
							type="button"
							class="discover-nav-arrow discover-nav-next"
							aria-label="<?php esc_attr_e( 'Next products', 'manamchocolate' ); ?>"
							data-slider-target="<?php echo esc_attr( $slider_id ); ?>"
						>
							<svg width="17" height="14" viewBox="0 0 17 14" fill="none" aria-hidden="true" focusable="false">
								<path d="M0 7h15M9 1l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div><!-- .discover-carousel-wrapper -->
				</div><!-- .discover-tab-pane -->
				<?php
				$panel_index++;
			endforeach;
			?>
		</div><!-- .discover-tabs-content -->
	</div><!-- .discover-section-inner -->
</section><!-- .discover-section -->

