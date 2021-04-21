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

    
    $sql = "SELECT count(pay_id) FROM tbl_payment;";

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
    ( SELECT inv.*, cus.cus_name FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id= cus.cus_id ORDER BY inv_date ASC
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
    
   

    $dbobj= DB::connect();

    
    
    
    $sql_inv = "INSERT INTO tbl_invoice (inv_id,cus_id,inv_date,inv_qty,inv_discount,inv_total,inv_paid, pay_id,inv_type, inv_status ) VALUES (
    '$inv_id','$cus_id','$inv_date','$totqty','$txtdis','$txtntot','$txtntot','$payid','$inv_type','$status')";

    $stmt_inv =$dbobj->prepare($sql_inv);
    if(!$stmt_inv->execute()){
        echo ("0,SQL Error ".$stmt_inv->error);
        exit();
    }
    $stmt_inv->close();
    $dbobj->close(); 

}




?>