<?php 
include "includes/function.php";
require_once "config/db_config.php";
$db = new Database();
$s = $db->getRows("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quotation</title>
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
  <?php include "includes/requireCSS.php"; ?>
</head>
<body>
<div class="app app-default">
<?php include "includes/sideNav.php"; ?>
<div class="app-container">
<?php require_once "includes/header.php"; ?>
<div class="container-fluid">
<div class="row">
  <div class="col-lg-12">
    <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#quoteModal">
    Add Quotation
    </button> 
  </div>
</div>
<div class="form-group">
<div class="modal fade" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:100%;" >
    <div class="modal-content">
      <div class="modal-header bg-green" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-white" id="myModalLabel">Create Quotation</h3>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body container-fluid  ">
      <div class="row">
      <div class="col-md-2">
         <div class="input-group">
            <div class="input-group-addon">Php</div>
            <input type="text" name="discount" class="form-control" id="discount" placeholder="Discount" >
          </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <input type="radio"  checked name="pricing" value="D">Dealer
          <input type="radio" name="pricing" value="R">Retail
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label for="subj">Company:</label>
          <input type="text"  name="company" id="company" required class="form-control">
        </div>
        <div class="col-md-3">
          <label>Subject</label>
          <input type="text"  name="subject" id="subject" required class="form-control">
        </div>
        <div class="col-md-3">
          <label>Recipient</label>
          <input type="text"  name="recipient" id="recipient" required class="form-control">
        </div>
        <div class="col-md-3">
          <label>Email</label>
          <input type="text"  name="email" id="email" required class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="btn-group col-md-6" role="group" aria-label="...">
        <select id="selcat" class="form-control" onchange="showPerCat(this.value)">
          <option disabled selected>SELECT CATEGORY</option>
          <?php 
            foreach($s as $r){
              echo "<option value='$r->catID'>$r->catName</option>";
            }
          ?>
        </select>
        </div>
      </div>  
      <br>
      <div class="row">
        <div id="items" class="col-md-8">

        </div>
          <div class="col-md-4">
            <div class="panel panel-default">
            <div class="panel-body">
              <div id="itemList">
                <h6>Panel Content</h6>
                <ul style="list-style:none;" id="showList">
                <!--Added Options goes here-->
                </ul>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submitQuote"  name="submitQuote" class="btn bg-green text-white">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
  <?php require_once "tables/quotation-table.php"; ?>
<?php include "includes/requireScript.php";?>
</div>  
</div>
<script type="text/javascript">
$(document).ready(function(){
 $('#quoteModalTable').DataTable({
    "ordering": false,
    "info":     false
  });
$('#devapp').DataTable({
    "ordering": false,
    "info":     false
  });
});

//Function for showing items per category.
function showPerCat(str) {
  if (str=="") {
    document.getElementById("selcat").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("items").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","tables/quoteModalTable.php?q="+str,true);
  xmlhttp.send();
}

var itemList   = new Array();
var cat = new Array();
var qty = new Array();
function insertItem(id,itemName,price,desc,ctgry)
{
  $("#itemList").show(); 
  var qnty = $("#"+  id).val();
  price*=qnty;
  itemList.push(id);
  cat.push(ctgry);
  qty.push(qnty)
  addToList(itemName,itemList.lastIndex(),qnty,price,desc.replaceAll());
}

String.prototype.replaceAll = function() 
{   
  var newString = this.replace(/~/g, "&#013;");
  return  newString;
} 

    function rt(text){  
    return text
    .replace(/&quo/g, '"')
    .replace(/&#039;/g, "'");
  }
//append selected items to itemList Div.
function addToList(itemName,index,qty,price,desc)
{ 

  var btn = "<a href='#' id='"+index+"' style='color:red;'onclick='removeItem(this,this.id)'>X</a>";
  var helper = "<input type='button' class='btn btn-default' value='?' title='"+desc+"'>";
  $("#showList").append("<li><h6>"+btn+"<b>Item:</b> "+rt(itemName)+" <b>Quantity:</b>"+qty+"<b> Price:</b> "+price+" "+helper +"</h6></li>");
}
//get last index of an array.
Array.prototype.lastIndex = function()
{
  return this.length-1;
}
//Remove selected item in the array list(itemList, cat & qty)
function removeItem(link,val)
{
  itemList.splice(val, 1);
  cat.splice(val,1);
  qty.splice(val,1);
  link.parentNode.parentNode.removeChild(link.parentNode);
}
//for debugging purposes.
function e()
{
  alert(itemList.lastIndex());
}
$("#submitQuote").click(function(event){

  //http://stackoverflow.com/questions/18274383/ajax-post-working-in-chrome-but-not-in-firefox
  event.preventDefault();
  var itemlist = JSON.stringify(itemList);
  var category = JSON.stringify(cat);
  var quantity = JSON.stringify(qty);
  var email    = $("#email").val();
  var company  = $("#company").val();
  var recipient= $("#recipient").val();
  var subject  = $("#subject").val();
  var pricing  = $("input[name='pricing']:checked").val();
  var discount = $("#discount").val();
  $.ajax({
    url: "ajax/insert.quote.php",
    type: "POST",
    data: {
    itemlist: itemlist,
    category : category,
    email : email,
    recipient: recipient,
    company: company,
    subject: subject,
    quantity: quantity,
    pricing: pricing,
    discount:discount
    },
    success: function(data){
      location.reload(); 
    }
  });
});
</script>
</body>
</html>