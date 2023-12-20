<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['formId', 'title', 'label', 'callback', 'value'])) {

    send_resolve( load_form(__DIR__.'/simple', [
        'formId' => $args->formId,
        'title' => $args->title,
        'label' => $args->label,
        'callback' => $args->callback,
        'value' => $args->value,
        'id' => 'si'.rand(1,1000)
    ]) );
}

    

?>
