<?php
/**
 * Template Name: Experience Hub Page
 * Description: Experiential hub showcasing Manam Chocolate workshops and factory tours.
 *
 * Implements:
 * - Breadcrumb navigation
 * - Experiential showcase cards with verified original photography
 * - Direct routing to Delhi Workshops, Hyderabad Workshops, Private Workshops, and Karkhana Tours
 * - Responsive grid and flagship destination banner
 *
 * @package ManamChocolate
 * @since 1.4.0
 */

get_header();

$theme_uri     = get_template_directory_uri();
$home_url      = home_url( '/' );

$experiences = array(
	array(
		'title'       => __( 'Workshops in Delhi', 'manamchocolate' ),
		'badge'       => __( 'Saket, New Delhi', 'manamchocolate' ),
		'venue'       => __( 'Eldeco Center, Saket, New Delhi', 'manamchocolate' ),
		'desc'        => __( 'Interactive craft chocolate workshops, guided tastings, and bespoke chocolatiering masterclasses in our dedicated studio at Eldeco Center.', 'manamchocolate' ),
		'image'       => $theme_uri . '/assets/images/experience-workshop-delhi.jpg',
		'link'        => $home_url . 'collections/workshops-in-delhi/',
		'cta'         => __( 'Explore Delhi Workshops', 'manamchocolate' ),
	),
	array(
		'title'       => __( 'Workshops in Hyderabad', 'manamchocolate' ),
		'badge'       => __( 'Banjara Hills, Hyderabad', 'manamchocolate' ),
		'venue'       => __( 'Manam Chocolate Karkhana, Banjara Hills', 'manamchocolate' ),
		'desc'        => __( 'Live factory masterclasses, bean-to-bar chocolate making, and chocolatiering immersions right on the Karkhana factory floor.', 'manamchocolate' ),
		'image'       => $theme_uri . '/assets/images/experience-workshop-hyderabad.jpg',
		'link'        => $home_url . 'collections/workshops-in-hyderabad/',
		'cta'         => __( 'Explore Hyderabad Workshops', 'manamchocolate' ),
	),
	array(
		'title'       => __( 'Private Chocolatiering Workshops', 'manamchocolate' ),
		'badge'       => __( 'Bespoke Sessions', 'manamchocolate' ),
		'venue'       => __( 'Private Groups & Celebrations', 'manamchocolate' ),
		'desc'        => __( 'Celebrate a birthday, organise a playdate, or host a corporate masterclass creating custom chocolate barks, truffles, and confections.', 'manamchocolate' ),
		'image'       => $theme_uri . '/assets/images/experience-private-workshop.png',
		'link'        => $home_url . 'product/private-chocolatiering-workshops/',
		'cta'         => __( 'View Private Workshops', 'manamchocolate' ),
	),
	array(
		'title'       => __( 'Manam Chocolate Karkhana Tours', 'manamchocolate' ),
		'badge'       => __( 'Flagship Factory', 'manamchocolate' ),
		'venue'       => __( 'Road No. 12, Banjara Hills, Hyderabad', 'manamchocolate' ),
		'desc'        => __( 'Step inside our 10,000 sq. ft. flagship factory to witness Indian craft chocolate making—from bean roasting and melangers to observation labs.', 'manamchocolate' ),
		'image'       => $theme_uri . '/assets/images/karkhana-exterior-flagship.jpg',
		'link'        => $home_url . 'experience/karkhana-tours/',
		'cta'         => __( 'Discover Karkhana Tours', 'manamchocolate' ),
	),
);
?>

<main id="primary" class="site-main experience-page-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'Experience', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. HUB HEADER -->
	<header class="experience-hub-header">
		<div class="site-container">
			<span class="experience-eyebrow" data-reveal="up"><?php esc_html_e( 'CRAFT CHOCOLATE EXPERIENCES', 'manamchocolate' ); ?></span>
			<h1 class="experience-title" data-reveal="up"><?php esc_html_e( 'Immersive Experiences & Masterclasses', 'manamchocolate' ); ?></h1>
			<p class="experience-subtitle" data-reveal="up">
				<?php esc_html_e( 'Step into our world of Indian craft chocolate. From hands-on chocolatiering workshops in Delhi and Hyderabad to guided visits through our 10,000 sq. ft. flagship Karkhana.', 'manamchocolate' ); ?>
			</p>
		</div>
	</header>

	<!-- 3. EXPERIENCE SHOWCASE CARDS GRID -->
	<section class="experience-cards-section" aria-label="<?php esc_attr_e( 'Experience Categories', 'manamchocolate' ); ?>">
		<div class="site-container">
			<div class="experience-cards-grid">
				<?php foreach ( $experiences as $exp ) : ?>
					<a href="<?php echo esc_url( $exp['link'] ); ?>" class="experience-card" data-reveal="up">
						<div class="experience-card-media">
							<img
								src="<?php echo esc_url( $exp['image'] ); ?>"
								alt="<?php echo esc_attr( $exp['title'] ); ?>"
								class="experience-card-img"
								width="800"
								height="500"
								loading="lazy"
							/>
							<span class="experience-card-badge"><?php echo esc_html( $exp['badge'] ); ?></span>
						</div>
						<div class="experience-card-body">
							<div class="experience-card-venue">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
								<span><?php echo esc_html( $exp['venue'] ); ?></span>
							</div>
							<h2 class="experience-card-title"><?php echo esc_html( $exp['title'] ); ?></h2>
							<p class="experience-card-desc"><?php echo esc_html( $exp['desc'] ); ?></p>
							<span class="experience-card-cta">
								<span><?php echo esc_html( $exp['cta'] ); ?></span>
								<span class="cta-arrow" aria-hidden="true">&rarr;</span>
							</span>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 4. VISIT THE KARKHANA DESTINATION BANNER -->
	<section class="tour-karkhana-destination bg-dark-chocolate text-white">
		<div class="site-container">
			<div class="destination-grid">
				<div class="destination-media">
					<img
						src="<?php echo esc_url( $theme_uri . '/assets/images/experience-karkhana-cafe.jpg' ); ?>"
						alt="<?php esc_attr_e( 'Manam Chocolate Karkhana Banjara Hills Café & Tasting Salon', 'manamchocolate' ); ?>"
						class="destination-img"
						width="2000"
						height="1000"
						loading="lazy"
					/>
				</div>
				<div class="destination-content">
					<span class="destination-label"><?php esc_html_e( 'FLAGSHIP DESTINATION', 'manamchocolate' ); ?></span>
					<h3 class="destination-title"><?php esc_html_e( 'Visit the Karkhana in Person', 'manamchocolate' ); ?></h3>
					<p class="destination-text">
						<?php esc_html_e( 'Our retail space and café are open daily for walk-in visits. Enjoy a full confectionery menu, single-origin tastings, and fresh chocolate treats crafted right on site.', 'manamchocolate' ); ?>
					</p>
					<div class="destination-details">
						<p><strong><?php esc_html_e( 'Hours:', 'manamchocolate' ); ?></strong> <?php esc_html_e( 'Monday to Sunday · 10:00 AM – 11:00 PM', 'manamchocolate' ); ?></p>
						<p><strong><?php esc_html_e( 'Location:', 'manamchocolate' ); ?></strong> <?php esc_html_e( '8/2/684/3/40 to 45 Road No. 12, Banjara Hills, Hyderabad - 500034', 'manamchocolate' ); ?></p>
						<p><strong><?php esc_html_e( 'Phone:', 'manamchocolate' ); ?></strong> <a href="tel:+918977760769" style="color: #d4af37; text-decoration: none;">+91 8977760769</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

