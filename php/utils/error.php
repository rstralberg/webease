<?php

require_once __DIR__ . '/strings.php';
require_once __DIR__ . '/send_reply.php';

function assert_hander($file, $line, $code, $desc = null)
{
    echo 'Assert in ' . $file . ' at line ' . $line .': ' . $code . PHP_EOL ;
    if ($desc) {
        echo ": $desc" . PHP_EOL ;
    }
    echo PHP_EOL ;
}


// ERRORS
//set_error_handler('appErrorHandler');
function appErrorHandler($errno, $errstr, $errfile, $errline)
{
    send_reject('ERROR [' . $errno . ']: ' . $errstr . PHP_EOL .
        'FILE ' . $errfile . ' ' . ' at line ' . $errline . PHP_EOL );
}

// EXECPTIONS
//set_exception_handler("appExceptionHandler");
function appExceptionHandler($exception)
{
    $out = 'Exception ' . PHP_EOL .  
        $exception->getMessage() . PHP_EOL .
        $exception->getFile() . ' at line ' . $exception->getLine() . PHP_EOL  .
        '------------------------------------------------' . PHP_EOL ;
        foreach( $exception->getTrace() as $trace ) {
            $out .= $trace['function'] . '(' ;
            if( array_key_exists('args', $trace ) ) {
                foreach($trace['args'] as $arg ) {
                    $out .=  $arg . ', ';
                }
            }
            $out .= ');' . PHP_EOL ;
        }
        $out .= '------------------------------------------------' . PHP_EOL ;
    send_reject($out) ;
}

function userError(string $function, string $msg) : void {
    send_reject('ERROR in function ' . $function . PHP_EOL .
        'Message: ' . $msg . PHP_EOL ) ;
}   
