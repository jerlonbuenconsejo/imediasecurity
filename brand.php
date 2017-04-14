<?php 
 include "includes/function.php";
 require_once "config/db_config.php";
 $db = new Database();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Brand</title>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">

    <?php include "includes/requireCSS.php"; ?>
</head>
<body>
<div class="app app-default">
<?php include "includes/sideNav.php"; ?>

<div class="app-container">
<?php require_once "includes/header.php"; ?>
<div class="container-fluid">
<div class="row">
  <div class="col-lg-12">
    <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
      Brand
    </button>
  </div>
</div>

<div class="form-group">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--HEADER-->
      <div class="modal-header bg-green" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-white" id="myModalLabel">Brand</h3>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
      <!--BODY-->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <label for="brand">Brand</label>
          </div>

          <div class="col-md-5">
            <input name="brand" type="text" required class="form-control" placeholder="HikVision/Dahua...">
          </div>
        </div>

      </div>

      <!--FOOTER-->
      <div class="modal-footer">
    <!--<b><p id="messageBox" class="bg-warning"></p></b>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit"   name="submit" class="btn bg-green text-white">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>



<?php  
if(isset($_POST['submit'])){
  $brand =  $_POST['brand'];
  $db->insertRow("INSERT INTO brand(name) 
          VALUES(?)",[$brand]);

}

?>
<?php require_once "tables/brand-table.php"; ?>
<?php include "includes/requireScript.php";?>
</div>

<!--EDIT-->
<div class="container-fluid">
<div class="form-group">
<div class="modal fade" id="editBrand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--HEADER-->
      <div class="modal-header bg-green" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-white" id="myModalLabel">Brand</h3>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
      <!--BODY-->
      <div class="modal-body">
        <input name="theID" id="theID" type="hidden" class="form-control"  >
        <div class="row">
          <div class="col-md-3">
            <label for="brand">Brand</label>
          </div>

          <div class="col-md-5">
            <input name="ebrand" id="ebrand" type="text" required class="form-control" placeholder="HikVision/Dahua...">
          </div>
        </div>

      </div>

      <!--FOOTER-->
      <div class="modal-footer">
    <!--<b><p id="messageBox" class="bg-warning"></p></b>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit"   name="esubmit" class="btn bg-green text-white">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<?php  
if(isset($_POST['esubmit'])){
  $id = $_POST['theID'];
  $brand =  $_POST['ebrand'];
  $sql = $db->insertRow  ("UPDATE brand SET name = ? WHERE id = ?",[$brand,$id]);
if(!$sql){
      echo "<script>alert('Error.');</script>";
    }else{
      echo "<meta http-equiv='refresh' content='0'>"; 
    }
}

?>
</div>
</div>

</body>
</html>