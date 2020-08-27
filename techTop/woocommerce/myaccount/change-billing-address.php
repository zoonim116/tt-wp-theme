<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php $user_data = User::get_user_details(); ?>

<div class=" white-bg form-container">
    <form id="billing-address">
        <div class="form-group">
            <p>שם</p>
            <input class="input" type="text" name="BName" id="BName" value="<?php echo $user_data->BName; ?>">
        </div>
<!--        <div class="form-group">-->
<!--            <p>החברה</p>-->
<!--            <input class="input" type="text" value="Lion Guitars.LTD">-->
<!--        </div>-->
        <div class="form-group">
            <p>כתובת</p>
            <input class="input" type="text" name="BAddress" id="BAddress" value="<?php echo $user_data->BAddress;?>">
        </div>
        <div class="form-group">
            <p>עיר</p>
            <input class="input" type="text" name="BCity" id="BCity" value="<?php echo $user_data->BCity;?>">
        </div>
        <div class="form-group">
            <p>מחוז</p>
            <input class="input" type="text" name="BRegion" id="BRegion" value="<?php echo $user_data->BRegion; ?>">
        </div>
        <div class="form-group">
            <p>מיקוד</p>
            <input class="input" type="text" name="BZip" id="BZip" value="<?php echo $user_data->BZip; ?>">
        </div>
        <div class="form-group">
            <p>טלפון</p>
            <input class="input" type="text" name="BPhone" id="BPhone" value="<?php echo $user_data->BPhone; ?>">
        </div>
<!--        <div class="form-group">-->
<!--            <p>אימייל</p>-->
<!--            <input class="input" type="email" value="lguitars@gmail.com">-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <p>מזהה מע"מ</p>-->
<!--            <input class="input" type="text" value="029486839">-->
<!--        </div>-->
        <div class="button-group">
            <a href="#" class="btn btn-orange">לשמור</a>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'definitions' ) ); ?>" class="btn">לבטל</a>
        </div>
        <input type="hidden" name="EMail" id="EMail" value="<?php echo $user_data->EMail; ?>">
        <input type="hidden" name="Name" id="Name" value="<?php echo $user_data->Name; ?>">
        <input type="hidden" name="Address" id="Address" value="<?php echo $user_data->Address; ?>">
        <input type="hidden" name="City" id="City" value="<?php echo $user_data->City; ?>">
        <input type="hidden" name="Country" id="Country" value="<?php echo $user_data->Country; ?>">
        <input type="hidden" name="Phone" id="Phone" value="<?php echo $user_data->Phone; ?>">
    </form>
</div>
