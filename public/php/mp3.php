<?php
require_once __DIR__ . '/../../php/utils/send_reply.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['mp3']['error'] === UPLOAD_ERR_OK) {

        $key = $_POST['key'];
        $folder = $_POST['folder'];
        
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/sites/' . $key . '/' . $folder;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = basename($_FILES['mp3']['name']);
        $uploadFile = $uploadDir . '/' . $filename;

        if (move_uploaded_file($_FILES['mp3']['tmp_name'], $uploadFile)) {
            send_resolve('sites/' . $key . '/' . $folder . '/' . $filename);
            exit(0);
        }
    }
}
send_reject('Uppladningen misslyckades');
exit(0);
