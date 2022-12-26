<?php
require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/PostsC.php';

$id = $_GET["id"];

if (deletePostByID($id)) {

    $file_to_dele = "../SRC/img/" . $id . ".jpg";
    unlink($file_to_dele);
    header("location: ../../index.php");
}
