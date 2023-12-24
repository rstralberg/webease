<?php 
require_once __DIR__ . '/../utils/load_html.php';

function create_gallery(string $key, int $pageid, array $section): string {

    $content = json_decode($section['content']);

    $html = '<figure class="gallery-container';
    if( $content->shadow) $html .= ' shadow';
    $html .= '">';

    for( $i=0; $i < count($content->images); $i++ ) {
        $src = $content->images[$i];
        $html .= '<figure class="gallery-figure">';
        $html .= '<img src="sites/'.$key.'/'.$pageid.'/'.$src.'" ';
        if( $content->shadow ) $html .= 'class="shadow" ';
        $html .= '>';
        $html .= '</figure>';
    }
    $html .= '</figure>';
    return compress_html($html);
}


?>


