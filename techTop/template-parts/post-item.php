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
            <div class="social-links">
                <a href="https://twitter.com/intent/tweet?url=<?php echo get_page_link(); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 18" fill="none">
                        <path d="M21.396 2.94661C20.6312 3.2861 19.8094 3.51473 18.9468 3.61779C19.8275 3.09037 20.5039 2.25463 20.8218 1.25868C19.9982 1.74713 19.0853 2.10221 18.1136 2.29361C17.3368 1.4648 16.2274 0.946899 15.001 0.946899C12.2479 0.946899 10.2248 3.5156 10.8466 6.18217C7.30361 6.00463 4.16158 4.30717 2.05795 1.72721C0.940744 3.64378 1.47856 6.15099 3.37694 7.42062C2.6789 7.3981 2.02071 7.2067 1.44652 6.88713C1.39975 8.86259 2.81574 10.7107 4.86654 11.1221C4.26637 11.2849 3.60904 11.323 2.94045 11.1949C3.4826 12.8889 5.05708 14.1212 6.92428 14.1559C5.13156 15.5615 2.8729 16.1894 0.610779 15.9226C2.4979 17.1325 4.7401 17.8383 7.14772 17.8383C15.0651 17.8383 19.5383 11.1516 19.2681 5.15417C20.1012 4.55226 20.8244 3.8014 21.396 2.94661Z" fill="#75A9F9" fill-opacity="0.41"/>
                    </svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_page_link(); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="21" viewBox="0 0 11 21" fill="none">
                        <path d="M2.59815 6.92839H0V10.3926H2.59815V20.7852H6.92839V10.3926H10.0825L10.3926 6.92839H6.92839V5.48469C6.92839 4.65761 7.09467 4.33025 7.89404 4.33025H10.3926V0H7.09467C3.98036 0 2.59815 1.37096 2.59815 3.99682V6.92839Z" fill="#75A9F9" fill-opacity="0.41"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>