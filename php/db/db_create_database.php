<?php
require_once __DIR__ . '/../conf.php';

function db_create_database(string $database) : bool {

    $cfg  = load_config();

    $db = mysqli_connect($cfg->dbHost, $cfg->dbUser, $cfg->dbPassword);
    if ($db === null) {
        return false;
    }

    mysqli_query($db, 'CREATE DATABASE IF NOT EXISTS ' . $database);
    $db->close();

    $db = mysqli_connect($cfg->dbHost, $cfg->dbUser, $cfg->dbPassword);
    if ($db->connect_error) {
        return false;
    }
    $db->close();
    return true;
}