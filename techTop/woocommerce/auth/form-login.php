<?php
/**
 * Auth form login
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/auth/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Auth
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

//do_action( 'woocommerce_auth_page_header' ); ?>


<?php wc_print_notices(); ?>


<form class="woocommerce-form woocommerce-form-login login" method="post">

<?php do_action( 'woocommerce_login_form_start' ); ?>

<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
<label for="username"><?php esc_html_e( 'חוקל רפסמ', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
</p>
<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
<label for="password"><?php esc_html_e( 'המסיס', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
</p>

<?php do_action( 'woocommerce_login_form' ); ?>

<p class="form-row">
<p class="woocommerce-LostPassword lost_password">
<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( '?אמסס תחכש', 'woocommerce' ); ?></a>
</p>
<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
</p>


<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>

<?php //do_action( 'woocommerce_auth_page_footer' ); ?>
