<?php
/**
 * Manam Chocolate Theme Functions and Definitions
 *
 * @package ManamChocolate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'MANAMCHOCOLATE_VERSION', '1.4.0' );

if ( ! function_exists( 'manamchocolate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function manamchocolate_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'manamchocolate', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set default thumbnail sizes.
		set_post_thumbnail_size( 1200, 9999 );

		// Register Navigation Menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'manamchocolate' ),
				'footer'  => esc_html__( 'Footer Menu', 'manamchocolate' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'               => 120,
				'width'                => 320,
				'flex-height'          => true,
				'flex-width'           => true,
				'unlink-homepage-logo' => false,
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for selective refresh for widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for WooCommerce and gallery features.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'manamchocolate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function manamchocolate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'manamchocolate_content_width', 1280 );
}
add_action( 'after_setup_theme', 'manamchocolate_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function manamchocolate_scripts() {
	// Google Fonts: Instrument Sans (matching Manam Chocolate reference typography).
	wp_enqueue_style(
		'manamchocolate-fonts',
		'https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap',
		array(),
		null
	);

	// Theme root stylesheet (metadata and core classes).
	wp_enqueue_style(
		'manamchocolate-style',
		get_stylesheet_uri(),
		array( 'manamchocolate-fonts' ),
		MANAMCHOCOLATE_VERSION
	);

	// Main theme styles.
	wp_enqueue_style(
		'manamchocolate-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'manamchocolate-style' ),
		MANAMCHOCOLATE_VERSION
	);

	// Main theme JavaScript.
	wp_enqueue_script(
		'manamchocolate-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		MANAMCHOCOLATE_VERSION,
		true
	);

	// Localize script data for AJAX add-to-cart and dynamic updates.
	$wc_ajax_endpoint = class_exists( 'WC_AJAX' ) ? WC_AJAX::get_endpoint( '%%endpoint%%' ) : '';
	wp_localize_script(
		'manamchocolate-main',
		'manamSettings',
		array(
			'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
			'wcAjaxUrl'   => $wc_ajax_endpoint,
			'cartUrl'     => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' ),
			'addedToCart' => esc_html__( 'Added to cart!', 'manamchocolate' ),
		)
	);

	// Comments reply script for single posts and pages.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'manamchocolate_scripts' );

/**
 * Safe Helper: Get Account URL.
 *
 * @return string Safe URL for Account link.
 */
function manamchocolate_get_account_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$account_page_id = get_option( 'woocommerce_myaccount_page_id' );
		if ( $account_page_id ) {
			$url = get_permalink( $account_page_id );
			if ( $url ) {
				return $url;
			}
		}
	}
	return is_user_logged_in() ? admin_url( 'profile.php' ) : wp_login_url();
}

/**
 * Safe Helper: Get Cart URL.
 *
 * @return string Safe URL for Cart link.
 */
function manamchocolate_get_cart_url() {
	if ( function_exists( 'wc_get_cart_url' ) ) {
		$url = wc_get_cart_url();
		if ( $url ) {
			return $url;
		}
	}
	return home_url( '/#cart' );
}

/**
 * Safe Helper: Get Cart Item Count.
 *
 * @return int Total count of cart items or 0.
 */
function manamchocolate_get_cart_count() {
	if ( function_exists( 'WC' ) && WC() && isset( WC()->cart ) && is_object( WC()->cart ) ) {
		return WC()->cart->get_cart_contents_count();
	}
	return 0;
}

/**
 * Default Primary Navigation Fallback.
 *
 * Renders the Manam Chocolate multi-column mega menu and all dropdown sections
 * when no custom WordPress menu is assigned in Appearance > Menus.
 */
function manamchocolate_primary_menu_fallback() {
	$home = trailingslashit( home_url( '/' ) );
	?>
	<ul id="primary-menu" class="nav-menu primary-nav-menu" role="menubar">

		<!-- 1. SHOP -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="Shop">
			<a href="<?php echo esc_url( $home . 'shop/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'Shop', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Shop Submenu', 'manamchocolate' ); ?>">
				<!-- 1.1 Craft Chocolate Tablets -->
				<li class="nav-dropdown__item has-dropdown" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Craft Chocolate Tablets', 'manamchocolate' ); ?></span>
						<svg class="dropdown-arrow-right" width="7" height="10" viewBox="0 0 7 10" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"/></svg>
					</a>
					<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Craft Chocolate Tablets', 'manamchocolate' ); ?>">
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Noteworthy', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product/the-tablet-library-10-pcs/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'The Tablet Library', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Single-Origin Dark', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Single-Origin Milk', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Single-Origin White', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Single Farm', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Signature Pairings', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Alternates', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/tablet-collection/' ); ?>" class="nav-dropdown__link view-all-link" role="menuitem"><span><?php esc_html_e( 'View All', 'manamchocolate' ); ?></span></a></li>
					</ul>
				</li>

				<!-- 1.2 Bonbons, Palettes & Assorted Boxes -->
				<li class="nav-dropdown__item has-dropdown" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/indulgence-collection/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Bonbons, Palettes & Assorted Boxes', 'manamchocolate' ); ?></span>
						<svg class="dropdown-arrow-right" width="7" height="10" viewBox="0 0 7 10" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"/></svg>
					</a>
					<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Bonbons, Palettes & Assorted Boxes', 'manamchocolate' ); ?>">
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/indulgence-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'The Bonbon Collection', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/indulgence-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'The Palette Collection', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/indulgence-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'The Chocolatier\'s Selection', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/indulgence-collection/' ); ?>" class="nav-dropdown__link view-all-link" role="menuitem"><span><?php esc_html_e( 'View All', 'manamchocolate' ); ?></span></a></li>
					</ul>
				</li>

				<!-- 1.3 Snacking Collection -->
				<li class="nav-dropdown__item has-dropdown" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/the-snacking-collection/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Snacking Collection', 'manamchocolate' ); ?></span>
						<svg class="dropdown-arrow-right" width="7" height="10" viewBox="0 0 7 10" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"/></svg>
					</a>
					<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Snacking Collection', 'manamchocolate' ); ?>">
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/the-snacking-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Mini Croissants', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product/almond-praline-cluster-45-milk/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Clusters', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product/nutty-praline-chocolate-barks-45-milk/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Chocolate Barks', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/the-snacking-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Chocolate Dragees', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/the-snacking-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Enrobed Chocolate', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product/sea-salt-cacao-nibs/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Snacking Cacao Nibs', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product/the-chocolatiers-thins-selection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Signature Thins', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product/sweet-curry-leaf-shortbread-cookies-white-chocolate/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Shortbread Cookies', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/the-snacking-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Savoury Mixes', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/the-snacking-collection/' ); ?>" class="nav-dropdown__link view-all-link" role="menuitem"><span><?php esc_html_e( 'View All', 'manamchocolate' ); ?></span></a></li>
					</ul>
				</li>

				<!-- 1.4 Pantry Essentials -->
				<li class="nav-dropdown__item has-dropdown" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/pantry-collection/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Pantry Essentials', 'manamchocolate' ); ?></span>
						<svg class="dropdown-arrow-right" width="7" height="10" viewBox="0 0 7 10" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"/></svg>
					</a>
					<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Pantry Essentials', 'manamchocolate' ); ?>">
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/pantry-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Chocolate Spreads', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/pantry-collection/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Drinking Chocolate', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'product-category/pantry-collection/' ); ?>" class="nav-dropdown__link view-all-link" role="menuitem"><span><?php esc_html_e( 'View All', 'manamchocolate' ); ?></span></a></li>
					</ul>
				</li>

				<!-- 1.5 Preferences -->
				<li class="nav-dropdown__item has-dropdown" role="none">
					<a href="<?php echo esc_url( $home . 'shop/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Preferences', 'manamchocolate' ); ?></span>
						<svg class="dropdown-arrow-right" width="7" height="10" viewBox="0 0 7 10" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"/></svg>
					</a>
					<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Preferences', 'manamchocolate' ); ?>">
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=dark' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Dark', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=milk' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Milk', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=white' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'White', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=vegan' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Vegan', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=sugar' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Sugar', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=gluten' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Gluten', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=nuts' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Nuts', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'shop/?filter_dietary=fruit' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Fruit', 'manamchocolate' ); ?></span></a></li>
					</ul>
				</li>

				<!-- 1.6 Additional Direct Links -->
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/award-winning/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Maker\'s Recommendation', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'shop/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Everything', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 2. GIFT -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="Gift">
			<a href="<?php echo esc_url( $home . 'product-category/gifting/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'Gift', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Gift Submenu', 'manamchocolate' ); ?>">
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/diwali-2026/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Diwali Edit 2026', 'manamchocolate' ); ?> <span class="nav-badge-new">New</span></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/birthdays-anniversaries/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Birthdays & Anniversaries', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/hosting-celebrations/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Hosting & Celebrations', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/preferences-lifestyle/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Preferences & Lifestyle', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/favours/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Favours', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product/gift-card/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Gift Card', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/gifting/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Everything', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 3. EXPERIENCE -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="Experience">
			<a href="<?php echo esc_url( $home . 'experience/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'Experience', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Experience Submenu', 'manamchocolate' ); ?>">
				<li class="nav-dropdown__item has-dropdown" role="none">
					<a href="<?php echo esc_url( $home . 'experience/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Workshops', 'manamchocolate' ); ?></span>
						<svg class="dropdown-arrow-right" width="7" height="10" viewBox="0 0 7 10" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"/></svg>
					</a>
					<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Workshops Locations', 'manamchocolate' ); ?>">
						<li role="none"><a href="<?php echo esc_url( $home . 'collections/workshops-in-delhi/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Delhi', 'manamchocolate' ); ?></span></a></li>
						<li role="none"><a href="<?php echo esc_url( $home . 'collections/workshops-in-hyderabad/' ); ?>" class="nav-dropdown__link" role="menuitem"><span><?php esc_html_e( 'Hyderabad', 'manamchocolate' ); ?></span></a></li>
					</ul>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'experience/karkhana-tours/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Karkhana Tours', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product/private-chocolatiering-workshops/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Private Workshops', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 4. VISIT -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="Visit">
			<a href="<?php echo esc_url( $home . 'store-locator/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'Visit', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Visit Locations Submenu', 'manamchocolate' ); ?>">
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'pages/manam-chocolate-hyderabad/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Hyderabad', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'pages/manam-chocolate-delhi-store/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Delhi-NCR', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 5. MAKE WITH MANAM -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="Make with Manam">
			<a href="<?php echo esc_url( $home . 'product-category/baking/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'Make with Manam', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Make with Manam Submenu', 'manamchocolate' ); ?>">
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'product-category/baking/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Baking Collection', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'for-professionals/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'For Professionals', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 6. ABOUT -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="About">
			<a href="<?php echo esc_url( $home . 'about-us/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'About', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'About Submenu', 'manamchocolate' ); ?>">
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'about-us/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Our Story', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'press/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Media', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 7. CUSTOMER SERVICE -->
		<li class="menu-item menu-item-has-children has-dropdown" role="none" data-item-title="Customer Service">
			<a href="<?php echo esc_url( $home . 'contact-us/' ); ?>" class="nav-link menu-link link--animated" role="menuitem" aria-haspopup="true" aria-expanded="false">
				<span><?php esc_html_e( 'Customer Service', 'manamchocolate' ); ?></span>
			</a>
			<ul class="nav-dropdown" role="menu" aria-label="<?php esc_attr_e( 'Customer Service Submenu', 'manamchocolate' ); ?>">
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'track-order/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Track Your Order', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'contact-us/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Contact Us', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'shipping-policy/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Shipping', 'manamchocolate' ); ?></span>
					</a>
				</li>
				<li class="nav-dropdown__item" role="none">
					<a href="<?php echo esc_url( $home . 'refund-policy/' ); ?>" class="nav-dropdown__link" role="menuitem">
						<span><?php esc_html_e( 'Refund', 'manamchocolate' ); ?></span>
					</a>
				</li>
			</ul>
		</li>

		<!-- 8. CORPORATE GIFTING (Direct link) -->
		<li class="menu-item" role="none" data-item-title="Corporate Gifting">
			<a href="<?php echo esc_url( $home . 'corporate-gifting/' ); ?>" class="nav-link menu-link link--animated" role="menuitem">
				<span><?php esc_html_e( 'Corporate Gifting', 'manamchocolate' ); ?></span>
			</a>
		</li>

	</ul>
	<?php
}

