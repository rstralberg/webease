<?php

function get_folders( string $dir) : array {

    $result = array();

    $subfolders = glob($dir . '/*', GLOB_ONLYDIR);
    if( $subfolders === false) return $result;

    foreach ($subfolders as $subfolder) {
        array_push($result, $subfolder);
        $result = array_merge($result,get_folders($subfolder));
    }
    return $result;
}

function get_folder_files( string $dir) : array {
    $result = array();

    $subfolders = glob($dir . '/*');
    if( $subfolders === false) return $result;

    foreach ($subfolders as $subfolder) {
        if( !is_dir($subfolder))  array_push($result, $subfolder);
        $result = array_merge($result,get_folder_files($subfolder));
    }
    return $result;

    
}