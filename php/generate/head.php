<?php

require_once __DIR__ . '/css.php';
require_once __DIR__ . '/fonts.php';    
require_once __DIR__ . '/icons.php';
require_once __DIR__ . '/scripts.php';
require_once __DIR__ . '/style.php';

function head(mysqli $db, string $siteName, string $themeName, int $pageId) : string {
    
    $html = '<head>';
    $html.= '<title>' . $siteName . '</title>';
    $html.= '<meta charset="UTF-8">';
    $html.= '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
    $html.= icons();
    $html.= style($db, $themeName,$pageId);
    $html.= css();
    $html.= scripts();
    $html.= '</head>';

    return $html;
}

?>
