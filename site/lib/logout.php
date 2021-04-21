
<?php
// Initialize the session
session_start();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ../index.php");
exit;
?>
<!--
<?php
//session_start();
//if(isset($_GET["type"])){
	//$type = $_GET["type"];
	//$type();
//}

//function logout(){ 
	//if (!isset($_SESSION["user"])){
		//header("location:../index.php");
//}

//unset($_SESSION["user"]);
//session_destroy();
//header("location:../index.php");
//}
?>  
-->