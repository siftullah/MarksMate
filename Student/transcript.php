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
            <div class="text" style="font-weight: bolder;"><i class='bx bx-spreadsheet'
                    style="font-size: 30px;"></i>&nbsp;Transcript</div>

            <br>
            <br>

            <div class="transcript-page-main-body main-body">

                <div class="transcript-outer-table info-table">

                    <h3 class="info-table-header">Student Transcript</h3>

                    <div class="table-flex-container transcript-inner-table-flex-container">

                    <?php
                    $counter = 0;

                    $query = "select distinct semester_list.id,semester_list.semester_session,semester_year from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on student_registered_courses.registered_section_id = courseSection.id join semester_list on courseSection.semester_id = semester_list.id where rollNo = '{$rollNo}' order by semester_list.id";
                    $semesters_array = sqlsrv_query($conn, $query);

                    #checks if the search was made
                    if ($semesters_array === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    $CGPA = 0;
                    while($semester_item = sqlsrv_fetch_array($semesters_array, SQLSRV_FETCH_ASSOC))
                        {
                            $semester_item_id = $semester_item['id'];
                            if($counter %  2 == 0)
                                echo'<div class="transcript-tables-row">';

                            echo'<div class="transcript-column">

                                <div class="semester-details">
                                    <div>
                                        <h3>'.$semester_item['semester_session'].' '.$semester_item['semester_year'].'</h3>
                                    </div>';

                                    $query = "SELECT SGPA,total_credit_hours,total_passed_credit_hours from (select semester_id,SUM(credit_hours) as total_passed_credit_hours from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id where rollNo = '{$rollNo}' and semester_id = '{$semester_item_id}' and grade_letter != 'F' and grade_letter != 'W' and grade_letter != 'I' group by semester_id) as A join (select semester_id,SUM(points * credit_hours)/SUM(credit_hours) as SGPA,SUM(credit_hours) as total_credit_hours from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id where rollNo = '{$rollNo}' and semester_id = '{$semester_item_id}' group by semester_id) as B on A.semester_id = B.semester_id";
                                    $temp_semester_item_summary = sqlsrv_query($conn, $query);
                                    $semester_item_summary = sqlsrv_fetch_array($temp_semester_item_summary, SQLSRV_FETCH_ASSOC);
                                    $CGPA = $CGPA + $semester_item_summary['SGPA'];

                                    echo '<div class="gpa" style="display: flex;">
                                        <div>Crd. Att : '.$semester_item_summary['total_credit_hours'].' &nbsp;</div>
                                        <div>&nbsp;Crd. Ern : '.$semester_item_summary['total_passed_credit_hours'].'&nbsp;</div>
                                        <div>&nbsp;SGPA : '.$semester_item_summary['SGPA'].'&nbsp;</div>
                                        <div>&nbsp;CGPA : '.round($CGPA/($counter+1),2).'</div>
                                    </div>
                                </div>

                                <table class="attendance-table marks-table transcript-table">
                                    <tr>
                                        <th>Code</th>
                                        <th>Course Name</th>
                                        <th>Section</th>
                                        <th>Credit Hours</th>
                                        <th>Grade</th>
                                        <th>Points</th>
                                        <th>Type</th>
                                    </tr>';

                                    $query = "select Course.course_code, Course.course_name, courseSection.section_name, Course.credit_hours, gradeSystem.grade_letter, gradeSystem.points, Course.relation from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id where semester_id = '{$semester_item_id}' and rollNo = '{$rollNo}' order by Course.course_code";
                                    $courses_array = sqlsrv_query($conn, $query);

                                    #checks if the search was made
                                    if ($courses_array === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                

                                    while($course_item = sqlsrv_fetch_array($courses_array, SQLSRV_FETCH_ASSOC))
                                    {
                                        echo'<tr>
                                            <td>'.$course_item['course_code'].'</td>
                                            <td>'.$course_item['course_name'].'</td>
                                            <td class="text-center">'.$course_item['section_name'].'</td>
                                            <td class="text-center">'.$course_item['credit_hours'].'</td>
                                            <td class="text-center">'.$course_item['grade_letter'].'</td>
                                            <td class="text-center">'.$course_item['points'].'</td>
                                            <td>'; if($course_item['relation'] == 1) echo 'Core'; else echo 'Elective';echo '</td>
                                        </tr>';
                                    }
                                    echo'
                                </table>
                            </div>


';
                            if($counter %  2 != 0)
                                echo'</div>';

                            $counter = $counter + 1;
                        }
                    ?>

                    </div>

                </div>

            </div>

        </section>
        <!--Main Body End-->

    </div>

    <!--Custom JS Scripts-->
    <script src="assets/js/script.js"></script>

</body>

</html>