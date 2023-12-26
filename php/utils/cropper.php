<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['src', 'ratio'])) {
    
    send_resolve(load_form(__DIR__ . '/cropper', [
        'src' => $args->src,
        'ratio' => $args->ratio
    ]));
}
