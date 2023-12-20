<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [])) {

    $db = db_open($args->key);

    $settings = db_select($db, 'settings', ['title'], db_where($db, 'id', 1));
    if (db_result($settings, 'Failed to load settings') === false) {
        exit(0);
    }

    $html = '';
    $html.= '<img class="footer-img" src="icons/WebEase-16.png" onclick="on_login()">';
    $html.= '<div class="footer-webease">WebEase</div>';
    $html.= '<div class="footer-by">by Roland Strålberg. Version 1.0 in '.Date('Y').'</div>';
    $html.= '<div class="footer-sitename">'. $settings[0]['title'] . '</div>';
    send_resolve(compress_html($html));
    exit(0);
}
