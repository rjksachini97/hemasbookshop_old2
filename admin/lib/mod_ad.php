<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}

/*
Following function generates a new employee id
eg. EMP00001
*/ 
function getNewAdId(){
  $dbobj = DB::connect();
  $sql = "SELECT newsa_id FROM tbl_newspaper_ad ORDER BY newsa_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$newid = "NEAD0001";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["newsa_id"];
	$num = substr($lastid, 4);
	$num++;
	$newid = "NEAD".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $newid; 
}

/*function getAdCat(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsac_id,newsac_category FROM tbl_news_ad_category WHERE newsac_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad)AND newsac_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsac_id"]."'>".$rec["newsac_category"]."</option>");
    }
  }
  $dbobj->close();  
} 

function getAdCatType(){
  $dbobj = DB::connect(); 
  $sql = "SELECT  adcattype_id,adcattype_desc FROM  tbl_news_adcat_type WHERE  adcattype_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad)AND adcattype_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec[" adcattype_id"]."'>".$rec["adcattype_desc"]."</option>");
    }
  }
  $dbobj->close();  
} */



function getPubCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT pub_id,pub_name FROM tbl_pub_company WHERE pub_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND pub_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["pub_id"]."'>".$rec["pub_name"]."</option>");
    }
  }
  $dbobj->close(); 
}


function getCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT npcat_id,npcat_category FROM tbl_newspaper_category WHERE npcat_id NOT IN (SELECT newsp_id FROM tbl_newspaper) AND npcat_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["npcat_id"]."'>".$rec["npcat_category"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getNewspaperCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsp_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
   
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsp_id"]."'>".$rec["newsp_name"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getModesofAd(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsad_mode_id,newsad_mode FROM tbl_news_ad_mode WHERE newsad_mode_id NOT 
  IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsad_mode_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsad_mode_id"]."'>".$rec["newsad_mode"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getAdColour(){
  $dbobj = DB::connect(); 
  $sql = "SELECT adcolour_id,adcolour_name FROM tbl_ad_colour WHERE adcolour_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["adcolour_id"]."'>".$rec["adcolour_name"]."</option>");
    }
  }
  $dbobj->close(); 
}




/*
Below function is used to insert new newspaer records to 
the tbl_newspaper
*/
function addNewAdvertisment(){

  $newsa_id = $_POST["txtadid"];
  $pub_id = $_POST["cmbnewspub"];
  $npcat_id = $_POST["cmbnpcategory"];
  $newsp_id = $_POST["cmbnpname"];
  $newsad_mode_id = $_POST["cmbnpadmode"];
  $adcolour_id = $_POST["cmbnpcolour"];
  $newsa_fwc = $_POST["txtfwc"];
  $newsa_fwcprice = $_POST["txtfwcprice"];
  $newsa_mwcprice = $_POST["txtmwcprice"];


  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_newspaper_ad(newsa_id,pub_id,npcat_id,newsp_id,newsad_mode_id,
  adcolour_id,newsa_fwc,newsa_fwcprice,newsa_mwcprice) VALUES(?,?,?,?,?,?,?,?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ssssssidd",$newsa_id,$pub_id,$npcat_id,$newsp_id,$newsad_mode_id,
  $adcolour_id,$newsa_fwc,$newsa_fwcprice,$newsa_mwcprice);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Added!");
  }
  $stmt->close();
  $dbobj->close();
}

function viewNewsPaperAd(){ 
  $table = <<<EOT

        (SELECT newsa.newsa_id,pub.pub_name,cat.npcat_category,news.newsp_name,admode.newsad_mode,adcol.adcolour_name,
        newsa.newsa_fwc,newsa.newsa_fwcprice,newsa.newsa_mwcprice,newsa.newsa_status FROM tbl_newspaper_ad newsa 
        JOIN tbl_newspaper_category cat ON newsa.npcat_id = cat.npcat_id 
        JOIN tbl_pub_company pub ON newsa.pub_id = pub.pub_id 
        JOIN tbl_newspaper news ON newsa.newsp_id = news.newsp_id 
        JOIN tbl_news_ad_mode admode ON newsa.newsad_mode_id = admode.newsad_mode_id 
        JOIN tbl_ad_colour adcol ON newsa.adcolour_id = adcol.adcolour_id WHERE newsa.newsa_status=1 ORDER BY newsa_id ASC
    ) temp

EOT;
 
	// Table's primary key
  $primaryKey = 'newsa_id';
  
  $columns = array(
	array( 'db' => 'newsa_id', 'dt' => 0 ),
  array( 'db' => 'newsad_mode', 'dt' => 1 ),
	array( 'db' => 'newsp_name',  'dt' => 2 ),
	array( 'db' => 'adcolour_name',  'dt' => 3 ),
  array( 'db' => 'newsa_fwc',  'dt' => 4 ),
  array( 'db' => 'newsa_fwcprice',  'dt' => 5 ),
  array( 'db' => 'newsa_mwcprice',  'dt' => 6 )
  	
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
  SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"newsa_status=1" )
  );
}

function getAd(){
  $newsadid = $_POST["newsadid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_newspaper_ad WHERE newsa_id='$newsadid';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }
  $rec = $result->fetch_assoc();
  echo(json_encode($rec));
  $dbobj->close();  
}

function getPubCompany(){
  $pubid = $_POST["pubid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_newspaper_ad WHERE pub_id='$pubid';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
  echo("SQL Error : ".$dbobj->error);
  exit;
  }
  $rec = $result->fetch_assoc();
  echo(json_encode($rec));
  $dbobj->close();  
}

// update newspaper
function updateAd(){

  $newsa_id = $_POST["txtadid"];
  $pub_id = $_POST["cmbnewspub"];
  $npcat_id = $_POST["cmbnpcategory"];
  $newsp_id = $_POST["cmbnpname"];
  $newsad_mode_id = $_POST["cmbnpadmode"];
  $adcolour_id = $_POST["cmbnpcolour"];
  $newsa_fwc = $_POST["txtfwc"];
  $newsa_fwcprice = $_POST["txtfwcprice"];
  $newsa_mwcprice = $_POST["txtmwcprice"];


  $dbobj = DB::connect();

  $sql = "UPDATE tbl_newspaper_ad SET pub_id=?, npcat_id=?, newsp_id=?, newsad_mode_id=?, adcolour_id=?, newsa_fwc=?, newsa_fwcprice=?, newsa_mwcprice=? WHERE newsa_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ssssssidd",$newsa_id,$pub_id,$npcat_id,$newsp_id,$newsad_mode_id,$adcolour_id,$newsa_fwc,$newsa_fwcprice,$newsa_mwcprice);
  
  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}
function deleteAd(){
	$newsadid = $_POST["newsadid"];
	
	$dbobj = DB::connect();
	$sql = "UPDATE tbl_newspaper_ad SET newsa_status=0  WHERE newsa_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$newsadid);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		/*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_deliveryman WHERE emp_id=?)";
		$stmt_new= $dbobj->prepare($sql_new);
		$stmt_new->bind_param("s",$delmid);
		$stmt_new->execute();
		$stmat_new->close();*/
	echo("1,Successfully Removed!");
	}
	$stmt->close();
	$dbobj->close();
} 

?>