<?php
require_once __DIR__.'/CategoryC.php';
$id=$_GET['id'];
deleteCategory($id);
header("location: ../../index.php");
?>