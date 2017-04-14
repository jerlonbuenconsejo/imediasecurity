<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover table-responsive" id="example">
<thead>
	<th>Date Created</th>
	<th>Company</th>
	<th>Subject</th>
	<th>Recipient</th>
	<th>Email</th>
	<th>Action</th>
</thead>
<tbody>	
	<?php 
		$sql =  $db->getRows("SELECT * FROM quotation_details");
		$cat = "quotation_details";
        foreach ($sql as $result) {
        	//$pricing = ($result->pricing=="D") ? "Dealer" : "Retail";
        	$disable = ($result->qtnStatus==0)? "disabled" : "";
        	$btnValue = ($disable=="disabled")? "Sold" : "$";
			echo"
			<tr>
			 <td>".e($result->dateCreated)."</td>
			 <td>".e($result->company)."</td>
			 <td>".e($result->subject)."</td>
			 <td>".e($result->recipient)."</td>
			 <td>".e($result->email)."</td>
			 <td>
			 <a href='pdfGen.php?quoteID=".$result->id."' class='btn red btn-success' target='_blank' >PDF </a>
			 <input type='button' class='btn red btn-warning' {$disable} onclick='toSales($result->id)' value='{$btnValue}'>
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
		             window.location.href = "quotation.php";
				}				
			});
		}
	}
	function toSales(qid){
		if(confirm("Convert quotation to sales?")){
			$.ajax({
				type:'POST',
				url: 'ajax/convert.to.sales.php',
				data: {
					"qid" : qid
				},
				cache: false,
				success : function(data){
		             window.location.href = "quotation.php";
				}
			});
		}
	}
	function createQuote(sub,rec){
		$('#quoteModal').modal('show', function(){
		});
	}
</script>