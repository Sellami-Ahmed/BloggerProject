<?php
session_start();


// unset($_SESSION["status"]);
if (!isset($_SESSION["status"])) {
    $_SESSION["status"] = "";
}
if (isset($_SESSION["user"])) {
    $username = $_SESSION["user"]->username;
    $email = $_SESSION["user"]->usersEmail;
} else {
    $username = "";
    $email = "";
}
?>
<!doctype html>
<html lang="en" style="height:100vh;">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../SRC/fonts/icomoon/style.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../SRC/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../SRC/css/style.css">

    <title>Contact Form #10</title>
</head>

<body>
    <input type="hidden" id="status" value="<?php echo $_SESSION["status"]; ?>">
    <?php

    require_once "./header.php";
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
    } else {
        $user = null;
    }
    echo showheader($user, true);
    ?>

    <div class="content">

        <div class="container">
            <div class="row align-items-stretch justify-content-center no-gutters">
                <div class="col-md-7">
                    <div class="form h-100 contact-wrap p-5">
                        <h3 class="text-center">Let's Talk</h3>
                        <form class="mb-5" method="post" action="../controller/SendEmailC.php" id="contactForm" name="contactForm">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="" class="col-form-label">Name *</label>
                                    <input required type="text" class="form-control" name="name" id="name" placeholder="Your name" value="<?php echo $username; ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="" class="col-form-label">Email *</label>
                                    <input required type="email" class="form-control" name="email" id="email" placeholder="Your email" value="<?php echo $email; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="budget" class="col-form-label">Subject</label>
                                    <input required type="text" class="form-control" name="subject" id="subject" placeholder="Your subject">
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="message" class="col-form-label">Message *</label>
                                    <textarea required class="form-control" name="message" id="message" cols="30" rows="4" placeholder="Write your message"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-5 form-group text-center">
                                    <input type="submit" name="send" value="Send Message" class="btn btn-block btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>

                        <div id="form-message-warning mt-4"></div>


                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>

    <script src="../SRC/js/jquery-3.3.1.min.js"></script>
    <script src="../SRC/js/popper.min.js"></script>
    <script src="../SRC/js/bootstrap.min.js"></script>
    <script src="../SRC/js/jquery.validate.min.js"></script>
    <script src="../SRC/js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="alert/dist/sweetalert.css">
    <script type="text/javascript">
        var status = document.getElementById("status").value;
        if (status == "mailSent") {
            swal("Congrats", "Your message was sent, thank you!", "success").then(function() {
                <?php $_SESSION["status"] = ""; ?>
            });
        }
    </script>
</body>

</html>