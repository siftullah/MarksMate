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
            <div class="text" style="font-weight: bolder;"><i class='bx bx-dollar'
                    style="font-size: 30px; font-weight: 900;"></i>&nbsp;Fee Details</div>

            <br>
            <br>

            <div class=" main-body">

                <div class="info-table fee-table-div" style="margin-top: 0;">

                    <h3 class="info-table-header">Pending Fees</h3>

                    <div class="fees-payment-history-container">

                        <table class="attendance-table marks-table">
                            <tr>
                                <th>#</th>
                                <th>Semester</th>
                                <th>Challan No</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Print Challan</th>
                            </tr>
                            <tbody>
                            <?php

                            $query ="select semester_session,semester_year,challanNo,amount,dueDate from feesChallan join semester_list on feesChallan.semester_id = semester_list.id where rollNo = '{$rollNo}' and fee_status = 0 order by dueDate";
                            $unpaid_fee_challan_array = sqlsrv_query($conn, $query);

                            #checks if the search was made
                            if ($unpaid_fee_challan_array === false) 
                            {
                                die(print_r(sqlsrv_errors(), true));
                            } 
                                $counter = 1;
                                while($unpaid_fee_challan_item = sqlsrv_fetch_array($unpaid_fee_challan_array))
                                {
                                    echo'<tr>
                                        <td>'.$counter.'</td>
                                        <td>'.$unpaid_fee_challan_item['semester_session'].' '.$unpaid_fee_challan_item['semester_year'].'</td>
                                        <td>'.$unpaid_fee_challan_item['challanNo'].'</td>
                                        <td>'.$unpaid_fee_challan_item['amount'].'</td>
                                        <td>'.$unpaid_fee_challan_item['dueDate'].'</td>
                                        <td><button class="primary-btn-1">Print</button></td>
                                    </tr>';

                                    $counter = $counter + 1;
                                }
                            ?>
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="info-table fee-table-div">

                    <h3 class="info-table-header">Payment History</h3>

                    <div class="fees-payment-history-container">

                        <table class="attendance-table marks-table">
                            <tr>
                                <th>#</th>
                                <th>Semester</th>
                                <th>Challan No</th>
                                <th>Paid Via</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Paid on</th>
                            </tr>
                            <tbody>
                            <?php

$query ="select semester_session,semester_year,challanNo,amount,dueDate,paidOn from feesChallan join semester_list on feesChallan.semester_id = semester_list.id where rollNo = '{$rollNo}' and fee_status = 1 order by dueDate";
$paid_fee_challan_array = sqlsrv_query($conn, $query);

#checks if the search was made
if ($paid_fee_challan_array === false) 
{
    die(print_r(sqlsrv_errors(), true));
} 
    $counter = 1;
    while($paid_fee_challan_item = sqlsrv_fetch_array($paid_fee_challan_array))
    {
        echo'<tr>
        <td>'.$counter.'</td>
        <td>'.$paid_fee_challan_item['semester_session'].' '.$paid_fee_challan_item['semester_year'].'</td>
        <td>'.$paid_fee_challan_item['challanNo'].'</td>
        <td>Bank Challan</td>
        <td>'.$paid_fee_challan_item['amount'].'</td>
        <td>'.$paid_fee_challan_item['dueDate'].'</td>
        <td>'.$paid_fee_challan_item['paidOn'].'</td>
    </tr>';

    $counter = $counter + 1;
}
?>
                            </tbody>
                        </table>

                    </div>

                </div>

                <br>

                <div class="course-marks-table info-table">

                    <h3 class="info-table-header">Semester-Wise Details</h3>


                    <div class="table-flex-container marks-table-flex-container">
<?php
$query = "SELECT semester_list.id, semester_session,semester_year,arrears,admission_fee,tuition_fee,security_fee,student_activites_fund,fast_nu_loan,scholarship,paid from semesterFeeDetails join semester_list on semester_list.id = semesterFeeDetails.semester_id where rollNo = '{$rollNo}'"; 
$semesters_fees_array = sqlsrv_query($conn, $query);

