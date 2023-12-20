<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../generate/fonts.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [])) {

    $db = db_open($args->key);
    $theme_names = db_select($db,'themes', ['*'], null, db_order_by('theme', 'asc'));
    db_close($db);

    if( gettype($theme_names) !== 'array') {
        send_reject('Failed to load themes');
        exit(0);
    }
    $themes = '';
    foreach( $theme_names as $theme_name) {
        $themes .= '<option value="' . $theme_name['theme'] . '">' . $theme_name['theme']  . '</option>';
    }

    send_resolve( load_form(__DIR__ . '/edit', [
        'themes' => $themes
    ]));
}

?>
