<?php
/**
 * Template Name: Track Your Order Page
 * Description: Recreates the official Manam Chocolate Track Your Order destination.
 *
 * Provides a genuine WooCommerce order lookup interface styled matching Shipway,
 * accompanied by honest courier tracking disclosure and customer care direct links.
 *
 * @package ManamChocolate
 * @since 1.5.0
 */

get_header();

$home_url = home_url( '/' );

$order_id     = isset( $_REQUEST['orderid'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['orderid'] ) ) : '';
$order_email  = isset( $_REQUEST['order_email'] ) ? sanitize_email( wp_unslash( $_REQUEST['order_email'] ) ) : '';
$order_status = null;
$error_msg    = '';

if ( ! empty( $order_id ) && ! empty( $order_email ) ) {
	$order = wc_get_order( absint( $order_id ) );
	if ( $order && strtolower( trim( $order->get_billing_email() ) ) === strtolower( trim( $order_email ) ) ) {
		$order_status = array(
			'id'           => $order->get_id(),
			'status'       => wc_get_order_status_name( $order->get_status() ),
			'date_created' => wc_format_datetime( $order->get_date_created() ),
			'items_count'  => $order->get_item_count(),
			'total'        => $order->get_formatted_order_total(),
		);
	} else {
		$error_msg = __( 'Sorry, we could not find an order matching that Order ID and Billing Email. Please double-check your order confirmation email.', 'manamchocolate' );
	}
} elseif ( ! empty( $_REQUEST['submitted'] ) ) {
	$error_msg = __( 'Please enter both your Order ID and Billing Email address to check your order status.', 'manamchocolate' );
}
?>

<main id="primary" class="site-main track-order-main">

	<!-- 1. BREADCRUMBS -->
	<div class="site-container">
		<nav class="product-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'manamchocolate' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Home', 'manamchocolate' ); ?></a>
			<span class="breadcrumb-separator">/</span>
			<span class="breadcrumb-current"><?php esc_html_e( 'Track Your Order', 'manamchocolate' ); ?></span>
		</nav>
	</div>

	<!-- 2. TRACK ORDER CONTAINER -->
	<section class="track-order-section">
		<div class="site-container track-container">
			<header class="track-header text-center" data-reveal="up">
				<h1 class="track-title"><?php esc_html_e( 'Track Your Order', 'manamchocolate' ); ?></h1>
				<p class="track-subtitle">
					<?php esc_html_e( 'Enter your order details below to check live preparation and dispatch status.', 'manamchocolate' ); ?>
				</p>
			</header>

			<div class="track-card-box" data-reveal="up">
				<form method="get" action="" class="track-order-form">
					<input type="hidden" name="submitted" value="1" />

					<div class="track-fields-grid">
						<div class="form-field-group">
							<label for="track-order-id" class="form-field-label"><?php esc_html_e( 'Order ID / Number', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input
								type="text"
								id="track-order-id"
								name="orderid"
								class="form-field-input"
								placeholder="<?php esc_attr_e( 'e.g. 1042', 'manamchocolate' ); ?>"
								value="<?php echo esc_attr( $order_id ); ?>"
								required
							/>
						</div>

						<div class="form-field-group">
							<label for="track-order-email" class="form-field-label"><?php esc_html_e( 'Billing Email Address', 'manamchocolate' ); ?> <span class="required">*</span></label>
							<input
								type="email"
								id="track-order-email"
								name="order_email"
								class="form-field-input"
								placeholder="<?php esc_attr_e( 'Email used during checkout', 'manamchocolate' ); ?>"
								value="<?php echo esc_attr( $order_email ); ?>"
								required
							/>
						</div>
					</div>

					<div class="track-submit-wrap">
						<button type="submit" class="button button--primary track-submit-btn">
							<span><?php esc_html_e( 'TRACK ORDER', 'manamchocolate' ); ?></span>
						</button>
					</div>
				</form>

				<!-- Result or Error Output -->
				<?php if ( ! empty( $error_msg ) ) : ?>
					<div class="track-alert track-alert--error" role="alert">
						<p><?php echo esc_html( $error_msg ); ?></p>
					</div>
				<?php elseif ( ! empty( $order_status ) ) : ?>
					<div class="track-result-card" role="region" aria-label="<?php esc_attr_e( 'Order Status', 'manamchocolate' ); ?>">
						<div class="track-result-header">
							<span class="track-result-tag"><?php esc_html_e( 'ORDER VERIFIED', 'manamchocolate' ); ?></span>
							<h3 class="track-result-number">#<?php echo esc_html( $order_status['id'] ); ?></h3>
						</div>
						<div class="track-result-details">
							<p><strong><?php esc_html_e( 'Current Status:', 'manamchocolate' ); ?></strong> <span class="status-badge"><?php echo esc_html( $order_status['status'] ); ?></span></p>
							<p><strong><?php esc_html_e( 'Order Date:', 'manamchocolate' ); ?></strong> <?php echo esc_html( $order_status['date_created'] ); ?></p>
							<p><strong><?php esc_html_e( 'Total Items:', 'manamchocolate' ); ?></strong> <?php echo esc_html( $order_status['items_count'] ); ?></p>
							<p><strong><?php esc_html_e( 'Total Amount:', 'manamchocolate' ); ?></strong> <?php echo wp_kses_post( $order_status['total'] ); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<!-- Honest Third-Party Integration Disclosure -->
				<div class="track-disclosure-box">
					<div class="disclosure-header">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
						<strong><?php esc_html_e( 'Courier Shipping & Tracking Note', 'manamchocolate' ); ?></strong>
					</div>
					<p class="disclosure-text">
						<?php esc_html_e( 'On the live Manam Chocolate website, shipment tracking integrates with the third-party Shipway courier tracking network. For all outstation deliveries, SMS and email notifications with direct live-tracking URLs (Blue Dart / Delhivery) are dispatched automatically once your chocolate leaves our temperature-controlled facility.', 'manamchocolate' ); ?>
					</p>
					<p class="disclosure-contact">
						<?php esc_html_e( 'Need immediate assistance with a delivery? Contact Customer Care at', 'manamchocolate' ); ?>
						<a href="tel:+917331100776">+91 73311 00776</a> <?php esc_html_e( 'or email', 'manamchocolate' ); ?> <a href="mailto:care@manamchocolate.com">care@manamchocolate.com</a>.
					</p>
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();

