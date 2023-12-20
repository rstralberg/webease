<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['items'])) {

    $db = db_open($args->key);
    
    $items = json_decode($args->items);
    for( $i = 0; $i < count($items); $i++ ) {
        $item = $items[$i];
        db_update($db, 'sections', ['pos'], [$item->pos], db_where($db, 'id', $item->id));
    }
    db_close($db);
    send_resolve(true);
    exit(0);
}
