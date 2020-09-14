<?php

/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$videos = carbon_get_post_meta($product->get_ID(), 'crb_product_videos');

if ( $videos) {

	foreach ( $videos as $video ) {

		$full_src = wp_get_attachment_image_src( $video['crb_video_thumbnail'], 'full' );

		$image =  wp_get_attachment_image(
			$video['crb_video_thumbnail'],
			$video['crb_video_thumbnail'],
			false,
			apply_filters(
				'woocommerce_gallery_image_html_attachment_image_params',
				array(
					'data-src'                => esc_url( $full_src[0] ),
				),
				$video['crb_video_thumbnail'],
				'full'
			)
		);
		echo '<div class="cart-slider-item">';
		echo $image;
		echo '</div>';
	}
}

