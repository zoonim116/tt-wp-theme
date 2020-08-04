<?php

require_once 'inc/Helper.php';

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
		'hide_empty'   => 0,
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
			'hide_empty'   => 0,
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
				'description'=> '',
				'slug' => $category[0],
				'parent' => $parent
			)
		);
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

//add_action('init', function (){
//    $p = Product::get_items("!23");
//    echo "<pre>";
//    die(var_dump($p));
//});

//add_action('init', function () {
//	$root = Categories::get_categories();
//	try {
//		if(is_array($root[10]) && count($root[10]) > 0){
//			cat($root[10]);
//		}
//	} catch (Exception $e) {
//		print $e->getMessage();
//	}
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

add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
//	if (is_product_category()) {
		remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		add_action( 'woocommerce_shop_loop_subcategory_title', 'tt_template_loop_category_title', 10);
		add_action('tt_show_subcategories', 'tt_show_subcategories', 10);
//	}
}