<?php

require_once __DIR__ . '/../config/Config.php';



$db = Config::getDB();

$id = $_GET["id"];
require_once __DIR__ . "\..\controller\UserC.php";
$isAdmin = isAdmin($id);
$Admin = isAdmin(1);
if ($isAdmin == $Admin && $id != 1) {
    updateU($id, false);
    $isAdmin2 = '0';
} else {
    updateU($id, true);
    $isAdmin2 = '1';
}

?>
<p><?php echo $isAdmin2; ?></p>