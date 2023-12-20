<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username'])) {

    $db = db_open($args->key);
    $users = db_select($db, 'users', ['*'], db_where($db, 'username', $args->username));
    if( $users === false ) {
        db_close($db); 
        send_reject('Faild to load requested user ' . $args->username );
        exit(0);
    }
    if( gettype($users) === 'string' ) {
        db_close($db); 
        send_reject($users);
        exit(0);
    }
    send_resolve( load_form(__DIR__ . '/account', [
        'username' => $users[0]['username'],
        'fullname' => $users[0]['fullname'],
        'email' => $users[0]['email'],
        'picture' => 'sites/' . $args->key . '/users/' . $users[0]['picture']
    ]));
}

?>
