<?php
/**
 * The template for displaying the custom footer
 *
 * Contains the closing of the #content and #primary divs, the full 4-column
 * footer matching manamchocolate.com, and all content up to </body>
 *
 * @package ManamChocolate
 * @since 1.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
$home_url  = home_url( '/' );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-container footer-container">
			<div class="footer-main-row">

				<!-- Column 0: Brand Logo (Desktop) -->
				<div class="footer-col footer-col-brand">
					<a href="<?php echo esc_url( $home_url ); ?>" class="footer-brand-logo-link" aria-label="<?php esc_attr_e( 'Manam Chocolate Home', 'manamchocolate' ); ?>">
						<img
							src="<?php echo esc_url( $theme_uri . '/assets/images/manam-and-distinct.svg' ); ?>"
							alt="<?php esc_attr_e( 'Manam Chocolate and Distinct Origins', 'manamchocolate' ); ?>"
							width="320"
							height="65"
							loading="lazy"
							class="footer-brand-logo"
						/>
					</a>
				</div><!-- .footer-col-brand -->

				<!-- Column 1: SHOP -->
				<div class="footer-col footer-col-shop">
					<h3 class="footer-col-title">
						<button type="button" class="footer-accordion-toggle" aria-expanded="false" aria-controls="footer-menu-shop">
							<span><?php esc_html_e( 'SHOP', 'manamchocolate' ); ?></span>
							<svg class="footer-accordion-icon" width="16" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
								<path d="M15 1.5L8 8.5L1 1.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<span class="footer-title-desktop"><?php esc_html_e( 'SHOP', 'manamchocolate' ); ?></span>
					</h3>
					<div class="footer-col-content" id="footer-menu-shop">
						<ul class="footer-links-list">
							<li><a href="<?php echo esc_url( $home_url . 'product-category/tablet-collection/' ); ?>"><?php esc_html_e( 'Tablet Collection', 'manamchocolate' ); ?></a></li>
							<li><a href="<?php echo esc_url( $home_url . 'product-category/indulgence-collection/' ); ?>"><?php esc_html_e( 'Indulgence Collection', 'manamchocolate' ); ?></a></li>
							<li><a href="<?php echo esc_url( $home_url . 'product-category/the-snacking-collection/' ); ?>"><?php esc_html_e( 'Snacking Collection', 'manamchocolate' ); ?></a></li>
							<li><a href="<?php echo esc_url( $home_url . 'product-category/gifting/' ); ?>"><?php esc_html_e( 'Gifting Collection', 'manamchocolate' ); ?></a></li>
							<li><a href="<?php echo esc_url( $home_url . 'product-category/pantry-collection/' ); ?>"><?php esc_html_e( 'Pantry Collection', 'manamchocolate' ); ?></a></li>
							<li><a href="<?php echo esc_url( $home_url . 'product-category/award-winning/' ); ?>"><?php esc_html_e( 'Award Winning', 'manamchocolate' ); ?></a></li>
						</ul>
					</div>
				</div><!-- .footer-col-shop -->

				<!-- Column 2: ABOUT & HELPDESK (Stacked as in reference) -->
				<div class="footer-col footer-col-stacked">
					<!-- About Group -->
					<div class="footer-subcol footer-subcol-about">
						<h3 class="footer-col-title">
							<button type="button" class="footer-accordion-toggle" aria-expanded="false" aria-controls="footer-menu-about">
								<span><?php esc_html_e( 'About', 'manamchocolate' ); ?></span>
								<svg class="footer-accordion-icon" width="16" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
									<path d="M15 1.5L8 8.5L1 1.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
							<span class="footer-title-desktop"><?php esc_html_e( 'About', 'manamchocolate' ); ?></span>
						</h3>
						<div class="footer-col-content" id="footer-menu-about">
							<ul class="footer-links-list">
								<li><a href="<?php echo esc_url( $home_url . 'about-us/' ); ?>"><?php esc_html_e( 'Our Story', 'manamchocolate' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_url . 'press/' ); ?>"><?php esc_html_e( 'In the News', 'manamchocolate' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_url . 'pages/wallpaper-download/' ); ?>"><?php esc_html_e( 'Wallpaper', 'manamchocolate' ); ?></a></li>
							</ul>
						</div>
					</div>

					<!-- Helpdesk Group -->
					<div class="footer-subcol footer-subcol-helpdesk">
						<h3 class="footer-col-title">
							<button type="button" class="footer-accordion-toggle" aria-expanded="false" aria-controls="footer-menu-helpdesk">
								<span><?php esc_html_e( 'HELPDESK', 'manamchocolate' ); ?></span>
								<svg class="footer-accordion-icon" width="16" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
									<path d="M15 1.5L8 8.5L1 1.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
							<span class="footer-title-desktop"><?php esc_html_e( 'HELPDESK', 'manamchocolate' ); ?></span>
						</h3>
						<div class="footer-col-content" id="footer-menu-helpdesk">
							<ul class="footer-links-list">
								<li><a href="<?php echo esc_url( $home_url . 'corporate-gifting/' ); ?>"><?php esc_html_e( 'BULK ORDER', 'manamchocolate' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_url . 'refund-policy/' ); ?>"><?php esc_html_e( 'REFUND POLICY', 'manamchocolate' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_url . 'shipping-policy/' ); ?>"><?php esc_html_e( 'SHIPPING POLICY', 'manamchocolate' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_url . 'track-order/' ); ?>"><?php esc_html_e( 'TRACK YOUR ORDER', 'manamchocolate' ); ?></a></li>
							</ul>
						</div>
					</div>
				</div><!-- .footer-col-stacked -->

				<!-- Column 3: CONTACT -->
				<div class="footer-col footer-col-contact">
					<h3 class="footer-col-title">
						<span class="footer-title-desktop"><a href="<?php echo esc_url( $home_url . 'contact-us/' ); ?>"><?php esc_html_e( 'Contact', 'manamchocolate' ); ?></a></span>
					</h3>
					<div class="footer-col-content footer-contact-content">
						<!-- Customer Care -->
						<div class="contact-block customer-care-block">
							<p class="contact-line">
								<span class="contact-label"><?php esc_html_e( 'Customer Care:', 'manamchocolate' ); ?></span>
								<a href="tel:+917331100776" class="contact-link footer-contact-link">+91 73311 00776</a>
							</p>
							<p class="contact-line">
								<a href="mailto:care@manamchocolate.com" class="contact-link contact-email footer-contact-link">care@manamchocolate.com</a>
							</p>
							<p class="contact-hours">
								<?php esc_html_e( 'Monday to Saturday ( 10:00 AM to 7:00 PM)', 'manamchocolate' ); ?>
							</p>
						</div>

						<!-- Stores List -->
						<div class="contact-stores-list">
							<!-- Store 1: Delhi -->
							<div class="store-item footer-store-item">
								<h4 class="store-name footer-store-name"><?php esc_html_e( 'Manam Chocolate, Delhi', 'manamchocolate' ); ?></h4>
								<p class="store-address footer-store-address"><?php esc_html_e( 'Eldeco Center, Saket, New Delhi', 'manamchocolate' ); ?></p>
								<p class="store-phone footer-store-phone"><a href="tel:+918977760769" class="contact-link footer-contact-link">+91 8977760769</a></p>
							</div>

							<!-- Store 2: Hyderabad Karkhana -->
							<div class="store-item footer-store-item">
								<h4 class="store-name footer-store-name"><?php esc_html_e( 'Manam Chocolate Karkhana', 'manamchocolate' ); ?></h4>
								<p class="store-address footer-store-address"><?php esc_html_e( 'Rd No. 12, Banjara Hills, Hyderabad', 'manamchocolate' ); ?></p>
								<p class="store-phone footer-store-phone"><a href="tel:+918121031763" class="contact-link footer-contact-link">+91 8121031763</a></p>
							</div>

							<!-- Store 3: Hyderabad Beverage Bar -->
							<div class="store-item footer-store-item">
								<h4 class="store-name footer-store-name"><?php esc_html_e( 'Manam Chocolate Beverage Bar', 'manamchocolate' ); ?></h4>
								<p class="store-address footer-store-address"><?php esc_html_e( 'Elixir Tower, Sattva Knowledge City, Hyderabad', 'manamchocolate' ); ?></p>
								<p class="store-phone footer-store-phone"><a href="tel:+918977760767" class="contact-link footer-contact-link">+91 8977760767</a></p>
							</div>

							<!-- Store 4: New Delhi Beverage Bar -->
							<div class="store-item footer-store-item">
								<h4 class="store-name footer-store-name"><?php esc_html_e( 'Manam Chocolate Beverage Bar', 'manamchocolate' ); ?></h4>
								<p class="store-address footer-store-address"><?php esc_html_e( 'GFK 17, Ground Floor, DLF Promenade Mall, Vasant Kunj, New Delhi (Next to Zara)', 'manamchocolate' ); ?></p>
								<p class="store-phone footer-store-phone"><a href="tel:+918121542288" class="contact-link footer-contact-link">+91 8121542288</a></p>
							</div>
						</div><!-- .contact-stores-list -->
					</div><!-- .footer-contact-content -->
				</div><!-- .footer-col-contact -->

				<!-- Column 4: Origin Emblem (Desktop) -->
				<div class="footer-col footer-col-emblem">
					<div class="footer-emblem-wrap">
						<img
							src="<?php echo esc_url( $theme_uri . '/assets/images/cacao-origin-seal.png' ); ?>"
							alt="<?php esc_attr_e( 'Manam Chocolate - Indian Origin West Godavari Cacao Emblem', 'manamchocolate' ); ?>"
							width="333"
							height="381"
							loading="lazy"
							class="footer-emblem-img"
						/>
					</div>
				</div><!-- .footer-col-emblem -->

			</div><!-- .footer-main-row -->

			<!-- Bottom Legal & Social Area -->
			<div class="footer-bottom-row">
				<!-- Mobile Brand Logo -->
				<div class="footer-mobile-logo-wrap">
					<img
						src="<?php echo esc_url( $theme_uri . '/assets/images/manam-and-distinct.svg' ); ?>"
						alt="<?php esc_attr_e( 'Manam Chocolate and Distinct Origins', 'manamchocolate' ); ?>"
						width="260"
						height="53"
						loading="lazy"
						class="footer-mobile-logo"
					/>
				</div>

				<div class="footer-bottom-inner">
					<div class="footer-copyright">
						<?php esc_html_e( 'COPYRIGHT © 2026 DISTINCT ORIGINS', 'manamchocolate' ); ?>
					</div>

					<!-- Social Media Links -->
					<div class="footer-social-links" aria-label="<?php esc_attr_e( 'Social Media Links', 'manamchocolate' ); ?>">
						<!-- Instagram -->
						<a href="https://www.instagram.com/manamchocolate/" class="social-icon-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Manam Chocolate on Instagram', 'manamchocolate' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
								<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
								<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
							</svg>
						</a>
						<!-- Facebook -->
						<a href="https://www.facebook.com/manamchocolate/" class="social-icon-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Manam Chocolate on Facebook', 'manamchocolate' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
							</svg>
						</a>
						<!-- LinkedIn -->
						<a href="https://www.linkedin.com/company/manamchocolate/" class="social-icon-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Manam Chocolate on LinkedIn', 'manamchocolate' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
								<rect x="2" y="9" width="4" height="12"></rect>
								<circle cx="4" cy="4" r="2"></circle>
							</svg>
						</a>
						<!-- YouTube -->
						<a href="https://www.youtube.com/@manamchocolate" class="social-icon-link" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Manam Chocolate on YouTube', 'manamchocolate' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
								<polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"></polygon>
							</svg>
						</a>
					</div>

					<!-- Legal Links -->
					<div class="footer-legal-links">
						<a href="<?php echo esc_url( $home_url . 'terms-and-conditions/' ); ?>"><?php esc_html_e( 'TERMS & CONDITIONS', 'manamchocolate' ); ?></a>
						<span class="legal-divider" aria-hidden="true">|</span>
						<a href="<?php echo esc_url( $home_url . 'privacy-policy/' ); ?>"><?php esc_html_e( 'PRIVACY POLICY', 'manamchocolate' ); ?></a>
					</div>
				</div><!-- .footer-bottom-inner -->
			</div><!-- .footer-bottom-row -->

		</div><!-- .site-container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