/**
 * WooCommerce compatibility helpers.
 */
if ( class_exists( 'WooCommerce' ) ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	add_filter( 'loop_shop_per_page', function() {
		return 30;
	}, 20 );

	function manamchocolate_woocommerce_wrapper_before() {
		echo '<main id="primary" class="site-main woocommerce-main">';
	}
	add_action( 'woocommerce_before_main_content', 'manamchocolate_woocommerce_wrapper_before', 10 );

	function manamchocolate_woocommerce_wrapper_after() {
		echo '</main><!-- #primary -->';
	}
	add_action( 'woocommerce_after_main_content', 'manamchocolate_woocommerce_wrapper_after', 10 );

	/**
	 * Ensure header cart count badge updates dynamically via WooCommerce AJAX fragments.
	 *
	 * @param array $fragments Existing fragments.
	 * @return array Modified fragments.
	 */
	function manamchocolate_cart_count_fragments( $fragments ) {
		$count = manamchocolate_get_cart_count();
		$fragments['#header-cart-count'] = '<span class="cart-count-badge" id="header-cart-count">' . esc_html( $count ) . '</span>';
		return $fragments;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'manamchocolate_cart_count_fragments' );

	/**
	 * Helper to get clean query parameters for filter URLs.
	 *
	 * @param string $param_key Query parameter name.
	 * @param string $param_val Term slug value.
	 * @return string Filter toggle URL.
	 */
	function manamchocolate_get_filter_url( $param_key, $param_val ) {
		$current_url = remove_query_arg( 'paged' );
		$current_val = isset( $_GET[ $param_key ] ) ? wc_clean( wp_unslash( $_GET[ $param_key ] ) ) : '';
		$values = ! empty( $current_val ) ? explode( ',', $current_val ) : array();

		if ( in_array( $param_val, $values, true ) ) {
			$values = array_diff( $values, array( $param_val ) );
		} else {
			$values[] = $param_val;
		}

		if ( empty( $values ) ) {
			return remove_query_arg( $param_key, $current_url );
		} else {
			return add_query_arg( $param_key, implode( ',', $values ), $current_url );
		}
	}

	/**
	 * Dynamically calculate collection filter counts for the current collection/category.
	 *
	 * Supports the 6 authentic Manam filter groups:
	 * 1. ORIGINS: Blend, Kerala, Vietnam, West Godavari
	 * 2. CACAO PERCENTAGE: Dark & Vegan, Milk, Vegan, White
	 * 3. AWARD WINNING: No, Yes
	 * 4. PREFERENCE BASED: Fruit, Plain
	 * 5. VEGAN: No, Yes
	 * 6. PRICE RANGE: Dynamic Min & Max
	 *
	 * @param int $current_term_id Taxonomy term ID if on category archive.
	 * @return array Filter option counts and price boundaries.
	 */
	function manamchocolate_get_collection_filter_counts( $current_term_id = 0 ) {
		$args = array(
			'status' => 'publish',
			'limit'  => -1,
			'return' => 'ids',
		);
		if ( $current_term_id ) {
			$term = get_term( $current_term_id, 'product_cat' );
			if ( $term && ! is_wp_error( $term ) ) {
				$args['category'] = array( $term->slug );
			}
		}
		$product_ids = wc_get_products( $args );

		$counts = array(
			'origins'          => array(
				'Blend'         => 0,
				'Kerala'        => 0,
				'Vietnam'       => 0,
				'West Godavari' => 0,
			),
			'cacao_percentage' => array(
				'Dark & Vegan' => 0,
				'Milk'         => 0,
				'Vegan'        => 0,
				'White'        => 0,
			),
			'award_winning'    => array(
				'No'  => 0,
				'Yes' => 0,
			),
			'preference_based' => array(
				'Fruit' => 0,
				'Plain' => 0,
			),
			'vegan'            => array(
				'No'  => 0,
				'Yes' => 0,
			),
			'price_min'        => 0,
			'price_max'        => 595,
		);

		if ( empty( $product_ids ) ) {
			return $counts;
		}

		$prices = array();
		foreach ( $product_ids as $pid ) {
			$origin = get_post_meta( $pid, '_origin', true );
			$cacao  = get_post_meta( $pid, '_cacao_group', true );
			$award  = get_post_meta( $pid, '_award_winning', true );
			$pref   = get_post_meta( $pid, '_preference_based', true );
			$veg    = get_post_meta( $pid, '_is_vegan', true );
			$price  = (float) get_post_meta( $pid, '_price', true );

			if ( $price > 0 ) {
				$prices[] = $price;
			}

			if ( ! empty( $origin ) && isset( $counts['origins'][ $origin ] ) ) {
				$counts['origins'][ $origin ]++;
			}
			if ( ! empty( $cacao ) && isset( $counts['cacao_percentage'][ $cacao ] ) ) {
				$counts['cacao_percentage'][ $cacao ]++;
			}
			if ( ! empty( $award ) && isset( $counts['award_winning'][ $award ] ) ) {
				$counts['award_winning'][ $award ]++;
			}
			if ( ! empty( $pref ) && isset( $counts['preference_based'][ $pref ] ) ) {
				$counts['preference_based'][ $pref ]++;
			}
			if ( ! empty( $veg ) && isset( $counts['vegan'][ $veg ] ) ) {
				$counts['vegan'][ $veg ]++;
			}
		}

		if ( ! empty( $prices ) ) {
			$counts['price_min'] = 0; // Reference begins at 0
			$counts['price_max'] = (int) ceil( max( $prices ) );
		}

		return $counts;
	}

	/**
	 * Filter WooCommerce main products query based on URL parameters.
	 *
	 * Handles all 6 authentic Manam Chocolate filter parameters:
	 * - filter_origin: Blend, Kerala, Vietnam, West Godavari
	 * - filter_cacao_percentage: Dark & Vegan, Milk, Vegan, White
	 * - filter_award_winning: Yes, No
	 * - filter_preference: Fruit, Plain
	 * - filter_vegan: Yes, No
	 * - min_price & max_price: Price range
	 *
	 * @param WP_Query $q WooCommerce product query.
	 */
	function manamchocolate_filter_woocommerce_products( $q ) {
		if ( is_admin() || ! $q->is_main_query() ) {
			return;
		}

		$tax_query = (array) $q->get( 'tax_query' );
		$meta_query = (array) $q->get( 'meta_query' );

		// 1. Origins Filter
		if ( ! empty( $_GET['filter_origin'] ) ) {
			$origins_raw = explode( ',', wc_clean( wp_unslash( $_GET['filter_origin'] ) ) );
			$origin_slug_map = array(
				'blend'         => 'Blend',
				'kerala'        => 'Kerala',
				'vietnam'       => 'Vietnam',
				'west-godavari' => 'West Godavari',
			);
			$origin_vals = array();
			foreach ( $origins_raw as $or ) {
				$or_slug = sanitize_title( $or );
				$origin_vals[] = isset( $origin_slug_map[ $or_slug ] ) ? $origin_slug_map[ $or_slug ] : $or;
			}
			$meta_query[] = array(
				'key'     => '_origin',
				'value'   => $origin_vals,
				'compare' => 'IN',
			);
		}

		// 2. Cacao Percentage Filter
		if ( ! empty( $_GET['filter_cacao_percentage'] ) ) {
			$cacao_raw = explode( ',', wc_clean( wp_unslash( $_GET['filter_cacao_percentage'] ) ) );
			$cacao_slug_map = array(
				'dark-vegan'   => 'Dark & Vegan',
				'dark-and-vegan' => 'Dark & Vegan',
				'milk'         => 'Milk',
				'vegan'        => 'Vegan',
				'white'        => 'White',
			);
			$cacao_vals = array();
			foreach ( $cacao_raw as $cr ) {
				$cr_slug = sanitize_title( $cr );
				$cacao_vals[] = isset( $cacao_slug_map[ $cr_slug ] ) ? $cacao_slug_map[ $cr_slug ] : $cr;
			}
			$meta_query[] = array(
				'key'     => '_cacao_group',
				'value'   => $cacao_vals,
				'compare' => 'IN',
			);
		}

		// 3. Award Winning Filter
		if ( ! empty( $_GET['filter_award_winning'] ) ) {
			$award_raw = explode( ',', wc_clean( wp_unslash( $_GET['filter_award_winning'] ) ) );
			$award_vals = array();
			foreach ( $award_raw as $ar ) {
				$award_vals[] = ( strtolower( trim( $ar ) ) === 'yes' ) ? 'Yes' : 'No';
			}
			$meta_query[] = array(
				'key'     => '_award_winning',
				'value'   => $award_vals,
				'compare' => 'IN',
			);
		}

		// 4. Preference Based Filter
		if ( ! empty( $_GET['filter_preference'] ) ) {
			$pref_raw = explode( ',', wc_clean( wp_unslash( $_GET['filter_preference'] ) ) );
			$pref_slug_map = array(
				'fruit' => 'Fruit',
				'plain' => 'Plain',
			);
			$pref_vals = array();
			foreach ( $pref_raw as $pr ) {
				$pr_slug = sanitize_title( $pr );
				$pref_vals[] = isset( $pref_slug_map[ $pr_slug ] ) ? $pref_slug_map[ $pr_slug ] : $pr;
			}
			$meta_query[] = array(
				'key'     => '_preference_based',
				'value'   => $pref_vals,
				'compare' => 'IN',
			);
		}

		// 5. Vegan Filter
		if ( ! empty( $_GET['filter_vegan'] ) ) {
			$vegan_raw = explode( ',', wc_clean( wp_unslash( $_GET['filter_vegan'] ) ) );
			$vegan_vals = array();
			foreach ( $vegan_raw as $vr ) {
				$vegan_vals[] = ( strtolower( trim( $vr ) ) === 'yes' ) ? 'Yes' : 'No';
			}
			$meta_query[] = array(
				'key'     => '_is_vegan',
				'value'   => $vegan_vals,
				'compare' => 'IN',
			);
		}

		// 6. In Stock Filter
		if ( isset( $_GET['in_stock'] ) && '1' === $_GET['in_stock'] ) {
			$meta_query[] = array(
				'key'     => '_stock_status',
				'value'   => 'instock',
				'compare' => '=',
			);
		}

		// 7. Price Range Filter
		if ( isset( $_GET['min_price'] ) && is_numeric( $_GET['min_price'] ) && (float)$_GET['min_price'] > 0 ) {
			$meta_query[] = array(
				'key'     => '_price',
				'value'   => floatval( $_GET['min_price'] ),
				'compare' => '>=',
				'type'    => 'NUMERIC',
			);
		}
		if ( isset( $_GET['max_price'] ) && is_numeric( $_GET['max_price'] ) && (float)$_GET['max_price'] < 10000 ) {
			$meta_query[] = array(
				'key'     => '_price',
				'value'   => floatval( $_GET['max_price'] ),
				'compare' => '<=',
				'type'    => 'NUMERIC',
			);
		}

		if ( ! empty( $tax_query ) ) {
			$q->set( 'tax_query', $tax_query );
		}
		if ( ! empty( $meta_query ) ) {
			$q->set( 'meta_query', $meta_query );
		}
	}
	add_action( 'woocommerce_product_query', 'manamchocolate_filter_woocommerce_products' );

	/**
	 * Normalize custom and Shopify-style orderby parameter values.
	 */
	function manamchocolate_normalize_orderby() {
		if ( ! empty( $_GET['orderby'] ) ) {
			$order_map = array(
				'best-selling'    => 'popularity',
				'price-ascending' => 'price',
				'price-descending'=> 'price-desc',
				'newest'          => 'date',
			);
			$raw_order = wc_clean( wp_unslash( $_GET['orderby'] ) );
			if ( isset( $order_map[ $raw_order ] ) ) {
				$_GET['orderby'] = $order_map[ $raw_order ];
			}
		}
	}
	add_action( 'init', 'manamchocolate_normalize_orderby' );

	/**
	 * Add custom product data fields to WordPress Admin > Edit Product > General tab.
	 */
	function manamchocolate_add_custom_product_meta_fields() {
		echo '<div class="options_group manam_custom_product_data">';
		echo '<h4 style="padding: 10px 12px; margin: 15px 0 5px; font-weight: 700; background: #faf6f0; border-left: 3px solid #2b160c;">' . esc_html__( 'Manam Chocolate Product Specifications', 'manamchocolate' ) . '</h4>';

		woocommerce_wp_text_input( array(
			'id'          => '_net_weight',
			'label'       => __( 'Net Weight Display', 'manamchocolate' ),
			'placeholder' => 'e.g. 80 g',
			'desc_tip'    => true,
			'description' => __( 'Display string for Net Weight (e.g. 80 g, 200 g).', 'manamchocolate' ),
		) );

		woocommerce_wp_text_input( array(
			'id'          => '_unit_price',
			'label'       => __( 'Unit Price Display', 'manamchocolate' ),
			'placeholder' => 'e.g. ₹6.19 / g',
			'desc_tip'    => true,
			'description' => __( 'Unit price when applicable (e.g. ₹6.19 / g).', 'manamchocolate' ),
		) );

		woocommerce_wp_text_input( array(
			'id'          => '_dietary_badges',
			'label'       => __( 'Dietary & Lifestyle Badges', 'manamchocolate' ),
			'placeholder' => 'e.g. Celiac Friendly, Nut Free, Vegan',
			'desc_tip'    => true,
			'description' => __( 'Comma-separated badges displayed as pill chips.', 'manamchocolate' ),
		) );

		woocommerce_wp_textarea_input( array(
			'id'          => '_tasting_notes',
			'label'       => __( 'Tasting Notes', 'manamchocolate' ),
			'placeholder' => 'e.g. Notes of grapefruit and orange, with a subtle nuttiness.',
			'desc_tip'    => true,
			'description' => __( 'Sensory tasting notes for craft chocolate tablets and confections.', 'manamchocolate' ),
		) );

		woocommerce_wp_text_input( array(
			'id'          => '_shelf_life',
			'label'       => __( 'Shelf Life', 'manamchocolate' ),
			'placeholder' => 'e.g. 12 Months',
			'desc_tip'    => true,
			'description' => __( 'Product shelf life.', 'manamchocolate' ),
		) );

		woocommerce_wp_text_input( array(
			'id'          => '_country_of_origin',
			'label'       => __( 'Country of Origin', 'manamchocolate' ),
			'placeholder' => 'e.g. India',
			'desc_tip'    => true,
			'description' => __( 'Manufacturing country.', 'manamchocolate' ),
		) );

		woocommerce_wp_textarea_input( array(
			'id'          => '_manufacturer',
			'label'       => __( 'Manufacturer Info', 'manamchocolate' ),
			'placeholder' => 'e.g. Distinct Origins Private Limited...',
			'desc_tip'    => true,
			'description' => __( 'Complete manufacturer address and legal details.', 'manamchocolate' ),
		) );

		woocommerce_wp_textarea_input( array(
			'id'          => '_ingredients',
			'label'       => __( 'Ingredients', 'manamchocolate' ),
			'placeholder' => 'e.g. Fine Flavour Cacao Beans, Cane Sugar.',
			'desc_tip'    => true,
			'description' => __( 'Full ingredient breakdown.', 'manamchocolate' ),
		) );

		woocommerce_wp_textarea_input( array(
			'id'          => '_storage_info',
			'label'       => __( 'Storage Information', 'manamchocolate' ),
			'placeholder' => 'e.g. Store in a cool, dry and dark place...',
			'desc_tip'    => true,
			'description' => __( 'Storage instructions and recommended temperature.', 'manamchocolate' ),
		) );

		woocommerce_wp_textarea_input( array(
			'id'          => '_allergen_info',
			'label'       => __( 'Allergen Information', 'manamchocolate' ),
			'placeholder' => 'e.g. Product is made in a facility that handles nuts...',
			'desc_tip'    => true,
			'description' => __( 'Allergen warning statement.', 'manamchocolate' ),
		) );

		woocommerce_wp_textarea_input( array(
			'id'          => '_traceability_info',
			'label'       => __( 'Traceability & Farm Story', 'manamchocolate' ),
			'placeholder' => 'e.g. West Godavari farmer community...',
			'desc_tip'    => true,
			'description' => __( 'Farm origin story and cacao terroir details.', 'manamchocolate' ),
		) );

		echo '</div>';
	}
	add_action( 'woocommerce_product_options_general_product_data', 'manamchocolate_add_custom_product_meta_fields' );

	/**
	 * Save custom product data fields from WordPress Admin.
	 */
	function manamchocolate_save_custom_product_meta_fields( $post_id ) {
		$fields = array(
			'_net_weight'          => 'sanitize_text_field',
			'_unit_price'          => 'sanitize_text_field',
			'_dietary_badges'      => 'sanitize_text_field',
			'_tasting_notes'       => 'sanitize_textarea_field',
			'_shelf_life'          => 'sanitize_text_field',
			'_country_of_origin'   => 'sanitize_text_field',
			'_manufacturer'        => 'sanitize_textarea_field',
			'_ingredients'         => 'sanitize_textarea_field',
			'_storage_info'        => 'sanitize_textarea_field',
			'_allergen_info'       => 'sanitize_textarea_field',
			'_traceability_info'   => 'sanitize_textarea_field',
		);

		foreach ( $fields as $field_key => $sanitizer ) {
			if ( isset( $_POST[ $field_key ] ) ) {
				$val = call_user_func( $sanitizer, wp_unslash( $_POST[ $field_key ] ) );
				update_post_meta( $post_id, $field_key, $val );
			}
		}
	}
	add_action( 'woocommerce_process_product_meta', 'manamchocolate_save_custom_product_meta_fields' );
}

