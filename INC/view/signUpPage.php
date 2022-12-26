<?php
session_start();
if (isset($_SESSION["user"])) {
	header("Location: ../../index.php");
}

// unset($_SESSION["status"]);
if (!isset($_SESSION["status"])) {
	$_SESSION["status"] = "";
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
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="../SRC/css/bootstrap.min.css" rel="stylesheet" />
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
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
							<form method="POST" action="./../controller/SignUpController.php" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Full Name</label>
									<input id="name" type="text" class="form-control" name="usersName" value="" autofocus>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="usersEmail" value="">
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Username</label>
									<input id="name" type="text" class="form-control" name="usersUid" value="">
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="usersPwd">
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Repeat password</label>
									<input id="password" type="password" class="form-control" name="pwdRepeat">
								</div>

								<p class="form-text text-muted mb-3">
									By registering you agree with our terms and condition.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Register
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Already have an account? <a href="./loginPage.php" class="text-dark">Login</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
		</div>
	</footer>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" href="alert/dist/sweetalert.css">
	<script type="text/javascript">
		var status = document.getElementById("status").value;
		if (status == "success") {
			swal("Congrats", "Account Created Successfully", "success").then(function() {
				<?php $_SESSION["status"] = ""; ?>
				window.location = "loginPage.php";
			});
		} else if (status == "failed") {
			swal("Sorry", "Wrong username or password", "error").then(function() {
				<?php $_SESSION["status"] = ""; ?>
			});;
		} else if (status == "UIDExist") {
			swal("Sorry", "UserID already exists", "error").then(function() {
				<?php $_SESSION["status"] = ""; ?>
			});;
		} else if (status == "invalidPassword") {
			swal("Sorry", "Please enter Password", "error").then(function() {
				<?php $_SESSION["status"] = ""; ?>
			});;
		}
	</script>
</body>


</html>