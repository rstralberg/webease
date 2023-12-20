<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [ 'id', 'align', 'pos', 'content' ])) {

    $db = db_open($args->key);

    $res = db_update($db, 'sections', 
        ['align', 'pos', 'content'],
        [$args->align, $args->pos, $args->content],
        db_where($db, 'id', (int)substr($args->id,1)));
        
    db_close($db);
    if( gettype($res) === 'boolean' && $res === false  ) {
        send_reject('Could not update section "'.$args->id .'"');
        exit(0);
    }

    send_resolve(true);
    exit(0);
}

?>
