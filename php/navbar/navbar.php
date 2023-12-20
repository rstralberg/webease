<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid', 'username'])) {

    $db = db_open($args->key);

    $settings = db_select($db, 'settings', ['logo'], db_where($db, 'id', 1));
    if (db_result($settings, 'Failed to load settings') === false) {
        exit(0);
    }

    $admin = false;
    if ($args->username !== ' ') {
        $users = db_select($db, 'users', ['adm'], db_where($db, 'username', $args->username));
        if (gettype($users) === 'array') {
            $admin = $users[0]['adm'] === '1';
        }
    }

    $logo = 'sites/' . $args->key . '/' . $settings[0]['logo'];

    $html = '';
    $html .= '<img class="nav-logo" src="' . $logo . '" width="auto" height="32px">';

    $pages = db_select($db, 'pages', ['id', 'isParent', 'parentId', 'isPublic', 'title'],
        null, db_order_by('pos', 'asc'));
    if (db_result($pages, 'Failed to fetch any pages') === false) {
        exit(0);
    }

    // Pages
    for ($i = 0; $i < count($pages); $i++) {
        $page = $pages[$i];

        if ($page['isParent'] === '1') {

            // begin: subnav-content
            $html .= '<div class="dropdown">';
            $html .= '<button class="dropbtn">' . $page['title'] . '&nbsp;&nabla;</button>';
            
            // begin: subnav-content
            $html .= '<div class="dropdown-content">';
            $pagechilds = db_select($db, 'pages', ['id', 'isParent', 'parentId', 'isPublic', 'title'],
                db_where($db, 'parentId', $page['id']), db_order_by('pos', 'asc'));
            if (gettype($pagechilds) === 'array') {
                foreach ($pagechilds as $child) {
                    if ($args->username !== '' || $child['isPublic'] === '1') {
                        $html .= '<a ';
                        if( $child['id'] === $args->pageid) {
                            $html .= 'class="active" ';
                        }
                        $html .= 'href="' . $args->key . '?p=' . $child['id'] . '">' . $child['title'] . '</a>';
                    }
                }
            }
            $html .= '</div>';
            // end: subnav-content

            $html .= '</div>';
            // end: subnav
        } else {
            if ($args->username !== '' || $page['isPublic'] === '1') {
                if ($page['parentId'] === '0') {
                    $html .= '<a ';
                    if( $page['id'] === $args->pageid) {
                        $html .= 'class="active" ';
                    }
                    $html .= 'href="' . $args->key . '?p=' . $page['id'] . '">' . $page['title'] . '</a>';
                }
            }
        }
    }

    // Themes
    // begin: subnav
    $html .= '<div class="dropdown">';
    $html .= '<button class="dropbtn">Tema &nbsp;&nabla;</button>';

    // begin: subnav-content
    $html .= '<div class="dropdown-content">';

    $themes = db_select($db, 'themes', ['id', 'theme'], null, db_order_by('theme', 'asc'));
    if (db_result($themes, 'Failed to fetch any themes')) {
        foreach ($themes as $theme) {
            $html .= '<a href="#" onclick="change_theme(\''. $theme['theme'] . '\')">' . $theme['theme'] . '</a>';
        }
    }
    $html .= '</div>';
    // end: subnav-content
    $html .= '</div>';
    // end: subnav

    // $html .= '<div id="debug" style="color:red">' . $args->pageid . '</div>';
    // $html .= '<a href="javascript:void(0);" class="icon" onclick="on_toggle_navbar()">&#9776;</a>';
    db_close($db);

    send_resolve(compress_html($html));
    exit(0);
}
