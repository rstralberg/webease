<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [])) {

    $db = db_open($args->key);
    $dbpages = db_select($db, 'pages', ['id','title'], db_where($db, 'isParent', '1'));
    db_close($db);

    $pages = '';
    if( gettype($dbpages) ===  'array') {
        foreach($dbpages as $page) {
            $pages .= '<option value="' . $page['id'] . '">Under ' . $page['title'] . '</option>';
        }
    }

    send_resolve( load_form(__DIR__ . '/add', [
        'pages' => $pages,
    ]));
}

?>
