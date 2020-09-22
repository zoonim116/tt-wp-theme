<?php
//
use Carbon_Fields\Carbon_Fields;

require_once 'inc/Helper.php';
require_once 'inc/categories-additonal.php';
require_once 'inc/product-additonal.php';
require_once 'inc/my-account.php';
require_once 'inc/homepage-settings.php';
require_once 'inc/bulma-navwalker.php';

function tt_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'html5', array( 'search-form' ) );

	register_nav_menus(
		array(
			'top-header-menu' => esc_html__( 'Primary', 'tt' ),
			'footer-bottom'   => esc_html__( 'Footer Bottom', 'tt' ),
		)
	);

	global $WIZ_CART;
	require_once( 'vendor/autoload.php' );
	Carbon_Fields::boot();
}

add_action( 'after_setup_theme', 'tt_setup' );

/**
 * Enqueue scripts and styles.
 */
function tt_scripts() {
	wp_enqueue_style( 'tt-nouislider', get_template_directory_uri() . '/css/nouislider.min.css', array(), time() );
	wp_enqueue_style( 'tt-style', get_template_directory_uri() . '/css/index.css', array(), time() );
	wp_style_add_data( 'tt-style', 'rtl', 'replace' );


	wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/lib/infinite-scroll.pkgd.min.js', [ 'jquery' ], time(), true );
	wp_enqueue_script( 'nouislider', get_template_directory_uri() . '/lib/nouislider.min.js', [ 'jquery' ], time(), true );
	wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/lib/jquery.validate.min.js', [ 'jquery' ], time(), false );
	wp_enqueue_script( 'additional-methods', get_template_directory_uri() . '/lib/additional-methods.min.js', [ 'jquery' ], time(), false );
	wp_enqueue_script( 'tt-script', get_template_directory_uri() . '/lib/main.js', [
		'jquery',
		'jquery-validate',
		'additional-methods'
	], time(), true );

	wp_localize_script( 'tt-script', 'tt_ajax',
		[
			'url' => admin_url( 'admin-ajax.php' )
		]
	);
}

add_action( 'wp_enqueue_scripts', 'tt_scripts' );

function login_handle( $username, $password ) {
	if ( $_POST['customer_type'] && in_array( $_POST['customer_type'], [ 'b2b', 'b2c' ] ) ) {

		if ( ! empty( $username ) && ! empty( $password ) && $_POST['customer_type'] === 'b2c' ) {
			return User::b2c_login( $username, $password );
		} elseif ( ! empty( $username ) && ! empty( $password ) && $_POST['customer_type'] === 'b2b' ) {
			$res = User::b2b_login( $username, $password );
			if ( $res ) {
				$user_details = User::get_user_details();
				update_user_meta( get_current_user_id(), 'user_details', $user_details );
			}

			return $res;
		}
	}

	return false;
}

add_action( 'wp_authenticate', 'login_handle', 30, 2 );

function display_woo_categories() {
	$top_categories   = get_categories( [
		'taxonomy'     => 'product_cat',
		'hierarchical' => 1,
		'title_li'     => '',
		'hide_empty'   => 1,
		'parent'       => 0
	] );
	$child_categories = [];
	foreach ( $top_categories as $index => $tc ) {
		if ( $tc->term_id == 15 ) {
			unset( $top_categories[ $index ] );
		}
		$cat                                = get_categories( [
			'taxonomy'     => 'product_cat',
			'hierarchical' => 0,
			'title_li'     => '',
			'hide_empty'   => 1,
			'parent'       => $tc->term_id
		] );
		$child_categories[ $tc->term_id ][] = $cat;
	}
	echo Helper::hm_get_template_part( 'template-parts/navigation', compact( 'top_categories', 'child_categories' ) );
}

add_action( 'display_woo_categories', 'display_woo_categories' );

