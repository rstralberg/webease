<?php

function db_table_exist(mysqli $db, string $database, string $table): bool
{

    $query = 'SELECT count(*) FROM information_schema.tables WHERE table_schema = "' . $database . '" AND table_name = "' . $table . '"';
    try {
        $res = mysqli_query($db, $query);
    } catch (Exception $e) {
        echo ('PHP: Database execption  [' . $query . '] ' . '<br>' . $e->getMessage());
        echo ('PHP: Error [' . $e->getMessage() . ']');
        return false;
    }
    if ($res === false) {
        return false;
    }

    if (mysqli_num_rows($res) === 0) {
        return false;
    }

    $data = mysqli_fetch_assoc($res);

    if ($data === null) {
        return false;
    }

    return $data['count(*)'] > 0;
}
