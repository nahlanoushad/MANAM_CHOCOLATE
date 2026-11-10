<?php
/**
 * Template Name: Karkhana Tours Page
 * Description: Informational destination page for Karkhana Tours in Banjara Hills, Hyderabad.
 *
 * Implements:
 * - Authentic status clarification (preserving unavailable state without fake booking slots)
 * - 10,000 sq. ft. factory experience highlights
 * - Verified booking contacts (+91 8977760769) and physical location
 * - Proportional imagery matching theme standards
 *
 * @package ManamChocolate
 * @since 1.3.0
 */

get_header();

$theme_uri       = get_template_directory_uri();
$home_url        = home_url( '/' );
$hero_img        = $theme_uri . '/assets/images/experience-workshop-hyderabad.jpg';
$hero_img_mobile = $theme_uri . '/assets/images/experience-workshop-hyderabad-mobile.jpg';
$exterior_img    = $theme_uri . '/assets/images/karkhana-exterior-flagship.jpg';
$roasting_img    = $theme_uri . '/assets/images/karkhana-roasting-room.jpg';
$lab_img         = $theme_uri . '/assets/images/karkhana-chocolaterie-lab.jpg';
$cafe_img        = $theme_uri . '/assets/images/experience-karkhana-cafe.jpg';
?>

