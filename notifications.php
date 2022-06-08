<?php
require("session.php");
require("db.php");

if($_SESSION["login_user_type"]!="Admin")
      header("location:index.php");

if(isset($_GET['id']) && isset($_GET['action']))
{
    $id=$_GET['id'];
    $for_id=$_GET['for_id'];
    $action=$_GET['action'];
    mysqli_query($mysql, "UPDATE $action SET active='1' WHERE id=$for_id");
    mysqli_query($mysql, "DELETE FROM notifications WHERE id=$id");
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
                        <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
                    </div>
                        <div class="table-responsive">
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">Notification</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php
    $sql_sel=mysqli_query($mysql,"SELECT * FROM notifications");
    if(mysqli_num_rows($sql_sel)>0) {
    $i=0;
    while($row=mysqli_fetch_array($sql_sel)){
    $i++;
    $ntype=$row['type'];
    if($ntype=="NEW_USER"){ $notif="New User added"; $link="user.php?id=".$row['for_id'];$for="users";}
    elseif($ntype=="NEW_BOOK"){  $notif="New Book added"; $link="book.php?id=".$row['for_id'];$for="books";}
    elseif($ntype=="NEW_CONFERENCE"){  $notif="New Conference added"; $link="conference.php?id=".$row['for_id'];$for="conferences";}
    elseif($ntype=="NEW_EXPERTTALK"){  $notif="New Expert Talk added"; $link="experttalk.php?id=".$row['for_id'];$for="expert_talk";}
    elseif($ntype=="NEW_JOURNAL") { $notif="New Journal added"; $link="journal.php?id=".$row['for_id'];$for="journals";}
    ?>
    <tr>
      <th scope="row"><p class="text-secondary"><?=$notif ?></p>
<p><a href="<?=$link ?>" class="text-info">#<?=$row['for_id'] ?></a> by User<a href="user.php?id=<?=$row['by_id']; ?>" class="text-info">#<?=$row['by_id']; ?></a></p></th>
      <td><a class="btn btn-secondary" href="notifications.php?id=<?=$row['id']?>&action=0" role="button">Dismiss</a>
        <a class="btn btn-success" href="notifications.php?id=<?=$row['id']?>&for_id=<?=$row['for_id'] ?>&action=<?=$for ?>" role="button">Set active</a>
        </td>
    </tr><?php	
    } }
    else {
    ?>
    <tr>
      <td colspan="2">No records found</td>
    </tr>
    <?php } ?>
  </tbody></table>
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