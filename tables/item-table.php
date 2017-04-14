<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover table-responsive" id="example">
<thead>
	<th>Image</th>
	<th>Item Name</th>
	<th>Retail</th>
	<th>Dealer</th>
	<th>Item Description</th>
	<th>Action</th>
</thead>
<tbody>	
	<?php 
		$item =  $db->getRows("SELECT * FROM products WHERE flag = 1  AND itemCat = ".$category."");
		$cat = "products";

        foreach ($item as $result) {
 			echo"
			<tr>
			 <td>".img($result->itemImage)."</td>
			 <td>".e($result->itemName)."</td>
			 <td>&#8369;".number_format(e($result->retail_price))."</td>
			 <td>&#8369;".number_format(e($result->dealer_price))."</td>
			 <td><pre>".e($result->itemDesc)."</pre></td>
			 <td>
			 <input type='button' class='btn red btn-warning' onclick='editItem($result->id,\"$result->itemName\",$result->retail_price,$result->dealer_price)' value='Edit'
			 >
			 <input type='button' class='btn red btn-warning' onclick='remove($result->id,\"$cat\")'  value='&#10006'>
			 </td>
			</tr>		
			";      
		}
	 ?>
</tbody>
</table>
</div>
<script type="text/javascript">	
	function remove(uid,table){
		if(confirm("Really?")){
			$.ajax({
				type: "POST",
				url: "ajax/delete.php", 
				data: {
					"uid" : uid,
					"tablename" : table
				},
				cache: false,
				success : function(data){
					 location.reload(); 
				}				
			});
		}
	}

	function editItem(id, itemName,retail,dealer){
		$('#theID').val(id);
		$('#eitemName').val(itemName);
		$('#eretail').val(retail);
		$('#edealer').val(dealer);
	    $('#editItem').modal('show');
	}
</script>