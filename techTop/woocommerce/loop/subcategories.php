<div class="category-footer">
	<?php foreach ($categories as $category): ?>
		<a href="<?php echo get_term_link( $category->term_id, 'product_cat' );?>"><?php echo $category->name; ?></a>
	<?php endforeach; ?>
</div>
