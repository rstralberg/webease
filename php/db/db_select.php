<?php

function db_select( mysqli $db, string $table, array $cols, string $where = null, string $order = null, string $opt = null ): array|bool|string {

    $query = 'SELECT ';

    if ($cols[0] === '*') {
        $query .= '* ';
    } else {
        foreach ($cols as $col) {
            $query .= db_name($col) . ',';
        }
    }
    $query = trimEnd($query, 1);
    $query .= ' FROM ' . db_name($table);
    if ($where)
        $query .= ' WHERE ' . $where;
    if ($order)
        $query .= ' ORDER BY ' . $order;
    if ($opt)
        $query .= ' ' . $opt;

    try {
        $result = mysqli_query($db, $query);
        if ($result === false)
            return false;

    } 
    catch (mysqli_sql_exception $e) {
        return $e->getMessage() . '[' . $query . ']';
    }

    $rows = array();
    while ($record = mysqli_fetch_assoc($result)) {
        array_push($rows, $record);
    }
    return count($rows)===0?false:$rows;
}

