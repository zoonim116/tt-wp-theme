<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php
global $wp_query;
$children_categories = get_term_children( $wp_query->get_queried_object()->term_id, 'product_cat' );
if ( count( $children_categories ) == 0 ): ?>
    </div>
    <?php if ($wp_query->max_num_pages > 1): ?>
        <div class="open-more">
            <a href="#" class="btn btn-blue">לטעון יותר</a>
        </div>
    <?php endif; ?>
<?php else: ?>
    </div>
<?php endif; ?>
<div class="have-question">
    <div class="have-question-image">
        <img src="<?php echo get_template_directory_uri(); ?>/images/question.png">
    </div>
    <div class="have-question-info">
        <p class="title">?ב תיפצ הנורחאל</p>
        <p>ךלש ישיאה ץעויה םע רשק רוצ</p>
        <a href="#" class="btn btn-blue">איש קשר </a>
    </div>
</div>
