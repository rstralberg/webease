<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/load_sites.php';
require_once __DIR__ . '/sitefolders.php';
require_once __DIR__ . '/sitetables.php';


function init_sites()
{
    $sites = load_sites();
    foreach ($sites as $site) {
        create_sitefolders($site);
        create_sitetables($site);
    }
}

?>
