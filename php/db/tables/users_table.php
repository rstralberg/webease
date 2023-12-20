<?php

require_once __DIR__ . '/../db.php';

function create_users_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'users', [
        'username',
        'fullname',
        'email',
        'picture',
        'password',
        'adm'
    ],
        [
            'VARCHAR(64) NOT NULL UNIQUE',
            'VARCHAR(256) NOT NULL',
            'VARCHAR(256) NOT NULL',
            'VARCHAR(128) NOT NULL',
            'VARCHAR(256) NOT NULL',
            'TINYINT NOT NULL'
        ]);
}

// returns true if table was created 
function verify_users_table(mysqli $db, string $database): bool | string
{
    if (db_table_exist($db, $database, 'users') === false) {
        return create_users_table($db, $database);
    }
    return false;
}

function get_default_user(string $fullname, string $email) : array {
    return [ 
        'admin',
        $fullname, 
        $email, 
        'avatar.png', 
        password_hash('winterfall', PASSWORD_DEFAULT),
        1//adm
     ];
}

function backup_users(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/users.sql', 'w');
    if( $fh ) {
        $users = db_select($db, 'users', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($users) === 'array' ) {
            foreach($users as $user) {
                $stmt = 'INSERT INTO ' . db_name('users') . ' (' ;
                $stmt.= db_name('username') . ',';
                $stmt.= db_name('fullname') . ',';
                $stmt.= db_name('email') . ',';
                $stmt.= db_name('picture') . ',';
                $stmt.= db_name('password') . ',';
                $stmt.= db_name('adm')  ;
                $stmt.= ') VALUES (';
                $stmt.= db_string($db, $user['username']) . ',';
                $stmt.= db_string($db, $user['fullname']) . ',';
                $stmt.= db_string($db, $user['email']) . ',';
                $stmt.= db_string($db, $user['picture']) . ',';
                $stmt.= db_string($db, $user['password']) . ',';
                $stmt.= $user['adm'];
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}