<?php

require_once __DIR__ . '/../utils/load_form.php';

function admin_tools() : string {
    return load_form(__DIR__ . '/admin', [
        'style' => 'white'
        ]);
}
