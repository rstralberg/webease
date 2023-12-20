<?php

function split($str, $delm)
{
    return [ 
        strstr($str, $delm, true), 
        ltrim(strstr($str, $delm), $delm) 
    ];
}

function splitInTwo($str, $delm)
{
    return [
        'first' => strstr($str, $delm, true),
        'second' => ltrim(strstr($str, $delm), $delm)
    ];
}

function trimEnd(string $str, int $numChar ): string {
    return substr($str, 0, strlen($str)-$numChar);
}

function surround(string $str, string $char) : string {
    return $char . $str . $char;
}

function remove_tag(string $str, string $tag) : string {
    return trim($str, '<'.$tag.'></'.$tag.'>');
}

function replace( string $str, string $replace, stdClass|string|null $replacement ) {
    if( $replacement === null ) return  $str ;
    else if( gettype($replacement) === 'object' ) return json_encode($replacement) ;
    return str_replace($replace, $replacement, $str);

}

function parse_files(string $ext, string $html) : array {
    $files = array();

    return $files;
}


?>

