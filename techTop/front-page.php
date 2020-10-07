<?php get_header('home'); ?>
<?php get_search_form(); ?>
<section class="home-slider">
    <?php foreach (carbon_get_post_meta(get_the_ID(), 'crb_top_slider') as $item): ?>
        <div class="home-slider-item" style="background-image: url('<?php echo $item['crb_ts_background']; ?>');">
            <div class="container">
                <div class="columns is-mobile">
                    <div class="column is-10 home-slider-title">
                        <?php echo apply_filters( 'the_content', $item['crb_ts_description'] ); ?>
                        <?php if(!is_wp_error(get_term_link($item['crb_ts_category'][0]['id']))): ?>
                            <a href="<?php echo get_term_link($item['crb_ts_category'][0]['id']); ?>" class="btn btn-blue">צפה בקטלוג</a>
                        <?php endif; ?>
                    </div>
                    <!-- <div class="column is-2 col-products"> -->
                        <!-- <span><span><?php //echo $item['crb_ts_product_count']?></span>מוצרים</span> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<section class="home-review">
    <div class="top-img">
        <img src="<?php echo get_template_directory_uri()?>/images/top-img.png">
    </div>
    <div class="container">
        <h3>‎טקטופ היבואן הגדול בישראל לפתרונות אודיו, מולטימדיה ותאורה מקצועיים</h3>
        <p class="home-review__subTitle">מגוון רחב של מותגים בינלאומיים מהמובילים בעולם, המספקים פתרונות להגברה מולטימדיה ותאורה.</p>
        <div class="home-review-list">
            <div class="home-review-item">
                <div class="home-review-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/box.png">
                </div>
                <p>שירותי מעבדה ותמיכה טכנית</p>
            </div>
            <div class="home-review-item">
                <div class="home-review-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/review2.png">
                </div>
                <p>צוות מכירות מקצועי</p>
            </div>
            <div class="home-review-item">
                <div class="home-review-img">
                    <img src="<?php echo get_template_directory_uri()?>/images/review3.png">
                </div>
                <p>תכנון וייעוץ בעל ותק של 25 שנות ניסיון</p>
            </div>
        </div>
    </div>
    <div class="bottom-img">
        <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-img.png">
    </div>
</section>
<section class="our-brands">
    <div class="container">
        <h3>המותגים שלנו</h3>
        <div class="brands-list">
            <?php foreach (carbon_get_post_meta(get_the_ID(), 'crb_our_brands') as $item): ?>
                <div class="brands-item">
                    <div>
                        <img src="<?php echo $item['crb_brands_img']; ?>">
                        <a href="<?php echo home_url('product-category/common/?action=filters&1='.$item['crb_ts_brand_slug']); ?>" class="brands-link">
