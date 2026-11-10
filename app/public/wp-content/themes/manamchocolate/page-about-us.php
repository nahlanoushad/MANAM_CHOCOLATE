<?php
/**
 * Template Name: About Us Page
 * Description: Authentic 1:1 recreation of the Manam Chocolate About Us (Our Story) page.
 *
 * Implements the 12 reference sections:
 * 1. Hero Overlay: "Ushering in a new era of Indian Craft Chocolate."
 * 2. WE ARE MANAM (Right-aligned text over We_are_manam-_about.jpg + Frame_84.svg)
 * 3. Section Divider: "CHOCOLATE AS YOU KNOW IT" (Dark #282828)
 * 4. Big Chocolate (Left image Rectangle_122.jpg + right text)
 * 5. ‘Bean-to-Bar’ Chocolate (Left text with Rectangle_1.png pattern + right image Bean-to-Bar_Chocolate.jpg)
 * 6. Section Divider: "CHOCOLATE AS IT SHOULD BE" (Light #ffffff)
 * 7. Great chocolate comes from great cacao (4-image auto-play carousel 301.jpg-304.jpg + patterned text)
 * 8. Expressing true flavours of cacao into chocolate (5-image auto-play carousel 401.jpg-405.jpg + patterned text)
 * 9. Exploring endless possibilities of chocolate (4-image auto-play carousel 501.jpg-504.jpg + patterned text)
 * 10. Indian Craft Chocolate™ Edition 2023 (250+ PRODUCTS | 45 CATEGORIES + Indian_Craft_Chocolate_Edition_2023-_about_us.jpg)
 * 11. Meet the Craftspeople of Cacao (Ambient looping video about-craftspeople.mp4 + overlay text)
 * 12. MANAM CHOCOLATE KARKHANA (Ambient looping video about-karkhana.mp4 + overlay text + 7 pillars bar + address/map)
 *
 * @package ManamChocolate
 * @version 5.13.0
 */

get_header();

$upload_base = content_url( '/uploads/manam-about-media' );
$home_url    = home_url( '/' );
$contact_url = home_url( '/contact-us/' );
?>

