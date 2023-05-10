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

    <body>

        <!--Desktop Sidebar-->
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxl-vuejs icon'></i>
                <div class="logo_name">MarksMate</div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.html">
                        <i class='bx bx-user'></i>
                        <span class="links_name">Profile</span>
                    </a>
                    <span class="tooltip">Profile</span>
                </li>
                <li>
                    <a href="attendance.html">
                        <i class="bi bi-table"></i>
                        <span class="links_name">Attendance</span>
                    </a>
                    <span class="tooltip">Attendance</span>
                </li>
                <li>
                    <a href="marks.html">
                        <i class='bx bx-clipboard'></i>
                        <span class="links_name">Marks</span>
                    </a>
                    <span class="tooltip">Marks</span>
                </li>
               
                <li>
                    <a href="change-password.html">
                        <i class="bi bi-key"></i>
                        <span class="links_name">Change Password</span>
                    </a>
                    <span class="tooltip">Change Password</span>
                </li>
                <li class="profile">
                    <div class="profile-details">
                        <img src="assets/images/pp.jpg" alt="profileImg">
                        <div class="name_job">
                            <div class="name" id="student-name">Siftullah</div>
                            <div class="rollno" id="student-roll-no">21L-5263</div>
                        </div>
                    </div>
                    <i class='bx bx-log-out' id="log_out" style="cursor: pointer;"></i>
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
                        <a href="index.html" class="active"><i class='bx bx-user'></i>&nbsp;<span
                                class="links_name">Profile</span></a>
                    </li>
                    <li>
                        <a href="attendance.html"> <i class="bi bi-table"></i>&nbsp;
                            <span class="links_name">Attendance</span></a>
                    </li>
                    <li>
                        <a href="marks.html"> <i class='bx bx-clipboard'></i>&nbsp;
                            <span class="links_name">Marks</span></a>
                    </li>
                   
                    <li>
                        <a href="change-password.html"> <i class="bi bi-key"></i>&nbsp;
                            <span class="links_name">Change Password</span></a>
                    </li>
                    <li>
                        <a href="index.html"> <i class='bx bx-log-out bx-flip-vertical'></i>&nbsp;
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
            <div class="text" style="font-weight: bolder;"><i class='bx bx-edit'></i>&nbsp;Marks Record</div>

            <br>
            <br>

            <div class="main-body">

                <!--Semester Select Drop Down-->
                <div class="select-boxes-div" style="display: flex; justify-content: space-evenly;">

                    <div class="custom-select">
                        <select name="semester" class="custom-select-box" id="semester">
                        <option selected disabled>Select Semester</option>
                        <option value="spring-2023">Spring 2023</option>
                        <option value="fall-2022">Fall 2022</option>
                        <option value="spring-2022">Spring 2022</option>
                        <option value="fall-2021">Fall 2021</option>
                        </select>
                    </div>

                    <div class="custom-select">
                        <select name="semester" id="semester">
                        <option selected disabled>Select Course</option>
                        <option value="CS2005">CS2005</option>
                        <option value="CS2006">CS2006</option>
                        <option value="CS2009">CS2009</option>
                        <option value="MT4002">MT4002</option>
                        <option value="SS2005">SS2005</option>
                        <option value="CL2005">CL2005</option>
                        <option value="CL2006">CL2006</option>
                        </select>
                    </div>

                </div>
                <br><br>

                  <div class="select-boxes-div" style="display: flex; justify-content: space-evenly;">

                    <div class="custom-select">
                        <select name="semester" class="custom-select-box" id="semester">
                        <option selected disabled>Select Section</option>
                        <option value="spring-2023">Spring 2023</option>
                        <option value="fall-2022">Fall 2022</option>
                        <option value="spring-2022">Spring 2022</option>
                        <option value="fall-2021">Fall 2021</option>
                        </select>
                    </div>

                   
                        <div class="custom-select">
                        <select name="semester" class="custom-select-box" id="semester">
                        <option selected disabled>Select Marks Type</option>
                        <option value="spring-2023">Quiz</option>
                        <option value="fall-2022">Assignment</option>
                          <option value="spring-2023">Homework</option>
                        <option value="spring-2022">Mids</option>
                        <option value="fall-2021">Finals</option>
                        </select>
                    </div>
                  

                </div>
                <br>
                

                <div class="select-boxes-div" style="display: flex; justify-content: space-around;">

                    <a href="#" class="btn_edit">Edit Marks</a>
                  

                </div>


                <br>
                <br>

                <div class="course-attendance-table info-table">

                    <h3 class="info-table-header"><span id="attendance-table-course-code">CL2005</span> - <span id="attendance-table-course-name">Database Systems Lab</span></h3>   


                    <div class="table-flex-container">
                        
                        
                        
                        <table class="attendance-table">
                            <tr>
                                <th style="width:20%">#</th>
                                <th>Roll No.</th>
                                <th>Name</th>
                                <th>Marks Type</th>
                                <th>Marks</th>
                            </tr>
                           
                            <tr>
                                <td>1</td>
                                <td>21L-1876</td>
                               
                                <td>Zeeshan Hamid</td>
                                <td>Mid term</td> 
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                 <td>21L-1876</td>
                                  <td>Siftullah</td>
                              <td>Mid term</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                 <td>21L-1876</td>
                                  <td>Abdul Rehman</td>
                                <td>Mid term</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                 <td>21L-1876</td>
                                  <td>Rumaan Shehzad</td>
                                <td>Mid term</td>
                                <td>24</td>
                            </tr>
                        </table>
                    </div>
                
                </div>

            </div>

        </section>
        <!--Main Body End-->

        <!--Custom JS Scripts-->
        <script src="assets/js/script.js"></script>
    </body>

</html>