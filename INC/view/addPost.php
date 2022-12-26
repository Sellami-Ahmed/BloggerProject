<?php
$event = "add";
$path = "INC/";
$modalname = "ADD NEW POST";
$req = "required";
$header = $title = $tags = $content = $image = $category = $id = "";
if (isset($_GET["id"]) && !empty($_GET["id"])) {

  $path = "../";
  $id = $_GET["id"];
  $req = "";
  $modalname = "EDIT POST";
  $event = "edit";
  require_once __DIR__ . "/../controller/PostsC.php";
  $post = getPostInf($_GET["id"]);
  $header = $post->header;
  $title = $post->title;
  $tags = $post->tags;
  $category = $post->category_id;
  $content = $post->content;
  $image = "./../SRC/img/$post->id.jpg";
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"><?php echo $modalname; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo "./" . $path . "controller/addPostC.php?action=" . $event ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body mx-3">
          <div class="form-group">
            <label>Post Title:</label>
            <input required type="text" class="form-control " name="title" value="<?php echo $title; ?>">


          </div>
          <div class="form-group">
            <label for="inlineFormCustomSelectPref">Category:</label>
            <select class="form-select" aria-label="Default select example" name="category" required>
              <option value="">Choose...</option>
              <?php
              require_once __DIR__ . "/../controller/CategoryC.php";
              echo getAllCategoriesSelect($category);
              ?>
            </select>
          </div>
          <div class="form-group">
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Post Header:</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="200" name="header" required><?php echo $header; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Post Tags:</label>
              <textarea class="form-control" id="test" rows="3" maxlength="100" name="tags" required><?php echo $tags; ?></textarea>
            </div>
            <script>
              var a = document.getElementById('test');
              a.addEventListener('keyup', addthis);

              function addthis() {
                b = a.value.replace('#', '');
                a.value = '#' + b

                if (a.value.indexOf(' ')) {
                  a.value = a.value.replace(' ', '#');
                }

              }
            </script>
          </div>
          <div class="form-group">
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Post Content:</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" maxlength="5000" name="content" required><?php echo $content; ?></textarea>
            </div>
          </div>
          <div>
            <div>

              <label for="Image" class="form-label">Post Image:</label>
              <input <?php echo $req; ?> class="form-control" type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $image; ?>" onchange="preview()">

            </div>
            <div class="container col-md-6">
              <img style="margin-top: 20px;" id="frame" src="<?php echo $image; ?>" class="img-fluid" />
            </div>
          </div>

          <script>
            function preview() {
              frame.src = URL.createObjectURL(event.target.files[0]);
            }

            function clearImage() {
              document.getElementById('formFile').value = null;
              frame.src = "";
            }
          </script>

        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary" name="id" value=<?php echo $id; ?>>Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>