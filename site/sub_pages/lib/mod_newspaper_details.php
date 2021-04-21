<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
  $type = $_GET["type"];
  $type();
}


function viewNewsPaper(){ 
  $table = <<<EOT
  (SELECT news.newsp_id,pub.pub_name,cat.npcat_category,npdet.np_medium,news.newsp_name,news.newsp_price,news.newsp_status 
  FROM tbl_newspaper news 
  JOIN tbl_newspaper_category cat ON news.npcat_id = cat.npcat_id
  JOIN tbl_newspaper_details npdet ON news.np_det_id = npdet.np_det_id 
  JOIN tbl_pub_company pub ON news.pub_id = pub.pub_id WHERE 
  news.newsp_status=1 ORDER BY newsp_id ASC
    ) temp
EOT;
 
	// Table's primary key
  $primaryKey = 'newsp_id';
  
  $columns = array(
	array( 'db' => 'newsp_id', 'dt' => 0 ),
  array( 'db' => 'newsp_name', 'dt' => 1 ),
	array( 'db' => 'npcat_category',  'dt' => 2 ),
	array( 'db' => 'pub_name',  'dt' => 3 ),
  array( 'db' => 'np_medium',  'dt' => 4 ),
  array( 'db' => 'newsp_price',  'dt' => 5 )
  );

	// SQL server connection information
  require_once("config.php");
  $host = Config::$host;
  $user = Config::$db_uname;
  $pass = Config::$db_pass;
  $db = Config::$dbname;

  $sql_details = array(
    'user' => $user,
    'pass' => $pass,
    'db'   => $db,
    'host' => $host
  );

  require('ssp.class.php');
 
  echo json_encode(
  SSP::complex($_POST, $sql_details, $table, $primaryKey,$columns, null,"newsp_status=1")
  );
}

?>