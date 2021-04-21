<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
class Config{
	public static $host="localhost";
	public static $db_uname="root";
	public static $db_pass ="";	
	public static $dbname ="db_hemas2019";	

}

	class DB{
		public static function connect(){
			$host = Config::$host;
			$uname = Config::$db_uname;
			$pass = Config::$db_pass;
			$db = Config::$dbname;

			$dbobj = new mysqli($host,$uname,$pass,$db); // Connect Database

			if($dbobj->connect_errno){
				echo("DB Connection Error <br>");
				echo("Error Text :".$dbobj->connect_error);
				exit;
			}
			return $dbobj;

		}
	}

?>

?>