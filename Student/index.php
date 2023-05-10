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
        $notifications = sqlsrv_fetch_array($result);
}

$query = "SELECT * FROM student_personal_info WHERE rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    
        $personal = sqlsrv_fetch_array($result);
   
}

$query = "SELECT Campus.campus_name as Campus, Degree.name_abbreviation as Degree, Batch.batch_session as Batch_Session, Batch.batch_year as Batch_year, Department.department_name as Department, student_university_info.enrollment_status as Status from student_university_info join Batch on Batch.id = student_university_info.batch join Degree on Degree.id = student_university_info.degree join Campus on Campus.id = Batch.campus_id join Department on Department.id = Degree.department WHERE rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
        $university = sqlsrv_fetch_array($result);
}

$query = "SELECT * FROM student_guardian_info WHERE rollNo ='{$rollNo}'";
$result = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    
        $guardian = sqlsrv_fetch_array($result);
    
}

$query = "SELECT distinct semester_list.id, semester_list.semester_session, semester_list.semester_year  from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id join semester_list on semester_list.id = courseSection.semester_id where grade_letter != 'I' and grade_letter != 'W' and rollNo ='{$rollNo}' order by semester_list.id";
$result = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT SUM(gradeSystem.points * Course.credit_hours)/SUM(credit_hours) as gpa from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id where grade_letter != 'I' and grade_letter != 'W' and rollNo ='{$rollNo}' group by semester_id order by semester_id";
$result2 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result2 === false) {
    die(print_r(sqlsrv_errors(), true));
}
$query = "SELECT distinct semester_list.id, semester_list.semester_session, semester_list.semester_year  from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id join semester_list on semester_list.id = courseSection.semester_id where grade_letter != 'I' and grade_letter != 'W' and rollNo ='{$rollNo}' order by semester_list.id";
$result3 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result3 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT SUM(gradeSystem.points * Course.credit_hours)/SUM(credit_hours) as gpa from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code join gradeSystem on gradeSystem.id = transcript.grade_id where grade_letter != 'I' and grade_letter != 'W' and rollNo ='{$rollNo}' group by semester_id order by semester_id";
$result4 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result4 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT A.course_code, (totalPresents*1.0/totalClasses)*100 as att_percent from 
(
	select Course.course_code, COUNT(*) as totalClasses 
	from student_attendance join student_registered_courses on student_attendance.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code
	WHERE rollNo ='{$rollNo}' and semester_id in (select MAX(id) from semester_list)
	group by Course.course_code
) 
as A join 
(
	select Course.course_code, COUNT(*) as totalPresents 
	from student_attendance join student_registered_courses on student_attendance.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code
	where student_attendance.attendance_status = 'P' and rollNo ='{$rollNo}' and semester_id in (select MAX(id) from semester_list)
	group by Course.course_code
) 
as B on A.course_code = B.course_code
order by course_code";
$result5 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result5 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT A.course_code, (totalPresents*1.0/totalClasses)*100 as att_percent from 
(
	select Course.course_code, COUNT(*) as totalClasses 
	from student_attendance join student_registered_courses on student_attendance.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code
	WHERE rollNo ='{$rollNo}'
	group by Course.course_code
) 
as A join 
(
	select Course.course_code, COUNT(*) as totalPresents 
	from student_attendance join student_registered_courses on student_attendance.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code
	where student_attendance.attendance_status = 'P' and rollNo ='{$rollNo}' and semester_id in (select MAX(id) from semester_list)
	group by Course.course_code
) 
as B on A.course_code = B.course_code
order by course_code";
$result6 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result6 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT distinct Course.course_code, Course.course_name 
from student_attendance join student_registered_courses on student_attendance.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code
WHERE rollNo ='{$rollNo}' and semester_id in (select MAX(id) from semester_list)
order by Course.course_code";
$result7 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result7 === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT distinct Course.course_code, Course.course_name 
from student_attendance join student_registered_courses on student_attendance.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code
WHERE rollNo ='{$rollNo}' and semester_id in (select MAX(id) from semester_list)
order by Course.course_code";
$result8 = sqlsrv_query($conn, $query);

