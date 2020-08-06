<?php

require_once 'inc/Helper.php';

function wooc_extra_register_fields() { ?>
    <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
    <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
    <p class="form-row form-row-first">
        <label for="reg_billing_city"><?php _e( 'City', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="city" id="reg_billing_city" value="<?php if ( ! empty( $_POST['city'] ) ) esc_attr_e( $_POST['city'] ); ?>" />
    </p>
    <p class="form-row form-row-last">
        <label for="reg_zipcode"><?php _e( 'Zipcode', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="zipcode" id="reg_zipcode" value="<?php if ( ! empty( $_POST['zipcode'] ) ) esc_attr_e( $_POST['zipcode'] ); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="reg_billing_address"><?php _e( 'Address', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="address" id="reg_billing_address" value="<?php esc_attr_e( $_POST['address'] ); ?>" />
    </p>
    <div class="clear"></div>
	<?php
}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

/**
 * Enqueue scripts and styles.
 */
function tt_scripts() {
	wp_enqueue_style( 'tt-style', get_template_directory_uri().'/css/index.css', array(), time() );
	wp_style_add_data( 'tt-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tt-script', get_template_directory_uri() . '/lib/main.js', ['jquery'], time(), true );
}
add_action( 'wp_enqueue_scripts', 'tt_scripts' );

function login_handle($username, $password ) {
	if ($_POST['customer_type'] && in_array($_POST['customer_type'], ['b2b', 'b2c'])) {

		if (!empty($username) && !empty($password) && $_POST['customer_type'] === 'b2c') {
			return User::b2c_login($username, $password);
		} elseif (!empty($username) && !empty($password) && $_POST['customer_type'] === 'b2b') {
			return  User::b2b_login($username, $password);
		}
	}
	return false;
}
add_action('wp_authenticate', 'login_handle', 30, 2);

function display_woo_categories() {
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
	echo Helper::hm_get_template_part('template-parts/navigation', compact('top_categories', 'child_categories'));
}

add_action('display_woo_categories', 'display_woo_categories');

function cat($arr, $parent = 0) {
	foreach ($arr as $category) {

		$cid = wp_insert_term(
			$category[0], // the term
			'product_cat', // the taxonomy
			array(
		        //TODO add description to category
				'description'=> '',
				'slug' => $category[0],
				'parent' => $parent
			)
		);
		$products = Product::get_items($category[0]);

		if (count($products->OutTab) > 0) {
            foreach ($products->OutTab as $item) {
                $product = new WC_Product();
                $product->set_name($item[0]);
                $product->set_status('publish');
                $product->set_catalog_visibility('visible');
                $product->set_description($item[2]);
                $product->set_sku($item[18]);
                //TODO add price to product
                $product->set_price(30);
                $product->set_regular_price(30);
                $product->set_manage_stock(true);
                $product->set_stock_quantity(1);
                if ($item[28] == 'Out of stock') {
                    $product->set_stock_status('outofstock');
                } else {
	                $product->set_stock_status('instock');
                }
                $product->set_backorders('no');
                $product->set_reviews_allowed(false);
                $product->set_sold_individually(false);
                $product->set_category_ids($cid);
                $product->update_meta_data('remote_image', "https://shop4.wizsoft.com/vshop/images/techtopimg/heb/{$item[6]}");
                $product_id = $product->save();
            }
		}
		if (!is_wp_error($cid)) {
			if (is_array($category[10]) && count($category[10]) > 0) {
				cat($category[10], $cid['term_id']);
			}
		}
	}
}

function tt_setup() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'tt_setup' );

//add_action('init', function () {
//	$root = Categories::get_categories();
//	try {
//		if(is_array($root[10]) && count($root[10]) > 0){
//			cat($root[10]);
//		}
//		die();
//	} catch (Exception $e) {
//		print $e->getMessage();
//	}
//	die("Done");
//});

function tt_template_loop_category_title($category) {
	echo '<a href="' . esc_url( get_term_link( $category, 'product_cat' ) ) . '">';
	?>
	<h3 class="woocommerce-loop-category__title">
		<?php
		echo esc_html( $category->name );
		?>
	</h3>
	<?php
	echo '</a>';
}

function tt_show_subcategories($category) {
	$categories = get_categories( [
		'taxonomy'     => 'product_cat',
		'hierarchical' => 1,
		'title_li'     => '',
		'hide_empty'   => 0,
		'parent'       => $category->term_id
	]);
	if ($categories) {
		wc_get_template( 'loop/subcategories.php', compact('categories') );
    }

}

function tt_template_loop_product_title() {
	echo '<p class="title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="'.get_permalink().'">' . get_the_title() . '</a></p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
//	if (is_product_category()) {
		remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	    add_action( 'tt_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
		add_action( 'woocommerce_shop_loop_subcategory_title', 'tt_template_loop_category_title', 10);
		add_action('tt_show_subcategories', 'tt_show_subcategories', 10);
	    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	    add_action( 'tt_shop_loop_item_title', 'tt_template_loop_product_title', 20 );
//	}
}

function tt_show_filters() {
    global $wp_query;
    $children_categories = get_term_children($wp_query->get_queried_object()->term_id, 'product_cat');
    if (count($children_categories) == 0) {
	    get_template_part('template-parts/filters');
    }
}

add_action('tt_show_filters', 'tt_show_filters');

function tt_loop_product_thumbnail() {
    global $product; ?>
    <img src="<?php echo get_post_meta($product->get_id(), 'remote_image', true); ?>">
<?php }

add_action('tt_loop_product_thumbnail', 'tt_loop_product_thumbnail');

add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');

function woo_custom_cart_button_text() {
	return __('להוסיף לתיק', 'tt');
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
	return 12;
}