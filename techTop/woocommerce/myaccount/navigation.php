<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

	<ul>

		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
                    <div>
                        <?php switch ($endpoint) {
                            case  'dashboard': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/account.svg">
                            <?php break;
	                        case  'orders': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/my-orders.svg">
                            <?php break;
	                        case  'wishlist': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/like.svg">
                            <?php break;
	                        case  'statistic': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/statistics.svg">
                            <?php break;
	                        case  'balance': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/balance.svg">
                            <?php break;
	                        case  'payments': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/payments.svg">
                            <?php break;
	                        case  'delivery-addresses': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/map.svg">
		                        <?php break;
	                        case  'definitions': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/settings.svg">
		                        <?php break;
	                        case  'promotional': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/promo.svg">
		                        <?php break;
	                        case  'consultant': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/personal.svg">
		                        <?php break;
                            case  'help': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/help.svg">
		                        <?php break;
	                        case  'logout': ?>
                                <img src="<?php echo get_template_directory_uri()?>/images/logout.svg">
		                        <?php break;
                        } ?>
                    </div>
                    <div>
	                    <?php echo esc_html( $label ); ?>
                    </div>
                    </a>
			</li>
		<?php endforeach; ?>
	</ul>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