/**
 * Phase 13: Verified Press & Media Articles Data
 *
 * Filterable registry of editorial features and articles for the /press/ page.
 * Allows effortless content management and future CPT integration without plugins.
 *
 * @return array List of verified press article items.
 */
function manamchocolate_get_press_articles() {
	$home = home_url();

	return array(
		array(
			'id'            => 'press-story-1',
			'publication'   => 'TIME Magazine',
			'date'          => '',
			'headline'      => 'Manam Chocolate featured in TIME\'s annual list of the World\'s Greatest Places 2024',
			'description'   => 'Manam works closely with farmers and fermenters in Andhra Pradesh’s West Godavari district to put Indian-grown cacao on the global stage. And the world is taking notice.',
			'url'           => 'https://time.com/collection/worlds-greatest-places-2024/',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/2024_-_TIME_World_s_Greatest_Places_-_RGB.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/TIME_Magazine.jpg',
		),
		array(
			'id'            => 'press-story-2',
			'publication'   => 'The Week',
			'date'          => '',
			'headline'      => 'Manam promises to revolutionalise the way a craft chocolate is perceived in India',
			'description'   => 'With the help of farmers, chocolate makers and technology, this Hyderabad-based craft chocolate comes with a strong story and an irresistible flavour profile',
			'url'           => 'https://www.theweek.in/leisure/lifestyle/2023/09/04/for-the-love-of-chocolate-how-a-hyderabad-brand-is-changing-the-taste-of-cacao-farmers-in-godavari-region.html',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_2_1.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/manam_chocolate.jpg',
		),
		array(
			'id'            => 'press-story-3',
			'publication'   => 'India Today',
			'date'          => '',
			'headline'      => 'Manam launches a retail and experiential store that not only offers a spectacular assortment of treats, but also turns chocolate into a spectator sport',
			'description'   => 'From the farm and fermentary, we head over to front row seats for bean-to-bar chocolate theatrics.From bonbons to truffles to tablets and more, Indian cacao, if treated correctly can be used to make some of the world’s best confectionery',
			'url'           => 'https://www.indiatoday.in/magazine/supplement/story/20230828-chocolate-the-art-of-craft-2423043-2023-08-19',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_3_d1e047fa-f50d-4971-b9b5-c63c7771c248.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_4-80.jpg',
		),
		array(
			'id'            => 'press-story-4',
			'publication'   => 'Homegrown',
			'date'          => '',
			'headline'      => 'Beauty & The Bean: Manam Brings A Quiet Sophistication To Indian Craft Chocolate',
			'description'   => 'You would not believe the number of ‘Willy Wonka’ quips I heard when I told my friends and colleagues that I’d be travelling toHyderabadto visit a chocolate factory. Truth be told, I genuinely had no idea what to expect. Were there going to be Oompa Loompas? Was I going to fall into a gigantic vat of something? Could there be impromptu singing and dancing? Perhaps even a sketchy grandfather who\'s conned his family into thinking he\'s an invalid for decades?',
			'url'           => 'https://homegrown.co.in/homegrown-explore/hyderabad-attend-a-mixology-workshop-by-trade-ambassador-ishrat-kaur-this-weekend',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_4_77d30275-2296-43fc-88e9-5bf94ded90fc.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/homegrown_2023-08_3_3734c2e7-5747-482d-ac4f-4dc83011a237.jpg',
		),
		array(
			'id'            => 'press-story-5',
			'publication'   => 'Condé Nast Traveller',
			'date'          => '12 August 2023',
			'headline'      => 'Manam Chocolate is building a world of fine Indian cacao confections by starting right at the source.',
			'description'   => 'There’s something in the air in Hyderabad. Stand on a sidewalk in the new part of the city for a few minutes and between the start-up India conversation at the corner cigarette shop, the steady buzz of construction drills and the 250-seater packed restaurants on a weekday, you’ll pick up on a palpable energy. One that is making young India look at the city with fresh eyes. At Banjara Hills, one of the city’s swish neighbourhoods, I find, that along with this energy, there’s the heady aroma of fine flavour chocolate in the air. I’m standing outside the tablet-shaped door of the flagship location of Manam Chocolate, an ambitious and large-hearted homegrown Indian brand that is bringing Hyderbad’s tech expertise to the world of Indian craft chocolate. At the centre of this unlikely Venn diagram is Hyderabad local Chaitanya Muppala, the 32-year-old founder of Manam, who is, in fact, no stranger to sugar and spreadsheets. “A standing joke I used to have is that Hyderabad has been the next big thing for the last 10 years. But now, I believe its time has finally come,” chuckles Muppala.',
			'url'           => 'https://www.cntraveller.in/story/this-new-hyderabad-based-craft-chocolate-bean-to-bar-brand-melds-tech-and-tradition/',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_10_5ac1652e-597d-4751-b024-9745b95db2b2.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/Chocolatiering_Manam_Chocolate_Karkhana__photo_Daniel_D_souza_DSCF8204-2.webp',
		),
		array(
			'id'            => 'press-story-6',
			'publication'   => 'The Hindu',
			'date'          => '25 August 2023',
			'headline'      => 'Manam in Hyderabad is on a quest to craft India’s best chocolate.',
			'description'   => 'The raw cacao fruit tastes a little like custard apple. You break the soft outer shell with gentle pressure and extract the individual pods, arranged in two rows inside, to bite into the flesh. It is a bit sweet and a bit tart and quite a bit sour with a distinctly fruity aroma; if you’re tasting it for the first time, it is hard to imagine that this is what ultimately yields rich, brown chocolate—the two seem to taste nothing alike. However, more experienced palates, like that of B. Venkateswara Rao, whose 12-acre cacao farm in Gangannagudem village in Andhra Pradesh’s West Godavari district we are in, can apparently detect distinct flavour notes. “We grow banana, coconut, pepper on the same farm, so these flavours do get into the fruit and the seed,” he explains, plucking another cacao fruit from a tree and expertly breaking it open to offer us more of the pods.',
			'url'           => 'https://www.thehindu.com/food/features/manam-in-hyderabad-is-on-a-quest-to-craft-indias-best-chocolate/article67167222.ece',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_11.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/Chaitanya_Muppala_Manam_Chocolate_1692900936972_1692900946523.webp',
		),
		array(
			'id'            => 'press-story-7',
			'publication'   => 'Travel + Leisure',
			'date'          => '21 Aug 2023',
			'headline'      => 'Farmers are at the heart of the Manam Karkhana. One can pick single farm bars where farmers like GVS Prasad and GP Rao have dedicated tablets made from cacao that they grow.',
			'description'   => 'I zip down a highway in the West Godavari district of Andhra Pradesh to reach an ocean of lush coconut trees, interspersed with areca nut and sprawling betel leaf plantations. Under the deep shadows of these tall cash crops is a small, five-acre farm of green and maroon pods sprouting right from tree bark, ripening and getting ready to be harvested. This is a progressive cacao farm, run by GP Rao, a local who has been growing cacao for almost 25 years. Farmers like Rao are at the heart of the Manam Karkhana. One can pick single farm bars where farmers like GVS Prasad and GP Rao have dedicated tablets made from cacao that they grow.',
			'url'           => 'https://manamchocolate.com/',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_7_276e4334-3bd1-4708-83c8-a826603c7334.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/homegrown_2023-08_ed1a7e32-b364-421b-bbb1-76734868f3c5_3.jpg',
		),
		array(
			'id'            => 'press-story-8',
			'publication'   => 'Mid-Day',
			'date'          => '17 Aug 2023',
			'headline'      => 'Here\'s how progressive farmers are harvesting cacao at farms in West Godavari',
			'description'   => 'At 7 am, 62-year-old Boyapati Venkateswara Rao heads to his farm at Tadikalapudi in West Godavari district, along with his three full-time workers. This morning’s mission is the harvest of cacao pods. The process is straightforward, he says. “We use sickle knives to cut the pods off the tree, gather them in heaps, crack them open by striking two pods against each other or with a small wooden bat, scoop out the beans, collect them in plastic crates and load them onto a tractor to be sent to the fermentery.” Rao was in his late twenties when he quit a sales job in Chennai and returned home to Vijayawada to pursue his passion—farming. In 2011, he decided to dedicate a corner of his farm to cacao as an intercrop, alongside coconut and oil palm. Today, the farmer nurtures 1,300 cacao trees across three-and-a-half acres of land.',
			'url'           => 'https://www.mid-day.com/sunday-mid-day/article/in-pursuit-of-a-craft-23303406',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_copy_6_1.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/Wooden-cubs_d_fcbbde85-0a24-4815-bdbe-965ab1f800fe.webp',
		),
		array(
			'id'            => 'press-story-9',
			'publication'   => 'The Indian Express',
			'date'          => '30 Dec 2023',
			'headline'      => 'The great Indian chocolate factory',
			'description'   => 'When Chaitanya Muppala, 32, got to run the family-owned Almond House, a leading mithai store in Hyderabad, he was quick to notice the shift in gifting preferences from tradition to modernity in the Old City. That’s why he launched Manam Chocolate this August, artisanal, boutique and carefully curated as an uber-cool indulgence. Following a colonial legacy with factory-made settings, it took him a while to understand that a good chocolate was much like wine-making, growing and nurturing the beans with the right soil, climate and technique. Like the best Pinot Noir, it could have spicy and supple notes. And there was as much a mathematical method to the madness of swirling flavours.',
			'url'           => 'https://indianexpress.com/article/express-sunday-eye/indian-artisinal-chocolate-industry-9087213/',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Artboard_2_820d532a-9829-4575-9376-79af1a88fe50.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/Chocolate_as_it_should_be.jpg',
		),
		array(
			'id'            => 'press-story-10',
			'publication'   => "Harper's Bazaar",
			'date'          => 'May 24, 2024',
			'headline'      => 'This isn\'t just indulgence. It\'s a celebration of Indian mangoes in a set of new avatars - ones that surprise and delight with every bite.',
			'description'   => 'If you\'re looking to celebrate the King of Fruits this summer season in Hyderabad, this is the place to be. It\'s time to indulge in your favourite fruit for a delightful, distinct new mango experience! The options are endless as you get to choose over 30 varieties that include the DIY Mango Sundae Bar where you get to pour Manam’s signature dark or milk chocolate over chunks of fresh, juicy mangoes, layered with sponge cake, and an abundance of fun toppings. Some of these include the chunky Alphonso Mango jelly that\'s layered with coconut cream in a flaky croissant, the silky, sweet Himayat Mango that gets recast as a soft custard filling in a crispy baked flan, a classic that sees the mulberries and mangoes unite, and many more. This isn\'t just indulgence. It\'s a celebration of Indian mangoes in a set of new avatars - ones that surprise and delight with every bite.',
			'url'           => 'https://www.harpersbazaar.in/travel-food/story/delectable-menus-and-restaurants-that-need-to-be-on-your-radar-1008899-2024-05-21',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/Capture.jpg',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/untitled_design_-_2024-05-24t103648.035.webp',
		),
		array(
			'id'            => 'press-story-11',
			'publication'   => 'LBB (Little Black Book)',
			'date'          => '',
			'headline'      => 'Explore The Art Of Chocolate Making At This Chocolate Factory In Banjara Hills.',
			'description'   => 'Step into the Manam Chocolate Karkhana on Road No. 12, Banjara Hills, to witness the chocolate-making journey unfold from live roasting and conching to handcrafted bonbons and custom chocolate bars.',
			'url'           => 'https://lbb.in/hyderabad/manam-chocolate-hyderabad/',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/images.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/655de26b6458330bd4cd975f_1700651627441.webp',
		),
		array(
			'id'            => 'press-story-12',
			'publication'   => 'ThePrint',
			'date'          => '',
			'headline'      => 'A Hyderabad company putting Indian cacao beans on world map. With scientists-farmers combo.',
			'description'   => 'The world of craft chocolate wouldn’t exist without Indians—or their idli grinders. It’s what chocolatiers use to grind down cacao beans, usually sourced from West Africa or Latin America. And now, this Hyderabad-based craft chocolate company wants to put the Indian cacao bean on the chocolate map.',
			'url'           => 'https://theprint.in/ground-reports/hyderabad-company-putting-indian-cacao-beans-on-world-map-with-scientists-farmers-combo/2103274/',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/6de467a5-1317-46a3-9112-55f50b7ec28b_336df12d-9b58-42ac-affb-82c9ff194e45.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/301.jpg',
		),
		array(
			'id'            => 'press-story-13',
			'publication'   => 'Fortune India',
			'date'          => '',
			'headline'      => "Crafting India's Chocolate Story.",
			'description'   => "SUMMER IN WEST GODAVARI district of Andhra Pradesh is oppressive. At his 20-acre plantation on outskirts of Vijayawada on a blistering summer morning, G.V.S Prasad ensures visitors are well-hydrated with tender coconut water from the farm. However, real attention-grabbers are cacao fruit, growing amid coconut, banana and spices. Cacao fruit acquire flavour notes of plant(s) growing next to them. 'The recently harvested fruit has notes of chakkarrakeli bananas,' he says.",
			'url'           => 'https://www.fortuneindia.com/long-reads/crafting-indias-chocolate-story/117038',
			'logo'          => $home . '/wp-content/uploads/manam-about-media/images_ea590466-2b0c-4d33-ba46-2ce0b46a0b3d.png',
			'feature_image' => $home . '/wp-content/uploads/manam-about-media/Screenshot_2024-06-11_182424.png',
		),
	);
}

