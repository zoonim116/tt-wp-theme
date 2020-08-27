<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php $user_data = User::get_user_details(); ?>

<div class="white-bg form-container">
	<form id="billing-info">
        <p class="errors"></p>
		<div class="form-group">
			<p>שם</p>
			<input class="input" type="text" value="<?php echo $user_data->Name; ?>" id="Name" name="name">
		</div>
<!--		<div class="form-group">-->
<!--			<p>חברה</p>-->
<!--			<input class="input" type="text" value="Lion Guitars.LTD">-->
<!--		</div>-->
		<div class="form-group">
			<p>אימייל</p>
			<input class="input" type="email" value="<?php echo $user_data->EMail; ?>" id="EMail" name="EMail">
		</div>
		<div class="form-group">
			<p>טלפון</p>
			<input class="input" type="text" value="<?php echo $user_data->Phone; ?>" id="Phone" name="Phone">
		</div>
		<div class="button-group">
			<a href="#" class="btn btn-orange">לשמור</a>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'definitions' ) ); ?>" class="btn">לבטל</a>
		</div>
        <input type="hidden" id="Address" value="<?php echo $user_data->Address; ?>">
        <input type="hidden" id="City" value="<?php echo  $user_data->City; ?>">
        <input type="hidden" id="Country" value="ישראל">
	</form>
</div>
