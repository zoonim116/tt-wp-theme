<?php get_header(); ?>
<?php global $wp_query; ?>
<section class="blog-banner" style="background-image: url('<?php echo get_template_directory_uri( ); ?>/images/blog-banner.jpg')">
    <div class="container">
        <h1>בלוג</h1>
    </div>
</section>
<section>
    <div class="container">
        <?php get_template_part( 'template-parts/post', 'categories'); ?>
        <div class="news-list">
            <?php 
                if ( have_posts() ){
                    while( have_posts() ){
                        the_post();
                        get_template_part( 'template-parts/post', 'item' );
                    }
                }
            ?>
            <div class="blog-pagination is-hidden">
                <?php the_posts_pagination(); ?>
            </div>
        </div>
        <?php if ($wp_query->max_num_pages > 1): ?>
            <div class="news-more">
                <a href="#" class="btn btn-blue">טען עוד</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_template_part('template-parts/join-form'); ?>
<?php get_footer(); ?>