/**
 * Phase 14: Workshop Notification Form AJAX Handler & Admin Lead Management
 */

// 1. AJAX Handler for Workshop Leads
function manamchocolate_handle_workshop_notify() {
	check_ajax_referer( 'manam_workshop_notify_nonce', 'security' );

	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone    = isset( $_POST['whatsapp'] ) ? sanitize_text_field( wp_unslash( $_POST['whatsapp'] ) ) : '';
	$location = isset( $_POST['location'] ) ? sanitize_text_field( wp_unslash( $_POST['location'] ) ) : 'General';
	$consent  = isset( $_POST['consent'] ) ? (bool) $_POST['consent'] : false;

	// Validation
	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid email address.', 'manamchocolate' ) ) );
	}

	// 10-digit Indian phone validation (starts with 6, 7, 8, 9)
	$clean_phone = preg_replace( '/[^0-9]/', '', $phone );
	if ( ! preg_match( '/^[6-9][0-9]{9}$/', $clean_phone ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid 10-digit Indian mobile number.', 'manamchocolate' ) ) );
	}

	if ( ! $consent ) {
		wp_send_json_error( array( 'message' => __( 'Please check the consent box to receive workshop updates.', 'manamchocolate' ) ) );
	}

	// Store lead securely in WordPress options
	$leads = get_option( 'manam_workshop_leads', array() );
	if ( ! is_array( $leads ) ) {
		$leads = array();
	}

	$lead_id = uniqid( 'lead_' );
	$leads[] = array(
		'id'         => $lead_id,
		'email'      => $email,
		'whatsapp'   => '+91 ' . $clean_phone,
		'location'   => $location,
		'created_at' => current_time( 'mysql' ),
	);

	update_option( 'manam_workshop_leads', $leads, false );

	wp_send_json_success( array(
		'message' => sprintf(
			/* translators: %s: City location */
			__( 'Thank you! Your contact details have been recorded. We will notify you via WhatsApp and email as soon as new workshop slots open in %s.', 'manamchocolate' ),
			esc_html( $location )
		)
	) );
}
add_action( 'wp_ajax_manam_workshop_notify', 'manamchocolate_handle_workshop_notify' );
add_action( 'wp_ajax_nopriv_manam_workshop_notify', 'manamchocolate_handle_workshop_notify' );

