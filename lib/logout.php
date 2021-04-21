<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location:../admin/index.php");
    }
    unset($_SESSION["user"]);
    session_destroy();
    header("Location:../admin/index.php");

?>