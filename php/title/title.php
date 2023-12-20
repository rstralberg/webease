<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid','username'])) {

    $db = db_open($args->key);
    
    $user = null;
    if( $args->username !== ' ') {
        $users = db_select($db, 'users', ['adm'], db_where($db, 'username', $args->username));
        if( gettype($users) === 'array') {
            $user = $users[0];
        }
    }

    $pages = db_select($db, 'pages', ['title','author','showTitle'], db_where($db, 'id', $args->pageid));
    if (db_result($pages, 'Failed to fetch page') === false) {
        exit(0);
    }
    $page = $pages[0];

    $showTools = $user && ( 
        $user['adm'] === '1' ||
        $user['username'] === $page['author'] ) ;

    $html = '<div class="'.($showTools?'header-with-tool':'header-without-tool').'">';
    
    $html.= $pages[0]['title'];
    $html.='</div>';

    db_close($db);

    send_resolve(compress_html($html));
    exit(0);
}
