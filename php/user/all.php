<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [])) {

    $db = db_open($args->key);
    $users = db_select($db, 'users', ['*'], null, db_order_by('username', 'asc'));
    db_close($db);

    if( gettype($users) !== 'array' ) {
        send_reject('Could not load any users');
        exit(0);
    }
    
    send_resolve( json_encode($users));
}

?>
