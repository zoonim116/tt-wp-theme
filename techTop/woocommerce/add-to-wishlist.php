<?php
/**
 * Add to wishlist template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist_url              string Url to wishlist page
 * @var $exists                    bool Whether current product is already in wishlist
 * @var $show_exists               bool Whether to show already in wishlist link on multi wishlist
 * @var $show_count                bool Whether to show count of times item was added to wishlist
 * @var $product_id                int Current product id
 * @var $product_type              string Current product type
 * @var $label                     string Button label
 * @var $browse_wishlist_text      string Browse wishlist text
 * @var $already_in_wishslist_text string Already in wishlist text
 * @var $product_added_text        string Product added text
 * @var $icon                      string Icon for Add to Wishlist button
 * @var $link_classes              string Classed for Add to Wishlist button
 * @var $available_multi_wishlist  bool Whether add to wishlist is available or not
 * @var $disable_wishlist          bool Whether wishlist is disabled or not
 * @var $template_part             string Template part
 * @var $container_classes         string Container classes
 * @var $fragment_options          array Array of data to send through ajax calls
 * @var $ajax_loading              bool Whether ajax loading is enabled or not
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?> <?php echo esc_attr( $container_classes ); ?> wishlist-fragment on-first-load" data-fragment-ref="<?php echo esc_attr( $product_id ); ?>" data-fragment-options="<?php echo esc_attr( json_encode( $fragment_options ) ); ?>">
    <?php if( ! $ajax_loading ): ?>
		<?php if( ! ( $disable_wishlist && ! is_user_logged_in() ) ): ?>
            <a href="<?php echo esc_url( add_query_arg( array( 'wishlist_notice' => 'true', 'add_to_wishlist' => $product_id ), get_permalink( wc_get_page_id( 'myaccount' ) ) ) )?>" rel="nofollow" class="disabled_item <?php echo str_replace( array( 'add_to_wishlist', 'single_add_to_wishlist' ), '', $link_classes ) ?>" >
                <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.89757 2.33031C8.83939 2.33119 10.4185 5.41921 11.0976 6.78183C11.7794 5.41301 13.3421 2.33915 16.303 2.33915C18.1739 2.33915 20.1885 3.49738 20.1885 6.03947C20.1885 9.08501 15.8758 12.9862 11.0976 17.5421C6.31757 12.9844 2.00666 9.08413 2.00666 6.03947C2.00666 3.67169 3.79302 2.32942 5.89757 2.33031ZM5.89848 0.560669C3.00484 0.560669 0.188477 2.49577 0.188477 6.03947C0.188477 10.1636 5.25211 14.3807 11.0976 20.0267C16.943 14.3807 22.0067 10.1636 22.0067 6.03947C22.0067 2.49046 19.1912 0.569517 16.303 0.569517C14.2994 0.569517 12.2612 1.4915 11.0976 3.43456C9.92939 1.48265 7.89575 0.560669 5.89848 0.560669Z" fill="#767676"></path>
                    <path d="M5.89359 0.244507C2.99996 0.244507 0.183594 2.23269 0.183594 5.8736C0.183594 10.1109 5.24723 14.4436 11.0927 20.2445C16.9381 14.4436 22.0018 10.1109 22.0018 5.8736C22.0018 2.22723 19.1863 0.253598 16.2981 0.253598C14.2945 0.253598 12.2563 1.20087 11.0927 3.19723C9.9245 1.19178 7.89087 0.244507 5.89359 0.244507Z" fill="#C2D7F8" class="full-fill"/>
                </svg>
            </a>

		<?php endif; ?>
	<?php endif; ?>
</div>