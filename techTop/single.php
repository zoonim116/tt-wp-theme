<?php get_header(); ?>
<?php  if ( have_posts() ){ 
    while( have_posts() ){
        the_post(); ?>
<section class="single-news">
    <div class="container">
        <div class="single-news-all">
            <?php do_action( 'tt_show_post_big_thumbnail_action' ); ?>
            <div class="news-wrap">
                <h1 class="title"><?php the_title() ?></h1>
                <p class="short-description">
                    <?php echo carbon_get_post_meta(get_the_ID(), 'crb_short_description'); ?>
                </p>
                <div class="news-content">
                    <?php the_content(); ?>
                </div>
                <div class="news-footer">
                    <div>
                        <p><?php echo get_the_author(); ?></p>
                        <p><strong><?php echo get_the_date(); ?></strong></p>
                    </div>
                    <?php get_template_part( 'template-parts/post-item', 'social-links' ); ?>
                </div>
            </div>
        </div>
        <div class="news-pagination">
            <?php if($prev_post = get_previous_post()): ?>
                <div class="prev">
                    <a href="<?php echo get_permalink( $prev_post ); ?>">
                        <div class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                <path d="M23.9297 11.0273L12.9023 22.0547L11.8477 21L21.0703 11.7773H0V10.2773H21.0703L11.8477 1.05469L12.9023 0L23.9297 11.0273Z" fill="#0060FE"/>
                            </svg>
                        </div>
                        <div>
                            <p>קודם</p>
                            <p><?php echo esc_html( $prev_post->post_title ); ?></p>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <?php if($next_post = get_next_post()): ?>
                <div class="next">
                    <a href="<?php echo get_permalink( $next_post ); ?>">
                        <div>
                            <p>הבא</p>
                            <p><?php echo esc_html($next_post->post_title); ?></p>
                        </div>
                        <div class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" viewBox="0 0 25 23" fill="none">
                                <path d="M0.766603 11.0273L11.7939 -1.12796e-06L12.8486 1.05469L3.62598 10.2773L24.6963 10.2773L24.6963 11.7773L3.62598 11.7773L12.8486 21L11.7939 22.0547L0.766603 11.0273Z" fill="#0060FE"/>
                            </svg>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php do_action('tt_show_post_banners_action'); ?>
<?php do_action('tt_show_related_posts_action'); ?>
<?php } } ?>
<?php get_template_part('template-parts/join-form'); ?>
<?php get_footer(); ?>