#checks if the search was made
if ($result8 === false) {
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
            <div class="text"><i class='bx bxs-home'></i>&nbsp;Home | Profile</div>

            <div class="main-body">

                <!--Personal Info Table-->
                <div class="info-table info-table-first" style="margin-top: 30px;">
                    <h3 class="info-table-header">&nbsp;&nbsp;<i class="bi bi-person-circle"></i>&nbsp; Personal
                        Information
                    </h3>

                    <div class="personal-info-table">
                        <div class="info-table-picture">
                            <img src="assets/images/<?php echo $personal['rollNo'];  ?>.jpg" style="height: 200px; width: 200px; border: 1px solid transparent; border-radius: 50%;">
                        </div>

                        <div class="info-table-inside" style="justify-content: space-evenly;">
                            <div class="info-table-inside-row">
                                <div class="info-table-inside-column">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Name : </b><span id="student-name" class="student-name"><?php if (is_null($personal) || is_null($personal['studentName'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['studentName']; ?></span></p>
                                </div>
                                <div class="info-table-inside-column">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; DOB : </b><span id="student-dob" class="student-dob"><?php if (is_null($personal) || is_null($personal['student_dob'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['student_dob'];  ?></span></p>
                                </div>
                            </div>
                            <div class="info-table-inside-row">
                                <div class="info-table-inside-column">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Gender : </b><span id="student-gender" class="student-gender"><?php  if (is_null($personal) || is_null($personal['gender'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['gender'];  ?></span></p>
                                </div>
                                <div class="info-table-inside-column">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; CNIC : </b><span id="student-cnic" class="student-cnic"><?php  if (is_null($personal) || is_null($personal['cnic'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['cnic'];  ?></span></p>
                                </div>
                            </div>
                            <div class="info-table-inside-row">
                                <div class="info-table-inside-column">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Mobile : </b><span id="student-mobile" class="student-mobile"><?php  if (is_null($personal) || is_null($personal['mobileNo'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['mobileNo'];  ?></span></p>
                                </div>
                                <div class="info-table-inside-column">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Email : </b><span id="student-email" class="student-email"><?php  if (is_null($personal) || is_null($personal['email'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['email'];  ?></span></p>
                                </div>
                            </div>
                            <div class="info-table-inside-row">
                                <div class="info-table-inside-column" style="width: 100%;">
                                    <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Address : </b><span id="student-address" class="student-address"><?php   if (is_null($personal) || is_null($personal['studentAddress'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['studentAddress']; ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--University Info Table-->
                <div class="info-table">
                    <h3 class="info-table-header">&nbsp;&nbsp;<i class="bi bi-building"></i>&nbsp; University
                        Information
                    </h3>
                    <div class="info-table-inside">
                        <div class="info-table-inside-row info-table-inside-first-row">
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Campus : </b><span id="student-campus" class="student-campus"><?php   if (is_null($university) || is_null($university['Campus'])) echo 'Not Provided';
                                                                                                                                                else echo $university['Campus']; ?></span></p>
                            </div>

                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Degree : </b><span id="student-degree" class="student-degree"><?php if (is_null($university) || is_null($university['Degree'])) echo 'Not Provided';
                                                                                                                                                else echo $university['Degree']; ?></span></p>
                            </div>

                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Batch : </b><span id="student-batch" class="student-batch"><?php if (is_null($university) || is_null($university['Batch_Session'])) echo 'Not Provided';
                                                                                                                                                else echo $university['Batch_Session'] . ' ' . $university['Batch_year']; ?></span></p>
                            </div>
                        </div>
                        <div class="info-table-inside-row">
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Department : </b><span id="student-section" class="student-section"><?php if (is_null($university) || is_null($university['Department'])) echo 'Not Provided';
                                                                                                                                                else echo $university['Department']; ?></span></p>
                            </div>
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Roll No : </b><span id="student-roll" class="student-roll"><?php if (is_null($personal) || is_null($personal['rollNo'])) echo 'Not Provided';
                                                                                                                                                else echo $personal['rollNo']; ?></span></p>
                            </div>
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Status : </b><span id="student-status" class="student-status"><?php if (is_null($university) || is_null($university['Status'])) 
                                                                                                                                                        echo 'Not Provided';
                                                                                                                                                else { if ($university['Status'] == 1) echo 'Current';
                                                                                                                                                    else echo 'Alumni';}  ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Guardian Info Table-->
                <div class="info-table">
                    <h3 class="info-table-header">&nbsp;&nbsp;<i class="bi bi-people"></i>&nbsp; Guardian Information
                    </h3>
                    <div class="info-table-inside">
                        <div class="info-table-inside-row info-table-inside-first-row">
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Name : </b><span id="guardian-name" class="guardian-name"><?php if (is_null($guardian) || is_null($guardian['guardianName'])) echo 'Not Provided';
                                                                                                                                                else echo $guardian['guardianName']; ?></span></p>
                            </div>

                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Gender : </b><span id="guardian-gender" class="guardian-gender"><?php if (is_null($guardian) || is_null($guardian['guardian_gender'])) echo 'Not Provided';
                                                                                                                                                else echo $guardian['guardian_gender']; ?></span></p>
                            </div>

                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Relation : </b><span id="guardian-relation" class="guardian-relation"><?php if (is_null($guardian) || is_null($guardian['guardian_relation'])) echo 'Not Provided';
                                                                                                                                                else echo $guardian['guardian_relation']; ?></span></p>
                            </div>
                        </div>
                        <div class="info-table-inside-row">
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; CNIC : </b><span id="guardian-cnic" class="guardian-cnic"><?php  if (is_null($guardian) || is_null($guardian['guardian_cnic'])) echo 'Not Provided';
                                                                                                                                                else  echo $guardian['guardian_cnic']; ?></span></p>
                            </div>
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Mobile : </b><span id="guardian-mobile" class="guardian-mobile"><?php if (is_null($guardian) || is_null($guardian['guardian_mobileNo'])) echo 'Not Provided';
                                                                                                                                                else echo $guardian['guardian_mobileNo']; ?></span></p>
                            </div>
                            <div class="info-table-inside-column">
                                <p><i class="bi bi-info-circle-fill"></i><b>&nbsp; Email : </b><span id="guardian-email" class="guardian-email"><?php  if (is_null($guardian) || is_null($guardian['guardian_email'])) echo 'Not Provided';
                                                                                                                                                else echo $guardian['guardian_email']; ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Attendance Chart-->
                <div class="info-table">
                    <h3 class="info-table-header">&nbsp;&nbsp;<i class='bx bx-objects-horizontal-left'></i>&nbsp; Course
                        Attendance</h3>
                    <div class="info-table-inside semester-gpa-table-desktop" style="padding: 20px;">
                        <canvas id="attendance-chart" width="80%" height="30px"></canvas>
                    </div>
                    <div class="info-table-inside semester-gpa-table-mobile" style="padding: 10px; display: none;">
                        <canvas id="attendance-chart-mobile" width="80%" height="120px"></canvas>
                    </div>
                </div>

                <!--Semester GPA Chart-->
                <div class="info-table" style="margin-bottom: 20px;">
                    <h3 class="info-table-header">&nbsp;&nbsp;<i class='bx bx-objects-vertical-bottom'></i>&nbsp;
                        Semester
                        GPA</h3>
                    <div class="info-table-inside semester-gpa-table-desktop" style="padding: 20px;">
                        <canvas id="bar-chart" width="80%" height="30px"></canvas>
                    </div>
                    <div class="info-table-inside semester-gpa-table-mobile" style="padding: 10px; display: none;">
                        <canvas id="bar-chart-mobile" width="80%" height="120px"></canvas>
                    </div>
                </div>

            </div>

        </section>
        <!--Main Body End-->

    </div>

    <!--Custom JS Scripts-->
    <script src="assets/js/script.js"></script>
    <script>
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    while ($semestersNames = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '"' . $semestersNames['semester_session'] . ' ' . $semestersNames['semester_year'] . '"' . ',';
                    }
                    ?>
                ],
                datasets: [{

                    label: "SGPA",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#3ede8d", "#8eea52", "#3abc9f", "#e67eb9", "#f45850"],
                    data: [
                        <?php
                        while ($semestergpa = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
                            echo '"' . $semestergpa['gpa'] . '"' . ',';
                        }

                        ?>
                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'GPA Earned Per Semester'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 4,
                        }
                    }]
                }
            },
        });
    </script>
    <script>
        new Chart(document.getElementById("bar-chart-mobile"), {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    while ($semestersNames = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)) {
                        echo '"' . $semestersNames['semester_session'] . ' ' . $semestersNames['semester_year'] . '"' . ',';
                    }
                    ?>
                ],
                datasets: [{
                    label: "SGPA",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#3ede8d", "#8eea52", "#3abc9f", "#e67eb9", "#f45850"],
                    data: [
                        <?php
                        while ($semestergpa = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC)) {
                            echo '"' . $semestergpa['gpa'] . '"' . ',';
                        }

                        ?>
                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'GPA Earned Per Semester'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 4,
                        }
                    }]
                }
            },
        });
    </script>
    <script>
        new Chart(document.getElementById("attendance-chart"), {
            type: 'horizontalBar',
            data: {
                labels: [
                    <?php
                    while ($coursesNames = sqlsrv_fetch_array($result7, SQLSRV_FETCH_ASSOC)) {
                        echo '"' . $coursesNames['course_name'] . '"' . ',';
                    }
                    ?>
                ],
                datasets: [{
                    label: "Course Lectures Attendance",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#a44850", "#841309", "#840139"],
                    data: [<?php
                            while ($coursesATT = sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC)) {
                                echo $coursesATT['att_percent'] . ',';
                            }
                            ?>]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Attendance of Current Courses'
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    }]
                }
            },
        });

        new Chart(document.getElementById("attendance-chart-mobile"), {
            type: 'horizontalBar',
            data: {
                labels: [<?php
                            while ($coursesNames = sqlsrv_fetch_array($result8, SQLSRV_FETCH_ASSOC)) {
                                echo '"' . $coursesNames['course_code'] . '"' . ',';
                            }
                            ?>],
                datasets: [{
                    label: "Course Lectures Attendance",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#a44850", "#841309", "#840139"],
                    data: [<?php
                            while ($coursesATT = sqlsrv_fetch_array($result6, SQLSRV_FETCH_ASSOC)) {
                                echo $coursesATT['att_percent'] . ',';
                            }
                            ?>]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Attendance of Current Courses'
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 100,
                        }
                    }]
                }
            },
        });
    </script>

</body>

</html>