<main id="primary" class="site-main about-page-main">

	<!-- 1. HERO OVERLAY: Ushering in a new era of Indian Craft Chocolate -->
	<section class="about-hero-section" id="about-hero">
		<div class="about-hero-media">
			<img
				src="<?php echo esc_url( $upload_base . '/8-fermentary-_2.png' ); ?>"
				alt="<?php esc_attr_e( 'Distinct Origins Cacao Fermentery', 'manamchocolate' ); ?>"
				class="about-hero-img"
				loading="eager"
			/>
			<div class="about-hero-scrim"></div>
		</div>
		<div class="about-hero-content-wrap">
			<div class="site-container">
				<h1 class="about-hero-title">
					<?php esc_html_e( 'Ushering in a new era of Indian Craft Chocolate.', 'manamchocolate' ); ?>
				</h1>
			</div>
		</div>
	</section>

	<!-- 2. WE ARE MANAM -->
	<section class="about-section about-we-are-section" id="about-we-are-manam">
		<div class="about-we-are-media">
			<img
				src="<?php echo esc_url( $upload_base . '/We_are_manam-_about.jpg' ); ?>"
				alt="<?php esc_attr_e( 'We Are Manam', 'manamchocolate' ); ?>"
				class="about-we-are-img desktop-only-img"
				loading="lazy"
			/>
		</div>
		<div class="site-container about-we-are-container">
			<div class="about-overlay-card about-we-are-card">
				<h2 class="about-card-title"><?php esc_html_e( 'WE ARE MANAM', 'manamchocolate' ); ?></h2>
				<div class="about-card-body">
					<p><?php esc_html_e( 'Manam, meaning ‘We’ or ‘Us’ in Telugu, is a heartfelt nod to our Indian roots, our shared past and our collective aspirations for the future.', 'manamchocolate' ); ?></p>
					<p><?php esc_html_e( 'We are farmers, fermenters, chocolate makers, chocolatiers and storytellers, exploring the endless possibilities of cacao in our pursuit of bringing about a new era of Indian Craft Chocolate™.', 'manamchocolate' ); ?></p>
				</div>
				<div class="about-card-brand-seal">
					<img
						src="<?php echo esc_url( $upload_base . '/Frame_84.svg' ); ?>"
						alt="<?php esc_attr_e( 'Manam Distinct Origins', 'manamchocolate' ); ?>"
						width="303"
						height="20"
						loading="lazy"
					/>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. SECTION DIVIDER: CHOCOLATE AS YOU KNOW IT (Dark) -->
	<section class="about-divider-band band-dark" id="about-divider-know-it">
		<div class="site-container">
			<h2 class="about-divider-heading"><?php esc_html_e( 'CHOCOLATE AS YOU KNOW IT', 'manamchocolate' ); ?></h2>
		</div>
	</section>

	<!-- 4. BIG CHOCOLATE (Image Left, Content Right) -->
	<section class="about-section about-split-feature split-image-left" id="about-big-chocolate">
		<div class="site-container">
			<div class="about-split-row">
				<div class="about-split-media-col">
					<img
						src="<?php echo esc_url( $upload_base . '/Rectangle_122.jpg' ); ?>"
						alt="<?php esc_attr_e( 'Big Chocolate Industry', 'manamchocolate' ); ?>"
						class="about-split-photo"
						loading="lazy"
					/>
				</div>
				<div class="about-split-text-col">
					<div class="about-editorial-box">
						<h3 class="about-feature-heading"><?php esc_html_e( 'Big Chocolate', 'manamchocolate' ); ?></h3>
						<div class="about-feature-text">
							<p><?php esc_html_e( 'The chocolate most of us have grown up on is made by big industrial brands who, sadly, sacrifice the soul of chocolate for the sake of standardisation. Chocolate comes from a sweet and pulpy fruit named cacao with rich and distinct inherent flavours. Big Chocolate carelessly farms and ferments cacao, leaving its flavours under-developed. These are then masked with additives to create a product that doesn’t taste like real chocolate should.', 'manamchocolate' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. ‘BEAN-TO-BAR’ CHOCOLATE (Content Left with Texture, Image Right) -->
	<section class="about-section about-split-feature split-image-right" id="about-bean-to-bar">
		<div class="site-container">
			<div class="about-split-row">
				<div class="about-split-text-col">
					<div class="about-editorial-box box-pattern-rectangle1">
						<h3 class="about-feature-heading"><?php esc_html_e( '‘Bean-to-Bar’ Chocolate', 'manamchocolate' ); ?></h3>
						<div class="about-feature-text">
							<p><?php esc_html_e( 'The craft chocolate movement in India is still at a nascent stage and is primarily driven by small-batch ‘bean-to-bar’ makers. Since these chocolate makers start with the bean and not the fruit, they are unable to develop the true flavour potential of cacao. Not only that, bean-to-bar makers end up limiting the possibilities of chocolate to a bar, when in fact, chocolate is an incredibly versatile ingredient and it can be so much more.', 'manamchocolate' ); ?></p>
						</div>
					</div>
				</div>
				<div class="about-split-media-col">
					<img
						src="<?php echo esc_url( $upload_base . '/Bean-to-Bar_Chocolate.jpg' ); ?>"
						alt="<?php esc_attr_e( 'Bean-to-Bar Craft Chocolate', 'manamchocolate' ); ?>"
						class="about-split-photo"
						loading="lazy"
					/>
				</div>
			</div>
		</div>
	</section>

	<!-- 6. SECTION DIVIDER: CHOCOLATE AS IT SHOULD BE (Light) -->
	<section class="about-divider-band band-light" id="about-divider-should-be">
		<div class="site-container">
			<h2 class="about-divider-heading"><?php esc_html_e( 'CHOCOLATE AS IT SHOULD BE', 'manamchocolate' ); ?></h2>
		</div>
	</section>

	<!-- 7. GREAT CHOCOLATE COMES FROM GREAT CACAO (Carousel Left 301-304 + Patterned Content Right) -->
	<section class="about-section about-carousel-section" id="about-great-cacao">
		<div class="site-container">
			<div class="about-split-row">
				<div class="about-carousel-col">
					<div class="about-carousel-wrapper" data-carousel-id="cacao-c1" data-autoplay="5000">
						<div class="about-carousel-track">
							<div class="about-carousel-slide active">
								<img src="<?php echo esc_url( $upload_base . '/301.jpg' ); ?>" alt="<?php esc_attr_e( 'Harvesting Fine Cacao Pods', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/302.jpg' ); ?>" alt="<?php esc_attr_e( 'Opening Cacao Fruit', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/303.jpg' ); ?>" alt="<?php esc_attr_e( 'Tiered Fermentation Boxes', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/304.jpg' ); ?>" alt="<?php esc_attr_e( 'Sun Drying Raised Beds', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
						</div>
						<div class="about-carousel-nav">
							<button type="button" class="about-carousel-arrow arrow-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'manamchocolate' ); ?>">
								<svg viewBox="0 0 100 100" width="16" height="16"><path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" fill="currentColor"></path></svg>
							</button>
							<button type="button" class="about-carousel-arrow arrow-next" aria-label="<?php esc_attr_e( 'Next Slide', 'manamchocolate' ); ?>">
								<svg viewBox="0 0 100 100" width="16" height="16"><path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" fill="currentColor" transform="translate(100, 100) rotate(180)"></path></svg>
							</button>
						</div>
					</div>
				</div>
				<div class="about-split-text-col">
					<div class="about-editorial-box box-pattern-rectangle1">
						<h3 class="about-feature-heading">
							<span><?php esc_html_e( 'Great chocolate comes', 'manamchocolate' ); ?></span><br />
							<span><?php esc_html_e( 'from great cacao', 'manamchocolate' ); ?></span>
						</h3>
						<div class="about-feature-text">
							<p><?php esc_html_e( 'Fermentation is the most crucial and yet the most overlooked process that unravels the cacao bean’s secret world of unique flavours. We work closely with our 100+ farmer-member community and our sister-concern Distinct Origins Cacao Fermentery in West Godavari, Andhra Pradesh. Together, we are revealing the unexplored flavours of the Indian Cacao through progressive farm practices and scientific fermentation and drying processes, elevating it to its rightful place on the world stage.', 'manamchocolate' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 8. EXPRESSING TRUE FLAVOURS OF CACAO INTO CHOCOLATE (Carousel Left 401-405 + Patterned Content Right) -->
	<section class="about-section about-carousel-section" id="about-expressing-flavours">
		<div class="site-container">
			<div class="about-split-row">
				<div class="about-carousel-col">
					<div class="about-carousel-wrapper" data-carousel-id="cacao-c2" data-autoplay="5000">
						<div class="about-carousel-track">
							<div class="about-carousel-slide active">
								<img src="<?php echo esc_url( $upload_base . '/401.jpg' ); ?>" alt="<?php esc_attr_e( 'Roasting Fine Cacao Nibs', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/402.jpg' ); ?>" alt="<?php esc_attr_e( 'Melange Stone Grinding', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/403.jpg' ); ?>" alt="<?php esc_attr_e( 'Precision Conching Cycle', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/404.jpg' ); ?>" alt="<?php esc_attr_e( 'Tempering Craft Chocolate', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/405.jpg' ); ?>" alt="<?php esc_attr_e( 'Nuanced Chocolate Expressions', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
						</div>
						<div class="about-carousel-nav">
							<button type="button" class="about-carousel-arrow arrow-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'manamchocolate' ); ?>">
								<svg viewBox="0 0 100 100" width="16" height="16"><path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" fill="currentColor"></path></svg>
							</button>
							<button type="button" class="about-carousel-arrow arrow-next" aria-label="<?php esc_attr_e( 'Next Slide', 'manamchocolate' ); ?>">
								<svg viewBox="0 0 100 100" width="16" height="16"><path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" fill="currentColor" transform="translate(100, 100) rotate(180)"></path></svg>
							</button>
						</div>
					</div>
				</div>
				<div class="about-split-text-col">
					<div class="about-editorial-box box-pattern-pattern2">
						<h3 class="about-feature-heading">
							<span><?php esc_html_e( 'Expressing true flavours of', 'manamchocolate' ); ?></span><br />
							<span><?php esc_html_e( 'cacao into chocolate', 'manamchocolate' ); ?></span>
						</h3>
						<div class="about-feature-text">
							<p><?php esc_html_e( 'Our pursuit of a new Indian Craft Chocolate™ is incomplete without doing justice to what the Indian Cacao offers. As chocolate makers, we celebrate the distinct inherent flavours of cacao every step of the way, from roasting to refining to conching. We are thoughtfully crafting a well-balanced and nuanced ‘chocolatey’ chocolate, that lets the bold flavours of cacao shine through.', 'manamchocolate' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 9. EXPLORING ENDLESS POSSIBILITIES OF CHOCOLATE (Carousel Left 501-504 + Patterned Content Right) -->
	<section class="about-section about-carousel-section" id="about-endless-possibilities">
		<div class="site-container">
			<div class="about-split-row">
				<div class="about-carousel-col">
					<div class="about-carousel-wrapper" data-carousel-id="cacao-c3" data-autoplay="5000">
						<div class="about-carousel-track">
							<div class="about-carousel-slide active">
								<img src="<?php echo esc_url( $upload_base . '/501.jpg' ); ?>" alt="<?php esc_attr_e( 'Chocolate Tablet Innovations', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/502.jpg' ); ?>" alt="<?php esc_attr_e( 'Handcrafted Bonbons and Palettes', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/503.jpg' ); ?>" alt="<?php esc_attr_e( 'Snacking Barks and Clusters', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
							<div class="about-carousel-slide">
								<img src="<?php echo esc_url( $upload_base . '/504.jpg' ); ?>" alt="<?php esc_attr_e( 'Artisanal Spreads and Beverages', 'manamchocolate' ); ?>" loading="lazy" />
							</div>
						</div>
						<div class="about-carousel-nav">
							<button type="button" class="about-carousel-arrow arrow-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'manamchocolate' ); ?>">
								<svg viewBox="0 0 100 100" width="16" height="16"><path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" fill="currentColor"></path></svg>
							</button>
							<button type="button" class="about-carousel-arrow arrow-next" aria-label="<?php esc_attr_e( 'Next Slide', 'manamchocolate' ); ?>">
								<svg viewBox="0 0 100 100" width="16" height="16"><path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" fill="currentColor" transform="translate(100, 100) rotate(180)"></path></svg>
							</button>
						</div>
					</div>
				</div>
				<div class="about-split-text-col">
					<div class="about-editorial-box box-pattern-pattern3">
						<h3 class="about-feature-heading">
							<span><?php esc_html_e( 'Exploring endless', 'manamchocolate' ); ?></span><br />
							<span><?php esc_html_e( 'possibilities of chocolate', 'manamchocolate' ); ?></span>
						</h3>
						<div class="about-feature-text">
							<p><?php esc_html_e( 'Chocolate is a truly magical and versatile ingredient, that has the potential to be much more than just a bar. At the Manam Chocolate Karkhana, our chocolatiers are interpreting chocolate in ways never done before, spanning 250+ concepts across 45 categories, and this is just the beginning. We are exploring the infinite possibilities of chocolate, in our pursuit to herald a new era for Indian Craft Chocolate™.', 'manamchocolate' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 10. INDIAN CRAFT CHOCOLATE™ EDITION 2023 -->
	<section class="about-section about-split-feature split-image-left" id="about-edition-2023">
		<div class="site-container">
			<div class="about-split-row">
				<div class="about-split-media-col">
					<img
						src="<?php echo esc_url( $upload_base . '/Indian_Craft_Chocolate_Edition_2023-_about_us.jpg' ); ?>"
						alt="<?php esc_attr_e( 'Indian Craft Chocolate Edition 2023', 'manamchocolate' ); ?>"
						class="about-split-photo"
						loading="lazy"
					/>
				</div>
				<div class="about-split-text-col">
					<div class="about-editorial-box">
						<h3 class="about-feature-heading">
							<span><?php esc_html_e( 'Indian Craft Chocolate™ Edition', 'manamchocolate' ); ?></span><br />
							<span><?php esc_html_e( '2023', 'manamchocolate' ); ?></span>
						</h3>
						<div class="about-edition-eyebrow">
							<?php esc_html_e( '250+ PRODUCTS | 45 CATEGORIES', 'manamchocolate' ); ?>
						</div>
						<div class="about-feature-text">
							<p><?php esc_html_e( 'Conceptualised as ‘annual editions’, Edition 2023 is our first attempt to create a truly Indian Craft Chocolate™ experience that lies at the flavourful intersection of familiar Indian tastes and novel global preferences. Masterfully crafted, our chocolate is not only complex and nuanced, but also designed to be delightful, just as great chocolate should be.', 'manamchocolate' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 11. MEET THE CRAFTSPEOPLE OF CACAO (Video Background + Overlay Text) -->
	<section class="about-video-section" id="about-craftspeople">
		<div class="about-video-media-wrap">
			<video
				class="about-video-bg"
				playsinline
				autoplay
				muted
				loop
				preload="metadata"
				poster="<?php echo esc_url( $upload_base . '/b304bea1c64e42e285683210670da106.thumbnail.0000000000_small.jpg' ); ?>"
			>
				<source src="<?php echo esc_url( $upload_base . '/about-craftspeople.mp4' ); ?>" type="video/mp4" />
			</video>
		</div>
		<div class="site-container about-video-container">
			<div class="about-overlay-card about-video-card">
				<h3 class="about-card-title"><?php esc_html_e( 'Meet the Craftspeople of Cacao', 'manamchocolate' ); ?></h3>
				<div class="about-card-body">
					<p><?php esc_html_e( 'It takes a village to raise a great Indian Cacao and to nurture it into a fine-flavoured bean. As farmers and fermenters, we bring our craft and skill together to give the Indian Cacao the respect it deserves. Each of us plays our part in our collective pursuit of a great Indian Craft Chocolate™.', 'manamchocolate' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 12. MANAM CHOCOLATE KARKHANA (Video Background + Overlay Text + 7 Pillars Footer) -->
	<section class="about-video-section" id="about-karkhana">
		<div class="about-video-media-wrap">
			<video
				class="about-video-bg"
				playsinline
				autoplay
				muted
				loop
				preload="metadata"
				poster="<?php echo esc_url( $upload_base . '/295ada7294754bfa9a6f03cb2d41fc24.thumbnail.0000000000_small.jpg' ); ?>"
			>
				<source src="<?php echo esc_url( $upload_base . '/about-karkhana.mp4' ); ?>" type="video/mp4" />
			</video>
		</div>
		<div class="site-container about-video-container">
			<div class="about-overlay-card about-video-card">
				<h3 class="about-card-title">
					<span><?php esc_html_e( 'MANAM CHOCOLATE', 'manamchocolate' ); ?></span><br />
					<span><?php esc_html_e( 'KARKHANA', 'manamchocolate' ); ?></span>
				</h3>
				<div class="about-card-body">
					<p><?php esc_html_e( 'Spread over 10,000 sq. ft., the Manam Chocolate Karkhana is a one-of-its-kind immersive experiential space. It brings together retail and the craft of chocolate making and chocolatiering under one roof, inviting you to explore a distinct new Indian Craft Chocolate experience™.', 'manamchocolate' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 12B. KARKHANA PILLARS, LOCATION & CONTACT BAR -->
	<section class="about-karkhana-info-bar" id="about-karkhana-info">
		<div class="site-container">
			<div class="karkhana-info-inner">
				<div class="karkhana-pillars-row">
					<?php esc_html_e( 'Manam Shop • Interactive Journey of Cacao • Live Chocolate-making • Chocolaterie • Chocolate Lab • Manam Classroom • Manam Café', 'manamchocolate' ); ?>
				</div>
				<div class="karkhana-address-row">
					<a href="https://maps.app.goo.gl/rKne5Hj2vZuyVi1MA" target="_blank" rel="noopener noreferrer" class="karkhana-map-link">
						<span><?php esc_html_e( 'ROAD No. 12, Banjara Hills, Hyderabad.', 'manamchocolate' ); ?></span>
						<span class="karkhana-arrow-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
								<path d="M12 1C12 0.447714 11.5523 -7.61451e-07 11 -3.39982e-07L2 -2.13542e-07C1.44772 -5.50717e-07 1 0.447715 1 0.999999C1 1.55228 1.44772 2 2 2L10 2L10 10C10 10.5523 10.4477 11 11 11C11.5523 11 12 10.5523 12 10L12 1ZM1.70711 11.7071L11.7071 1.70711L10.2929 0.292893L0.292893 10.2929L1.70711 11.7071Z" fill="#282828"></path>
							</svg>
						</span>
					</a>
					<div class="karkhana-hours">
						<?php esc_html_e( 'Open everyday. 10 AM - 12 AM.', 'manamchocolate' ); ?>
					</div>
				</div>
				<div class="karkhana-contact-row">
					<a href="<?php echo esc_url( $contact_url ); ?>" class="karkhana-contact-link">
						<span><?php esc_html_e( 'CONTACT US', 'manamchocolate' ); ?></span>
						<span class="karkhana-arrow-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
								<path d="M15.7877 8.59271C16.1725 8.1965 16.1632 7.56341 15.767 7.17865L9.31033 0.908733C8.91412 0.52398 8.28102 0.533268 7.89627 0.929479C7.51151 1.32569 7.5208 1.95879 7.91701 2.34354L13.6562 7.9168L8.08298 13.656C7.69823 14.0522 7.70751 14.6853 8.10373 15.0701C8.49994 15.4548 9.13303 15.4456 9.51779 15.0493L15.7877 8.59271ZM0.944357 9.10341L15.085 8.89595L15.0556 6.89616L0.915018 7.10362L0.944357 9.10341Z" fill="#282828"></path>
							</svg>
						</span>
					</a>
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();
