<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['title', 'message'])) {

    send_resolve( load_form(__DIR__.'/popup', [
        'title' => $args->title,
        'msg' => $args->message,
    ]) );
}

    

?>
