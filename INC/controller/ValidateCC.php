<?php
require_once __DIR__ . '/PostsC.php';
require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/CommentsC.php';

$db = Config::getDB();
$id = $_GET['id'];
$post_id = $_GET['post'];

validateComment($id);
incComments($post_id);
header("location: ../view/post.php?id=$post_id#comments");
