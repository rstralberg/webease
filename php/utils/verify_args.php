<?php

require_once __DIR__ . '/send_reply.php';

function verify_args( stdClass $args, array $more = []) : bool {

    if( !isset($args->key) ) { send_reject( 'Missing argument: key'); return false; }
    if( !isset($args->php) ) { send_reject( 'Missing argument: php'); return false; }
    foreach( $more as $arg) {
        if( !isset($args->$arg) ) { send_reject( 'Missing argument: "'.$arg.'"'); return false; }
    }
    return true;
}

?>