<?php
include 'header.php';

$conn = connectDatabase();

$rollNo = $_SESSION['rollNo'];

$query = "SELECT COUNT(*) as unread_notifications from student_notification where read_status = 0 and rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    if (sqlsrv_has_rows($result) == 1) {
        $notifications = sqlsrv_fetch_array($result);
    }
}

$query = "SELECT distinct semester_list.id, semester_session,semester_year from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join semester_list on semester_list.id = courseSection.semester_id
where rollNo ='{$rollNo}' order by semester_list.id desc";
$result2 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result2 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT distinct semester_list.id, semester_session,semester_year from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join semester_list on semester_list.id = courseSection.semester_id
where rollNo ='{$rollNo}' order by semester_list.id desc";
$result3 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result3 === false) {
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
                        <?php
                        if(!empty($notifications['unread_notifications']) && $notifications['unread_notifications'] != 0)
                        {
                            echo ('
                        <span class="notifi_count">');
                         echo $notifications['unread_notifications'];
                         echo(' </span>');
                        }
                        ?>
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
                        <img src="assets/images/<?php echo $rollNo;  ?>.jpg" alt="profileImg">
                        <div class="name_job">
                            <div class="name" id="student-name">Siftullah</div>
                            <div class="rollno" id="student-roll-no">21L-5263</div>
                        </div>
                    </div>
                    <a href="login.php" class="logout_link"><i class='bx bx-log-out' id="log_out" style="cursor: pointer;"></i></a>
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
                <div class="header-name" style="display: flex;/* align-content: stretch; */align-items: center; margin-top: 15px; padding: 0 8px;">
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
            <div class="text"><i class='bx bx-time-five'></i>&nbsp;Timetable</div>

            <div class="main-body">

                <!--Semester Select Drop Down-->
                <div class="select-boxes-div" style="display: flex; justify-content: space-evenly;">

                    <div class="custom-select">
                        <select name="semester" class="custom-select-box" id="semester" onchange="displaytimetable()">
                            <option value="0" selected disabled>Select Semester</option>
                            <?php
                            $temp = $result2;
                            while ($semesteritem = sqlsrv_fetch_array($temp, SQLSRV_FETCH_ASSOC)) {
                                echo '<option value="'.$semesteritem['id'].'">'.$semesteritem['semester_session'].' '.$semesteritem['semester_year'].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="custom-select">
                        <select name="day" id="day" onchange="displaytimetable()">
                            <option value="0" selected disabled>Select Day</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                    </div>

                </div>

                <br>
                <br>

<?php
                            while ($semesteritem = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)) {

                             $day = 1;
                             
                             while($day != 7)
                             {
                                $tempsemester = $semesteritem['id'];
                                $daysarr = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                              echo '  
                                <div style="display:none;" class="course-attendance-table info-table" name="timetablediv"'.' id = "'.$tempsemester.$day.'">

                                <h3 class="info-table-header"><i class="bx bx-calendar"></i> ';
                                
                                echo $daysarr[$day-1]; echo'</h3>
            
            
                                <div class="table-flex-container">
            
                                    <table class="attendance-table">
                                        <tr>
                                            <th>Course</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Venue</th>
                                        </tr>';

                                        
                                        $tempquery = "SELECT distinct Course.course_name,timetable.start_time, cast(DATEPART(hour, timetable.start_time) as varchar) + ':' + cast(DATEPART(minute, timetable.start_time) as varchar) as startTime,cast(DATEPART(hour, timetable.end_time) as varchar) + ':' + cast(DATEPART(minute, timetable.end_time) as varchar) as endTime ,timetable.end_time, Department.name_abbreviation, Classroom.room_no, Classroom.room_type from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code join timetable on courseSection.id = timetable.section_id join Classroom on Classroom.id = timetable.venue join Department on Department.id = Classroom.department
                                        where semester_id = '{$tempsemester}' and timetable.day_no = $day and rollNo ='{$rollNo}'
                                        order by timetable.start_time";
$tempresult= sqlsrv_query($conn, $tempquery);

#checks if the search was made
if ($tempresult === false) {
    die(print_r(sqlsrv_errors(), true));
}
while ($timetableitem = sqlsrv_fetch_array($tempresult, SQLSRV_FETCH_ASSOC))
{ 

                                       echo' <tr>
                                            <td>'.$timetableitem['course_name'].'</td>
                                            <td>'.$timetableitem['startTime'].'</td>
                                            <td>'.$timetableitem['endTime'].'</td>
                                            <td>';
                                            
                                            if($timetableitem['room_type'] == 2)
                                                echo 'Lab ';

                                            echo $timetableitem['name_abbreviation'].'-'.$timetableitem['room_no'].'</td>
                                        </tr>';
}
                                    echo'    
                                    </table>
                                </div>
            
                            </div>';                           $day = $day+1;} }
?>

            </div>

        </section>
        <!--Main Body End-->

    </div>

    <!--Custom JS Scripts-->
    <script src="assets/js/script.js"></script>
    <script>
        function displaytimetable()
        {
            
            var TextElements = document.getElementsByName("timetablediv");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }

            var currentdiv = document.getElementById('semester').value + document.getElementById('day').value;

            document.getElementById(currentdiv).style.display = "block";
        }
    </script>

</body>

</html>