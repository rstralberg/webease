<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_list(array $section): string {

    $content = json_decode($section['content']);
    $html = '<ul style="list-style:'.$content->style.'">';
    
    for( $i=0; $i < count($content->items); $i++ ) {
        $html .= '<li>' . $content->items[$i] . '</li>';
    }
    $html .= '</ul>';
    return compress_html($html);
}


?>


