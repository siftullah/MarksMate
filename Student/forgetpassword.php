<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'header.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$conn = connectDatabase();

$rollNo = $_POST['rollNo'];

$query = "SELECT * FROM student_login_info WHERE rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);  

if($result === false)
{
    
}
else
{
    if(sqlsrv_has_rows($result) == 1)
    {
        $row = sqlsrv_fetch_array($result);
        $_SESSION['rollNo'] = $row['rollNo'];
        
        $OTP = generateNumericOTP();
        $_SESSION['OTP'] = $OTP;

        $conn = connectDatabase();

        $rollNo = $_SESSION['rollNo'];
        
        $query = "SELECT * from student_personal_info where rollNo ='{$rollNo}'";
        $result = sqlsrv_query($conn, $query);
        $student = sqlsrv_fetch_array($result);
        
        
        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vortexflex01@gmail.com';
        $mail->Password = 'pkrckfaquptnjdkn';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('vortexflex01@gmail.com');
        
        $mail->addAddress($student['email']);
        
        $mail->isHTML(true);
        
        $mail->Subject = "OTP For Forget Password";
        
        $mail->Body = "Your OTP is " . $OTP .= ". It is valid for only 5 minutes.";     
        
        $mail->send();

        header("Location: forget2.php");
    }
    else
    {
        
    }
}
?>