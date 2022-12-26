<?php
require_once __DIR__.'/CategoryC.php';
$id=$_GET['id'];
$name=$_POST[$id];
editCategory($name,$id);
header("location: ../../index.php");
?>