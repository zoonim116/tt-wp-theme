<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="logout white-bg">
	<p class="title">האם אתה בטוח שברצונך להתנתק?</p>
	<div class="button-group">
		<a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )?>" class="btn btn-orange">לשמור</a>
		<a href="<?php echo esc_url(wc_get_page_permalink( 'myaccount' )); ?>" class="btn">לבטל</a>
	</div>
</div>
