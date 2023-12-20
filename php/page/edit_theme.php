<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid'])) {

    $db = db_open($args->key);
    $pages = db_select($db,'pages', ['*'], db_where($db, 'id', $args->pageid));
    db_close($db);

    if( gettype($pages) !== 'array') {
        send_reject('Failed to load page ' . $args->pageid );
        exit(0);
    }
    $page = $pages[0];

    send_resolve( load_form(__DIR__ . '/edit_theme', [
        'titleW' => (int)$page['titleW'],
        'titleH' => (int)$page['titleH'],
        'titleMargin' => (int)$page['titleMargin'],
        'titleFg' => $page['titleFg'],
        'titleStyle' => $page['titleStyle'] === 'italic' ? 'checked' : '',
        'titleWeight' => $page['titleWeight'] === 'bold' ? 'checked' : '',
        'titleBorder' => $page['titleBorder'] === '1' ? 'checked' : '',
        'titleShadow' => $page['titleShadow'] === '1' ? 'checked' : '',
        'articleW' => (int)$page['articleW'],
        'articleMargin' => (int)$page['articleMargin'],
        'articleBg' => $page['articleBg'],
        'articleBorder' => $page['articleBorder'] === '1' ? 'checked' : '',
        'articleShadow' => $page['articleShadow'] === '1' ? 'checked' : '',
        'sectionW' => (int)$page['sectionW'],
        'sectionMargin' => (int)$page['sectionMargin'],
        'sectionBg' => $page['sectionBg'],
        'sectionFg' => $page['sectionFg'],
        'sectionActBg' => $page['sectionActBg'],
        'sectionBorder' => $page['sectionBorder'] === '1' ? 'checked' : '',
        'sectionShadow' => $page['sectionShadow'] === '1' ? 'checked' : '',
           
    ]));
}

?>
