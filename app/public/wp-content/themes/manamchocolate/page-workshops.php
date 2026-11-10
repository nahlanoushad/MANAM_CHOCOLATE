<?php
/**
 * Template Name: Workshops Collection Page
 * Description: Recreates the Manam Chocolate Workshops collection page for Delhi & Hyderabad.
 *
 * Implements:
 * - Dynamic location detection (Delhi / Hyderabad)
 * - Breadcrumb navigation
 * - Location-tailored header and hero imagery
 * - WooCommerce workshop product loop (when live products exist)
 * - Authentic reference Workshop Notification Form with WhatsApp +91 validation & Email
 * - Secure AJAX submission with WordPress nonce protection
 * - "What to Expect" workshop experience overview
 * - Private workshops cross-link
 *
 * @package ManamChocolate
 * @since 1.3.0
 */

get_header();

$theme_uri  = get_template_directory_uri();
$home_url   = home_url( '/' );
$page_slug  = get_post_field( 'post_name', get_post() );
$is_delhi   = ( false !== strpos( $page_slug, 'delhi' ) );

if ( $is_delhi ) {
	$location_title  = __( 'Workshops in Delhi', 'manamchocolate' );
	$location_slug   = 'delhi';
	$cat_slug        = 'workshops-in-delhi';
	$venue_name      = __( 'Eldeco Center, Saket, New Delhi', 'manamchocolate' );
	$venue_phone     = '+91 8977760769';
	$hero_img        = $theme_uri . '/assets/images/experience-workshop-delhi.jpg';
	$hero_img_mobile = $theme_uri . '/assets/images/experience-workshop-delhi-listing.jpg';
	$location_desc   = __( 'Interactive craft chocolate workshops, guided tastings, and bespoke chocolatiering masterclasses at Eldeco Center, Saket, New Delhi.', 'manamchocolate' );
} else {
	$location_title  = __( 'Workshops in Hyderabad', 'manamchocolate' );
	$location_slug   = 'hyderabad';
	$cat_slug        = 'workshops-in-hyderabad';
	$venue_name      = __( 'Manam Chocolate Karkhana, Road No. 12, Banjara Hills, Hyderabad', 'manamchocolate' );
	$venue_phone     = '+91 8977760769';
	$hero_img        = $theme_uri . '/assets/images/experience-workshop-hyderabad.jpg';
	$hero_img_mobile = $theme_uri . '/assets/images/experience-workshop-hyderabad-mobile.jpg';
	$location_desc   = __( 'Live factory masterclasses, bean-to-bar chocolate making, and chocolatiering immersions at the Manam Chocolate Karkhana, Banjara Hills, Hyderabad.', 'manamchocolate' );
}

// Check for live WooCommerce products in this category
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 12,
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $cat_slug,
		),
	),
);
$workshop_query = new WP_Query( $args );
?>

