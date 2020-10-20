<div class="news-item">
    <div class="news-img">
        <a href="<?php the_permalink( ); ?>" title="<?php the_title(); ?>">
            <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
        </a>
    </div>
    <div class="news-info">
        <a href="<?php the_permalink( ); ?>" title="<?php the_title(); ?>">
            <p class="title"><?php the_title(); ?></p>
        </a>
        <p><?php the_excerpt(); ?></p>
        <div class="news-footer">
            <div>
                <p><?php the_author(); ?></p>
                <p><strong><?php the_date(); ?></strong></p>
            </div>
            <?php get_template_part( 'template-parts/post-item', 'social-links' ); ?>
        </div>
    </div>
</div>