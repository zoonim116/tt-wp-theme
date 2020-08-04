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
<section class="catalog-search">
    <div class="container">
        <form>
            <div class="search-form">
                <input class="input" type="search" placeholder="חפש מוצר">
                <img src="<?php echo get_template_directory_uri(); ?>/images/search.svg">
            </div>
        </form>
    </div>
</section>
