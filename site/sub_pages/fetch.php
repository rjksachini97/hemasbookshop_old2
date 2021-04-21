<?php

?>

<script>
 $(document).ready(function(){
    var dataTable = $("#tblsave").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_np_booking.php?type=viewSave",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"}
        ],
        "columnDefs":[
          {
            "data":null,
            "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
            "targets":2
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
            "targets":3
          }
        ]
    });
    $("#tblsave tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
        var type= $(this).attr('title');
        var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
        var sid = data[0];
        if(type=="Edit"){
            $("#SaveBooking").load("newspaperbooking.php?sampleid="+sid);
        }else if(type=="Delete"){
            swal({
            title:"Do you want to Remove this Booking?",
            text:"You are trying to Remove Booking:"+sid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
              if(willDelete){
                var url = "lib/mod_np_booking.php?type=deleteSave";
                $.ajax({
                  method:"POST",
                  url:url,
                  data:{sampleid:sid},
                  dataType:"text",
                  success:function(result){
                    res = result.split(",");
                    if(res[0]=="0"){
                      swal("Error",res[1],"error")
                    }
                    
                    else if(res[0]=="1"){         
                      swal("Success",res[1],"success");
                      //$("#lnkviewemp").click();
                    }
                  },
                  error:function(eobj,etxt,err){
                    console.log(etxt);
                  }
                });
              }
          });
        }   
      });
 });
</script>

  <div class="container" style="padding-top: 20px;">
    <form id="SaveBooking">
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
</form>
</div> 