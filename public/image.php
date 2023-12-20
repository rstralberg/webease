
<?php

require_once __DIR__ . '/../php/utils/load_html.php';
require_once __DIR__ . '/../php/utils/send_reply.php';
require_once __DIR__ . '/../php/utils/scaleimage.php';

$image = $_POST['image'];
$folder = $_POST['folder'];
$key = $_POST['key'];
$name = $_POST['name'];
$type = $_POST['type'];

$image = str_replace('data:image/' . $type . ';base64,', '', $image);
$image = str_replace(' ', '+', $image);

$data = base64_decode($image);

$folder = $_SERVER['DOCUMENT_ROOT'] . '/sites/' . $key . '/' . $folder;

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

$src = $folder . '/' . $name;
file_put_contents($src, $data);

send_resolve($name);
exit(0);

?>