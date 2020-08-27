<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="white-bg form-container">
    <form id="change-password">
        <p class="errors"></p>
        <p class="success"></p>
        <div class="form-group">
            <p>סיסמה ישנה</p>
            <input class="input" type="password" name="currPass" id="currPass" required>
            <span class="show-pass">
                <img src="<?php echo get_template_directory_uri() ?>/images/password.png">
            </span>
        </div>
        <div class="form-group">
            <p>סיסמה חדשה</p>
            <input class="input" type="password" name="newPass" id="newPass" required>
            <span class="show-pass">
                <img src="<?php echo get_template_directory_uri() ?>/images/password.png">
            </span>
        </div>
        <div class="form-group">
            <p>חזור על סיסמה חדשה</p>
            <input class="input" type="password" name="confPass" required>
            <span class="show-pass">
                <img src="<?php echo get_template_directory_uri() ?>/images/password.png">
            </span>
        </div>
        <div class="button-group">
            <a href="#" class="btn btn-orange">לשמור</a>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'definitions' ) ); ?>" class="btn">לבטל</a>
        </div>
    </form>
</div>
