<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_video(string $key, int $pageid, array $section): string {

    $content = json_decode($section['content']);

    $html = '<video width="400" controls="">';
    $html.= '<source type="' . $content->type . '" src="';
    $html.= 'sites/'. $key . '/' . $pageid . '/' . $content->src . '">';
    $html.= '</video>';

    return compress_html($html);
}
?>


