<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_html.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['title', 'owner', 'email', 'logo','theme'])) {

    $db = db_open($args->key);
    
    $res = db_update($db, 'settings', 
        ['title', 'owner', 'email', 'logo','theme'],
        [$args->title, $args->owner, $args->email, $args->logo, $args->theme],
        db_where($db, 'id', 1));
    
    $settings = db_select($db, 'settings', ['*'], db_where($db, 'id', 1));
    db_close($db);

    if( $settings === false ) {
        send_reject('Could not update update settings');
        exit(0);
    }
    if ( gettype($settings) === 'string ') {
        send_reject($settings);
        exit(0);
    }
    
    send_resolve(json_encode($settings[0]));
    exit(0);
}
