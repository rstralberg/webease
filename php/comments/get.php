<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['pageid'])) {

    $db = db_open($args->key);
    $content = array();
    $comments = db_select($db, 'comments', ['*'], db_where($db, 'pageId', $args->pageid), db_order_by('date', 'asc'));
    
    
    $html = '';
    if( gettype($comments) !== 'array') {
        db_close($db);
        send_resolve($html);
        exit(0);
    }

    foreach($comments as $comment) {

        $imgsrc = 'icons/avatar.png';
        $users = db_select($db, 'users', ['username', 'picture'], db_where($db, 'username', $comment['author']));
        if( $users !== false && gettype($users) !== 'string') {
            $imgsrc = 'sites/' . $args->key . '/users/' . $users[0]['picture'];
        }
        $html.= '<div class="comment-block">';
        $html.= '   <div class="comment-picture"><img src="'.$imgsrc.'"" width="48px" height="auto"></div>';
        $html.= '   <div class="comment-author">'.$comment['author'].'</div>';
        $html.= '   <div class="comment-date">'.$comment['date'].'</div>';
        $html.= '   <div class="comment-cont">';
        $html.= '       <div class="comment-title">'.$comment['title'].'</div>';
        $html.= '       <div class="comment-text">'.$comment['comment'].'</div>';
        $html.= '   </div>';
        $html.= '</div>';
    }
    db_close($db);

    send_resolve($html);
    exit(0);
}
