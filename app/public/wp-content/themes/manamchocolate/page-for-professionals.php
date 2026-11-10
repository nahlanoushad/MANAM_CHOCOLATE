<?php
/**
 * Template Name: For Professionals Page
 * Description: Exact recreation of the official Manam Chocolate For Professionals destination.
 *
 * Implements:
 * - Chef & artisanal professional introduction
 * - 11-field professional enquiry form matching live Shopify structure
 * - Secure AJAX submission with WordPress nonce protection
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

get_header();

$home_url  = home_url( '/' );
$theme_uri = get_template_directory_uri();
?>

<main id="primary" class="site-main professionals-page-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'For Professionals', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. HEADER -->
	<section class="professionals-hero-section">
		<div class="site-container">
			<header class="professionals-header text-center" data-reveal="up">
				<span class="professionals-eyebrow"><?php esc_html_e( 'ARTISANAL & CHEF PARTNERSHIPS', 'manamchocolate' ); ?></span>
				<h1 class="professionals-title"><?php esc_html_e( 'For Professionals', 'manamchocolate' ); ?></h1>
				<p class="professionals-desc">
					<?php esc_html_e( 'Discover chocolate and cacao products that deliver exceptional flavour and versatility across baking, pastry, confectionery, beverages, and desserts. Crafted from West Godavari cacao and designed for artisanal and professional chefs.', 'manamchocolate' ); ?>
				</p>
			</header>

			<!-- 3. ENQUIRY FORM CONTAINER -->
			<div class="professionals-card-box" data-reveal="up">
				<div class="card-inner-header text-center">
					<h2 class="card-title"><?php esc_html_e( 'Professional Inquiries & Wholesale Catalogue', 'manamchocolate' ); ?></h2>
					<p class="card-sub"><?php esc_html_e( 'Submit your culinary profile below to access wholesale specifications and pricing.', 'manamchocolate' ); ?></p>
				</div>

				<form id="manam-professionals-form" class="manam-professionals-form" method="post" action="" novalidate>
					<?php wp_nonce_field( 'manam_professionals_form_nonce', 'pro_nonce' ); ?>
					<input type="hidden" name="action" value="manam_submit_professionals_form" />

					<div class="form-grid-2col">
						<!-- Full Name -->
						<div class="form-field-group">
							<label for="pro-name" class="form-field-label"><?php esc_html_e( 'Full Name', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="text" id="pro-name" name="name" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your full name', 'manamchocolate' ); ?>" required autocomplete="name" />
						</div>

						<!-- Registered Company Name -->
						<div class="form-field-group">
							<label for="pro-company" class="form-field-label"><?php esc_html_e( 'Registered Company Name', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="text" id="pro-company" name="company" class="form-field-input" placeholder="<?php esc_attr_e( 'Legal business / entity name', 'manamchocolate' ); ?>" required />
						</div>

						<!-- Brand Name -->
						<div class="form-field-group">
							<label for="pro-brand" class="form-field-label"><?php esc_html_e( 'Brand Name', 'manamchocolate' ); ?></label>
							<input type="text" id="pro-brand" name="brand" class="form-field-input" placeholder="<?php esc_attr_e( 'Trading or brand name', 'manamchocolate' ); ?>" />
						</div>

						<!-- Phone -->
						<div class="form-field-group">
							<label for="pro-phone" class="form-field-label"><?php esc_html_e( 'Phone', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="tel" id="pro-phone" name="phone" class="form-field-input" placeholder="<?php esc_attr_e( 'Contact telephone or mobile', 'manamchocolate' ); ?>" required autocomplete="tel" />
						</div>

						<!-- Email -->
						<div class="form-field-group">
							<label for="pro-email" class="form-field-label"><?php esc_html_e( 'E-mail', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="email" id="pro-email" name="email" class="form-field-input" placeholder="<?php esc_attr_e( 'Business email address', 'manamchocolate' ); ?>" required autocomplete="email" />
						</div>

						<!-- Type of Business -->
						<div class="form-field-group">
							<label for="pro-business-type" class="form-field-label"><?php esc_html_e( 'Type of Business', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<select id="pro-business-type" name="business_type" class="form-field-select" required>
								<option value="" disabled selected><?php esc_html_e( 'Select business category', 'manamchocolate' ); ?></option>
								<option value="Hotel / Resort"><?php esc_html_e( 'Hotel / Resort', 'manamchocolate' ); ?></option>
								<option value="Restaurant"><?php esc_html_e( 'Restaurant', 'manamchocolate' ); ?></option>
								<option value="Café / Coffee Shop"><?php esc_html_e( 'Café / Coffee Shop', 'manamchocolate' ); ?></option>
								<option value="Bakery / Patisserie"><?php esc_html_e( 'Bakery / Patisserie', 'manamchocolate' ); ?></option>
								<option value="Cloud Kitchen"><?php esc_html_e( 'Cloud Kitchen', 'manamchocolate' ); ?></option>
								<option value="Caterer / Events"><?php esc_html_e( 'Caterer / Events', 'manamchocolate' ); ?></option>
								<option value="Other"><?php esc_html_e( 'Other', 'manamchocolate' ); ?></option>
							</select>
						</div>

						<!-- Product Interest -->
						<div class="form-field-group">
							<label for="pro-product-interest" class="form-field-label"><?php esc_html_e( 'Product Interest', 'manamchocolate' ); ?></label>
							<input type="text" id="pro-product-interest" name="product_interest" class="form-field-input" placeholder="<?php esc_attr_e( 'e.g. Cacao Powder, 80% Baking Tablet, Nibs', 'manamchocolate' ); ?>" />
						</div>

						<!-- Expected Monthly Volume -->
						<div class="form-field-group">
							<label for="pro-volume" class="form-field-label"><?php esc_html_e( 'Expected Monthly Volume', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<select id="pro-volume" name="volume" class="form-field-select" required>
								<option value="" disabled selected><?php esc_html_e( 'Select volume estimate', 'manamchocolate' ); ?></option>
								<option value="Under 10 kg"><?php esc_html_e( 'Under 10 kg', 'manamchocolate' ); ?></option>
								<option value="10 – 25 kg">10 – 25 kg</option>
								<option value="25 – 50 kg">25 – 50 kg</option>
								<option value="50 – 100 kg">50 – 100 kg</option>
								<option value="100+ kg">100+ kg</option>
								<option value="One-time / Trial Order"><?php esc_html_e( 'One-time / Trial Order', 'manamchocolate' ); ?></option>
							</select>
						</div>

						<!-- City -->
						<div class="form-field-group">
							<label for="pro-city" class="form-field-label"><?php esc_html_e( 'City', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<select id="pro-city" name="city" class="form-field-select" required>
								<option value="" disabled selected><?php esc_html_e( 'Select your city', 'manamchocolate' ); ?></option>
								<option value="Hyderabad">Hyderabad</option>
								<option value="Delhi NCR">Delhi NCR</option>
								<option value="Mumbai">Mumbai</option>
								<option value="Bengaluru">Bengaluru</option>
								<option value="Other"><?php esc_html_e( 'Other (please specify below)', 'manamchocolate' ); ?></option>
							</select>
						</div>

						<!-- Pincode -->
						<div class="form-field-group">
							<label for="pro-pincode" class="form-field-label"><?php esc_html_e( 'Pincode', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input type="text" id="pro-pincode" name="pincode" class="form-field-input" placeholder="<?php esc_attr_e( '6-digit postal code', 'manamchocolate' ); ?>" required maxlength="6" />
						</div>
					</div>

					<!-- Tell Us About Your Requirement -->
					<div class="form-field-group full-width">
						<label for="pro-requirement" class="form-field-label"><?php esc_html_e( 'Tell Us About Your Requirement', 'manamchocolate' ); ?></label>
						<textarea id="pro-requirement" name="requirement" class="form-field-textarea" rows="3" placeholder="<?php esc_attr_e( 'Outline your culinary project, menu applications, or delivery schedule requirements...', 'manamchocolate' ); ?>"></textarea>
					</div>

					<div class="form-submit-wrap text-center">
						<button type="submit" id="pro-submit-btn" class="button button--primary professionals-submit-btn">
							<span class="btn-text"><?php esc_html_e( 'DOWNLOAD CATALOGUE', 'manamchocolate' ); ?></span>
							<span class="btn-spinner" aria-hidden="true"></span>
						</button>
					</div>

					<div id="professionals-form-feedback" class="form-feedback-message" role="alert" aria-live="polite"></div>
				</form>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