function cat( $arr, $parent = 0 ) {
	foreach ( $arr as $category ) {
		if ( $term = term_exists( $category[0], 'product_cat' ) ) {
			$cid = $term['term_id'];
		} else {
			$term = wp_insert_term(
				$category[0], // the term
				'product_cat', // the taxonomy
				array(
					//TODO add description to category
					'description' => '',
					'slug'        => $category[0],
					'parent'      => $parent
				)
			);
			$cid  = $term['term_id'];
		}
		$products = Product::get_items( $category[0] );
		if ( count( $products->OutTab ) > 0 ) {
			foreach ( $products->OutTab as $item ) {
				$tt_product = Product::get_item_info( $item[0] );

				$product_id = 0;
				if ( wc_get_product_id_by_sku( $item[0] ) ) {
					$product_id = wc_get_product_id_by_sku( $item[0] );
				}
				try {
					$price   = str_replace( 'NIS ', '', $item[7] );
					$product = new WC_Product( $product_id );
					$product->set_name( $item[1] );
					$product->set_status( 'publish' );
					$product->set_catalog_visibility( 'visible' );
					$product->set_short_description( $item[2] );
					if ( ! $product->get_sku() ) {
						$product->set_sku( $item[0] );
					}
					//TODO add price to product
					$product->set_price( $price );
					$product->set_regular_price( $price );
					$product->set_manage_stock( true );
					$product->set_stock_quantity( $item[4] );
					if ( $item[28] == 'Out of stock' ) {
						$product->set_stock_status( 'outofstock' );
					} else {
						$product->set_stock_status( 'instock' );
					}
					$product->set_backorders( 'no' );
					$product->set_reviews_allowed( false );
					$product->set_sold_individually( false );
					$product->set_category_ids( [ $cid ] );
					$product->update_meta_data( 'remote_image', "https://shop4.wizsoft.com/vshop/images/techtopimg/heb/{$item[6]}" );
					if ( $tt_product->Status == 'OK' && count( $tt_product->VSNotesTab[1] ) > 0 ) {
						$product->update_meta_data( 'info_data', $tt_product->VSNotesTab[1] );
					}
					if ( count( $item[4] ) > 0 ) {
						$product->update_meta_data( 'gallery_info_data', $item[4] );
					}
					$product->save();
				} catch ( Exception $e ) {
					echo "<pre>";
					print_r( $e );
				}
			}
		}
		if ( is_array( $category[10] ) && count( $category[10] ) > 0 ) {
			cat( $category[10], $cid );
		}
	}
}

add_filter( 'cron_schedules', 'tt_add_cron_interval' );
function tt_add_cron_interval( $schedules ) {
	$schedules['half_hour'] = array(
		'interval' => 30 * 60,
		'display'  => esc_html__( 'Half hour' )
	);

	return $schedules;
}

function tt_catalog_cron_hook() {
	$root = Categories::get_categories();
	try {
		if ( is_array( $root[10] ) && count( $root[10] ) > 0 ) {
			cat( $root[10] );
		}
	} catch ( Exception $e ) {
		print $e->getMessage();
	}
	die( "Done" );
}

add_action( 'tt_catalog_cron_hook', 'tt_catalog_cron_hook' );

if ( ! wp_next_scheduled( 'tt_catalog_cron_hook' ) ) {
	wp_schedule_event( time(), 'half_hour', 'tt_catalog_cron_hook' );
}

//add_action('init', function () {
//	$root = Categories::get_categories();
//	try {
//		if(is_array($root[10]) && count($root[10]) > 0){
//			cat($root[10]);
//		}
//	} catch (Exception $e) {
//		print $e->getMessage();
//	}
//	die("Done");
//});

