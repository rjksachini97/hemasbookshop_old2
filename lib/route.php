<?php  
session_start();
if(!isset($_SESSION["user"])){
    header("Location:../admin/index.php");
}
$utype=$_SESSION["user"]["type"];
$name=$_SESSION["user"]["uname"];
switch($utype){
    case "1" ;
        header("location:../admin/home.php");

        break;
    case "2";
        header("location:../admin/index.php");
}
?>