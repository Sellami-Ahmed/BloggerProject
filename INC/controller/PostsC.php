<?php
require_once __DIR__ . '/../config/Config.php';

require_once __DIR__ . '/../model/Post.php';

require_once __DIR__ . '/../model/Comment.php';

require_once __DIR__ . '/../model/User.php';
$db = Config::getDB();

function getNbComments($id_post)
{
  global $db;
  if (Comment::getNbComments($db, $id_post)->nbcomment != null) {
    return Comment::getNbComments($db, $id_post)->nbcomment;
  }
  return 0;
}


function addLikedPost($id, $post, $bool = true)
{
  global $db;
  return User::addLikedPost($db, $id, $post, $bool);
}
function findLikedPost($id, $post)
{
  global $db;
  return User::findLikedPost($db, $id, $post);
}
function incViews($id)
{
  global $db;
  return Post::incViews($db, $id);
}
function deletePostByID($id)
{
  global $db;
  return Post::delete($db, $id);
}
function incLikes($id, $op = '+')
{
  global $db;
  return Post::incLikes($db, $id, $op);
}
function incComments($id, $op = '+')
{
  global $db;
  return Post::incComments($db, $id, $op);
}
function postSave($header, $title, $content, $category, $tags, $blogger, $id = null)
{
  global $db;
  $p = new Post($header, $title, $content, $category, $tags, $blogger);
  return $p->save($db, $id);
}
function getPostInf($id)
{
  global $db;
  return Post::getbyid($db, $id);
}
function search($elem, $istag = 'false')
{
  global $db;
  if ($istag == 'true') {
    $posts = Post::searchByTag($db, $elem);
  } else if ($istag == 'name') {
    $posts = Post::searchByName($db, $elem);
  } else {
    $posts = Post::searchByCategory($db, $elem);
  }

  $result = "<div class='row'>";
  if (count($posts) > 0) {
    foreach ($posts as $value) {
      $nbComments = getNbComments($value->id);

      $result .= "<div class='col-lg-6 ' >
      <!-- Blog post-->
      <div class='card mb-4 border border-dark border-2' >
          <a href='./INC/view/post.php?id=$value->id'><img class='card-img-top' height='200' src='./INC/SRC/img/$value->id.jpg' alt='...' /></a>
          <div class='card-body'>


          <div class='d-flex bd-highlight'>
              <div class='p-2 bd-highlight'><div class='small text-muted'>$value->submit_date</div></div>
              <div class='ms-auto p-2 bd-highlight'><a class='badge bg-secondary text-decoration-none link-light' href='#!'>$value->category</a></div>
          </div>
              
            
              <h2 class='card-title h4'>$value->title</h2>
              <p class='card-text'>$value->header</p>";
      $result .= '<div class="d-flex bd-highlight align-items-center">
                      <div class="p-2 bd-highlight"><a class="btn btn-primary btn-sm" href="./INC/view/post.php?id=' . $value->id . '">Read more →</a></div>
                      <div class="ms-auto p-2 bd-highlight">
                          <div class="row align-items-center">
                              <div class="col align-items-center">
                                  <div class="small text-center">
                                      <i class="fa fa-heart"></i>
                                      <p style="margin-bottom: 0 !important; ">' . $value->likes . '</p>
                                  </div>
                              </div>
                              <div class="col align-items-center">
                                  <div class="small text-center">
                                      <i class="fa fa-comment"></i>
                                      <p style="margin-bottom: 0 !important; ">' . $nbComments . '</p>
                                  </div>
                              </div>
                              <div class="col align-items-center">
                                  <div class="small text-center">
                                      <i class="fa fa-eye"></i>
                                      <p style="margin-bottom: 0 !important; ">' . $value->views . '</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';
      $result .= "</div>
      </div></div>";
    }
  } else {
    $result .= "0 result's found";
  }
  $result .= "</div>";


  return $result;
}
function convert($string)
{
  try {
    $res = explode("#", trim($string, '#'));
    $output = "";
    foreach ($res as $tag) {
      $output .= "<a class='m-1 badge bg-secondary text-decoration-none link-light' href='#!'>#$tag</a>";
    }
    return $output;
  } catch (Exception $e) {
    var_dump($e);
    return "";
  }
}
function getPostByid($id)
{
  global $db;

  $post = Post::getbyid($db, $id);
  if (!$post) {
    return false;
  }
  if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
  } else {
    $user = null;
  }

  if (!is_null($user) && $user->isAdmin) {
    $edit = "                  <div class='ms-auto p-2 bd-highlight'>
    <div class='dropdown'>
      <i class='fa fa-bars' aria-hidden='true' aria-hidden='true' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'></i>
      <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
        <li>
          <a class='dropdown-item d-flex bd-highlight mb-3' data-bs-toggle='modal' data-bs-target='#exampleModal'>
            <div class='p-2 bd-highlight'><i class='fa fa-edit' aria-hidden='true'></i></div>
            <div class='ms-auto p-2 bd-highlight'> Edit</div>
          </a>
        </li>
        <li>
          <a class='dropdown-item d-flex bd-highlight mb-3' href='../controller/DeletePC.php?id=$id'>
            <div class='p-2 bd-highlight'><i class='fa fa-trash' aria-hidden='true'></i></div>
            <div class='ms-auto p-2 bd-highlight'> Delete</div>
          </a>
        </li>
      </ul>
    </div>
  </div>";
  } else if (!is_null($user) && !$user->isAdmin) {
    if (!findLikedPost($user->id, $id)) {
      $color = 'btn-dark';
    } else {
      $color = 'btn-danger';
    }
    $edit = "<div class='ms-auto p-2 bd-highlight'>
    <a href='../controller/LikeC.php?id=$id&user=$user->id' class='btn $color ' name='comment' id='comments'>
                                  <i class='fa fa-heart'></i>
                                </a>
    </div>";
  } else {
    $edit = "";
  }
  $result = "<!-- Post header-->
          <header class='mb-4'>
                      <!-- Post title-->
                      <div class='d-flex bd-highlight mb-3'>
                        <div class='p-2 bd-highlight'>
                          <h1 class='fw-bolder mb-1'>$post->title</h1>
                        </div>
                        
                        $edit


                      </div>
          
          
                      <!-- Post meta content-->
                      <div class='text-muted fst-italic mb-2'>
                      $post->submit_date<br/>
                      Blogger name: <b>$post->blogger</b>
                      </div>" . convert($post->tags) . "
                      
                    </header>
                    <!-- Preview image figure-->
                    <figure class='mb-4'>
                      <img class='img-fluid rounded' src='../SRC/img/$post->id.jpg' alt='...' />
                    </figure>
                    <!-- Post content-->
                    <section class='mb-5'>
                      <p class='fs-5 mb-4'>
                      $post->content
                      </p>
                    </section>";

  return $result;
}
function getAllPosts()
{
  global $db;

  $posts = Post::getAll($db);
  if ($posts) {
    $result = "<div class='row'>";

    foreach ($posts as $value) {
      $nbComments = getNbComments($value->id);
      $result .= "<div class='col-lg-6 ' >
              <!-- Blog post-->
              <div class='card mb-4 border border-dark border-2' >
                  <a href='./INC/view/post.php?id=$value->id'><img class='card-img-top' height='200' src='./INC/SRC/img/$value->id.jpg' alt='...' /></a>
                  <div class='card-body'>
      
      
                  <div class='d-flex bd-highlight'>
                      <div class='p-2 bd-highlight'><div class='small text-muted'>$value->submit_date</div></div>
                      <div class='ms-auto p-2 bd-highlight'><a class='badge bg-secondary text-decoration-none link-light' href='#!'>$value->category</a></div>
                  </div>
                      
                    
                      <h2 class='card-title h4'>$value->title</h2>
                      <p class='card-text'>$value->header</p>";
      $result .= '<div class="d-flex bd-highlight align-items-center">
                              <div class="p-2 bd-highlight"><a class="btn btn-primary btn-sm" href="./INC/view/post.php?id=' . $value->id . '">Read more →</a></div>
                              <div class="ms-auto p-2 bd-highlight">
                                  <div class="row align-items-center">
                                      <div class="col align-items-center">
                                          <div class="small text-center">
                                              <i class="fa fa-heart"></i>
                                              <p style="margin-bottom: 0 !important; ">' . $value->likes . '</p>
                                          </div>
                                      </div>
                                      <div class="col align-items-center">
                                          <div class="small text-center">
                                              <i class="fa fa-comment"></i>

                                              

                                              <p style="margin-bottom: 0 !important; ">' . $nbComments . '</p>

                                          </div>
                                      </div>
                                      <div class="col align-items-center">
                                          <div class="small text-center">
                                              <i class="fa fa-eye"></i>
                                              <p style="margin-bottom: 0 !important; ">' . $value->views . '</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>';
      $result .= "</div>
              </div></div>";
    }
    $result .= "</div>";


    return $result;
  } else {
    return '';
  }
}
function getFeatredPost()
{
  global $db;

  $post = Post::getFeatred($db);

  if ($post) {
    $nbComments = getNbComments($post->id);
    return "<div class='card mb-4 border border-dark border-2'>
    <a href='./INC/view/post.php?id=$post->id'><img class='card-img-top'  width='850' height='350' src='./INC/SRC/img/$post->id.jpg' alt='...' /></a>
    <div class='card-body'>
    <div class='d-flex bd-highlight'>
    <div class='p-2 bd-highlight'><div class='small text-muted'>$post->submit_date</div></div>
    <div class='ms-auto p-2 bd-highlight'><a class='badge bg-secondary text-decoration-none link-light' href='#!'>$post->category</a></div>
</div>
      <h2 class='card-title'>Featured Post : $post->title</h2>
      <p class='card-text'>
      $post->header
      </p>
      <div class='d-flex bd-highlight align-items-center'>
        <div class='p-2 bd-highlight'><a class='btn btn-primary btn-sm' href='./INC/view/post.php?id=$post->id'>Read more →</a></div>
        <div class='ms-auto p-2 bd-highlight'>
          <div class='row align-items-center'>
            <div class='col align-items-center'>
              <div class='small text-center'>
                <i class='fa fa-heart'></i>
                <p style='margin-bottom: 0 !important; '>$post->likes</p>
              </div>
            </div>
            <div class='col align-items-center'>
              <div class='small text-center'>
                <i class='fa fa-comment'></i>

                <p style='margin-bottom: 0 !important; '>$nbComments</p>

              </div>
            </div>
            <div class='col align-items-center'>
              <div class='small text-center'>
                <i class='fa fa-eye'></i>
                <p style='margin-bottom: 0 !important; '>$post->views</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>";
  } else {
    return '<p>No post found</p>';
  }
}
