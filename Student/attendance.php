<?php
include "header.php";

$conn = connectDatabase();

$rollNo = $_SESSION["rollNo"];

$query = "EXECUTE getNotificationsCount @rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    if (sqlsrv_has_rows($result) == 1) {
        $notifications = sqlsrv_fetch_array($result);
    }
}

$query = "EXECUTE getRegisteredSemesters @rollNo = '{$rollNo}'";
$result2 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result2 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "EXECUTE getRegisteredSemesters @rollNo = '{$rollNo}'";
$result3 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result3 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "EXECUTE getRegisteredSemesters @rollNo = '{$rollNo}'";
$result4 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result4 === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MarksMate</title>

    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--Font Awesome Icons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!--Charts JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>

    <!--Custom Stylesheet-->
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<body onload="disablepreloader()">

    <div id="preloader">
        <img src="assets/images/preloader.gif">
    </div>

    <div id="page-body">

        <!--Desktop Sidebar-->
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxl-vuejs icon'></i>
                <div class="logo_name">MarksMate</div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.php">
                        <i class='bx bx-user'></i>
                        <span class="links_name">Profile</span>
                    </a>
                    <span class="tooltip">Profile</span>
                </li>
                <li>
                    <a href="notifications.php">
                        <i class='bx bx-bell'></i>
                        <?php if (
                            !empty($notifications["unread_notifications"]) &&
                            $notifications["unread_notifications"] != 0
                        ) {
                            echo '
                        <span class="notifi_count">';
                            echo $notifications["unread_notifications"];
                            echo " </span>";
                        } ?>
                        <span class="links_name notifi_link">Notifications</span>
                    </a>
                    <span class="tooltip">Notifications</span>
                </li>
                <li>
                    <a href="course-registration.php">
                        <i class='bx bx-file'></i>
                        <span class="links_name">Course Registration</span>
                    </a>
                    <span class="tooltip">Course Registration</span>
                </li>
                <li>
                    <a href="timetable.php">
                        <i class='bx bx-time-five'></i>
                        <span class="links_name">Timetable</span>
                    </a>
                    <span class="tooltip">Timetable</span>
                </li>
                <li>
                    <a href="attendance.php">
                        <i class="bi bi-table"></i>
                        <span class="links_name">Attendance</span>
                    </a>
                    <span class="tooltip">Attendance</span>
                </li>
                <li>
                    <a href="marks.php">
                        <i class='bx bx-clipboard'></i>
                        <span class="links_name">Marks</span>
                    </a>
                    <span class="tooltip">Marks</span>
                </li>
                <li>
                    <a href="transcript.php">
                        <i class='bx bx-spreadsheet'></i>
                        <span class="links_name">Transcript</span>
                    </a>
                    <span class="tooltip">Transcript</span>
                </li>
                <li>
                    <a href="fees.php">
                        <i class='bx bx-dollar'></i>
                        <span class="links_name">Fee Details</span>
                    </a>
                    <span class="tooltip">Fee Details</span>
                </li>
                <li>
                    <a href="support.php">
                        <i class='bx bx-envelope'></i>
                        <span class="links_name">Contact Support</span>
                    </a>
                    <span class="tooltip">Contact Support</span>
                </li>
                <li>
                    <a href="change-password.php">
                        <i class="bi bi-key"></i>
                        <span class="links_name">Change Password</span>
                    </a>
                    <span class="tooltip">Change Password</span>
                </li>
                <li class="profile">
                    <div class="profile-details">
                        <img src="assets/images/<?php echo $rollNo; ?>.jpg" alt="profileImg">
                        <div class="name_job">
                            <div class="name" id="student-name">Siftullah</div>
                            <div class="rollno" id="student-roll-no">21L-5263</div>
                        </div>
                    </div>
                    <a href="login.php" class="logout_link"><i class='bx bx-log-out' id="log_out"
                            style="cursor: pointer;"></i></a>
                </li>
            </ul>
        </div>
        <!--Desktop Sidebar End-->

        <!--Mobile Sidebar-->
        <header class="mobile-sidebar mobile-header" style="display: none;">
            <div class="header-name" style="display: flex;/* align-content: stretch; */align-items: center;">
                <i class="bx bxl-vuejs icon" style="font-size: 54px;"></i>
                <div class="logo_name" style="font-size: 28px;font-weight: bolder;">MarksMate</div>
            </div>
            <input type="checkbox" id="nav_check" hidden>
            <nav class="mobile-nav">
                <div class="header-name"
                    style="display: flex;/* align-content: stretch; */align-items: center; margin-top: 15px; padding: 0 8px;">
                    <i class="bx bxl-vuejs icon" style="font-size: 54px;"></i>
                    <div class="logo_name" style="font-size: 28px;font-weight: bolder;">MarksMate</div>
                </div>
                <ul class="mobile-navbar-list">
                    <li>
                        <a href="index.php"><i class='bx bx-user'></i>&nbsp;<span class="links_name">Profile</span></a>
                    </li>
                    <li>
                        <a href="notifications.php"> <i class='bx bx-bell'></i>&nbsp;
                            <span class="links_name">Notifications</span></a>
                    </li>
                    <li>
                        <a href="course-registration.php"> <i class='bx bx-file'></i>&nbsp;
                            <span class="links_name">Course Registration</span></a>
                    </li>
                    <li>
                        <a href="timetable.php"> <i class='bx bx-time-five'></i>&nbsp;
                            <span class="links_name">Timetable</span></a>
                    </li>
                    <li>
                        <a href="attendance.php"> <i class="bi bi-table"></i>&nbsp;
                            <span class="links_name">Attendance</span></a>
                    </li>
                    <li>
                        <a href="marks.php"> <i class='bx bx-clipboard'></i>&nbsp;
                            <span class="links_name">Marks</span></a>
                    </li>
                    <li>
                        <a href="transcript.php"> <i class='bx bx-spreadsheet'></i>&nbsp;
                            <span class="links_name">Transcript</span></a>
                    </li>
                    <li>
                        <a href="fees.php"> <i class='bx bx-dollar'></i>&nbsp;
                            <span class="links_name">Fee Details</span></a>
                    </li>
                    <li>
                        <a href="support.php"> <i class='bx bx-envelope'></i>&nbsp;
                            <span class="links_name">Contact Support</span></a>
                    </li>
                    <li>
                        <a href="change-password.php"> <i class="bi bi-key"></i>&nbsp;
                            <span class="links_name">Change Password</span></a>
                    </li>
                    <li>
                        <a href="index.php"> <i class='bx bx-log-out bx-flip-vertical'></i>&nbsp;
                            <span class="links_name">Sign Out</span></a>
                    </li>
                </ul>
            </nav>
            <label for="nav_check" class="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </label>
        </header>
        <!--Mobile Sidebar End-->


        <!--Main Body-->
        <section class="home-section">

            <!--Webpage Heading-->
            <div class="text" style="font-weight: bolder;"><i class='bx bx-edit'></i>&nbsp;Attendance Record</div>

            <br>
            <br>

            <div class="main-body">

                <!--Semester Select Drop Down-->
                <div class="select-boxes-div" style="display: flex; justify-content: space-evenly;">

                    <div class="custom-select">
                        <select name="semester" class="custom-select-box" id="semester" onchange="displaycourses()">
                            <option value="0" selected disabled>Select Semester</option>
                            <?php
                            $temp = $result2;
                            while (
                                $semester_item = sqlsrv_fetch_array(
                                    $temp,
                                    SQLSRV_FETCH_ASSOC
                                )
                            ) {
                                echo '<option value="' .
                                    $semester_item["id"] .
                                    '">' .
                                    $semester_item["semester_session"] .
                                    " " .
                                    $semester_item["semester_year"] .
                                    "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <?php while (
                        $semester_item = sqlsrv_fetch_array(
                            $result3,
                            SQLSRV_FETCH_ASSOC
                        )
                    ) {
                        $semester_item_id = $semester_item["id"];
                        $query = "EXECUTE getRegisteredCourses @rollNo ='{$rollNo}' , @semester_id = '{$semester_item_id}'";
                        $result5 = sqlsrv_query($conn, $query);

                        if ($result5 === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        $result6 = sqlsrv_query($conn, $query);

                        if ($result6 === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        echo '<div onchange="displaycoursediv()" class="custom-select custom-select-box" name="courses-custom-select" style="display:none" id="' . $semester_item_id . '">
<select class="course" name="semester" id="' . $semester_item_id . 'semestercourses">
    <option value="0" selected disabled>Select Course</option>
    ';

                        while (
                            $course_item = sqlsrv_fetch_array(
                                $result5,
                                SQLSRV_FETCH_ASSOC
                            )
                        ) {
                            echo '
                            <option value="' .
                                $course_item["course_code"] .
                                '">' .
                                $course_item["course_name"] .
                                "</option>";
                        }
                        echo ' </select>
                    </div>';
                    } ?>
                </div>

                <br>
                <br>


                <?php

                while ($semester_item = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC)) {
                    $semester_item_id = $semester_item['id'];
                    $query = "EXECUTE getRegisteredCourses @rollNo ='{$rollNo}' , @semester_id = '{$semester_item_id}'";
                    $courses_list = sqlsrv_query($conn, $query);

                    #checks if the search was made
                    if ($courses_list === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    while ($course_item = sqlsrv_fetch_array($courses_list, SQLSRV_FETCH_ASSOC)) {
                        echo '<div name="attendancediv" class="course-attendance-table attendancediv info-table" style="display:none;" id="' . $semester_item_id . $course_item["course_code"] . '">
                                    <h3 class="info-table-header"><span id="attendance-table-course-code">' . $course_item["course_code"] . '</span> - <span id="attendance-table-course-name">' . $course_item["course_name"] . '</span></h3>';

                        $course_item_code = $course_item["course_code"];

                        $query = "EXECUTE getCourseAttendance @rollNo = '{$rollNo}', @semester_id = '{$semester_item_id}', @course_code = '{$course_item_code}'";
                        $course_attendance_array = sqlsrv_query($conn, $query);
                        #checks if the search was made
                        if ($course_attendance_array === false) {
                            die(print_r(sqlsrv_errors(), true));
                        } else {
                            if (sqlsrv_has_rows($course_attendance_array) == 1) {
                                $query = "EXECUTE getCourseAttendancePercent @rollNo = '{$rollNo}' , @semester_id = '{$semester_item_id}' , @course_code = '{$course_item_code}'";
                                $attendance_percent = sqlsrv_query($conn, $query);

                                #checks if the search was made
                                if ($attendance_percent === false) {
                                    die(print_r(sqlsrv_errors(), true));
                                }

                                $course_item_attendance_percent = sqlsrv_fetch_array($attendance_percent, SQLSRV_FETCH_ASSOC);

                                echo '<div class="table-flex-container">';

                                echo '<div class="progress-container">
                                                <h4>Attendance %</h4>
                                                <div class="progress-bar">
                                                    <span style="width: ' . round($course_item_attendance_percent["attendance_percent"], 0) . '%;">' . round($course_item_attendance_percent["attendance_percent"], 2) . '%</span>
                                                </div>
                                            </div>

                                            <table class="attendance-table">
                                                <tr>
                                                    <th style="width:20%">#</th>
                                                    <th>Date</th>
                                                    <th>Attendance</th>
                                                </tr>';

                                $counter = 1;
                                while ($course_item_attendance_item = sqlsrv_fetch_array($course_attendance_array, SQLSRV_FETCH_ASSOC)) {
                                    echo '<tr>
                                                        <td>' . $counter . '</td>
                                                        <td>' . $course_item_attendance_item["attendance_date"] . '</td>
                                                        <td>' . $course_item_attendance_item["attendance_status"] . '</td>
                                                    </tr>';
                                    $counter = $counter + 1;
                                }

                                echo '</table>
                                    </div>';
                            }
                        }
                        echo '</div>';
                    }
                }
                ?>


            </div>

        </section>
        <!--Main Body End-->

    </div>

    <!--Custom JS Scripts-->
    <script src="assets/js/script.js"></script>
    <script>
        function displaycourses() {

            var TextElements = document.getElementsByName("courses-custom-select");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }

            var TextElements = document.getElementsByName("attendancediv");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }

            var currentdiv = document.getElementById('semester').value;
            document.getElementById(currentdiv).style.display = "flex";

            var currentdiv = document.getElementById('semester').value + "semestercourses";
            document.getElementById(currentdiv).value = "0";


        }

        function displaycoursediv() {
            var TextElements = document.getElementsByName("attendancediv");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }
            var temp = document.getElementById('semester').value;
            var currentdiv = document.getElementById('semester').value + "semestercourses";
            currentdiv = document.getElementById(currentdiv).value;

            document.getElementById(document.getElementById('semester').value + currentdiv).style.display = "block";
        }

    </script>
</body>

</html>