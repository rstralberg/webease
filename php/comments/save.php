
<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid','username','picture','title','comment'])) {

    $db = db_open($args->key);

    $res = db_insert($db, 'comments', 
        ['pageId','author', 'date', 'title', 'comment'], 
        [$args->pageid, $args->username, DATE('Y-m-d'), $args->title, $args->comment ]);
    
    db_close($db);
    if( (int)$res <= 0 )  {
        send_reject('Failed to save comment');
        exit(0);
    }

    send_resolve(true);
    exit(0);
}
