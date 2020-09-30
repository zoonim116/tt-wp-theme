<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Theme Options' ) )
	         ->add_fields( [
		         Field::make( 'text', 'crb_phone', __( 'Phone' ) ),
		         Field::make( 'text', 'crb_fax', __( 'Fax' ) ),
		         Field::make( 'text', 'crb_address', __( 'Address' ) )
	         ] );
}
