<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';
require_once __DIR__ . '/table.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    
    db_delete($db, 'themes', db_where($db, 'theme', $args->theme));
    send_resolve(true);
    exit(0);
}
