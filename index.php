<?php
session_start();
if (!isset($_SESSION["status"])) {
  $_SESSION["status"] = "";
}
?>
<!DOCTYPE html>
<html lang="en" style="height:100vh;">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Blog Home - Start Bootstrap Template</title>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="./INC/SRC/css/bootstrap.min.css" rel="stylesheet">
  <script src="./INC/SRC/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="d-flex flex-column h-100">
  <input type="hidden" id="status" value="<?php echo $_SESSION["status"]; ?>">

  <script type="text/javascript">
    function searchID(id) {
      $.ajax({
        type: 'POST',
        url: 'INC/controller/SearchC.php',
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
          url: 'INC/controller/SearchC.php',

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
          url: 'INC/controller/SearchC.php',

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
  <?php

  require_once "./INC/view/header.php";
  require_once "./INC/view/addPost.php";
  require_once "./INC/view/crudCategory.php";
  if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
  } else {
    $user = null;
  }
  echo showheader($user);
  ?>

  <!-- Page content-->
  <div class="container mt-5 ">
    <div class="row ">

      <!-- Blog entries-->
      <div class="col-lg-8 ">


        <?php
        if (!is_null($user) && $user->isAdmin) {
          echo '<div class="card mb-4">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus-circle"></i>
          ADD NEW POST
        </button>
      </div>';
        } else {
          echo '';
        } ?>

        <div id="output">
          <?php
          require_once "./INC/controller/PostsC.php";
          echo getFeatredPost();
          ?>
          <!-- Nested row for non-featured blog posts-->
          <?php
          echo getAllPosts();
          ?>
        </div>
      </div>
      <!-- Side widgets-->
      <div class="col-lg-4 ">
        <!-- Search widget-->
        <div class="card mb-4 border border-dark border-2">
          <div class="card-header text-bg-dark">Search</div>
          <div class="card-body">
            <div class="input-group">
              <input type="text" id="search" class="form-control" placeholder="Search posts by tag ...">
            </div>
          </div>
        </div>

        <!-- Categories widget-->
        <?php
        require_once "./INC/controller/CategoryC.php";
        echo getAllCategories();
        ?>
        <?php
        if (!is_null($user) && $user->isAdmin) {
          echo '<div class="d-flex justify-content-around mb-4 ">
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#crud"><i class="fa fa-edit"></i>
            Edit categories
          </button>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addcat"><i class="fa fa-plus-circle"></i>
            Add Category
          </button>
        </div>';
        } else {
          echo '';
        } ?>
        <!-- Side widget-->

      </div>
    </div>
  </div>




  </div>

  <!-- Footer-->
  <footer class="py-5 bg-dark footer mt-auto py-3 bg-light">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
    </div>
  </footer>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="alert/dist/sweetalert.css">
  <script type="text/javascript">
    var status = document.getElementById("status").value;
    if (status == "addSuccess") {
      swal("Congrats", "Your post was published, thank you!", "success").then(function() {
        <?php $_SESSION["status"] = ""; ?>
      });
    }
  </script>
</body>

</html>