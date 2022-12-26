<?php
function showheader($user = null, $view = false)
{
  if ($view) {
    $path = "";
    $path4 = "/..";
    $path3 = "";
    $path2 = "/../..";
  } else {
    $path4 = "/INC";
    $path = "/INC/view";
    $path2 = "";
    $path3 = "/INC/view";
  }
  if (is_null($user)) {
    $var = "<div class='text-end'>
            <a href='.$path/loginPage.php' class='btn btn-outline-light me-2'>Login</a>
            <a href='.$path/signUpPage.php' class='btn btn-primary'>Sign-up</a>
            </div>";
    $isAdmin = "<li><a href='.$path3/contactUs.php' class='nav-link px-2 text-white'>Contact us</a></li>";
  } else {
    if ($user->isAdmin) {
      $isAdmin = "<li><a href='.$path3/userManager.php' class='nav-link px-2 text-white'>User Manager</a></li>";
    } else {
      $isAdmin = "<li><a href='.$path3/contactUs.php' class='nav-link px-2 text-white'>Contact us</a></li>";
    }
    $var = "<div class='text-end'>
            <a  class='btn btn-outline-light me-2'><i class='fa fa-user pe-2'></i>$user->usersUid</a>
            <a href='.$path4/controller/LogoutController.php' class='btn btn-danger'>Logout</a>
            </div>";
  }
  $result = "<header class='p-3 text-bg-dark'>
              <div class='container'>
                <div class='d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start'>
                  
                  <ul class='nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0'>
                    <li><a href='.$path2/index.php' class='nav-link px-2 text-white'>Home</a></li>
                    $isAdmin
                  </ul>

                  <form class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3' role='search'>
                    <input type='search' id='searchN' class='form-control form-control-dark text-bg-dark' placeholder='Search posts by name ...' aria-label='Search'>
                  </form>

                  $var
                </div>
              </div>

              </header>";


  return $result;
}
