<?php if($banners = carbon_get_post_meta(get_the_ID(), 'crb_post_banners')): ?>
    <section class="banners-wrap">
        <div class="container">
            <p class="title"></p>
            <div class="banners-container <?php echo count($banners) == 1 ? 'single' : 'twice'; ?>">
                <?php foreach($banners as $banner): ?>
                    <?php
                        $url = wp_get_attachment_url( $banner['crb_banner_image'] );
                        $alt = get_post_meta($banner['crb_banner_image'], '_wp_attachment_image_alt', TRUE);    
                    ?>
                    <a href="<?php echo $banner['crb_url'] ?>" target="_blank"><img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>"></a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>