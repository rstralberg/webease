<?php

require_once __DIR__ . '/../conf.php';

function db_open(string $database ) : mysqli | null {
        
    $cfg = load_config();
    $db = mysqli_connect($cfg->dbHost, $cfg->dbUser, $cfg->dbPassword);
    if ($db === null) {
        return null;
    }

    mysqli_query($db, 'CREATE DATABASE IF NOT EXISTS ' . $database);
    $db->close();

    $db = mysqli_connect($cfg->dbHost, $cfg->dbUser, $cfg->dbPassword);
    if ($db->connect_error) {
        return null;
    }

    mysqli_query($db, 'USE ' . $database);
    return $db;
}

