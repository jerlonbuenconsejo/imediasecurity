
 function addToList(brand,model,index){
  var btn = "<a href='#' id='"+index+"' style='color:red;'onclick='removeItem(this,this.id)'>X</a>";
  $("#showList").append("<li><h6>"+btn+"<b>Rate:</b> "+brand+" "+model+"</h6></li>");
}

Array.prototype.lastIndex = function(){
  return this.length-1;
}

function removeElement(link,val){
   	itemList.splice(val, 1);
   	link.parentNode.parentNode.removeChild(link.parentNode);

}


