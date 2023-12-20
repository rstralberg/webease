<?php 

function css() : string {

    $cssfiles = glob('../public/css/*.css');
    $css = '';
    foreach ($cssfiles as $font) {
        $parts = pathinfo($font);
        $css .= '<link rel="stylesheet" type="text/css" href="css/' . $parts['basename'] . '">' . PHP_EOL;
    }

    return $css;
}

?>
