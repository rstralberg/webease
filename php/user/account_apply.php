<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username', 'fullname', 'email', 'picture', 'password'])) {

    $db = db_open($args->key);

    if( $args->password === '') {
        $res = db_update($db, 'users', 
        [ 'fullname', 'email', 'picture'], 
        [ $args->fullname, $args->email, $args->picture],
        db_where($db,'username', $args->username));
    }
    else {
        $res = db_update($db, 'users', 
        ['fullname', 'email', 'picture', 'password'], 
        [$args->fullname, $args->email, $args->picture, password_hash($args->password, PASSWORD_DEFAULT) ],
        db_where($db,'username', $args->username));
    }

    $users = db_select($db, 'users', ['username', 'fullname', 'email', 'picture', 'password'], db_where($db, 'username', $args->username));
    $user = $users[0];

    db_close($db);

    if( $res === false ) {
        send_reject('Kunde inte uppdatera användaren');
        exit(0);
    }
    else if ( gettype($res) === 'string') {
        send_reject($res);
        exit(0);
    }

    send_resolve(json_encode($user));
}

?>
