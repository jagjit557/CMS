<?php
require("session.php");
require("db.php");
$users=mysqli_query($mysql, "SELECT * FROM users");
$noOfUsers=mysqli_num_rows($users);

if(isset($_GET['btn_search'])){
        $conferences="SELECT DISTINCT c.id, c.title, c.conference_name, c.scope, c.active, str_to_date(concat('01 ',c.month, ' ', RIGHT('0000' + c.year, 4)), '%d %M %Y') AS newdate FROM conferences c INNER JOIN conference_authors ca ON c.id=ca.conference WHERE 1";
        $journals="SELECT DISTINCT c.id, c.title, c.journal_name, c.scope, c.active, str_to_date(concat('01 ',c.month, ' ', RIGHT('0000' + c.year, 4)), '%d %M %Y') AS newdate FROM journals c INNER JOIN journal_authors ca ON c.id=ca.journal WHERE 1";

        if(isset($_GET['authorType']) && $_GET['authorType']!=""){
            $authorType=$_GET['authorType'];
            $conferences.=" AND ca.author_type='".$authorType."'";
            $journals.=" AND ca.author_type='".$authorType."'";
        }

        if(isset($_GET['author_name']) && $_GET['author_name']!=""){
            $author_name=$_GET['author_name'];
            $conferences.=" AND ca.author_name='".$author_name."'";
            $journals.=" AND ca.author_name='".$author_name."'";
        }

        if(isset($_GET['scope']) && $_GET['scope']!=""){
            $scope=$_GET['scope'];
            $conferences.=" AND c.scope='".$scope."'";
            $journals.=" AND c.scope='".$scope."'";
        }

        if(isset($_GET['rangeFrom']) && isset($_GET['rangeTo']) && $_GET['rangeFrom']!="" && $_GET['rangeTo']!=""){
            $rangeFrom=$_GET['rangeFrom'];
            $rangeTo=$_GET['rangeTo'];
            $conferences.=" HAVING newdate BETWEEN '".$rangeFrom."-01' AND '".$rangeTo."-01'";
            $journals.=" HAVING newdate BETWEEN '".$rangeFrom."-01' AND '".$rangeTo."-01'";
        }
    $conferences_sel=mysqli_query($mysql,$conferences);
    $journals_sel=mysqli_query($mysql,$journals);
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$noOfUsers-1?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php if($_SESSION["login_user_type"]=="Admin") { ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h4 mb-0 text-gray-800">Search entries</h1>
                    </div>

                        <form method="GET">
  <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Search Range</label>
                          <div class="input-group">
    <input type="text" name="rangeFrom" class="form-control" id="startDate" placeholder="From" <?=isset($_GET['rangeFrom']) && $_GET['rangeFrom'] != "" ? ' value="'.$_GET['rangeFrom'].'"' : ''?>>
    <div class="input-group-append">
    <span class="input-group-text">to</span>
  </div>
    <input type="text" name="rangeTo" class="form-control" id="endDate" placeholder="To" <?=isset($_GET['rangeTo']) && $_GET['rangeTo'] != "" ? ' value="'.$_GET['rangeTo'].'"' : ''?>>
</div>
                        </div>

                        <div class="form-group col-md-2">
                          <label>Type</label>
      <select class="form-control" name="type">
          <option value="">BOTH</option>
          <option value="journals"<?=isset($_GET['type']) && $_GET['type'] == "journals" ? ' selected' : ''?>>Journals</option>
          <option value="conferences"<?=isset($_GET['type']) && $_GET['type'] == "conferences" ? ' selected' : ''?>>Conferences</option>
        </select>
                        </div>

                        <div class="form-group col-md-2">
                          <label>Scope</label>
      <select class="form-control" name="scope">
          <option value="">BOTH</option>
          <option value="National"<?=isset($_GET['scope']) && $_GET['scope'] == "National" ? ' selected' : ''?>>National</option>
          <option value="International"<?=isset($_GET['scope']) && $_GET['scope'] == "International" ? ' selected' : ''?>>International</option>
        </select>
                        </div>

                        <div class="form-group col-md-2">
                          <label>Author Type</label>
      <select class="form-control" name="authorType">
          <option value="">BOTH</option>
          <option value="Teacher"<?=isset($_GET['authorType']) && $_GET['authorType'] == "Teacher" ? ' selected' : ''?>>Teachers</option>
          <option value="Student"<?=isset($_GET['authorType']) && $_GET['authorType'] == "Student" ? ' selected' : ''?>>Students</option>
        </select>
                        </div>
<?php if(isset($_GET['btn_search']) && (mysqli_num_rows($journals_sel)>0 || mysqli_num_rows($conferences_sel)>0)) {?>
                        <div class="form-group col-md-2">
                          <label>Author</label>
      <select class="form-control" name="author_name">
          <option value="">ALL</option>
          <?php 
    $authors=mysqli_query($mysql,"SELECT author_name, author_affiliation FROM conference_authors UNION SELECT author_name, author_affiliation FROM journal_authors");
    $aj=0;
    while($arow=mysqli_fetch_array($authors)){
    $aj++; ?>
    <option value="<?=$arow['author_name']?>" <?php if (isset($_GET['author_name']) && $_GET['author_name'] == $arow['author_name']) echo 'selected' ?>>
    <?=$arow['author_name']?>, <?=$arow['author_affiliation']?>
  </option> <?php } ?>
        </select>
                        </div>
                        <?php } ?>
  </div>

                        <div class="form-group">
  <button type="submit" class="btn btn-primary" name="btn_search">Search</button>
                        </div>
                        </form>
                    <?php if(isset($_GET['btn_search'])){ ?>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="h5 mb-0 text-gray-800">Records found = <?=(mysqli_num_rows($journals_sel)+mysqli_num_rows($conferences_sel))?></h1>
                    </div>
                    <?php if(mysqli_num_rows($journals_sel)>0 || mysqli_num_rows($conferences_sel)>0) { ?>
                    <table class="table">
  <thead>
    <tr>
      <th scope="col">Title/Topic</th>
      <th scope="col">Author(s)</th>
      <th scope="col">Name</th>
      <th scope="col">Scope</th>
      <th scope="col">Status</th>
      <th scope="col">View/Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if((isset($_GET['type']) && $_GET['type']=='') || (isset($_GET['type']) && $_GET['type']=='conferences')) if(mysqli_num_rows($conferences_sel)>0) { ?>
    <tr>
      <td colspan="6"><h1 class="h5">Conferences</h1></td>
    </tr><?php 
    $i=0;
    while($row=mysqli_fetch_array($conferences_sel)){
    $i++; ?>
    <tr>
      <td><?php echo $row['title'];?></td>
      <td><ul><?php 
      $j_id=$row['id'];
    $cauthors=mysqli_query($mysql,"SELECT * FROM conference_authors WHERE conference='$j_id'");
    $j=0;
    while($carow=mysqli_fetch_array($cauthors)){
    $j++; echo "<li>".$carow['author_name'].",  ".$carow['author_affiliation']." (".$carow['author_type'].")</li>"; } ?></ul>
    </td>
      
      <td><?php echo $row['conference_name'];?></td>
      <td><?php echo $row['scope'];?></td>
      <td><?php if($row['active']==1) { ?><p class="text-primary">Active</p>
        <?php } else { ?><p class="text-secondary">Inactive</p><?php } ?></td>
      <td>
      <a class="btn btn-primary" href="conference.php?id=<?=$row['id']?>" role="button">View/Edit</a>
        </td>
    </tr>
<?php
    } }
    ?>
    <?php
    if((isset($_GET['type']) && $_GET['type']=='') || (isset($_GET['type']) && $_GET['type']=='journals')) if(mysqli_num_rows($journals_sel)>0) { ?>
    <tr>
      <td colspan="6"><h1 class="h5">Journals</h1></td>
    </tr><?php 
    $i=0;
    while($row=mysqli_fetch_array($journals_sel)){
    $i++; ?>
    <tr>
      <td><?php echo $row['title'];?></td>
      <td><ul><?php 
      $j_id=$row['id'];
    $jauthors=mysqli_query($mysql,"SELECT * FROM journal_authors WHERE journal='$j_id'");
    $j=0;
    while($jarow=mysqli_fetch_array($jauthors)){
    $j++; echo "<li>".$jarow['author_name'].",  ".$jarow['author_affiliation']." (".$jarow['author_type'].")</li>"; } ?></ul>
    </td>
      
      <td><?php echo $row['journal_name'];?></td>
      <td><?php echo $row['scope'];?></td>
      <td><?php if($row['active']==1) { ?><p class="text-primary">Active</p>
        <?php } else { ?><p class="text-secondary">Inactive</p><?php } ?></td>
      <td><a class="btn btn-primary" href="journal.php?id=<?=$row['id']?>" role="button">View/Edit</a>
        </td>
    </tr>
<?php
    } }
?>
  </tbody>
</table><?php }}} ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        var startDate=$('#startDate').datepicker({
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months",
        });
        $('#endDate').datepicker({
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months",
        });
    </script>

</body>

</html>