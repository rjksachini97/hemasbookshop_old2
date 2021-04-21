<script type="text/javascript">
  $(document).ready(function(){
     var html = '<tr><td><input class="form-control" type="text" name="txt_npname[]" required=""</td><td><input class="form-control" type="text" name="txt_npqty[]" required=""></td><td><input class="form-control" type="text" name="txt_timep[]" required=""></td><td><input class="btn btn-danger" type="button" name="remove" id="remove" value="Remove"></td></tr>';

     

     $("#add").click(function(){
        $("#table_field").append(html);

     });
     $("#table_field").on('click','#remove',function(){
       $(this).closest('tr').remove();
     });


  });

</script>

    <!-- ======= Newspaper Booking Details Section ======= -->
<div class="container" style="padding-top: 100px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <h3 >Newspaper Booking</h3>
    </li>
  </ol>


  <form class="insert-form" id="insert_form" method="post" action="">
    <div class="input-field">
      <table class="table table-bordered" id="table_field">
      <tr>
        <th>Newspaper Name<b class="text-danger">*</b></th>
        <th>Quantity<b class="text-danger">*</b></th>
        <th>Period for ordering<b class="text-danger">*</b></th>
        <th>Add or Remove</th>
      </tr>
      <?php
        $dbobj = DB::connect(); 

        if (isset($_POST['save'])) {
          $txt_npname = $_POST['txt_npname'];
          $txt_npqty = $_POST['txt_npqty'];
          $txt_timep = $_POST['txt_timep'];

          foreach ($txt_npname as $key => $value) {
            $save = "INSERT INTO tbl_sample_data( newsp_id,np_book_qty,np_order_time) VALUES('".$value."','".$txt_npqty[$key]."','".$txt_timep[$key]."')";
            
            $result = $dbobj->query($save);
          }
        }

      ?>

      <tr>
        <td>
          <select class="form-control" name="txt_npname" id="txt_npname">
            <option>-- Select Newspaper --</option>
              <?php getNewspaperCategories(); ?>  
          </select>
        </td>
        <td><input class="form-control" type="text" name="txt_npqty" required=""></td>
        <td>
          <select class="form-control" name="txt_timep" id="txt_timep">
            <option>-- Select Time Period for Ordering--</option>
              <option value="1">For One Day</option>
              <option value="2">For One Week</option>
              <option value="3">For One Month</option>
              <option value="4">For One Year</option>
          </select>
        </td>
        <td><input class="btn btn-warning" type="button" name="add" id="add" value="Add"></td>
      </tr>
      </table>
      <center>
        <input class="btn btn-success" type="submit" name="save" id="save" value="Save Order">
      </center>
    </div>
  </form>
  <div style="padding-top: 50px;">
  <table class="table table-striped">
    <tr>
      <th>Newspaper Name</th>
        <th>Quantity</th>
        <th>Period for ordering</th>
        
    </tr>
    <?php
      $select = "SELECT * FROM tbl_sample_data ORDER BY sample_id DESC";
      $result1 = $dbobj->query($select);
      while ($row = $result1->fetch_array()) {  ?>
        
    <tr>
      <td><?php echo $row['newsp_id']; ?></td>
      <td><?php echo $row['np_book_qty']; ?></td>
      <td><?php echo $row['np_order_time']; ?></td>
    </tr>
    <?php
      }
    ?>
  </table>
  </div>
</div>




<script type="text/javascript">
 

  $(function(){  
    $("#btnreg").click(function(){
      var name = $("#txt_npname").val();
      var qty = $("#txt_npqty").val();

      /*if(title==""){
        swal("Invalid Input","Please Select the title","error");
        return;
      }*/
      
      var fdata = $("SaveBooking").serialize();
      var url = "lib/mod_np_booking?type=getNPSave";

      $.ajax({

      method:"POST",
      url:url,
      data:fdata,
      dataType:"text",
      success:function(result){
        res = result.split(",");
        if(res[0]=="0"){
          swal("Error",res[1],"error")
        }
        else if(res[0]=="1"){
          swal("Success",res[1],"success");
          //$("#lnknewemp").click();
        }
      },
      error:function(eobj,etxt,err){
        console.log(etxt);
      }

      });

    });

  });
</script>
-->



<!--
<script type="text/javascript">
  $(document).ready(function() {

    fetch_data();

    function fetch_data(){
      $.ajax({
        url:"fetch.php",
        method:"POST",
        success:function(data)
        {
          $('tbody').html(data);
        }
      });
    }

    $('#SaveBooking').on('button',function(event){
      event.preventDefault();
      if($('#txt_npqty').val() == ''){
        swal("Error",res[1],"error")
      }
      else if($('#txt_npname').val() == ''){
        swal("Success",res[1],"success");
      }
      else
      {
        $.ajax({
          url:"lib/mod_np_booking?type=getNPSave",
          method:"POST",
          data:$(this).serialize(),
          success:function(data){
            alert(data);
            $('#SaveBooking')[0].reset();
            fetch_data();
          }
        })
      }
    });

  });
</script>  --> 
<!--
<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewemp").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_emp.php?type=viewEmployee",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"},
          {"data":"3"},
          {"data":"4"},
          {"data":"5"}
        ],
        "columnDefs":[
          {
            "data":null,
            "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
            "targets":5
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
            "targets":6
          }
        ]
    });
    $("#tblviewemp tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
        var type= $(this).attr('title');
        var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
        var eid = data[0];
        if(type=="Edit"){
            $("#rpanel").load("view/updateemp.php?empid="+eid);
        }else if(type=="Delete"){
            swal({
            title:"Do you want to Remove this Employee?",
            text:"You are trying to Remove Employee:"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
              if(willDelete){
                var url = "lib/mod_emp.php?type=deleteEmp";
                $.ajax({
                  method:"POST",
                  url:url,
                  data:{empid:eid},
                  dataType:"text",
                  success:function(result){
                    res = result.split(",");
                    if(res[0]=="0"){
                      swal("Error",res[1],"error")
                    }
                    
                    else if(res[0]=="1"){         
                      swal("Success",res[1],"success");
                      $("#lnkviewemp").click();
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
</script>    -->

<!--<script type="text/javascript">
    $(function(){  
    $("#btnreg").click(function(){
      var npname = $("#txtname").val();
      var npqty = $("#dtpdob").val();

      if(npname==""){
        swal("Required Field ","Please Select Newspaper","error");
        return;
      }

      if(npqty==""){
        swal("Required Field ","Please Enter Newspaper Quantity","error");
        return;
      }
      
      var fdata = $('form').serialize();
      var url = "lib/mod_np_booking.php?type=addNewNPSave";

      $.ajax({

      method:"POST",
      url:url,
      data:fdata,
      dataType:"text",
      success:function(result){
        res = result.split(",");
        if(res[0]=="0"){
          swal("Error",res[1],"error")
        }
        else if(res[0]=="1"){
          swal("Success",res[1],"success");
          $("#lnknewemp").click();
        }
      },
      error:function(eobj,etxt,err){
        console.log(etxt);
      }

      });

    });

  }); 
</script>  -->

