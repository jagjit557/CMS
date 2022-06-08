<?php
require("session.php");
require("db.php");

if(isset($_GET['id']) && isset($_GET['active']))
{
	$id=$_GET['id'];
  $active=$_GET['active'];
	$del_sql=mysqli_query($mysql, "UPDATE users SET active=$active WHERE id=$id");
	if(!$del_sql)
		$msg="Error :".mysqli_error($mysql);
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
                        <h1 class="h3 mb-0 text-gray-800">All Users</h1>
                    </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="Students" aria-selected="true">Students</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers" role="tab" aria-controls="teachers" aria-selected="false">Teachers</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="students-tab">
                        <div class="table-responsive">
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php
    $sql_sel=mysqli_query($mysql,"SELECT * FROM users WHERE type='Student'");
    if(mysqli_num_rows($sql_sel)>0) {
    $i=0;
    while($row=mysqli_fetch_array($sql_sel)){
    $i++;
    ?>
    <tr>
      <th scope="row"><?php echo $row['fname']." ".$row['lname'];?></th>
      <td><?php echo $row['email'] ?></td>
      <td><?php if($row['active']==1) { ?><p class="text-primary">Active</p>
        <?php } else { ?><p class="text-secondary">Inactive</p><?php } ?></td>
      <td><a class="btn btn-primary" href="user.php?id=<?=$row['id']?>" role="button">Edit</a>
      <?php if($_SESSION["login_user_type"]=="Admin") { if($row['active']==1) { ?><a class="btn btn-danger" href="users.php?id=<?=$row['id']?>&active=0" role="button">Set inactive</a>
        <?php } else { ?><a class="btn btn-success" href="users.php?id=<?=$row['id']?>&active=1" role="button">Set active</a><?php } } ?>
        </td>
    </tr><?php	
    } }
    else {
    ?>
    <tr>
      <td colspan="4">No records found</td>
    </tr>
    <?php } ?>
  </tbody></table>
                        </div></div>
  <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                        <div class="table-responsive">
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php
    $sql_sel=mysqli_query($mysql,"SELECT * FROM users WHERE type='Teacher'");
    if(mysqli_num_rows($sql_sel)>0) {
    $i=0;
    while($row=mysqli_fetch_array($sql_sel)){
    $i++;
    ?>
    <tr>
      <th scope="row"><?php echo $row['fname']." ".$row['lname'];?></th>
      <td><?php echo $row['email'] ?></td>
      <td><?php if($row['active']==1) { ?><p class="text-primary">Active</p>
        <?php } else { ?><p class="text-secondary">Inactive</p><?php } ?></td>
      <td><a class="btn btn-primary" href="user.php?id=<?=$row['id']?>" role="button">Edit</a>
      <?php if($_SESSION["login_user_type"]=="Admin") { if($row['active']==1) { ?><a class="btn btn-danger" href="users.php?id=<?=$row['id']?>&active=0" role="button">Set inactive</a>
        <?php } else { ?><a class="btn btn-success" href="users.php?id=<?=$row['id']?>&active=1" role="button">Set active</a><?php } } ?>
        </td>
    </tr><?php	
    } }
    else {
    ?>
    <tr>
      <td colspan="4">No records found</td>
    </tr>
    <?php } ?>
  </tbody></table>
                        </div></div>
                    </div>
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