<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['id','pos'])) {

    $db = db_open($args->key);
    
    $res = db_update($db, 'articles', 
        ['pos'],
        [$args->pos],
        db_where($db, 'id', $args->id));
    db_close($db);
    if( $res === false ) {
        send_reject('Could not update article "' . $args->id . '"');
        exit(0);
    }
    
    send_resolve(true);
    exit(0);
}
