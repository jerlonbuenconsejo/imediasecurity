<?php 
	require_once "config/db_config.php";
	include "includes/function.php";
	$db = new Database();
	$category = $_GET['catID'];
	$sql= $db->getRow("SELECT * from categories WHERE catID = ".$category."");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<?php include "includes/requireCSS.php"; ?>
	<title>Item List</title>
</head>
<body>
<div class="app app-default">
<?php include "includes/sideNav.php"; ?>
<div class="app-container">
<?php require_once "includes/header.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#supplier">Add <?php echo $sql->catName; ?></button>
			</div>
		</div><!--row-->	
		<div class="form-group">
		<div class="modal fade" id="supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document" ">
		    <div class="modal-content">
		      <!--HEADER-->
		      <div class="modal-header bg-green" >
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title text-white" id="myModalLabel"><?php echo $sql->catName; ?></h3>
		      </div>

		      <form action="" method="POST" enctype="multipart/form-data">
		      <!--BODY-->
		      <div class="modal-body">

			      <div class="row">
			        <div class="col-md-3">
			          <label for="item_image">Add Image</label>
			        </div>
			        <div class="col-md-7">
			        	<input name="item_image" type="file" required class="form-control"  placeholder="">				        
			        </div>
			      </div>

			      <div class="row">
			        <div class="col-md-3">
			          <label for="item">Item Name</label>
			        </div>
			        <div class="col-md-7">
			        	<input name="itemName" type="text" required class="form-control"  placeholder="Item Name">				        
			        </div>
			      </div>

			      <div class="row">
			       <div class="col-md-3">
			          <label for="retail">Retail</label>
			        </div>
			        <div class="col-md-7">
			        	<input name="retail" type="text" required class="form-control"  placeholder="Retail Price">				        
			        </div>
			      </div>

			      <div class="row">
			       <div class="col-md-3">
			          <label for="dealer">Dealer</label>
			        </div>
			        <div class="col-md-7">
			        	<input name="dealer" type="text" required class="form-control"  placeholder="Dealer Price">				        
			        </div>
			      </div>

			      <div class="row">
			       <div class="col-md-3">
			          <label for="itemDesc">Description</label>
			        </div>
			        <div class="col-md-7">
			        	<textarea name="itemDesc" id="iDesc" class="form-control"  placeholder="Item Desc">	</textarea>			        
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


<!--EDIT MODAL -->
<div class="container-fluid">
		<div class="form-group">
		<div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document" ">
		    <div class="modal-content">
		      <!--HEADER-->
		      <div class="modal-header bg-green" >
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title text-white" id="myModalLabel"><?php echo $sql->catName; ?></h3>
		      </div>

		      <form action="" method="POST" enctype="multipart/form-data">
		      <!--BODY-->
		      <div class="modal-body">
		          <input name="theID" id="theID" type="hidden" class="form-control"  >
			      <div class="row">
			        <div class="col-md-3">
			          <label for="item">Item Name</label>
			        </div>
			        <div class="col-md-7">
			        	<input name="eitemName" id="eitemName" type="text" required class="form-control"  placeholder="Item Name">				        
			        </div>
			      </div>

			      <div class="row">
			       <div class="col-md-3">
			          <label for="retail">Retail</label>
			        </div>
			        <div class="col-md-7">	
			        	<input name="eretail" id="eretail" type="text" required class="form-control"  placeholder="Retail Price">				        
			        </div>
			      </div>

			      <div class="row">
			       <div class="col-md-3">
			          <label for="dealer">Dealer</label>
			        </div>
			        <div class="col-md-7">
			        	<input name="edealer" id="edealer" type="text" required class="form-control"  placeholder="Dealer Price">				        
			        </div>
			      </div>

			      <div class="row">
			       <div class="col-md-3">
			          <label for="itemDesc">Description</label>
			        </div>
			        <div class="col-md-7">
			        	<textarea name="eitemDesc" id="eitemDesc" class="form-control"  placeholder="Item Desc">	</textarea>			        
			        </div>
			      </div>
				  <br>
		      </div>

		      <!--FOOTER-->
		      <div class="modal-footer">
				<!--<b><p id="messageBox" class="bg-warning"></p></b>-->
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" name="esubmit" class="btn bg-green text-white">Submit</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
		</div>
	</div>

<!--TABLE-->
<?php include "tables/item-table.php"; ?>
</div>
</div>
<?php include "includes/requireScript.php";?>
<?php 
	if(isset($_POST['submit'])){
		$img        = $_FILES['item_image']['name'];
		$temp_img   = $_FILES['item_image']['tmp_name'];
		$moveImg    = move_uploaded_file($temp_img, "images/items/".$img);
		$itemName 	= $_POST['itemName'];
		$retail 	= $_POST['retail'];
		$dealer 	= $_POST['dealer'];
		$itemDesc 	= $_POST['itemDesc'];		
		$sql = $db->insertRow("INSERT INTO products(itemCat,itemImage, itemName, retail_price, dealer_price, itemDesc)VALUES (?,?,?,?,?,?)",[$category,$img, $itemName, $retail,$dealer,$itemDesc]);
		echo "<meta http-equiv='refresh' content='0'>";	
	}

	if(isset($_POST['esubmit'])){
		$id = $_POST['theID'];
		$itemName 	= $_POST['eitemName'];
		$retail 	= $_POST['eretail'];
		$dealer 	= $_POST['edealer'];
		$itemDesc 	= $_POST['eitemDesc'];		
		$sql = $db->updateRow("UPDATE products SET itemName=?,retail_price=?,dealer_price=?,itemDesc=? WHERE id =? ",[$itemName,$retail,$dealer,$itemDesc,$id]);
		echo "<meta http-equiv='refresh' content='0'>";	
	}
?>
</body>
</html>