<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'header.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$conn = connectDatabase();

$rollNo = $_SESSION['rollNo'];

if($_SESSION['OTP'] == $_POST['OTP'])
{
    header("Location: forget3.php");
}

?>