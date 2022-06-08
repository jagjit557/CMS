<?php
session_start();
if(isset($_SESSION['login_user'])){
	header("location: index.php");
}
require("db.php");

$msg="";
if(isset($_POST['btn_log'])){
	$email=$_POST['email'];
	$pwd=$_POST['pass'];
	$sql=mysqli_query($mysql, "SELECT * FROM users WHERE email='".$email."' AND password='".$pwd."' AND active=1");
	$cout=mysqli_num_rows($sql);
	if($cout>0){
		$row=mysqli_fetch_array($sql);
        $_SESSION['login_user'] = $row['id'];
        $_SESSION['login_user_type'] = $row['type'];
		header("location: index.php");
	}
	else
		$msg="Invalid/Inactive login, try again.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>	
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt text-center" data-tilt>
					<img src="images/logo.png" alt="IMG">
				</div>
				<form class="login100-form validate-form" method="POST">
				<?php if($msg!="") {?>
					<div class="alert alert-primary" role="alert">
  <?php echo $msg; ?>
</div>
<?php } ?>
					<span class="login100-form-title">
						User Login
					</span>

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
						<button class="login100-form-btn" name="btn_log">
							Login
						</button>
					</div>

					<div class="text-center pt-5">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right ml-2" aria-hidden="true"></i>
						</a>
					</div>
				</form>
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
