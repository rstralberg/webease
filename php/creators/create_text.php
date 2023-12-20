<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_text(array $section): string {
    $content = json_decode($section['content']);
    return compress_html(rawurldecode($content->text));
}


?>


