<?php
require_once "./header.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    if (!$user->isAdmin) {
        header("Location: ../../index.php");
    }
} else {
    $user = null;
    header("Location: ../../index.php");
}

?>
<!DOCTYPE html>
<html lang="en" style="height: 100vh;">

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body style="height: 100vh;">
    <script>
        <?php
        require_once "./addCrudmanager.php";
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            echo "
        window.onload = function () {
            OpenBootstrapPopup();
        };";
        } ?>

        function OpenBootstrapPopup() {
            $("#editUser").modal('show');
        }
    </script>

    <!-- Responsive navbar-->
    <?php
    echo showheader($user, true);
    ?>

    <input type="hidden" id="status" value="<?php echo $_SESSION["status"]; ?>">


    <!-- Page content-->
    <div class="container mt-5">
        <?php
        require_once __DIR__ . "/../controller/UserC.php";
        echo getAllUsers();
        ?>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark footer mt-auto py-3 bg-light">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="alert/dist/sweetalert.css">
    <script>
        function getXMLHttpRequest() {
            var xhr = null;
            try {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                xhr = new XMLHttpRequest();
            }
            return xhr;
        }

        function toggle(id) {
            var xhr = getXMLHttpRequest();
            obj = document.getElementById(id);
            obj.innerHTML = "";
            xhr.open("GET", "../controller/toggleC.php?id=" + id, true);
            xhr.send();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById(id).innerHTML = xhr.responseText;
                }
            }

        }
    </script>


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