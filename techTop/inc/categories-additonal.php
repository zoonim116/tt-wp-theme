<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_category_options' );
function crb_attach_category_options() {
	Container::make( 'term_meta', __( 'Additional settings' ) )
	         ->where( 'term_taxonomy', '=', 'product_cat' )
	         ->add_fields([
	         	 Field::make( 'image', 'crb_additional_thumb', __( 'Navigation thumb' ))->set_type(['image' ])->set_value_type( 'url' ),
		         Field::make( 'image', 'crb_banner_thumb', __( 'Banner thumb' ))->set_type(['image' ])->set_value_type( 'url' ),
		         Field::make( 'text', 'crb_banner_url', __( 'Banner redirect url' ))->set_attribute('type', 'url'),
	         ]);
}