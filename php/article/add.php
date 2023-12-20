<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [ 'pageId', 'pos' ])) {

    $db = db_open($args->key);

    $id = db_insert($db, 'articles', 
        ['pageId', 'pos'], 
        [$args->pageId, $args->pos]);
        
    if( gettype($id) === 'integer' && $id === 0  ) {
        db_close($db);
        send_reject('Could not add article to page "'.$args->pageid.'"');
        exit(0);
    }

    $id = db_insert($db, 'sections', 
        ['articleId','type', 'pos', 'align', 'content'],
        [$id, 'title', 0, 'center', json_encode( [
            'title' =>  'Rubrik'])]);
    if( gettype($id) === 'integer' && $id === 0  ) {
        db_close($db);
        send_reject('Could not add section to article "'.$id.'"');
        exit(0);
    }

    send_resolve(true);
}

?>
