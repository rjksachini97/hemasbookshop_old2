<?php      
require_once("dbconnection.php");
date_default_timezone_set("Asia/Colombo");

if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
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

    echo($newid);
    $dbobj->close();
}

function getPayId(){
    $dbobj = DB::connect();

    
    $sql = "SELECT count(npbookpay_id) FROM tbl_np_booking_pay;";

    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $row = $result->fetch_array();
    $count = $row[0];
    $count++;
    return $count;

    $dbobj->close();
}

/*----------------------check customer  --------------------------   */

function checkCustomer(){
    $email = $_POST['email'];
    $dbobj = DB::connect();
    $sql = "SELECT cus.cus_id,cus.cus_name,cus.cus_mobile FROM tbl_reg_customer cus WHERE cus.cus_email='$email';";
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

/*------------add new customer----------------*/

function addNewCustomer(){

    $ncus_email = $_POST['ncus_email'];
    $ncus_name = $_POST['ncus_name'];
    $ncus_mobile = $_POST['ncus_mobile'];
    $ncus_gender = $_POST['gender'];
    $ndtpdob =$_POST['ndtpdob'];
    $ncus_address =$_POST['ncus_address'];
    $ncus_nic = $_POST['$ncus_nic'];
    $status = 1;

    $dbobj= DB::connect();
    $sql = "INSERT INTO `tbl_customers` (`cus_name`,`cus_dob`,`cus_gender`,`cus_address`,`cus_mobile`,`cus_email`,`cus_nic`,`cus_status`)
 VALUES ('$ncus_name','$ndtpdob','ncus_gender','$ncus_address','$ncus_mobile','$ncus_email',$ncus_nic,'$status' );";

    $stmt =$dbobj->prepare($sql);
    if(!$stmt->execute()){
        echo ("0,SQL Error ".$stmt->error);
    }else{
        echo("1,Created successfully ");
    }
    $stmt->close();
    $dbobj->close();
}

function viewInvoice(){
    $table = <<<EOT
    ( SELECT inv.*, cus.cus_name FROM tbl_invoice inv JOIN tbl_reg_customer cus ON inv.cus_id= cus.cus_id ORDER BY inv_date ASC
        ) temp
EOT;

    $primary_key ="inv_id" ;

    $columns = array(
        array( 'db' => 'inv_id', 'dt' => 0 ),
        array( 'db' => 'cus_name',  'dt' => 1 ),
        array( 'db' => 'inv_date',  'dt' => 2 ),
        array( 'db' => 'inv_qty',   'dt' => 3 ),
        array( 'db' => 'inv_total',   'dt' => 4 ),
        array( 'db' => 'inv_paid',   'dt' => 5 ),
        array( 'db' => 'inv_type',   'dt' => 6 )
    );
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
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns)
    );
}

function viewInvDetails(){
   $inv_id = $_GET['inv_id'];

    $table = <<<EOT
    (SELECT inv.*,np.newsp_name FROM tbl_inv_details inv JOIN tbl_newspaper np ON inv.newsp_id=np.newsp_id WHERE inv.inv_id="$inv_id"
    )temp

EOT;

    $primaryKey ='inv_id';

    $columns = array(
        array( 'db' => 'newsp_id', 'dt'=> 0),
        array( 'db' => 'newsp_name', 'dt'=> 1),
        array( 'db' => 'newsp_cprice', 'dt'=> 2),
        array( 'db' => 'newsp_qty', 'dt'=> 3),
        array( 'db' => 'newsp_sprice', 'dt'=> 4)

    );
    require_once('config.php');
    $host = Config::$host ;
    $user = Config::$db_uname ;
    $pass = Config::$db_pass ;
    $db = Config::$dbname ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host,
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );



}