<!--                            <span>656 מוצרים</span>-->
                            <img src="<?php echo get_template_directory_uri(); ?>/images/brands-line.svg">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
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
</section>
<section class="home-category">
    <div class="home-category-header">
        <div class="container">
            <h3>מוצרים לפי קטגוריה</h3>
        </div>
    </div>
    <div class="container">
        <div class="notification-area" style="margin-bottom: 20px;"></div>
    </div>
    <?php
    $top_categories = get_categories( [
	    'taxonomy'     => 'product_cat',
	    'hierarchical' => 1,
	    'title_li'     => '',
	    'hide_empty'   => 1,
	    'parent'       => 0
    ]);
    $child_categories = [];
    foreach ($top_categories as $index => $tc) {
	    if ($tc->term_id == 15)
		    unset($top_categories[$index]);
	    $cat = get_categories( [
		    'taxonomy'     => 'product_cat',
		    'hierarchical' => 0,
		    'title_li'     => '',
		    'hide_empty'   => 1,
		    'parent'       => $tc->term_id
	    ]);
	    $child_categories[$tc->term_id][] = $cat;
    }
    ?>

    <?php foreach ($top_categories as $index => $parent_category): ?>
        <div class="home-category-item">
            <div class="container">
                <div class="home-category-item-header">
                    <div class="home-category-item-header-img">
                        <img src="<?php echo carbon_get_term_meta($parent_category->term_id, 'crb_homepage_banner_thumb')?>">
                    </div>
                    <h4><a href="<?php echo get_term_link($parent_category->term_id); ?>"><?php echo $parent_category->name; ?></a></h4>
                    <div class="btn-group">
                        <?php foreach ($child_categories[$parent_category->term_id][0] as $child) :?>
                            <a href="<?php echo get_term_link($child->term_id); ?>" class="btn"><?php echo $child->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php $products = wc_get_products([
                        'limit' => 5,
	                    'category' => [$parent_category->slug],
                ]); ?>
                <div class="home-category-products-slider">
                    <div class="catalog-products-list" id="catalog-products-list-<?php echo $index + 1;?>">
                        <?php foreach ($products as $product): ?>
                            <div class="catalog-products-item">
                                <div class="item-wrap">
                                    <div class="item-img">
                                        <a href="<?php echo get_permalink($product->get_ID()); ?>" class="item-img">
                                            <img src="<?php echo get_post_meta($product->get_ID(), 'remote_image', true); ?>">
                                        </a>
                                        <div class="btn-group">
                                        <?php
                                                if ($product->get_stock_quantity() > 0 && is_user_logged_in()) {
                                                    echo apply_filters(
                                                        'woocommerce_loop_add_to_cart_link',
                                                        sprintf(
                                                            '<a href="%s" data-product_id="%s" data-product_sku="%s" class="btn btn-blue %s button product_type_%s add_to_cart_button ajax_add_to_cart">%s</a>',
                                                            esc_url( $product->add_to_cart_url() ),
                                                            esc_attr( $product->get_id() ),
                                                            esc_attr( $product->get_sku() ),
                                                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                                                            esc_attr( $product->product_type ),
                                                            esc_html( $product->add_to_cart_text() )
                                                        ),
                                                        $product
                                                    );
                                                } elseif(!is_user_logged_in()) { ?>
                                                    <a href="<?php echo home_url('resellers'); ?>"class="btn btn-blue ">להוסיף לתיק</a>
                                               <?php }
                                        ?>
                                        <a href="#" class="like" data-sku="<?php echo $product->get_sku(); ?>">
                                            <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.89757 2.33031C8.83939 2.33119 10.4185 5.41921 11.0976 6.78183C11.7794 5.41301 13.3421 2.33915 16.303 2.33915C18.1739 2.33915 20.1885 3.49738 20.1885 6.03947C20.1885 9.08501 15.8758 12.9862 11.0976 17.5421C6.31757 12.9844 2.00666 9.08413 2.00666 6.03947C2.00666 3.67169 3.79302 2.32942 5.89757 2.33031ZM5.89848 0.560669C3.00484 0.560669 0.188477 2.49577 0.188477 6.03947C0.188477 10.1636 5.25211 14.3807 11.0976 20.0267C16.943 14.3807 22.0067 10.1636 22.0067 6.03947C22.0067 2.49046 19.1912 0.569517 16.303 0.569517C14.2994 0.569517 12.2612 1.4915 11.0976 3.43456C9.92939 1.48265 7.89575 0.560669 5.89848 0.560669Z" fill="#767676"></path>
                                                <path d="M5.89359 0.244507C2.99996 0.244507 0.183594 2.23269 0.183594 5.8736C0.183594 10.1109 5.24723 14.4436 11.0927 20.2445C16.9381 14.4436 22.0018 10.1109 22.0018 5.8736C22.0018 2.22723 19.1863 0.253598 16.2981 0.253598C14.2945 0.253598 12.2563 1.20087 11.0927 3.19723C9.9245 1.19178 7.89087 0.244507 5.89359 0.244507Z" fill="#C2D7F8" class="full-fill"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    </div>

                                    <div class="item-info">
                                        <p class="title"><a href="<?php echo get_permalink($product->get_ID()); ?>"><?php echo $product->get_name(); ?> </a></p>
                                        <div class="item-flex">
                                            <div class="item-price">
<!--                                                <p class="old-price">₪910</p>-->
                                                <p><?php $info = Product::get_item_info($product->get_sku()); echo $info->OutTab[0][6]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
            </div>
        </div>
        <?php if ($index == 5): ?>
            <div class="banners-set">
                <div class="container">
                    <div class="banners-set-flex">
                        <div class="banners-set-first">
                            <div class="first-img">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/set1.png">
                            </div>
                            <div class="set-info">
                                <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                <p class="title">DJ Headphones HPX6000</p>
                                <div class="item-price">
                                    <p>₪1.267</p>
                                    <p class="old-price">₪1.700</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="banners-set-second">
                                <div class="first-img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/set2.png">
                                </div>
                                <div class="set-info">
                                    <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                    <p class="title">110 VCO/VCF/VCA</p>
                                    <div class="item-price">
                                        <p>₪1.267</p>
                                        <p class="old-price">₪1.700</p>
                                    </div>
                                </div>
                            </div>
                            <div class="banners-set-last">
                                <div class="first-img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/set3.png">
                                </div>
                                <div class="set-info">
                                    <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                    <p class="title">X-TOUCH</p>
                                    <div class="item-price">
                                        <p>₪1.267</p>
                                        <p class="old-price">₪1.700</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</section>
<section class="home-join-us">
    <div class="container">
        <div class="home-join-flex">
           
            <div class="home-join-form">
                <p class="subtitle">כל החדשות והעדכונים שלנו ישירות אליכם למייל
פשוט, חינמי ושווה.</p>
                <p class="title">הצטרפו לניוזלטר שלנו וקבלו עדכונים, <br> מבצעים וטיפים ישירות למייל.</p>
                <form>
                    <p>אימייל</p>
                    <div class="form-group">
                        <input class="input" type="email">
                        <button class="btn btn-blue">להירשם</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
