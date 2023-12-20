<?php 

require_once __DIR__ . '/../conf.php';

function icons() : string {
    
    $cfg = load_config();
    $fh = fopen(__DIR__. '/../../public/icons/site.webmanifest', 'w');
    if($fh) {
        fwrite($fh, '
        {
            "name": "",
            "short_name": "",
            "icons": [
                {
                    "src": "/icons/'.$cfg->iconPrefix.'-128.png",
                    "sizes": "128x128",
                    "type": "image/png"
                },
                {
                    "src": "/icons/'.$cfg->iconPrefix.'-32.png",
                    "sizes": "32x32",
                    "type": "image/png"
                },
                {
                    "src": "/icons/'.$cfg->iconPrefix.'-16.png",
                    "sizes": "16x16",
                    "type": "image/png"
                }
            ],
            "theme_color": "#ffffff",
            "background_color": "#ffffff",
            "display": "standalone"
        }');
        fclose($fh);
    }


    $html  = '<link rel="apple-touch-icon" sizes="128x128" href="icons/'.$cfg->iconPrefix.'-128.png">';
    $html .= '<link rel="icon" type="image/png" sizes="32x32" href="icons/'.$cfg->iconPrefix.'-32.png">';
    $html .= '<link rel="icon" type="image/png" sizes="16x16" href="icons/'.$cfg->iconPrefix.'-16.png">';
    $html .= '<link rel="manifest" href="icons/site.webmanifest">';

    return $html;
}

?>