function tt_template_loop_category_title( $category ) {
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

function tt_show_subcategories( $category ) {
	$categories = get_categories( [
		'taxonomy'     => 'product_cat',
		'hierarchical' => 1,
		'title_li'     => '',
		'hide_empty'   => 0,
		'parent'       => $category->term_id
	] );
	if ( $categories ) {
		wc_get_template( 'loop/subcategories.php', compact( 'categories' ) );
	}

}

function tt_template_loop_product_title() {
	global $product;
	echo '<p class="title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . get_permalink() . '">' . $product->get_name() . '</a></p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
//	if (is_product_category()) {
	remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'tt_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'woocommerce_shop_loop_subcategory_title', 'tt_template_loop_category_title', 10 );
	add_action( 'tt_show_subcategories', 'tt_show_subcategories', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'tt_shop_loop_item_title', 'tt_template_loop_product_title', 20 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
//	}
}

function tt_template_loop_price() {
	global $product;
	$info = Product::get_item_info( $product->get_sku() );
	echo '<p>' . $info->OutTab[0][6] . '</p>';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'tt_template_loop_price', 10 );


function tt_show_filters() {
	global $wp_query;
	$children_categories = get_term_children( $wp_query->get_queried_object()->term_id, 'product_cat' );
	if ( count( $children_categories ) == 0 ) {
		get_template_part( 'template-parts/filters' );
	}
}

add_action( 'tt_show_filters', 'tt_show_filters' );

function tt_loop_product_thumbnail() {
	global $product; ?>
    <img src="<?php echo get_post_meta( $product->get_id(), 'remote_image', true ); ?>">
<?php }

add_action( 'tt_loop_product_thumbnail', 'tt_loop_product_thumbnail' );

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' );

function woo_custom_cart_button_text() {
	return __( 'להוסיף לתיק', 'tt' );
}


add_filter( 'woocommerce_output_related_products_args', 'tt_related_products_args', 20 );
function tt_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns']        = 2; // arranged in 2 columns

	return $args;
}

add_filter( 'woocommerce_product_related_products_heading', 'tt_related_products_heading', 10 );

function tt_related_products_heading( $args ) {
	return 'בדרך כלל לקנות עם זה';
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
	return 12;
}

function tt_loop_product_short_description() {
	the_excerpt();
}

add_action( 'tt_loop_product_short_description', 'tt_loop_product_short_description' );


function tt_template_single_excerpt() {
	wc_get_template( 'single-product/short-description.php' );
}

add_action( 'tt_single_product_summary', 'tt_template_single_excerpt', 20 );

function tt_template_single_price() {
	wc_get_template( 'single-product/price.php' );
}

add_action( 'tt_template_single_price', 'tt_template_single_price', 10 );

add_filter( 'woocommerce_get_price_html', 'tt_price_html', 100, 2 );
function tt_price_html( $price, $product ) {
	$info      = Product::get_item_info( $product->get_sku() );
	$old_price = '';
	if ( is_user_logged_in() ) {
		$old_price = '<p class="old-price">NIS ' . $product->get_price() . '</p>';
	}

	return '<div class="item-price">
            ' . $old_price . '
            <p>' . $info->OutTab[0][6] . '</p>
        </div>';
//	if ( $product->get_price() > 0 ) {
//		if ( $product->get_price() && $product->get_regular_price() ) {
//			$from = $product->get_regular_price();
//			$to = $product->get_price();
//			return '<div class="item-price">
//                    <p class="old-price">'. ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) .'</p>
//                    <p>'.( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) .'</p>
//                </div>';
//		} else {
//			$to = $product->get_price();
//			return '<div class="item-price">
//                    <p>'.( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) .'</p>
//                </div>';
//		}
//	} else {
//		return ;
//	}
}

function tt_show_drivers_list() {
	global $product;
	$drivers   = carbon_get_post_meta( $product->get_id(), 'crb_drivers' );
	$list_html = '';
	if ( $drivers ) {
		$list_html .= "<ul>";
		foreach ( $drivers as $driver ) {
			$list_html .= "<li><a href='" . $driver['crb_url'] . "' target='_blank'>" . $driver['crb_title'] . "</a> </li>";
		}
		$list_html .= "</ul>";
		echo $list_html;
	}
}

add_action( 'tt_show_drivers_list', 'tt_show_drivers_list', 10 );

function tt_show_software_list() {
	global $product;
	$drivers   = carbon_get_post_meta( $product->get_id(), 'crb_software' );
	$list_html = '';
	if ( $drivers ) {
		$list_html .= "<ul>";
		foreach ( $drivers as $driver ) {
			$list_html .= "<li><a href='" . $driver['crb_url'] . "' target='_blank'>" . $driver['crb_title'] . "</a> </li>";
		}
		$list_html .= "</ul>";
		echo $list_html;
	}
}

add_action( 'tt_show_software_list', 'tt_show_software_list', 10 );

function tt_show_media_list() {
	global $product;
	$drivers   = carbon_get_post_meta( $product->get_id(), 'crb_media' );
	$list_html = '';
	if ( $drivers ) {
		$list_html .= "<ul>";
		foreach ( $drivers as $driver ) {
			$list_html .= "<li><a href='" . $driver['crb_url'] . "' target='_blank'>" . $driver['crb_title'] . "</a> </li>";
		}
		$list_html .= "</ul>";
		echo $list_html;
	}
}

add_action( 'tt_show_media_list', 'tt_show_media_list', 10 );

function tt_show_documentation_list() {
	global $product;
	$drivers   = carbon_get_post_meta( $product->get_id(), 'crb_documentation' );
	$list_html = '';
	if ( $drivers ) {
		$list_html .= "<ul>";
		foreach ( $drivers as $driver ) {
			$list_html .= "<li><a href='" . $driver['crb_url'] . "' target='_blank'>" . $driver['crb_title'] . "</a> </li>";
		}
		$list_html .= "</ul>";
		echo $list_html;
	}
}

add_action( 'tt_show_documentation_list', 'tt_show_documentation_list', 10 );

function tt_show_attributes_list() {
	global $product;
	$formatted_attributes = get_post_meta( $product->get_ID(), 'info_data' )[0];
	$list_1               = $list_2 = '<div class="column is-6 card-col"><ul>';
	$index                = 0;
	foreach ( $formatted_attributes as $value ) {
		if ( $value == 'true' ) {
			$value = '<img src="' . get_template_directory_uri() . '/images/check.svg">';
		}
		if ( $index % 2 == 0 ) {
			$list_1 .= '<li><span>' . $value[0] . '</span><span>' . $value[1] . '</span></li>';
		} else {
			$list_2 .= '<li><span>' . $value[0] . '</span><span>' . $value[1] . '</span></li>';
		}
		$index ++;
	}
	$list_1 .= '</ul></div>';
	$list_2 .= '</ul></div>';
	echo $list_1 . '' . $list_2;
}

add_action( 'tt_show_attributes_list', 'tt_show_attributes_list', 10 );

function tt_remove_specific_country( $countries ) {

	global $woocommerce;

	// default do not limit
	$limited_countries = array_values( array_flip( $countries ) );

	// Country array to keep
	$eu = [ 'IL' ];

	// keep countries, sort them out of the full array to keep the names
	$found = array_filter( $countries, function ( $item ) use ( $eu ) {
		return in_array( $item, $eu );
	}, ARRAY_FILTER_USE_KEY ); // USE_KEY is essential cause we are filtering the language codes

	// return the found countries
	return $found;
}

add_filter( 'woocommerce_countries', 'tt_remove_specific_country', 10, 1 );

function tt_prefill_checkout_fields( $input, $key ) {
	$user = User::get_user_details();
	switch ( $key ) :
		case 'billing_first_name':
			return $user->Name;
			break;
		case 'shipping_first_name':
			return $user->Name;
			break;
		case 'billing_email':
			return $user->EMail;
			break;
		case 'billing_phone':
			return $user->BPhone;
			break;
		case 'billing_city':
			return $user->BCity;
			break;
		case 'billing_address_1':
			return $user->BAddress;
			break;
	endswitch;
}

add_filter( 'woocommerce_checkout_get_value', 'tt_prefill_checkout_fields', 10, 2 );

add_filter( 'woocommerce_checkout_fields', 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	$fields['billing']['billing_first_name']['placeholder'] = $fields['shipping']['shipping_first_name']['placeholder'] = 'שם ומשפחה';
	$fields['billing']['billing_first_name']['label']       = $fields['shipping']['shipping_first_name']['label'] = 'שם ומשפחה';
	$fields['billing']['billing_first_name']['class'][0]    = $fields['shipping']['shipping_first_name']['class'][0] = 'form-row-wide';
	unset( $fields['billing']['billing_last_name'] );
	unset( $fields['shipping']['shipping_last_name'] );
	unset( $fields['billing']['billing_company'] );
	unset( $fields['shipping']['shipping_company'] );
	unset( $fields['billing']['billing_phone']['validate'] );

	return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'tt_unrequire_wc_phone_field' );
function tt_unrequire_wc_phone_field( $fields ) {
	$fields['company']['required']  = false;
	$fields['postcode']['required'] = false;

	return $fields;
}

add_filter( 'woocommerce_cart_needs_payment', '__return_false' );

add_action( 'woocommerce_after_checkout_billing_form', 'tt_select_shipping_method' );
add_action( 'woocommerce_after_checkout_billing_form', 'tt_select_payment_method' );


// Dropdown with shipping methods from API
function tt_select_shipping_method( $checkout ) {
	$options           = [];
	$shipping_response = User::get_user_shipping_methods();
	if ( count( $shipping_response->OutTab ) ) {
		foreach ( $shipping_response->OutTab[0][3] as $index => $delivery_method ) {
			$options[ $delivery_method[0] ] = $delivery_method[0];
		}
	}

	$current_user          = wp_get_current_user();
	$DefaultDeliveryMethod = get_user_meta( $current_user->ID, 'DefaultDeliveryMethod', true );
	woocommerce_form_field( 'delivery_method', [
		'type'        => 'select',
		// text, textarea, select, radio, checkbox, password, about custom validation a little later
		'required'    => true,
		// actually this parameter just adds "*" to the field
		'class'       => array( 'delivery-field', 'form-row-wide' ),
		// array only, read more about classes and styling in the previous step
		'label'       => 'שיטת משלוח',
		'label_class' => 'delivery-label',
		// sometimes you need to customize labels, both string and arrays are supported
		'options'     => $options
	], $DefaultDeliveryMethod );
}

// Dropdown with payment methods from API

function tt_select_payment_method( $checkout ) {
	$options = [
		'1' => 'Payment will be competed in back-office',
		'2' => 'Payment has already done other way'
	];

	woocommerce_form_field( 'tt_payment_method', [
		'type'        => 'select',
		// text, textarea, select, radio, checkbox, password, about custom validation a little later
		'required'    => true,
		// actually this parameter just adds "*" to the field
		'class'       => array( 'delivery-field', 'form-row-wide' ),
		// array only, read more about classes and styling in the previous step
		'label'       => 'Payment method',
		'label_class' => 'delivery-label',
		// sometimes you need to customize labels, both string and arrays are supported
		'options'     => $options
	], '' );
}

add_action( 'woocommerce_checkout_update_order_meta', 'tt_save_shipping_method' );
add_action( 'woocommerce_checkout_update_order_meta', 'tt_save_payment_method' );

function tt_save_shipping_method( $order_id ) {
	if ( ! empty( $_POST['delivery_method'] ) ) {
		update_post_meta( $order_id, 'delivery_method', sanitize_text_field( $_POST['delivery_method'] ) );
	}
}

function tt_save_payment_method( $order_id ) {
	if ( ! empty( $_POST['tt_payment_method'] ) ) {
		update_post_meta( $order_id, 'tt_payment_method', sanitize_text_field( $_POST['tt_payment_method'] ) );
	}
}

add_action( 'woocommerce_add_to_cart', 'customer_add_to_cart', 10, 4 );
function customer_add_to_cart( $cart_item_key, $product_id, $quantity ) {
	$product = wc_get_product( $product_id );
	Product::add_to_cart( $product->get_sku(), $quantity );
}

function customer_remove_from_cart( $cart_item_key, $cart ) {
	$product_id = $cart->cart_contents[ $cart_item_key ]['product_id'];
	$product    = wc_get_product( $product_id );
	Product::remove_from_cart( $product->get_sku() );
}

add_action( 'woocommerce_remove_cart_item', 'customer_remove_from_cart', 10, 2 );

add_action( 'woocommerce_after_cart_item_quantity_update', 'customer_update_cart', 10, 4 );
function customer_update_cart( $cart_item_key, $quantity, $old_quantity, $that ) {
	$product_id  = $that->cart_contents[ $cart_item_key ]['product_id'];
	$product     = wc_get_product( $product_id );
	$cart        = Product::get_cart();
	$wiz_product = null;
	foreach ( $cart->OutTab as $product_in_cart ) {
		if ( $product_in_cart[1] == $product->get_sku() ) {
			$wiz_product = $product_in_cart;
		}
	}
	if ( $wiz_product ) {
		Product::update_quantity_cart( $wiz_product[0], $wiz_product[1], $quantity );
	}
}

add_action( 'wp_ajax_get_b2b_user_balance', 'get_b2b_user_balance' );
function get_b2b_user_balance() {
	$data = User::get_balance();
	echo $data->CurrBalance;
	wp_die();
}

add_action( 'wp_ajax_update_password', 'update_password' );
function update_password() {
	if ( $_POST['currPass'] && $_POST['newPass'] ) {
		$data = User::update_password( $_POST['currPass'], $_POST['newPass'] );
		if ( $data->Status && $data->Status == 'OK' ) {
			echo $data->Status;
		} else {
			echo $data;
		}
	}
	wp_die();
}

add_action( 'wp_ajax_update_billing_info', 'update_billing_info' );
function update_billing_info() {
	$data = $_POST;
	unset( $data['action'] );
	$data = User::update_user_details( $data );
	if ( $data->Status && $data->Status == 'OK' ) {
		echo $data->Status;
	} else {
		echo $data;
	}
	wp_die();
}

add_action( 'wp_ajax_add_to_wishlist', 'add_to_wishlist' );
function add_to_wishlist() {
	if ( $_POST['sku'] ) {
		$data = Product::add_to_wishlist( $_POST['sku'] );
		if ( $data->Status && $data->Status == 'OK' ) {
			echo $data->Status;
		} else {
			echo $data;
		}
	}
	wp_die();
}

add_action( 'wp_ajax_remove_from_wishlist', 'remove_from_wishlist' );
function remove_from_wishlist() {
	if ( $_POST['sku'] ) {
		$data = Product::remove_from_wishlist( $_POST['sku'] );
		if ( $data->Status && $data->Status == 'OK' ) {
			echo $data->Status;
		} else {
			echo $data;
		}
	}
	wp_die();
}

add_action( 'woocommerce_checkout_order_processed', 'create_order', 1, 1 );
function create_order( $order_id ) {
	$order    = new WC_Order( $order_id );
	$payment  = get_post_meta( $order_id, 'tt_payment_method', true );
	$shipping = get_post_meta( $order_id, 'delivery_method', true );
	$data     = User::create_order( $payment, $shipping, $order->get_customer_order_notes() );
	if ( $data->Status == 'OK' ) {
		update_post_meta( $order_id, 'tt_order_number', $data->OrderNo );
		update_post_meta( $order_id, 'tt_delivery_cost', $data->DeliveryCost );
		update_post_meta( $order_id, 'tt_Total', $data->Total );
	}
}

add_action( 'woocommerce_calculate_totals', 'tt_calculate_total', 10 );
/**
 * @param WC_Cart $cart
 */
function tt_calculate_total( $cart ) {
	$tt_cart             = Product::get_cart();
	$_SESSION['tt_cart'] = $tt_cart;
	$cart->set_cart_contents_total( $tt_cart->TotalCostItems );
	$cart->set_subtotal( $tt_cart->Total );
	$cart->set_total( $tt_cart->Total );
	$cart->set_shipping_total( $tt_cart->DeliveryCost );
}

add_action( 'woocommerce_review_order_before_order_total', 'custom_cart_total' );
add_action( 'woocommerce_before_cart_totals', 'custom_cart_total' );
function custom_cart_total() {
	if ( $_SESSION['tt_cart'] ) {
		$tt_cart = $_SESSION['tt_cart'];
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}
		WC()->cart->total = $tt_cart->Total;
	}
}


