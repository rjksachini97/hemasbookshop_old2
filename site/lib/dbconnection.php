<?php
require_once("config.php");

class DB{
	public static function connect(){
		$host = config::$host;
		$uname = config::$db_uname;
		$pass = config::$db_pass;
		$db = config::$dbname;

		$dbobj = new mysqli($host,$uname,$pass,$db);

		if ($dbobj->connect_errno){
			echo("DB connection error <br>");
			echo("Error text : ".$dbobj->connect_error);
			exit;
			
		}
		return $dbobj;
	}
}
?>