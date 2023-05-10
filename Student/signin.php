<?php
    include 'header.php';

    $conn = connectDatabase();

    $rollno = $_POST['rollno'];
    $password = $_POST['password'];

    $query = "SELECT * FROM student_login_info WHERE rollNo ='{$rollno}' AND student_password='{$password}'";
    $result = sqlsrv_query($conn, $query);  

    if($result === false)
    {
        header("Location: login.html");
    }
    else
    {
        if(sqlsrv_has_rows($result) == 1)
        {
            $row = sqlsrv_fetch_array($result);
            $_SESSION['rollNo'] = $row['rollNo'];
            header("Location: index.php");
        }
        else
        {
            header("Location: login.php");
        }
    }
?>