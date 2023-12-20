<?php 
require_once __DIR__ . '/../utils/load_html.php';

function create_audio(string $key, int $pageid, array $section): string {

    $content = json_decode($section['content']);

    $html = '<figure style="text-align:center">';
    $html.= '<audio controls src="sites/'.$key.'/'.$pageid.'/'.$content->src.'"></audio>';
    $html.= '<figcaption>'. $content->caption . '</figcaption>';
    $html.= '</figure>';

    return compress_html($html);
}


?>


