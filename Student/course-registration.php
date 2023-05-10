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
            <div class="text"><i class='bx bx-file'></i>&nbsp;Course Registration</div>

            <div class="main-body">

                <!--Registration Info Table-->
                <div class="transcript-outer-table info-table registration-outer-table">

                    <h3 class="info-table-header"><i class="bi bi-exclamation-circle"></i>&nbsp;&nbsp;Registration Info
                    </h3>

                    <div class="table-flex-container transcript-inner-table-flex-container">

                        <div class="transcript-tables-row">

                            <div class="transcript-column registration-column">

                                <table class="attendance-table marks-table transcript-table registration-table">
                                    <tr>
                                        <th>Semester</th>
                                        <th>Max Credit Hours</th>
                                        <th>Registered Credit Hours</th>
                                        <th>Theory Registered Credit Hours</th>
                                        <th>Lab Registered Credit Hours</th>
                                        <th>Total Registered Courses</th>
                                    </tr>

                                    <?php
                                        $query = "SELECT * from student_registration_info join semester_list on student_registration_info.semester_id = semester_list.id where rollNo = '{$rollNo}' and semester_id in (select MAX(id) from semester_list)";
                                        $result = sqlsrv_query($conn, $query);
                                        
                                        $registration_summary = sqlsrv_fetch_array($result);
                                        $available_credit_hours = false;
                                        if(!is_null($registration_summary) && !is_null($registration_summary['credit_hrs_limit']) && !is_null($registration_summary['registered_credit_hours']))
                                        {
                                            if($registration_summary['credit_hrs_limit'] == $registration_summary['registered_credit_hours'])
                                            {
                                                $available_credit_hours = false;
                                            }
                                            else
                                            {
                                                $available_credit_hours = true;
                                            }
                                        }

                                        $query = "SELECT Count(*) as total_courses from student_registered_courses join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code where rollNo = '{$rollNo}' and semester_id in (select MAX(id) from semester_list)";
                                        $semester_courses_count = sqlsrv_query($conn, $query);
                                        $total_courses = sqlsrv_fetch_array($semester_courses_count);
                                    ?>

                                    <tr style="background-color: rgb(248, 246, 246);">
                                        <td class="text-center" style="max-width: 15px;"><?php if(!is_null($registration_summary) && !is_null($registration_summary['semester_session']) ** !is_null($registration_summary['semester_year'])) echo $registration_summary['semester_session'].' '.$registration_summary['semester_year']?> </td>
                                        <td class="text-center"><?php if(!is_null($registration_summary) && !is_null($registration_summary['credit_hrs_limit'])) echo $registration_summary['credit_hrs_limit']?></td>                                       
                                        <td class="text-center"><?php if(!is_null($registration_summary) && !is_null($registration_summary['registered_credit_hours']))  echo $registration_summary['registered_credit_hours']?></td>
                                        <td class="text-center"><?php if(!is_null($registration_summary) && !is_null($registration_summary['theory_credit_hours']))  echo $registration_summary['theory_credit_hours']?></td>
                                        <td class="text-center"><?php if(!is_null($registration_summary) && !is_null($registration_summary['lab_credit_hours']))  echo $registration_summary['lab_credit_hours']?></td>
                                        <td class="text-center"><?php if(!is_null($registration_summary) && !is_null($total_courses['total_courses']))  echo $total_courses['total_courses']?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

                <!--Registered Courses Table-->
                <div class="transcript-outer-table info-table registration-outer-table">

                    <h3 class="info-table-header"><i class="bi bi-check2-square"></i>&nbsp;&nbsp;Registered Courses</h3>

                    <div class="table-flex-container transcript-inner-table-flex-container">

                        <div class="transcript-tables-row">

                            <div class="transcript-column registration-column">

                                <table class="attendance-table marks-table transcript-table registration-table">
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th style="text-align: left;">Name</th>
                                        <th>Type</th>
                                        <th>Cr. Hours</th>
                                        <th>Pre. Req</th>
                                        <th>Relation</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                    <?php
                                        $query = "SELECT student_registered_courses.id,Course.course_code, Course.course_name, Course.course_type, Course.credit_hours, Course.pre_requisite, Course.relation, courseSection.section_name from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code where rollNo = '{$rollNo}' and Course.course_code not in (select courseSection.course_code from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id where rollNo = '{$rollNo}' and courseSection.semester_id not in (select MAX(id) from semester_list)) and courseSection.semester_id in (select MAX(id) from semester_list)";
                                        $result = sqlsrv_query($conn, $query);

                                        $counter = 1;
                                                
                                        while($course_item = sqlsrv_fetch_array($result))
                                        {
                                            echo'<tr>
                                                <td class="text-center" style="max-width: 15px;">'.$counter.'</td>
                                                <td class="text-center" style="width: 10%;">'.$course_item['course_code'].'</td>
                                                <td>'.$course_item['course_name'].'</td>
                                                <td class="text-center">'; if($course_item['course_type'] == 1) echo 'Theory'; else echo 'Lab';  echo'</td>
                                                <td class="text-center">'.$course_item['credit_hours'].'</td>
                                                <td class="text-center">'; if(!is_null($course_item['pre_requisite'])) echo $course_item['pre_requisite']; else echo 'None';  echo '</td>
                                                <td class="text-center">'; if($course_item['relation'] == 1) echo 'Core'; else echo 'Elective';  echo'</td>
                                                <td class="text-center">'.$course_item['section_name'].'</td>
                                                <td class="text-center">New</td>
                                                <td class="text-center"><form action="dropCourse.php" method="post"><input type="text" name="registrationid" style="display:none;" value="'.$course_item['id'].'"><input type="submit" value="Drop" class="primary-btn-1"></form></td>
                                            </tr>';
                                        }

                                        $query = "SELECT student_registered_courses.id, Course.course_code, Course.course_name, Course.course_type, Course.credit_hours, Course.pre_requisite, Course.relation, courseSection.section_name from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code where rollNo = '{$rollNo}' and Course.course_code in (select courseSection.course_code from transcript join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on courseSection.id = student_registered_courses.registered_section_id where rollNo = '{$rollNo}' and courseSection.semester_id not in (select MAX(id) from semester_list)) and courseSection.semester_id in (select MAX(id) from semester_list)";
                                        $result = sqlsrv_query($conn, $query);

                                        $counter = 1;
                                        
                                        while($course_item = sqlsrv_fetch_array($result))
                                        {
                                            echo'<tr>
                                                <td class="text-center" style="max-width: 15px;">'.$counter.'</td>
                                                <td class="text-center" style="width: 10%;">'.$course_item['course_code'].'</td>
                                                <td>'.$course_item['course_name'].'</td>
                                                <td class="text-center">'; if($course_item['course_type'] == 1) echo 'Theory'; else echo 'Lab';  echo'</td>
                                                <td class="text-center">'.$course_item['credit_hours'].'</td>
                                                <td class="text-center">'; if(!is_null($course_item['pre_requisite'])) echo $course_item['pre_requisite']; else echo 'None';  echo '</td>
                                                <td class="text-center">'; if($course_item['relation'] == 1) echo 'Core'; else echo 'Elective';  echo'</td>
                                                <td class="text-center">'.$course_item['section_name'].'</td>
                                                <td class="text-center">Repeat</td>
                                                <td class="text-center"><form action="dropCourse.php" method="post"><input type="text" name="registrationid" style="display:none;" value="'.$course_item['id'].'"><input type="submit" value="Drop" class="primary-btn-1"></form></td>
                                            </tr>';
                                        }
                                    ?>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

                <!--Available Courses Table-->
                <div class="transcript-outer-table info-table registration-outer-table">

                    <h3 class="info-table-header"><i class="bi bi-journal-check"></i>&nbsp;&nbsp;Available Courses</h3>

                    <div class="table-flex-container transcript-inner-table-flex-container">

                        <div class="transcript-tables-row">

                            <div class="transcript-column registration-column">

                                <table class="attendance-table marks-table transcript-table registration-table">
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th style="text-align: left;">Name</th>
                                        <th>Type</th>
                                        <th>Cr. Hours</th>
                                        <th>Pre. Req</th>
                                        <th>Relation</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php

                                    if($available_credit_hours)
                                    {

                                        $query = "SELECT distinct  Course.course_code, Course.course_name, Course.course_type, Course.credit_hours, Course.pre_requisite, Course.relation from courseSection join Course on courseSection.course_code = Course.course_code
                                        where degree_id in
                                        (
                                            select student_university_info.degree from student_university_info where rollNo = '{$rollNo}'
                                        )
                                        and batch_id in
                                        (
                                            select student_university_info.batch from student_university_info where rollNo = '{$rollNo}'
                                        )
                                        and available_seats > 0
                                        and semester_id in
                                        (
                                            select MAX(id) from semester_list
                                        )
                                        and Course.course_code not in
                                        (
                                            select distinct course_code from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id 
                                            where rollNo = '{$rollNo}' and semester_id not in 
                                            (
                                                select MAX(id) from semester_list
                                            )
                                        )
                                        and Course.course_code not in 
                                        (
                                            select distinct course_code from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id 
                                            where rollNo = '{$rollNo}' and semester_id in 
                                            (
                                                select MAX(id) from semester_list
                                            )
                                        )
                                        and Course.course_code not in
                                        (
                                            select distinct Course.pre_requisite from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on courseSection.course_code = Course.course_code 
                                            where rollNo = '{$rollNo}' and semester_id in 
                                            (
                                                select MAX(id) from semester_list
                                            )
                                            and Course.pre_requisite is not null
                                        )
                                        and (Course.pre_requisite is NULL or (Course.pre_requisite in
                                        (
                                            select courseSection.course_code from transcript join gradeSystem on transcript.grade_id = gradeSystem.id join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on student_registered_courses.registered_section_id = courseSection.id
                                            where semester_id not in
                                            (
                                                select MAX(id) from semester_list
                                            )
                                            and grade_letter != 'F' and grade_letter != 'W' and grade_letter != 'I' and rollNo = '{$rollNo}'
                                        )
                                        and Course.pre_requisite not in
                                        (
                                            select courseSection.course_code from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id
                                            where semester_id in
                                            (
                                                select MAX(id) from semester_list
                                            )
                                            and rollNo = '{$rollNo}'
                                        )
                                        )
                                        )";
                                        $result = sqlsrv_query($conn, $query);

                                        $counter = 1;
                                                
                                        while($course_item = sqlsrv_fetch_array($result))
                                        {
                                            $current_course_code = $course_item['course_code'];
                                            echo '<tr>
                                            <td class="text-center" style="max-width: 15px;">'.$counter.'</td>
                                            <td class="text-center" style="width: 10%;">'.$course_item['course_code'].'</td>
                                            <td>'.$course_item['course_name'].'</td>
                                            <td class="text-center">'; if($course_item['course_type'] == 1) echo 'Theory'; else echo 'Lab';  echo'</td>
                                            <td class="text-center">'.$course_item['credit_hours'].'</td>
                                            <td class="text-center">'; if(!is_null($course_item['pre_requisite'])) echo $course_item['pre_requisite']; else echo 'None';  echo '</td>
                                            <td class="text-center">'; if($course_item['relation'] == 1) echo 'Core'; else echo 'Elective';  echo'</td>
                                                <td class="text-center">                    <div class="custom-select section-custom-select">
                                                    <select name="'.$current_course_code.'" class="custom-select-box" id="section" onchange="changesection(this)">
                                                        <option selected disabled>Select Section</option>';

                                                       

                                                        $query = "SELECT courseSection.section_name from courseSection
                                                        where course_code = '{$current_course_code}' and degree_id in
                                                        (
                                                            select student_university_info.degree from student_university_info where rollNo = '21L-5263'
                                                        )
                                                        and batch_id in
                                                        (
                                                            select student_university_info.batch from student_university_info where rollNo = '21L-5263'
                                                        )
                                                        and available_seats > 0
                                                        and semester_id in
                                                        (
                                                            select MAX(id) from semester_list
                                                        )
                                                        order by section_name";
                                                        $result2 = sqlsrv_query($conn, $query);
                                                                
                                                        while($course__section_item = sqlsrv_fetch_array($result2))
                                                        {
                                                            echo'<option value="'.$course__section_item['section_name'].'">'.$course__section_item['section_name'].'</option>';
                                                        }

                                                    echo'</select>
                                                </div></td>
                                                <td class="text-center">New</td>
                                                <td class="text-center"><form action="registerCourse.php" method="post"><input type="text" name="course" value="'.$current_course_code.'" style="display:none;"> <input id="'.$current_course_code.'input" name="section" style="display:none;" type="text"><input type=submit class="primary-btn-1 hover-green" value="Register"></form></td>
                                            </tr>';
                                        }

                                        $query = "SELECT distinct  Course.course_code, Course.course_name, Course.course_type, Course.credit_hours, Course.pre_requisite, Course.relation from courseSection join Course on courseSection.course_code = Course.course_code
                                        where degree_id in
                                        (
                                            select student_university_info.degree from student_university_info where rollNo = '{$rollNo}'
                                        )
                                        and batch_id in
                                        (
                                            select student_university_info.batch from student_university_info where rollNo = '{$rollNo}'
                                        )
                                        and available_seats > 0
                                        and semester_id in
(
	select MAX(id) from semester_list
)
                                        and Course.course_code in
                                        (
                                            select distinct course_code from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id 
                                            where rollNo = '{$rollNo}' and semester_id not in 
                                            (
                                                select MAX(id) from semester_list
                                            )
                                        )
                                        and Course.course_code not in 
                                        (
                                            select distinct course_code from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id 
                                            where rollNo = '{$rollNo}' and semester_id in 
                                            (
                                                select MAX(id) from semester_list
                                            )
                                        )
                                        and Course.course_code not in
                                        (
                                            select distinct Course.pre_requisite from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on courseSection.course_code = Course.course_code 
                                            where rollNo = '{$rollNo}' and semester_id in 
                                            (
                                                select MAX(id) from semester_list
                                            )
                                            and Course.pre_requisite is not null
                                        )
                                        and (Course.pre_requisite is NULL or (Course.pre_requisite in
                                        (
                                            select courseSection.course_code from transcript join gradeSystem on transcript.grade_id = gradeSystem.id join student_registered_courses on transcript.student_registration_id = student_registered_courses.id join courseSection on student_registered_courses.registered_section_id = courseSection.id
                                            where semester_id not in
                                            (
                                                select MAX(id) from semester_list
                                            )
                                            and grade_letter != 'F' and grade_letter != 'W' and grade_letter != 'I' and rollNo = '{$rollNo}'
                                        )
                                        and Course.pre_requisite not in
                                        (
                                            select courseSection.course_code from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id
                                            where semester_id in
                                            (
                                                select MAX(id) from semester_list
                                            )
                                            and rollNo = '{$rollNo}'
                                        )
                                        )
                                        )";
                                        $result = sqlsrv_query($conn, $query);

                                        $counter = 1;
                                                
                                        while($course_item = sqlsrv_fetch_array($result))
                                        {
                                            $current_course_code = $course_item['course_code'];
                                            echo '<tr>
                                            <td class="text-center" style="max-width: 15px;">'.$counter.'</td>
                                            <td class="text-center" style="width: 10%;">'.$course_item['course_code'].'</td>
                                            <td>'.$course_item['course_name'].'</td>
                                            <td class="text-center">'; if($course_item['course_type'] == 1) echo 'Theory'; else echo 'Lab';  echo'</td>
                                            <td class="text-center">'.$course_item['credit_hours'].'</td>
                                            <td class="text-center">'; if(!is_null($course_item['pre_requisite'])) echo $course_item['pre_requisite']; else echo 'None';  echo '</td>
                                            <td class="text-center">'; if($course_item['relation'] == 1) echo 'Core'; else echo 'Elective';  echo'</td>
                                                <td class="text-center">                    <div class="custom-select section-custom-select">
                                                <select name="'.$current_course_code.'" class="custom-select-box" id="section" onchange="changesection(this)">
                                                        <option selected disabled>Select Section</option>';

                                                        $query = "SELECT courseSection.section_name from courseSection
                                                        where course_code = '{$current_course_code}' and degree_id in
                                                        (
                                                            select student_university_info.degree from student_university_info where rollNo = '21L-5263'
                                                        )
                                                        and batch_id in
                                                        (
                                                            select student_university_info.batch from student_university_info where rollNo = '21L-5263'
                                                        )
                                                        and available_seats > 0
                                                        and semester_id in
                                                        (
                                                            select MAX(id) from semester_list
                                                        )
                                                        order by section_name";
                                                        $result2 = sqlsrv_query($conn, $query);
                                                                
                                                        while($course__section_item = sqlsrv_fetch_array($result2))
                                                        {
                                                            echo'<option value="'.$course__section_item['section_name'].'">'.$course__section_item['section_name'].'</option>';
                                                        }

                                                    echo'</select>
                                                </div></td>
                                                <td class="text-center">Repeat</td>
                                                <td class="text-center"><form action="registerCourse.php" method="post"><input type="text" name="course" value="'.$current_course_code.'" style="display:none;"> <input id="'.$current_course_code.'input" name="section" style="display:none;" type="text"><input type=submit class="primary-btn-1 hover-green" value="Register"></form></td>
                                            </tr>';
                                        }
                                    }
                                    ?>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <!--Main Body End-->

        <div id="page-body">

            <!--Custom JS Scripts-->
            <script src="assets/js/script.js"></script>
            <script>
                function changesection(ele)
                {
                    var select_name = ele.name;

                    var input_id = select_name + "input";

                    document.getElementById(input_id).value = ele.value;
                }
            </script>
</body>

</html>