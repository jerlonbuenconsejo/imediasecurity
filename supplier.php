<?php 
	require_once "./config/db_config.php";
	include "includes/function.php";
	$db = new Database();

	$sql = $db->getRows("SELECT * FROM categories WHERE flag = 1");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<?php include "includes/requireCSS.php"; ?>
	<title>Supplier</title>
</head>
<body>
<div class="app app-default">
<?php include "includes/sideNav.php"; ?>
<div class="app-container">
<?php require_once "includes/header.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#supplier">Add Supplier</button>
			</div>
		</div><!--row-->	
		<div class="form-group">
		<div class="modal fade" id="supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document" ">
		    <div class="modal-content">
		      <!--HEADER-->
		      <div class="modal-header bg-green" >
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title text-white" id="myModalLabel">Supplier</h3>
		      </div>

		      <form action="" method="POST" enctype="multipart/form-data">
		      <!--BODY-->
		      <div class="modal-body">
			      <div class="row">
			        <div class="col-md-3">
			          <label for="category">Select Category</label>
			        </div>

			        <div class="col-md-7">
			        <select name="category" id="category" class="form-control" required>
   				        <option>Select Category</option>
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
			          <label for="item">Item</label>
			        </div>
			        <div class="col-md-7">
				        <select id="item" name="item" class="form-control" width="120" required>
				        </select>
			        </div>
			      </div>
				  <br>
			      <div class="row">
			        <div class="col-md-2">
			          <label for="type">JVS</label>
			        </div>
			        <div class="col-md-5">
			        	<input name="jvsR"  type="text" required class="form-control"  placeholder="Retail">
			        </div>
			        <div class="col-md-5">
			        	<input name="jvsD"  type="text" required class="form-control"  placeholder="Dealer">			        	
			        </div>
			      </div>
			      
				  <div class="row">
			        <div class="col-md-2">
			          <label for="desc">Exposed</label>
			        </div>
			        <div class="col-md-5">
			        	<input name="expR"  type="text" required class="form-control"  placeholder="Retail">
			        </div>
			        <div class="col-md-5">
			        	<input name="expD"  type="text" required class="form-control"  placeholder="Dealer">
			        </div>
			      </div>
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
	<?php include "tables/supplier-table.php"; ?>	
</div>
</div>
<?php include "includes/requireScript.php";?>
<?php 
if(isset($_POST['submit'])){
	$cat 	= $_POST['category'];
	$item 	= $_POST['item'];
	$jvsR	= $_POST['jvsR'];
	$jvsD	= $_POST['jvsD'];
	$expR 	= $_POST['expR'];
	$expD 	= $_POST['expD'];



}
?>
<script type="text/javascript">
	$("#category").on("change",function(){
		var cat = $(this).val();
		$.ajax({
			type: "POST",
			url:"ajax/supplier.getItem.php",
			data:{ 
				cat
			},
			cache: false,
			success:function(data){
				$("#item").html(data);
			}
		});
	});

</script>
</body>
</html>