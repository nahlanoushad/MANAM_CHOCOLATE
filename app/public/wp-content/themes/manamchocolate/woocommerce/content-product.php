<?php
/**
 * The template for displaying product content within loops
 *
 * Exact Recreation of the authentic Manam Chocolate product card:
 * - 4:5 Aspect ratio product photography
 * - Secondary image hover swap
 * - Cacao percentage badge (top right)
 * - Award winning medal badge (top left)
 * - Veg indicator icon
 * - Sold Out status badge
 * - Net Weight indicator
 * - MRP Price display with "(Incl. of Taxes)"
 * - Native WooCommerce AJAX Add-to-Cart with hover state
 *
 * @package ManamChocolate
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_id         = $product->get_id();
$title              = $product->get_name();
$permalink          = $product->get_permalink();
$in_stock           = $product->is_in_stock() && $product->is_purchasable();
$weight_val         = get_post_meta( $product_id, '_net_weight', true );
if ( empty( $weight_val ) ) {
	$weight_val = $product->get_weight();
}
$weight_unit        = get_option( 'woocommerce_weight_unit', 'g' );
$cacao_badge        = get_post_meta( $product_id, '_cacao_percentage', true );
$award_winning      = get_post_meta( $product_id, '_award_winning', true );
$award_badge        = get_post_meta( $product_id, '_award_badge', true );
$theme_uri          = get_template_directory_uri();
$placeholder_image  = $theme_uri . '/assets/images/product-placeholder.svg';
$card_classes       = array( 'product-item-card' );

if ( ! $in_stock ) {
	$card_classes[] = 'is-sold-out';
}

// Fallback cacao tag extraction from title if meta is empty
if ( empty( $cacao_badge ) ) {
	if ( preg_match( '/([0-9]+%\s*(?:Milk|Dark|Extra Dark|Malt Milk|Oat Mylk|Dark Milk))/i', $title, $m ) ) {
		$cacao_badge = $m[1];
	} elseif ( stripos( $title, 'Caramelised White' ) !== false ) {
		$cacao_badge = 'Caramelised White';
	} elseif ( stripos( $title, 'White Chocolate' ) !== false || stripos( $title, 'White' ) !== false ) {
		if ( stripos( $title, 'Tablet' ) !== false ) {
			$cacao_badge = 'White';
		}
	}
}

// Secondary hover image
$gallery_image_ids  = $product->get_gallery_image_ids();
$secondary_image_id = ! empty( $gallery_image_ids ) ? $gallery_image_ids[0] : (int) get_post_meta( $product_id, '_secondary_image_id', true );
?>
<li <?php wc_product_class( $card_classes, $product ); ?> data-product-id="<?php echo esc_attr( $product_id ); ?>" data-reveal="up">
	<div class="product-item-image-wrapper">
		<!-- Award Badge (Top Left) -->
		<?php if ( 'Yes' === $award_winning || ! empty( $award_badge ) ) : ?>
			<div class="product-item-award-tag" title="<?php echo esc_attr( ! empty( $award_badge ) ? $award_badge : 'Award Winning' ); ?>">
				<div class="award-tag-inner">
					<svg width="18" height="26" viewBox="0 0 24 32" fill="none" class="award-medal-icon" aria-hidden="true">
						<circle cx="12" cy="11" r="9" stroke="#71717A" stroke-width="2" fill="#E4E4E7"/>
						<path d="M7 20L5 31L12 27L19 31L17 20" stroke="#71717A" stroke-width="1.5" fill="#A1A1AA"/>
					</svg>
					<span class="award-tag-label"><?php echo esc_html( ! empty( $award_badge ) ? $award_badge : 'Award Winning' ); ?></span>
				</div>
			</div>
		<?php endif; ?>

		<!-- Cacao Percentage Badge (Top Right) -->
		<?php if ( ! empty( $cacao_badge ) ) : ?>
			<div class="product-item-cacao-tag">
				<span class="cacao-tag-text"><?php echo esc_html( $cacao_badge ); ?></span>
			</div>
		<?php endif; ?>

		<!-- Sold Out Badge -->
		<?php if ( ! $in_stock ) : ?>
			<div class="product-item-badge-list">
				<span class="product-badge badge-sold-out">
					<?php esc_html_e( 'Sold out', 'manamchocolate' ); ?>
				</span>
			</div>
		<?php endif; ?>

		<!-- Clickable Image Link with Primary & Secondary Hover Image -->
		<a href="<?php echo esc_url( $permalink ); ?>" class="product-item-image-link" tabindex="-1" aria-hidden="true">
			<div class="product-item-image-ratio">
				<?php
				if ( has_post_thumbnail( $product_id ) ) {
					echo $product->get_image(
						'full',
						array(
							'class'   => 'product-primary-image',
							'loading' => 'lazy',
							'alt'     => esc_attr( $title ),
						)
					);
					if ( $secondary_image_id ) {
						echo wp_get_attachment_image(
							$secondary_image_id,
							'full',
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

		<!-- Add to Cart / Quick Buy Action Buttons -->
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
		<div class="product-item-header-row">
			<h3 class="product-item-title">
				<a href="<?php echo esc_url( $permalink ); ?>">
					<?php echo esc_html( $title ); ?>
				</a>
			</h3>
			<span class="product-item-veg-icon" title="<?php esc_attr_e( 'Vegetarian', 'manamchocolate' ); ?>" aria-label="<?php esc_attr_e( 'Vegetarian', 'manamchocolate' ); ?>">
				<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
					<rect x="0.5" y="0.5" width="13" height="13" stroke="#229653" fill="#ffffff" stroke-width="1"/>
					<circle cx="7" cy="7" r="3.5" fill="#229653"/>
				</svg>
			</span>
		</div>

		<?php if ( ! empty( $weight_val ) ) : ?>
			<span class="product-item-weight">
				<?php echo esc_html( sprintf( __( 'Net Weight: %s%s', 'manamchocolate' ), $weight_val, ( is_numeric( $weight_val ) ? ' ' . $weight_unit : '' ) ) ); ?>
			</span>
		<?php endif; ?>

		<div class="product-item-price-wrap">
			<span class="visually-hidden"><?php esc_html_e( 'Sale price', 'manamchocolate' ); ?></span>
			<span class="product-item-price">MRP <?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span class="product-item-tax-note"><?php esc_html_e( '(Incl. of Taxes)', 'manamchocolate' ); ?></span>
		</div>
	</div><!-- .product-item-info -->
</li>
