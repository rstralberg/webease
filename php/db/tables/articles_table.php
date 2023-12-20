<?php

require_once __DIR__ . '/../db.php';

function create_articles_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'articles', [
        'pageId',
        'pos'
    ], [
        'INT(11) NOT NULL', // pageId
        'TINYINT NOT NULL'
    ]);
}

// returns true if table was created 
function verify_articles_table(mysqli $db, string $database): bool 
{
    if (db_table_exist($db, $database, 'articles') === false) {
        return create_articles_table($db, $database);
    } 
    return false ;
}


function backup_articles(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/articles.sql', 'w');
    if( $fh ) {
        $articles = db_select($db, 'articles', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($articles) === 'array' ) {
            foreach($articles as $article) {
                $stmt = 'INSERT INTO ' . db_name('articles') . ' (' ;
                $stmt.= db_name('pageId') . ',';
                $stmt.= db_name('pos') . ',';
                $stmt.= ') VALUES (';
                $stmt.= $article['pageId'] . ',';
                $stmt.= $article['pos'] ;
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}