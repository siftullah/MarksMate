<?php
include 'header.php';

$conn = connectDatabase();

$rollNo = $_SESSION['rollNo'];
$password = $_POST['password'];

$query = "UPDATE student_login_info set student_password = '{$password}' where rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);

if ($result === false)
    die(print_r(sqlsrv_errors(), true));
else

header("Location: index.php");

?>