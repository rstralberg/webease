<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../generate/fonts.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db,'themes', 
        ['navW', 'navH', 'navMargin', 'navFg', 'navActBg', 'navActFg', 'navWeight'], 
        db_where($db, 'theme', $args->theme));
    db_close($db);

    if( gettype($themes) !== 'array') {
        send_reject('Failed to load theme ' . $args->theme);
        exit(0);
    }
    $theme = $themes[0];

    $fonts = '';
    $fontnames = get_fontnames();
    foreach($fontnames as $fontname) {
        $fonts .= '<options value="' . $fontname . '">' . $fontname . '</option>';
    }

    send_resolve( load_form(__DIR__ . '/nav', [
        'navW' => (int)$theme['navW'], 
        'navH' => (int)$theme['navH'], 
        'navMargin' => (int)$theme['navMargin'], 
        'navFg' => $theme['navFg'],
        'navActBg' => $theme['navActBg'],
        'navActFg' => $theme['navActFg'],
        'navWeight' => $theme['navWeight'] === 'bold' ? 'checked' : '',
        ]));
}

?>
