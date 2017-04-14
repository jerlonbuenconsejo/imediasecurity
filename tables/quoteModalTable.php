<?php 
		include "../config/db_config.php";
		include "../includes/function.php";
		$db = new Database();
		$id = $_GET['q'];
		$sql =  $db->getRows("SELECT * FROM products WHERE itemCat = $id");
		echo "<div class='dataTable_wrapper'>
				<table class='table table-striped table-bordered table-hover table-responsive listTable' id='quoteModalTable'>
				<thead>
					<th>Item Name</th>
					<th>Description</th>
					<th>QTY</th>
					<th>Dealer/Retail</th>
					<th>Action</th>
				</thead>
				<tbody>	";
        foreach ($sql as $result) {
		echo "

						<tr>
						 <td>".e($result->itemName)."</td>	
						 <td ><div class='scrollable'></div></td>
						 <td><input type='text' class='form-control' size='2' id='$result->id' value='1' ></td>
						 <td>&#8369;".e($result->dealer_price) ."/". e($result->retail_price)."</td>
						 <td>
						 <input type='button' class='btn'  value='&#8594;' 
						 onclick='insertItem($result->id,\"".$result->itemName."\",".$result->retail_price.",\"".e($result->itemDesc)."\",$id)'> 	
						 </td>	
						</tr>";
     	}
    	echo "</tbody>
				</table>
			</div>";
?>

