<?php

function db_drop( mysqli $db, string $table) : bool | string {
    $query = 'DROP TABLE IF EXIST ' . db_name($table) . ' ';
    try { 
        return mysqli_query($db, $query);
    }
    catch (mysqli_sql_exception $e) { 
        return $e->getMessage();
    }
}

?>