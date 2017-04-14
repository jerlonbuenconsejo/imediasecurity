<div class="form-group">
<div class="modal fade" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:100%;" >
    <div class="modal-content">
      <!--HEADER-->
      <div class="modal-header bg-green" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-white" id="myModalLabel">Create Quotation</h3>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
      <!--BODY-->
      <div class="modal-body container-fluid  ">
        <div class="row">
        <div class="col-md-3">
          <label for="subj">Company:</label>
          <input type="text"   id="Company" class="btn">
        </div>

        <div class="col-md-3">
          <label>Address</label>
          <input type="text"   id="address" class="btn">
        </div>

        <div class="col-md-3">
          <label>Recipient</label>
          <input type="text"   id="recipient" class="btn">
        </div>

        <div class="col-md-3">
          <label>Email</label>
          <input type="text"   id="email" class="btn">
        </div>

        </div>
        <br>
        <div class="row">
          <div class="col-md-8">
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
      <!--FOOTER-->
      <div class="modal-footer">
    <!--<b><p id="messageBox" class="bg-warning"></p></b>-->
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit"   name="submitQuote" class="btn bg-green text-white">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>