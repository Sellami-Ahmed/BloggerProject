<?php
session_start();
require_once "./header.php";
if (isset($_SESSION["user"])) {
  $user = $_SESSION["user"];
} else {
  $user = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Blog Post - Start Bootstrap Template</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../SRC/css/bootstrap.min.css" rel="stylesheet">
  <script src="../SRC/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

  <script type="text/javascript">
    function searchID(id) {
      $.ajax({
        type: 'POST',
        url: '../controller/SearchC.php',
        data: {
          name: id,
          tag: 'false',
        },
        success: function(data) {
          $('#output').html(data);
        }
      });
    }
    $(document).ready(function() {
      $("#searchN").keyup(function() {
        $.ajax({
          type: 'POST',
          url: '../controller/SearchC.php',

          data: {
            name: $("#searchN").val(),
            tag: 'name',
          },
          success: function(data) {
            $("#output").html(data);
          }
        });
      });
    });
    $(document).ready(function() {
      $("#search").keyup(function() {
        $.ajax({
          type: 'POST',
          url: '../controller/SearchC.php',

          data: {
            name: $("#search").val(),
            tag: 'true',
          },
          success: function(data) {
            $("#output").html(data);
          }
        });
      });
    });
  </script>
  <!-- Responsive navbar-->
  <?php

  echo showheader($user, true);
  ?>

  <input type="hidden" id="status" value="<?php echo $_SESSION["status"]; ?>">


  <!-- Page content-->
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-8">
        <!-- Post content-->
        <div class='card  p-4 border border-dark border-2' id="output">

          <article>
            <?php
            require_once "./../controller/PostsC.php";
            $post = getPostByid($_GET['id']);
            if ($post) {
              require_once "./../view/addPost.php";
              echo getPostByid($_GET['id']);
              incViews($id);
            } else {
              header("location: ../../index.php");
            }
            ?>
          </article>

          <!-- Comments section-->
          <section class="mb-5 ">
            <div class="card text-bg-light">
              <div class="card-body">
                <!-- Comment form-->
                <form action="../controller/addCommentC.php" method="POST" class="mb-2 ">
                  <div class=" row d-flex justify-content-between mb-2 pe-2 text-dark ">

                    <input hidden name="user_id" value=<?php
                                                        if (!is_null($user)) {
                                                          echo $user->id;
                                                        }
                                                        ?> />
                    <input hidden name="post_id" value=<?php echo $_GET['id'] ?> />
                    <?php
                    if (!is_null($user)) {
                      echo '<div class="col-11 ">
                                <textarea required class="form-control" rows="1" name="content" placeholder="Join the discussion and leave a comment!"></textarea>
                              </div>
                              <div class="col-1 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary " name="comment" id="comments">
                                  <i class="fa fa-paper-plane"></i>
                                </button>
                                
                              </div>';
                    }
                    ?>




                  </div>
                </form>
                <!-- Comment with nested comments-->
                <?php
                require_once __DIR__ . "/../controller/CommentsC.php";
                echo showAllComments($_GET['id']);
                ?>
                <!-- Single comment-->

              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- Side widgets-->
      <div class="col-lg-4">
        <!-- Search widget-->
        <div class="card mb-4">
          <div class="card-header text-bg-dark">Search</div>
          <div class="card-body">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search posts by tag..." aria-describedby="button-search" />

            </div>
          </div>
        </div>
        <!-- Categories widget-->
        <?php
        require_once __DIR__ . "/../controller/CategoryC.php";
        echo getAllCategories();
        ?>
        <!-- Side widget-->

      </div>
    </div>
  </div>
  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">
        Copyright &copy; Your Website 2022
      </p>
    </div>
  </footer>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="alert/dist/sweetalert.css">
  <script type="text/javascript">
    var status = document.getElementById("status").value;
    if (status == "editSuccess") {
      swal("Congrats", "Your post was edited, thank you!", "success").then(function() {
        <?php $_SESSION["status"] = ""; ?>
      });
    }
  </script>
</body>

</html>