<?php
if(isset($_GET['npid'])){
    $newsp_id =$_GET['npid'];
    $npname = $_GET['npname'];
    $qty = $_GET['qty'];
}
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#" class="text-dark" onclick="funViewStock()">GRN Management</a></li>            
  <li class="breadcrumb-item active">View Batch Details</li>
</ol>

<div class="container">

</div>

<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col-lg-5 form-label">Newspaper ID</label>
            <input type="text" class="col-lg-6 form-control form-control-plaintext readonly " readonly="readonly"    id="npid" name="npid" value="<?php echo($newsp_id) ?>" >
        </div>
    </div>

    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col form-label">Newspaper</label>
            <input type="text" class="col form-control form-control-plaintext  " readonly="readonly" id="np_name" name="np_name" value="<?php echo($npname) ?>">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col form-label">Total Quantity</label>
            <input type="text" class="col form-control form-control-plaintext  " readonly="readonly" id="np_qty" name="np_qty" value="<?php echo($qty) ?>">
        </div>
    </div>
</div>

<div class="m-2 border-dark">

    <!-- Content Row -->
    <div >
        <table id="tblviewbatch" class="table table-striped "  >
            <thead>
            <tr>
                <th>Batch ID</th>
                <th>Publication Company</th>
                <th>Cost Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Remaining Quantity</th>
                <th>Received Date</th>
                <th>Batch Status</th>

            </tr>
            </thead>

        </table>

    </div>

</div>

<script>
    $(document).ready(function(){
        $(this).scrollTop(0);
        var newsp_id =$("#npid").val();
        var dataTable = $("#tblviewbatch").DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "lib/mod_stock.php?type=viewBatch&newsp_id="+newsp_id,
                "type": "POST"
            },
            "columns": [
                {"data": "0"},
                {"data": "1"},
                {"data": "2"},
                {"data": "3"},
                {"data": "4"},
                {"data": "5"},
                {"data": "6"},
                {"data": "7"}
            ],
            "columnDefs":[
                {
                    "data":"7",
                    "render": function(data,type,row){
                        return(data=="1")?"<button title='status' class='btn btn-success'>Active</button>":"<button title='status'  class='btn btn-danger'>Inctive</button>";
                    },
                    "targets":7
                }
            ]
        });



    })
</script>
