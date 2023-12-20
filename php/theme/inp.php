<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../generate/fonts.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db,'themes', 
        [ 'inpBg', 'inpFg', 'inpActBg', 'inpActFg', 'inpDisBg', 
            'inpDisFg', 'inpW', 'inpH', 'inpBorder', 'inpBorderColor', 
            'inpWeight', 'inpShadow'], 
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

    send_resolve( load_form(__DIR__ . '/inp', [
        'inpH' => (int)$theme['inpH'],
        'inpW' => (int)$theme['inpW'],
        'inpBg' => $theme['inpBg'], 
        'inpFg' => $theme['inpFg'], 
        'inpActBg' => $theme['inpActBg'],
        'inpActFg' => $theme['inpActFg'], 
        'inpDisBg' => $theme['inpDisBg'], 
        'inpDisFg' => $theme['inpDisFg'], 
        'inpWeight' => $theme['inpWeight'] === 'bold' ? 'checked' : '', 
        'inpBorder' => $theme['inpBorder'] === '1' ? 'checked' : '', 
        'inpBorderColor' => $theme['inpBorderColor'], 
        'inpShadow' => $theme['inpShadow'] === '1' ? 'checked' : ''
        ]));
}

?>
