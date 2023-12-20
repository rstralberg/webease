<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';
require_once __DIR__ . '/../db/tables/pages_table.php';

if (verify_args($args, ['id','articleId', 'numsections'])) {

    $db = db_open($args->key);

    db_delete($db, 'sections', db_where($db, 'id', $args->id));

    if( $args->numsections === 1) {
        db_insert($db, 'sections', 
            ['articleId', 'type', 'pos', 'align', 'content'],
            [$args->articleId, 'empty', 0, 'center', '']);
    }

    db_close($db);

    send_resolve(true);
}

?>
