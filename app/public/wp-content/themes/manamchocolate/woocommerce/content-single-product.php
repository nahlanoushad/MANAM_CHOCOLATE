<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Implements the authentic Manam Chocolate product details experience:
 * - Interactive multi-image gallery with thumbnail navigation and fallback to product-placeholder.svg
 * - Product Meta: Net Weight, Product Title, MRP Price with "(Incl. of Taxes)", Unit Price
 * - Genuine review/rating display only when authentic reviews exist (zero fabricated ratings)
 * - Product Highlights: Dietary & Lifestyle chips (Celiac Friendly, Nut Free, Vegan, etc.)
 * - Taste Descriptors: Tasting notes, Origin, Cacao percentage
 * - Native Purchasing Form: Interactive Quantity selector, Add to Cart button, Variable product support
 * - Delivery Pincode Checker: 6-digit Indian PIN code input with validation
 * - 5-Section Product Information Tabs & Mobile Accordions:
 *     1. Description
 *     2. Product Info (Shelf Life, Manufacturer, Country of Origin)
 *     3. Ingredients
 *     4. Storage Information
 *     5. Allergen Information
 * - "More in Collection": Curated related products from the same collection
 *
 * @package ManamChocolate
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

$product_id   = $product->get_id();
$is_gift_card = ( 'gift-card' === $product->get_slug() || 97 === $product_id );
$theme_uri    = get_template_directory_uri();
$home_url     = home_url( '/' );
$shop_url     = wc_get_page_permalink( 'shop' );
$placeholder  = $theme_uri . '/assets/images/product-placeholder.svg';
$in_stock     = $product->is_in_stock() && $product->is_purchasable();

// 1. Fetch Categories & Breadcrumbs
$categories = wp_get_post_terms( $product_id, 'product_cat' );
$primary_cat = null;
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
	foreach ( $categories as $cat ) {
		if ( 'discover' !== $cat->slug && 'uncategorized' !== $cat->slug ) {
			$primary_cat = $cat;
			break;
		}
	}
	if ( ! $primary_cat ) {
		$primary_cat = $categories[0];
	}
}

// 2. Fetch Product Specifications & Metadata
$weight_display = get_post_meta( $product_id, '_net_weight', true );
if ( empty( $weight_display ) && $product->get_weight() ) {
	$weight_display = $product->get_weight() . ' ' . get_option( 'woocommerce_weight_unit', 'g' );
}

$unit_price         = get_post_meta( $product_id, '_unit_price', true );
$dietary_badges_raw = get_post_meta( $product_id, '_dietary_badges', true );
$tasting_notes      = get_post_meta( $product_id, '_tasting_notes', true );
$shelf_life         = get_post_meta( $product_id, '_shelf_life', true );
$manufacturer       = get_post_meta( $product_id, '_manufacturer', true );
$storage_info       = get_post_meta( $product_id, '_storage_info', true );
$ingredients        = get_post_meta( $product_id, '_ingredients', true );
$allergen_info      = get_post_meta( $product_id, '_allergen_info', true );
$country_of_origin  = get_post_meta( $product_id, '_country_of_origin', true ) ?: 'India';

// Check attributes for Origin & Cacao Percentage if not directly in meta
$origin_term   = $product->get_attribute( 'pa_origin' );
if ( empty( $origin_term ) ) {
	$origin_term = get_post_meta( $product_id, '_origin', true );
}
$cacao_pct     = $product->get_attribute( 'pa_cacao_percentage' );
if ( empty( $cacao_pct ) ) {
	$cacao_pct = get_post_meta( $product_id, '_cacao_percentage', true );
}

// Split dietary chips with deduplication
$dietary_chips = array();
if ( ! empty( $dietary_badges_raw ) ) {
	$raw_chips   = array_map( 'trim', explode( ',', $dietary_badges_raw ) );
	$known_chips = array( 'Celiac Friendly', 'Nut Free', 'Vegan', 'Dairy Free', 'Eggless', 'Vegetarian' );
	$filtered    = array();
	foreach ( $raw_chips as $rc ) {
		foreach ( $known_chips as $kc ) {
			if ( stripos( $rc, $kc ) !== false ) {
				$filtered[] = $kc;
			}
		}
	}
	$dietary_chips = ! empty( $filtered ) ? array_values( array_unique( $filtered ) ) : array_values( array_unique( array_filter( $raw_chips ) ) );
}


