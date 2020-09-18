<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
$cart = $_SESSION['tt_cart'];
if (is_null($cart)) {
	$cart = Product::get_cart();
	$_SESSION['tt_cart'] = $cart;
}
do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
    <div class="sub-cart__title">
        <span class="sub-cart__title-big">הלכלכ</span>
        <?php echo WC()->cart->get_cart_contents_count(); ?> <span>םיטירפ</span>
    </div>
	<ul class="woocommerce-mini-cart cart_list product_list_widget sub-cart__list <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			$wiz_product = null;
			foreach ($cart->OutTab as $product_in_cart) {
				if ($product_in_cart[1] == $_product->get_sku()) {
					$wiz_product = $product_in_cart;
				}
			}
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', $wiz_product['5'], $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

				?>
				<li class="sub-cart__item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <a class="sub-cart__prod-img" href="<?php echo esc_url( $product_permalink ); ?>">
                        <img src="<?php echo get_post_meta($product_id, 'remote_image', true); ?>">
                    </a>
                    <div class="sub-cart__prod-info">
                        <a href="#" class="sub-cart__prod-name"><?php echo $product_name; ?></a>
                        <div class="sub-cart__prod-price">₪<?php echo $product_price; ?></div>
                    </div>
                    <?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="sub-cart__delete remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M14.6244 3.3756H13.4995V16.3126C13.4995 16.5469 13.4555 16.7667 13.3676 16.9717C13.2797 17.1768 13.1596 17.3555 13.0073 17.5078C12.8549 17.6602 12.6762 17.7803 12.4712 17.8682C12.2661 17.9561 12.0464 18 11.812 18H2.81239C2.57802 18 2.3583 17.9561 2.15323 17.8682C1.94816 17.7803 1.76946 17.6602 1.61712 17.5078C1.46478 17.3555 1.34467 17.1768 1.25678 16.9717C1.1689 16.7667 1.12495 16.5469 1.12495 16.3126V3.3756H0V2.25064H4.49982V1.12569C4.49982 0.96749 4.52911 0.821012 4.5877 0.686251C4.6463 0.551491 4.72539 0.434308 4.825 0.334703C4.9246 0.235098 5.04472 0.15307 5.18534 0.0886194C5.32596 0.0241689 5.47243 -0.00512674 5.62477 0.000732392H8.99963C9.15783 0.000732392 9.30431 0.0300281 9.43907 0.0886194C9.57383 0.147211 9.69101 0.226309 9.79062 0.325914C9.89022 0.42552 9.97225 0.545632 10.0367 0.686251C10.1012 0.826871 10.1304 0.973349 10.1246 1.12569V2.25064H14.6244V3.3756ZM5.62477 2.25064H8.99963V1.12569H5.62477V2.25064ZM12.3745 3.3756H2.24991V16.3126C2.24991 16.4649 2.30557 16.5967 2.41689 16.7081C2.52822 16.8194 2.66005 16.875 2.81239 16.875H11.812C11.9644 16.875 12.0962 16.8194 12.2075 16.7081C12.3188 16.5967 12.3745 16.4649 12.3745 16.3126V3.3756ZM5.62477 14.6251H4.49982V5.6255H5.62477V14.6251ZM7.87468 14.6251H6.74973V5.6255H7.87468V14.6251ZM10.1246 14.6251H8.99963V5.6255H10.1246V14.6251Z" fill="#C2D7F8"/>
										</svg></a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_attr__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						),
						$cart_item_key
					);
					?>
					<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php //echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>
    <div class="sub-cart__footer">
        <div class="sub-cart__footer-header">
            <div class="sub-cart__footer-total">יפוס ריחמ</div>
            <div class="sub-cart__footer-price" ><?php echo WC()->cart->get_cart_total(); ?></div>
        </div>
        <div class="sub-cart__footer-button">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-white">הלגעל ףסוה</a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-blue button">םלשל</a>
        </div>
    </div>
<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
