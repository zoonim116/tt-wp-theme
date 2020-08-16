<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<?php
    wc_get_template( 'single-product/title.php' );
    wc_get_template( 'single-product/product-image.php' ); ?>

<div class="columns card-info">
    <div class="column is-5">
        <?php do_action( 'tt_single_product_summary' ); ?>
    </div>
    <div class="column delivery-wrap">
        <p><img src="<?php echo get_template_directory_uri(); ?>/images/delivery.svg"> <a href="#">משלוח ותשלום</a></p>
        <p><img src="<?php echo get_template_directory_uri(); ?>/images/return.svg"> <a href="#">תנאי החזרה</a></p>
    </div>
</div>
<div class="card-price">
	<?php do_action('tt_template_single_price'); ?>
    <div class="btn-group">
        <?php
                echo apply_filters(
                    'woocommerce_loop_add_to_cart_link',
                    sprintf(
                        '<a href="%s" data-product_id="%s" data-product_sku="%s" class="btn btn-blue %s product_type_%s">%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( $product->get_id() ),
                        esc_attr( $product->get_sku() ),
                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                        esc_attr( $product->product_type ),
                        esc_html( $product->add_to_cart_text() )
                    ),
                    $product
                );?>
        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
    </div>
</div>
<div class="card-param">
    <p class="title">מאפייני מוצר</p>
    <div class="columns">
        <?php wc_get_template( 'single-product/product-attributes.php' ); ?>
        <?php do_action('tt_show_attributes_list'); ?>
    </div>
</div>
<div class="columns card-properties is-multiline">
    <div class="column is-6">
        <p class="title">תוכנה</p>
	    <?php do_action('tt_show_software_list'); ?>
    </div>
    <div class="column is-6">
        <p class="title">נהגים</p>
        <?php do_action('tt_show_drivers_list'); ?>
    </div>
    <div class="column is-6">
        <p class="title">תיעוד</p>
        <?php do_action('tt_show_media_list'); ?>
    </div>
    <div class="column is-6">
        <p class="title">מדיה</p>
        <?php do_action('tt_show_documentation_list'); ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>


