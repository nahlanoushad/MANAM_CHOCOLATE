<?php
/**
 * Template Name: Shipping Policy Page
 * Description: Exact recreation of the official Manam Chocolate Shipping Policy.
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
			<span class="breadcrumb-current"><?php esc_html_e( 'Shipping policy', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. POLICY ARTICLE -->
	<article class="policy-article-section">
		<div class="site-container policy-container">
			<header class="policy-header text-center" data-reveal="up">
				<h1 class="policy-title"><?php esc_html_e( 'Shipping policy', 'manamchocolate' ); ?></h1>
			</header>

			<div class="policy-body-content" data-reveal="up">
				<p>Orders placed before 7 pm will be dispatched within 24 hours and delivered.</p>

				<p>Orders placed after 7 pm will be dispatched within 48 hours and delivered within 24-48 hours from dispatch.</p>

				<p>Orders received on Saturday after 7 pm will be dispatched on Monday.</p>

				<p>At times, the delivery may take longer than expected due to unavoidable circumstances, (if any). We do not guarantee delivery time for local delivery during festivals. For outstation, since we use a courier service, we do guarantee delivery time.</p>

				<p>Please note that the delivery timing depends on several factors like weather, unforeseen events, traffic conditions and other special events. However, we will always endeavour to complete the delivery as early as possible and keep you updated in case of any changes. We are not responsible for any delay caused by any unforeseen time lags by the courier companies in delivering the parcels to the customer, or if the customer is not available at the time of delivery. In situations outside of Distinct Origins Pvt Ltd. control (Product unavailability, public holidays, Strikes, Natural Disasters etc.), there could be a delay in shipping the Order.</p>

				<p>Products will be delivered to the address mentioned by the customer while placing the order. Distinct Origins Pvt Ltd. control (Product unavailability, public holidays, Strikes, Natural Disasters) will not be responsible for delivery delays in case an incorrect or incomplete address is provided. Distinct Origins Pvt Ltd. will not deliver to post-box-only addresses. For any changes to the Order, please contact us by phone or email as soon as possible. Distinct Origins Pvt Ltd. will try and accommodate the changes as much as possible depending on order status and other parameters. No changes will be accepted once the order has been shipped.</p>

				<h2 class="policy-subheading"><?php esc_html_e( 'SHIPMENT TRACKING', 'manamchocolate' ); ?></h2>

				<p>You will get an email with the tracking details as soon as the product is shipped.</p>

				<p>Any charges like GST, Customs Tax, Customs Excise Duty, Service Tax or any Direct or Indirect taxes, post shipment, in any Country, State/Province, City/Town, or District, both National and International, will be liable to the consignee/customer.</p>
			</div>
		</div>
	</article>

</main><!-- #primary -->

<?php
get_footer();

