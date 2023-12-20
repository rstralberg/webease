<?php

require_once __DIR__ . '/send_reply.php';
require_once __DIR__ . '/load_html.php';

function load_form(string $form, array $args ) : string {

    $loaded = load_html( $form . '.html', $args);
    if( $loaded ) 
        return compress_html($loaded);
    else 
        return compress_html('<p>Failed to load "'.$form.'"</p>');
}
