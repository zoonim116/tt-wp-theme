<?php get_header(); ?>
<div class="container">

</div>


<?php
$top_categories   = get_categories( [
	'taxonomy'     => 'product_cat',
	'hierarchical' => 1,
	'title_li'     => '',
	'hide_empty'   => 1,
	'parent'       => 0
] );
$child_categories = [];
foreach ( $top_categories as $index => $tc ) {
//	if ( $tc->term_id == 15 ) {
//		unset( $top_categories[ $index ] );
//	}
	$cat = get_categories( [
		'taxonomy'     => 'product_cat',
		'hierarchical' => 0,
		'title_li'     => '',
		'hide_empty'   => 1,
		'child_of'       => $tc->term_id
	] );
	$child_categories[ $tc->term_id ][] = $cat;
}
?>
<section class="home-category">
    <div class="home-category-header">
        <div class="container">
            <h3>מוצרים לפי קטגוריה</h3>
        </div>
    </div>
    <?php $counter = 0; ?>
    <?php foreach ($top_categories as $index => $parent_category): ?>
        <div class="home-category-item">
            <div class="container">
                <div class="home-category-item-header">
                    <div class="home-category-item-header-img">
                        <img src="<?php echo carbon_get_term_meta($parent_category->term_id, 'crb_homepage_banner_thumb')?>">
                    </div>
                    <h4><a href="<?php echo get_term_link($parent_category->term_id); ?>"><?php echo $parent_category->name; ?></a></h4>
                </div>
                <div class="home-category-products-slider">
                    <div class="catalog-products-list catalog-all-list" id="catalog-products-list-1">
                        <?php foreach ($child_categories[$parent_category->term_id][0] as $child): ?>
                            <div class="catalog-products-item">
                                <div class="item-wrap">
                                    <div class="item-info">
                                        <p class="title"><a href="<?php echo get_term_link($child->term_id); ?>"><?php echo $child->name; ?> </a></p>
                                        <div class="count">
                                            <span>5</span>
                                            <span>מוצרים למכירה</span>
                                        </div>
                                    </div>
                                    <div class="item-img">
                                        <a href="<?php echo get_term_link($child->term_id); ?>">
                                            <img src="<?php echo carbon_get_term_meta($child->term_id, 'crb_homepage_banner_thumb')?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="arrows-slider">
                    <span class="next">
                        <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                              d="M12.9998 21L3.24975 11.5L12.9998 2L11.2498 0.25L-0.000250354 11.5L11.2498 22.75L12.9998 21Z"
                              fill="black"/>
                        </svg>
                    </span>
                        <span class="prev">
                        <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6.10352e-05 2L9.75006 11.5L6.10352e-05 21L1.75006 22.75L13.0001 11.5L1.75006 0.249988L6.10352e-05 2Z"
                                  fill="black"/>
                        </svg>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($counter == 0): ?>
            <div class="banners-set catalog-all-banners">
                <div class="container">
                    <div class="banners-set-flex">
                        <div class="banners-set-second">
                            <div class="first-img">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/set2.png">
                            </div>
                            <div class="set-info">
                                <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                <p class="title">Ohms 2 W into2000x2 קפסה רבגמ</p>
                                <div class="item-price">
                                    <p>₪1.267</p>
                                    <p class="old-price">₪1.700</p>
                                </div>
                            </div>
                        </div>
                        <div class="banners-set-first">
                            <div class="first-img">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/set1.png">
                            </div>
                            <div class="set-info">
                                <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                <p class="title">פדלבורד איכותי</p>
                                <div class="item-price">
                                    <p>₪1.267</p>
                                    <p class="old-price">₪1.700</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($counter == 3): ?>
            <div class="banners-set banners-set-left">
                <div class="container">
                    <div class="banners-set-flex">
                        <div>
                            <div class="banners-set-second">
                                <div class="first-img">
                                    <img src="<?php echo get_template_directory_uri()?>/images/set2.png">
                                </div>
                                <div class="set-info">
                                    <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                    <p class="title">110 VCO/VCF/VCA</p>
                                    <div class="item-price">
                                        <p>₪1.267</p>
                                        <p class="old-price">₪1.700</p>
                                    </div>
                                </div>
                            </div>
                            <div class="banners-set-last">
                                <div class="first-img">
                                    <img src="<?php echo get_template_directory_uri()?>/images/set3.png">
                                </div>
                                <div class="set-info">
                                    <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                    <p class="title">X-TOUCH</p>
                                    <div class="item-price">
                                        <p>₪1.267</p>
                                        <p class="old-price">₪1.700</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="banners-set-first">
                            <div class="first-img">
                                <img src="<?php echo get_template_directory_uri()?>/images/set1.png">
                            </div>
                            <div class="set-info">
                                <p class="sale"><span>15% - </span>הצעה מיוחדת</p>
                                <p class="title">DJ Headphones HPX6000</p>
                                <div class="item-price">
                                    <p>₪1.267</p>
                                    <p class="old-price">₪1.700</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php $counter++; ?>
    <?php endforeach; ?>
</section>
<section class="home-join-us">
    <div class="container">
        <div class="home-join-flex">
            <div class="home-join-sale">
                <div>
                    <span class="count">1098</span>
                    <p>טובין במלאי חידוש הבסיס בכל שבוע</p>
                </div>
                <div>
                    <span class="count">25%</span>
                    <p>הנחות קבועות בכל שבוע</p>
                </div>
            </div>
            <div class="home-join-form">
                <p class="subtitle">היה הראשון לדעת על הנחות ומבצעים</p>
                <p class="title">הצטרף כמנוי לניוזלטר</p>
                <form>
                    <p>אימייל</p>
                    <div class="form-group">
                        <input class="input" type="email">
                        <button class="btn btn-blue">להירשם</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
