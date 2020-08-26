<section class="catalog-search">
	<div class="container">
		<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
			<div class="search-form">
				<input class="input" type="text" value="<?php echo get_search_query() ?>" name="s" id="s"  placeholder="חפש מוצר">
				<img src="<?php echo get_template_directory_uri(); ?>/images/search.svg">
			</div>
		</form>
	</div>
</section>
