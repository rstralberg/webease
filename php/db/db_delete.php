<?php

function db_delete( mysqli $db, string $table, string $where ) : bool|string {

    $query = 'DELETE FROM ' . db_name($table) . ' ';
    $query .= 'WHERE ' . $where;
    try { 
        return mysqli_query($db, $query);
    }
    catch (mysqli_sql_exception $e) { 
        return $e->getMessage();
    }
}
?>

