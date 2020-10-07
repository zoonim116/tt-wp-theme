<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
//do_action( 'woocommerce_account_navigation' ); ?>

<!--<div class="woocommerce-MyAccount-content">-->

<section class="main-section">
    <div class="container">
        <div class="notification-area"></div>
        <div class="columns">
            <div class="column is-3">
            </div>
            <div class="column is-9">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="columns">
            <div class="column is-3 nav-menu">
                <?php
                /**
                 * My Account navigation.
                 *
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_navigation' ); ?>
                <a class="more-btn remove1"></a>
            </div>
            <div class="column is-9">
	            <?php
	            /**
	             * My Account content.
	             *
	             * @since 2.6.0
	             */
	            do_action( 'woocommerce_account_content' );
	            ?>
            </div>
        </div>
    </div>
</section>
