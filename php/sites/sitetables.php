<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../db/tables/articles_table.php';
require_once __DIR__ . '/../db/tables/comments_table.php';
require_once __DIR__ . '/../db/tables/pages_table.php';
require_once __DIR__ . '/../db/tables/sections_table.php';
require_once __DIR__ . '/../db/tables/settings_table.php';
require_once __DIR__ . '/../db/tables/themes_table.php';
require_once __DIR__ . '/../db/tables/users_table.php';

function create_sitetables(array $site): void
{
    $db = db_open($site['key']);

    create_settings($db, $site);
    
    create_theme($db, $site);

    $pageId = create_pages($db, $site);
    $articleId = create_articles($db, $pageId, $site);
    create_sections($db, $articleId, $site);
    create_users($db, $site);
    create_comments($db, $site);

    db_close($db);
}

function create_settings(mysqli $db, array $site): void
{
    if (verify_settings_table($db, $site['key'])) {
        db_insert($db, 'settings',
            ['title', 'owner', 'email', 'logo', 'theme'],
            [$site['title'], $site['owner'], $site['email'], $site['logo'], $site['theme']]
        );
    }
}

function create_pages(mysqli $db, array $site): int
{
    if (verify_pages_table($db, $site['key'])) {
        return db_insert($db, 'pages', pages_cols, get_default_page('Start', 'admin') );
    }
    return 0;
}

function create_articles(mysqli $db, int $pageId, array $site): int | bool | string
{
    if (verify_articles_table($db, $site['key'])) {
        return db_insert($db, 'articles',
            ['pageId', 'pos'],
            [$pageId, 0]);
    }
    return 0;
}

function create_sections(mysqli $db, int $articleId, array $site): int | bool | string
{
    if (verify_sections_table($db, $site['key'])) {
        $content = json_encode( [
            'text' => '...'
        ]);
        return db_insert($db, 'sections',
            ['articleId', 'type', 'pos', 'align', 'content'],
            [$articleId, 'text', 0, 'left', $content]
        );
    }
    return 0;
}

function create_theme(mysqli $db, array $site): void
{
    if (verify_themes_table($db, $site['key'])) {

        db_insert($db, 'themes', theme_cols, get_default_theme());
    }
}

function create_users(mysqli $db, array $site): void
{
    if (verify_users_table($db, $site['key'])) {
        db_insert($db, 'users', ['username', 'fullname', 'email', 'picture', 'password', 'adm'],
            get_default_user($site['owner'], $site['email']));
    }
}

function create_comments(mysqli $db, array $site): void
{
    verify_comments_table($db, $site['key']);
}