function add_query_vars_filter( $vars ) {
	$vars[] = "action";
	$vars[] = "CategoryPath";
	foreach ( range( 0, 100 ) as $item ) {
		$vars[] = $item;
	}

	return $vars;
}

add_filter( 'query_vars', 'add_query_vars_filter' );

//add_filter( 'woocommerce_add_to_cart_fragments', 'tt_mini_cart');
//
//function tt_mini_cart($fragments) {
////	ob_start();
//    echo "<pre>";
//    die(var_dump(WC()->cart->get));
//	return $fragments;
//}

add_filter( 'woocommerce_cart_totals_order_total_html', 'tt_cart_totals_order_total_html', 20, 1 );

function tt_cart_totals_order_total_html( $value ) {
	$tt_cart = Product::get_cart();

	return '<strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₪</span>' . $tt_cart->Total . '</span></strong>';
}

function my_render_wc_login_form( $atts ) {
	if ( ! is_user_logged_in() ) {
		if ( function_exists( 'woocommerce_login_form' ) &&
		     function_exists( 'woocommerce_output_all_notices' ) ) {
			//render the WooCommerce login form
			ob_start();
			woocommerce_output_all_notices();
			woocommerce_login_form();

			return ob_get_clean();
		} else {
			//render the WordPress login form
			return wp_login_form( array( 'echo' => false ) );
		}
	} else {
		return "Hello there! Welcome back.";
	}
}

add_shortcode( 'my_wc_login_form', 'my_render_wc_login_form' );

function tt_admin_default_page() {
	return home_url('/my-account');
}

add_filter('woocommerce_login_redirect', 'tt_admin_default_page');

function tt_redirect_to_login(){
	wp_redirect( home_url('/login') );
	exit();
}

add_action('wp_logout','tt_redirect_to_login');