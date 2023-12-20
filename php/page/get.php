<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid'])) {

    $db = db_open($args->key);
    $pages = db_select($db, 'pages', ['*'], db_where($db, 'id', $args->pageid));
    db_close($db);

    if( gettype($pages) !== 'array' ) {
        send_reject('Could not find page ');
        exit(0);
    }
    send_resolve( json_encode($pages[0]));
}

?>
