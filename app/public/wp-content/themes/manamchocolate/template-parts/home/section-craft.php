<?php
/**
 * Template part for displaying the "Our Craft" homepage section
 *
 * Implements:
 * "BEFORE THE BEAN. BEYOND THE BAR."
 * 4 Craft Stages:
 * - Stage 01: Nurturing the Cacao (Farming)
 * - Stage 02: Revealing Hidden Flavours (Fermentation)
 * - Stage 03: Expressing Cacao's Flavours (Chocolate Making)
 * - Stage 04: Exploring Endless Possibilities (Chocolatiering)
 *
 * @package ManamChocolate
 * @since 1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
$theme_dir = get_template_directory();

$craft_stages = array(
	1 => array(
		'stage' => '01',
		'tab'   => __( 'Farming', 'manamchocolate' ),
		'focus' => __( 'Cacao Cultivation & Farming', 'manamchocolate' ),
		'title' => __( 'Nurturing the Cacao', 'manamchocolate' ),
		'desc'  => __( 'Our 100+ farmer-member community with progressive farm practices nurture the Indian Origin Cacao in West Godavari, Andhra Pradesh.', 'manamchocolate' ),
		'file'  => 'craft-farming.jpg',
		'video' => 'craft-farming.mp4',
		'alt'   => __( 'Cacao farming and harvesting in West Godavari, India - Nurturing the Cacao', 'manamchocolate' ),
	),
	2 => array(
		'stage' => '02',
		'tab'   => __( 'Fermentation', 'manamchocolate' ),
		'focus' => __( 'Cacao Fermentation & Drying', 'manamchocolate' ),
		'title' => __( 'Revealing Hidden Flavours', 'manamchocolate' ),
		'desc'  => __( 'Scientific fermentation and drying at Distinct Origins Cacao Fermentery unlocks the true flavour potential of the Indian Cacao.', 'manamchocolate' ),
		'file'  => 'craft-fermentation.jpg',
		'video' => 'craft-fermentation.mp4',
		'alt'   => __( 'Cacao fermentation and drying at Distinct Origins Fermentery - Revealing Hidden Flavours', 'manamchocolate' ),
	),
	3 => array(
		'stage' => '03',
		'tab'   => __( 'Chocolate Making', 'manamchocolate' ),
		'focus' => __( 'Chocolate Making & Processing', 'manamchocolate' ),
		'title' => __( 'Expressing Cacao’s Flavours', 'manamchocolate' ),
		'desc'  => __( 'Cacao beans are delicately roasted, refined, conched and tempered into chocolate couvertures that honour the bold and distinct flavours of the ingredient.', 'manamchocolate' ),
		'file'  => 'craft-making.jpg',
		'video' => 'craft-making.mp4',
		'alt'   => __( 'Roasting, conching and chocolate processing - Expressing Cacao\'s Flavours', 'manamchocolate' ),
	),
	4 => array(
		'stage' => '04',
		'tab'   => __( 'Chocolatiering', 'manamchocolate' ),
		'focus' => __( 'Different Chocolate Interpretations', 'manamchocolate' ),
		'title' => __( 'Exploring Endless Possibilities', 'manamchocolate' ),
		'desc'  => __( 'Chocolate is creatively interpreted into an ever-growing world of chocolate concepts that balance familiar Indian tastes with novel global preferences.', 'manamchocolate' ),
		'file'  => 'craft-chocolaterie.jpg',
		'video' => 'craft-chocolatiering.mp4',
		'alt'   => __( 'Artisanal bonbons and confections - Exploring Endless Possibilities', 'manamchocolate' ),
	),
);
?>

<section id="our-craft-section" class="homepage-section our-craft-section" aria-labelledby="craft-section-heading">
	<div class="site-container">
		
		<!-- Section Header -->
		<header class="section-header craft-section-header" data-reveal="up">
			<span class="section-subtitle craft-subtitle"><?php esc_html_e( 'Our Craft', 'manamchocolate' ); ?></span>
			<h2 id="craft-section-heading" class="section-title craft-main-heading">
				<span class="craft-heading-line"><?php esc_html_e( 'BEFORE THE BEAN.', 'manamchocolate' ); ?></span>
				<span class="craft-heading-line"><?php esc_html_e( 'BEYOND THE BAR.', 'manamchocolate' ); ?></span>
			</h2>
		</header>

		<!-- Interactive Timeline Container -->
		<div id="craft-timeline" class="craft-timeline" data-total-stages="4">
			
			<!-- Stage Cards Carousel/Switcher -->
			<div class="craft-carousel-wrapper" data-reveal="up">
				
				<!-- Previous / Next Controls -->
				<div class="craft-arrows-wrap" aria-label="<?php esc_attr_e( 'Craft Stage Navigation Controls', 'manamchocolate' ); ?>">
					<button type="button" class="craft-arrow-btn craft-arrow-prev" id="craft-arrow-prev" aria-label="<?php esc_attr_e( 'Previous Craft Stage', 'manamchocolate' ); ?>" disabled>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<polyline points="15 18 9 12 15 6"></polyline>
						</svg>
					</button>
					<button type="button" class="craft-arrow-btn craft-arrow-next" id="craft-arrow-next" aria-label="<?php esc_attr_e( 'Next Craft Stage', 'manamchocolate' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<polyline points="9 18 15 12 9 6"></polyline>
						</svg>
					</button>
				</div>

				<div class="craft-stages-list" id="craft-stages-list">
					<?php foreach ( $craft_stages as $index => $stage ) :
						$has_image = file_exists( $theme_dir . '/assets/images/' . $stage['file'] );
						$poster_url = $has_image ? $theme_uri . '/assets/images/' . $stage['file'] : '';
						$has_video = file_exists( $theme_dir . '/assets/videos/' . $stage['video'] );
						$video_url  = $has_video ? $theme_uri . '/assets/videos/' . $stage['video'] : '';
						$is_active = ( 1 === $index );
					?>
						<article
							id="craft-stage-<?php echo esc_attr( $index ); ?>"
							class="craft-stage-card<?php echo $is_active ? ' is-active' : ''; ?>"
							data-stage-index="<?php echo esc_attr( $index ); ?>"
							aria-hidden="<?php echo $is_active ? 'false' : 'true'; ?>"
							role="tabpanel"
							aria-labelledby="craft-tab-<?php echo esc_attr( $index ); ?>"
						>
							<!-- Left Column: Visual / Photograph Container with Video Loop -->
							<div class="craft-stage-visual-wrap">
								<div class="craft-video-container">
									<?php if ( $has_video ) : ?>
										<video
											class="craft-stage-video"
											playsinline
											muted
											loop
											preload="none"
											poster="<?php echo esc_url( $poster_url ); ?>"
											width="720"
											height="720"
											aria-label="<?php echo esc_attr( $stage['alt'] ); ?>"
										>
											<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
										</video>
									<?php endif; ?>

									<?php if ( $has_image ) : ?>
										<img
											src="<?php echo esc_url( $poster_url ); ?>"
											alt="<?php echo esc_attr( $stage['alt'] ); ?>"
											width="1000"
											height="1000"
											loading="lazy"
											class="craft-stage-poster"
										/>
									<?php else : ?>
										<!-- Clean Photographic Container with Fallback Typography & Tone -->
										<div class="craft-stage-placeholder" aria-label="<?php echo esc_attr( $stage['alt'] ); ?>">
											<div class="craft-placeholder-inner">
												<div class="craft-placeholder-badge"><?php echo esc_html( 'STAGE ' . $stage['stage'] ); ?></div>
												<span class="craft-placeholder-label"><?php echo esc_html( $stage['tab'] ); ?></span>
												<span class="craft-placeholder-file"><?php echo esc_html( $stage['file'] ); ?></span>
												<span class="craft-placeholder-hint"><?php esc_html_e( 'Awaiting approved photograph', 'manamchocolate' ); ?></span>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<!-- Right Column: Editorial Content Card -->
							<div class="craft-stage-content-wrap">
								<div class="craft-stage-content">
									<div class="craft-stage-meta">
										<span class="craft-stage-tag"><?php echo esc_html( 'STAGE ' . $stage['stage'] ); ?></span>
										<span class="craft-stage-separator" aria-hidden="true">&bull;</span>
										<span class="craft-stage-focus"><?php echo esc_html( $stage['focus'] ); ?></span>
									</div>
									<h3 class="craft-stage-title"><?php echo esc_html( $stage['title'] ); ?></h3>
									<p class="craft-stage-desc"><?php echo esc_html( $stage['desc'] ); ?></p>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div><!-- .craft-stages-list -->
			</div><!-- .craft-carousel-wrapper -->

			<!-- Stage Navigation Tabs with Progress Line -->
			<div class="craft-nav-container" data-reveal="up">
				<div class="craft-progress-track" aria-hidden="true">
					<div class="craft-progress-bar" id="craft-progress-bar" style="width: 25%;"></div>
				</div>
				<nav class="craft-tabs-nav" role="tablist" aria-label="<?php esc_attr_e( 'Craft Stages', 'manamchocolate' ); ?>">
					<?php foreach ( $craft_stages as $index => $stage ) :
						$is_active = ( 1 === $index );
					?>
						<button
							type="button"
							id="craft-tab-<?php echo esc_attr( $index ); ?>"
							class="craft-nav-tab<?php echo $is_active ? ' is-active' : ''; ?>"
							role="tab"
							aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
							aria-controls="craft-stage-<?php echo esc_attr( $index ); ?>"
							data-stage-target="<?php echo esc_attr( $index ); ?>"
						>
							<span class="craft-tab-stage"><?php echo esc_html( $stage['stage'] ); ?></span>
							<span class="craft-tab-title"><?php echo esc_html( $stage['tab'] ); ?></span>
						</button>
					<?php endforeach; ?>
				</nav>
			</div><!-- .craft-nav-container -->

		</div><!-- #craft-timeline -->

	</div><!-- .site-container -->
</section>

