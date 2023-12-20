<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../generate/fonts.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db,'themes', 
        ['formBg', 'formFg', 'formBorder', 'formBorderColor', 'formShadow'], 
        db_where($db, 'theme', $args->theme));
    db_close($db);

    if( gettype($themes) !== 'array') {
        send_reject('Failed to load theme ' . $args->theme);
        exit(0);
    }
    $theme = $themes[0];

    send_resolve( load_form(__DIR__ . '/form', [
        'formBg' => $theme['formBg'], 
        'formFg' => $theme['formFg'], 
        'formBorder' => $theme['formBorder'] === '1' ? 'checked' : '', 
        'formBorderColor' => $theme['formBorderColor'], 
        'formShadow' => $theme['formShadow'] === '1' ? 'checked' : '',
        ]));
}

?>
