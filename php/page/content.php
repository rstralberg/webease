<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';
require_once __DIR__ . '/../creators/create_audio.php';
require_once __DIR__ . '/../creators/create_empty.php';
require_once __DIR__ . '/../creators/create_image.php';
require_once __DIR__ . '/../creators/create_list.php';
require_once __DIR__ . '/../creators/create_soundcloud.php';
require_once __DIR__ . '/../creators/create_spotify.php';
require_once __DIR__ . '/../creators/create_text.php';
require_once __DIR__ . '/../creators/create_title.php';
require_once __DIR__ . '/../creators/create_youtube.php';
require_once __DIR__ . '/../creators/create_gallery.php';
require_once __DIR__ . '/../creators/create_video.php';
require_once __DIR__ . '/../creators/create_slider.php';
require_once __DIR__ . '/../creators/create_vimeo.php';

if (verify_args($args, ['pageid'])) {

    $db = db_open($args->key);

    $aid = 0;
    $articles = db_select($db, 'articles', ['*'], db_where($db, 'pageId', $args->pageid), db_order_by('pos', 'asc'));
    if( gettype($articles) !== 'array' ) {
        $aid = db_insert($db, 'articles', 
            ['pageId','pos','align'], 
            [$args->pageid, '0', ''] );
        if( gettype($aid) === 'boolean' && $aid === false ) {
            send_reject('Page does not contain any articles');
            db_close($db);
            exit(0);
        }
        $articles = db_select($db, 'articles', ['*'], db_where($db, 'pageId', $args->pageid), db_order_by('pos', 'asc'));
    }

    $html = '';
    foreach($articles as $article) {
        $sections = db_select($db, 'sections', ['*'], db_where($db, 'articleId', $article['id']), db_order_by('pos', 'asc'));
        if( gettype($sections) !== 'array' ) {
            $sid = db_insert($db, 'sections', 
            [ 'articleId', 'type', 'pos', 'align', 'content'],
            [ $article['id'], 'empty', 0, '', '' ]);
            if( gettype($sid) === 'boolean' && $sid === false ) {
                send_reject('Article does not contain any sections');
                db_close($db);
                exit(0);
            }
            $sections = db_select($db, 'sections', ['*'], db_where($db, 'articleId', $article['id']), db_order_by('pos', 'asc'));
        }

        $html .= '<article id="a'.$article['id'].'" ';
        $html .= 'type="article" >';
        
        foreach( $sections as $section) {
            
            $html .= '<section id="s'.$section['id'].'" ' ;
            $html .= 'type="'.$section['type'].'" ';
            $html .= 'class="'.$section['type'].'" ';
            $html .= 'style="justify-content:';  
            $html.= $section['align'] === '' ? 'left' : $section['align'];
            $html.= '">';
            switch( $section['type']) {
                case 'audio': $html.= create_audio($args->key, $args->pageid, $section); break;
                case 'empty': $html.= create_empty(); break;
                case 'image': $html.= create_image($args->key, $args->pageid, $section); break;
                case 'gallery': $html.= create_gallery($args->key, $args->pageid, $section); break;
                case 'video': $html.= create_video($args->key, $args->pageid, $section); break;
                case 'list': $html.= create_list($section); break;
                case 'soundcloud': $html.= create_soundcloud($section); break;
                case 'spotify': $html.= create_spotify($section); break;
                case 'text':  $html.= create_text($section); break;
                case 'title': $html.= create_title($section); break;
                case 'youtube': $html.= create_youtube($section); break;
                case 'vimeo': $html.= create_vimeo($section); break;
                case 'slider': $html.= create_slider($args->key, $args->pageid, $section); break;
                default: break;
            }
            $html.= '</section>';
        }
        $html.='</article>';
    }
    db_close($db);

    send_resolve(compress_html($html));
    exit(0);
}
