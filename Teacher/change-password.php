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

    <!--Bootstrap Icons CDN-->
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
        <div class="text" style="font-weight: bolder;"><i class='bi bi-key'
                style="font-size: 30px; font-weight: 900;"></i>&nbsp;Change Password</div>

        <br>
        <br>

        <div class=" main-body">

            <div class="info-table fee-table-div password-table-div">

                <h3 class="info-table-header" style="font-size: 20px;"><i class="bi bi-file-lock"></i>&nbsp;Change
                    Password</h3>

                <div class="change-password-container">

                    <form action="" style="margin:auto; text-align: center;">
                        <div class="input-container">
                            <i class="bi bi-shield-lock-fill field-icon"></i>
                          <input class="input-field" type="password" placeholder="Old Password" name="usrnm">
                        </div>
                      
                        <div class="input-container">
                            <i class="bi bi-shield-lock-fill field-icon"></i>
                          <input class="input-field" type="password" placeholder="New Password" name="email">
                        </div>
                        
                        <div class="input-container">
                            <i class="bi bi-shield-lock-fill field-icon"></i>
                          <input class="input-field" type="password" placeholder="Repeat New Password" name="psw">
                        </div>
                      
                        <button type="submit" class="primary-btn-2" style="margin-top: 15px;">Submit</button>
                      </form>
                </div>

            </div>

        </div>

    </section>
    <!--Main Body End-->

    <!--Custom JS Scripts-->
    <script src="assets/js/script.js"></script>

</body>

</html>