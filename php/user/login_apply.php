<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username', 'password'])) {

    $db = db_open($args->key);
    $users = db_select($db, 'users', ['*'], db_where($db, 'username', $args->username));
    db_close($db);

    if ($users === false) {
        send_reject('Användaren finns inte');
        exit(0);
    } 

    $user = $users[0];
    $res = password_verify($args->password, $user['password']);

    if ($res) send_resolve(json_encode($user));
    else send_reject('Felaktigt lösenord');
}
