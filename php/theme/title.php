<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db,'themes', 
        [ 'titleW', 'titleH', 'titleMargin', 'titleFg', 'titleStyle', 
            'titleWeight', 'titleBorder', 'titleBorderColor', 'titleShadow'
        ], 
        db_where($db, 'theme', $args->theme));
    db_close($db);

    if( gettype($themes) !== 'array') {
        send_reject('Failed to load theme ' . $args->theme );
        exit(0);
    }
    $theme = $themes[0];


    send_resolve( load_form(__DIR__ . '/title', [
        'titleW' => (int)$theme['titleW'],
        'titleH' => (int)$theme['titleH'],
        'titleMargin' => (int)$theme['titleMargin'],
        'titleFg' => $theme['titleFg'],
        'titleStyle' => $theme['titleStyle'] === 'italic' ? 'checked' : '',
        'titleWeight' => $theme['titleWeight'] === 'bold' ? 'checked' : '',
        'titleBorder' => $theme['titleBorder'] === '1' ? 'checked' : '',
        'titleBorderColor' => $theme['titleBorderColor'],
        'titleShadow' => $theme['titleShadow'] === '1' ? 'checked' : '',
           
    ]));
}

?>
