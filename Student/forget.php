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
                <p>Please enter Roll No to receive the OTP</p>
            </div>
            <form class="login-form" autocomplete="off" action="forgetpassword.php" method="post">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="emailForm">Enter Roll No.</label>
                        <input type="text" id="emailForm" name="rollNo">
                    </div>
                    <button type="submit">Send OTP</button>
                </div>
                <div class="login-form-footer">
                    <a href="login.html">
                        <i class="bi bi-exclamation-triangle-fill"></i>&nbsp;&nbsp;Sign in Instead ?
                    </a>
                </div>
            </form>
        </div>
        <div class="login-right">
            <img src="assets/images/login.jpg" alt="image">
        </div>
    </div>

</body>

</html>