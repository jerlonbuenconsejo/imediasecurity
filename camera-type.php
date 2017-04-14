  <?php 
 include "./includes/function.php";
 require_once "./config/db_config.php";
 $db = new Database();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Camera Type</title>
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
    Add Camera Type
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
        <h3 class="modal-title text-white" id="myModalLabel">Camera Type</h3>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
      <!--BODY-->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <label for="ctype">Camera Type</label>
          </div>

          <div class="col-md-5">
            <input name="ctype" type="text" required class="form-control" placeholder="PTZ/Dome/Bullet..">
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
  $ctype =  $_POST['ctype'];
  $db->insertRow("INSERT INTO camera_Type(name) 
          VALUES(?)",[$ctype]);

}

?>
<?php require_once "tables/camera-type-table.php"; ?>
<?php include "includes/requireScript.php";?>
</div>
</div>

<!--EDIT-->
<div class="container-fluid">
<div class="form-group">
<div class="modal fade" id="emyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--HEADER-->
      <div class="modal-header bg-green" >  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-white" id="myModalLabel">Camera Type</h3>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
      <!--BODY-->
      <div class="modal-body">

        <input name="theID" id="theID" type="hidden" class="form-control"  >
        <div class="row">
          <div class="col-md-3">
            <label for="ctype">Camera Type</label>
          </div>

          <div class="col-md-5">
            <input name="ectype" id="ectype" type="text" required class="form-control" placeholder="PTZ/Dome/Bullet..">
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
  $id   = $_POST['theID'];
  $ctype =  $_POST['ectype'];
  $sql = $db->updateRow("UPDATE camera_type SET name = ? WHERE id = ?",[$ctype,$id]);

  if(!$sql){
      echo "<meta http-equiv='refresh' content='0'>";
    }else{
      echo "<meta http-equiv='refresh' content='0'>"; 
    }

}

?>
</div>
</div>


</body>
</html>