<main id="primary" class="site-main workshops-page-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<a href="<?php echo esc_url( $home_url . 'experience' ); ?>"><?php esc_html_e( 'Experience', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php echo esc_html( $location_title ); ?></span>
		</nav>
	</div>

	<!-- 2. COLLECTION HEADER -->
	<header class="workshops-header">
		<div class="site-container">
			<div class="workshops-header-grid">
				<div class="workshops-header-text" data-reveal="up">
					<span class="workshops-eyebrow"><?php esc_html_e( 'EXPERIENCE & MASTERCLASSES', 'manamchocolate' ); ?></span>
					<h1 class="workshops-title"><?php echo esc_html( $location_title ); ?></h1>
					<p class="workshops-desc"><?php echo esc_html( $location_desc ); ?></p>
					<div class="workshops-venue-pill">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
						<span><?php echo esc_html( $venue_name ); ?></span>
					</div>
				</div>
				<div class="workshops-header-media" data-reveal="fade">
					<picture>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $hero_img_mobile ); ?>" />
						<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php echo esc_attr( $location_title ); ?>" class="workshops-hero-img" width="1200" height="800" loading="eager" />
					</picture>
				</div>
			</div>
		</div>
	</header>

	<!-- 3. WORKSHOPS LISTING OR NOTIFICATION FORM -->
	<section class="workshops-content-section" aria-label="<?php echo esc_attr( $location_title ); ?>" data-reveal="up">
		<div class="site-container">

			<?php if ( $workshop_query->have_posts() ) : ?>

				<div class="product-facet__product-list workshops-grid">
					<?php
					while ( $workshop_query->have_posts() ) :
						$workshop_query->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>

			<?php else : ?>

				<!-- Reference Empty-State & Workshop Notification Form -->
				<div class="workshop-notification-card">
					<div class="workshop-notification-inner text-center">
						<div class="notification-icon-wrap">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
								<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
							</svg>
						</div>

						<h2 class="workshop-notification-heading" id="workshop-form-heading">
							<?php esc_html_e( 'Leave us your contact information to get workshop updates!', 'manamchocolate' ); ?>
						</h2>
						<p class="workshop-notification-subtitle">
							<?php
							printf(
								/* translators: %s: City location */
								esc_html__( 'Our small-batch masterclasses and chocolatiering workshops in %s fill up rapidly. Enter your details to receive early-access booking alerts on WhatsApp and email.', 'manamchocolate' ),
								esc_html( ucfirst( $location_slug ) )
							);
							?>
						</p>

						<form class="workshop-notification-form" id="workshop-notification-form" method="post" action="" novalidate>
							<?php wp_nonce_field( 'manam_workshop_notify_nonce', 'workshop_nonce' ); ?>
							<input type="hidden" name="action" value="manam_workshop_notify" />
							<input type="hidden" name="location" value="<?php echo esc_attr( ucfirst( $location_slug ) ); ?>" />

							<div class="form-fields-wrap">
								<!-- Email Address -->
								<div class="form-field-group">
									<label for="workshop-email" class="form-field-label"><?php esc_html_e( 'Email Address', 'manamchocolate' ); ?> <span class="required">*</span></label>
									<input
										type="email"
										id="workshop-email"
										name="email"
										class="form-field-input"
										placeholder="<?php esc_attr_e( 'Enter your email address', 'manamchocolate' ); ?>"
										required
										autocomplete="email"
									/>
								</div>

								<!-- WhatsApp Number with +91 -->
								<div class="form-field-group">
									<label for="workshop-whatsapp" class="form-field-label"><?php esc_html_e( 'WhatsApp Number', 'manamchocolate' ); ?> <span class="required">*</span></label>
									<div class="whatsapp-input-wrapper">
										<span class="whatsapp-prefix">+91</span>
										<input
											type="tel"
											id="workshop-whatsapp"
											name="whatsapp"
											class="form-field-input whatsapp-number-field"
											placeholder="<?php esc_attr_e( 'Enter 10-digit WhatsApp number', 'manamchocolate' ); ?>"
											pattern="[6-9][0-9]{9}"
											maxlength="10"
											inputmode="numeric"
											autocomplete="tel-national"
											required
										/>
									</div>
								</div>
							</div>

							<!-- Consent Checkbox -->
							<div class="form-consent-group">
								<label class="consent-checkbox-label">
									<input type="checkbox" name="consent" id="workshop-consent" value="1" required checked />
									<span><?php esc_html_e( 'I agree to receive workshop and masterclass updates from Manam Chocolate.', 'manamchocolate' ); ?></span>
								</label>
							</div>

							<!-- Submit Button -->
							<div class="form-submit-group">
								<button type="submit" id="workshop-submit-btn" class="button button--primary workshop-submit-btn">
									<span class="btn-text"><?php esc_html_e( 'NOTIFY ME', 'manamchocolate' ); ?></span>
									<span class="btn-spinner" aria-hidden="true"></span>
								</button>
							</div>

							<!-- Live Alert / Feedback Container -->
							<div id="workshop-form-feedback" class="form-feedback-message" role="alert" aria-live="polite"></div>
						</form>
					</div>
				</div>

			<?php endif; ?>

		</div>
	</section>

	<!-- 4. WHAT TO EXPECT AT MANAM WORKSHOPS -->
	<section class="workshop-experience-overview">
		<div class="site-container">
			<div class="section-header text-center">
				<span class="section-subtitle"><?php esc_html_e( 'THE CRAFT EXPERIENCE', 'manamchocolate' ); ?></span>
				<h2 class="section-title"><?php esc_html_e( 'WHAT TO EXPECT', 'manamchocolate' ); ?></h2>
			</div>

			<div class="workshop-features-grid">
				<div class="workshop-feature-card">
					<div class="feature-icon">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
					</div>
					<h3 class="feature-title"><?php esc_html_e( 'Guided Tastings', 'manamchocolate' ); ?></h3>
					<p class="feature-desc"><?php esc_html_e( 'Taste diverse craft chocolate profiles, exploring terroir, percentage nuances, and origin notes.', 'manamchocolate' ); ?></p>
				</div>
				<div class="workshop-feature-card">
					<div class="feature-icon">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
					</div>
					<h3 class="feature-title"><?php esc_html_e( 'Hands-on Making', 'manamchocolate' ); ?></h3>
					<p class="feature-desc"><?php esc_html_e( 'Bake, shape, layer, and hand-decorate your own chocolate tablets, truffles, and confections.', 'manamchocolate' ); ?></p>
				</div>
				<div class="workshop-feature-card">
					<div class="feature-icon">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
					</div>
					<h3 class="feature-title"><?php esc_html_e( 'Master Chocolatiers', 'manamchocolate' ); ?></h3>
					<p class="feature-desc"><?php esc_html_e( 'Learn directly from our seasoned chocolatiers in our dedicated, climate-controlled classroom.', 'manamchocolate' ); ?></p>
				</div>
				<div class="workshop-feature-card">
					<div class="feature-icon">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
					</div>
					<h3 class="feature-title"><?php esc_html_e( 'Take Creations Home', 'manamchocolate' ); ?></h3>
					<p class="feature-desc"><?php esc_html_e( 'Package your handcrafted treats in signature Manam presentation boxes to savour and share.', 'manamchocolate' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. PRIVATE WORKSHOPS TEASER -->
	<section class="private-workshop-teaser-section">
		<div class="site-container">
			<div class="teaser-card bg-dark-chocolate text-white">
				<div class="teaser-content text-center">
					<span class="teaser-badge"><?php esc_html_e( 'BESPOKE SESSIONS', 'manamchocolate' ); ?></span>
					<h2 class="teaser-title"><?php esc_html_e( 'Looking for a Private Chocolatiering Workshop?', 'manamchocolate' ); ?></h2>
					<p class="teaser-desc">
						<?php esc_html_e( 'Celebrate a birthday, organise a playdate, or host a corporate team-building session with our exclusive private chocolatiering workshops.', 'manamchocolate' ); ?>
					</p>
					<div class="teaser-actions">
						<a href="<?php echo esc_url( $home_url . 'product/private-chocolatiering-workshops/' ); ?>" class="button button--gold">
							<span><?php esc_html_e( 'View Private Workshop Details', 'manamchocolate' ); ?></span>
							<span class="button-arrow" aria-hidden="true">&rarr;</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