/*----------------------get Newspaer details  --------------------------   */
function getNewspaper(){
    $newspid = $_POST['newspid'];
    $dbobj = DB::connect();
    $sql = "SELECT np.newsp_id,np.newsp_name,np.newsp_qty,bat.bat_cprice,bat.bat_sprice,bat.bat_id FROM tbl_newspaper np INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE np.newsp_id = b.newsp_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) WHERE np.newsp_id='$newspid'";
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

/*----------------------Add New Invoice --------------------------   */
function addNewInv(){

    //$log_user = $_POST['log_user'];


    $inv_id = $_POST['inv_id']; 
    $inv_date = $_POST['inv_date'];
    
    $cus_id = $_POST['cus_id']; //customer ID
    $cus_mobile = $_POST['cus_mobile'];

    /*---------------------np Details------------*/

    $newsp_id = $_POST['tbl_id'];   //np id
    $batch_id = $_POST['bat_id'];
    $newsp_cprice = $_POST['tbl_cprice']; //pnp cost price    
    

    $tbl_sprice = $_POST['tbl_sprice']; // selling price
    $tbl_qty = $_POST['tbl_qty'];  // np quantuty  
    
    $totqty = $_POST['totqty']; // invoice total quantati
    $txtdis = $_POST['txtdis']; // invoice discount

    $txtntot = $_POST['txtntot']; // invoice total
    $inv_type = "offline";
    $status ="1";

    $payid = getPayId();
    $paydate = date("Y-m-d");
    $inv_time = date("H:m:s");
    
    $dbobj= DB::connect();

$sql_inv = "INSERT INTO tbl_invoice (inv_id,cus_id,inv_date,inv_qty,inv_discount,inv_total,inv_paid, pay_id,inv_type, inv_status ) VALUES (
    '$inv_id','$cus_id','$inv_date','$totqty','$txtdis','$txtntot','$txtntot','$payid','$inv_type','$status')";

    $stmt_inv =$dbobj->prepare($sql_inv);
    if(!$stmt_inv->execute()){
        echo ("0,SQL Error ".$stmt_inv->error);
        
    }
    else{
        $row = count($tbl_id = $_POST['tbl_id']);
        for($i=0; $i<$row; $i++){

            $sql_prod = "INSERT INTO tbl_inv_details (inv_id,newsp_id,newsp_cprice,newsp_qty,newsp_sprice,inv_det_status) VALUES (?,?,?,?,?,?)";

            $stmt_prod =$dbobj->prepare($sql_prod);
            $stmt_prod->bind_param("ssdidi",$inv_id,$tbl_id[$i],$newsp_cprice[$i],$tbl_qty[$i],$tbl_sprice[$i],$status);
            if(!$stmt_prod->execute()){
                 echo ("02,SQL Error ".$stmt_prod->error);
             }else{
                $res = updateStock($dbobj,$batch_id[$i],$tbl_id[$i],$tbl_qty[$i]);
                if ($res=="0"){
                    echo("0,Error on Batch update");
                    exit;
                }

             }

        }
        $sql_pay ="INSERT INTO tbl_np_booking_pay (npbookpay_id,inv_id,pay_amount,pay_date,pay_time,pay_type) VALUES ('$payid','$inv_id','$txtntot','$paydate','$inv_time','$inv_type')";
                $result_pay = $dbobj->prepare($sql_pay);
                if(!$result_pay->execute()){
                    echo ("0,SQL Error ".$result_pay->error);
                    exit;    
                }
        echo("1,Invoice created");

    }
    $stmt_inv->close();
    $dbobj->close(); 

}

/*----------------------Update Stock with invoice  --------------------------   */

function updateStock($dbobj,$batch_id,$tbl_id,$tbl_qty){
    $sql_batch = "UPDATE tbl_batch SET bat_rem=bat_rem-$tbl_qty WHERE bat_id='$batch_id';";
    $dbobj->query($sql_batch);
    if($dbobj->errno){
        return "0";
    }
    else{
        $sql_status = "UPDATE tbl_batch SET bat_status=0 WHERE bat_id='$batch_id' AND bat_rem=0;";
        $dbobj->query($sql_status);

        $sql_prod = "UPDATE tbl_newspaper SET newsp_qty=newsp_qty-$tbl_qty WHERE newsp_id='$tbl_id';";
        $dbobj->query($sql_prod);
        if($dbobj->errno)
            return "0";
        else
            return "1";
    }
}

/* --------------  add new Payments --------------*/
function addPayments(){
    $invid = $_POST['inv_id'];
    $cdate = $_POST['cdate'];
    $ctime =date('H:m:s');
    $amount = $_POST['pay_amount'];
    $type = "offline";
    

    $dbobj = DB::connect();
    $sql = "INSERT INTO tbl_np_booking_pay (inv_id,pay_amount,pay_date,pay_time,pay_type) VALUES('$invid','$amount','$cdate','$amount','$type')";
    $stmt = $dbobj->prepare($sql);
    if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
     }

    if(!$stmt->execute()){
        echo("0,Payment was not success");
    }else{
               
        $sql_inv = "UPDATE tbl_invoice SET inv_paid=inv_paid+$amount WHERE inv_id = '$invid';";
       
        $dbobj->query($sql_inv);

        if($dbobj->errno){
            echo("0,Payment was not success");
        }else{
            echo("1,Payment Is successfully added");
        }
    }
    $dbobj->close();
}





?>