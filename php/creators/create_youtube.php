<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_youtube(array $section): string {

    $content = json_decode($section['content']);

    $html = '<iframe width="560" height="315" ';
    $html.= 'src="https://www.youtube.com/embed/';
    $html.= $content->track;
    $html.= '" title="YouTube video player" frameborder="0" ';
    $html.= 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; ';
    $html.= 'gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

    return compress_html($html);
}


?>


