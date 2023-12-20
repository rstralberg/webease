<?php
require_once __DIR__ . '/../utils/load_form.php';

function user_tools() : string {
    return load_form(__DIR__ . '/user', [
        'style' => 'white'
    ]);
}
