<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, [])) {

     $db = db_open($args->key);

     $pages = db_select($db, 'pages', ['id', 'title', 'isParent'], null, db_order_by('pos', 'asc'));

     $all = '';
     foreach ($pages as $page) {
         $all .= '<option value="' . $page['id'] . '">' . $page['title'] . '</option>';
     }
 
     $parents = '';
     foreach ($pages as $page) {
         if( $page['isParent'] === '1' ) {
             $parents .= '<option value="' . $page['id'] . '">' . $page['title'] . '</option>';
         }
     }
 
     send_resolve( load_form(__DIR__ . '/edit', [
         'pages' => $all,
         'parents' => $parents
     ]));
}

?>
