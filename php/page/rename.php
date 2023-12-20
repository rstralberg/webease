<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid', 'title'])) {

     $db = db_open($args->key);
     db_update($db, 'pages', ['title'], [$args->title], db_where($db, 'id', $args->pageid));
     db_close($db);
     send_resolve(true);
}

