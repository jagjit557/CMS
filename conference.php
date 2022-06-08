<?php
require("session.php");
require("db.php");

$id="";
$msg="";
$uploaded=0;
if(isset($_GET['id'])){
	$id=$_GET['id'];
}

if(isset($_POST['btn_add'])){
	$title=$_POST['title'];
	$conference_name=$_POST['conference_name'];
    $venue=$_POST['venue'];
	$scope=$_POST['scope'];
    $month=$_POST['month'];
    $year=$_POST['year'];

    $fileExt = pathinfo($_FILES["proof"]["name"], PATHINFO_EXTENSION);
    $proof= 'proofs/proof-' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.'.$fileExt;
    if ($_FILES["proof"]["size"] < 500000 && ($fileExt=="jpg"||$fileExt=="jpeg"||$fileExt=="png"||$fileExt=="pdf")) {
      move_uploaded_file($_FILES["proof"]["tmp_name"], $proof);
$uploaded=1;
    } else {
      $msg="Sorry, your file was invalid.";
    }
	if($_SESSION["login_user_type"]=="Admin") $active=1;
  else $active=0;

if($uploaded==1){
$sql_ins=mysqli_query($mysql,"INSERT INTO conferences 
						VALUES(
							NULL,
							'$title',
							'$conference_name' ,
							'$venue',
                            '$scope',
                            '$month',
                            '$year',
							'$proof',
                            '$active'
							)
					");
$insert_id=mysqli_insert_id($mysql);
if($sql_ins==true){
$author_name=$_POST['author_name'];
$author_affiliation=$_POST['author_affiliation'];
$author_type=$_POST['author_type'];
for($i=0;$i<count($author_name);$i++)
{
mysqli_query($mysql,"INSERT INTO conference_authors 
						VALUES(
							NULL,
							'".$insert_id."',
              '".$author_name[$i]."',
              '".$author_affiliation[$i]."',
              '".$author_type[$i]."'
							)
					");
}
if($active==0){
$user_id=$_SESSION['login_user'];
$notify=mysqli_query($mysql,"INSERT INTO notifications 
						VALUES(
							NULL,
							'NEW_CONFERENCE',
							'$insert_id' ,
							'$user_id'
							)
					");
          }
  header("location:conferences.php");
}
else
	$msg="Insert Error:".mysqli_error($mysql);}
}
if(isset($_POST['btn_upd'])){
	$title=$_POST['title'];
	$conference_name=$_POST['conference_name'];
    $venue=$_POST['venue'];
	$scope=$_POST['scope'];
    $month=$_POST['month'];
    $year=$_POST['year'];
	
	$sql_update=mysqli_query($mysql,"UPDATE conferences SET 
								title='$title',
								conference_name='$conference_name',
								venue='$venue',
								scope='$scope',
								month='$month',
								year='$year'
							WHERE
								id=$id
							");

mysqli_query($mysql,"DELETE FROM conference_authors 
						WHERE conference='$id'
					");
$author_name=$_POST['author_name'];
$author_affiliation=$_POST['author_affiliation'];
$author_type=$_POST['author_type'];
for($i=0;$i<count($author_name);$i++)
{
mysqli_query($mysql,"INSERT INTO conference_authors 
						VALUES(
							NULL,
							'".$id."',
              '".$author_name[$i]."',
              '".$author_affiliation[$i]."',
              '".$author_type[$i]."'
							)
					");
}
	if($sql_update)
        $msg="Record Updated Successfully!";
	else
		$msg="Update Failed!";
	}

  
if(isset($_GET['id'])){
	$sql=mysqli_query($mysql,"SELECT * FROM conferences WHERE id=$id");
	$row=mysqli_fetch_array($sql);
  if(mysqli_num_rows($sql)==0) 
      header("location:conferences.php");
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
        
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
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
                        <h1 class="h3 mb-0 text-gray-800"><?=isset($_GET['id'])?"Edit":"Add" ?> Conference</h1>
                    </div>
                        <?php if($msg!=""){ ?><div class="alert alert-primary" role="alert">
  <?=$msg ?>
</div><?php } ?>
                        <form method="POST" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="scope" id="inlineRadio1" value="National" <?php if(isset($_GET['id']) && $row['scope']=="National") echo "checked"; ?> required>
  <label class="form-check-label" for="inlineRadio1">National</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="scope" id="inlineRadio2" value="International" <?php if(isset($_GET['id']) && $row['scope']=="International") echo "checked"; ?> required>
  <label class="form-check-label" for="inlineRadio2">International</label>
</div>
  </div>
  <div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" placeholder="Title" <?php if(isset($_GET['id'])) echo "value='".$row["title"]."'"; ?> required>
  </div>
    <div class="form-group">
    <label>Authors</label>
    <table class="table" id="author_list">
      <?php 
    if(isset($_GET['id'])) { 
      $j_id=$_GET['id'];
      $authors=mysqli_query($mysql,"SELECT * FROM conference_authors WHERE conference='$j_id'");
      $j=0;
      while($arow=mysqli_fetch_array($authors)){
      $j++;  ?>
<tr id="row<?=$j?>">
    <td><input type="text" class="form-control" name="author_name[]" placeholder="Enter Name" <?="value='".$arow["author_name"]."'";?> required></td>
    <td><input type="text" class="form-control" name="author_affiliation[]" placeholder="Enter Affiliation" <?="value='".$arow["author_affiliation"]."'";?> required></td>
    <td><select class='form-control' name='author_type[]'><option <?=$arow["author_type"]=="Teacher"?"selected":"";?>>Teacher</option><option <?=$arow["author_type"]=="Student"?"selected":"";?>>Student</option></select></td>
    <?php if($j>1){ ?><td><button class='btn btn-danger' type='button' onclick=delete_row('row<?=$j?>')>Delete Author</button></td><?php } ?>
   </tr>
    <?php }} else { ?>
   <tr id="row1">
    <td><input type="text" class="form-control" name="author_name[]" placeholder="Enter Name" required></td>
    <td><input type="text" class="form-control" name="author_affiliation[]" placeholder="Enter Affiliation" required></td>
    <td><select class='form-control' name='author_type[]'><option>Teacher</option><option>Student</option></select></td>
   </tr><?php } ?>
  </table>
  <button class="btn btn-primary" id="add_btn" type="button" onclick="add_row();">Add Author</button>
  </div>
  <div class="form-group">
    <label>Name of Conference</label>
    <input type="text" name="conference_name" class="form-control" placeholder="Name of Conference" <?php if(isset($_GET['id'])) echo "value='".$row["conference_name"]."'"; ?> required>
  </div>
  <div class="form-group">
    <label>Venue</label>
    <input type="text" name="venue" class="form-control" placeholder="Venue" <?php if(isset($_GET['id'])) echo "value='".$row["venue"]."'"; ?> required>
  </div>
  <div class="form-group">
  <div class="form-row">
    <div class="col-6">
    <label>Month</label>
      <select class="form-control" name="month">
          <option value="">Select Month</option>
          <?php for ($i = 0; $i < 12; $i++) { 
              $date_str = date('F', strtotime("01-01-1900+ $i months"));  ?>
              <option value='<?=$date_str ?>' <?php if(isset($_GET['id'])) if($row["month"]==$date_str) echo "selected"; ?>><?=$date_str ?></option> <?php }
?>
</select>
    </div>
    <div class="col-6">
    <label>Year</label>
      <input  type="number" min="1900" max="2099" step="1" class="form-control" name="year" placeholder="Year" <?php if(isset($_GET['id'])) echo "value='".$row["year"]."'"; ?> required>
    </div>
  </div>
  </div>
  <div class="form-group"><?php if(!isset($_GET['id'])){ ?>
    <label for="proof" class="form-label">Proof: Certificate/First Page (.jpg, .jpeg, .png, .pdf accepted)</label>
    <input class="form-control" type="file" id="proof" name="proof"
      accept=".jpg, .jpeg, .png, .pdf"><?php } else { ?>
    <a target="_blank" href="<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
      === 'on' ? "https" : "http") . 
      "://" . $_SERVER['HTTP_HOST'] ."/cms/".$row["proof"]?>" class="badge badge-primary">View Proof</a><br>
    <?php } ?>
  </div>
  <?php if(!isset($_GET['id'])){ ?><button type="submit" name="btn_add" class="btn btn-primary">Add Conference</button>
    <?php } else { ?><button type="submit" name="btn_upd" class="btn btn-primary">Update Conference</button><?php } ?>
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

<script type="text/javascript">
function add_row()
{
 $rowno=$("#author_list tr").length;
 $rowno=$rowno+1;
 $("#author_list tr:last").after("<tr id='row"+$rowno+"'><td><input type='text' class='form-control' name='author_name[]' placeholder='Enter Name' required></td><td><input type='text' class='form-control' name='author_affiliation[]' placeholder='Enter Affiliation' required></td><td><select class='form-control' name='author_type[]'><option>Teacher</option><option>Student</option></select></td><td><button class='btn btn-danger' type='button' onclick=delete_row('row"+$rowno+"')>Delete Author</button></td></tr>");
 if($rowno==6) $("#add_btn").remove();
}
function delete_row(row)
{
 $('#'+row).remove();
 $rowno=$("#author_list tr").length;
 if($rowno==5) $("#author_list").after('<button class="btn btn-primary" id="add_btn" type="button" onclick="add_row();">Add Author</button>');
}
</script>
</body>

</html>
