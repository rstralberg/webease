<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../db/tables/articles_table.php';
require_once __DIR__ . '/../db/tables/comments_table.php';
require_once __DIR__ . '/../db/tables/pages_table.php';
require_once __DIR__ . '/../db/tables/sections_table.php';
require_once __DIR__ . '/../db/tables/themes_table.php';
require_once __DIR__ . '/../db/tables/users_table.php';

if (verify_args($args, [])) {

    $db = db_open($args->key);

    backup_articles($db);
    backup_comments($db);
    backup_pages($db);
    backup_sections($db);
    backup_themes($db);
    backup_users($db);

    db_close($db);

    send_resolve(true);
}
