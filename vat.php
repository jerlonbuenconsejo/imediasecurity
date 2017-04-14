<?php 
 include "includes/function.php";
 require_once "config/db_config.php";
 $db = new Database();
 $sql = $db->getRow("SELECT * FROM vat");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>VAT </title>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<?php include "includes/requireCSS.php";?>
</head>
<body>
<div class="app app-default">
<?php include "includes/sideNav.php";?>
<div class="app-container">
<?php require_once "includes/header.php";?>
<div class="container-fluid">
<div class="form-group">
    <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
    	<div class="row">	
		<div class="panel panel-warning">
			<div class="panel-heading">Warning!</div>
			<div class="panel-body">
				<p>Changing the value of VAT will reflect on the overall amount in the quotation.</p>
			</div>
			</div>      
		</div>	
		<div class="row">
			<div class="col-sm-2 "><label>Value Added Tax(%)</label></div>
			<div class="col-sm-2">
			<div class="form-group">
			    <div class="input-group">
					<input type="text" name="vat" class="form-control" value=<?php echo $sql->vat;?>	>
			    	<div class="input-group-addon">%</div>
			    </div>
			</div>
			</div>
			<div class="col-sm-2"><input class="btn btn-primary" type="submit" name="updateVat"></div>
		</div>
    </form>
</div>
<?php  
if(isset($_POST['updateVat'])){
	$newValue =  $_POST['vat'];
	$db->updateRow("UPDATE vat set vat =".$newValue."");
	$db->redirect("vat.php");
}
?>
<?php include "includes/requireScript.php";?>
</div>
</div>
</div>
</body>
</html>