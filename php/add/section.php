<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [ 'articleId', 'pos', 'align', 'type', 'content' ])) {

    $db = db_open($args->key);

    $id = db_insert($db, 'sections', 
        ['articleId', 'type', 'pos', 'align', 'content'],
        [(int)substr($args->articleId,1), $args->type, $args->pos, $args->align, $args->content]);
        
    if( gettype($id) === 'integer' && $id === 0  ) {
        db_close($db);
        send_reject('Could not add audo section to article "'.$args->articleId .'"');
        exit(0);
    }

    send_resolve($id);
}

?>
