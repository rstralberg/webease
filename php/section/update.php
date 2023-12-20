<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['id','pos', 'align', 'content'])) {

    $db = db_open($args->key);
    
    $res = db_update($db, 'sections', 
        [ 'pos', 'align', 'content'],
        [ $args->pos, $args->align, rawurldecode($args->content)],
        db_where($db, 'id', $args->id));
    db_close($db);
    if( $res === false ) {
        send_reject('Could not update section "' . $args->id . '"');
        exit(0);
    }
    
    send_resolve(true);
    exit(0);
}
