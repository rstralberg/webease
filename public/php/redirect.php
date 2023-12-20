<?php

require_once __DIR__ . '/../../php/utils/send_reply.php';
require_once __DIR__ . '/../../php/utils/verify_args.php';

$data = file_get_contents('php://input');

if ($data===null) {
    send_reject('Empty request!');
    exit(0);
}

try {
    $args = json_decode($data);
    if ($args === null) {
        send_reject('Failed to decode request');
        exit(0);
    }

    if( !verify_args($args)) {
        exit(0);
    }
    $require  = __DIR__ . '/../../php/' . $args->php . '.php'; 
    if( !file_exists( $require )) {
        send_reject('Could not find "' . $require . '"');
    }
    else {
        require_once  $require;
    }
} 
catch (Exception $ex) {
    send_reject($ex);
}
exit(0);

