<?php
require_once __DIR__.'/CategoryC.php';
$name=$_POST["namecat"];
editCategory($name);
header("location: ../../index.php");
?>