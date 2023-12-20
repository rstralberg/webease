<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';
require_once __DIR__ . '/../db/tables/themes_table.php';

if (verify_args($args, ['source', 'target'])) {

    $db = db_open($args->key);
    
    $themes = db_select($db, 'themes', ['*'], db_where($db, 'theme', $args->source));
    if( gettype($themes) !== 'array') {
        db_close($db);
        send_reject('Failed to load theme "'.$args->source.'"');
        exit(0);
    }

    $theme = $themes[0];
    $theme['theme'] = $args->target;
    $id = db_insert($db, 'themes', theme_cols, [
        $theme['theme'],
        $theme['font'],
        $theme['fontsize'],
        $theme['contentW'],
        $theme['borderRadius'],
        $theme['bg'],
        $theme['barBg'], 
        $theme['barBorder'], 
        $theme['barBorderColor'], 
        $theme['barShadow'],
        $theme['navH'], 
        $theme['navW'],
        $theme['navMargin'],
        $theme['navFg'], 
        $theme['navActBg'], 
        $theme['navActFg'],
        $theme['navWeight'],
        $theme['footerH'],
        $theme['footerStyle'], 
        $theme['footerWeight'],
        $theme['formBg'], 
        $theme['formFg'], 
        $theme['formBorder'], 
        $theme['formBorderColor'], 
        $theme['formShadow'],
        $theme['btnH'],
        $theme['btnW'],
        $theme['btnBg'], 
        $theme['btnFg'], 
        $theme['btnActBg'], 
        $theme['btnActFg'], 
        $theme['btnDisBg'], 
        $theme['btnDisFg'], 
        $theme['btnWeight'], 
        $theme['btnBorder'], 
        $theme['btnBorderColor'], 
        $theme['btnShadow'],
        $theme['inpH'],
        $theme['inpW'],
        $theme['inpBg'], 
        $theme['inpFg'], 
        $theme['inpActBg'],
        $theme['inpActFg'], 
        $theme['inpDisBg'], 
        $theme['inpDisFg'], 
        $theme['inpWeight'], 
        $theme['inpBorder'], 
        $theme['inpBorderColor'], 
        $theme['inpShadow'],
        $theme['titleH'],
        $theme['titleW'],
        $theme['titleMargin'],
        $theme['titleFg'], 
        $theme['titleStyle'],
        $theme['titleWeight'], 
        $theme['titleBorder'],
        $theme['titleBorderColor'],
        $theme['titleShadow'],
        $theme['articleW'],
        $theme['articleMargin'],
        $theme['articleBg'], 
        $theme['articleBorder'], 
        $theme['articleBorderColor'], 
        $theme['articleShadow'],
        $theme['sectionW'],
        $theme['sectionMargin'],
        $theme['sectionBg'], 
        $theme['sectionFg'], 
        $theme['sectionActBg'],
        $theme['sectionBorder'], 
        $theme['sectionBorderColor'], 
        $theme['sectionShadow'],
        $theme['sectionTitleFg'],
        $theme['sectionTitleBorder'],
        $theme['sectionTitleBorderColor'],
        $theme['sectionTitleShadow'],
        $theme['weblinkFg']
    
    ]);
    db_close($db);

    if( $id === false ) {
        send_reject('Could not clone theme "' . $args->source . '" to "' . $args->target . '"' );
        exit(0);
    }
    
    send_resolve($args->target);
    exit(0);
}