// 2. Admin Lead Management Page
function manamchocolate_register_leads_admin_page() {
	add_management_page(
		__( 'Workshop Leads', 'manamchocolate' ),
		__( 'Workshop Leads', 'manamchocolate' ),
		'manage_options',
		'manam-workshop-leads',
		'manamchocolate_render_leads_admin_page'
	);
}
add_action( 'admin_menu', 'manamchocolate_register_leads_admin_page' );

function manamchocolate_render_leads_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Handle deletion if requested
	if ( isset( $_GET['action'], $_GET['lead_id'], $_GET['_wpnonce'] ) && 'delete' === $_GET['action'] ) {
		if ( wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'delete_lead_' . sanitize_text_field( $_GET['lead_id'] ) ) ) {
			$del_id = sanitize_text_field( $_GET['lead_id'] );
			$leads  = get_option( 'manam_workshop_leads', array() );
			$leads  = array_filter( $leads, function( $l ) use ( $del_id ) {
				return $l['id'] !== $del_id;
			} );
			update_option( 'manam_workshop_leads', array_values( $leads ), false );
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Lead removed successfully.', 'manamchocolate' ) . '</p></div>';
		}
	}

	$leads = get_option( 'manam_workshop_leads', array() );
	if ( ! is_array( $leads ) ) {
		$leads = array();
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Workshop Notification Submissions', 'manamchocolate' ); ?></h1>
		<p><?php esc_html_e( 'Secure list of customer leads registered to receive notifications for upcoming workshops in Delhi and Hyderabad.', 'manamchocolate' ); ?></p>
		
		<table class="wp-list-table widefat fixed striped" style="margin-top: 15px; max-width: 900px;">
			<thead>
				<tr>
					<th style="width: 140px;"><?php esc_html_e( 'Date', 'manamchocolate' ); ?></th>
					<th style="width: 120px;"><?php esc_html_e( 'Location', 'manamchocolate' ); ?></th>
					<th><?php esc_html_e( 'Email', 'manamchocolate' ); ?></th>
					<th style="width: 150px;"><?php esc_html_e( 'WhatsApp', 'manamchocolate' ); ?></th>
					<th style="width: 80px;"><?php esc_html_e( 'Actions', 'manamchocolate' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( ! empty( $leads ) ) : ?>
					<?php foreach ( array_reverse( $leads ) as $lead ) : ?>
						<tr>
							<td><?php echo esc_html( $lead['created_at'] ); ?></td>
							<td><strong><?php echo esc_html( $lead['location'] ); ?></strong></td>
							<td><a href="mailto:<?php echo esc_attr( $lead['email'] ); ?>"><?php echo esc_html( $lead['email'] ); ?></a></td>
							<td><?php echo esc_html( $lead['whatsapp'] ); ?></td>
							<td>
								<?php
								$del_url = wp_nonce_url(
									admin_url( 'tools.php?page=manam-workshop-leads&action=delete&lead_id=' . urlencode( $lead['id'] ) ),
									'delete_lead_' . $lead['id']
								);
								?>
								<a href="<?php echo esc_url( $del_url ); ?>" onclick="return confirm('Delete this lead?');" style="color: #a00;"><?php esc_html_e( 'Delete', 'manamchocolate' ); ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="5"><?php esc_html_e( 'No workshop leads submitted yet.', 'manamchocolate' ); ?></td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * =========================================================================
 * STAGE 5: GIFT CARD CUSTOMIZATION & CART DATA HOOKS
 * =========================================================================
 */

// 1. Capture Gift Card options on Add to Cart
function manamchocolate_add_gift_card_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
	$product = wc_get_product( $product_id );
	if ( ! $product ) {
		return $cart_item_data;
	}

	if ( 'gift-card' === $product->get_slug() || 97 === (int) $product_id ) {
		$valid_denominations = array( 1000, 2000, 3000, 5000 );
		$denom = isset( $_POST['gift_card_denomination'] ) ? absint( $_POST['gift_card_denomination'] ) : 1000;
		if ( ! in_array( $denom, $valid_denominations, true ) ) {
			$denom = 1000;
		}

		$cart_item_data['gift_card_denomination'] = $denom;

		if ( ! empty( $_POST['gift_card_recipient_email'] ) ) {
			$cart_item_data['gift_card_recipient_email'] = sanitize_email( wp_unslash( $_POST['gift_card_recipient_email'] ) );
		}
		if ( ! empty( $_POST['gift_card_recipient_name'] ) ) {
			$cart_item_data['gift_card_recipient_name'] = sanitize_text_field( wp_unslash( $_POST['gift_card_recipient_name'] ) );
		}
		if ( ! empty( $_POST['gift_card_message'] ) ) {
			$cart_item_data['gift_card_message'] = sanitize_textarea_field( wp_unslash( $_POST['gift_card_message'] ) );
		}
		if ( ! empty( $_POST['gift_card_sender_name'] ) ) {
			$cart_item_data['gift_card_sender_name'] = sanitize_text_field( wp_unslash( $_POST['gift_card_sender_name'] ) );
		}
		if ( ! empty( $_POST['gift_card_send_on'] ) ) {
			$cart_item_data['gift_card_send_on'] = sanitize_text_field( wp_unslash( $_POST['gift_card_send_on'] ) );
		}

		$cart_item_data['unique_key'] = md5( microtime() . wp_rand() );
	}

	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'manamchocolate_add_gift_card_cart_item_data', 10, 3 );

// 2. Set dynamic price based on denomination before calculating totals
function manamchocolate_set_gift_card_price( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	foreach ( $cart->get_cart() as $cart_item ) {
		if ( ! empty( $cart_item['gift_card_denomination'] ) ) {
			$cart_item['data']->set_price( floatval( $cart_item['gift_card_denomination'] ) );
		}
	}
}
add_action( 'woocommerce_before_calculate_totals', 'manamchocolate_set_gift_card_price', 20, 1 );

// 3. Display Gift Card metadata in cart and checkout
function manamchocolate_display_gift_card_item_data( $item_data, $cart_item ) {
	if ( ! empty( $cart_item['gift_card_denomination'] ) ) {
		$item_data[] = array(
			'key'   => __( 'Denomination', 'manamchocolate' ),
			'value' => wc_price( $cart_item['gift_card_denomination'] ),
		);
	}
	if ( ! empty( $cart_item['gift_card_recipient_email'] ) ) {
		$item_data[] = array(
			'key'   => __( 'Recipient Email', 'manamchocolate' ),
			'value' => esc_html( $cart_item['gift_card_recipient_email'] ),
		);
	}
	if ( ! empty( $cart_item['gift_card_recipient_name'] ) ) {
		$item_data[] = array(
			'key'   => __( 'Recipient Name', 'manamchocolate' ),
			'value' => esc_html( $cart_item['gift_card_recipient_name'] ),
		);
	}
	if ( ! empty( $cart_item['gift_card_message'] ) ) {
		$item_data[] = array(
			'key'   => __( 'Message', 'manamchocolate' ),
			'value' => esc_html( $cart_item['gift_card_message'] ),
		);
	}
	if ( ! empty( $cart_item['gift_card_sender_name'] ) ) {
		$item_data[] = array(
			'key'   => __( 'Sender Name', 'manamchocolate' ),
			'value' => esc_html( $cart_item['gift_card_sender_name'] ),
		);
	}
	if ( ! empty( $cart_item['gift_card_send_on'] ) ) {
		$item_data[] = array(
			'key'   => __( 'Send On', 'manamchocolate' ),
			'value' => esc_html( $cart_item['gift_card_send_on'] ),
		);
	}

	return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'manamchocolate_display_gift_card_item_data', 10, 2 );

// 4. Save metadata to Order Line Items at Checkout
function manamchocolate_save_gift_card_order_item_meta( $item, $cart_item_key, $values, $order ) {
	if ( ! empty( $values['gift_card_denomination'] ) ) {
		$item->add_meta_data( __( 'Denomination', 'manamchocolate' ), wc_price( $values['gift_card_denomination'] ), true );
	}
	if ( ! empty( $values['gift_card_recipient_email'] ) ) {
		$item->add_meta_data( __( 'Recipient Email', 'manamchocolate' ), $values['gift_card_recipient_email'], true );
	}
	if ( ! empty( $values['gift_card_recipient_name'] ) ) {
		$item->add_meta_data( __( 'Recipient Name', 'manamchocolate' ), $values['gift_card_recipient_name'], true );
	}
	if ( ! empty( $values['gift_card_message'] ) ) {
		$item->add_meta_data( __( 'Gift Message', 'manamchocolate' ), $values['gift_card_message'], true );
	}
	if ( ! empty( $values['gift_card_sender_name'] ) ) {
		$item->add_meta_data( __( 'Sender Name', 'manamchocolate' ), $values['gift_card_sender_name'], true );
	}
	if ( ! empty( $values['gift_card_send_on'] ) ) {
		$item->add_meta_data( __( 'Send Date', 'manamchocolate' ), $values['gift_card_send_on'], true );
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'manamchocolate_save_gift_card_order_item_meta', 10, 4 );

/**
 * =========================================================================
 * STAGE 5: ENQUIRY & CONTACT AJAX FORM HANDLERS
 * =========================================================================
 */

// 1. Contact Us Form Handler
function manamchocolate_handle_contact_form() {
	check_ajax_referer( 'manam_contact_form_nonce', 'contact_nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'manamchocolate' ) ) );
	}

	$submissions = get_option( 'manam_contact_submissions', array() );
	if ( ! is_array( $submissions ) ) {
		$submissions = array();
	}

	$submissions[] = array(
		'id'         => uniqid( 'cnt_', true ),
		'name'       => $name,
		'email'      => $email,
		'phone'      => $phone,
		'message'    => $message,
		'created_at' => current_time( 'mysql' ),
	);

	if ( count( $submissions ) > 100 ) {
		$submissions = array_slice( $submissions, -100 );
	}

	update_option( 'manam_contact_submissions', $submissions, false );

	wp_send_json_success( array(
		'message' => __( 'Thank you for reaching out! Our customer concierge team has received your message and will respond shortly.', 'manamchocolate' ),
	) );
}
add_action( 'wp_ajax_manam_submit_contact_form', 'manamchocolate_handle_contact_form' );
add_action( 'wp_ajax_nopriv_manam_submit_contact_form', 'manamchocolate_handle_contact_form' );

// 2. Corporate Gifting Form Handler
function manamchocolate_handle_corporate_form() {
	check_ajax_referer( 'manam_corporate_form_nonce', 'corp_nonce' );

	$name         = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone        = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email        = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$gifting_type = isset( $_POST['gifting_type'] ) ? sanitize_text_field( wp_unslash( $_POST['gifting_type'] ) ) : '';
	$company      = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$num_gifts    = isset( $_POST['num_gifts'] ) ? sanitize_text_field( wp_unslash( $_POST['num_gifts'] ) ) : '';
	$category     = isset( $_POST['category'] ) ? sanitize_text_field( wp_unslash( $_POST['category'] ) ) : '';
	$budget       = isset( $_POST['budget'] ) ? sanitize_text_field( wp_unslash( $_POST['budget'] ) ) : '';
	$timeline     = isset( $_POST['timeline'] ) ? sanitize_text_field( wp_unslash( $_POST['timeline'] ) ) : '';
	$details      = isset( $_POST['details'] ) ? sanitize_textarea_field( wp_unslash( $_POST['details'] ) ) : '';

	if ( empty( $name ) || empty( $phone ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'manamchocolate' ) ) );
	}

	$submissions = get_option( 'manam_corporate_submissions', array() );
	if ( ! is_array( $submissions ) ) {
		$submissions = array();
	}

	$submissions[] = array(
		'id'           => uniqid( 'corp_', true ),
		'name'         => $name,
		'phone'        => $phone,
		'email'        => $email,
		'gifting_type' => $gifting_type,
		'company'      => $company,
		'num_gifts'    => $num_gifts,
		'category'     => $category,
		'budget'       => $budget,
		'timeline'     => $timeline,
		'details'      => $details,
		'created_at'   => current_time( 'mysql' ),
	);

	if ( count( $submissions ) > 100 ) {
		$submissions = array_slice( $submissions, -100 );
	}

	update_option( 'manam_corporate_submissions', $submissions, false );

	wp_send_json_success( array(
		'message' => __( 'Thank you for your enquiry! Our corporate gifting concierge will review your requirements and reach out within 24 hours with custom recommendations.', 'manamchocolate' ),
	) );
}
add_action( 'wp_ajax_manam_submit_corporate_form', 'manamchocolate_handle_corporate_form' );
add_action( 'wp_ajax_nopriv_manam_submit_corporate_form', 'manamchocolate_handle_corporate_form' );

