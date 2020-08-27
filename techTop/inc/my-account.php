<?php

add_action( 'init', 'my_account_new_endpoints' );

function my_account_new_endpoints() {
	add_rewrite_endpoint( 'wishlist', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'orders', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'statistic', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'balance', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'payments', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'delivery-addresses', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'definitions', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'promotional', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'consultant', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'help', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'logout', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'change_password', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'change_billing_info', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'change_billing_address', EP_ROOT | EP_PAGES);
	add_rewrite_endpoint( 'change_shipping_info', EP_ROOT | EP_PAGES);
}

function my_account_menu_order() {
	return [
		'dashboard'          => __( 'סקירת חשבון', 'woocommerce' ),
		'orders'          => __( 'ההזמנות שלי', 'woocommerce' ),
		'wishlist'          => __( 'רשימת משאלות', 'woocommerce' ),
		'statistic'          => __( 'סטטיסטיקה', 'woocommerce' ),
		'balance'          => __( 'איזון', 'woocommerce' ),
		'payments'          => __( 'תשלומים', 'woocommerce' ),
		'delivery-addresses'   => __( 'מסירת כתובות', 'woocommerce' ),
		'definitions'          => __( 'הגדרות', 'woocommerce' ),
		'promotional'          => __( 'קודי קידום מכירות', 'woocommerce' ),
		'consultant'          => __( 'יועץ אישי', 'woocommerce' ),
		'help'          => __( 'עזרה', 'woocommerce' ),
		'logout'    => __( 'להתנתק', 'woocommerce' ),
	];
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );

add_action( 'woocommerce_account_wishlist_endpoint', 'my_wishlist_endpoint_content' );
function my_wishlist_endpoint_content() {
	wc_get_template_part( 'myaccount/wishlist' );
}

add_action( 'woocommerce_account_logout_endpoint', 'logout_endpoint_content' );
function logout_endpoint_content() {
	wc_get_template_part( 'myaccount/logout' );
}

add_action( 'woocommerce_account_help_endpoint', 'help_endpoint_content' );
function help_endpoint_content() {
	wc_get_template_part( 'myaccount/help' );
}

add_action( 'woocommerce_account_change_password_endpoint', 'change_password_endpoint_content' );
function change_password_endpoint_content() {
	wc_get_template_part( 'myaccount/change-password' );
}

add_action( 'woocommerce_account_definitions_endpoint', 'definitions_endpoint_content' );
function definitions_endpoint_content() {
	wc_get_template_part( 'myaccount/definitions' );
}

add_action( 'woocommerce_account_change_billing_info_endpoint', 'change_billing_info_endpoint_content' );
function change_billing_info_endpoint_content() {
	wc_get_template_part( 'myaccount/change-billing-info' );
}

add_action( 'woocommerce_account_change_billing_address_endpoint', 'change_billing_address_endpoint_content' );
function change_billing_address_endpoint_content() {
	wc_get_template_part( 'myaccount/change-billing-address' );
}



function my_account_endpoint_title( $title, $id ) {
	global $wp;
	if (array_key_exists ('page', $wp->query_vars) && $wp->query_vars['pagename'] == 'my-account' && in_the_loop()) {
		return  'סקירת חשבון';
	}
	if (array_key_exists ('orders', $wp->query_vars) && in_the_loop()) {
		return  'ההזמנות שלי';
	}
	if (array_key_exists ('my_wishlist', $wp->query_vars) && in_the_loop()) {
		return  'רשימת משאלות';
	}
	if (array_key_exists ('statistic', $wp->query_vars) && in_the_loop()) {
		return  'סטטיסטיקה';
	}
	if (array_key_exists ('balance', $wp->query_vars) && in_the_loop()) {
		return  'איזון';
	}
	if (array_key_exists ('payments', $wp->query_vars) && in_the_loop()) {
		return  'תשלומים';
	}
	if (array_key_exists ('delivery-addresses', $wp->query_vars) && in_the_loop()) {
		return  'מסירת כתובות';
	}
	if (array_key_exists ('definitions', $wp->query_vars) && in_the_loop()) {
		return  'הגדרות';
	}
	if (array_key_exists ('change_billing_info', $wp->query_vars) && in_the_loop()) {
		return  'ערוך מידע';
	}
	if (array_key_exists ('change_billing_address', $wp->query_vars) && in_the_loop()) {
		return  'ערוך את כתובת החיוב';
	}
	if (array_key_exists ('change_shipping_info', $wp->query_vars) && in_the_loop()) {
		return  'ערוך מידעу';
	}
	if (array_key_exists ('promotional', $wp->query_vars) && in_the_loop()) {
		return  'קודי קידום מכירות';
	}
	if (array_key_exists ('consultant', $wp->query_vars) && in_the_loop()) {
		return  'יועץ אישי';
	}
	if (array_key_exists ('help', $wp->query_vars) && in_the_loop()) {
		return  'עזרה';
	}
	if (array_key_exists ('change_password', $wp->query_vars) && in_the_loop()) {
		return  'שנה סיסמא';
	}
	if (array_key_exists ('logout', $wp->query_vars) && in_the_loop()) {
		return  'להתנתק';
	}
}

add_filter( 'the_title', 'my_account_endpoint_title', 10, 2 );
