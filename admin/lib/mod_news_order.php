<?php require_once("dbconnection.php");    

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}

function viewNPOrders(){

	$table = <<<EOT
				( SELECT od.order_id,cus.cus_name,od.order_date,od.order_comp_date,
				od.order_price,od.order_status,od.delivery_status
					FROM tbl_newspaper_order od 
					JOIN tbl_reg_customer cus ON od.cus_id = cus.cus_id ORDER  BY order_id
				)temp
EOT;
				//Table's PrimaryKey
				$PrimaryKey = 'order_id';

				$coloumns = array(
					array('db' => 'order_id','dt' => 0 ),
					array('db' => 'cus_name','dt' => 1 ),
					array('db' => 'order_date','dt' => 2 ),
					array('db' => 'order_comp_date','dt' => 3 ),
					array('db' => 'order_price','dt' => 4 ),
					array('db' => 'order_status','dt' => 5 ),
					array('db' => 'delivery_status','dt' => 6 ),
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

}

/*
function viewNPOrders(){
	$table = <<<EOT
				( SELECT od.order_id,cus.cus_name,od.order_date,od.order_comp_date,od.order_price,od.order_status
					FROM tbl_newspaper_order od 
					JOIN tbl_reg_customer cus ON od.cus_id = cus.cus_id WHERE
					od.order_status=1 ORDER  BY order_id

				)temp
EOT;
				//Table's Primary Key
				$primaryKey = 'order_id';

				$coloumns = array(
					array('db' => 'order_id','dt' => 0 ),
					array('db' => 'cus_name','dt' => 1 ),
					array('db' => 'order_date','dt' => 2 ),
					array('db' => 'order_comp_date','dt' => 3 ),
					array('db' => 'order_price','dt' => 4 ),
					array('db' => 'order_status','dt' => 5 )
				);

				//SQL Server Connection Information
				require_once("config.php");
				$host = config::$host;
				$uname = config::$db_uname;
				$pass = config::$db_pass;
				$db = config::$dbname;

				$sql_details = array(
					'user' => $uname,
					'pass' => $pass,
					'db' => $db,
					'host' => $host					
				);

				require("ssp.class.php");

				echo json_encode(
				SSP::comploex($_POST, $sql_details, $table, $primaryKey, $coloumns, null, "order_status=1")
				);
}*/

function completeOrder(){
	$order_id = $_POST['order_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_newspaper_order SET order_status=1 WHERE order_id='$order_id' ";

	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
	$dbobj->close();
}

function viewNPOrderDetails(){
	$order_id = $_POST['order_id'];
	$dbobj=DB::connect();

	$sql = "SELECT * FROM tbl_newspaper_booking book, tbl_newspaper np, tbl_reg_customer cus WHERE book.cus_id=cus.cus_id AND book.newsp_id=np.newsp_id AND book.np_book_id=$order_id;";

	$result = $dbobj->query($sql);

	$output = "";

	while($row = $result->fetch_assoc()){
		$output .= "<label class=\"col-xs-5 control-label\">Booking ID:</label>";
		$output .= "<p class=\"form-control-static\">" . $row['np_book_id'] . "</p>";

		$output .= "<label class=\"col-xs-5 control-label\">Customer name : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Mobile number : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_mobile']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsp_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper Quantity : </label>";
		$output .= "<p class=\"form-control-static\">".$row['np_book_qty']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper Order Period : </label>";
		$output .= "<p class=\"form-control-static\">".$row['np_order_time']."</p> ";
	
		$output .= "<label class=\"col-xs-5 control-label\">Booked Date : </label>";
		$output .= "<p class=\"form-control-static\">".$row['current_date']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Delivery date : </label>";
		$output .= "<p class=\"form-control-static\">".$row['order_date']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Total Price : </label>";
		$output .= "<p class=\"form-control-static\">".$row['np_tot_price']."</p> ";
	}

	echo $output;
}



/*-------------------------Delivery Newspaper-------------------------*/
function getdeliveryman(){
	$dbobj ==DB::connect(); 
  $sql = "SELECT delm_id,delm_name FROM tbl_deliveryman WHERE delm_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
   $output = "<option>-- Select Deliveryman--</option>";
  // if($nor>0){
  //   while($rec = $result->fetch_assoc()){
  //     $output .= "<option value='".$rec["delm_id"]."'>".$rec["delm_name"]."</option>";
  //   }
  // }
  echo ($output);
  $dbobj->close(); 
}


?>