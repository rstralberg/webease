<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db, 'themes', ['*'], db_where($db, 'theme', $args->theme));
    db_close($db);

    if( gettype($themes) !== 'array') {
        send_reject('Could not load theme "' . $args->theme . '"');
        exit(0);
    }

    send_resolve( json_encode($themes[0]));
}

?>
