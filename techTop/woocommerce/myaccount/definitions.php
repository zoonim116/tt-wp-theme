<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php $user_data = User::get_user_details();
?>
<div class="settings-list">
	<div class="settings-item white-bg">
		<div class="settings-header">
			<p class="title">המידע שלך</p>
		</div>
		<div class="settings-body">
			<p><?php echo $user_data->Name; ?></p>
<!--			<p> דיו של לירי גיטרות.</p>-->
			<p><?php echo $user_data->EMail; ?></p>
			<p><?php echo $user_data->Phone; ?></p>
		</div>
		<div class="settings-footer">
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'change_billing_info' ) ); ?>" class="btn">ערוך</a>
		</div>
	</div>
	<div class="settings-item white-bg">
		<div class="settings-header">
			<p class="title">כתובת לחיוב</p>
		</div>
		<div class="settings-body">
			<p><?php echo $user_data->BName; ?></p>
<!--			<p>דיו של לירי גיטרות.</p>-->
			<p> <?php echo $user_data->BAddress; ?> <p>
			<p><?php echo $user_data->BCity;?></p>
			<p><?php echo $user_data->BRegion; ?></p>
			<p><?php echo $user_data->BZip; ?></p>
			<p><?php echo $user_data->BPhone; ?></p>
			<p><?php echo $user_data->EMail?></p>
<!--			<p>09484610</p>-->
		</div>
		<div class="settings-footer">
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'change_billing_address' ) ); ?>" class="btn">ערוך</a>
		</div>
	</div>
	<div class="settings-item white-bg">
		<div class="settings-header">
			<p class="title">אבטחה</p>
		</div>
		<div class="settings-body">
			<p>סיסמה <span>השתנה לפני שנה</span></p>
		</div>
		<div class="settings-footer">
			<a href="<?php echo wc_get_account_endpoint_url( 'change_password' );?>" class="btn">שנה סיסמא</a>
		</div>
	</div>
	<div class="settings-item white-bg">
		<div class="settings-header">
			<p class="title">העדפות יצירת קשר</p>
		</div>
		<div class="settings-body">
			<p>בחר באפשרויות שלך למטה ונשמור אותך על הקו.
				על מה תרצה לשמוע?</p>
			<div class="checkbox-set">
				<div class="info-checkbox">
					<input type="checkbox" id="check1" checked>
					<label for="check1">הנחה ומכירות</label>
				</div>
				<div class="info-checkbox">
					<input type="checkbox" id="check2" checked>
					<label for="check2">דברים חדשים</label>
				</div>
				<div class="info-checkbox">
					<input type="checkbox" id="check3" checked>
					<label for="check3">
						<span>התכלילים שלך</span><br>
						<span>ההנחות האישיות שלך</span>
					</label>
				</div>
			</div>
		</div>
		<div class="settings-footer">
			<a href="#" class="btn btn-orange">ערוך</a>
		</div>
	</div>
</div>
