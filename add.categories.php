<?php 
	require "config/db_config.php";
	include "includes/function.php";
	$db = new Database();
	$sql = $db->getRows("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<?php include "includes/requireCSS.php"; ?>
	<title>Categories</title>
</head>
<body>
<div class="app app-default">
<?php include "includes/sideNav.php"; ?>
<div class="app-container">
<?php require_once "includes/header.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#supplier">Add Categories</button>
			</div>
		</div><!--row-->	
		<div class="form-group">
		<div class="modal fade" id="supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document" ">
		    <div class="modal-content">
		      <!--HEADER-->
		      <div class="modal-header bg-green" >
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title text-white" id="myModalLabel">Categories</h3>
		      </div>

		      <form action="" method="POST" enctype="multipart/form-data">
		      <!--BODY-->
		      <div class="modal-body">
			      <div class="row">
			        <div class="col-md-3">
			          <label for="parent">Parent Level</label>
			        </div>

			        <div class="col-md-7">
			        <select name="parent" id="parent" class="form-control" required>
   				        <option selected>-----Category-----</option>
			        	<?php 
			        		foreach($sql as $res){
			        			echo "<option value='".$res->catID."'>".strtoupper($res->catName)."</option>";
			        		}
			        	 ?>
			        </select>
			        </div>
			      </div>

			      <div class="row">
			        <div class="col-md-3">
			          <label for="cat"></label>
			        </div>
			        <div class="col-md-7">
			        	<input name="cat" type="text" required class="form-control"  placeholder="Item Name">				        
			        </div>
			      </div>
				  <br>
			     
		      </div>

		      <!--FOOTER-->
		      <div class="modal-footer">
				<!--<b><p id="messageBox" class="bg-warning"></p></b>-->
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" name="submit" class="btn bg-green text-white">Submit</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
		</div>
	</div>

	<?php include "tables/categories-table.php"; ?>
</div>
</div>
<?php include "includes/requireScript.php";?>
<?php 
if(isset($_POST['submit'])){
$parent = (empty($_POST['parent']))? NULL : $_POST['parent'];
$cat 	= $_POST['cat'];


$db->insertRow("INSERT INTO categories(parentID, catName) VALUES (?,?)",[$parent,$cat] );
$db->redirect('add.categories.php');
}
?>
<script type="text/javascript">
</script>
</body>
</html>