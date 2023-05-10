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

$query = "SELECT distinct semester_list.id, semester_session,semester_year from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join semester_list on semester_list.id = courseSection.semester_id
where rollNo ='{$rollNo}' order by semester_list.id desc";
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
            <div class="text" style="font-weight: bolder;"><i class='bx bx-edit'></i>&nbsp;Marks Sheet</div>

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
                        $query = "SELECT Course.course_code, Course.course_name from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code
                                where rollNo ='{$rollNo}' and courseSection.semester_id = '{$semester_item_id}' order by Course.course_code";
                        $result5 = sqlsrv_query($conn, $query);

                        #checks if the search was made
                        if ($result5 === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        $result6 = sqlsrv_query($conn, $query);

                        #checks if the search was made
                        if ($result6 === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        echo '<div onchange="displaycoursediv()" class="custom-select custom-select-box" name="courses-custom-select" style="display:none" id="'.$semester_item_id.'">
<select class="course" name="semester" id="'.$semester_item_id.'semestercourses">
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
                
                while ($semester_item = sqlsrv_fetch_array($result4,SQLSRV_FETCH_ASSOC)) 
                {
                    $semester_item_id = $semester_item['id'];
                    $query = "SELECT Course.course_code, Course.course_name, CourseSection.id from student_registered_courses join courseSection on student_registered_courses.registered_section_id = courseSection.id join Course on Course.course_code = courseSection.course_code where rollNo ='{$rollNo}' and courseSection.semester_id = '{$semester_item_id}' order by Course.course_code";
                    $courses_list = sqlsrv_query($conn, $query);

                    #checks if the search was made
                    if ($courses_list === false) 
                    {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    while ($course_item = sqlsrv_fetch_array($courses_list,SQLSRV_FETCH_ASSOC)) 
                    {
                        echo '<div name="marksdiv" class="course-attendance-table attendancediv info-table" style="display:none;" id="'.$semester_item_id.$course_item["course_code"] .'">
                                <h3 class="info-table-header"><span id="attendance-table-course-code">'.$course_item["course_code"] .'</span> - <span id="attendance-table-course-name">' .$course_item["course_name"].'</span></h3>';

                        $course_item_code = $course_item["course_code"];

                        $query = "select distinct MarksType.id, MarksType.marks_type_name from courseSectionMarks left join StudentMarks on courseSectionMarks.id = StudentMarks.total_marks_id join courseSection on courseSection.id = courseSectionMarks.section_id join MarksType on MarksType.id = courseSectionMarks.marks_type where semester_id = '{$semester_item_id}' and course_code = '{$course_item_code}' order by MarksType.id";
                        $course_marks_type_array = sqlsrv_query($conn, $query);
                        #checks if the search was made
                        if ($course_marks_type_array  === false) 
                        {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        else
                        {
                            if(sqlsrv_has_rows($course_marks_type_array) == 1)
                            {
                                echo'<div class="table-flex-container marks-table-flex-container">';

                                $total_total_weightage = 0;
                                $total_obtained_weightage = 0;

                                while($course_marks_type_item = sqlsrv_fetch_array($course_marks_type_array,SQLSRV_FETCH_ASSOC))
                                {
                                    $current_marks_type_id = $course_marks_type_item['id'];
                                    echo'<button class="collapsible">'.$course_marks_type_item['marks_type_name'].'</button>';

                                    $query = "SELECT courseSectionMarks.id, isNULL(weightage,0) as weightage, total_marks from courseSectionMarks join courseSection on courseSectionMarks.section_id = courseSection.id where semester_id = '{$semester_item_id}' and course_code = '{$course_item_code}' and courseSectionMarks.marks_type = '{$current_marks_type_id}' order by courseSectionMarks.id";
                                    $course_marks_type_total_marks = sqlsrv_query($conn, $query);

                                    $query = "select isNULL(AVG(obtained_marks),0) as average, isNULL(MIN(obtained_marks),0) as min_marks, isNULL(MAX(obtained_marks),0) as max_marks from courseSectionMarks left join StudentMarks on courseSectionMarks.id = StudentMarks.total_marks_id join courseSection on courseSection.id = courseSectionMarks.section_id join MarksType on MarksType.id = courseSectionMarks.marks_type join student_registered_courses on student_registered_courses.registered_section_id = courseSection.id where semester_id = '{$semester_item_id}' and course_code = '{$course_item_code}' and MarksType.id = '{$current_marks_type_id}' group by courseSectionMarks.id";
                                    $course_marks_type_students_statistics = sqlsrv_query($conn, $query);

                                    echo '
                                        <div class="content">
                                            <table class="attendance-table marks-table">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Weightage</th>
                                                    <th>Obtained Marks</th>
                                                    <th>Total Marks</th>
                                                    <th>Average</th>
                                                    <th>Min</th>
                                                    <th>Max</th>
                                                </tr>';

                                                $counter = 1;
                                                $total_weightage = 0;
                                                $obtained_Weightage = 0;

                                                while($course_marks_type_total_marks_item = sqlsrv_fetch_array($course_marks_type_total_marks,SQLSRV_FETCH_ASSOC))
                                                {
                                                    $course_marks_type_students_statistics_item = sqlsrv_fetch_array($course_marks_type_students_statistics,SQLSRV_FETCH_ASSOC);

                                                    $query = "SELECT obtained_marks from StudentMarks join student_registered_courses on StudentMarks.student_registration_id = student_registered_courses.id where rollNo = '{$rollNo}' and total_marks_id = '{$course_marks_type_total_marks_item['id']}'";
                                                    $course_marks_type_student_marks = sqlsrv_query($conn, $query);
                                                    $course_marks_type_student_marks_item = sqlsrv_fetch_array($course_marks_type_student_marks,SQLSRV_FETCH_ASSOC);

                                                    echo'<tr>
                                                        <td>'.$counter.'</td>
                                                        <td>'.$course_marks_type_total_marks_item['weightage'].'</td>
                                                        <td>';if(is_null($course_marks_type_student_marks_item) || is_null($course_marks_type_student_marks_item['obtained_marks'])) echo '-'; else echo $course_marks_type_student_marks_item['obtained_marks'];echo '</td>
                                                        <td>'.$course_marks_type_total_marks_item['total_marks'].'</td>
                                                        <td>'.$course_marks_type_students_statistics_item['average'].'</td>
                                                        <td>'.$course_marks_type_students_statistics_item['min_marks'].'</td>
                                                        <td>'.$course_marks_type_students_statistics_item['max_marks'].'</td>
                                                    </tr>';

                                                    $counter = $counter + 1;
                                                    $total_weightage = $total_weightage + $course_marks_type_total_marks_item['weightage'];
                                                    
                                                    if(!is_null($course_marks_type_student_marks_item) && !is_null($course_marks_type_student_marks_item['obtained_marks']))
                                                        $obtained_Weightage = $obtained_Weightage + ($course_marks_type_total_marks_item['weightage'] * ($course_marks_type_student_marks_item['obtained_marks'] / $course_marks_type_total_marks_item['total_marks']));
                                                }
                                                echo'
                                                <tr>
                                                    <td>Total</td>
                                                    <td>'.$total_weightage.'</td>
                                                    <td>'.round($obtained_Weightage,2).'</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>';
                                    
                                        $total_total_weightage = $total_total_weightage + $total_weightage;
                                        $total_obtained_weightage = $total_obtained_weightage + $obtained_Weightage;
                                }
        echo'
                                <button class="collapsible">Grand Total Marks</button>
                                <div class="content">
                                    <table class="attendance-table marks-table">
                                        <tr>
                                            <th>Total Marks</th>
                                            <th>Obtained Marks</th>
                                            <th>Class Average</th>
                                            <th>Minimum</th>
                                            <th>Maximum</th>
                                        </tr>
                                        <tr>
                                            <td>'.round($total_total_weightage,2).'</td>
                                            <td>'.round($total_obtained_weightage,2).'</td>';

                                            $course_item_id = $course_item['id'];
                                            $query = "SELECT isNULL(AVG(total_obtained_absolutes),0) as average, isNULL(MIN(total_obtained_absolutes),0) as min_absolutes, isNULL(MAX(total_obtained_absolutes),0) as max_absolutes from (select SUM(weightage * (obtained_marks*1.0/total_marks)) as total_obtained_absolutes from StudentMarks join courseSectionMarks on StudentMarks.total_marks_id = courseSectionMarks.id join student_registered_courses on student_registered_courses.id = StudentMarks.student_registration_id join courseSection on courseSection.id = student_registered_courses.registered_section_id where semester_id = '{$semester_item_id}' and course_code = '{$course_item_code}' and section_id = '{$course_item_id}' group by rollNo) as A";
                                            $course_marks_all_students_statistics = sqlsrv_query($conn, $query);
                                            $course_marks_all_students_statistics_item = sqlsrv_fetch_array($course_marks_all_students_statistics,SQLSRV_FETCH_ASSOC);
                                            echo'<td>'.round($course_marks_all_students_statistics_item['average'],2).'</td>
                                            <td>'.round($course_marks_all_students_statistics_item['min_absolutes'],2).'</td>
                                            <td>'.round($course_marks_all_students_statistics_item['max_absolutes'],2).'</td>
                                        </tr>
                                    </table>
                                </div>
        
                            </div>';
                               
                            }
                        }
                        echo'</div>';
                    }
                } 
            ?>

            </div>
            <br>
    <br>
        </section>
        <!--Main Body End-->

    </div>

    <!--Custom JS Scripts-->
    <script src="assets/js/script.js"></script>
    <script>

        //script for collapsible marks menu on marks-webpage

        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active-collapsible");
                var content = this.nextElementSibling;
                if (content.style.display == "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>

<script>
        function displaycourses()
        {
            
            var TextElements = document.getElementsByName("courses-custom-select");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }

            var TextElements = document.getElementsByName("marksdiv");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }

            var currentdiv = document.getElementById('semester').value;
            document.getElementById(currentdiv).style.display = "flex";

            var currentdiv = document.getElementById('semester').value + "semestercourses";
             document.getElementById(currentdiv).value = "0";

          
        }

        function displaycoursediv()
        {
            var TextElements = document.getElementsByName("marksdiv");

            for (var i = 0, max = TextElements.length; i < max; i++) {
                TextElements[i].style.display = "none";
            }
            var temp = document.getElementById('semester').value;
            var currentdiv = document.getElementById('semester').value + "semestercourses";
            currentdiv = document.getElementById(currentdiv).value;

            document.getElementById(document.getElementById('semester').value+currentdiv).style.display = "block";
        }

    </script>
</body>

</html>