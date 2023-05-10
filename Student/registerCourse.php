<?php

include 'header.php';

$conn = connectDatabase();

$rollNo = $_SESSION['rollNo'];

$course = $_POST['course'];
$section = $_POST['section'];

$query = "SELECT * from student_university_info where rollNo = '{$rollNo}'";
$result = sqlsrv_query($conn, $query);
$student = sqlsrv_fetch_array($result);
$batch = $student['batch'];
$degree = $student['degree'];

$query = "SELECT id from courseSection where course_code = '{$course}' and section_name = '{$section}' and batch_id = '{$batch}' and degree_id = '{$degree}' ";
$coursesection = sqlsrv_query($conn, $query);
$coursesectionitem = sqlsrv_fetch_array($coursesection);

$coursesection_id = $coursesectionitem['id'];

$query = "INSERT into student_registered_courses(rollNo,registered_section_id) values('{$rollNo}','{$coursesection_id}')";
$result = sqlsrv_query($conn, $query);

header("Location: course-registration.php");

?>