// 3. Image Gallery Setup
$attachment_ids = $product->get_gallery_image_ids();
$main_image_id  = $product->get_image_id();
$all_image_urls = array();

if ( $main_image_id ) {
	$full_src = wp_get_attachment_image_url( $main_image_id, 'full' );
	if ( $full_src ) {
		$all_image_urls[] = array(
			'id'    => $main_image_id,
			'full'  => $full_src,
			'thumb' => wp_get_attachment_image_url( $main_image_id, 'woocommerce_thumbnail' ),
			'alt'   => get_post_meta( $main_image_id, '_wp_attachment_image_alt', true ) ?: get_the_title(),
		);
	}
}

foreach ( $attachment_ids as $att_id ) {
	if ( $att_id === $main_image_id ) {
		continue;
	}
	$full_src = wp_get_attachment_image_url( $att_id, 'full' );
	if ( $full_src ) {
		$all_image_urls[] = array(
			'id'    => $att_id,
			'full'  => $full_src,
			'thumb' => wp_get_attachment_image_url( $att_id, 'woocommerce_thumbnail' ),
			'alt'   => get_post_meta( $att_id, '_wp_attachment_image_alt', true ) ?: get_the_title(),
		);
	}
}

// Default to placeholder if no image attached
if ( empty( $all_image_urls ) ) {
	$prod_slug   = $product->get_slug();
	$default_img = $placeholder;
	if ( 'private-chocolatiering-workshops' === $prod_slug && file_exists( get_template_directory() . '/assets/images/experience-private-workshop.svg' ) ) {
		$default_img = $theme_uri . '/assets/images/experience-private-workshop.svg';
	}
	$all_image_urls[] = array(
		'id'    => 0,
		'full'  => $default_img,
		'thumb' => $default_img,
		'alt'   => get_the_title(),
	);
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product product--thumbnails-left manam-single-product', $product ); ?>>

	<!-- 1. BREADCRUMBS -->
	<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
		<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
		<span class="breadcrumb-separator">/</span>
		<a href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Collections', 'manamchocolate' ); ?></a>
		<?php if ( $primary_cat ) : ?>
			<span class="breadcrumb-separator">/</span>
			<a href="<?php echo esc_url( get_term_link( $primary_cat ) ); ?>"><?php echo esc_html( $primary_cat->name ); ?></a>
		<?php endif; ?>
		<span class="breadcrumb-separator">/</span>
		<span class="breadcrumb-current"><?php the_title(); ?></span>
	</nav>

	<!-- 2. TWO-COLUMN PRODUCT DETAILS HERO -->
	<div class="product-main-layout">

		<!-- LEFT COLUMN: PRODUCT GALLERY -->
		<div class="product__media" id="product-gallery" data-reveal="fade">
			<div class="product__gallery-container <?php echo count( $all_image_urls ) > 1 ? 'has-thumbnails' : 'no-thumbnails'; ?>">

				<!-- Thumbnail Strip (Desktop Left / Mobile Bottom) -->
				<?php if ( count( $all_image_urls ) > 1 ) : ?>
					<div class="product__thumbnail-list-wrapper hide-scrollbar">
						<div class="product__thumbnail-list" role="tablist">
							<?php foreach ( $all_image_urls as $idx => $img_data ) : ?>
								<button
									type="button"
									class="product__thumbnail-item <?php echo 0 === $idx ? 'is-active' : ''; ?>"
									data-index="<?php echo esc_attr( $idx ); ?>"
									data-large-src="<?php echo esc_url( $img_data['full'] ); ?>"
									data-alt="<?php echo esc_attr( $img_data['alt'] ); ?>"
									role="tab"
									aria-selected="<?php echo 0 === $idx ? 'true' : 'false'; ?>"
									aria-label="<?php echo esc_attr( sprintf( __( 'View image %d', 'manamchocolate' ), $idx + 1 ) ); ?>"
								>
									<img src="<?php echo esc_url( $img_data['thumb'] ); ?>" alt="<?php echo esc_attr( $img_data['alt'] ); ?>" width="80" height="100" loading="lazy">
								</button>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- Main Large Active Image Display -->
				<div class="product__main-image-wrapper">
					<?php if ( ! $in_stock ) : ?>
						<div class="product-badge-wrap">
							<span class="product-badge badge-sold-out"><?php esc_html_e( 'Sold out', 'manamchocolate' ); ?></span>
						</div>
					<?php endif; ?>

					<div class="product__main-image-ratio">
						<img
							id="product-main-view"
							src="<?php echo esc_url( $all_image_urls[0]['full'] ); ?>"
							alt="<?php echo esc_attr( $all_image_urls[0]['alt'] ); ?>"
							class="product__active-photo"
							width="1000"
							height="1250"
							loading="eager"
						/>
					</div>
				</div>

			</div>
		</div><!-- .product__media -->

		<!-- RIGHT COLUMN: PRODUCT INFORMATION -->
		<div class="product__info" data-reveal="up">

			<!-- 1. Product Title -->
			<h1 class="product-meta__title"><?php the_title(); ?></h1>

			<!-- 2. Veg Icon & Net Weight / Unit Price (Exact Reference Format) -->
			<div class="product-meta__weight-wrap">
				<span class="product-veg-icon" title="<?php esc_attr_e( 'Vegetarian', 'manamchocolate' ); ?>" aria-label="<?php esc_attr_e( 'Vegetarian', 'manamchocolate' ); ?>">
					<span class="product-veg-icon__square">
						<span class="product-veg-icon__circle"></span>
					</span>
				</span>
				<?php if ( ! empty( $weight_display ) ) : ?>
					<span class="product-meta__weight">
						<?php
						echo esc_html( sprintf( __( 'Net Weight: %s', 'manamchocolate' ), $weight_display ) );
						if ( ! empty( $unit_price ) && ! $is_gift_card ) {
							echo esc_html( sprintf( __( ', Unit Price: %s', 'manamchocolate' ), $unit_price ) );
						}
						?>
					</span>
				<?php endif; ?>
			</div>

			<!-- 3. Price & Taxes -->
			<div class="product-meta__price-wrap">
				<?php if ( $is_gift_card ) : ?>
					<span class="product-meta__price" id="gift-card-active-price">MRP <span class="amount"><bdi><span class="woocommerce-Price-currencySymbol">&#8377;</span>1,000</bdi></span></span>
				<?php else : ?>
					<span class="product-meta__price">MRP <?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php endif; ?>
				<span class="product-meta__tax-note"><?php esc_html_e( '(Incl. of Taxes)', 'manamchocolate' ); ?></span>
			</div>

			<?php if ( $is_gift_card ) : ?>
				<!-- Gift Card Denominations -->
				<div class="gift-card-denominations-section">
					<label class="gift-card-field-label"><strong><?php esc_html_e( 'Denominations:', 'manamchocolate' ); ?></strong></label>
					<div class="gift-card-denominations-group" role="radiogroup" aria-label="<?php esc_attr_e( 'Denominations', 'manamchocolate' ); ?>">
						<button type="button" class="gift-card-denom-btn is-active" data-amount="1000">₹1000</button>
						<button type="button" class="gift-card-denom-btn" data-amount="2000">₹2000</button>
						<button type="button" class="gift-card-denom-btn" data-amount="3000">₹3000</button>
						<button type="button" class="gift-card-denom-btn" data-amount="5000">₹5000</button>
					</div>
				</div>
			<?php endif; ?>

			<!-- 4. Customer Rating (Displayed ONLY if genuine reviews exist) -->
			<?php if ( wc_review_ratings_enabled() && $product->get_review_count() > 0 ) : ?>
				<div class="product-meta__reviews-badge">
					<?php echo wc_get_rating_html( $product->get_average_rating() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="reviews-count-text">
						<?php
						printf(
							/* translators: %s: number of reviews */
							_n( '%s review', '%s reviews', $product->get_review_count(), 'manamchocolate' ),
							esc_html( $product->get_review_count() )
						);
						?>
					</span>
				</div>
			<?php endif; ?>

			<!-- 5. Dietary & Lifestyle Highlights Chips -->
			<?php if ( ! empty( $dietary_chips ) ) : ?>
				<div class="product-highlights">
					<div class="product-highlights__chips">
						<?php foreach ( $dietary_chips as $chip ) : ?>
							<div class="product-highlights__chip">
								<span class="product-highlights__chip-title"><?php echo esc_html( $chip ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- 6. Taste Descriptors Table -->
			<?php if ( ! empty( $tasting_notes ) || ! empty( $origin_term ) || ! empty( $cacao_pct ) ) : ?>
				<div class="taste-descriptors">
					<div class="taste-descriptors__table">
						<?php if ( ! empty( $tasting_notes ) ) : ?>
							<div class="taste-descriptors__row">
								<span class="taste-descriptors__label"><?php esc_html_e( 'Tasting notes', 'manamchocolate' ); ?></span>
								<span class="taste-descriptors__value"><?php echo esc_html( $tasting_notes ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $origin_term ) ) : ?>
							<div class="taste-descriptors__row">
								<span class="taste-descriptors__label"><?php esc_html_e( 'Origin.', 'manamchocolate' ); ?></span>
								<span class="taste-descriptors__value"><?php echo esc_html( $origin_term ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $cacao_pct ) ) : ?>
							<div class="taste-descriptors__row">
								<span class="taste-descriptors__label"><?php esc_html_e( 'Cacao Percentage', 'manamchocolate' ); ?></span>
								<span class="taste-descriptors__value"><?php echo esc_html( $cacao_pct ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- 7. Delivery Pincode Checker (Positioned Above Purchase Button per Reference) -->
			<?php if ( ! $is_gift_card ) : ?>
			<div class="pincode-checker-box" id="pincode-checker">
				<div class="pincode-checker-content">
					<div class="pincode-form">
						<div class="pincode-input-group">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="pincode-truck-icon" aria-hidden="true">
								<rect x="1" y="3" width="15" height="13"></rect>
								<polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
								<circle cx="5.5" cy="18.5" r="2.5"></circle>
								<circle cx="18.5" cy="18.5" r="2.5"></circle>
							</svg>
							<input
								type="text"
								id="pincode-input"
								name="pincode"
								class="pincode-number-input"
								pattern="[0-9]{6}"
								inputmode="numeric"
								maxlength="6"
								placeholder="<?php esc_attr_e( 'Check pincode for delivery date', 'manamchocolate' ); ?>"
								required
							/>
							<button type="button" id="pincode-check-btn" class="pincode-check-btn"><?php esc_html_e( 'CHECK', 'manamchocolate' ); ?></button>
						</div>
						<div id="pincode-feedback" class="pincode-feedback-message" aria-live="polite"></div>
					</div>
				</div>
			</div><!-- .pincode-checker-box -->
			<?php endif; ?>

			<!-- 8. Purchasing Area: Add to Cart Form -->
			<div class="product-purchasing-area">
				<?php if ( $product->is_type( 'variable' ) ) : ?>
					<!-- Native WooCommerce Variable Form -->
					<?php woocommerce_variable_add_to_cart(); ?>
				<?php else : ?>
					<!-- Native Simple Product Form -->
					<form class="cart manam-product-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
						<?php if ( $is_gift_card ) : ?>
							<!-- Gift Card Recipient Details -->
							<input type="hidden" name="gift_card_denomination" id="gift_card_denomination_input" value="1000" />
							<input type="hidden" name="quantity" value="1" />
							<div class="gift-card-recipient-fields">
								<div class="form-field-group">
									<label for="gift_card_recipient_email" class="gift-card-label"><?php esc_html_e( 'Recipient email*', 'manamchocolate' ); ?></label>
									<input type="email" id="gift_card_recipient_email" name="gift_card_recipient_email" class="form-field-input" placeholder="<?php esc_attr_e( 'recipient@example.com', 'manamchocolate' ); ?>" required />
								</div>
								<div class="form-field-group">
									<label for="gift_card_recipient_name" class="gift-card-label"><?php esc_html_e( 'Recipient name (optional)', 'manamchocolate' ); ?></label>
									<input type="text" id="gift_card_recipient_name" name="gift_card_recipient_name" class="form-field-input" placeholder="<?php esc_attr_e( 'Recipient Name', 'manamchocolate' ); ?>" />
								</div>
								<div class="form-field-group">
									<label for="gift_card_message" class="gift-card-label"><?php esc_html_e( 'Message (optional)', 'manamchocolate' ); ?></label>
									<textarea id="gift_card_message" name="gift_card_message" rows="3" class="form-field-input" placeholder="<?php esc_attr_e( 'Add a heartfelt note...', 'manamchocolate' ); ?>"></textarea>
								</div>
								<div class="form-field-group">
									<label for="gift_card_sender_name" class="gift-card-label"><?php esc_html_e( 'Sender name (optional)', 'manamchocolate' ); ?></label>
									<input type="text" id="gift_card_sender_name" name="gift_card_sender_name" class="form-field-input" placeholder="<?php esc_attr_e( 'Your Name', 'manamchocolate' ); ?>" />
								</div>
								<div class="form-field-group">
									<label for="gift_card_send_on" class="gift-card-label"><?php esc_html_e( 'Send on (optional)', 'manamchocolate' ); ?></label>
									<input type="date" id="gift_card_send_on" name="gift_card_send_on" class="form-field-input" />
								</div>
							</div>
							<div class="purchasing-controls-row">
								<button
									type="submit"
									name="add-to-cart"
									value="<?php echo esc_attr( $product->get_id() ); ?>"
									data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
									class="single_add_to_cart_button button button--primary product-form__add-button btn-add-to-cart btn-add-to-cart--full"
								>
									<span class="btn-text"><?php esc_html_e( 'ADD TO CART', 'manamchocolate' ); ?></span>
									<span class="btn-loading-spinner" aria-hidden="true"></span>
								</button>
							</div>
						<?php elseif ( $in_stock ) : ?>
							<div class="purchasing-controls-row">
								<!-- Quantity Selector -->
								<div class="quantity-selector-wrap">
									<button type="button" class="qty-btn qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'manamchocolate' ); ?>">&minus;</button>
									<input
										type="number"
										id="product-quantity-input"
										class="qty-input input-text qty text"
										name="quantity"
										value="1"
										aria-label="<?php esc_attr_e( 'Product quantity', 'manamchocolate' ); ?>"
										size="4"
										min="<?php echo esc_attr( $product->get_min_purchase_quantity() ); ?>"
										max="<?php echo esc_attr( $product->get_max_purchase_quantity() > 0 ? $product->get_max_purchase_quantity() : '' ); ?>"
										step="1"
										inputmode="numeric"
										autocomplete="off"
									/>
									<button type="button" class="qty-btn qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'manamchocolate' ); ?>">&plus;</button>
								</div>

								<!-- Add to Cart Button (Full width) -->
								<button
									type="submit"
									name="add-to-cart"
									value="<?php echo esc_attr( $product->get_id() ); ?>"
									data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
									class="single_add_to_cart_button button button--primary product-form__add-button btn-add-to-cart"
								>
									<span class="btn-text"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
									<span class="btn-loading-spinner" aria-hidden="true"></span>
								</button>
							</div>
						<?php else : ?>
							<button type="button" class="product-form__add-button button is-disabled" disabled aria-disabled="true">
								<span><?php esc_html_e( 'Sold out', 'manamchocolate' ); ?></span>
							</button>
						<?php endif; ?>
					</form>
				<?php endif; ?>
			</div><!-- .product-purchasing-area -->

		</div><!-- .product__info -->


	</div><!-- .product-main-layout -->

	<?php if ( $is_gift_card ) : ?>
		<!-- Gift Card Terms & Conditions Section -->
		<section class="product-info-tabs-section gift-card-terms-section" aria-label="<?php esc_attr_e( 'Terms & Conditions', 'manamchocolate' ); ?>">
			<div class="site-container">
				<div class="gift-card-terms-box">
					<h3 class="gift-card-terms-title"><?php esc_html_e( 'Terms & Conditions', 'manamchocolate' ); ?></h3>
					<div class="gift-card-terms-content">
						<ol class="gift-card-terms-list">
							<li>
								<strong><?php esc_html_e( '1. Applicability', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'These terms apply to digital Gift Cards purchased on www.manamchocolate.com. Gift Cards are redeemable only on this website and cannot be used at physical stores, on quick commerce platforms, or on any marketplace.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '2. Purchase & Delivery', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'Gift Cards are delivered digitally to the email address provided at checkout or on the product detail page. Please verify the recipient\'s email is correct. Manam Chocolate is not responsible for incorrect email addresses entered for Gift Cards by the purchaser.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '3. Redemption', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'Enter the unique Gift Card code at checkout to apply your Gift Card value against your order. Gift Cards can only be used towards the product total.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '4. Partial Use', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'If the order value is less than the Gift Card value, the balance stays on the Gift Card for future use, until expiry. If the order value exceeds the Gift Card value, the difference must be paid via available payment methods.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '5. No Cash Value', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'Gift Cards cannot be exchanged, redeemed, or refunded for cash, in whole or in part, except where required by law.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '6. Non-Refundable', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'Gift Card purchases are final and cannot be cancelled, refunded, or returned once issued.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '7. Lost, Stolen or Misused Codes', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'Treat the Gift Card code like cash. Manam Chocolate is not liable for lost, stolen, or unauthorised use of a Gift Card code. Gift Cards cannot be reissued if the code is compromised.', 'manamchocolate' ); ?></p>
							</li>
							<li>
								<strong><?php esc_html_e( '8. Amendments', 'manamchocolate' ); ?></strong>
								<p><?php esc_html_e( 'We may amend these terms at any time. The terms in effect at the time of purchase apply to your Gift Card.', 'manamchocolate' ); ?></p>
							</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
	<?php else : ?>
	<!-- 3. PRODUCT INFORMATION TABS & ACCORDIONS -->
	<section class="product-info-tabs-section" aria-label="<?php esc_attr_e( 'Product Details', 'manamchocolate' ); ?>">
		
		<!-- Desktop Tab Nav Bar (Exact Reference Uppercase Titles) -->
		<div class="tabs-nav-bar hide-scrollbar" role="tablist">
			<button type="button" class="tab-nav-btn is-active" data-tab-target="tab-description" role="tab" aria-selected="true">
				<?php esc_html_e( 'DESCRIPTION', 'manamchocolate' ); ?>
			</button>
			<button type="button" class="tab-nav-btn" data-tab-target="tab-product-info" role="tab" aria-selected="false">
				<?php esc_html_e( 'PRODUCT INFO', 'manamchocolate' ); ?>
			</button>
			<button type="button" class="tab-nav-btn" data-tab-target="tab-ingredients" role="tab" aria-selected="false">
				<?php esc_html_e( 'INGREDIENTS', 'manamchocolate' ); ?>
			</button>
			<button type="button" class="tab-nav-btn" data-tab-target="tab-storage" role="tab" aria-selected="false">
				<?php esc_html_e( 'STORAGE INFORMATION', 'manamchocolate' ); ?>
			</button>
			<button type="button" class="tab-nav-btn" data-tab-target="tab-allergens" role="tab" aria-selected="false">
				<?php esc_html_e( 'ALLERGEN INFORMATION', 'manamchocolate' ); ?>
			</button>
		</div>


		<!-- Tab Panels (Desktop View) & Accordions (Mobile View) -->
		<div class="tabs-panels-wrap">

			<!-- 1. Description -->
			<div class="tab-panel is-active" id="tab-description" role="tabpanel">
				<button type="button" class="mobile-accordion-header" aria-expanded="true">
					<span><?php esc_html_e( 'Description', 'manamchocolate' ); ?></span>
					<svg class="accordion-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"/></svg>
				</button>
				<div class="tab-panel-inner">
					<div class="product-description-content">
						<?php
						$content = get_the_content();
						if ( ! empty( $content ) ) {
							the_content();
						} else {
							echo wp_kses_post( wpautop( $product->get_short_description() ?: __( 'Specially crafted chocolate made with single-origin Indian cacao beans, celebrating the terroir and progressive craft chocolate practices of India.', 'manamchocolate' ) ) );
						}
						?>
					</div>
				</div>
			</div>

			<!-- 2. Product Info -->
			<div class="tab-panel" id="tab-product-info" role="tabpanel">
				<button type="button" class="mobile-accordion-header" aria-expanded="false">
					<span><?php esc_html_e( 'Product Info', 'manamchocolate' ); ?></span>
					<svg class="accordion-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"/></svg>
				</button>
				<div class="tab-panel-inner">
					<div class="spec-table">
						<?php if ( ! empty( $shelf_life ) ) : ?>
							<div class="spec-row">
								<span class="spec-label"><?php esc_html_e( 'Shelf life', 'manamchocolate' ); ?>:</span>
								<span class="spec-value"><?php echo esc_html( $shelf_life ); ?></span>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $country_of_origin ) ) : ?>
							<div class="spec-row">
								<span class="spec-label"><?php esc_html_e( 'Country of Origin', 'manamchocolate' ); ?>:</span>
								<span class="spec-value"><?php echo esc_html( $country_of_origin ); ?></span>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $manufacturer ) ) : ?>
							<div class="spec-row">
								<span class="spec-label"><?php esc_html_e( 'Manufactured By', 'manamchocolate' ); ?>:</span>
								<span class="spec-value"><?php echo esc_html( $manufacturer ); ?></span>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $weight_display ) ) : ?>
							<div class="spec-row">
								<span class="spec-label"><?php esc_html_e( 'Net Weight', 'manamchocolate' ); ?>:</span>
								<span class="spec-value"><?php echo esc_html( $weight_display ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- 3. Ingredients -->
			<div class="tab-panel" id="tab-ingredients" role="tabpanel">
				<button type="button" class="mobile-accordion-header" aria-expanded="false">
					<span><?php esc_html_e( 'Ingredients', 'manamchocolate' ); ?></span>
					<svg class="accordion-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"/></svg>
				</button>
				<div class="tab-panel-inner">
					<div class="ingredients-content">
						<?php if ( ! empty( $ingredients ) ) : ?>
							<p><?php echo esc_html( $ingredients ); ?></p>
						<?php else : ?>
							<p class="text-subdued"><?php esc_html_e( 'Detailed ingredient list for this product is currently being updated.', 'manamchocolate' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- 4. Storage Information -->
			<div class="tab-panel" id="tab-storage" role="tabpanel">
				<button type="button" class="mobile-accordion-header" aria-expanded="false">
					<span><?php esc_html_e( 'Storage Information', 'manamchocolate' ); ?></span>
					<svg class="accordion-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"/></svg>
				</button>
				<div class="tab-panel-inner">
					<div class="storage-content">
						<?php if ( ! empty( $storage_info ) ) : ?>
							<p><?php echo esc_html( $storage_info ); ?></p>
						<?php else : ?>
							<p><?php esc_html_e( 'Store in a cool, dry and dark place. Recommended storage temperature 16°C - 18°C. Changes in temperature and humidity may produce a whitish layer on the product. This does not affect its fitness for consumption.', 'manamchocolate' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- 5. Allergen Information -->
			<div class="tab-panel" id="tab-allergens" role="tabpanel">
				<button type="button" class="mobile-accordion-header" aria-expanded="false">
					<span><?php esc_html_e( 'Allergen Information', 'manamchocolate' ); ?></span>
					<svg class="accordion-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"/></svg>
				</button>
				<div class="tab-panel-inner">
					<div class="allergens-content">
						<?php if ( ! empty( $allergen_info ) ) : ?>
							<p><?php echo esc_html( $allergen_info ); ?></p>
						<?php else : ?>
							<p><?php esc_html_e( 'Product is made in a facility that handles nuts, wheat, oats, barley and milk. May contain traces of the same.', 'manamchocolate' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div><!-- .tabs-panels-wrap -->
	</section><!-- .product-info-tabs-section -->
	<?php endif; ?>

	<!-- 4. MORE IN COLLECTION / RELATED PRODUCTS -->
	<?php
	$related_args = array(
		'post_type'      => 'product',
		'posts_per_page' => 4,
		'post__not_in'   => array( $product_id ),
		'orderby'        => 'rand',
	);

	if ( $primary_cat ) {
		$related_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $primary_cat->term_id,
			),
		);
	}

	$related_query = new WP_Query( $related_args );

	if ( $related_query->have_posts() ) :
		?>
		<section class="more-in-collection-section" aria-labelledby="more-in-collection-heading">
			<div class="section-header text-center">
				<span class="section-subtitle"><?php esc_html_e( 'MORE FROM', 'manamchocolate' ); ?></span>
				<h2 id="more-in-collection-heading" class="section-title">
					<?php
					$more_from_custom = get_post_meta( $product_id, '_product_more_from', true );
					if ( ! empty( $more_from_custom ) ) {
						echo esc_html( strtoupper( $more_from_custom ) );
					} elseif ( $primary_cat ) {
						echo esc_html( strtoupper( $primary_cat->name ) );
					} else {
						esc_html_e( 'COLLECTION', 'manamchocolate' );
					}
					?>
				</h2>
			</div>


			<div class="product-facet__product-list related-products-grid">
				<?php
				while ( $related_query->have_posts() ) :
					$related_query->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</section>
	<?php endif; ?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php
do_action( 'woocommerce_after_single_product' );
