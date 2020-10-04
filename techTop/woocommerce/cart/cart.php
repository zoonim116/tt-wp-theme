<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
$cart = $_SESSION['tt_cart'];
do_action( 'woocommerce_before_main_content' );
do_action( 'woocommerce_before_cart' ); ?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	
	<h2 class="sub-title">הלכלכ</h2>
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<div class="shop_table-wrapp">
	
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<!-- <thead>
			<tr>
				<th class="product-remove">&nbsp;</th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			</tr>
		</thead> -->
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				    $wiz_product = null;
				    foreach ($cart->OutTab as $product_in_cart) {
				        if ($product_in_cart[1] == $_product->get_sku()) {
                            $wiz_product = $product_in_cart;
                        }
                    }
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link0',
									sprintf(
										'<a href="%s" aria-label="%s" data-product_id="%s" data-product_sku="%s"> <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M19.4992 4.50079H17.9993V21.7501C17.9993 22.0626 17.9407 22.3555 17.8235 22.629C17.7063 22.9024 17.5462 23.1407 17.343 23.3438C17.1399 23.5469 16.9017 23.707 16.6282 23.8242C16.3548 23.9414 16.0618 24 15.7494 24H3.74985C3.43736 24 3.1444 23.9414 2.87098 23.8242C2.59755 23.707 2.35928 23.5469 2.15616 23.3438C1.95305 23.1407 1.7929 22.9024 1.67571 22.629C1.55853 22.3555 1.49994 22.0626 1.49994 21.7501V4.50079H0V3.00085H5.99976V1.50092C5.99976 1.28999 6.03882 1.09468 6.11694 0.915002C6.19506 0.735322 6.30052 0.579078 6.43333 0.446271C6.56614 0.313464 6.72629 0.204093 6.91378 0.118159C7.10127 0.0322252 7.29658 -0.00683566 7.49969 0.000976523H11.9995C12.2104 0.000976523 12.4057 0.0400374 12.5854 0.118159C12.7651 0.196281 12.9213 0.301746 13.0542 0.434553C13.187 0.56736 13.2963 0.72751 13.3823 0.915002C13.4682 1.10249 13.5073 1.2978 13.4995 1.50092V3.00085H19.4992V4.50079ZM7.49969 3.00085H11.9995V1.50092H7.49969V3.00085ZM16.4993 4.50079H2.99988V21.7501C2.99988 21.9532 3.07409 22.129 3.22253 22.2774C3.37096 22.4258 3.54673 22.5001 3.74985 22.5001H15.7494C15.9525 22.5001 16.1283 22.4258 16.2767 22.2774C16.4251 22.129 16.4993 21.9532 16.4993 21.7501V4.50079ZM7.49969 19.5002H5.99976V7.50067H7.49969V19.5002ZM10.4996 19.5002H8.99963V7.50067H10.4996V19.5002ZM13.4995 19.5002H11.9995V7.50067H13.4995V19.5002Z" fill="#C2D7F8"/>
										</svg>
										</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>

						<td class="product-thumbnail">
						<?php

						$thumbnail = '<img width="369" height="369" class="woocommerce-placeholder wp-post-image" src="'.get_post_meta($_product->get_id(), 'remote_image', true).'">';


						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						<span class="woocommerce-Price-currencySymbol">
							<?php
                                echo $wiz_product['5'];
							?>
							₪
							</span>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $wiz_product[4],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>
						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
						<span class="woocommerce-Price-currencySymbol">
							<?php
//								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                echo $wiz_product[8];
							?>
							₪
						</span>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<tr>
					<td style="text-align: right;" colspan="3">
						<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button alt wc-forward checkout-button-custom">
						התקדם לנקודת הביקורת
						</a>
					</td>
					<td></td>
					<td style="padding 10px 15px;  font-weight: 500; font-size: 18px; text-align: center; line-height: 68px;" class="">יפוס ריחמ</td>
					<td style="color: #0060FE;" class="product-subtotal"><?php wc_cart_totals_order_total_html(); ?></td>
					
					
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php //do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		//do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
