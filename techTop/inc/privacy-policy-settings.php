<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_privacy_policy_options' );

function crb_attach_privacy_policy_options() {
    Container::make( 'post_meta', __( 'Privacy Policy Settings' ) )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'page-privacy.php' )
    ->add_fields([
        Field::make( 'complex', 'crb_pp_content', __('Privacy Policy content') )
             ->add_fields([
                Field::make( 'text', 'crb_pp_title', __('Privacy Policy Title') ),
                Field::make( 'rich_text', 'crb_pp_content', __('Privacy Policy Content'))
             ])
             ->set_collapsed(true)
             ->set_header_template( '
           <% if (crb_pp_title ) { %>
                <%- crb_pp_title %>
           <% } %>
       ' )
    ]);
}