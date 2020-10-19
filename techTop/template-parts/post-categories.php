<div class="blog-categories">
    <p>מיין לפי</p>
    <?php $categories = get_categories(); ?>
    <ul>
        <?php foreach($categories as $category): ?>
            <?php $active_class = ""; ?>
            <?php if(is_category( $category->term_id )) $active_class = "active"; ?>
            <li class="<?php echo $active_class; ?>">
                <a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>