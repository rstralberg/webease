<?php

require_once __DIR__ . '/conf.php';
require_once __DIR__ . '/utils/error.php';
require_once __DIR__ . '/utils/disk.php';
require_once __DIR__ . '/db/db.php';
require_once __DIR__ . '/sites/init_sites.php';
require_once __DIR__ . '/sites/parse_args.php';
require_once __DIR__ . '/generate/html.php';
require_once __DIR__ . '/db/tables/pages_table.php';

// create and/or update sites databases and folders
$conf = load_config();

init_sites();

// argument will tell which site to load
$key = 'km';
if (array_key_exists('PATH_INFO', $_SERVER)) {
    $key = $_SERVER['PATH_INFO'];
    if( $key[0] === '/') {
        $key = substr($key,1);
    }
}

// We need site information
$db = db_open($key);
$sites = db_select($db, 'settings', ['title', 'theme'], db_where($db, 'id', 1));
db_close($db);

if( gettype( $sites ) !== 'array' ) {
    die('WebEase: #ERROR. Failed to load requested site. Aborting!');
}
$title = $sites[0]['title'];
$theme = $sites[0]['theme'];

// which page to load
$page_id = 0;
if( array_key_exists('p', $_GET) ) {
    $page_id = (int)$_GET['p'];
} else {
    $page_id = get_first_page_id($db);
}


// Greate. Were ready to start
session_start();

// Lets generate the basic page
// and then scripts will do the rest
try {
    echo( html($db, $page_id, $key, $title, $theme ));
} 
catch (Exception $e) {
    $str ='<br>WebEase: #EXCEPTION ' . $e->getMessage(); 
    echo ($str);
    send_reject($str);
}

?>