// 3. For Professionals Form Handler
function manamchocolate_handle_professionals_form() {
	check_ajax_referer( 'manam_professionals_form_nonce', 'pro_nonce' );

	$name             = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$company          = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$brand            = isset( $_POST['brand'] ) ? sanitize_text_field( wp_unslash( $_POST['brand'] ) ) : '';
	$phone            = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email            = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$business_type    = isset( $_POST['business_type'] ) ? sanitize_text_field( wp_unslash( $_POST['business_type'] ) ) : '';
	$product_interest = isset( $_POST['product_interest'] ) ? sanitize_text_field( wp_unslash( $_POST['product_interest'] ) ) : '';
	$volume           = isset( $_POST['volume'] ) ? sanitize_text_field( wp_unslash( $_POST['volume'] ) ) : '';
	$city             = isset( $_POST['city'] ) ? sanitize_text_field( wp_unslash( $_POST['city'] ) ) : '';
	$pincode          = isset( $_POST['pincode'] ) ? sanitize_text_field( wp_unslash( $_POST['pincode'] ) ) : '';
	$requirement      = isset( $_POST['requirement'] ) ? sanitize_textarea_field( wp_unslash( $_POST['requirement'] ) ) : '';

	if ( empty( $name ) || empty( $company ) || empty( $phone ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'manamchocolate' ) ) );
	}

	$submissions = get_option( 'manam_professionals_submissions', array() );
	if ( ! is_array( $submissions ) ) {
		$submissions = array();
	}

	$submissions[] = array(
		'id'               => uniqid( 'pro_', true ),
		'name'             => $name,
		'company'          => $company,
		'brand'            => $brand,
		'phone'            => $phone,
		'email'            => $email,
		'business_type'    => $business_type,
		'product_interest' => $product_interest,
		'volume'           => $volume,
		'city'             => $city,
		'pincode'          => $pincode,
		'requirement'      => $requirement,
		'created_at'       => current_time( 'mysql' ),
	);

	if ( count( $submissions ) > 100 ) {
		$submissions = array_slice( $submissions, -100 );
	}

	update_option( 'manam_professionals_submissions', $submissions, false );

	wp_send_json_success( array(
		'message' => __( 'Thank you! Your culinary partnership request has been received. Our chef relationship team will contact you with wholesale catalogues and sampling details.', 'manamchocolate' ),
	) );
}
add_action( 'wp_ajax_manam_submit_professionals_form', 'manamchocolate_handle_professionals_form' );
add_action( 'wp_ajax_nopriv_manam_submit_professionals_form', 'manamchocolate_handle_professionals_form' );

