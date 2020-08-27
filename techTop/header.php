<!DOCTYPE html>
<html dir="rtl" lang="he-IL">
<!--<html>-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action('display_woo_categories'); ?>
<?php get_search_form(); ?>
