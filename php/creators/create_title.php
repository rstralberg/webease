<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_title(array $section): string {

    $content = json_decode($section['content']);
    if( $content === null ) return 'Section of type ' . $section['type'] . ' JSON Error';
    $html = '<h1>' . $content->title . '</h1>';
    return compress_html($html);
}


?>


