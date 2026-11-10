<?php
/**
 * Template Name: Refund Policy Page
 * Description: Exact recreation of the official Manam Chocolate Refund Policy.
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

get_header();

$home_url = home_url( '/' );
?>

<main id="primary" class="site-main policy-page-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'Refund policy', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. POLICY ARTICLE -->
	<article class="policy-article-section">
		<div class="site-container policy-container">
			<header class="policy-header text-center" data-reveal="up">
				<h1 class="policy-title"><?php esc_html_e( 'Refund policy', 'manamchocolate' ); ?></h1>
			</header>

			<div class="policy-body-content" data-reveal="up">
				<h2 class="policy-subheading"><?php esc_html_e( 'CANCELLATIONS & RETURNS', 'manamchocolate' ); ?></h2>

				<p>
					For Refund/Replacement and Cancellation requests, please contact the Distinct Origins Pvt Ltd. Customer Service team at 
					<a href="tel:18001233110" class="policy-phone-link"><strong>1800 1233110</strong></a> (9:00 am to 7:00 pm IST) or write an email to 
					<a href="mailto:care@manamchocolate.com" class="policy-email-link"><strong>care@manamchocolate.com</strong></a>.
				</p>

				<p>
					Cancellations will be considered only if the request is made within 24 hours of placing an order. Distinct Origins Pvt Ltd. will make a decision on the cancellation request based on the current order status among other factors. For example, if the order has already been shipped, it will not be possible to cancel the order.
				</p>

				<p>
					Cancellation requests will also not be approved for products that the Distinct Origins Pvt Ltd. marketing team has obtained for special occasions like Holi, Diwali, Valentine’s Day etc. These are limited-occasion offers and therefore cancellations are not possible.
				</p>

				<p>
					Refund/Replacement requests will be considered only if the request is made to the Distinct Origins Pvt Ltd. customer service team within 12 hours of receiving delivery of the item. The reasons for example could be an incorrect item was shipped, or the product has gone bad. It is the responsibility of the customer to provide adequate information (including photographs) to help Distinct Origins Pvt Ltd. make a decision. There will be no refund if the taste of the product is not to the customer’s liking or if the customer thinks it is not good enough as long as the product is within the expiry date.
				</p>

				<p>
					In case of receipt of a damaged product, please report the same to our Customer Service team within 12 hours of receipt of the shipment. The Customer should provide adequate information (including photographs) so Distinct Origins Pvt Ltd. can take it up with the Courier Company. Distinct Origins Pvt Ltd. will provide a refund/replacement to the customer in case of a positive decision.
				</p>

				<p>
					For product replacements, the customer will be shipped a new packet of the same product. In case the same product is not available, an equivalent product will be shipped after a discussion with the customer.
				</p>

				<p>
					Distinct Origins Pvt Ltd. will usually process refunds within 1-2 business days after a refund request is approved. The request is then passed on to our Payment Gateway partner; they have advised it takes them 7-10 business days to process the refund.
				</p>
			</div>
		</div>
	</article>

</main><!-- #primary -->

<?php
get_footer();

