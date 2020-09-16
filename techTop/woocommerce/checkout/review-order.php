<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ($_SESSION['tt_cart']) {
	$tt_cart = $_SESSION['tt_cart'];
}
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	
	
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$wiz_product = null;

			foreach ($tt_cart->OutTab as $product_in_cart) {
				if ($product_in_cart[1] == $_product->get_sku()) {
					$wiz_product = $product_in_cart;
				}
			}
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<a href="#" class="customer-order-img" style="background-color: red;">
						<img src="" alt="">
					</a>
					<div class="customer-order-wrap">
						<a href="#" class="product-name">
							<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
						<div class="product-total">
							<?php echo $wiz_product[8]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $wiz_product[4] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</div>
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
		<div class="promo-wrap">
			<label class="promo" for="promo">
			דוק
				<div class="promo-icon">
					<svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M16.0439 8.0083V18.9331H4.79395V15.5581H0.293945V0.933105H7.84375L11.2188 4.30811H12.3438L16.0439 8.0083ZM12.6689 7.68311H14.1191L12.6689 6.23291V7.68311ZM4.79395 4.30811H9.61914L7.36914 2.05811H1.41895V14.4331H4.79395V4.30811ZM14.9189 8.80811H11.5439V5.43311H5.91895V17.8081H14.9189V8.80811Z" fill="#0060FE"/>
					</svg>
					<input class="promo-field" type="text">
				</div>
			</label>
		</div>
		<div class="customer-order-total">
			<div class="customer-order-total__title">מ"עמ ללוכ אל ריחמ</div>
			<div class="customer-order-total"><?php wc_cart_totals_order_total_html(); ?></div>
		</div>
	<div>

		

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>



		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>


	</div>
</div>
