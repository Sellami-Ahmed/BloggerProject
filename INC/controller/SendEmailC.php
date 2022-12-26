<?php
session_start();
if (!isset($_SESSION["status"])) {
    $_SESSION["status"] = "";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = "reebayprod@gmail.com";
$mail->Password = "lysyihwlzsccmvog";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->setFrom("reebayprod@gmail.com");
$mail->addAddress("ahmedsellami380@gmail.com");

$mail->isHTML(true);
$from = "</br><p><b>Name:</b> " . $_POST["name"] . "</p><p><b>Email:</b> " . $_POST["email"] . "</p>";
$mail->Subject = $_POST["subject"];
$mail->Body = "<p>" . $_POST["message"] . "</p></br></br></br><p>This message is from:</p>" . $from;

$mail->send();
$_SESSION["status"] = "mailSent";
header("location: ../view/contactUs.php");
