<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['text'])) {

    send_resolve( load_form(__DIR__.'/linkform', [
        'text' => $args->text
    ]) );
}


?>
