<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/verify_client_args.php';

if (verify_args($args, ['pageid','title'])) {

    $db = db_open($args->key);
    $res = db_update($db, 'pages', ['title'], [$args->title], db_where($db, 'id', $args->pageid));
    db_close($db);
    if( $res === false ) {
        send_reject('Failed to rename page');
    } 
    else if (gettype($res) === 'string' ) {
        send_reject($res);
    }
    else {
        send_resolve($res);
    }
}

