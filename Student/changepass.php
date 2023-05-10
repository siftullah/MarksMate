<?php
    include 'header.php';

    $conn = connectDatabase();

    $rollNo = $_SESSION['rollNo'];

    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $newpass2 = $_POST['newpass2'];

    $query = "SELECT * FROM student_login_info WHERE rollNo ='{$rollNo}' AND student_password='{$oldpass}'";
    $result = sqlsrv_query($conn, $query);  

    if($result === false)
    {
        die(print_r(sqlsrv_errors(), true));
    }
    else
    {
        if(sqlsrv_has_rows($result) == 1)
        {
            $query = "UPDATE student_login_info set student_password = '{$newpass}'  WHERE rollNo ='{$rollNo}'";
            $result = sqlsrv_query($conn, $query);
            
            if($result === false)
            {
                die(print_r(sqlsrv_errors(), true));
            }
            else
                header("Location: index.php");
        }
        else
        {
            header("Location: change-password.php");
        }
    }
?>