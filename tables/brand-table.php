<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover table-responsive" id="example">
<thead>
	<th>Brand</th>
	<th>Action</th>
</thead>
<tbody>	
	<?php 
		$sql =  $db->getRows("SELECT * FROM brand WHERE flag = 1");
		$cat = "brand";
        foreach ($sql as $result) {
        $brand = e($result->name);
        $brand2 = str_replace('&quot;', "&quo", e($result->name));
        $id = $result->id;	
		echo "
			<tr>
			 <td>$brand</td>
			 <td>
			 <input type='button' class='btn red ' onclick='edit($result->id,\"$brand2\")'  value='Edit'> 
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

	function rt(text){	
		return text
		.replace(/&quo/g, '"')
		.replace(/&#039;/g, "'");
	}

	function edit(id, brand){
		$('#theID').val(id);
		$('#ebrand').val(rt(brand));
	    $('#editBrand').modal('show');
	}
</script>