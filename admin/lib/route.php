<?php
session_start();
if(!isset($_SESSION["user"])){
	header("Location:../index.php");  //create session for block unauthirized person
}

$utype = $_SESSION["user"]["type"];
$name=$_SESSION["user"]["uname"];

switch($utype){
	case "1"; 
		header("Location:../home.php");
		break;
	case "2";
		header("Location:../../manager/home.php");
		break;
	case "3";
		header("Location:../../publication/home.php");
		break;

}


            if($utype==1){
                echo "Admin";
            }else if($utype==2){
                echo "Manager";
            }else{
                echo "Employee ";
            }


?>