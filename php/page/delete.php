<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid'])) {

    $db = db_open($args->key);
    db_delete($db, 'pages', db_where($db, 'id', $args->pageid));
    db_close($db);

    send_resolve(true);
}

?>
