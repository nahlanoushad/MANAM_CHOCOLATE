<?php
/**
 * Template Name: Corporate Gifting Page
 * Description: Exact recreation of the official Manam Chocolate Corporate + Bulk Ordering destination.
 *
 * Implements:
 * - Brand hero header with verified official campaign photography
 * - Complete 12-field corporate enquiry & bulk order form
 * - Full field grouping, dropdown selections matching Shopify reference
 * - Nonce protection, secure AJAX submission, and catalogue download triggering
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

get_header();

$theme_uri = get_template_directory_uri();
$home_url  = home_url( '/' );

$hero_desktop = $theme_uri . '/assets/images/corporate-gifting-hero-desktop.jpg';
$hero_mobile  = $theme_uri . '/assets/images/corporate-gifting-hero-mobile.jpg';
?>

<main id="primary" class="site-main corporate-gifting-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'Corporate + Bulk Ordering', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. HERO BANNER -->
	<header class="corporate-hero-section">
		<div class="site-container">
			<div class="corporate-banner-wrap" data-reveal="fade">
				<picture>
					<source media="(max-width: 767px)" srcset="<?php echo esc_url( $hero_mobile ); ?>" />
					<img
						src="<?php echo esc_url( $hero_desktop ); ?>"
						alt="<?php esc_attr_e( 'Manam Chocolate Corporate + Bulk Ordering', 'manamchocolate' ); ?>"
						class="corporate-banner-img"
						width="3000"
						height="1500"
						loading="eager"
					/>
				</picture>
			</div>

			<div class="corporate-header-text text-center" data-reveal="up">
				<span class="corporate-eyebrow"><?php esc_html_e( 'BESPOKE & BULK HAMPERS', 'manamchocolate' ); ?></span>
				<h1 class="corporate-title"><?php esc_html_e( 'Corporate + Bulk Ordering', 'manamchocolate' ); ?></h1>
				<p class="corporate-desc">
					<?php esc_html_e( 'A thoughtful way to celebrate teams, clients, and partners, our curated gift boxes offer up a world of Indian craft chocolate to discover. From ready-to-order hampers and keepsake tins to bespoke gift selections, let us help you find experiences they\'ll genuinely enjoy.', 'manamchocolate' ); ?>
				</p>
				<p class="corporate-prompt">
					<?php esc_html_e( 'Would you like assistance in finding the perfect gift? Complete the form below, and we\'ll get back to you with personalized recommendations.', 'manamchocolate' ); ?>
				</p>
			</div>
		</div>
	</header>

	<!-- 3. ENQUIRY FORM SECTION -->
	<section class="corporate-form-section">
		<div class="site-container corporate-form-container">
			<div class="corporate-card-box" data-reveal="up">
				<div class="corporate-card-header text-center">
					<h2 class="card-heading"><?php esc_html_e( 'Request Custom Recommendations & Catalogue', 'manamchocolate' ); ?></h2>
					<p class="card-subtitle"><?php esc_html_e( 'Please provide your details below and our corporate concierge will reach out within 24 hours.', 'manamchocolate' ); ?></p>
				</div>

				<form id="manam-corporate-form" class="manam-corporate-form" method="post" action="" novalidate>
					<?php wp_nonce_field( 'manam_corporate_form_nonce', 'corp_nonce' ); ?>
					<input type="hidden" name="action" value="manam_submit_corporate_form" />

					<div class="form-grid-2col">
						<!-- Full Name -->
						<div class="form-field-group">
							<label for="corp-name" class="form-field-label"><?php esc_html_e( 'Full Name', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="text" id="corp-name" name="name" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your full name', 'manamchocolate' ); ?>" required autocomplete="name" />
						</div>

						<!-- Phone -->
						<div class="form-field-group">
							<label for="corp-phone" class="form-field-label"><?php esc_html_e( 'Phone', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="tel" id="corp-phone" name="phone" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your contact number', 'manamchocolate' ); ?>" required autocomplete="tel" />
						</div>

						<!-- Email -->
						<div class="form-field-group">
							<label for="corp-email" class="form-field-label"><?php esc_html_e( 'E-mail', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="email" id="corp-email" name="email" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your corporate email', 'manamchocolate' ); ?>" required autocomplete="email" />
						</div>

						<!-- Type of Gifting -->
						<div class="form-field-group">
							<label for="corp-gifting-type" class="form-field-label"><?php esc_html_e( 'Type of Gifting', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<select id="corp-gifting-type" name="gifting_type" class="form-field-select" required>
								<option value="" disabled selected><?php esc_html_e( 'Select type of gifting', 'manamchocolate' ); ?></option>
								<option value="Corporate"><?php esc_html_e( 'Corporate', 'manamchocolate' ); ?></option>
								<option value="Bulk"><?php esc_html_e( 'Bulk', 'manamchocolate' ); ?></option>
								<option value="Weddings"><?php esc_html_e( 'Weddings', 'manamchocolate' ); ?></option>
								<option value="Ceremony"><?php esc_html_e( 'Ceremony', 'manamchocolate' ); ?></option>
							</select>
						</div>

						<!-- Company Name -->
						<div class="form-field-group">
							<label for="corp-company" class="form-field-label"><?php esc_html_e( 'Company Name', 'manamchocolate' ); ?></label>
							<input type="text" id="corp-company" name="company" class="form-field-input" placeholder="<?php esc_attr_e( 'Organization or Company name', 'manamchocolate' ); ?>" />
						</div>

						<!-- Company Type -->
						<div class="form-field-group">
							<label for="corp-company-type" class="form-field-label"><?php esc_html_e( 'Company Type', 'manamchocolate' ); ?></label>
							<input type="text" id="corp-company-type" name="company_type" class="form-field-input" placeholder="<?php esc_attr_e( 'e.g. Technology, Finance, Hospitality', 'manamchocolate' ); ?>" />
						</div>

						<!-- Designation -->
						<div class="form-field-group">
							<label for="corp-designation" class="form-field-label"><?php esc_html_e( 'Designation', 'manamchocolate' ); ?></label>
							<input type="text" id="corp-designation" name="designation" class="form-field-input" placeholder="<?php esc_attr_e( 'Your role or title', 'manamchocolate' ); ?>" />
						</div>

						<!-- Number Of Gifts -->
						<div class="form-field-group">
							<label for="corp-num-gifts" class="form-field-label"><?php esc_html_e( 'Number of Gifts', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<select id="corp-num-gifts" name="num_gifts" class="form-field-select" required>
								<option value="" disabled selected><?php esc_html_e( 'Select quantity range', 'manamchocolate' ); ?></option>
								<option value="10-20">10 – 20</option>
								<option value="20-30">20 – 30</option>
								<option value="30-50">30 – 50</option>
								<option value="above 50"><?php esc_html_e( 'Above 50', 'manamchocolate' ); ?></option>
							</select>
						</div>

						<!-- Preferred Category -->
						<div class="form-field-group">
							<label for="corp-category" class="form-field-label"><?php esc_html_e( 'Preferred Category', 'manamchocolate' ); ?></label>
							<select id="corp-category" name="preferred_category" class="form-field-select">
								<option value="All products available"><?php esc_html_e( 'All products available', 'manamchocolate' ); ?></option>
								<option value="Gifting"><?php esc_html_e( 'Gifting Collection', 'manamchocolate' ); ?></option>
								<option value="Award Winning"><?php esc_html_e( 'Award Winning', 'manamchocolate' ); ?></option>
								<option value="Tablet Collection"><?php esc_html_e( 'Craft Chocolate Tablets', 'manamchocolate' ); ?></option>
								<option value="Indulgence Collection"><?php esc_html_e( 'Bonbons, Palettes & Assorted Boxes', 'manamchocolate' ); ?></option>
								<option value="The Snacking Collection"><?php esc_html_e( 'Snacking Collection', 'manamchocolate' ); ?></option>
								<option value="Baking"><?php esc_html_e( 'Baking Collection', 'manamchocolate' ); ?></option>
								<option value="The Tablet Library"><?php esc_html_e( 'The Tablet Library', 'manamchocolate' ); ?></option>
							</select>
						</div>

						<!-- Budget Per Person -->
						<div class="form-field-group">
							<label for="corp-budget" class="form-field-label"><?php esc_html_e( 'Budget Per Person (INR)', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<select id="corp-budget" name="budget" class="form-field-select" required>
								<option value="" disabled selected><?php esc_html_e( 'Select budget per person', 'manamchocolate' ); ?></option>
								<option value=">300">&gt; ₹300</option>
								<option value=">500">&gt; ₹500</option>
								<option value=">700">&gt; ₹700</option>
								<option value=">1000">&gt; ₹1,000</option>
							</select>
						</div>
					</div>

					<!-- Delivery Address -->
					<div class="form-field-group full-width">
						<label for="corp-address" class="form-field-label"><?php esc_html_e( 'Delivery Address / Cities', 'manamchocolate' ); ?></label>
						<textarea id="corp-address" name="delivery_address" class="form-field-textarea" rows="2" placeholder="<?php esc_attr_e( 'City, state, or specific office locations for delivery', 'manamchocolate' ); ?>"></textarea>
					</div>

					<!-- Additional Details -->
					<div class="form-field-group full-width">
						<label for="corp-details" class="form-field-label"><?php esc_html_e( 'Additional Details or Customization Requests', 'manamchocolate' ); ?></label>
						<textarea id="corp-details" name="additional_details" class="form-field-textarea" rows="3" placeholder="<?php esc_attr_e( 'Tell us about branding sleeve requirements, custom gift notes, or occasion dates...', 'manamchocolate' ); ?>"></textarea>
					</div>

					<div class="form-submit-wrap text-center">
						<button type="submit" id="corp-submit-btn" class="button button--primary corporate-submit-btn">
							<span class="btn-text"><?php esc_html_e( 'DOWNLOAD CATALOGUE', 'manamchocolate' ); ?></span>
							<span class="btn-spinner" aria-hidden="true"></span>
						</button>
					</div>

					<div id="corporate-form-feedback" class="form-feedback-message" role="alert" aria-live="polite"></div>
				</form>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

