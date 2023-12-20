<?php

require_once __DIR__ . '/db.php';

// returns true if table was created
function db_create(mysqli $db, string $database, string $table, array $cols, array $defs): bool
{
    if (!db_table_exist($db, $database, $table)) {

        $query = 'CREATE TABLE ' . db_name($table) . '(';
        $query .= 'id INT(11) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,';
        for ($i = 0; $i < count($defs); $i++) {
            $query .= db_name($cols[$i]) . ' ' . $defs[$i] . ',';
        }
        $query = trimEnd($query, 1);
        $query .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci';

        // $fh = fopen( __DIR__. '/sql/' . $table . '.sql', 'w');
        // fwrite($fh, $query);
        // fclose($fh);

        return mysqli_query($db, $query);
    }
    return false;
}
