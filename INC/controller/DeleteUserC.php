<?php


require '../controller/UserC.php';



$id = $_GET["id"];

if (delete($id)) {
    header("Location: ../view/userManager.php");
}
