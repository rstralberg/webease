<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid', 'size', 'url', 'caption', 'shadow'])) {

    $shadow = $args->shadow ? 'checked' : '';
    $folder = __DIR__ . '/../../public/sites/' . $args->key . '/' . $args->pageid ;
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $url = 'sites/' . $args->key . '/' . $args->pageid . '/' . $args->url;
    if( strlen($args->url) === 0 ) 
        $url = 'sites/' . $args->key . '/WebEase-128.png';
    try {
        send_resolve(load_form(__DIR__ . '/imageform', [
            'size' => $args->size,
            'url' => $url,
            'caption' => $args->caption,
            'shadow' => $shadow,
        ]));
    } catch (Exception $e) {
        send_reject('<p>'+$e->getMessage()+'</p>');
    }
}
