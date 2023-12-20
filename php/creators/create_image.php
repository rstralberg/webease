<?php 
require_once __DIR__ . '/../utils/load_form.php';

function create_image(string $key, int $pageid, array $section): string {

    $content = json_decode($section['content']);

    $html = '<figure>';
    $html.= '<img src="sites/'.$key.'/'.$pageid.'/'.$content->src.'" width="'.$content->width.'" heigh="auto"';
    if( $content->shadow ) $html .= ' class="shadow"';
    $html.= '>';
    $html.= '<figcaption>'.$content->caption.'</figcaption>';
    $html.= '</figure>';

    return compress_html($html);
}


?>


