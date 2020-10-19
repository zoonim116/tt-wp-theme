<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_blog_post_options' );

function crb_attach_blog_post_options() {
    Container::make( 'post_meta', __( 'Additional settings' ) )
     ->where( 'post_type', '=', 'post' )
     ->add_fields([
        Field::make( 'file', 'crb_post_big_thumbnail', __( 'Big Thumbnail' ) )->set_type(['image'])
    ]);
}