<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username','fullname','email','picture','password'])) {

    $db = db_open($args->key);
    
    $res = db_update($db, 'users', 
        ['fullname','email','picture','password'],
        [$args->fullname,$args->email,$args->picture,
        password_hash($args->password, PASSWORD_DEFAULT)],
        db_where($db, 'username', $args->username));
    
        db_close($db);
    if( $res === false ) {
        send_reject('Could not update user "' . $args->username . '"');
        exit(0);
    }
    
    send_resolve(true);
    exit(0);
}
