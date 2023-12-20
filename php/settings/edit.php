<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [])) {

    $db = db_open($args->key);

    $settings = db_select($db, 'settings', ['*'], db_where($db, 'id', 1));
    $themes = db_select($db, 'themes', ['theme'], null, db_order_by('theme', 'asc'));
    
    db_close($db);

    if( $settings === false ) {
        send_reject('Could not load settings');
        exit(0);
    }
    if ( gettype($settings) === 'string') {
        send_reject($settings);
        exit(0);
    }

    $setting = $settings[0];
    $options = '';
    for($i=0; $i<count($themes); $i++) {
        if( $themes[$i]['theme'] === $setting['theme']) {
            $options .= '<option selected value="'. $themes[$i]['theme'].'">'.$themes[$i]['theme'].'</option>';
        }
        else {
            $options .= '<option value="'. $themes[$i]['theme'].'">'.$themes[$i]['theme'].'</option>';
        }
    }

    $logo = 'sites/' . $args->key . '/' . $setting['logo'];

    send_resolve( load_form(__DIR__ . '/edit', [
        'title' => $setting['title'],
        'owner' => $setting['owner'],
        'email' => $setting['email'],
        'logo' => $logo,
        'themes' => $options 
    ]));
}

?>
