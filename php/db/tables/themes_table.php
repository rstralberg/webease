<?php

require_once __DIR__ . '/../db.php';

const theme_cols = [
    'theme',
    'font',
    'fontsize',
    'contentW',
    'borderRadius',
    'bg',
    'barBg', 
    'barBorder',
    'barBorderColor',
    'barShadow',
    'navH', 
    'navW',
    'navMargin',
    'navFg', 
    'navActBg', 
    'navActFg',
    'navWeight',
    'footerH',
    'footerStyle', 
    'footerWeight',
    'formBg', 
    'formFg', 
    'formBorder', 
    'formBorderColor', 
    'formShadow',
    'btnH',
    'btnW',
    'btnBg', 
    'btnFg', 
    'btnActBg', 
    'btnActFg', 
    'btnDisBg', 
    'btnDisFg', 
    'btnWeight', 
    'btnBorder', 
    'btnBorderColor', 
    'btnShadow',
    'inpH',
    'inpW',
    'inpBg', 
    'inpFg', 
    'inpActBg',
    'inpActFg', 
    'inpDisBg', 
    'inpDisFg', 
    'inpWeight', 
    'inpBorder', 
    'inpBorderColor', 
    'inpShadow',
    'titleH',
    'titleW',
    'titleMargin',
    'titleFg', 
    'titleStyle',
    'titleWeight', 
    'titleBorder',
    'titleBorderColor',
    'titleShadow',
    'articleW',
    'articleMargin',
    'articleBg', 
    'articleBorder', 
    'articleBorderColor', 
    'articleShadow',
    'sectionW',
    'sectionMargin',
    'sectionBg', 
    'sectionFg', 
    'sectionActBg', 
    'sectionBorder', 
    'sectionBorderColor', 
    'sectionShadow',
    'sectionTitleFg',
    'sectionTitleBorder',
    'sectionTitleBorderColor',
    'sectionTitleShadow',
    'weblinkFg'

];

