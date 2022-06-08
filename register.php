<?php

session_start();
if(isset($_SESSION['login_user'])){
	header("location: index.php");
}
require("db.php");
$msg="";
if(isset($_POST['btn_add'])){
	$f_name=$_POST['fname'];
	$l_name=$_POST['lname'];
	$email=$_POST['email'];	
	$pass=$_POST['pass'];	
	$type=$_POST['userType'];

$sql_ins=mysqli_query($mysql,"INSERT INTO users 
						VALUES(
							NULL,
							'$f_name',
							'$l_name' ,
							'$email',
							'$pass',
							'$type', 
							'0'
							)
					");
if($sql_ins==true){
$insert_id=mysqli_insert_id($mysql);
$notify=mysqli_query($mysql,"INSERT INTO notifications 
						VALUES(
							NULL,
							'NEW_USER',
							'$insert_id' ,
							'$insert_id'
							)
					");
	$msg="Account Created. Awaiting activation.";
}
else
	$msg="Insert Error:".mysqli_error($mysql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SignUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt text-center" data-tilt>
					<img src="images/logo.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST"><?php if($msg!="") {?>
					<div class="alert alert-primary" role="alert">
  <?php echo $msg; ?>
</div>
<?php } ?>
					<span class="login100-form-title">
						User Registration
					</span>
					
					<div class="wrap-input100">
  <input type="radio" name="userType" value="Teacher" required> Teacher
						
  <input type="radio" name="userType" value="Student" required> Student
					</div>
					
					<div class="wrap-input100">
						<input class="input100" type="text" name="fname" placeholder="First Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="wrap-input100">
						<input class="input100" type="text" name="lname" placeholder="Last Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100"> 
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="btn_add">
							Register
						</button>
					</div>

					<div class="text-center pt-4">
						<a class="txt2" href="login.php">
							Already registered? Login
							<i class="fa fa-long-arrow-right ml-2" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.0.3/tilt.jquery.min.js"></script>
<script src="main.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
</body>
</html>
