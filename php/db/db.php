<?php

require_once __DIR__ . '/../utils/strings.php';
require_once __DIR__ . '/../utils/send_reply.php';

function db_string(mysqli $db, string $str): string
{
    return surround(mysqli_real_escape_string($db, $str), '\'');
}

function db_bool(bool $v): int
{
    return $v ? 1 : 0;
}

function db_name(string $str): string
{
    return surround($str, '`');
}

function db_error(mysqli $db): string
{
    return mysqli_error($db);
}

function db_where(mysqli $db, string $left, $right) {
    if( gettype($right) === 'string')
    return db_name($left).'='.db_string($db, $right);
    else if( gettype($right) === 'boolean') 
    return db_name($left).'='.db_bool($right);
    else 
    return db_name($left).'='.$right;
}

function db_where_not(mysqli $db, string $left, $right) {
    if( gettype($right) === 'string')
    return db_name($left).'<>'.db_string($db, $right);
    else if( gettype($right) === 'boolean') 
    return db_name($left).'<>'.db_bool($right);
    else 
    return db_name($left).'<>'.$right;
}

function db_order_by( string $col, string $dir) {
    return db_name($col) . ' ' . $dir;
}

function db_result( bool|string|array $res, string $msg) : bool {
    if( $res === false ) {
        send_reject($msg);
        return false;
    }
    if( gettype($res) === 'string') {
        send_reject($res);
        return false;
    }
    return true;
}

require_once __DIR__ . '/db_close.php';
require_once __DIR__ . '/db_create_database.php';
require_once __DIR__ . '/db_create.php';
require_once __DIR__ . '/db_delete.php';
require_once __DIR__ . '/db_drop.php';
require_once __DIR__ . '/db_exist.php';
require_once __DIR__ . '/db_insert.php';
require_once __DIR__ . '/db_open.php';
require_once __DIR__ . '/db_select.php';
require_once __DIR__ . '/db_table_exist.php';
require_once __DIR__ . '/db_update.php';

?>