// returns true if table was created
function create_themes_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'themes', theme_cols,
    [
        'VARCHAR(64) NOT NULL UNIQUE',// theme
        'VARCHAR(64) NOT NULL',//font'
        'VARCHAR(16) NOT NULL',//fontsize
        'VARCHAR(16) NOT NULL',//contentW
        'VARCHAR(16) NOT NULL',//borderRadius
        'VARCHAR(16) NOT NULL',//bg
        'VARCHAR(16) NOT NULL',//barBg'
        'TINYINT NOT NULL',//barBorder'
        'VARCHAR(16) NOT NULL',//barBorderColor'
        'TINYINT NOT NULL',//barShadow
        'VARCHAR(16) NOT NULL',//navH'
        'VARCHAR(16) NOT NULL',//navW
        'VARCHAR(16) NOT NULL',//navMargin
        'VARCHAR(16) NOT NULL',//navFg'
        'VARCHAR(16) NOT NULL',//navActBg'
        'VARCHAR(16) NOT NULL',//navActFg
        'VARCHAR(16) NOT NULL',//navWeight
        'VARCHAR(16) NOT NULL',//footerH
        'VARCHAR(16) NOT NULL',//footerStyle'
        'VARCHAR(16) NOT NULL',//footerWeight
        'VARCHAR(16) NOT NULL',//formBg'
        'VARCHAR(16) NOT NULL',//formFg'
        'TINYINT NOT NULL',//formBorder'
        'VARCHAR(16) NOT NULL',//formBorderColor'
        'TINYINT NOT NULL',//formShadow
        'VARCHAR(16) NOT NULL',//btnH
        'VARCHAR(16) NOT NULL',//btnW
        'VARCHAR(16) NOT NULL',//btnBg'
        'VARCHAR(16) NOT NULL',//btnFg'
        'VARCHAR(16) NOT NULL',//btnActBg'
        'VARCHAR(16) NOT NULL',//btnActFg'
        'VARCHAR(16) NOT NULL',//btnDisBg'
        'VARCHAR(16) NOT NULL',//btnDisFg'
        'VARCHAR(16) NOT NULL',//btnWeight'
        'TINYINT NOT NULL',//btnBorder'
        'VARCHAR(16) NOT NULL',//btnBorderColor'
        'TINYINT NOT NULL',//btnShadow
        'VARCHAR(16) NOT NULL',//inpH
        'VARCHAR(16) NOT NULL',//inpW
        'VARCHAR(16) NOT NULL',//inpBg'
        'VARCHAR(16) NOT NULL',//inpFg'
        'VARCHAR(16) NOT NULL',//inpActBg
        'VARCHAR(16) NOT NULL',//inpActFg'
        'VARCHAR(16) NOT NULL',//inpDisBg'
        'VARCHAR(16) NOT NULL',//inpDisFg'
        'VARCHAR(16) NOT NULL',//inpWeight'
        'TINYINT NOT NULL',//inpBorder'
        'VARCHAR(16) NOT NULL',//inpBorderColor'
        'TINYINT NOT NULL',//inpShadow
        'VARCHAR(16) NOT NULL',//titleH
        'VARCHAR(16) NOT NULL',//titleW
        'VARCHAR(16) NOT NULL',//titleMargin
        'VARCHAR(16) NOT NULL',//titleFg'
        'VARCHAR(16) NOT NULL',//titleStyle
        'VARCHAR(16) NOT NULL',//titleWeight'
        'TINYINT NOT NULL',//titleBorder
        'VARCHAR(16) NOT NULL',//titleBorderColor'
        'TINYINT NOT NULL',//titleShadow
        'VARCHAR(16) NOT NULL',//articleW
        'VARCHAR(16) NOT NULL',//articleMargin
        'VARCHAR(16) NOT NULL',//articleBg'
        'TINYINT NOT NULL',//articleBorder'
        'VARCHAR(16) NOT NULL',//articleBorderColor'
        'TINYINT NOT NULL',//articleShadow
        'VARCHAR(16) NOT NULL',//sectionW
        'VARCHAR(16) NOT NULL',//sectionMargin
        'VARCHAR(16) NOT NULL',//sectionBg'
        'VARCHAR(16) NOT NULL',//sectionFg'
        'VARCHAR(16) NOT NULL',//sectionActBg'
        'TINYINT NOT NULL',//sectionBorder'
        'VARCHAR(16) NOT NULL',//sectionBorderColor'
        'TINYINT NOT NULL', //sectionShadow
        'VARCHAR(16) NOT NULL',//sectionTitleFg',
        'TINYINT NOT NULL',//sectionTitleBorder',
        'VARCHAR(16) NOT NULL',//sectionTitleBorderColor',
        'TINYINT NOT NULL',//sectionTitleShadow',
        'VARCHAR(16) NOT NULL',//weblinkFg'
    

    ]);
}

// returns true if table was created 
function verify_themes_table(mysqli $db, string $database): bool | string
{
    if (db_table_exist($db, $database, 'themes') === false) {
        return create_themes_table($db, $database) ;
    }
    return false;
}

