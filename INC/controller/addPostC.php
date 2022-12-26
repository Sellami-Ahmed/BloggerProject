<?php
session_start();
require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/PostsC.php';
$id = $_POST["id"];
$action = $_GET["action"];
$title = $_POST["title"];
$header = $_POST["header"];
$content = $_POST["content"];
$tags = $_POST["tags"];
$category = $_POST["category"];
if ($action == "edit") {
    $result = postSave($header, $title, $content, $category, $tags, $_SESSION["user"]->username, $id);
    $target_dir = __DIR__ . "/../SRC/img/";
    $target_file = $target_dir . basename($id) . ".jpg";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $_SESSION["status"] = "editSuccess";
    header("location: ../view/post.php?id=" . $id);
} else {
    $id = postSave($header, $title, $content, $category, $tags, $_SESSION["user"]->username);
    $image = __DIR__ . "/../SRC/img/$id.jpg";
    $target_dir = __DIR__ . "/../SRC/img/";
    $target_file = $target_dir . basename($id) . ".jpg";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $_SESSION["status"] = "addSuccess";
    header("location: ../../index.php");
}