/**
 * Support direct Shopify-style collection URLs and routing parity
 */
function manamchocolate_shopify_collection_rewrites() {
	// 1. Dedicated Workshop Collection Pages (ID 28 & ID 29)
	add_rewrite_rule( '^collections/workshops-in-delhi/?$', 'index.php?page_id=28', 'top' );
	add_rewrite_rule( '^collections/workshops-in-hyderabad/?$', 'index.php?page_id=29', 'top' );

	// 2. Direct Shopify-style product URLs (/products/{slug})
	add_rewrite_rule( '^products/([^/]+)/?$', 'index.php?product=$matches[1]', 'top' );

	// 3. Shopify-style page aliases
	add_rewrite_rule( '^pages/terms-and-condition/?$', 'index.php?pagename=terms-and-conditions', 'top' );
	add_rewrite_rule( '^pages/privacy-and-policy/?$', 'index.php?pagename=privacy-policy', 'top' );
	add_rewrite_rule( '^pages/wallpaper-download/?$', 'index.php?pagename=wallpaper-download', 'top' );
	add_rewrite_rule( '^pages/corporate-bulk-ordering/?$', 'index.php?pagename=corporate-gifting', 'top' );
	add_rewrite_rule( '^pages/refund-policy/?$', 'index.php?pagename=refund-policy', 'top' );
	add_rewrite_rule( '^pages/shipping-policy/?$', 'index.php?pagename=shipping-policy', 'top' );
	add_rewrite_rule( '^wallpaper/?$', 'index.php?pagename=wallpaper-download', 'top' );
	add_rewrite_rule( '^category/diwali-edit/?$', 'index.php?product_cat=diwali-2026', 'top' );

	// 4. Direct Shopify-style page URLs (/pages/{slug})
	add_rewrite_rule( '^pages/([^/]+)/?$', 'index.php?pagename=pages/$matches[1]', 'top' );

	// 5. Fallback Shopify collection URLs (/collections/{slug} and /collections/{slug}/{sub})
	add_rewrite_rule( '^collections/([^/]+)/([^/]+)/?$', 'index.php?product_cat=$matches[1]', 'top' );
	add_rewrite_rule( '^collections/([^/]+)/?$', 'index.php?product_cat=$matches[1]', 'top' );
}
add_action( 'init', 'manamchocolate_shopify_collection_rewrites' );





