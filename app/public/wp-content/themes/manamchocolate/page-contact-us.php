<?php
/**
 * Template Name: Contact Us Page
 * Description: Recreates the official Manam Chocolate Contact Us page.
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

get_header();

$home_url = home_url( '/' );
?>

<main id="primary" class="site-main contact-page-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'Contact Us', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. CONTACT HEADER & MAIN GRID -->
	<section class="contact-section">
		<div class="site-container">
			<header class="contact-header text-center" data-reveal="up">
				<h1 class="contact-title"><?php esc_html_e( 'Contact Us', 'manamchocolate' ); ?></h1>
			</header>

			<div class="contact-grid">
				<!-- Left Column: Contact Details & Store Directory -->
				<div class="contact-info-col" data-reveal="up">
					<div class="contact-card primary-contact-card">
						<h2 class="contact-card-title"><?php esc_html_e( 'Customer Care', 'manamchocolate' ); ?></h2>
						<p class="contact-hours-note"><?php esc_html_e( 'Monday to Saturday · 10:00 AM to 7:00 PM IST', 'manamchocolate' ); ?></p>
						<div class="contact-direct-links">
							<a href="tel:+917331100776" class="contact-link-row">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
								<span>+91 73311 00776</span>
							</a>
							<a href="mailto:care@manamchocolate.com" class="contact-link-row">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
								<span>care@manamchocolate.com</span>
							</a>
						</div>
					</div>

					<div class="contact-card registered-office-card">
						<h2 class="contact-card-title"><?php esc_html_e( 'Registered Address', 'manamchocolate' ); ?></h2>
						<p class="contact-address-text">
							2nd Floor, Plot No. 490, 491, 492, Block No. 31, Almond House, VI Phase, KPHB Colony, Kukatpally, Hyderabad, Medchal-Malkajgiri, Telangana - 500072
						</p>
					</div>

					<div class="contact-card locations-card">
						<h2 class="contact-card-title"><?php esc_html_e( 'Our Locations', 'manamchocolate' ); ?></h2>
						<ul class="contact-locations-list">
							<li>
								<strong><?php esc_html_e( 'Manam Chocolate, Delhi', 'manamchocolate' ); ?></strong><br />
								<span>Eldeco Center, Saket, New Delhi</span><br />
								<a href="tel:+918977760769" class="loc-phone">+91 89777 60769</a>
							</li>
							<li>
								<strong><?php esc_html_e( 'Manam Chocolate Karkhana', 'manamchocolate' ); ?></strong><br />
								<span>Road No. 12, Banjara Hills, Hyderabad</span><br />
								<a href="tel:+918121031763" class="loc-phone">+91 81210 31763</a>
							</li>
							<li>
								<strong><?php esc_html_e( 'Manam Chocolate Beverage Bar, Hyderabad', 'manamchocolate' ); ?></strong><br />
								<span>Gate 6, Ground Floor, Elixir Tower, Sattva Knowledge City, Hyderabad</span><br />
								<a href="tel:+918977760767" class="loc-phone">+91 89777 60767</a>
							</li>
							<li>
								<strong><?php esc_html_e( 'Manam Chocolate Beverage Bar, Delhi', 'manamchocolate' ); ?></strong><br />
								<span>GFK 17, Ground Floor, DLF Promenade Mall, Vasant Kunj, New Delhi (Next to Zara)</span><br />
								<a href="tel:+918121542288" class="loc-phone">+91 81215 42288</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- Right Column: Interactive Contact Form -->
				<div class="contact-form-col" data-reveal="up">
					<div class="contact-form-wrapper">
						<h2 class="form-box-title"><?php esc_html_e( 'Send Us a Message', 'manamchocolate' ); ?></h2>
						<p class="form-box-desc"><?php esc_html_e( 'Have a question about our craft chocolate, workshop bookings, or custom orders? Reach out below and our team will get back to you.', 'manamchocolate' ); ?></p>

						<form id="manam-contact-form" class="manam-contact-form" method="post" action="" novalidate>
							<?php wp_nonce_field( 'manam_contact_form_nonce', 'contact_nonce' ); ?>
							<input type="hidden" name="action" value="manam_submit_contact_form" />

							<div class="form-field-group">
								<label for="contact-name" class="form-field-label"><?php esc_html_e( 'Full Name', 'manamchocolate' ); ?> <span class="required">*</span></label>
								<input type="text" id="contact-name" name="name" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your full name', 'manamchocolate' ); ?>" required autocomplete="name" />
							</div>

							<div class="form-field-group">
								<label for="contact-email" class="form-field-label"><?php esc_html_e( 'E-mail', 'manamchocolate' ); ?> <span class="required">*</span></label>
								<input type="email" id="contact-email" name="email" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your email address', 'manamchocolate' ); ?>" required autocomplete="email" />
							</div>

							<div class="form-field-group">
								<label for="contact-phone" class="form-field-label"><?php esc_html_e( 'Phone', 'manamchocolate' ); ?> <span class="required">*</span></label>
								<input type="tel" id="contact-phone" name="phone" class="form-field-input" placeholder="<?php esc_attr_e( 'Enter your phone number', 'manamchocolate' ); ?>" required autocomplete="tel" />
							</div>

							<div class="form-field-group">
								<label for="contact-message" class="form-field-label"><?php esc_html_e( 'Message', 'manamchocolate' ); ?> <span class="required">*</span></label>
								<textarea id="contact-message" name="message" class="form-field-textarea" rows="5" placeholder="<?php esc_attr_e( 'Write your message here...', 'manamchocolate' ); ?>" required></textarea>
							</div>

							<div class="form-submit-wrap">
								<button type="submit" id="contact-submit-btn" class="button button--primary contact-submit-btn">
									<span class="btn-text"><?php esc_html_e( 'SUBMIT', 'manamchocolate' ); ?></span>
									<span class="btn-spinner" aria-hidden="true"></span>
								</button>
							</div>

							<div id="contact-form-feedback" class="form-feedback-message" role="alert" aria-live="polite"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

