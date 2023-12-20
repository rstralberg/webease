<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username'])) {

    $db = db_open($args->key);
    $users = db_select($db, 'users', ['*'], db_where($db, 'username', $args->username));
    db_close($db);

    if( gettype($users) !== 'array' ) {
        send_reject('Could not find requested user "'. $args->username . '"');
        exit(0);
    }
    
    send_resolve( json_encode($users[0]));
}

?>
