<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover table-responsive" id="example">
<thead>
	<th>Categories</th>
	<th>Parent Category</th>
	<th>Action</th>
</thead>
<tbody>	
	<?php 
		$sql =  $db->getRows("SELECT * FROM categories WHERE flag = 1");
		$cat = "categories";
        foreach ($sql as $result) {

		$parent = ($result->parentID==0)? "" : $db->getParent($result->parentID);
		echo "
			<tr>
			 <td>".e($result->catName)."</td>
			 <td>".e($parent)."</td>
			 <td>
			 <input type='button' class='btn red ' onclick='remove($result->catID, \"$cat\")'  value='Remove'> 
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
				url: "ajax/deleteCat.php", 
				data: {
					"uid" : uid,
					"tablename" : table
				},
				cache: false,
				success : function(data){
		            window.location.href = "add.categories.php";
				}				
			});
		}
	}
</script>