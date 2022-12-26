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
<html lang="en" style="height:80vh;">

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


<body style="height:100vh;">
	<input type="hidden" id="status" value="<?php echo $_SESSION["status"]; ?>">
	<?php

	require_once "./header.php";

	echo showheader(null, true);
	?>

	<?php if (!empty($_POST["remember"])) {
		setcookie("name/email", $_POST['name/email'], time() + 3600);
		setcookie("usersPwd", $_POST['usersPwd'], time() + 3600);
	} else {
		setcookie("name/email", "", time() + 3600);
		setcookie("usersPwd", "", time() + 3600);
	}
	?>
	<section class="h-100 ">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="../SRC/img/cd.png" alt="Logo" width="100">
					</div>
					<div class="card shadow-lg ">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
							<form method="POST" action="<?php echo "./../controller/UserC.php?exec=1"?>" class="needs-validation" novalidate="" autocomplete="off">
								<input type="hidden" name="type" value="login">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="text" class="form-control" name="name/email" value="<?php if (isset($_COOKIE["name/email"])) {
																													echo ($_COOKIE["name/email"]);
																												} ?>" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>

									</div>
									<input id="password" type="password" class="form-control" name="usersPwd" value="<?php if (isset($_COOKIE['usersPwd'])) {
																															echo ($_COOKIE['usersPwd']);
																														} ?>" required>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Remember Me</label>
									</div>
									<button type="submit" class="btn btn-primary ms-auto">
										Login
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Don't have an account? <a href="./signUpPage.php" class="text-dark">Create One</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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
		if (status == "failed") {
			swal("Sorry", "Wrong username or password", "error").then(function() {
				<?php $_SESSION["status"] = ""; ?>
			});
		} else if (status == "emptyInput") {
			swal("Sorry", "Please fill out all inputs", "error").then(function() {
				<?php $_SESSION["status"] = ""; ?>
			});
		} else if (status == "invalidPassword") {
			swal("Sorry", "Please enter Password", "error").then(function() {
				<?php $_SESSION["status"] = ""; ?>
			});
		}
	</script>

</body>

</html>