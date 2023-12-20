<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [ 'username', 'fullname', 'email', 'picture', 'password'])) {

    $db = db_open($args->key);
    $id = db_insert($db, 'users', 
        [ 'username', 'fullname', 'email', 'picture', 'password','adm'], 
        [ $args->username, $args->fullname,$args->email,$args->picture,
            password_hash($args->password, PASSWORD_DEFAULT), 0]);

    db_close($db);
    
    send_resolve( true );
}

?>
