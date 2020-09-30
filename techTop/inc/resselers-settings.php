<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action( 'carbon_fields_register_fields', 'crb_attach_resellers_options' );

function crb_attach_resellers_options() {
	Container::make( 'post_meta', __( 'Resellers Settings' ) )
	         ->where( 'post_type', '=', 'page' )
	         ->where( 'post_template', '=', 'page-resselers.php' )
	         ->add_fields( [
		         Field::make( 'complex', 'crb_resellers' )
		              ->add_fields( [
			              Field::make( 'text', 'crb_location' ),
			              Field::make( 'complex', 'crb_resellers_details', __('Details') )
			                   ->add_fields([
				                   Field::make( 'text', 'crb_name' ),
				                   Field::make( 'text', 'crb_city' ),
				                   Field::make( 'text', 'crb_address' ),
				                   Field::make( 'text', 'crb_phone' ),
				                   Field::make( 'text', 'crb_fax' ),
				                   Field::make( 'text', 'crb_email' ),
			                   ])
				              ->set_collapsed(true)
				              ->set_header_template( '
						    <% if (crb_name ) { %>
						         <%- crb_name %>
						    <% } %>
						' )
		              ])
			         ->set_collapsed(true)
			         ->set_header_template( '
					    <% if (crb_location) { %>
					        <%- crb_location %>
					    <% } %>
					' ),
	         ]);
}
