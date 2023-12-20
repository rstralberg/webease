<?php

require_once __DIR__ . '/../db_table_exist.php';
require_once __DIR__ . '/../db_create.php';

// returns true if table was created
function create_settings_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'settings', [
        'title',
        'owner',
        'email',
        'logo',
        'theme'], [
        'VARCHAR(128) NOT NULL',
        'VARCHAR(128) NOT NULL',
        'VARCHAR(128) NOT NULL',
        'VARCHAR(128) NOT NULL',
        'VARCHAR(128) NOT NULL',
    ]);
}


// returns true if table was created 
function verify_settings_table(mysqli $db, string $database): bool | string
{
    if (db_table_exist($db, $database, 'settings') === false) {
        return create_settings_table($db, $database);
    } 
    return false;
}


function backup_settings(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/settings.sql', 'w');
    if( $fh ) {
        $settings = db_select($db, 'settings', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($settings) === 'array' ) {
            foreach($settings as $setting) {
                $stmt = 'INSERT INTO ' . db_name('settings') . ' (' ;
                $stmt.= db_name('title') . ',' ;
                $stmt.= db_name('owner') . ',' ;
                $stmt.= db_name('email') . ',' ;
                $stmt.= db_name('logo') . ',' ;
                $stmt.= db_name('theme') ;
                $stmt.= ') VALUES (';
                $stmt.= db_string($db, $setting['title']) . ',' ;
                $stmt.= db_string($db, $setting['owner']) . ',' ;
                $stmt.= db_string($db, $setting['email']) . ',' ;
                $stmt.= db_string($db, $setting['logo']) . ',' ;
                $stmt.= db_string($db, $setting['theme']) ;
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}