<?php
require_once __DIR__.'/../config/Config.php';
require_once __DIR__.'/PostsC.php';
$post=$_GET["id"];
$id=$_GET["user"];
if (!findLikedPost($id,$post)) 
{
    addLikedPost($id,$post);
    incLikes($post);
}
else{
    addLikedPost($id,$post,false);
    incLikes($post,'-');
}

header("location: ../view/post.php?id=".$post);