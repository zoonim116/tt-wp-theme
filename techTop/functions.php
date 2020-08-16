<?php

require_once 'inc/Helper.php';
require_once 'inc/categories-additonal.php';
require_once 'inc/product-additonal.php';

function tt_setup() {
	add_theme_support( 'woocommerce' );
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'after_setup_theme', 'tt_setup' );

/**
 * Enqueue scripts and styles.
 */
function tt_scripts() {
	wp_enqueue_style( 'tt-style', get_template_directory_uri().'/css/index.css', array(), time() );
	wp_style_add_data( 'tt-style', 'rtl', 'replace' );


	wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/lib/infinite-scroll.pkgd.min.js', ['jquery'], time(), true );
	wp_enqueue_script( 'nouislider', get_template_directory_uri() . '/lib/nouislider.min.js', ['jquery'], time(), true );
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
	            try {
		            $product_id = $product->save();
                } catch (Exception $e) {
	                print_r($e);
                }

            }
		};
		if (!is_wp_error($cid)) {
			if (is_array($category[10]) && count($category[10]) > 0) {
				cat($category[10], $cid['term_id']);
			}
		} else {
			if (is_array($category[10]) && count($category[10]) > 0) {
				cat($category[10], $cid->error_data['term_exists']);
			}
        }
	}
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
	    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
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
add_filter( 'woocommerce_product_add_to_cart_text' , 'woo_custom_cart_button_text' );

function woo_custom_cart_button_text() {
	return __('להוסיף לתיק', 'tt');
}

add_filter( 'woocommerce_output_related_products_args', 'tt_related_products_args', 20 );
function tt_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 2; // arranged in 2 columns
	return $args;
}

add_filter('woocommerce_product_related_products_heading', 'tt_related_products_heading', 10);

function tt_related_products_heading($args) {
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

add_action('tt_loop_product_short_description', 'tt_loop_product_short_description');


function tt_template_single_excerpt() {
	wc_get_template( 'single-product/short-description.php' );
}

add_action( 'tt_single_product_summary', 'tt_template_single_excerpt', 20 );

function tt_template_single_price() {
	wc_get_template( 'single-product/price.php' );
}

add_action( 'tt_template_single_price', 'tt_template_single_price', 10 );

add_filter( 'woocommerce_get_price_html', 'tt_price_html', 100, 2 );
function tt_price_html( $price, $product ){
	if ( $product->get_price() > 0 ) {
		if ( $product->get_price() && $product->get_regular_price() ) {
			$from = $product->get_regular_price();
			$to = $product->get_price();
			return '<div class="item-price">
                    <p class="old-price">'. ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) .'</p>
                    <p>'.( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) .'</p>
                </div>';
		} else {
			$to = $product->get_price();
			return '<div class="item-price">
                    <p>'.( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) .'</p>
                </div>';
		}
	} else {
		return ;
	}
}

function tt_show_drivers_list() {
    global $product;
    $drivers = carbon_get_post_meta($product->get_id(), 'crb_drivers');
    $list_html = '';
    if ($drivers) {
        $list_html .= "<ul>";
        foreach ($drivers as $driver) {
            $list_html .="<li><a href='".$driver['crb_url']."' target='_blank'>".$driver['crb_title']."</a> </li>";
        }
        $list_html .="</ul>";
        echo $list_html;
    }
}

add_action('tt_show_drivers_list', 'tt_show_drivers_list', 10);

function tt_show_software_list() {
	global $product;
	$drivers = carbon_get_post_meta($product->get_id(), 'crb_software');
	$list_html = '';
	if ($drivers) {
		$list_html .= "<ul>";
		foreach ($drivers as $driver) {
			$list_html .="<li><a href='".$driver['crb_url']."' target='_blank'>".$driver['crb_title']."</a> </li>";
		}
		$list_html .="</ul>";
		echo $list_html;
	}
}

add_action('tt_show_software_list', 'tt_show_software_list', 10);

function tt_show_media_list() {
	global $product;
	$drivers = carbon_get_post_meta($product->get_id(), 'crb_media');
	$list_html = '';
	if ($drivers) {
		$list_html .= "<ul>";
		foreach ($drivers as $driver) {
			$list_html .="<li><a href='".$driver['crb_url']."' target='_blank'>".$driver['crb_title']."</a> </li>";
		}
		$list_html .="</ul>";
		echo $list_html;
	}
}

add_action('tt_show_media_list', 'tt_show_media_list', 10);

function tt_show_documentation_list() {
	global $product;
	$drivers = carbon_get_post_meta($product->get_id(), 'crb_documentation');
	$list_html = '';
	if ($drivers) {
		$list_html .= "<ul>";
		foreach ($drivers as $driver) {
			$list_html .="<li><a href='".$driver['crb_url']."' target='_blank'>".$driver['crb_title']."</a> </li>";
		}
		$list_html .="</ul>";
		echo $list_html;
	}
}

add_action('tt_show_documentation_list', 'tt_show_documentation_list', 10);

function tt_show_attributes_list() {
	global $product;
	$formatted_attributes = array();

	$attributes = $product->get_attributes();

	foreach($attributes as $attr=>$attr_deets){

		$attribute_label = wc_attribute_label($attr);

		if ( isset( $attributes[ $attr ] ) || isset( $attributes[ 'pa_' . $attr ] ) ) {

			$attribute = isset( $attributes[ $attr ] ) ? $attributes[ $attr ] : $attributes[ 'pa_' . $attr ];

			if ( $attribute['is_taxonomy'] ) {

				$formatted_attributes[$attribute_label] = implode( ', ', wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) ) );

			} else {

				$formatted_attributes[$attribute['name']] = $attribute['value'];
			}

		}
	}
	$list_1 = $list_2 = '<div class="column is-6 card-col"><ul>';
	$index = 0;
    foreach ($formatted_attributes as $name => $value) {
        if ($value == 'true') {
            $value = '<img src="'.get_template_directory_uri().'/images/check.svg">';
        }
        if ($index % 2 == 0) {
            $list_1 .= '<li><span>'.$name.'</span><span>'.$value.'</span></li>';
        } else {
	        $list_2 .= '<li><span>'.$name.'</span><span>'.$value.'</span></li>';
        }
        $index++;
    }
    $list_1 .= '</ul></div>';
    $list_2 .= '</ul></div>';
    echo $list_1 . '' .$list_2;
}

add_action('tt_show_attributes_list', 'tt_show_attributes_list', 10);
