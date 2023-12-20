<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_spotify(array $section): string {

    $content = json_decode($section['content']);

    $html = '<iframe style="border-radius:12px" ';
    $html.= 'src="https://open.spotify.com/embed/track/';
    $html.= $content->track;
    $html.= '?utm_source=generator" width="100%" height="352" ';
    $html.= 'frameBorder="0" allowfullscreen="" allow="autoplay; ';
    $html.= 'clipboard-write; encrypted-media; fullscreen; ';
    $html.= 'picture-in-picture" loading="lazy"></iframe>';
    
    return compress_html($html);
}


?>


