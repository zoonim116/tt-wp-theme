<?php /* Template Name: Privacy Policy Page */ ?>
<?php get_header(); ?>
<?php $faqs = carbon_get_post_meta(get_the_ID(), 'crb_pp_content'); ?>
<section class="privacy-container">
    <div class="container">
        <div class="columns">
            <div class="column is-3">
            </div>
            <div class="column is-9">
                <h1>תקנון אתר טקטופ שיווק – תנאי שימוש ומדיניות פרטיות</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column is-3">
                <ul class="privacy-links">
                    <?php foreach($faqs as $index => $faq): ?>
                        <li><a href="#link<?php echo $index; ?>"><?php echo $faq['crb_pp_title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="column is-9">
                <div class="privacy-list">
                <?php foreach($faqs as $index => $faq): ?>
                    <div id="link<?php echo $index; ?>" class="privacy-item">
                        <p class="title"><?php echo $faq['crb_pp_title']; ?></p>
                        <div class="privacy-content">
                            <?php echo $faq['crb_pp_content']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>