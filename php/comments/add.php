<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username'])) {

    $db = db_open($args->key);
    $users = db_select($db, 'users', ['picture'], db_where($db, 'username', $args->username));
    db_close($db);

    if( db_result($users, 'Could not find user "' . $args->username . '"') === false ) exit(0);

    send_resolve( load_form(__DIR__ . '/addcomm', [
        'username' => $args->username,
        'picture' => 'sites/' . $args->key . '/users/' . $users[0]['picture'],
    ]));
}

?>
