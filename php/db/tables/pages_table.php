<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../conf.php';

const pages_cols = [
    'title',
    'parentId',
    'author',
    'showTitle',
    'pos',
    'isParent',
    'isPublic'
];

function create_pages_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'pages', pages_cols, 
    [
        'VARCHAR(60) NOT NULL UNIQUE', // title
        'INT(11) NOT NULL', // pageId
        'VARCHAR(120) NOT NULL', // author
        'TINYINT NOT NULL', //showTitle
        'TINYINT NOT NULL', //pos
        'TINYINT NOT NULL', //isParent
        'TINYINT NOT NULL' //isPublic
    ]);
}


// returns true if table was created 
function verify_pages_table(mysqli $db, string $database): bool | string
{
    if (db_table_exist($db, $database, 'pages') === false) {
        return create_pages_table($db, $database);
    } 
    return false;
}

function get_first_page_id(mysqli $db): int
{
    $pages = db_select($db, 'pages', ['id'],
        db_name('isParent') . '=0 AND ' .
        db_name('isPublic') . '=1 AND ' .
        db_name('parentId') . '=0',
        db_name('pos') . ' asc',
        'LIMIT 1'
    );
    if (!$pages) {
        $pages = db_select($db, 'pages', ['id'],
            db_name('isParent') . '=0 AND ' .
            db_name('parentId') . '=0',
            db_name('pos') . ' asc',
            'LIMIT 1'
        );
    }
    return $pages ? $pages[0]['id'] : -1;
}

function get_default_page(string $title, string $author) : array {
    return [
        $title, // title
        0, // pageId
        $author, // author
        1, //showTitle
        0, //pos
        0, //isParent
        1 //isPublic
    ];
}

function backup_pages(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/pages.sql', 'w');
    if( $fh ) {
        $pages = db_select($db, 'pages', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($pages) === 'array' ) {
            foreach($pages as $page) {
                $stmt = 'INSERT INTO ' . db_name('pages') . ' (' ;
                $stmt.= db_name('title') . ',' ;
                $stmt.= db_name('parentId') . ',' ;
                $stmt.= db_name('author') . ',' ;
                $stmt.= db_name('showTitle') . ',' ;
                $stmt.= db_name('pos') . ',' ;
                $stmt.= db_name('isParent') . ',' ;
                $stmt.= db_name('isPublic') ;
                $stmt.= ') VALUES (';
                $stmt.= db_string($db, $page['title']) . ',' ;
                $stmt.= $page['parentId'] . ',' ;
                $stmt.= db_string($db, $page['author']) . ',' ;
                $stmt.= $page['showTitle'] . ',' ;
                $stmt.= $page['pos'] . ',' ;
                $stmt.= $page['isParent'] . ',' ;
                $stmt.= $page['isPublic'] ;
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}