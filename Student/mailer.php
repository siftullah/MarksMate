<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'header.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$conn = connectDatabase();

$rollNo = $_SESSION['rollNo'];

$query = "SELECT * from student_personal_info join student_university_info on student_personal_info.rollNo = student_university_info.rollNo where student_personal_info.rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);
$student = sqlsrv_fetch_array($result);

$supportid = $_POST["subject-matter"];

$query = "SELECT * from supportEmails where id = '{$supportid}'";
$result = sqlsrv_query($conn, $query);
$subject = sqlsrv_fetch_array($result);

if($subject['id'] == 5)
{
    $coursesection = $_POST['support-course'];
    $query = "SELECT * from Course join courseSection on Course.course_code = courseSection.course_code join teacher_login_info on courseSection.teacher_id = teacher_login_info.teacher_id where courseSection.id = '{$coursesection}'";
    $result = sqlsrv_query($conn, $query);
    if ($result === false)
        die(print_r(sqlsrv_errors(), true));
    $teacher = sqlsrv_fetch_array($result);
}

if(isset($_POST["send"]))
{
    if (!empty($_FILES['supportfile']['name']))
    {
    $path = 'upload/'.$_FILES["supportfile"]["name"];
    move_uploaded_file($_FILES["supportfile"]["tmp_name"],$path);
    }

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vortexflex01@gmail.com';
    $mail->Password = 'pkrckfaquptnjdkn';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('vortexflex01@gmail.com');

    if($subject['id'] == 5)
        $mail->addAddress($teacher['teacher_email']);
    else
         $mail->addAddress($subject['email']);
    $mail->isHTML(true);
    
    $mail->Subject = $_POST["topic"];
    
    $mail->Body = "Student Name = " . $student['studentName'] .= "<br> Roll No = " . $student['rollNo'] .= "<br> Student Email = " . $student['email'] .= "<br>";
    
    if($subject['id'] == 5)
    {
        $mail->Body = $mail->Body .= "Course = " . $teacher['course_name'] .= "<br> Section = " . $teacher['section_name'] .= "<br>";
    }
    
    $mail->Body = $mail->Body .= "<br>" .  $_POST["content"];

    if (!empty($_FILES['supportfile']['name']))
    {
    $mail->addAttachment($path);
    }

    $mail->send();

    header("Location: support.php");
}

?>