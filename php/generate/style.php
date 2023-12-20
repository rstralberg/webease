<?php

require_once __DIR__ . '/../conf.php';
require_once __DIR__ . '/../db/db.php';

function style(mysqli $db, string $themeName, int $themeId): string
{
    $cfg = load_config();
    $themes = db_select($db, 'themes', ['*'], db_where($db, 'theme', $themeName));
    if( $themes === false || gettype($themes) === 'string' ) {
        $themes = db_select($db, 'themes', ['*'], db_where($db, 'theme', $cfg->dbTheme ));
        if( $themes === false || gettype($themes) === 'string' ) {
            throw new Exception('Kunde inte ladda applikationens tema ' . $themeName);
        }
    }
    $theme = $themes[0];

    $root = ':root {';

    $root .= '--theme:' . $theme['theme'] . ';';
    $root .= '--font:' . $theme['font'] . ';';
    $root .= '--fontsize:' . $theme['fontsize'] . ';';
    $root .= '--contentW:' . $theme['contentW'] . ';';
    $root .= '--borderRadius:' . $theme['borderRadius'] . ';';
    $root .= '--bg:' . $theme['bg'] . ';';
    $root .= '--barBg:' . $theme['barBg'] . ';';
    $root .= '--barBorder:' . $theme['barBorder'] . ';';
    $root .= '--barBorderColor:' . $theme['barBorderColor'] . ';';
    $root .= '--barShadow:' . $theme['barShadow'] . ';';
    $root .= '--navH:' . $theme['navH'] . ';';
    $root .= '--navW:' . $theme['navW'] . ';';
    $root .= '--navMargin:' . $theme['navMargin'] . ';';
    $root .= '--navFg:' . $theme['navFg'] . ';';
    $root .= '--navActBg:' . $theme['navActBg'] . ';';
    $root .= '--navActFg:' . $theme['navActFg'] . ';';
    $root .= '--navWeight:' . $theme['navWeight'] . ';';
    $root .= '--footerH:' . $theme['footerH'] . ';';
    $root .= '--footerStyle:' . $theme['footerStyle'] . ';';
    $root .= '--footerWeight:' . $theme['footerWeight'] . ';';
    $root .= '--formBg:' . $theme['formBg'] . ';';
    $root .= '--formFg:' . $theme['formFg'] . ';';
    $root .= '--formBorder:' . $theme['formBorder'] . ';';
    $root .= '--formBorderColor:' . $theme['formBorderColor'] . ';';
    $root .= '--formShadow:' . $theme['formShadow'] . ';';
    $root .= '--btnH:' . $theme['btnH'] . ';';
    $root .= '--btnW:' . $theme['btnW'] . ';';
    $root .= '--btnBg:' . $theme['btnBg'] . ';';
    $root .= '--btnFg:' . $theme['btnFg'] . ';';
    $root .= '--btnActBg:' . $theme['btnActBg'] . ';';
    $root .= '--btnActFg:' . $theme['btnActFg'] . ';';
    $root .= '--btnDisBg:' . $theme['btnDisBg'] . ';';
    $root .= '--btnDisFg:' . $theme['btnDisFg'] . ';';
    $root .= '--btnWeight:' . $theme['btnWeight'] . ';';
    $root .= '--btnBorder:' . $theme['btnBorder'] . ';';
    $root .= '--btnBorderColor:' . $theme['btnBorderColor'] . ';';
    $root .= '--btnShadow:' . $theme['btnShadow'] . ';';
    $root .= '--inpH:' . $theme['inpH'] . ';';
    $root .= '--inpW:' . $theme['inpW'] . ';';
    $root .= '--inpBg:' . $theme['inpBg'] . ';';
    $root .= '--inpFg:' . $theme['inpFg'] . ';';
    $root .= '--inpActBg:' . $theme['inpActBg'] . ';';
    $root .= '--inpActFg:' . $theme['inpActFg'] . ';';
    $root .= '--inpDisBg:' . $theme['inpDisBg'] . ';';
    $root .= '--inpDisFg:' . $theme['inpDisFg'] . ';';
    $root .= '--inpWeight:' . $theme['inpWeight'] . ';';
    $root .= '--inpBorder:' . $theme['inpBorder'] . ';';
    $root .= '--inpBorderColor:' . $theme['inpBorderColor'] . ';';
    $root .= '--inpShadow:' . $theme['inpShadow'] . ';';
    $root .= '--titleH:' . $theme['titleH'] . ';';
    $root .= '--titleW:' . $theme['titleW'] . ';';
    $root .= '--titleMargin:' . $theme['titleMargin'] . ';';
    $root .= '--titleFg:'  . $theme['titleFg'] . ';';
    $root .= '--titleStyle:' . $theme['titleStyle'] . ';';
    $root .= '--titleWeight:'  . $theme['titleWeight'] . ';';
    $root .= '--titleBorder:' . $theme['titleBorder'] . ';';
    $root .= '--titleBorderColor:' . $theme['titleBorderColor'] . ';';
    $root .= '--titleShadow:' . $theme['titleShadow'] . ';';
    $root .= '--articleW:' . $theme['articleW'] . ';';
    $root .= '--articleMargin:' . $theme['articleMargin'] . ';';
    $root .= '--articleBg:'  . $theme['articleBg'] . ';';
    $root .= '--articleBorder:'  . $theme['articleBorder'] . ';';
    $root .= '--articleBorderColor:'  . $theme['articleBorderColor'] . ';';
    $root .= '--articleShadow:' . $theme['articleShadow'] . ';';
    $root .= '--sectionW:' . $theme['sectionW'] . ';';
    $root .= '--sectionMargin:' . $theme['sectionMargin'] . ';';
    $root .= '--sectionBg:'  . $theme['sectionBg'] . ';';
    $root .= '--sectionFg:'  . $theme['sectionFg'] . ';';
    $root .= '--sectionActBg:'  . $theme['sectionActBg'] . ';';
    $root .= '--sectionBorder:'  . $theme['sectionBorder'] . ';';
    $root .= '--sectionBorderColor:'  . $theme['sectionBorderColor'] . ';';
    $root .= '--sectionShadow:' . $theme['sectionShadow'] . ';';
    $root .= '--sectionTitleFg:' . $theme['sectionTitleFg'] . ';';
    $root .= '--sectionTitleBorder:' . $theme['sectionTitleBorder'] . ';';
    $root .= '--sectionTitleBorderColor:' . $theme['sectionTitleBorderColor'] . ';';
    $root .= '--sectionTitleShadow:' . $theme['sectionTitleShadow'] . ';';
    $root .= '--weblinkFg:' . $theme['weblinkFg'] . ';';


    $root .= '}';

    // $fh = fopen(__DIR__ . '/style.css', 'w');
    // if($fh) {
    //     fwrite($fh, $root);
    //     fclose($fh);
    // }

    return '<style>' . $root . '</style>';
}   

