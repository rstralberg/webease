<?php

require_once __DIR__ . '/../utils/load_form.php';
require_once __DIR__ . '/../utils/send_reply.php';
require_once __DIR__ . '/../utils/verify_args.php';

if (verify_args($args, ['username'])) {

     send_resolve( load_form(__DIR__.'/logout', [
          'username' => $args->username,
          'disabled' => $args->username === 'admin' ? 'disabled' : ''
     ]));
     exit(0);
}
