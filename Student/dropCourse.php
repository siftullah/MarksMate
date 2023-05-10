<?php

include 'header.php';

$conn = connectDatabase();

$rollNo = $_SESSION['rollNo'];

$registrationid = $_POST['registrationid'];

$query = "DELETE from student_registered_courses where id = '{$registrationid}'";
$result = sqlsrv_query($conn, $query);

header("Location: course-registration.php");

?>