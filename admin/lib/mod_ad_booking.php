<?php 
require_once("dbconnection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}

function viewadbooking(){

	$table = <<<EOT
	(SELECT  
	adb.ad_book_id,np.newsp_name,npm.newsad_mode,cus.cus_name,adb.adpub_date,
	adb.ad_tot_price,adb.ad_pay_status,adb.ad_book_status FROM tbl_ad_booking adb
	JOIN tbl_reg_customer cus ON adb.cus_id = cus.cus_id
	JOIN tbl_newspaper np ON np.newsp_id = adb.newsp_id
	JOIN tbl_news_ad_mode npm ON npm.newsad_mode_id = adb.newsad_mode_id 
	ORDER BY ad_book_id
	  ) temp
EOT;
	


	//echo("viewEmp");
	// DB table to use
	//$table = ' tbl_ad_booking';
 
	// Table's primary key
	$primaryKey = 'ad_book_id';

	$columns = array(
	    array( 'db' => 'ad_book_id','dt' => 0 ),
	    array( 'db' => 'cus_name','dt' => 1 ),
	    array( 'db' => 'newsad_mode','dt' => 2 ),
	    array( 'db' => 'newsp_name','dt' => 3 ),
	    array( 'db' => 'adpub_date','dt' => 4 ),
	    array( 'db' => 'ad_tot_price','dt' => 5 ),
	    array( 'db' => 'ad_pay_status' , 'dt' => 6),
	    array( 'db' => 'ad_book_status','dt' => 7 )
		
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

function viewadBookingDetails(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "SELECT * FROM tbl_ad_booking book, tbl_newspaper np, tbl_reg_customer cus, tbl_news_ad_mode adm, 
	tbl_ad_colour cl, tbl_news_ad_category adc, tbl_news_adcat_type act, tbl_ad_modes_details admdet 
	WHERE book.cus_id=cus.cus_id AND book.newsp_id=np.newsp_id AND book.newsad_mode_id=adm.newsad_mode_id 
	AND book.adcolour_id=cl.adcolour_id AND book.newsac_id=adc.newsac_id AND 
	book.adcattype_id=act.adcattype_id AND book.admode_details_id=admdet.admode_details_id AND 
	book.ad_book_id='$booking_id';";

	$result = $dbobj->query($sql);

	$output = "";

	while($row = $result->fetch_assoc()){
		$output .= "<label class=\"col-xs-5 control-label\">Booking ID:</label>";
		$output .= "<p class=\"form-control-static\">" . $row['ad_book_id'] . "</p>";

		$output .= "<label class=\"col-xs-5 control-label\">Customer name : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Mobile number : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_mobile']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Advertisment Mode : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsad_mode']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Advertisment Colour: </label>";
		$output .= "<p class=\"form-control-static\">".$row['adcolour_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsp_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper Ad Category : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsac_category']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper Ad Category Type : </label>";
		$output .= "<p class=\"form-control-static\">".$row['adcattype_desc']."</p> ";


		$output .= "<label class=\"col-xs-5 control-label\">Advertisment Size : </label>";
		$output .= "<p class=\"form-control-static\">".$row['admode_details_size']."</p> ";
	
		$output .= "<label class=\"col-xs-5 control-label\">Booked Date : </label>";
		$output .= "<p class=\"form-control-static\">".$row['crnt_date']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Publish date : </label>";
		$output .= "<p class=\"form-control-static\">".$row['adpub_date']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Ad Description : </label>";
		$output .= "<p class=\"form-control-static\">".$row['ad_description']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Word Count : </label>";
		$output .= "<p class=\"form-control-static\">".$row['ad_wc']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Total Price : </label>";
		$output .= "<p class=\"form-control-static\">".$row['ad_tot_price']."</p> ";
	}

	echo $output;
}


function AdviewSlip(){
			$ad_book_id = $_POST['ad_book_id'];
			$dbobj=DB::connect();

			$sql = "SELECT ad_img_slip FROM tbl_ad_booking WHERE ad_book_id=$ad_book_id;";

			$result = $dbobj->query($sql);

			$output = "";

			$row = $result->fetch_assoc();
			if($row['slip_img'] != ""){  //correct  the path
				$output .= "<img  class='img-thumbnail' src='../../dlab_admin_edit/images/Bankslips/Event_slips/" . $row['slip_img'] . "' />";
			}else{
				$output .="<i>No Image Uploaded!</i>";
			}
			echo $output;
}


function confirmNPBooking(){
	$booking_id = $_POST['event_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_ad_booking SET ad_book_status=1 WHERE ad_book_id=$booking_id";

	if(!$dbobj->query($sql)){
		echo("0,SQL Error :Approve:".$sql->error);
		exit;
	}
	else{
		$sql_bk_details = "INSERT INTO tbl_ad_order(cus_id,ad_book_id,newsad_mode,	adorder_date,publish_date,adorder_price,adorder_status)
							SELECT cus_id,ad_book_id,newsad_mode,crnt_date,adpub_date,ad_tot_price,ad_book_status
							FROM tbl_ad_booking
							WHERE ad_book_id=$booking_id";
		if($dbobj->query($sql_bk_details)){
			echo 1;
		}else{
			echo 0;
		}
	}


	//sendEmail($dbobj,$booking_id);// mail send to customer

	
}


function confirmfullpayment(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_ad_booking SET ad_pay_status=1 WHERE ad_book_id=$booking_id";

	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}

/*function approval(){
	$booking_id = $_POST['booking_id'];
	$dbobj = DB::connect();

	$sql = "UPDATE tbl_ad_booking SET ad_book_status=1 WHERE ad_book_id=$booking_id";

	if($dbobj->query($sql)){
		echo 1;
	}else {echo 0;
}
}*/



function deleteadbooking(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "DELETE FROM tbl_ad_booking WHERE ad_book_id = $booking_id";
	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}

?>