<?php
require_once("dbconnection.php"); 

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}

function getNewOrderId(){  
  $dbobj = DB::connect();
  $sql = "SELECT sample_id FROM tbl_sample_data ORDER BY sample_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

  $dbobj->close();
  
}

function getInvId(){
  $dbobj = DB::connect();

  $cdate = date("Y-m-d",time());
  $sql = "SELECT count(inv_id) FROM tbl_invoice WHERE inv_date='$cdate';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
      echo("SQL Error : ".$dbobj->error);
      exit;
  }
  $row = $result->fetch_array();
  $count = $row[0];
  $count++;

  $newid = "INV".str_replace("-","",$cdate)."_".str_pad($count,4,"0",STR_PAD_LEFT);

  return $newid;
  $dbobj->close();
}

/*function getNPDetails(){
  $sampleid = $_POST["sampleid"];
  $qty = $_POST["qty"];
  $dbobj = DB::connect();

  $sql = "SELECT newsp_id,newsp_name,newsp_price FROM tbl_newspaper;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("0,SQL Error : ".$dbobj->error);
    exit;
  }

  $output = array();
  while($rec=$result->fetch_assoc()){
    $line = array(
    
      $line[0] = $rec["newsp_name"];
      $line[1] = $qty;
      $line[2] = $rec["newsp_price"];
      $output[] = $line;
      break;
 );   
    
  }
  echo(json_encode($output));
  $dbobj->close();
}*/

function getNewspaperCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_booking) AND newsp_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsp_id"]."'>".$rec["newsp_name"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getprice(){
  $newsp_id = $_POST['newsp_id'];
  $dbobj = DB::connect();
  $sql = "SELECT newsp_id,newsp_qty,newsp_name,newsp_price FROM tbl_newspaper WHERE newsp_id='$newsp_id';";
  $result =  $dbobj->query($sql);
  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }
  $row = $result->fetch_assoc();
  if($row==""){
        echo ("1");
  }else{
    echo (json_encode($row));
  }
  $dbobj->close();
}

function getNPSave(){
  //$id = $_GET[""];
  $name = $_POST["txt_npname"];
  $qty = $_POST["txt_npqty"];

   $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_sample_data (newsp_id,sample_qty) VALUES (?,?);";

      $stmt = $dbobj->prepare($sql);
      $stmt->bind_param("si",$name,$qty);

        if(!$stmt->execute()){
        echo("0,SQL Error : ".$stmt->error);
        }
        else{

        echo("1,Successfully Reserved!");
        }

        $stmt->close();
        $dbobj->close();
                
}

function viewSave(){
  //echo("viewEmp");
  // DB table to use
  $table = 'tbl_sample_data';
 
  // Table's primary key
  //$primaryKey = 'sample_id';

  $columns = array(
      array( 'db' => 'newsp_id', 'dt' => 0 ),
      array( 'db' => 'sample_qty',  'dt' => 1 ) 
  );

  // SQL server connection information
  require_once("config.php");
  $host = Config::$host;
  $user = Config::$db_uname;
  $pass = Config::$db_pass;
  $db = Config::$dbname;

  $sql_details = array(
      'user' => $user,
      'pass' => $pass,
      'db'   => $db,
      'host' => $host
  );

  require('ssp.class.php');
  
  echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey,$columns, null,"sample_status=1" )
  );
}
/*

// update Save
function updateEmp(){
  $emp_id = $_POST["txteid"];
  $emp_title = $_POST["cmbtitle"];
  $emp_name = $_POST["txtname"];
  $emp_dob = $_POST["dtpdob"];
  $emp_gender = $_POST["optgen"];
  $emp_address = $_POST["txtaddress"];
  $emp_tel = $_POST["txttel"];
  $emp_email = $_POST["txtemail"];
  $emp_nic = $_POST["txtnic"];
  $emp_doj = $_POST["dtpdoj"];


  $dbobj = DB::connect();

  $sql = "UPDATE tbl_employee SET emp_title=?, emp_name=?, emp_dob=?, emp_gender=?, emp_address=?, emp_mobile=?, emp_email=?, emp_nic=?, emp_doj=? WHERE emp_id=?";

  /*$sql = "UPDATE tbl_employee SET emp_title='$emp_title', emp_name='$emp_name', emp_dob='$emp_dob', emp_gender='$emp_gender', emp_address='$emp_address', emp_mobile='$emp_tel', emp_email='$emp_email', emp_nic='$emp_nic',emp_doj='$emp_doj' WHERE emp_id='$emp_id'";*/

  /*$sql = "INSERT INTO tbl_employee(emp_id,emp_title,emp_name,emp_dob,emp_gender,emp_address,emp_mobile,emp_email, emp_nic,emp_doj) VALUES(?,?,?,?,?,?,?,?,?,?);";*/

 /*

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ississssss",$emp_title,$emp_name,$emp_dob,$emp_gender,$emp_address,$emp_tel,$emp_email,$emp_nic,$emp_doj,$emp_id);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}
*/
function deleteSave(){
  $sampleid = $_POST["sampleid"];
  
  $dbobj = DB::connect();
  $sql = "UPDATE tbl_sample_data SET sample_status=0  WHERE sample_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("s",$sampleid);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    /*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_employee WHERE emp_id=?)";
    $stmt_new= $dbobj->prepare($sql_new);
    $stmt_new->bind_param("s",$sampleid);
    $stmt_new->execute();
    $stmat_new->close();*/
    echo("1,Successfully Removed!");
  }
  $stmt->close();
  $dbobj->close();


}


