<?php

function send_resolve(string|stdClass|bool $content): void
{
    header('Content-Type: application/json');
    try {
        echo( json_encode([
            'ok' => true,
            'content' => $content
        ])) ;
    } catch (Exception $ex) {
        echo (json_encode([
            'ok' => false,
            'content' => $ex->getMessage()
        ]));
    }
}

function send_reject(string|stdClass|bool $content): void
{
    header('Content-Type: application/json');
    try {
        echo( json_encode([
            'ok' => false,
            'content' => $content
        ]));
        
    } catch (Exception $ex) {
        echo (json_encode([
            'ok' => false,
            'content' => $ex->getMessage()
        ]));
    }
}
    
