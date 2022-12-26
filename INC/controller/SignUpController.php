<?php
session_start();
if (!isset($_SESSION["status"])) {
    $_SESSION["status"] = "";
}

require_once __DIR__ . '/../config/Config.php';

require '../model/User.php';

$db = Config::getDB();

//Init data
$data = [
    'usersName' => trim($_POST['usersName']),
    'usersEmail' => trim($_POST['usersEmail']),
    'usersUid' => trim($_POST['usersUid']),
    'usersPwd' => trim($_POST['usersPwd']),
    'pwdRepeat' => trim($_POST['pwdRepeat'])
];

//Check for Inputs 
if (empty($data['usersName']) || empty($data['usersEmail']) || empty($data['usersUid']) || empty($data['usersPwd']) || empty($data['pwdRepeat'])) {
    $_SESSION["status"] = "emptyInput";

    header("location: ../view/signUpPage.php");
    exit();
} else {
    $_SESSION["status"] = "";
}
$newUser = User::register($db, $data);

// Check for user/email
if (is_null($newUser)) {
    $_SESSION["status"] = "UIDExist";
} else {
    if ($newUser) {
        $_SESSION["status"] = "success";
    } else {
        $_SESSION["status"] = "failed";
    }
}
header("location: ../view/signUpPage.php");
exit();
