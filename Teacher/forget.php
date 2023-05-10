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

	<!--Bootstrap CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


	<!--Custom Stylesheet-->
	<link href="assets/css/loginstyle.css" rel="stylesheet">
	<!-- Template CSS files  // -->
</head>

<body>

	<main class="d-flex">
		<div class="container main-container">
			<div class="row login-page-row">
				<div class="col-lg-5 login-page-bgi d-none d-lg-flex">
					<div class="overlay">
					</div>
				</div>
				<div class="col-lg-7 login-page-mb-1 login-page-mb-md-1 login-page-aic" style="display: flex; justify-content: center; align-items: center;">
					<div class="card" style="width: 100%;">
						<div class="card-content" style="padding-top: 4% !important; padding-bottom: 8% !important;">
							<div class="header" style="margin-bottom: 4%;">
								<div class="header-logo" style="display: flex; justify-content: center;">
									<i class='bx bxl-vuejs' style="color: white; font-size: 92px;"></i>
									<div class="header-inside" style="display: flex; flex-direction: column; align-items: flex-end;">
										<span style="color: white; font-size: 36px;">MarksMate</span>
										<h3 style="color: blueviolet; font-size: 22px;">Welcome Back!</h3>
									</div>
								</div>
							</div>
							<form>
								<div class="form-group">
									<label for="inputEmail">Roll No.</label>
									<div class="input-group login-page-gp">
										<span class="login-page-gp-pp"><i class="bi bi-person-circle" style="font-size: 18px;"></i></span>
										<input id="inputEmail" class="form-control" type="text" tabindex="1"
											placeholder="E.g., 21L-5263" required style="font-size: 16px;">
									</div>
								</div>

								<button type="submit" class="btn btn-block btn-primary login-page-btn">Send Code</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Template JS files // -->
	<script src="js/script.js"></script>
	<!-- Template JS files // -->

</body>

</html>