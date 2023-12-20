<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_html.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid', 'cols', 'values'])) {

    $db = db_open($args->key);
    
    $pages = db_update($db, 'pages', $args->cols, $args->values, db_where($db, 'id', $args->pageid));
    if( $pages === false ) {
        send_reject('Kunde inte uppdatera sidan');
        exit(0);
    }
    else if ( gettype($pages) === 'string ') {
        send_reject($pages);
        exit(0);
    }
    
    $pages = db_select($db, 'pages', ['*'],  db_where($db, 'id', $args->pageid));
    if ($pages === false) {
        // No idea to continue without pages!!!!
        db_close($db);
        send_reject('Uppdatering av sidan misslyckades');
        exit(0);
    }
    else if ( gettype($pages) === 'string ') {
        send_reject($pages);
        exit(0);
    }
    send_resolve(json_encode($pages[0]));
    exit(0);
}
