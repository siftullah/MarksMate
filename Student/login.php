<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/loginstyle.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--Font Awesome Icons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title>MarksMate | Student</title>
</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header">
                <h1>Welcome to <span style="font-size: 62px; margin-right: -5px; color: black;">⩔</span><span
                        style="color: black;">ortexFlex</span></h1>
                <p>Please login to use the student platform</p>
            </div>
            <form class="login-form" action="signin.php" method="post" autocomplete="off">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="emailForm">Enter Roll No.</label>
                        <input name="rollno" type="text" id="emailForm">
                    </div>
                    <div class="form-item">
                        <label for="passwordForm">Enter Password</label>
                        <input name="password" type="password" id="passwordForm">
                    </div>
                    <div class="form-item">
                        <div class="checkbox">
                            <input type="checkbox" id="rememberMeCheckbox" checked>
                            <label class="checkboxLabel" for="rememberMeCheckbox">Remember me</label>
                        </div>
                    </div>
                    <button type="submit">Sign In</button>
                </div>
                <div class="login-form-footer">
                    <a href="forget.php">
                        <i class="bi bi-exclamation-triangle-fill"></i>&nbsp;&nbsp;Forgot Password ?
                    </a>
                </div>
            </form>
        </div>
        <div class="login-right">
            <img src="assets/images/login.jpg" alt="image">
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.js" integrity="sha512-BgV3bZfMmUklIZI+dP0SILdmQ0RBY2gxegFFyfgo4Ui56WhKF4Pny9LsV/l96jxDDA+2w47zAXA4IyHo2UT/Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>