<?php
require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/../model/Comment.php';
$db = Config::getDB();
function updateComment($post_id, $content, $commenter, $id)
{
  global $db;
  $c = new Comment($post_id, $content, $commenter);
  return $c->save($db, $id);
}
function newComment($post_id, $content, $commenter)
{
  global $db;
  $c = new Comment($post_id, $content, $commenter);
  return $c->save($db);
}
function newReply($post_id, $content, $commenter, $parent)
{
  global $db;
  $c = new Comment($post_id, $content, $commenter, $parent);
  return $c->save($db);
}
function deleteComment($id)
{
  global $db;
  return Comment::delete($db, $id);
}

function validateComment($id)
{
  global $db;
  return Comment::validate($db, $id);
}

function getbyPost($id)
{
  global $db;
  return Comment::getbyPost($db, $id);
}




function countComment()

{
  global $db;
  return Comment::countComment($db);
}

function showAllComments($id)
{
  $pComments = getbyPost($id);

  if (isset($_SESSION["user"])) {
    $result = "";
  } else {
    $result = "<p><a href='./loginPage.php'>Login</a> to comment!</p><br/>";
  }

  foreach ($pComments as $comment) {
    if (isset($_SESSION["user"])) {
      $user = $_SESSION["user"];
    } else {
      $user = null;
    }
    $color = "primary";
    if ($comment->isAdmin) {
      $color = "danger";
    }
    if (!$comment->valid) {
      $valid = "<small class='text-muted'>Not yet validated...</small>";
    } else {
      $valid = "";
    }

    $result .= "
        <div class='d-flex justify-content-between mb-2 rounded pe-2 border text-dark bg-white'>
        
  <div class='p-2'>
    <div class='fw-bold badge bg-$color'>
      <div class=' d-flex '>
      
        <div class='bd-highlight'><i class='fa fa-user pe-2'></i>$comment->usersUid</div>
        
        
      </div>
    </div>
    $valid
    <div class='text-break ms-3 mt-2'>
    $comment->content </div>
    
    ";

    $result .= "</div>";
    $result .= "<div class='d-flex align-items-center  text-wrap pe-2 ps-4'>";

    if (!is_null($user) && $user->isAdmin && !$comment->valid) {
      $result .= "<a class='badge bg-success ' href='../controller/ValidateCC.php?id=$comment->id&post=$id'><i class='fa fa-check p-1'></i></a>";
    }
    if (!is_null($user) && ($user->isAdmin || $user->id == $comment->user_id)) {
      $result .= "<a class='badge bg-secondary ' href='../controller/DeleteCC.php?id=$comment->id&post=$id'><i class='fa fa-trash p-1'></i></a>";
    }

    $result .= "</div>";
    $result .= "</div>";
  }
  return $result;
}
