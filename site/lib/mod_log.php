<?php
	/*require_once("dbconnection.php");
	$dbobj = DB::connect();

if(isset($_GET['ischecklogin'])){
	$cus_email = $_POST['email'];
	$cus_pass = md5($_POST['pass']);
	$sql = "SELECT * FROM tbl_reg_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	$resultlogin = $dbobj->query($sql);
	echo $resultlogin->num_rows;
	

}

elseif (isset($_POST['email'])){
	$cus_email = $_POST['email'];
	$cus_pass = md5($_POST['pass']);
	$sql = "SELECT * FROM tbl_reg_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	$resultlogin = $dbobj->query($sql);

	if($resultlogin->num_rows == 1){
		session_start();
		$_SESSION['session_cus'] = $resultlogin->fetch_assoc();
		header("Location: ../index.php#services");
	}
	
}*/

?> 

<?php
	require_once("dbconnection.php");
	$dbobj = DB::connect();


	if(isset($_POST['txtuname'])){
		$cus_email = $_POST['txtuname'];
		$cus_pass = md5($_POST['txtpass']);
		$sql = "SELECT * FROM tbl_reg_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
		$resultlogin = $dbobj->query($sql);
		$rows =$resultlogin->num_rows;
		$error = 0;
		if($rows > 0){
			session_start();
			$_SESSION['session_cus'] = $resultlogin->fetch_assoc();
			$error = 1;
			echo($error);
		}
		else{
			echo($error);
		}
	}
	// if(isset($_POST['txtuname'])){
	// 	$cus_email = $_POST['txtuname'];
	// 	$cus_pass = md5($_POST['txtpass']);
	// 	$sql = "SELECT * FROM tbl_reg_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	// 	$resultlogin = $dbobj->query($sql);
	// 	$rows =$resultlogin->num_rows;

	// 	if($rows > 0){
	// 		session_start();
	// 		$_SESSION['session_cus'] = $resultlogin->fetch_assoc();
	// 		echo ("1");
	// 		header("Location: ../index.php#services");
	// 	}else{
	// 		echo ($cus_pass.",".$rows);
	// 	}
	// }
?>