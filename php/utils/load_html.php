<?php

require_once __DIR__ . '/strings.php';

function compress_html(string $html): string
{
    $res = preg_replace('/\s+/', ' ', $html);
    $res = preg_replace('/\s*<\s*/', '<', $res);
    $res = preg_replace('/\s*>\s*/', '>', $res);
    return $res;
}

function load_html(string $htmlFile, array $args = null, string $tag = '$'): string | bool
{
    try {
        $fh = fopen($htmlFile, 'r');
        if ($fh) {
            $html = fread($fh, 32000);
            fclose($fh);

            if ($html) {
                $html = compress_html($html);
                if ($args !== null) {
                    foreach ($args as $key => $value) {
                        $html = replace($html, $tag . '{' . $key . '}', $value === 'null' || $value === null ? '' : $value);
                    }
                }
                return $html;
            }
        }
    } catch (Exception $e) {
        return '<p>'+$e->getMessage()+'<p>';
    }
    return false;
}