/*function getNPSave(){
  $dbobj = DB::connect();
  $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper;";

  $statement = $connect->prepare($sql);

  $statement->execute();

  $result = $statement->fetchAll();
}*/


/*----------------------Add New Invoice --------------------------   */
function addNewsPaperBooking(){
  session_start();
  $cus_id = $_SESSION['session_cus']['cus_id'];
  $total_qty = $_POST['totqty'];
  $total_price = $_POST['txtntot'];
  $inv_type = "offline";
  $status ="1";  
  // $payid = getPayId();
  $crnt_date = date("Y-m-d");
  $inv_time = date("H:m:s");

  $newsp_id = $_POST['newsp_id'];
  $newsp_name = $_POST['newsp_name'];
  $np_book_qty = $_POST['newsp_qty'];
  $order_date = $_POST['order_date'];
  $np_tot_price = $_POST['newsp_total_price'];

  $dbobj= DB::connect();

  
  
  
  $sql_order = "INSERT INTO tbl_newspaper_booking_details (cus_id,crnt_date,total_qty,total_price,npbook_status) VALUES ('$cus_id','$crnt_date','$total_qty','$total_price','$status')";

  $stmt_order =$dbobj->prepare($sql_order);
  if(!$stmt_order->execute()){
      echo ("0,SQL Error ".$stmt_order->error);
  }else{
      $row = count($newsp_id = $_POST['newsp_id']);

      $npbook_details_id= mysqli_insert_id($dbobj);
      
      for($i=0; $i<$row; $i++){

          // $nodays = $nodays[$i]." days";
          // $warrenty =date("Y-m-d", strtotime($inv_date. $nodays)); //warrenty expire date
          $sql_prod = "INSERT INTO tbl_newspaper_booking (cus_id,npbook_details_id,newsp_name,np_book_qty,np_order_time,crnt_date,order_date,np_tot_price,np_book_status) VALUES (?,?,?,?,?,?,?,?,?)";
          $stmt_prod =$dbobj->prepare($sql_prod);
          $stmt_prod->bind_param("iisisssdi",$cus_id,$npbook_details_id,$newsp_id[$i],$np_book_qty[$i],$inv_time,$crnt_date,$order_date[$i],$np_tot_price[$i],$status);
          if(!$stmt_prod->execute()){
               echo ("0,SQL Error ".$stmt_prod->error);
          }
           

      }
      // $sql_pay ="INSERT INTO tbl_payment (pay_id,inv_id,pay_amount,pay_date,pay_time,pay_type) VALUES ('$payid','$inv_id','$txtntot','$paydate','$inv_time','$inv_type')";
      //         $result_pay = $dbobj->prepare($sql_pay);
      //         if(!$result_pay->execute()){
      //             echo ("0,SQL Error ".$result_pay->error);
      //             exit;    
      //         }
        $inv_type="online";
        $inv_id = getInvId();
        $sql_inv ="INSERT INTO tbl_invoice (inv_id,cus_id,inv_date,inv_qty,inv_total,inv_type,inv_status) VALUES (?,?,?,?,?,?,?)";
        $result_inv = $dbobj->prepare($sql_inv);
        $result_inv->bind_param("sisidsi",$inv_id,$cus_id,$crnt_date,$total_qty,$total_price,$inv_type,$status);
        if(!$result_inv->execute()){
          echo ("0,SQL Error ".$result_inv->error);
            exit;    
        }
       
      echo("1,Invoice created");

  }
  $stmt_order->close();
  $dbobj->close(); 

}

?>