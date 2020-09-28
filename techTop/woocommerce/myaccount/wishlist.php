<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php $sort = 'ASC';
    if (in_array($_GET['sort'], ['ASC', 'DESC'])) {
        $sort = $_GET['sort'];
    }
?>
<?php $wishlist_data = User::get_wishlist($sort); ?>

<div class="filter-bar">
	<div class="status">
		<p>הופעה:</p>
		<a href="#">סטטוס 1</a>
		<a href="#">סטטוס 2</a>
		<a href="#">סטטוס 3</a>
	</div>
	<div class="sort-by">
		<p>מיין לפי:</p>
		<div class="select">
			<select name="wishlist_sorting">
                <?php if (!$_GET['SORT'] || $_GET['sort'] == 'ASC'): ?>
                    <option value="ASC" selected>ASC</option>
                <?php else: ?>
                    <option value="ASC">ASC</option>
                <?php endif; ?>
				<?php if ($_GET['sort'] == 'DESC'): ?>
                    <option value="DESC" selected>DESC</option>
				<?php else: ?>
                    <option value="DESC">DESC</option>
				<?php endif; ?>
			</select>
		</div>
	</div>
</div>
<div class="wishlist-wrap">
	<div class="wishlist-list">
		<?php if (count($wishlist_data->OutTab) > 0): ?>
			<?php foreach ($wishlist_data->OutTab as $item): ?>
				<?php $product_id = wc_get_product_id_by_sku($item[1]); ?>
                <?php if ($product_id): ?>
                    <?php $product = wc_get_product($product_id); ?>
                    <div class="products-item">
                        <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="item-img">
                            <img src="<?php echo get_post_meta($product->get_id(), 'remote_image', true); ?>">
						</a>
                        <div class="item-content">
                            <a href="<?php echo get_permalink( $product->get_id() ); ?>"> <p class="title"><?php echo $product->get_name(); ?></p></a>
                            <p class="description"><?php echo apply_filters( 'the_excerpt', $product->post->post_excerpt ); ?></p>
                        </div>
                        <div class="item-footer">
                            <p class="price">₪<?php echo $item['5']; ?></p>
                            <div class="item-icons">
                                <a href="#" data-sku="<?php echo $item[1]; ?>" class="wishlist active"><span></span></a>
                                <?php
                                echo apply_filters(
                                    'woocommerce_loop_add_to_cart_link',
                                    sprintf(
                                        '<a href="%s" data-product_id="%s" data-product_sku="%s" class="cart product_type_%s"><span></span></a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( $product->get_id() ),
                                        esc_attr( $product->get_sku() ),
                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                        esc_attr( $product->product_type ),
                                        esc_html( $product->add_to_cart_text() )
                                    ),
                                    $product
                                );?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="wishlist-show-more">
		<a href="#" class="btn">להראות יותר</a>
	</div>
</div>
<div class="appeared-products white-bg">
	<p class="title">הופיע במלאי</p>
	<div class="appeared-products-list">
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="removed-products white-bg">
	<p class="title">הוסר מהסל שלך</p>
	<div class="removed-products-list">
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
		<div class="products-item">
			<div class="item-img">
				<img src="images/new-product.jpg" alt="new product">
			</div>
			<div class="item-content">
				<p class="title">CRU-7 / CRU-7A</p>
				<p class="description">
					ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
					IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
				</p>
			</div>
			<div class="item-footer">
				<p class="price">₪670</p>
				<div class="item-icons">
					<a href="#" class="wishlist"><span></span></a>
					<a href="#" class="cart"><span></span></a>
				</div>
			</div>
		</div>
	</div>
</div>
