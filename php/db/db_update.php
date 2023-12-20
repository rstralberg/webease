<?php

function db_update(mysqli $db, string $table, array $cols, array $values, string $where): bool | string
{

    $query = 'UPDATE ' . db_name($table) . ' SET ';

    $values = array_values($values);
    for ($i = 0; $i < count($cols); $i++) {
        if (gettype($values[$i]) === 'string') {
            $query .= db_name($cols[$i]) . '=' . db_string($db, $values[$i]) . ',';
        } else if (gettype($values[$i]) === 'boolean') {
            $query .= db_name($cols[$i]) . '=' . db_bool($values[$i]) . ',';
        } else {
            $query .= db_name($cols[$i]) . '=' . $values[$i] . ',';
        }

    }
    $query = trimEnd($query, 1);
    $query .= ' ';
    $query .= 'WHERE ' . $where;

    try {
    //     $fh = fopen(__DIR__ . '/sql/' . $table . '.sql', 'w');
    //     fwrite($fh, $query);
    //     fclose($fh);

        return mysqli_query($db, $query);
    } catch (mysqli_sql_exception $e) {
        return $e->getMessage();
    }
}
