<?php

function db_insert(mysqli $db, string $table, array $cols, array $values): int | bool | string
{

    $query = 'INSERT INTO ' . db_name($table) . ' (';

    for ($i = 0; $i < count($cols); $i++) {
        $query .= db_name($cols[$i]) . ',';
    }
    $query = trimEnd($query, 1);
    $query .= ') VALUES (';
    for ($i = 0; $i < count($values); $i++) {
        if (gettype($values[$i]) === 'string') {
            $query .= db_string($db, $values[$i]) . ',';
        } else if (gettype($values[$i]) === 'boolean') {
            $query .= db_bool($values[$i]) . ',';
        } else {
            $query .= $values[$i] . ',';
        }

    }
    $query = trimEnd($query, 1);
    $query .= ')';

    
    try {
        // $fh = fopen( __DIR__. '/sql/' . $table . '.sql', 'w');
        // fwrite($fh, $query);
        // fclose($fh);
        
        $result = mysqli_query($db, $query);
        if ($result === false) {
            return false;
        }

    } catch (mysqli_sql_exception $e) {
        return $e->getMessage();
    }
    return (int)$db->insert_id;
}
