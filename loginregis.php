
<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Log In / Sign Up - pure css - #12</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'><link rel="stylesheet" href="./style.css">

</head>
<body style="background: linear-gradient(-45deg, #32CD32, #93DC5C, #B7E892, #DBF3C9, #C3F550);">
<!-- partial:index.partial.html -->

	<?php
	if (isset($_POST["login"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
		require_once "database.php";
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($user) {
			if (password_verify($password, $user["password"])) {
				session_start();
				$_SESSION["user"] = "yes";
				header("Location: dashboard.php");
				die();
			}else{
				echo "<div class='alert alert-danger'>Password does not match</div>";
			}
		}else{
			echo "<div class='alert alert-danger'>Email does not match</div>";
		}
	}
	?>

	<?php
            if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
            
            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
                array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
                array_push($errors,"Password must be at least 8 charactes long");
            }
            if ($password!==$passwordRepeat) {
                array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors,"Email already exists!");
            }
            if (count($errors)>0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                
                $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                }else{
                    die("Something went wrong");
                }
            }
            

            }
            ?>

	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<div class="choices">
							<h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
						</div>

			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">

								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-1 pb-3">Walang Cattulad</h4>
											<h6 class="mb-4">Volunteer Log-in</h6>

											<form action="loginregis.php" method="post">
												
												<div class="form-group mb-2 mb-2">
													<input type="email" name="email" class="form-style" placeholder="Your Email" autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>
													
												<div class="form-group mt-2">
													<input type="password" name="password" class="form-style" placeholder="Your Password"  autocomplete="off">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<div class="form-btn mt-3">
                    								<input type="submit" value="Login" name="login" class="btn btn-primary">
                								</div>

											</form>
				      					</div>
			      					</div>
			      				</div>
								
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-2 pb-1">Sign Up</h4>
											<h6 class="mb-3">Volunteer Log-in</h6>

											<form action="loginregis.php" method="post">

												<div class="form-group">
													<input type="text" name="fullname" class="form-style" placeholder="Your Full Name"  autocomplete="off">
													<i class="input-icon uil uil-user"></i>
												</div>	
												<div class="form-group mt-2">
													<input type="email" name="email" class="form-style" placeholder="Your Email"  autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>	
												<div class="form-group mt-2">
													<input type="password" name="password" class="form-style" placeholder="Your Password"  autocomplete="off">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<div class="form-group mt-2">
													<input type="password" name="repeat_password" class="form-style" placeholder="Repeat Password" autocomplete="off">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<div class="form-btn mt-3">
													<input type="submit" class="btn btn-primary" value="Register" name="submit">
												</div>

											</form>

				      					</div>
			      					</div>
			      				</div>
								
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
