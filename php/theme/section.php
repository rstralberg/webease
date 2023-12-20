<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db,'themes', 
        ['sectionW','sectionMargin','sectionBg','sectionFg',
        'sectionActBg','sectionBorder','sectionBorderColor','sectionShadow'], 
        db_where($db, 'theme', $args->theme));
    db_close($db);

    if( gettype($themes) !== 'array') {
        send_reject('Failed to load theme ' . $args->theme );
        exit(0);
    }
    $theme = $themes[0];


    send_resolve( load_form(__DIR__ . '/section', [
        'sectionW' => (int)$theme['sectionW'],
        'sectionMargin' => (int)$theme['sectionMargin'],
        'sectionBg' => $theme['sectionBg'],
        'sectionFg' => $theme['sectionFg'],
        'sectionActBg' => $theme['sectionActBg'],
        'sectionBorder' => $theme['sectionBorder'] === '1' ? 'checked' : '',
        'sectionBorderColor' => $theme['sectionBorderColor'],
        'sectionShadow' => $theme['sectionShadow'] === '1' ? 'checked' : '',
           
    ]));
}

?>
