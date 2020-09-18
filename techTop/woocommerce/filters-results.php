<?php extract($template_args); ?>
<div class="catalog-products-item product type-product post-10496 status-publish first instock product_cat-1009 shipping-taxable purchasable product-type-simple">
    <div class="item-wrap">
        <a href="<?php echo get_permalink( $product->get_id() );?>" class="item-img">
            <img src="<?php echo get_post_meta($product->get_ID(), 'remote_image', true); ?>">
            <div class="btn-group">
                <a href="?add-to-cart=<?php echo $product->get_ID(); ?>" data-quantity="1" class="btn btn-blue button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_ID(); ?>" data-product_sku="<?php echo $product->get_sku();?>" aria-label="Add “Product” to your cart" rel="nofollow">להוסיף לתיק</a>                <a href="#" data-sku="<?php echo $product->get_sku(); ?>" class="like">
                    <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.89757 2.33031C8.83939 2.33119 10.4185 5.41921 11.0976 6.78183C11.7794 5.41301 13.3421 2.33915 16.303 2.33915C18.1739 2.33915 20.1885 3.49738 20.1885 6.03947C20.1885 9.08501 15.8758 12.9862 11.0976 17.5421C6.31757 12.9844 2.00666 9.08413 2.00666 6.03947C2.00666 3.67169 3.79302 2.32942 5.89757 2.33031ZM5.89848 0.560669C3.00484 0.560669 0.188477 2.49577 0.188477 6.03947C0.188477 10.1636 5.25211 14.3807 11.0976 20.0267C16.943 14.3807 22.0067 10.1636 22.0067 6.03947C22.0067 2.49046 19.1912 0.569517 16.303 0.569517C14.2994 0.569517 12.2612 1.4915 11.0976 3.43456C9.92939 1.48265 7.89575 0.560669 5.89848 0.560669Z" fill="#767676"></path>
                        <path d="M5.89359 0.244507C2.99996 0.244507 0.183594 2.23269 0.183594 5.8736C0.183594 10.1109 5.24723 14.4436 11.0927 20.2445C16.9381 14.4436 22.0018 10.1109 22.0018 5.8736C22.0018 2.22723 19.1863 0.253598 16.2981 0.253598C14.2945 0.253598 12.2563 1.20087 11.0927 3.19723C9.9245 1.19178 7.89087 0.244507 5.89359 0.244507Z" fill="#C2D7F8" class="full-fill"></path>
                    </svg>
                </a>
            </div>
        </a>
        <div class="item-info">
            <p class="title woocommerce-loop-product__title"><a href="<?php echo get_permalink( $product->get_id() );?>"><?php echo $product->get_name(); ?></a></p>
            <div class="item-flex">
                <div class="item-description">
                </div>
                <div class="item-price">
                    <?php if (is_user_logged_in()): ?>
                        <p class="old-price">NIS <?php echo $product->get_price(); ?></p>
                    <?php endif; ?>
                    <p><?php echo $info[6]; ?></p>                </div>
            </div>
        </div>
    </div>
</div>
