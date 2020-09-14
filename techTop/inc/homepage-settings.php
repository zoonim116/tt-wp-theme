<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_homepage_options' );

function crb_attach_homepage_options() {
	Container::make( 'post_meta', __( 'Homepage Settings' ) )
	         ->where( 'post_id', '=', get_option( 'page_on_front' ) )
	         ->add_tab( __( 'Top Slider' ), [
			         Field::make( 'complex', 'crb_top_slider', __( 'Top Slider' ) )
		                ->add_fields([
							Field::make('image', 'crb_ts_background', __('Background image'))->set_value_type( 'url' ),
							Field::make('association', 'crb_ts_category', __('Category'))
							->set_types( [
								[
									'type' => 'term',
									'taxonomy' => 'product_cat'
								]
							])->set_max(1),
			                Field::make('text', 'crb_ts_product_count', __('Products'))->set_attribute('type', 'number'),
			                Field::make('rich_text', 'crb_ts_description', __('Description'))
		                ])
		                ->set_collapsed(true)
	         ])
			->add_tab(__('Our brands'), [
				Field::make( 'complex', 'crb_our_brands', __( 'Brands' ) )
				     ->add_fields([
					     Field::make('image', 'crb_brands_img', __('Brand image'))->set_value_type( 'url' ),
					     Field::make('text', 'crb_ts_brand_slug', __('Brand Slug')),
				     ])
			]);
}
