<?php 
    if (is_null($_SESSION['wishlist'])) {
        $wishlist_data = User::get_wishlist('ASC');
        $_SESSION['wishlist'] = $wishlist;
    } else {
        $wishlist_data = $_SESSION['wishlist'];
    }
 ?>
<?php if (count($wishlist_data->OutTab) > 0): ?>
    <div class="sub-cart__title">
        <span class="sub-cart__title-big">הלכלכ</span>
        <?php echo count($wishlist_data->OutTab) ?> <span>םיטירפ</span>
    </div>
    <ul class="woocommerce-mini-cart wish_list product_list_widget sub-cart__list ">
        <?php foreach ($wishlist_data->OutTab as $item): ?>
            <?php $product_id = wc_get_product_id_by_sku($item[1]); ?>
            <?php if ($product_id): ?>
                <?php $product = wc_get_product($product_id); ?>
                <li class="sub-cart__item woocommerce-mini-cart-item mini_cart_item">
                    <a class="sub-cart__prod-img"
                       href="<?php echo get_permalink( $product->get_id() ); ?>">
                        <img src="<?php echo get_post_meta($product->get_id(), 'remote_image', true); ?>">
                    </a>
                    <div class="sub-cart__prod-info">
                        <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="sub-cart__prod-name"><?php echo $product->get_name(); ?></a>
                        <div class="sub-cart__prod-price">₪<?php echo $item['5']; ?></div>
                    </div>
                    <a href="#" data-sku="<?php echo $item[1]; ?>"
                       class="sub-cart__delete remove remove_from_cart_button" aria-label="הסר פריט זה" data-product_id="13477"
                       data-cart_item_key="dbc50898cf582dfebd6d7adf4eaf9eb6" data-product_sku="28305 9812">
                        <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6244 3.3756H13.4995V16.3126C13.4995 16.5469 13.4555 16.7667 13.3676 16.9717C13.2797 17.1768 13.1596 17.3555 13.0073 17.5078C12.8549 17.6602 12.6762 17.7803 12.4712 17.8682C12.2661 17.9561 12.0464 18 11.812 18H2.81239C2.57802 18 2.3583 17.9561 2.15323 17.8682C1.94816 17.7803 1.76946 17.6602 1.61712 17.5078C1.46478 17.3555 1.34467 17.1768 1.25678 16.9717C1.1689 16.7667 1.12495 16.5469 1.12495 16.3126V3.3756H0V2.25064H4.49982V1.12569C4.49982 0.96749 4.52911 0.821012 4.5877 0.686251C4.6463 0.551491 4.72539 0.434308 4.825 0.334703C4.9246 0.235098 5.04472 0.15307 5.18534 0.0886194C5.32596 0.0241689 5.47243 -0.00512674 5.62477 0.000732392H8.99963C9.15783 0.000732392 9.30431 0.0300281 9.43907 0.0886194C9.57383 0.147211 9.69101 0.226309 9.79062 0.325914C9.89022 0.42552 9.97225 0.545632 10.0367 0.686251C10.1012 0.826871 10.1304 0.973349 10.1246 1.12569V2.25064H14.6244V3.3756ZM5.62477 2.25064H8.99963V1.12569H5.62477V2.25064ZM12.3745 3.3756H2.24991V16.3126C2.24991 16.4649 2.30557 16.5967 2.41689 16.7081C2.52822 16.8194 2.66005 16.875 2.81239 16.875H11.812C11.9644 16.875 12.0962 16.8194 12.2075 16.7081C12.3188 16.5967 12.3745 16.4649 12.3745 16.3126V3.3756ZM5.62477 14.6251H4.49982V5.6255H5.62477V14.6251ZM7.87468 14.6251H6.74973V5.6255H7.87468V14.6251ZM10.1246 14.6251H8.99963V5.6255H10.1246V14.6251Z"
                                  fill="#C2D7F8"></path>
                        </svg>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
 <?php endif; ?>