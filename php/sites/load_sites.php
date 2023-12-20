<?php

function load_sites(): array
{
    $fh = fopen(__DIR__ . '/../../sites.json', 'r');
    if ($fh === null)
        die('WebEase: #ERROR. No sites defined. Aborting!');

    $text = fread($fh, 32000);
    fclose($fh);

    if ($text === null || $text === '') {
        die('WebEase: #ERROR. No sites defined. Aborting!');
    }

    $item = json_decode($text);

    $sites = array();
    for ($i = 0; $i < count($item->sites); $i++) {
        $site = $item->sites[$i];
        array_push(
            $sites,
            [
                'key' => $site->key,
                'title' => $site->title,
                'owner' => $site->owner,
                'email' => $site->email,
                'logo' => 'WebEase-128.png',
                'theme' => $site->theme
            ]
        );
    }
    return $sites;
}

?>
