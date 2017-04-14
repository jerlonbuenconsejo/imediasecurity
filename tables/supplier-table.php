<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover table-responsive" id="example">
<thead>
	<th>Supplier</th>
	<th>Item</th>
	<th>JVS</th>
	<th>Exposed</th>
	<th>Action</th>
</thead>
<tbody>	
	<?php 
		$sql =  $db->getRows("SELECT * FROM supplierdetails");
		$cat = "supplierdetails";
        foreach ($sql as $result) {
		echo "
			<tr>
			 <td>".e($result->name)."</td>
			 <td>
			 <input type='button' class='btn red ' onclick='remove($result->id,\"$cat\")'  value='&#9997'> 
			 <input type='button' class='btn red ' onclick='remove($result->id,\"$cat\")'  value='&#10006'>
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
		             window.location.href = "brand.php";
				}				
			});
		}
	}
</script>