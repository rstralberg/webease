<?php

require_once __DIR__ . '/../db.php';

function create_comments_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'comments', [
        'pageId',
        'author',
        'date',
        'title',
        'comment'
    ], [
        'INT(11) NOT NULL', // pageId
        'VARCHAR(64) NOT NULL', //author
        'VARCHAR(64) NOT NULL', //date
        'VARCHAR(128) NOT NULL', //title
        'TEXT NOT NULL' //comment
    ]);
}

// returns true if table was created 
function verify_comments_table(mysqli $db, string $database): bool 
{
    if (db_table_exist($db, $database, 'comments') === false) {
        return create_comments_table($db, $database);
    } 
    return false ;
}

function backup_comments(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/comments.sql', 'w');
    if( $fh ) {
        $comments = db_select($db, 'comments', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($comments) === 'array' ) {
            foreach($comments as $comment) {
                $stmt = 'INSERT INTO ' . db_name('comments')  . ' (' ;
                $stmt.= db_name('pageId') . ',';
                $stmt.= db_name('author') . ',';
                $stmt.= db_name('date') . ',';
                $stmt.= db_name('title') . ',';
                $stmt.= db_name('comment') ;
                $stmt.= ') VALUES (';
                $stmt.= $comment['pageId'] . ',';
                $stmt.= db_string($db, $comment['author'] ) . ',';
                $stmt.= db_string($db, $comment['date'] ) . ',';
                $stmt.= db_string($db, $comment['title'] ) . ',';
                $stmt.= db_string($db, $comment['comment'] ) ;
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}