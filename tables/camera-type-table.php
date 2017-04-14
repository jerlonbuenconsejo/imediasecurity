<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover table-responsive" id="example">
<thead>
	<th>Camera Type</th>
	<th>Action</th>
</thead>
<tbody>	
	<?php 
		$sql =  $db->getRows("SELECT * FROM camera_type");
		$cat = "camera_type";
        foreach ($sql as $result) {
		echo "
			<tr>
			 <td>".e($result->name)."</td>
			 <td>
			 <input type='button' class='btn red ' onclick='editType($result->id,\"$result->name\")'  value='Edit'> 
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
		             window.location.href = "camera-type.php";
				}				
			});
		}
	}

		function editType(id, type){
		$('#theID').val(id);
		$('#ectype').val(type);
	    $('#emyModal').modal('show');
	}
</script>