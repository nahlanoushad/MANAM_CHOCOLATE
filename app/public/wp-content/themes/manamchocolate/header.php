<?php
/**
 * The header template for our theme
 *
 * Displays all of the <head> section and everything up until <div id="content">
 * Recreates the exact black header, title-case navigation, and utility icon arrangement
 * from the official Manam Chocolate reference website (https://manamchocolate.com/).
 *
 * @package ManamChocolate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$home_url = home_url( '/' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'manamchocolate' ); ?>
	</a>

	<!-- SITE HEADER -->
	<header id="masthead" class="site-header <?php echo ( is_front_page() || is_home() ) ? 'header--transparent' : ''; ?>" role="banner">

		<!-- 2. Main Navigation Bar (Exact Manam Chocolate #121212 Black Header) -->
		<div class="header-main-bar">
			<div class="site-container header-main-inner">

				<!-- Mobile Hamburger Toggle (Mobile/Tablet Only) -->
				<div class="header-mobile-toggle-wrap">
					<button type="button" class="mobile-menu-toggle" id="mobile-menu-toggle" aria-controls="mobile-navigation-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'manamchocolate' ); ?>">
						<svg class="icon icon-hamburger" width="24" height="24" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
							<line x1="4" y1="6.5" x2="22" y2="6.5" stroke-linecap="round"/>
							<line x1="4" y1="13" x2="22" y2="13" stroke-linecap="round"/>
							<line x1="4" y1="19.5" x2="22" y2="19.5" stroke-linecap="round"/>
						</svg>
					</button>
				</div>

				<!-- Left / Brand Area: Official Manam White Wordmark -->
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						$logo_file = get_template_directory() . '/assets/images/Manam_Logo_Wordmark_280x.png';
						if ( file_exists( $logo_file ) ) :
							?>
							<a href="<?php echo esc_url( $home_url ); ?>" class="site-brand-link" rel="home">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Manam_Logo_Wordmark_280x.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="brand-logo-img brand-logo-white" width="140" height="39" />
							</a>
							<?php
						else :
							$site_title = get_bloginfo( 'name' );
							if ( empty( $site_title ) || strtolower( trim( $site_title ) ) === 'manamchocolate' ) {
								$brand_text = 'MANAM CHOCOLATE';
							} else {
								$brand_text = $site_title;
							}
							?>
							<a href="<?php echo esc_url( $home_url ); ?>" class="site-brand-link" rel="home">
								<span class="site-brand-text"><?php echo esc_html( $brand_text ); ?></span>
							</a>
							<?php
						endif;
					endif;
					?>
				</div>

				<!-- Centre: Desktop Primary Navigation -->
				<nav id="site-navigation" class="site-navigation desktop-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'manamchocolate' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'nav-menu primary-nav-menu',
							'container'      => false,
							'fallback_cb'    => 'manamchocolate_primary_menu_fallback',
						)
					);
					?>
				</nav>

				<!-- Right: 4 Utility Icons (Exact Reference Order: Email/Blinkit, Search, Account, Cart) -->
				<div class="header-actions">
					<!-- 1. Email / Blinkit Availability Icon -->
					<button type="button" class="header-action-btn email-toggle-btn header__icon-wrapper" id="email-toggle-btn" aria-controls="newsletter-popup" aria-expanded="false" aria-label="<?php esc_attr_e( 'Availability on Blinkit', 'manamchocolate' ); ?>">
						<svg focusable="false" width="20" height="16" class="icon icon-header-email" viewBox="0 0 20 16" fill="none" stroke="currentColor" stroke-width="1.1" aria-hidden="true">
							<path d="M19 4l-9 5-9-5"></path>
							<path d="M1 1h18v14H1z"></path>
						</svg>
					</button>

					<!-- 2. Search Drawer Toggle Button -->
					<button type="button" class="header-action-btn search-toggle-btn header__icon-wrapper" id="search-toggle-btn" aria-controls="search-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open Search', 'manamchocolate' ); ?>">
						<svg focusable="false" width="22" height="22" class="icon icon-header-search" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
							<path d="M21.4502 21.4502L16.1608 16.5115M17.9502 11.4767C17.9502 14.943 15.0961 17.7531 11.5752 17.7531C8.05438 17.7531 5.2002 14.943 5.2002 11.4767C5.2002 8.01026 8.05438 5.2002 11.5752 5.2002C15.0961 5.2002 17.9502 8.01026 17.9502 11.4767Z" stroke-linecap="round"/>
						</svg>
					</button>

					<!-- 3. Account Link -->
					<a href="<?php echo esc_url( manamchocolate_get_account_url() ); ?>" class="header-action-btn account-btn header__icon-wrapper" id="account-btn" aria-label="<?php esc_attr_e( 'My Account', 'manamchocolate' ); ?>">
						<svg width="22" height="22" viewBox="0 0 29 29" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M4.833 25.375V22.958C4.833 21.677 5.343 20.447 6.249 19.541C7.155 18.634 8.385 18.125 9.667 18.125H12.688"/>
							<path d="M14.5 13.292C17.169 13.292 19.333 11.128 19.333 8.458C19.333 5.789 17.169 3.625 14.5 3.625C11.831 3.625 9.667 5.789 9.667 8.458C9.667 11.128 11.831 13.292 14.5 13.292Z"/>
						</svg>
					</a>

					<!-- 4. Shopping Cart Link with Floating Item Counter -->
					<a href="<?php echo esc_url( manamchocolate_get_cart_url() ); ?>" class="header-action-btn cart-btn header__icon-wrapper" id="cart-btn" aria-label="<?php esc_attr_e( 'View Shopping Bag', 'manamchocolate' ); ?>">
						<svg focusable="false" width="22" height="22" class="icon icon-header-cart" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
							<path d="M4 13H16" stroke-miterlimit="10"/>
							<path d="M7.02209 6C6.79445 4.34703 8.36222 2.96956 10.0658 3.00051C11.7254 3.03147 13.2014 4.39346 12.9774 6" stroke-miterlimit="10"/>
							<path d="M15.3518 6L4.64821 6.01573L4 15.9056L4.06772 15.9528L15.9 16L16 15.893L15.3518 6Z" stroke-miterlimit="10"/>
						</svg>
						<span class="cart-count-badge header__cart-count header__cart-count--floating bubble-count" id="header-cart-count">
							<?php echo esc_html( manamchocolate_get_cart_count() ); ?>
						</span>
					</a>
				</div>

			</div>
		</div>

		<!-- 3. Authentic Predictive Search Drawer (Exact Reference Layout) -->
		<div id="search-drawer" class="predictive-search drawer drawer--large drawer--from-right" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Search', 'manamchocolate' ); ?>" hidden>
			<span class="drawer__overlay" id="search-drawer-overlay"></span>

			<div class="drawer__container">
				<header class="drawer__header">
					<form id="predictive-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="predictive-search__form" role="search">
						<svg focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon icon--header-search" viewBox="0 0 26 26" fill="none" aria-hidden="true">
							<path d="M21.4502 21.4502L16.1608 16.5115M17.9502 11.4767C17.9502 14.943 15.0961 17.7531 11.5752 17.7531C8.05438 17.7531 5.2002 14.943 5.2002 11.4767C5.2002 8.01026 8.05438 5.2002 11.5752 5.2002C15.0961 5.2002 17.9502 8.01026 17.9502 11.4767Z" stroke="currentColor" stroke-width="1.2"/>
						</svg>
						<input class="predictive-search__input" type="search" name="s" id="predictive-search-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" aria-label="<?php esc_attr_e( 'Search', 'manamchocolate' ); ?>" placeholder="<?php esc_attr_e( 'What are you looking for?', 'manamchocolate' ); ?>" value="<?php echo get_search_query(); ?>">
						<button type="button" class="predictive-search__clear-btn" id="predictive-search-clear" aria-label="<?php esc_attr_e( 'Clear search', 'manamchocolate' ); ?>" hidden>
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M13 13L1 1M13 1L1 13"/></svg>
						</button>
					</form>

					<button type="button" class="drawer__close-button tap-area" id="search-drawer-close" aria-label="<?php esc_attr_e( 'Close Search', 'manamchocolate' ); ?>">
						<svg focusable="false" width="14" height="14" class="icon icon--close" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.3">
							<path d="M13 13L1 1M13 1L1 13"></path>
						</svg>
					</button>
				</header>

				<div class="drawer__content">
					<div class="predictive-search__content-wrapper">
						<div class="predictive-search__loading-state" id="predictive-search-loading" hidden>
							<div class="search-spinner" aria-label="<?php esc_attr_e( 'Loading...', 'manamchocolate' ); ?>">
								<svg class="spinner-svg" viewBox="0 0 50 50">
									<circle cx="25" cy="25" r="20" fill="none" stroke="currentColor" stroke-width="3"></circle>
								</svg>
							</div>
						</div>

						<div class="predictive-search__results" id="predictive-search-results" aria-live="polite">
							<div class="predictive-search__initial-state">
								<p class="predictive-search__prompt-text"><?php esc_html_e( 'Search our craft chocolates, tablets, collections, and gifting selections.', 'manamchocolate' ); ?></p>
							</div>
						</div>
					</div>
				</div>

				<footer class="drawer__footer drawer__footer--no-top-padding" id="predictive-search-footer" hidden>
					<button type="submit" form="predictive-search-form" class="button button--primary button--full predictive-search__view-all-btn" id="predictive-search-view-all">
						<?php esc_html_e( 'View all results', 'manamchocolate' ); ?>
					</button>
				</footer>
			</div>
		</div>

		<!-- 4. Authentic Blinkit Availability Modal (Exact Reference Parity) -->
		<div id="newsletter-popup" class="modal blinkit-modal" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Availability on Blinkit', 'manamchocolate' ); ?>" hidden>
			<div class="modal__overlay" id="blinkit-modal-overlay"></div>
			<div class="modal__content blinkit-modal__content">
				<button type="button" class="modal__close-button tap-area" id="blinkit-modal-close" aria-label="<?php esc_attr_e( 'Close popup', 'manamchocolate' ); ?>">
					<svg focusable="false" width="14" height="14" class="icon icon--close" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path d="M13 13L1 1M13 1L1 13"></path>
					</svg>
				</button>
				<a href="https://manamchocolate.com/collections/quickcommerce" target="_blank" rel="noopener noreferrer" class="newsletter-modal__link blinkit-modal__link" id="blinkit-modal-link" aria-label="<?php esc_attr_e( 'Shop Manam Chocolate on Blinkit Quickcommerce', 'manamchocolate' ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/web-blinkit-x-manam.jpg' ); ?>" alt="<?php esc_attr_e( 'Manam Chocolate x Blinkit Quickcommerce', 'manamchocolate' ); ?>" class="newsletter-modal__image blinkit-modal__image" width="1080" height="1080" />
				</a>
			</div>
		</div>

		<!-- 5. Mobile Responsive Navigation Drawer -->
		<div id="mobile-navigation-drawer" class="mobile-navigation-drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile Navigation Menu', 'manamchocolate' ); ?>" hidden>
			<div class="mobile-drawer-backdrop" id="mobile-drawer-backdrop"></div>
			<div class="mobile-drawer-panel">
				<!-- Drawer Header -->
				<div class="mobile-drawer-header">
					<div class="mobile-drawer-branding">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Manam_Logo_Wordmark_280x.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="mobile-drawer-logo" width="120" height="33" />
					</div>
					<button type="button" class="mobile-drawer-close" id="mobile-drawer-close" aria-label="<?php esc_attr_e( 'Close Menu', 'manamchocolate' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="18" y1="6" x2="6" y2="18"/>
							<line x1="6" y1="6" x2="18" y2="18"/>
						</svg>
					</button>
				</div>

				<!-- Drawer Search -->
				<div class="mobile-drawer-search">
					<form role="search" method="get" class="mobile-search-form" action="<?php echo esc_url( $home_url ); ?>">
						<div class="mobile-search-wrap">
							<input type="search" class="mobile-search-input" placeholder="<?php esc_attr_e( 'Search chocolates, tablets...', 'manamchocolate' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
							<button type="submit" class="mobile-search-submit" aria-label="<?php esc_attr_e( 'Search', 'manamchocolate' ); ?>">
								<svg width="18" height="18" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
									<path d="M21.4502 21.4502L16.1608 16.5115M17.9502 11.4767C17.9502 14.943 15.0961 17.7531 11.5752 17.7531C8.05438 17.7531 5.2002 14.943 5.2002 11.4767C5.2002 8.01026 8.05438 5.2002 11.5752 5.2002C15.0961 5.2002 17.9502 8.01026 17.9502 11.4767Z"/>
								</svg>
							</button>
						</div>
					</form>
				</div>

				<!-- Drawer Navigation List with Accordions (All 8 Top-Level Items) -->
				<div class="mobile-drawer-body">
					<nav class="mobile-nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'manamchocolate' ); ?>">
						<ul class="mobile-menu-list">
							<!-- 1. SHOP ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'shop/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'Shop', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Shop Categories', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<!-- Craft Chocolate Tablets -->
									<div class="mobile-sub-group">
										<h5 class="mobile-sub-title"><?php esc_html_e( 'Craft Chocolate Tablets', 'manamchocolate' ); ?></h5>
										<ul class="mobile-sub-list">
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Noteworthy', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product/the-tablet-library-10-pcs/' ); ?>"><?php esc_html_e( 'The Tablet Library', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Single-Origin Dark', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Single-Origin Milk', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Single-Origin White', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Single Farm', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Signature Pairings', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Alternates', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>" class="mobile-view-all"><?php esc_html_e( 'View All', 'manamchocolate' ); ?> &rarr;</a></li>
										</ul>
									</div>

									<!-- Bonbons, Palettes & Assorted Boxes -->
									<div class="mobile-sub-group">
										<h5 class="mobile-sub-title"><?php esc_html_e( 'Bonbons, Palettes & Assorted Boxes', 'manamchocolate' ); ?></h5>
										<ul class="mobile-sub-list">
											<li><a href="<?php echo esc_url( $home_url . 'product-category/indulgence-collection/' ); ?>"><?php esc_html_e( 'The Bonbon Collection', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/indulgence-collection/' ); ?>"><?php esc_html_e( 'The Palette Collection', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/indulgence-collection/' ); ?>"><?php esc_html_e( 'The Chocolatier\'s Selection', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/indulgence-collection/' ); ?>" class="mobile-view-all"><?php esc_html_e( 'View All', 'manamchocolate' ); ?> &rarr;</a></li>
										</ul>
									</div>

									<!-- Snacking Collection -->
									<div class="mobile-sub-group">
										<h5 class="mobile-sub-title"><?php esc_html_e( 'Snacking Collection', 'manamchocolate' ); ?></h5>
										<ul class="mobile-sub-list">
											<li><a href="<?php echo esc_url( $home_url . 'product-category/the-snacking-collection/' ); ?>"><?php esc_html_e( 'Mini Croissants', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product/almond-praline-cluster-45-milk/' ); ?>"><?php esc_html_e( 'Clusters', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product/nutty-praline-chocolate-barks-45-milk/' ); ?>"><?php esc_html_e( 'Chocolate Barks', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/the-snacking-collection/' ); ?>"><?php esc_html_e( 'Chocolate Dragees', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/the-snacking-collection/' ); ?>"><?php esc_html_e( 'Enrobed Chocolate', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product/sea-salt-cacao-nibs/' ); ?>"><?php esc_html_e( 'Snacking Cacao Nibs', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product/the-chocolatiers-thins-selection/' ); ?>"><?php esc_html_e( 'Signature Thins', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product/sweet-curry-leaf-shortbread-cookies-white-chocolate/' ); ?>"><?php esc_html_e( 'Shortbread Cookies', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/the-snacking-collection/' ); ?>"><?php esc_html_e( 'Savoury Mixes', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/the-snacking-collection/' ); ?>" class="mobile-view-all"><?php esc_html_e( 'View All', 'manamchocolate' ); ?> &rarr;</a></li>
										</ul>
									</div>

									<!-- Pantry Essentials -->
									<div class="mobile-sub-group">
										<h5 class="mobile-sub-title"><?php esc_html_e( 'Pantry Essentials', 'manamchocolate' ); ?></h5>
										<ul class="mobile-sub-list">
											<li><a href="<?php echo esc_url( $home_url . 'product-category/pantry-collection/' ); ?>"><?php esc_html_e( 'Chocolate Spreads', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/pantry-collection/' ); ?>"><?php esc_html_e( 'Drinking Chocolate', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/pantry-collection/' ); ?>" class="mobile-view-all"><?php esc_html_e( 'View All', 'manamchocolate' ); ?> &rarr;</a></li>
										</ul>
									</div>

									<!-- Preferences -->
									<div class="mobile-sub-group">
										<h5 class="mobile-sub-title"><?php esc_html_e( 'Preferences', 'manamchocolate' ); ?></h5>
										<ul class="mobile-sub-list">
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=dark' ); ?>"><?php esc_html_e( 'Dark', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=milk' ); ?>"><?php esc_html_e( 'Milk', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=white' ); ?>"><?php esc_html_e( 'White', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=vegan' ); ?>"><?php esc_html_e( 'Vegan', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=sugar' ); ?>"><?php esc_html_e( 'Sugar', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=gluten' ); ?>"><?php esc_html_e( 'Gluten', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=nuts' ); ?>"><?php esc_html_e( 'Nuts', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/?filter_dietary=fruit' ); ?>"><?php esc_html_e( 'Fruit', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'product-category/award-winning/' ); ?>"><strong><?php esc_html_e( 'Maker\'s Recommendation', 'manamchocolate' ); ?></strong></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'shop/' ); ?>" class="mobile-view-all"><strong><?php esc_html_e( 'Everything', 'manamchocolate' ); ?> &rarr;</strong></a></li>
										</ul>
									</div>
								</div>
							</li>

							<!-- 2. GIFT ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'product-category/gifting/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'Gift', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Gift Categories', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<ul class="mobile-sub-list">
										<li><a href="<?php echo esc_url( $home_url . 'product-category/gifting/' ); ?>"><?php esc_html_e( 'Diwali Edit 2026', 'manamchocolate' ); ?> <span class="nav-badge-new">New</span></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product-category/birthdays-anniversaries/' ); ?>"><?php esc_html_e( 'Birthdays & Anniversaries', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product-category/hosting-celebrations/' ); ?>"><?php esc_html_e( 'Hosting & Celebrations', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product-category/preferences-lifestyle/' ); ?>"><?php esc_html_e( 'Preferences & Lifestyle', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product-category/favours/' ); ?>"><?php esc_html_e( 'Favours', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product/gift-card/' ); ?>"><?php esc_html_e( 'Gift Card', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product-category/gifting/' ); ?>" class="mobile-view-all"><?php esc_html_e( 'Everything', 'manamchocolate' ); ?> &rarr;</a></li>
									</ul>
								</div>
							</li>

							<!-- 3. EXPERIENCE ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'experience/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'Experience', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Experience Categories', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<div class="mobile-sub-group">
										<h5 class="mobile-sub-title"><?php esc_html_e( 'Workshops', 'manamchocolate' ); ?></h5>
										<ul class="mobile-sub-list">
											<li><a href="<?php echo esc_url( $home_url . 'collections/workshops-in-delhi/' ); ?>"><?php esc_html_e( 'Delhi', 'manamchocolate' ); ?></a></li>
											<li><a href="<?php echo esc_url( $home_url . 'collections/workshops-in-hyderabad/' ); ?>"><?php esc_html_e( 'Hyderabad', 'manamchocolate' ); ?></a></li>
										</ul>
									</div>
									<ul class="mobile-sub-list" style="margin-top: 10px;">
										<li><a href="<?php echo esc_url( $home_url . 'experience/karkhana-tours/' ); ?>"><?php esc_html_e( 'Karkhana Tours', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'product/private-chocolatiering-workshops/' ); ?>"><?php esc_html_e( 'Private Workshops', 'manamchocolate' ); ?></a></li>
									</ul>
								</div>
							</li>

							<!-- 4. VISIT ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'store-locator/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'Visit', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Visit Locations', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<ul class="mobile-sub-list">
										<li><a href="<?php echo esc_url( $home_url . 'pages/manam-chocolate-hyderabad/' ); ?>"><?php esc_html_e( 'Hyderabad', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'pages/manam-chocolate-delhi-store/' ); ?>"><?php esc_html_e( 'Delhi-NCR', 'manamchocolate' ); ?></a></li>
									</ul>
								</div>
							</li>

							<!-- 5. MAKE WITH MANAM ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'product-category/baking/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'Make with Manam', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Make with Manam', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<ul class="mobile-sub-list">
										<li><a href="<?php echo esc_url( $home_url . 'product-category/baking/' ); ?>"><?php esc_html_e( 'Baking Collection', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'for-professionals/' ); ?>"><?php esc_html_e( 'For Professionals', 'manamchocolate' ); ?></a></li>
									</ul>
								</div>
							</li>

							<!-- 6. ABOUT ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'about-us/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'About', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle About', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<ul class="mobile-sub-list">
										<li><a href="<?php echo esc_url( $home_url . 'about-us/' ); ?>"><?php esc_html_e( 'Our Story', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'press/' ); ?>"><?php esc_html_e( 'Media', 'manamchocolate' ); ?></a></li>
									</ul>
								</div>
							</li>

							<!-- 7. CUSTOMER SERVICE ACCORDION -->
							<li class="mobile-menu-item has-accordion">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'contact-us/' ); ?>" class="mobile-item-link"><?php esc_html_e( 'Customer Service', 'manamchocolate' ); ?></a>
									<button type="button" class="accordion-toggle-btn" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Customer Service', 'manamchocolate' ); ?>">
										<span class="animated-plus"></span>
									</button>
								</div>
								<div class="accordion-panel" hidden>
									<ul class="mobile-sub-list">
										<li><a href="<?php echo esc_url( $home_url . 'track-order/' ); ?>"><?php esc_html_e( 'Track Your Order', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'contact-us/' ); ?>"><?php esc_html_e( 'Contact Us', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'shipping-policy/' ); ?>"><?php esc_html_e( 'Shipping', 'manamchocolate' ); ?></a></li>
										<li><a href="<?php echo esc_url( $home_url . 'refund-policy/' ); ?>"><?php esc_html_e( 'Refund', 'manamchocolate' ); ?></a></li>
									</ul>
								</div>
							</li>

							<!-- 8. CORPORATE GIFTING LINK -->
							<li class="mobile-menu-item">
								<div class="accordion-header">
									<a href="<?php echo esc_url( $home_url . 'corporate-gifting/' ); ?>" class="mobile-item-link">
										<?php esc_html_e( 'Corporate Gifting', 'manamchocolate' ); ?>
									</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Drawer Footer Actions -->
				<div class="mobile-drawer-footer">
					<a href="<?php echo esc_url( manamchocolate_get_account_url() ); ?>" class="mobile-footer-action-link">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
							<circle cx="12" cy="7" r="4"/>
						</svg>
						<span><?php esc_html_e( 'My Account', 'manamchocolate' ); ?></span>
					</a>
					<a href="<?php echo esc_url( manamchocolate_get_cart_url() ); ?>" class="mobile-footer-action-link">
						<svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" aria-hidden="true">
							<path d="M6.5 6C6.3 4.4 7.9 3 9.6 3C11.3 3 12.8 4.4 12.6 6"/>
							<path d="M15.4 6L4.6 6L4 16.5L16 16.5L15.4 6Z"/>
						</svg>
						<span><?php esc_html_e( 'Shopping Bag', 'manamchocolate' ); ?></span>
						<span class="mobile-cart-count"><?php echo esc_html( manamchocolate_get_cart_count() ); ?></span>
					</a>
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