function get_default_theme() : array {

    return [
        'WebEase',// theme
        'Arial',//font'
        '1em',//fontsize
        '60vw',//contentW
        '16px',//borderRadius
        '#202020',//bg
        '#101010',//barBg'
        1,//barBorder'
        '#ffffff',//barBorderColor'
        1,//barShadow
        '7vh',//navH'
        '98vw',//navW
        '4vh',//navMargin
        '#ffffff',//navFg'
        '#a08000',//navActBg'
        '#ffffff',//navActFg
        'bold',//navWeight
        '3vh',//footerH
        'italic',//footerStyle'
        'normal',//footerWeight
        '#202020',//formBg'
        '#ffffff',//formFg'
        1,//formBorder'
        '#ffffff',//formBorderColor'
        1,//formShadow
        '2em',//btnH
        '8em',//btnW
        '#000000',//btnBg'
        '#ffffff',//btnFg'
        '#ffff00',//btnActBg'
        '#000000',//btnActFg'
        '#404040',//btnDisBg'
        '#808080',//btnDisFg'
        'bold',//btnWeight'
        1,//btnBorder'
        '#ffffff',//btnBorderColor'
        1,//btnShadow
        '1.5em',//inpH
        '3em',//inpW
        '#e0e0e0',//inpBg'
        '#000000',//inpFg'
        '#ffffff',//inpActBg
        '#000000',//inpActFg'
        '#404040',//inpDisBg'
        '#808080',//inpDisFg'
        'bold',//inpWeight'
        1,//inpBorder'
        '#ffffff',//inpBorderColor'
        0,//inpShadow
        '4vh',//titleH
        '100%',//titleW
        '2vh',//titleMargin
        '#ffffff',//titleFg'
        'italic',//titleStyle
        'bold',//titleWeight'
        1,//titleBorder
        '#ffffff',//titleBorderColor'
        1,//titleShadow
        '100%',//articleW
        '2vh',//articleMargin
        '#303030',//articleBg'
        1,//articleBorder'
        '#ffffff',//articleBorderColor'
        1,//articleShadow
        '80%',//sectionW
        '1vh',//sectionMargin
        '#404040',//sectionBg'
        '#ffffff',//sectionFg'
        '#505050',//sectionActBg'
        1,//sectionBorder'
        '#ffffff',//sectionBorderColor'
        1,//sectionShadow
        '#ffffff',//sectionTitleFg
        1,//sectionTitleBorder
        '#ffffff',//sectionTitleBorderColor
        1,//sectionTitleShadow
        '#ffc800'//weblinkFg
    
    ];
}

