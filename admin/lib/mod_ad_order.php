<?php   
require_once("dbconnection.php"); 

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}
 function viewAllAdOrders() {
 	$table = <<<EOT
 				(SELECT tbl_ad_order.adorder_id,tbl_reg_customer.cus_name,tbl_reg_customer.cus_mobile,tbl_ad_order.adorder_date,tbl_ad_order.publish_date,tbl_ad_order.adorder_price,tbl_ad_order.adorder_status,tbl_ad_order.email_status,tbl_ad_order.sms_status FROM `tbl_ad_order` JOIN tbl_reg_customer ON tbl_ad_order.cus_id= tbl_reg_customer.cus_id
 			)temp
EOT;


 			$primaryKey = 'adorder_id';

 				$columns = array(
	    			array( 'db' => 'adorder_id','dt' => 0 ),
	    			array( 'db' => 'cus_name','dt' => 1 ),
	    			array( 'db' => 'cus_mobile','dt' => 2 ),
	    			array( 'db' => 'adorder_date','dt' => 3 ),
	    			array( 'db' => 'publish_date','dt' => 4 ),
	    			array( 'db' => 'adorder_price','dt' => 5 ),
	    			array( 'db' => 'adorder_status','dt' => 6 ),
	    			array( 'db' => 'email_status','dt' => 7 ),
	    			array( 'db' => 'sms_status','dt' => 8 )
	    			
				);

				// SQL server connection information
				require_once("config.php");
				$host = Config::$host;
				$uname = Config::$db_uname;
				$pass = Config::$db_pass;
				$db = Config::$dbname;

				$sql_details = array(
    			'user' => $uname,
    			'pass' => $pass,
    			'db'   => $db,
    			'host' => $host
	);

	require('ssp.class.php');
 
	echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null)
	);
}

function completeAdOrder(){
	
}

//This is the function for sending SMS
function sendSMS(){
	$recipient = $_GET['contact'];

	$user = "94717228827"; //put your username
	$password = "4380"; //put your password
	$text = urlencode("This is an example message");
	$to = "$recipient";
	 
	$baseurl ="http://www.textit.biz/sendmsg";
	$url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
	$ret = file($url);
	 
	$res= explode(":",$ret[0]);
	 
	if (trim($res[0])=="OK")
	{
	echo "Message Sent - ID : ".$res[1];
	}
	else
	{
	echo "Sent Failed - Error : ".$res[1];
	}

}

 






/*function viewAllAdOrders(){ 

	$table = <<<EOT
				( SELECT ao.adorder_id,ao.adorder_date,ao.publish_date,ao.adorder_price,ao.adorder_status,cus.cus_name FROM tbl_ad_order ao JOIN tbl_reg_customer cus ON ao.cus_id = cus.cus_id WHERE ao.adorder_status=1
				)temp
EOT;
				//Table's PrimaryKey
				$PrimaryKey = 'adorder_id';

				$coloumns = array(
					array('db' => 'adorder_id','dt' => 0 ),
					array('db' => 'cus_name','dt' => 1 ),
					array('db' => 'adorder_date','dt' => 2 ),
					array('db' => 'publish_date','dt' => 3 ),
					array('db' => 'adorder_price','dt' => 4 ),
					array('db' => 'adorder_status','dt' => 5 )
				);

				//SQL Server Coonection Information
				require_once("config.php");
				$host = COnfig::$host;
				$uname = COnfig::$db_uname;
				$pass = COnfig::$db_pass;
				$db = Config::$dbname;

				$sql_details = array(
						'user' => $uname,
						'pass' => $pass,
						'db' => $db,
						'host' => $host,
				);

				require("ssp.class.php");

				echo json_encode(
				SSP::complex($_POST, $sql_details, $table, $PrimaryKey, $coloumns, null));

}*/

?>