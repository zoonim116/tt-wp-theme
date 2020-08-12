<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$html = '<div class="cart-slider-item">';
if ( $product->get_image_id() ) {
	$html .= wc_get_gallery_image_html( $post_thumbnail_id, true );
} elseif(get_post_meta($product->get_id(), 'remote_image', true)) {
	$html .= sprintf( '<img src="%s" alt="" />', esc_url( get_post_meta($product->get_id(), 'remote_image', true) ));
} else {
	$html .= sprintf( '<img src="%s" alt="%s" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
}
$html .= '</div>';
?>
<div class="card-slider">
    <div>
        <div class="slider-for">
            <?php echo $html; ?>
            <?php wc_get_template( 'single-product/product-thumbnails.php' ); ?>
        </div>
        <div class="arrows-slider">
            <span class="next">
                <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12.9998 21L3.24975 11.5L12.9998 2L11.2498 0.25L-0.000250354 11.5L11.2498 22.75L12.9998 21Z" fill="black"/>
                </svg>
            </span>
            <span class="prev">
                <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M6.10352e-05 2L9.75006 11.5L6.10352e-05 21L1.75006 22.75L13.0001 11.5L1.75006 0.249988L6.10352e-05 2Z" fill="black"/>
                </svg>
            </span>
        </div>
    </div>
    <div>
        <div class="slider-nav">
            <?php echo $html; ?>
            <?php wc_get_template( 'single-product/product-full-images.php' ); ?>
        </div>
    </div>
</div>

