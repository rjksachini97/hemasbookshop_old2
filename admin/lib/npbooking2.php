<div class="container" style="padding-top: 100px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <h3 >Newspaper Booking</h3>
    </li>
  </ol>
                
  <form id="NewspaperBookingForm">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cusname">Customer Name<b class="text-danger">*</b></label>
        <input type="text" class="form-control col-sm-8" id="cusname" name="cusname" value="">
      </div>
      <div class="form-group col-md-6">
      <label for="txt_mob">Contact No<b class="text-danger">*</b></label>
      <input type="text" class="form-control col-sm-8" id="txt_mob" name="txt_mob" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="txt_nic">NIC<b class="text-danger">*</b></label>
      <input type="text" class="form-control col-sm-8" id="txt_nic" name="txt_nic" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="txt_timep">Period for ordering<b class="text-danger">*</b></label>
      <div >
          <select class="form-control col-sm-8" name="txt_timep" id="txt_timep">
            <option>-- Select Time Period for Ordering--</option>
              <option value="1">For One Day</option>
              <option value="2">For One Week</option>
              <option value="3">For One Month</option>
              <option value="4">For One Year</option>
          </select>
        </div>
    </div>
  </div>

  <div class="container" style="padding-top: 20px;">
    
    <div class="form-group row">
      <label for="txt_npname" class="col-sm-3 col-form-label">Newspaper Name<b class="text-danger">*</b></label>
        <div class="col-sm-6">
          <select class="form-control col-sm-6" name="txt_npname" id="txt_npname">
          <!--  <?php
            //foreach($result as $row)
            {
              //echo '<option value="'.$row["newsp_name"].'">'.$row["newsp_name"].'</option>';
            }
            ?>  -->
           
          <option>-- Select Newspaper --</option>
             <?php getNewspaperCategories(); ?>  
          
          </select>
        </div>
      </div>
                        
      <div class="form-group row">
        <label for="txt_npqty" class="col-sm-3 col-form-label">Newspaper Quantity<b class="text-danger">*</b></label>
          <div class="col-sm-3">
            <input type="text"class="form-control" name="txt_npqty" id="txt_npqty" value="" placeholder="Enter Newspaper Quantity">
        </div>
      </div>


      <div class="form-group row">
       <button type="button" class="btn btn-success" id="btnSave">Save</button> 
        <!--<input type="hidden" name="action" id="action" value="add"> -->
        <!--<input type="submit" id="Save" class="btn btn-success" name="Save" value="Save">  -->
        </div>

      <table id="tblsave" class="table table-striped">
  <thead>
    <tr>
       <th>Newspaper Name</th>
      <th>Quantity</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody></tbody>
  <tfoot>
    <tr>
       <th>Newspaper Name</th>
      <th>Quantity</th>
     <th>Edit</th>

    </tr>
  </tfoot>
</table>  

</div>                     

  <div class="form-group" style="padding-top: 50px;">
                              <label for="tot_price">Total Price</label>
                              <input type="text" class="form-control col-sm-2" id="tot_price" name="tot_price" readonly="readonly" value="00.00">
                            </div> 

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="ck_agree">
                                    <label class="form-check-label" for="ck_agree">I agree to the Pay Half of the total Package fee as retainer to hold the date.</label>
                            </div>

                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                                <button type="button" class="btn btn-primary" id="btnBooking" disabled>Place My Booking</button>
                            </div>

                      </form>
                </div>