/**
 * ==========================================================================
 * STAGE 5.10: LIVE PREDICTIVE SEARCH AJAX ENDPOINT & SEARCH QUERY PARITY
 * ==========================================================================
 */

/**
 * AJAX handler for live predictive product search
 */
function manamchocolate_ajax_predictive_search() {
	$raw_query = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
	$raw_query = trim( $raw_query );

	if ( empty( $raw_query ) ) {
		wp_send_json_success(
			array(
				'query'    => '',
				'total'    => 0,
				'products' => array(),
				'view_all' => home_url( '/?s=&post_type=product' ),
			)
		);
	}

	// 1. Direct search by keyword (title/content/excerpt)
	$title_query = new WP_Query(
		array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			's'              => $raw_query,
			'posts_per_page' => 20,
			'fields'         => 'ids',
		)
	);
	$found_ids   = ! empty( $title_query->posts ) ? $title_query->posts : array();

	// 2. Matching product categories or tags
	$matching_terms = get_terms(
		array(
			'taxonomy'   => array( 'product_cat', 'product_tag' ),
			'name__like' => $raw_query,
			'fields'     => 'ids',
		)
	);

	if ( ! empty( $matching_terms ) && ! is_wp_error( $matching_terms ) ) {
		$cat_query = new WP_Query(
			array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => 20,
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $matching_terms,
					),
				),
				'fields'         => 'ids',
			)
		);
		if ( ! empty( $cat_query->posts ) ) {
			$found_ids = array_unique( array_merge( $found_ids, $cat_query->posts ) );
		}
	}

	// 3. Search by SKU if applicable
	if ( function_exists( 'wc_get_product_id_by_sku' ) ) {
		$sku_id = wc_get_product_id_by_sku( $raw_query );
		if ( $sku_id && ! in_array( $sku_id, $found_ids, true ) ) {
			$found_ids[] = $sku_id;
		}
	}

	$total_count = count( $found_ids );
	$sliced_ids  = array_slice( $found_ids, 0, 8 );
	$products    = array();

	foreach ( $sliced_ids as $pid ) {
		$p = wc_get_product( $pid );
		if ( ! $p || ! $p->is_visible() ) {
			continue;
		}

		$image_id  = $p->get_image_id();
		$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : ( get_template_directory_uri() . '/assets/images/product-placeholder.svg' );

		// Extract cacao percentage or badge if present
		$cacao = get_post_meta( $pid, '_cacao_percentage', true );
		if ( empty( $cacao ) && preg_match( '/([0-9]+%\s*(?:Milk|Dark|Extra Dark|Malt Milk|Oat Mylk|Dark Milk))/i', $p->get_name(), $m ) ) {
			$cacao = $m[1];
		}

		$products[] = array(
			'id'         => $pid,
			'title'      => html_entity_decode( $p->get_name(), ENT_QUOTES, 'UTF-8' ),
			'url'        => $p->get_permalink(),
			'image'      => $image_url,
			'price_html' => $p->get_price_html(),
			'cacao'      => ! empty( $cacao ) ? $cacao : '',
		);
	}

	wp_send_json_success(
		array(
			'query'    => $raw_query,
			'total'    => $total_count,
			'products' => $products,
			'view_all' => add_query_arg(
				array(
					's' => $raw_query,
				),
				home_url( '/' )
			),
		)
	);
}
add_action( 'wp_ajax_manamchocolate_predictive_search', 'manamchocolate_ajax_predictive_search' );
add_action( 'wp_ajax_nopriv_manamchocolate_predictive_search', 'manamchocolate_ajax_predictive_search' );

/**
 * Filter frontend search queries to display WooCommerce products and include taxonomy matches
 */
function manamchocolate_filter_frontend_search( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set( 'post_type', 'product' );
		$query->set( 'post_status', 'publish' );

		$s = trim( (string) $query->get( 's' ) );
		if ( ! empty( $s ) ) {
			// Find category or tag matches
			$matching_terms = get_terms(
				array(
					'taxonomy'   => array( 'product_cat', 'product_tag' ),
					'name__like' => $s,
					'fields'     => 'ids',
				)
			);

			if ( ! empty( $matching_terms ) && ! is_wp_error( $matching_terms ) ) {
				$cat_pids = get_posts(
					array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => 100,
						'tax_query'      => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $matching_terms,
							),
						),
						'fields'         => 'ids',
					)
				);

				$title_pids = get_posts(
					array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => 100,
						's'              => $s,
						'fields'         => 'ids',
					)
				);

				$combined = array_unique( array_merge( (array) $title_pids, (array) $cat_pids ) );
				if ( ! empty( $combined ) ) {
					$query->set( 'manam_original_s', $s );
					$query->set( 'post__in', $combined );
					add_filter( 'posts_search', 'manamchocolate_suppress_posts_search', 10, 2 );
				}
			}
		}
	}
}
add_action( 'pre_get_posts', 'manamchocolate_filter_frontend_search' );

function manamchocolate_suppress_posts_search( $search, $wp_query ) {
	if ( $wp_query->get( 'manam_original_s' ) ) {
		remove_filter( 'posts_search', 'manamchocolate_suppress_posts_search', 10 );
		return '';
	}
	return $search;
}