while($semester_fees_item = sqlsrv_fetch_array($semesters_fees_array))
                        {
                            $semester_item_id = $semester_fees_item['id'];
                            $query = "SELECT Course.course_code, Course.course_name, Course.credit_hours, Course.relation from student_registered_courses join courseSection on courseSection.id = student_registered_courses.registered_section_id join Course on Course.course_code = courseSection.course_code where rollNo = '{$rollNo}' and semester_id = '{$semester_item_id}'";
                            $semester_courses_array = sqlsrv_query($conn, $query);

                        echo '<button class="collapsible">'.$semester_fees_item['semester_session'].$semester_fees_item['semester_year'].'</button>';
                        
                        echo'<div class="content fee-details-content">
                            <div
                                class="table-flex-container fee-table-flex-container transcript-inner-table-flex-container">

                                <div class="transcript-tables-row">

                                    <div class="transcript-column">

                                        <div class="semester-details-table-heading">
                                            <div>
                                                <h1>Fee Information</h1>
                                            </div>
                                        </div>

                                        <table class="fee-detail-table">
                                            <tr>
                                                <th>Arrears</th>
                                                <td>'.$semester_fees_item['arrears'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Admission Fee</th>
                                                <td>'.$semester_fees_item['admission_fee'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Security Fee</th>
                                                <td>'.$semester_fees_item['security_fee'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Tuition Fee</th>
                                                <td>'.$semester_fees_item['tuition_fee'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Student Activities Fund</th>
                                                <td>'.$semester_fees_item['student_activites_fund'].'</td>
                                            </tr>
                                            <tr>
                                                <th>FAST NU Loan</th>
                                                <td>'.$semester_fees_item['fast_nu_loan'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Scholarship</th>
                                                <td>'.$semester_fees_item['scholarship'].'</td>
                                            </tr>
                                        </table>

                                        <br>
                                        <br>

                                        <table class="fee-detail-table">
                                            <tr>
                                                <th>Total</th>
                                                <td>'.$semester_fees_item['arrears']+$semester_fees_item['admission_fee']+$semester_fees_item['security_fee']+$semester_fees_item['student_activites_fund']+$semester_fees_item['fast_nu_loan']+$semester_fees_item['scholarship']+$semester_fees_item['tuition_fee'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Paid</th>
                                                <td>'.$semester_fees_item['paid'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Remaining</th>
                                                <td>'.($semester_fees_item['arrears']+$semester_fees_item['admission_fee']+$semester_fees_item['security_fee']+$semester_fees_item['student_activites_fund']+$semester_fees_item['fast_nu_loan']+$semester_fees_item['scholarship']+$semester_fees_item['tuition_fee'])-$semester_fees_item['paid'].'</td>
                                            </tr>
                                        </table>

                                    </div>


                                    <div class="transcript-column">

                                        <div class="semester-details-table-heading">
                                            <div>
                                                <h1>Registered Courses</h1>
                                            </div>
                                        </div>

                                        <table class="attendance-table marks-table transcript-table">
                                            <tr>
                                                <th>Code</th>
                                                <th>Course Name</th>
                                                <th>Credit Hours</th>
                                                <th>Type</th>
                                            </tr>';

                                            while($semester_course_item = sqlsrv_fetch_array($semester_courses_array))
                                            {
                                                echo'<tr>
                                                    <td>'.$semester_course_item['course_code'].'</td>
                                                    <td>'.$semester_course_item['course_name'].'</td>
                                                    <td class="text-center">'.$semester_course_item['credit_hours'].'</td>
                                                    <td class="text-center">';if($semester_course_item['relation'] == 1) echo 'Core'; else echo 'Relative'; echo'</td>
                                                </tr>';
                                            }
                                            echo'
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>';
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

    <script>

        //script for collapsible details menu in semester-wise-details-table

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

</body>

</html>