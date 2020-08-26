<?php
$banner_url = $banner_image = null;
if ($wp_query->get_queried_object()->term_id) {
    $banner_image = carbon_get_term_meta($wp_query->get_queried_object()->term_id, 'crb_banner_thumb');
    $banner_url = carbon_get_term_meta($wp_query->get_queried_object()->term_id, 'crb_banner_url');
}
if ($banner_url && $banner_image): ?>
    <section class="catalog-banner">
        <a href="<?php echo $banner_url; ?>"><img src="<?php echo $banner_image;?>"></a>
    </section>
<?php endif; ?>