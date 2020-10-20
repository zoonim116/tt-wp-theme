<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_blog_post_options' );

function crb_attach_blog_post_options() {
    Container::make( 'post_meta', __( 'Additional settings' ) )
     ->where( 'post_type', '=', 'post' )
     ->add_tab(__('Banner Settings'), [
        Field::make( 'complex', 'crb_post_banners')
        ->add_fields([
            Field::make( 'text', 'crb_url'),
            Field::make( 'image', 'crb_banner_image')
        ])
     ])
     ->add_tab(__('Post Settings'), [
        Field::make( 'rich_text', 'crb_short_description', 'Short Description' ),
        Field::make( 'image', 'crb_post_big_thumbnail', __( 'Big Thumbnail' ) )->set_type(['image'] )
    ]);
}