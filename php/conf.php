<?php

class Conf {

    public $dbHost;
    public $dbUser;
    public $dbDatabase;
    public $dbPassword;
    public $dbTheme;
    public $iconPrefix;
    public $dbMaxImageSize;
}

function load_config() : Conf {
    
    if( !isset($GLOBALS['conf']) ) {
        $fh = fopen(__DIR__.'/../config.json', 'r' ) ;
        if( $fh === null) die( 'Konfiguration saknas');
        $content = fread($fh, 2048);
        fclose($fh);
        
        $params = json_decode($content);
        $conf = new Conf;
        $conf->dbHost = $params->dbHost;
        $conf->dbUser = $params->dbUser;
        $conf->dbPassword = $params->dbPassword;
        $conf->dbTheme = $params->dbTheme;
        $conf->iconPrefix = $params->iconPrefix;
        $conf->dbMaxImageSize = $params->dbMaxImageSize;
        $GLOBALS['conf'] = $conf;
    }
    return $GLOBALS['conf'];
}
