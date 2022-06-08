<?php
require("session.php");
require("db.php");

$id="";
$msg="";
if(isset($_GET['id'])){
	$id=$_GET['id'];
}

if(isset($_POST['btn_add'])){
	$f_name=$_POST['fname'];
	$l_name=$_POST['lname'];
	$email=$_POST['email'];	
	$pass=$_POST['password'];	
	$type=$_POST['userType'];	
	if($_SESSION["login_user_type"]=="Admin") $active=1;
  else $active=0;

$sql_ins=mysqli_query($mysql,"INSERT INTO users 
						VALUES(
							NULL,
							'$f_name',
							'$l_name' ,
							'$email',
              '$pass',
              '$type',
              '$active'
							)
					");
          
if($sql_ins==true){
if($active==0){$insert_id=mysqli_insert_id($mysql);
$user_id=$SESSION['login_user'];
$notify=mysqli_query($mysql,"INSERT INTO notifications 
						VALUES(
							NULL,
							'NEW_USER',
							'$insert_id' ,
							'$user_id'
							)
					");
          }
  header("location:users.php");
}
else
	$msg="Insert Error:".mysqli_error($mysql);
}
if(isset($_POST['btn_upd'])){
	$f_name=$_POST['fname'];
	$l_name=$_POST['lname'];
	$email=$_POST['email'];
	
	$sql_update=mysqli_query($mysql,"UPDATE users SET 
								fname='$f_name',
								lname='$l_name',
								email='$email'
							WHERE
								id=$id
							");
	if($sql_update)
        $msg="Record Updated Successfully!";
	else
		$msg="Update Failed!";
	}

  
if(isset($_GET['id'])){
	$sql=mysqli_query($mysql,"SELECT * FROM users WHERE id=$id");
	$row=mysqli_fetch_array($sql);
  if(mysqli_num_rows($sql)==0) 
      header("location:users.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
<?php include("navbar.php") ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include("topbar.php") ?>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=isset($_GET['id'])?"Edit":"Add" ?> User</h1>
                    </div>
                        <?php if($msg!=""){ ?><div class="alert alert-primary" role="alert">
  <?=$msg ?>
</div><?php } ?>
                        <form method="POST"><?php if(!isset($_GET['id'])){ ?>
  <div class="form-group">
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="userType" id="inlineRadio1" value="Teacher" <?php if(isset($_GET['id']) && $row['type']=="Teacher") echo "checked"; ?> required>
  <label class="form-check-label" for="inlineRadio1">Teacher</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="userType" id="inlineRadio2" value="Student" <?php if(isset($_GET['id']) && $row['type']=="Student") echo "checked"; ?> required>
  <label class="form-check-label" for="inlineRadio2">Student</label>
</div>
  </div><?php } ?>
  <div class="form-group">
  <div class="form-row">
    <div class="col-6">
    <label>First Name</label>
      <input type="text" class="form-control" name="fname" placeholder="First Name" <?php if(isset($_GET['id'])) echo "value='".$row["fname"]."'"; ?> required>
    </div>
    <div class="col-6">
    <label>Last Name</label>
      <input type="text" class="form-control" name="lname" placeholder="Last Name" <?php if(isset($_GET['id'])) echo "value='".$row["lname"]."'"; ?> required>
    </div>
  </div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Email" <?php if(isset($_GET['id'])) echo "value='".$row["email"]."'"; ?> required>
  </div> <?php if(!isset($_GET['id'])){ ?>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div><?php } ?>
  <?php if(!isset($_GET['id'])){ ?><button type="submit" name="btn_add" class="btn btn-primary">Add User</button>
    <?php } else { ?><button type="submit" name="btn_upd" class="btn btn-primary">Update User</button><?php } ?>
</form>
                </div>
            </div>
<?php include("footer.php") ?>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>