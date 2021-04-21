<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}
/*function getNPDetails(){
	$dbobj = DB::connect();

	$sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_status=1;";

	 $result = $dbobj->query($sql);
$dbobj->close(); 
}*/
 
function viewnpbooking(){

	$table = <<<EOT
 		(SELECT book.np_book_id,cus.cus_id,np.newsp_name,book.np_book_qty,book.np_order_time,book.current_date,book.order_date,book.np_tot_price,book.np_pay_status,book.np_book_status 
 		FROM tbl_newspaper_booking book
		JOIN tbl_reg_customer cus ON book.cus_id = cus.cus_id
		JOIN tbl_newspaper np ON book.newsp_id = np.newsp_id WHERE
		book.np_book_status=1 ORDER BY np_book_id
  		) temp
EOT;
 
	//echo("viewEmp");
	// DB table to use
	//$table = ' tbl_newspaper_booking';
 
	// Table's primary key
	$primaryKey = 'np_book_id';

	$columns = array(
	    array( 'db' => 'np_book_id','dt' => 0 ),
	    array( 'db' => 'cus_id','dt' => 1 ),
	    array( 'db' => 'newsp_name','dt' => 2 ),
	    array( 'db' => 'np_book_qty','dt' => 3 ),
	    array( 'db' => 'np_order_time','dt' => 4 ),
	    array( 'db' => 'np_tot_price','dt' => 5 ),
	    array( 'db' => 'np_book_status','dt' => 6 ),
		array( 'db' => 'np_pay_status' , 'dt' => 7)
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

function viewBookingDetails(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "SELECT * FROM tbl_newspaper_booking book, tbl_newspaper np, tbl_reg_customer cus WHERE book.cus_id=cus.cus_id AND book.newsp_id=np.newsp_id AND book.np_book_id=$booking_id;";

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

function viewSlip(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "SELECT np_img_slip FROM tbl_newspaper_booking WHERE np_book_id=$booking_id;";

	$result = $dbobj->query($sql);

	$output = "";

	$row = $result->fetch_assoc();
	if($row['np_img_slip'] != ""){///correcr path
		$output .= "<img class='img-thumbnail' src='../..//images/Bankslips/Wedding_slips/" . $row['np_img_slip'] . "' />";
	}else{
		$output .="<i>No Image Uploaded!</i>";
	}
	echo $output;
}


function confirmBooking(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_newspaper_booking SET np_book_status=1 WHERE np_book_id=$booking_id";


	sendEmail($dbobj,$booking_id);// mail send to customer

	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}


function confirmfullpayment(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_newspaper_booking SET np_pay_status=1 WHERE np_book_id=$booking_id";

	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}

function deletebooking(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "DELETE FROM tbl_newspaper_booking WHERE np_book_id = $booking_id";
	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}

?>