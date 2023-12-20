<?php

require_once __DIR__ . '/../db.php';

function create_sections_table(mysqli $db, string $database): bool
{
    return db_create($db, $database, 'sections', [
        'articleId',
        'type',
        'pos',
        'align',
        'content',
    ], [
        'INT(11) NOT NULL',//articleId
        'VARCHAR(16) NOT NULL',//type
        'TINYINT NOT NULL',//pos
        'VARCHAR(16) NOT NULL',//align
        'TEXT NOT NULL',//content
    ]);
}

// returns true if table was created 
function verify_sections_table(mysqli $db, string $database): bool 
{
    if (db_table_exist($db, $database, 'sections') === false) {
        return create_sections_table($db, $database);
    } 
    return false ;
}


function backup_sections(mysqli $db) : void {
    
    $fh = fopen(__DIR__.  '/../../../backup/sections.sql', 'w');
    if( $fh ) {
        $sections = db_select($db, 'sections', ['*'], null, db_order_by('id', 'asc'));
        if( gettype($sections) === 'array' ) {
            foreach($sections as $section) {
                $stmt = 'INSERT INTO ' . db_name('sections') . ' (' ;
                $stmt.= db_name('articleId') . ',' ;
                $stmt.= db_name('type') . ',' ;
                $stmt.= db_name('pos') . ',' ;
                $stmt.= db_name('align') . ',' ;
                $stmt.= db_name('content' ) ;
                $stmt.= ') VALUES (';
                $stmt.= $section['articleId'] . ',';
                $stmt.= db_string($db, $section['type']) . ',';
                $stmt.= $section['pos'] . ',';
                $stmt.= db_string($db, $section['align']) . ',';
                $stmt.= db_string($db, $section['content']) ;
                $stmt.= ');' . PHP_EOL;
                fwrite($fh, $stmt);
            }
        }
        fclose($fh);
    }
}