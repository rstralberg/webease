<?php

require_once __DIR__ . '/../conf.php';

function create_sitefolders(array $site) {

    $sitefolder = __DIR__ . '/../../public/sites/' . $site['key'];
    if (!file_exists($sitefolder)) {
        mkdir($sitefolder, 0777, true);
    }

    $usersfolder = $sitefolder . '/users';
    if (!file_exists($usersfolder)) {
        mkdir($usersfolder, 0777, true);
    }

    copy(__DIR__ . '/../../public/icons/WebEase-128.png', $sitefolder . '/WebEase-128.png');
    copy(__DIR__ . '/../../public/icons/avatar.png', $usersfolder . '/avatar.png');

    $readme = $sitefolder . '/readme.txt';
    if (!file_exists($readme)) {
        $fh = fopen($readme, 'w');
        if ($fh) {
            fwrite($fh, PHP_EOL);
            fwrite($fh, '=====================================================================' . PHP_EOL);
            fwrite($fh, 'This is the root folder for ' . $site['title'] . PHP_EOL);
            fwrite($fh, 'Uploads for ' . $site['title'] . ' will got to the subfolders.' . PHP_EOL);
            fwrite($fh, PHP_EOL);
            fwrite($fh, 'Created by WebEase at ' . Date('Y-m-d H:i') . PHP_EOL);
            fwrite($fh, '=====================================================================' . PHP_EOL);
            fwrite($fh, 'Stralberg Development, rstralberg@pm.me' . PHP_EOL);
            fwrite($fh, '=====================================================================' . PHP_EOL);
            fwrite($fh, PHP_EOL);
            fflush($fh);
            fclose($fh);
        }
    }
}
