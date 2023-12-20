<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../conf.php';
require_once __DIR__ . '/../db/tables/pages_table.php';

function parse_args(mysqli $db): stdClass
{
    $result = new stdClass();
    $result->key = 'km';
    $result->pageid = 0;
    
    if( array_key_exists('p', $_GET) ) {
        $result->pageid = (int)$_GET['p'];
    } else {
        $result->pageId = get_first_page_id($db);
    }
    
    if (array_key_exists('PATH_INFO', $_SERVER)) {
        $result->key = $_SERVER['PATH_INFO'];
        if( $result->key[0] === '/') {
            $result->key = substr($result->key,1);
        }
    }
    return $result;
}
