<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';
require_once __DIR__ . '/../db/tables/pages_table.php';

if (verify_args($args, [ 'title', 'isParent', 'parentId' ])) {

    $db = db_open($args->key);

    $pages = db_select($db, 'pages', ['id'], db_where($db, 'title', $args->title));
    if( gettype($pages) === 'array' && count($pages) > 0  ) {
        db_close($db);
        send_reject('Sidan "'.$args->title.'" finns redan');
        exit(0);
    }

    $id = db_insert($db, 'pages', ['title','parentId','author','showTitle','pos','isParent','isPublic'],
        [ $args->title, $args->parentId, $args->username, 1,  0, $args->isParent, 1 ]);
     
    if( gettype($id) !== 'integer' || (int)$id === 0)  {
        db_close($db);
        send_reject('Failed to add page');
        exit(0);
    }
    
    $aid = db_insert($db, 'articles', 
        ['pageId','pos'],
        [$id, 0 ]);
    if( gettype($aid) !== 'integer' ) {
        db_close($db);
        send_reject('Failed to add page article');
        exit(0);
    }

    $sid = db_insert($db, 'sections', 
        ['articleId','type','pos','align','content'],
        [$aid,'title', 0, 'center', json_encode( [
            'title' => 'Rubrik'])]);
    if( gettype($sid) !== 'integer' ) {
        db_close($db);
        send_reject('Failed to add article section');
        exit(0);
    }

    $pages = db_select($db, 'pages', ['id','title','isPublic'], db_where($db, 'id', $id));
    db_close($db);
    if( gettype($pages) !== 'array') {
        send_reject($pages);    
        exit(0);
    }
    send_resolve(json_encode($pages[0]));
}

?>
