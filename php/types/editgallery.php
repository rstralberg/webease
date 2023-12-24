<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['id','pageid','shadow', 'images'])) {
    
    $images = '';
    for($i=0; $i < count($args->images); $i++) {
        $images .= '<figure class="gallery-figure" onclick="edit_gallery_image_clicked(this)"><img src="sites/' .
            $args->key . '/' . $args->pageid . '/' . $args->images[$i] . '" ' ;
        if( $args->shadow ) $images .= ' class="shadow" ';
        $images .= '></figure>';
    }

    send_resolve(load_form(__DIR__ . '/editgallery', [
        'images' => $images
    ]));
}
