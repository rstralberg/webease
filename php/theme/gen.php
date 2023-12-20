<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../generate/fonts.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['theme'])) {

    $db = db_open($args->key);
    $themes = db_select($db,'themes', 
        ['font','fontsize','bg',  'contentW', 'footerH', 'borderRadius',
        'sectionTitleFg', 'sectionTitleBorder', 'sectionTitleBorderColor', 
        'sectionTitleShadow', 'weblinkFg'], 
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
        if( $fontname === $theme['font']  )
            $fonts .= '<option selected value="' . $fontname . '">' . $fontname . '</option>';
        else 
            $fonts .= '<option value="' . $fontname . '">' . $fontname . '</option>';
    }

    send_resolve( load_form(__DIR__ . '/gen', [
        'theme' => $args->theme,
        'fonts' => $fonts,
        'fontsize' => (int)$theme['fontsize'],
        'contentW' => (int)$theme['contentW'],
        'footerH' => (int)$theme['footerH'],
        'borderRadius' => (int)$theme['borderRadius'],
        'bg' => $theme['bg'],
        'sectionTitleFg' => $theme['sectionTitleFg'],
        'sectionTitleBorder' => $theme['sectionTitleBorder'],
        'sectionTitleBorderColor' => $theme['sectionTitleBorderColor'],
        'sectionTitleShadow' => $theme['sectionTitleShadow'],
        'weblinkFg' => $theme['weblinkFg']

        ]));
}

?>
