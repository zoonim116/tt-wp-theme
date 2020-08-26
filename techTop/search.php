<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */

get_header();
global $wp_query;
?>
<section class="main-catalog">
	<div class="container">
		<h1>סקירת חשבון</h1>
			<?php if ( have_posts() ) { ?>
				<div class="catalog-products-list">
					<?php while ( have_posts() ) { the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php } ?>
				</div>
				<?php paginate_links(); ?>
			<?php } ?>
	</div>
</section>
<?php get_footer(); ?>