<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_slider( string $key, int $pageid, array $section): string {

    $content = json_decode($section['content']);

    $html = '<div class="slider-container" data-speed="'.$content->speed.'">';

    $numImages = count($content->images);
    for( $i=0; $i < $numImages; $i++ ) {
        $html .= '<div class="slides fade">';
        $html .= '  <img src="sites/'.$key.'/'.$pageid.'/'.$content->images[$i].'" ';
        if( $content->shadow )$html .= 'class="shadow" ';
        $html .= '">';
        $html .= '</div>';
    }
    $html .= '</div>';
    return compress_html($html);
}


?>


