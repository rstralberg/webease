<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';
require_once __DIR__ . '/../db/tables/pages_table.php';

if (verify_args($args, ['id'])) {

    $db = db_open($args->key);
    $articleId = (int)substr($args->id,1);
    db_delete($db, 'articles', db_where($db, 'id', $articleId));

    db_delete($db, 'sections', db_where($db, 'articleId', $articleId));
    db_close($db);

    send_resolve(true);
}

?>
