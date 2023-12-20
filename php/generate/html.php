<?php
require_once __DIR__ . '/head.php';
require_once __DIR__ . '/../utils/load_html.php';
require_once __DIR__ . '/../tools/user.php';
require_once __DIR__ . '/../tools/admin.php';
require_once __DIR__ . '/fonts.php';

function html(mysqli $db, int $pageId, string $sitekey, string $siteName, string $siteTheme): string
{
    fonts();
    $pages = db_select($db, 'pages', ['id', 'title', 'isPublic', 'showTitle', 'author'], db_where($db, 'id', $pageId));
    if ($pages === false) {
        die("failed to load requested page with id = " . $pageId);
    }
    if (gettype($pages) === 'string') {
        die($pages);
    }

    $html = '<!DOCTYPE html><html lang="sv">';
    $html .= head($db, $siteName, $siteTheme, $pageId);

    $page = $pages[0];
    $html .=
    '<body>
        <div style="display:none">  
            <input id="_pageid" type="hidden" value="' . $page['id'] . '">
            <input id="_showtitle" type="hidden" value="' . $page['showTitle']. '">
            <input id="_author" type="hidden" value="' . $page['author'] . '">
            <input id="_username" type="hidden" value="">
            <input id="_adm" type="hidden" value="0">
            <input id="_key" type="hidden" value="' . $sitekey . '">
            <input id="_article" type="hidden" value="">
            <input id="_section" type="hidden" value="">
        </div>
        <nav></nav>
        <main>
            <header></header>
            <div class="articles"></div>
            <div class="comments">
                <input style="width:inherit" type="button" onclick="on_toggle_comments(this)" value="Kommentarer: &#8711;">
                <div class="comments-content">
                    <div class="comments-tools">
                        <input type="button" value="Skriv" onclick="on_add_comment()">
                    </div>
                    <div id="comments-container"></div>
                </div>
            </div>
            <div style="min-height:8vh"></div>
        </main>

        <footer>
            <img class="footer-img" src="icons/WebEase-16.png" onclick="on_login()">
            <div class="footer-webease">WebEase</div>
            <div class="footer-by">by Roland Strålberg. Version 1.0 in ' . Date('Y') . '</div>
            <div class="footer-sitename">' . $siteName . '</div>
        </footer>' .
    user_tools() .
    admin_tools() .
        '</body>';

    // Jscript loading ....
    $page = $pages[0];
    $html .= '<script type="module">
                addEventListener("DOMContentLoaded", (event) => { index('. $pageId . ')})
            </script>';

    $html .= '</html>';

    $fh = fopen(__DIR__ . '/../../main.html', 'w');
    if ($fh) {
        fwrite($fh, $html);
        fclose($fh);
    }
    return compress_html($html);
}
