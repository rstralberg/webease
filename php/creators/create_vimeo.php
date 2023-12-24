<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_vimeo(array $section): string {

    $content = json_decode($section['content']);

    $html = '<iframe src="https://player.vimeo.com/video/';
    $html.= $content->track;
    $html.= '?h=1c61046eef" ';
    $html.= 'width="640" height="351" ';
    $html.= 'frameborder="0" ';
    $html.= 'allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>';
    $html.= '</iframe>';

    return compress_html($html);
}


?>


