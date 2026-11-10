<?php
/**
 * Template part for displaying the "Manam Chocolate Karkhana" homepage section
 *
 * Implements:
 * - 5 Panoramic Photographic Slides (2:1 Widescreen Aspect Ratio)
 *   1. Karkhana Exterior Facade
 *   2. Chocolate Retail Space & Tablet Library
 *   3. Experiential Café & Beverage Space
 *   4. Live Chocolatiering & Chocolate-Making
 *   5. Cacao Roasting & Craft Production
 * - Dynamic JPG detection with fallback to custom vector artwork
 * - Authentic Overlay Content Card (#F0E5D4 background):
 *   - Heading: MANAM CHOCOLATE KARKHANA
 *   - Description: Come experience the magical craft...
 *   - Location: BANJARA HILLS, HYDERABAD.
 * - Interactive slide progress indicators & auto-advance timer
 * - Mobile responsive stacking & touch swipe gesture support
 *
 * @package ManamChocolate
 * @since 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
$theme_dir = get_template_directory();

$karkhana_slides = array(
	1 => array(
		'slug' => 'exterior',
		'file' => 'karkhana-exterior',
		'alt'  => __( 'Manam Chocolate Karkhana flagship experiential boutique exterior in Banjara Hills, Hyderabad', 'manamchocolate' ),
		'name' => __( 'Exterior Facade', 'manamchocolate' ),
	),
	2 => array(
		'slug' => 'retail',
		'file' => 'karkhana-retail',
		'alt'  => __( 'Manam Chocolate retail space and curated tablet library in Hyderabad', 'manamchocolate' ),
		'name' => __( 'Retail Interior', 'manamchocolate' ),
	),
	3 => array(
		'slug' => 'cafe',
		'file' => 'karkhana-cafe',
		'alt'  => __( 'Experiential chocolate café and beverage bar at Manam Chocolate Karkhana', 'manamchocolate' ),
		'name' => __( 'Experiential Café', 'manamchocolate' ),
	),
	4 => array(
		'slug' => 'chocolaterie',
		'file' => 'karkhana-chocolaterie',
		'alt'  => __( 'Live chocolatiering and bonbon crafting on marble tempering slab', 'manamchocolate' ),
		'name' => __( 'Live Chocolatiering', 'manamchocolate' ),
	),
	5 => array(
		'slug' => 'roasting',
		'file' => 'karkhana-roasting',
		'alt'  => __( 'Artisan cacao bean roasting and craft chocolate production machinery', 'manamchocolate' ),
		'name' => __( 'Cacao Roasting', 'manamchocolate' ),
	),
);
?>

<section class="homepage-section karkhana-section" id="karkhana-section" aria-labelledby="karkhana-heading">
	<div class="karkhana-container-wrapper">

		<!-- Visual Slideshow Area -->
		<div class="karkhana-slideshow" id="karkhana-slideshow" data-total-slides="<?php echo esc_attr( count( $karkhana_slides ) ); ?>" data-autoplay="true" data-interval="5000" data-reveal="fade">
			<div class="karkhana-slides-track">
				<?php
				$slide_index = 0;
				foreach ( $karkhana_slides as $key => $slide ) :
					$jpg_path = $theme_dir . '/assets/images/' . $slide['file'] . '.jpg';
					$has_jpg  = file_exists( $jpg_path );
					$img_src  = $has_jpg
						? $theme_uri . '/assets/images/' . $slide['file'] . '.jpg'
						: $theme_uri . '/assets/images/' . $slide['file'] . '.svg';

					$is_active = ( 0 === $slide_index );
					?>
					<div
						class="karkhana-slide <?php echo $is_active ? 'is-active' : ''; ?>"
						id="karkhana-slide-<?php echo esc_attr( $slide_index ); ?>"
						data-index="<?php echo esc_attr( $slide_index ); ?>"
						role="group"
						aria-roledescription="slide"
						aria-label="<?php echo esc_attr( sprintf( __( 'Slide %d of %d: %s', 'manamchocolate' ), $slide_index + 1, count( $karkhana_slides ), $slide['name'] ) ); ?>"
						<?php echo ! $is_active ? 'hidden' : ''; ?>
					>
						<div class="karkhana-image-wrapper">
							<img
								src="<?php echo esc_url( $img_src ); ?>"
								alt="<?php echo esc_attr( $slide['alt'] ); ?>"
								width="2160"
								height="1080"
								loading="<?php echo 0 === $slide_index ? 'eager' : 'lazy'; ?>"
								class="karkhana-image"
								draggable="false"
							/>
						</div>
					</div><!-- .karkhana-slide -->
					<?php
					$slide_index++;
				endforeach;
				?>
			</div><!-- .karkhana-slides-track -->

			<!-- Progress Bar Navigation Dots -->
			<nav class="karkhana-nav-dots" role="tablist" aria-label="<?php esc_attr_e( 'Karkhana Slideshow Navigation', 'manamchocolate' ); ?>">
				<div class="karkhana-nav-dots-inner">
					<?php
					$dot_index = 0;
					foreach ( $karkhana_slides as $key => $slide ) :
						$is_active = ( 0 === $dot_index );
						?>
						<button
							type="button"
							class="karkhana-progress-btn <?php echo $is_active ? 'is-active' : ''; ?>"
							data-slide-target="<?php echo esc_attr( $dot_index ); ?>"
							role="tab"
							aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
							aria-controls="karkhana-slide-<?php echo esc_attr( $dot_index ); ?>"
							aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %d: %s', 'manamchocolate' ), $dot_index + 1, $slide['name'] ) ); ?>"
						>
							<span class="karkhana-progress-fill"></span>
						</button>
						<?php
						$dot_index++;
					endforeach;
					?>
				</div>
			</nav>

			<!-- Desktop Floating Content Box (Over lower-left of visual showcase) -->
			<aside class="karkhana-content-box karkhana-desktop-content-box">
				<h2 id="karkhana-heading" class="karkhana-title">
					<strong><?php esc_html_e( 'MANAM CHOCOLATE', 'manamchocolate' ); ?><br><?php esc_html_e( 'KARKHANA', 'manamchocolate' ); ?></strong>
				</h2>
				<p class="karkhana-desc">
					<?php esc_html_e( 'Come experience the magical craft of chocolate making and chocolatiering in an immersive universe of new Indian Craft Chocolate™ experiences.', 'manamchocolate' ); ?>
				</p>
				<p class="karkhana-location">
					<strong><?php esc_html_e( 'BANJARA HILLS, HYDERABAD.', 'manamchocolate' ); ?></strong>
				</p>
			</aside>

		</div><!-- .karkhana-slideshow -->

		<!-- Mobile / Responsive Content Box (Positioned directly beneath slideshow on mobile) -->
		<div class="karkhana-mobile-content-box-wrapper">
			<div class="site-container">
				<aside class="karkhana-content-box karkhana-mobile-content-box">
					<h2 class="karkhana-title">
						<strong><?php esc_html_e( 'MANAM CHOCOLATE', 'manamchocolate' ); ?><br><?php esc_html_e( 'KARKHANA', 'manamchocolate' ); ?></strong>
					</h2>
					<p class="karkhana-desc">
						<?php esc_html_e( 'Come experience the magical craft of chocolate making and chocolatiering in an immersive universe of new Indian Craft Chocolate™ experiences.', 'manamchocolate' ); ?>
					</p>
					<p class="karkhana-location">
						<strong><?php esc_html_e( 'BANJARA HILLS, HYDERABAD.', 'manamchocolate' ); ?></strong>
					</p>
				</aside>
			</div>
		</div><!-- .karkhana-mobile-content-box-wrapper -->

	</div><!-- .karkhana-container-wrapper -->
</section><!-- .karkhana-section -->

