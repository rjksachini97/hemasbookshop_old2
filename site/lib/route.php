<?php
session_start();
if(!isset($_SESSION["session_cus"])){
    header("Location:../index.php");
}else{
    header("Location: ../index.php#services");
}


?>