function backup_themes(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/themes.sql', 'w');
    if( $fh ) {
        $themes = db_select($db, 'themes', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($themes) === 'array' ) {
            foreach($themes as $theme) {
                $stmt = 'INSERT INTO ' . db_name('themes') . ' (' ;
                $stmt.= db_name('theme') . ',' ;
                $stmt.= db_name('font') . ',' ;
                $stmt.= db_name('fontsize') . ',' ;
                $stmt.= db_name('contentW') . ',' ;
                $stmt.= db_name('borderRadius') . ',' ;
                $stmt.= db_name('bg') . ',' ;
                $stmt.= db_name('barBg') . ',' ;
                $stmt.= db_name('barBorder') . ',' ;
                $stmt.= db_name('barBorderColor') . ',' ;
                $stmt.= db_name('barShadow') . ',' ;
                $stmt.= db_name('navH') . ',' ;
                $stmt.= db_name('navW') . ',' ;
                $stmt.= db_name('navMargin') . ',' ;
                $stmt.= db_name('navFg') . ',' ;
                $stmt.= db_name('navActBg') . ',' ;
                $stmt.= db_name('navActFg') . ',' ;
                $stmt.= db_name('navWeight') . ',' ;
                $stmt.= db_name('footerH') . ',' ;
                $stmt.= db_name('footerStyle') . ',' ;
                $stmt.= db_name('footerWeight') . ',' ;
                $stmt.= db_name('formBg') . ',' ;
                $stmt.= db_name('formFg') . ',' ;
                $stmt.= db_name('formBorder') . ',' ;
                $stmt.= db_name('formBorderColor') . ',' ;
                $stmt.= db_name('formShadow') . ',' ;
                $stmt.= db_name('btnH') . ',' ;
                $stmt.= db_name('btnW') . ',' ;
                $stmt.= db_name('btnBg') . ',' ;
                $stmt.= db_name('btnFg') . ',' ;
                $stmt.= db_name('btnActBg') . ',' ;
                $stmt.= db_name('btnActFg') . ',' ;
                $stmt.= db_name('btnDisBg') . ',' ;
                $stmt.= db_name('btnDisFg') . ',' ;
                $stmt.= db_name('btnWeight') . ',' ;
                $stmt.= db_name('btnBorder') . ',' ;
                $stmt.= db_name('btnBorderColor') . ',' ;
                $stmt.= db_name('btnShadow') . ',' ;
                $stmt.= db_name('inpH') . ',' ;
                $stmt.= db_name('inpW') . ',' ;
                $stmt.= db_name('inpBg') . ',' ;
                $stmt.= db_name('inpFg') . ',' ;
                $stmt.= db_name('inpActBg') . ',' ;
                $stmt.= db_name('inpActFg') . ',' ;
                $stmt.= db_name('inpDisBg') . ',' ;
                $stmt.= db_name('inpDisFg') . ',' ;
                $stmt.= db_name('inpWeight') . ',' ;
                $stmt.= db_name('inpBorder') . ',' ;
                $stmt.= db_name('inpBorderColor') . ',' ;
                $stmt.= db_name('inpShadow') . ',' ;
                $stmt.= db_name('titleH') . ',' ;
                $stmt.= db_name('titleW') . ',' ;
                $stmt.= db_name('titleMargin') . ',' ;
                $stmt.= db_name('titleFg') . ',' ;
                $stmt.= db_name('titleStyle') . ',' ;
                $stmt.= db_name('titleWeight') . ',' ;
                $stmt.= db_name('titleBorder') . ',' ;
                $stmt.= db_name('titleBorderColor') . ',' ;
                $stmt.= db_name('titleShadow') . ',' ;
                $stmt.= db_name('articleW') . ',' ;
                $stmt.= db_name('articleMargin') . ',' ;
                $stmt.= db_name('articleBg') . ',' ;
                $stmt.= db_name('articleBorder') . ',' ;
                $stmt.= db_name('articleBorderColor') . ',' ;
                $stmt.= db_name('articleShadow') . ',' ;
                $stmt.= db_name('sectionW') . ',' ;
                $stmt.= db_name('sectionMargin') . ',' ;
                $stmt.= db_name('sectionBg') . ',' ;
                $stmt.= db_name('sectionFg') . ',' ;
                $stmt.= db_name('sectionActBg') . ',' ;
                $stmt.= db_name('sectionBorder') . ',' ;
                $stmt.= db_name('sectionBorderColor') . ',' ;
                $stmt.= db_name('sectionShadow') . ',' ;
                $stmt.= db_name('sectionTitleFg') . ',' ;
                $stmt.= db_name('sectionTitleBorder') . ',' ;
                $stmt.= db_name('sectionTitleBorderColor') . ',' ;
                $stmt.= db_name('sectionTitleShadow') . ',' ;
                $stmt.= db_name('weblinkFg') ;
                $stmt.= ') VALUES (';
                $stmt.= db_string($db, $theme['theme']) . ',' ;
                $stmt.= db_string($db, $theme['font']) . ',' ;
                $stmt.= db_string($db, $theme['fontsize']) . ',' ;
                $stmt.= db_string($db, $theme['contentW']) . ',' ;
                $stmt.= db_string($db, $theme['borderRadius']) . ',' ;
                $stmt.= db_string($db, $theme['bg']) . ',' ;
                $stmt.= db_string($db, $theme['barBg']) . ',' ;
                $stmt.= $theme['barBorder'] . ',' ;
                $stmt.= db_string($db, $theme['barBorderColor']) . ',' ;
                $stmt.= $theme['barShadow'] . ',' ;
                $stmt.= db_string($db, $theme['navH']) . ',' ;
                $stmt.= db_string($db, $theme['navW']) . ',' ;
                $stmt.= db_string($db, $theme['navMargin']) . ',' ;
                $stmt.= db_string($db, $theme['navFg']) . ',' ;
                $stmt.= db_string($db, $theme['navActBg']) . ',' ;
                $stmt.= db_string($db, $theme['navActFg']) . ',' ;
                $stmt.= db_string($db, $theme['navWeight']) . ',' ;
                $stmt.= db_string($db, $theme['footerH']) . ',' ;
                $stmt.= db_string($db, $theme['footerStyle']) . ',' ;
                $stmt.= db_string($db, $theme['footerWeight']) . ',' ;
                $stmt.= db_string($db, $theme['formBg']) . ',' ;
                $stmt.= db_string($db, $theme['formFg']) . ',' ;
                $stmt.= $theme['formBorder'] . ',' ;
                $stmt.= db_string($db, $theme['formBorderColor']) . ',' ;
                $stmt.= $theme['formShadow'] . ',' ;
                $stmt.= db_string($db, $theme['btnH']) . ',' ;
                $stmt.= db_string($db, $theme['btnW']) . ',' ;
                $stmt.= db_string($db, $theme['btnBg']) . ',' ;
                $stmt.= db_string($db, $theme['btnFg']) . ',' ;
                $stmt.= db_string($db, $theme['btnActBg']) . ',' ;
                $stmt.= db_string($db, $theme['btnActFg']) . ',' ;
                $stmt.= db_string($db, $theme['btnDisBg']) . ',' ;
                $stmt.= db_string($db, $theme['btnDisFg']) . ',' ;
                $stmt.= db_string($db, $theme['btnWeight']) . ',' ;
                $stmt.= $theme['btnBorder'] . ',' ;
                $stmt.= db_string($db, $theme['btnBorderColor']) . ',' ;
                $stmt.= $theme['btnShadow'] . ',' ;
                $stmt.= db_string($db, $theme['inpH']) . ',' ;
                $stmt.= db_string($db, $theme['inpW']) . ',' ;
                $stmt.= db_string($db, $theme['inpBg']) . ',' ;
                $stmt.= db_string($db, $theme['inpFg']) . ',' ;
                $stmt.= db_string($db, $theme['inpActBg']) . ',' ;
                $stmt.= db_string($db, $theme['inpActFg']) . ',' ;
                $stmt.= db_string($db, $theme['inpDisBg']) . ',' ;
                $stmt.= db_string($db, $theme['inpDisFg']) . ',' ;
                $stmt.= db_string($db, $theme['inpWeight']) . ',' ;
                $stmt.= $theme['inpBorder'] . ',' ;
                $stmt.= db_string($db, $theme['inpBorderColor']) . ',' ;
                $stmt.= $theme['inpShadow'] . ',' ;
                $stmt.= db_string($db, $theme['titleH']) . ',' ;
                $stmt.= db_string($db, $theme['titleW']) . ',' ;
                $stmt.= db_string($db, $theme['titleMargin']) . ',' ;
                $stmt.= db_string($db, $theme['titleFg']) . ',' ;
                $stmt.= db_string($db, $theme['titleStyle']) . ',' ;
                $stmt.= db_string($db, $theme['titleWeight']) . ',' ;
                $stmt.= $theme['titleBorder'] . ',' ;
                $stmt.= db_string($db, $theme['titleBorderColor']) . ',' ;
                $stmt.= $theme['titleShadow'] . ',' ;
                $stmt.= db_string($db, $theme['articleW']) . ',' ;
                $stmt.= db_string($db, $theme['articleMargin']) . ',' ;
                $stmt.= db_string($db, $theme['articleBg']) . ',' ;
                $stmt.= $theme['articleBorder'] . ',' ;
                $stmt.= db_string($db, $theme['articleBorderColor']) . ',' ;
                $stmt.= $theme['articleShadow'] . ',' ;
                $stmt.= db_string($db, $theme['sectionW']) . ',' ;
                $stmt.= db_string($db, $theme['sectionMargin']) . ',' ;
                $stmt.= db_string($db, $theme['sectionBg']) . ',' ;
                $stmt.= db_string($db, $theme['sectionFg']) . ',' ;
                $stmt.= db_string($db, $theme['sectionActBg']) . ',' ;
                $stmt.= $theme['sectionBorder'] . ',' ;
                $stmt.= db_string($db, $theme['sectionBorderColor']) . ',' ;
                $stmt.= $theme['sectionShadow'] . ',' ;
                $stmt.= db_string($db, $theme['sectionTitleFg']) . ',' ;
                $stmt.= $theme['sectionTitleBorder'] . ',' ;
                $stmt.= db_string($db, $theme['sectionTitleBorderColor']) . ',' ;
                $stmt.= $theme['sectionTitleShadow'] . ',' ;
                $stmt.= db_string($db, $theme['weblinkFg']) ;
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}