<main id="primary" class="site-main karkhana-tours-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<a href="<?php echo esc_url( $home_url . 'experience' ); ?>"><?php esc_html_e( 'Experience', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'Karkhana Tours', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. HERO HEADER -->
	<header class="tours-header">
		<div class="site-container">
			<div class="tours-header-grid">
				<div class="tours-header-text" data-reveal="up">
					<span class="tours-eyebrow"><?php esc_html_e( 'IMMERSIVE FACTORY EXPERIENCE', 'manamchocolate' ); ?></span>
					<h1 class="tours-title"><?php esc_html_e( 'Manam Chocolate Karkhana Tours', 'manamchocolate' ); ?></h1>
					<p class="tours-subtitle">
						<?php esc_html_e( 'Step inside our 10,000 sq. ft. flagship factory in Banjara Hills, Hyderabad, to witness Indian craft chocolate making from bean to bar.', 'manamchocolate' ); ?>
					</p>
					<div class="tours-location-badge">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
						<span><?php esc_html_e( 'Road No. 12, Banjara Hills, Hyderabad', 'manamchocolate' ); ?></span>
					</div>
				</div>
				<div class="tours-header-media" data-reveal="fade">
					<picture>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $hero_img_mobile ); ?>" />
						<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php esc_attr_e( 'Manam Chocolate Karkhana Tours', 'manamchocolate' ); ?>" class="tours-hero-image" width="1200" height="800" loading="eager" />
					</picture>
				</div>
			</div>
		</div>
	</header>

	<!-- 3. TOUR STATUS ADVISORY (Truthful without fake slots) -->
	<section class="tour-status-section" data-reveal="up">
		<div class="site-container">
			<div class="tour-status-card">
				<div class="tour-status-badge"><?php esc_html_e( 'SCHEDULE UPDATE', 'manamchocolate' ); ?></div>
				<h2 class="tour-status-heading"><?php esc_html_e( 'Upcoming Tour Schedules', 'manamchocolate' ); ?></h2>
				<p class="tour-status-text">
					<?php esc_html_e( 'Public guided tour schedules for the Manam Chocolate Karkhana are currently being refreshed for upcoming calendar dates. To ensure genuine availability, booking slots will open as soon as verified timings are announced.', 'manamchocolate' ); ?>
				</p>
				<div class="tour-contact-box">
					<p class="contact-prompt">
						<strong><?php esc_html_e( 'Enquiries & Private Group Visits:', 'manamchocolate' ); ?></strong><br />
						<?php esc_html_e( 'For private group bookings, culinary study tours, or school groups, please reach out directly to our team:', 'manamchocolate' ); ?>
					</p>
					<div class="contact-links-row">
						<a href="tel:+918977760769" class="contact-pill">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
							<span>+91 8977760769</span>
						</a>
						<a href="mailto:hello@manamchocolate.com" class="contact-pill">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							<span>hello@manamchocolate.com</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 4. TOUR HIGHLIGHTS -->
	<section class="tour-highlights-section">
		<div class="site-container">
			<div class="section-header text-center">
				<span class="section-subtitle"><?php esc_html_e( 'INSIDE THE KARKHANA', 'manamchocolate' ); ?></span>
				<h2 class="section-title"><?php esc_html_e( 'WHAT YOU WILL EXPERIENCE', 'manamchocolate' ); ?></h2>
			</div>

			<div class="tour-highlights-grid">
				<div class="tour-highlight-card">
					<div class="highlight-media">
						<img src="<?php echo esc_url( $roasting_img ); ?>" alt="<?php esc_attr_e( 'Cacao Roasting & Melangers', 'manamchocolate' ); ?>" class="highlight-thumb" width="400" height="200" loading="lazy" />
					</div>
					<span class="highlight-step">01</span>
					<h3 class="highlight-title"><?php esc_html_e( 'Cacao Roasting & Winnowing', 'manamchocolate' ); ?></h3>
					<p class="highlight-desc"><?php esc_html_e( 'Witness fine flavour Indian cacao beans gently roasted and cracked to separate crisp husks from aromatic nibs.', 'manamchocolate' ); ?></p>
				</div>
				<div class="tour-highlight-card">
					<div class="highlight-media">
						<img src="<?php echo esc_url( $roasting_img ); ?>" alt="<?php esc_attr_e( 'Granite Melangers & Refining', 'manamchocolate' ); ?>" class="highlight-thumb" width="400" height="200" loading="lazy" />
					</div>
					<span class="highlight-step">02</span>
					<h3 class="highlight-title"><?php esc_html_e( 'Granite Melangers & Refining', 'manamchocolate' ); ?></h3>
					<p class="highlight-desc"><?php esc_html_e( 'See massive rotating granite stones grind cacao nibs and organic sugar into velvety chocolate liquor over 72 hours.', 'manamchocolate' ); ?></p>
				</div>
				<div class="tour-highlight-card">
					<div class="highlight-media">
						<img src="<?php echo esc_url( $lab_img ); ?>" alt="<?php esc_attr_e( 'Chocolatiering Laboratory', 'manamchocolate' ); ?>" class="highlight-thumb" width="400" height="200" loading="lazy" />
					</div>
					<span class="highlight-step">03</span>
					<h3 class="highlight-title"><?php esc_html_e( 'Chocolatiering Laboratory', 'manamchocolate' ); ?></h3>
					<p class="highlight-desc"><?php esc_html_e( 'Look through glass observation walls as chocolatiers temper, hand-paint bonbons, and sculpt delicate pastries.', 'manamchocolate' ); ?></p>
				</div>
				<div class="tour-highlight-card">
					<div class="highlight-media">
						<img src="<?php echo esc_url( $cafe_img ); ?>" alt="<?php esc_attr_e( 'Custom Tablet Station & Café', 'manamchocolate' ); ?>" class="highlight-thumb" width="400" height="200" loading="lazy" />
					</div>
					<span class="highlight-step">04</span>
					<h3 class="highlight-title"><?php esc_html_e( 'Custom Tablet Station & Café', 'manamchocolate' ); ?></h3>
					<p class="highlight-desc"><?php esc_html_e( 'Finish your visit by designing your own bespoke chocolate bar and sampling artisanal drinking chocolates in the café.', 'manamchocolate' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. KARKHANA EXTERIOR SHOWCASE -->
	<section class="tour-karkhana-destination bg-dark-chocolate text-white">
		<div class="site-container">
			<div class="destination-grid">
				<div class="destination-media">
					<img src="<?php echo esc_url( $exterior_img ); ?>" alt="<?php esc_attr_e( 'Manam Chocolate Karkhana Banjara Hills', 'manamchocolate' ); ?>" class="destination-img" width="2000" height="1000" loading="lazy" />
				</div>
				<div class="destination-content">
					<span class="destination-label"><?php esc_html_e( 'FLAGSHIP LOCATION', 'manamchocolate' ); ?></span>
					<h3 class="destination-title"><?php esc_html_e( 'Visit the Karkhana in Person', 'manamchocolate' ); ?></h3>
					<p class="destination-text">
						<?php esc_html_e( 'Our retail space and café are open daily for walk-in visits. Enjoy a full confectionery menu, single-origin tastings, and fresh chocolate treats crafted right on site.', 'manamchocolate' ); ?>
					</p>
					<div class="destination-details">
						<p><strong><?php esc_html_e( 'Hours:', 'manamchocolate' ); ?></strong> <?php esc_html_e( 'Monday to Sunday · 10:00 AM – 11:00 PM', 'manamchocolate' ); ?></p>
						<p><strong><?php esc_html_e( 'Location:', 'manamchocolate' ); ?></strong> <?php esc_html_e( '8/2/684/3/40 to 45 Road No. 12, Banjara Hills, Hyderabad - 500034', 'manamchocolate' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

