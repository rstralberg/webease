<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme', 'cols', 'values'])) {

    $db = db_open($args->key);
    
    $res = db_update($db, 'themes', $args->cols, $args->values,
        db_where($db, 'theme', $args->theme));
    db_close($db);

    if( $res === false ) {
        send_reject('Could not update theme "' . $args->theme . '"');
        exit(0);
    }
    
    send_resolve(true);
    exit(0);
}
