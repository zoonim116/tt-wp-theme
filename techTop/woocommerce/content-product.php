<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( 'catalog-products-item', $product ); ?> >
    <div class="item-wrap">
        <div class="item-img">
           <a href="<?php echo get_permalink();?>">
                <?php do_action('tt_loop_product_thumbnail'); ?>
           </a>
            <div class="btn-group">
                <?php
                /**
                 * Hook: woocommerce_after_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                if ($product->get_stock_quantity() > 0 && is_user_logged_in()) {
	                do_action( 'woocommerce_after_shop_loop_item' );
                } else {
                ?>
                    <a href="<?php echo home_url('resellers'); ?>"class="btn btn-blue ">להוסיף לתיק</a>
                <?php } ?>
                <a href="#" data-sku="<?php echo $product->get_sku(); ?>" class="like">
                    <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.89757 2.33031C8.83939 2.33119 10.4185 5.41921 11.0976 6.78183C11.7794 5.41301 13.3421 2.33915 16.303 2.33915C18.1739 2.33915 20.1885 3.49738 20.1885 6.03947C20.1885 9.08501 15.8758 12.9862 11.0976 17.5421C6.31757 12.9844 2.00666 9.08413 2.00666 6.03947C2.00666 3.67169 3.79302 2.32942 5.89757 2.33031ZM5.89848 0.560669C3.00484 0.560669 0.188477 2.49577 0.188477 6.03947C0.188477 10.1636 5.25211 14.3807 11.0976 20.0267C16.943 14.3807 22.0067 10.1636 22.0067 6.03947C22.0067 2.49046 19.1912 0.569517 16.303 0.569517C14.2994 0.569517 12.2612 1.4915 11.0976 3.43456C9.92939 1.48265 7.89575 0.560669 5.89848 0.560669Z" fill="#767676"></path>
                        <path d="M5.89359 0.244507C2.99996 0.244507 0.183594 2.23269 0.183594 5.8736C0.183594 10.1109 5.24723 14.4436 11.0927 20.2445C16.9381 14.4436 22.0018 10.1109 22.0018 5.8736C22.0018 2.22723 19.1863 0.253598 16.2981 0.253598C14.2945 0.253598 12.2563 1.20087 11.0927 3.19723C9.9245 1.19178 7.89087 0.244507 5.89359 0.244507Z" fill="#C2D7F8" class="full-fill"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="item-info">
           <?php do_action( 'tt_shop_loop_item_title' );  ?>
            <div class="item-flex">
                <div class="item-price">
	                <?php if (is_user_logged_in()): ?>
                        <p class="old-price">NIS <?php echo $product->get_price(); ?></p>
	                <?php endif; ?>
                    <?php
                    /**
                     * Hook: woocommerce_after_shop_loop_item_title.
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
