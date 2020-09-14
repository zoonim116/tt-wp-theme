<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_product_options' );
function crb_attach_product_options() {
	Container::make( 'post_meta', __( 'Additional settings' ) )
     ->where( 'post_type', '=', 'product' )
     ->add_tab( __( 'Drivers' ), [
	     Field::make( 'complex', 'crb_drivers', __( 'Drivers' ) )
	          ->add_fields([
		          Field::make( 'text', 'crb_title'),
		          Field::make( 'text', 'crb_url', __( 'Download URL' ) )->set_attribute('type', 'url'),
	          ])
	          ->set_header_template( '
			    <% if (crb_title) { %>
			        <%- crb_title %> 
			    <% } %>
			' )
	          ->set_collapsed(true)
     ])
	->add_tab('Software', [
		Field::make( 'complex', 'crb_software', __( 'Software' ) )
		     ->add_fields([
			     Field::make( 'text', 'crb_title'),
			     Field::make( 'text', 'crb_url', __( 'Download URL' ) )->set_attribute('type', 'url'),
		     ])
		     ->set_header_template( '
			    <% if (crb_title) { %>
			        <%- crb_title %> 
			    <% } %>
			' )
		     ->set_collapsed(true)
	])
	->add_tab('Media', [
			Field::make( 'complex', 'crb_media', __( 'Media' ) )
			     ->add_fields([
				     Field::make( 'text', 'crb_title'),
				     Field::make( 'text', 'crb_url', __( 'URL' ) )->set_attribute('type', 'url'),
			     ])
			     ->set_header_template( '
			    <% if (crb_title) { %>
			        <%- crb_title %> 
			    <% } %>
			' )
			     ->set_collapsed(true)
	])
		->add_tab('Documentation', [
			Field::make( 'complex', 'crb_documentation', __( 'Documentation' ) )
			     ->add_fields([
				     Field::make( 'text', 'crb_title'),
				     Field::make( 'text', 'crb_url', __( 'URL' ) )->set_attribute('type', 'url'),
			     ])
			     ->set_header_template( '
			    <% if (crb_title) { %>
			        <%- crb_title %> 
			    <% } %>
			' )
			     ->set_collapsed(true)
		])
	->add_tab('Videos', [
		Field::make( 'complex', 'crb_product_videos', __( 'Videos' ) )
			->add_fields([
				Field::make( 'file', 'crb_video', __('Video'))->set_type(['video']),
				Field::make( 'file', 'crb_video_thumbnail', __( 'Video Thumbnail' ) )->set_type(['image'])
			])
	]);
}
