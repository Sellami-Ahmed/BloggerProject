<?php
require_once __DIR__ . '/PostsC.php';
require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/CommentsC.php';
$content = $_POST["content"];
$post_id = $_POST["post_id"];
$user_id = $_POST["user_id"];



if($result=newComment($post_id,$content, $user_id)){
    incComments($post_id);
};
header("location: ../view/post.php?id=$post_id#comments");
?>

