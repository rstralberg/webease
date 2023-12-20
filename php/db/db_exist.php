<?php

require_once __DIR__ . '/../conf.php';

function db_exist(string $dbName): bool
{
    $cfg = load_config();
    $host = $cfg->dbHost;
    $user = $cfg->dbUser;
    $pwd =  $cfg->dbPassword;

    try {
        $mysqli = mysqli_connect($host, $user, $pwd);
    }
    catch (Exception $e) {
        die($e->getMessage());
    }

    $exist = false;
    try {
        $exist = mysqli_select_db($mysqli, $dbName) !== null;
    } catch (Exception $e) {
    }
    mysqli_close($mysqli);
    return $exist;
}
