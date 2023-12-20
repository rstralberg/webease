<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_soundcloud(array $section): string {

    $content = json_decode($section['content']);

    $html = '<iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" ';
    $html.= 'src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/';
    $html.= $content->track ;
    $html.= '&color=%23ff5500&auto_play=false&hide_related=false';
    $html.= '&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true">';
    $html.= '</iframe>';
    
    return compress_html($html);
}


?>


