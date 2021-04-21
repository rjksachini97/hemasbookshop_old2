<?php
require_once("config.php");  
if(isset($_GET["type"])){
    $type = $_GET["type"]; 
    $type();
}

function viewGrn(){  

    $table = <<<EOT
	( SELECT grn_id, pub_name, grn_rdate, grn_total, total_qty 
		FROM tbl_grn JOIN tbl_pub_company ON 
		tbl_grn.pub_id = tbl_pub_company.pub_id 
		ORDER BY tbl_grn.grn_id ASC
		) temp
EOT;

    $primary_key ="grn_id" ;

    $columns = array(
        array( 'db' => 'grn_id', 'dt' => 0 ),
        array( 'db' => 'pub_name',  'dt' => 1 ),
        array( 'db' => 'grn_rdate',   'dt' => 2 ),
        array( 'db' => 'total_qty',   'dt' => 3 ),
        array( 'db' => 'grn_total',   'dt' => 4 )
    );
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
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns)
    );

}

function getGrnNo(){
    $dbobj = DB::connect();

    $sql = "SELECT grn_id FROM tbl_grn ORDER BY grn_id DESC LIMIT 1";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ("SQL ERROR : ". $result->error);
        exit;
    }

    $nor = $result->num_rows;
    $grnId = "";
    if($nor=="0"){
        $grnId = "1";
    }else{
        $rec = $result->fetch_array();
        $grnId= $rec[0];
        $grnId= $grnId+1;
    }
    echo ($grnId);
    $dbobj->close();

}

/*------------------------get NP Category List----------------------*/
function getNPCategory(){
    $dbobj = DB::connect();

    $sql = "SELECT npcat_id, npcat_category FROM  tbl_newspaper_category;";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    $output .="<option value=''>  All</option>";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['npcat_id']."'>".$row['npcat_category']."</option>";
    }

    echo($output);
    $dbobj->close();
}

/*------------------------get NP List----------------------*/

function getNewspaper(){
    $npcat_id = $_POST["npcat_id"];
    $dbobj = DB::connect();

    $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE npcat_id='$npcat_id'";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['newsp_id']."'>".$row['newsp_name']."</option>";
    }
    $out="<option value=''>***Select Newspaper***</option>";
    echo($out.$output);
    $dbobj->close();
}


/*function getNewspaper(){
    $npcat_id = $_POST["npcat_id"];
    $dbobj = DB::connect();

    $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE npcat_id='$npcat_id'";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['newsp_id']."'>".$row['newsp_name']."</option>";
    }
    $out="<option value=''>***Select Newspaper***</option>";
    echo($out.$output);
    $dbobj->close();
}*/

function addNewGrn(){
    $grn_id = $_POST["grnid"];
    $rdate = $_POST["rdate"];
    $grn_pub = $_POST["selectPub"];
    $tbl_cat = $_POST["tbl_cat"];
    $tbl_np = $_POST["tbl_np"];
    $tbl_qty = $_POST["tbl_qty"];
    $tbl_cprice = $_POST["tbl_cprice"];
    $tbl_sprice = $_POST["tbl_sprice"];
    $bat_price = $_POST["bat_price"];
    $gtot = $_POST["txtgtot"];
    $ntot = $_POST["txtntot"];
    $totqty =$_POST['totqty'];
    $status = 1;

    $dbobj = DB::connect();

    $sql =  "INSERT INTO tbl_grn (grn_id,pub_id,grn_rdate,grn_total,total_qty,grn_status) VALUES ('$grn_id','$grn_pub','$rdate','$ntot','$totqty','$status')";

    $stmt = $dbobj->prepare($sql);

    if(!$stmt->exeute()){
    	echo("GRN SQL Error: ".$stmt->error);
    	exit;
    }else {
    	$rows = count($_POST['tbl_np']);
    	for($i=0; $i<$rows; $i++){
    		$bat_id = getBatchNo();
    		$sql_batch = "INSERT INTO tbl_batch(bat_id,grn_id,newsp_id,bat_cprice,bat_sprice,bat_qty,bat_rem,bat_rdate,total_price,bat_status) VALUES (?,?,?,?,?,?,?,?,?,?)";

    		$stmt_batch = $dbobj->prepare($sql_batch);
    		$stmt_batch->bind_param("sisddiisdi",$bat_id,$grn_id,$tbl_np[$i],$tbl_cprice[$i],$tbl_sprice[$i],$tbl_qty[$i],$tbl_qty[$i],$rdate,$bat_price[$i],$status);

    		if(!$stmt_batch->exeute()){
    			echo("Batch SQL Error: ".$stmt_batch->error);
    			exit;
    		}else{
    			$sql_np_upd = "UPDATE tbl_newspaper SET newsp_qty=newsp_qty+? WHERE newsp_id=?";

    			$stmt_np = $dbobj->prepare($sql_np_upd);
    			$stmt_np->bind_param("is",$tbl_qty[$i],$tbl_np[$i]);
    			if(!$stmt_np->exeute()){
    				echo ("NP SQL Error: ".$stmt_np->error);
    				exit;
    			}
    			$stmt_np->close();
    		}
    		$stmt_batch->close();
    	}
    	echo("1,GRN Successfully Added!");
    	$stmt->close();
    	$dbobj->close();
    }
}

function getBatchNo(){
	$dbobj = DB::connect();

	$sql = "INSERT INTO bat_id FROM tbl_batch ORDER BY bat_id DESC LIMIT 1";

	$result = $dbobj->query($sql);
	if ($dbobj->errno){
		echo("SQL Error :".$result->error);
		exit;
	}

	$nor = $result->num_rows;

	if($nor=="0"){
		$batId = "BAT00001";
	}else{
		$rec = $result->fetch_assoc();
		$lastId = $rec["bat_id"];
		$num = substr($lastId,3);
		$num++;
		$batId = "BAT".str_pad($num,5,"0",STR_PAD_LEFT);
	}

	$dbobj->close();
	return $batId;
}

function viewGrnDetail(){
    $grn_id = $_POST["grn_id"];
     $dbobj= DB::connect();
     $sql = "SELECT grn.grn_id,grn.grn_rdate,pub.pub_name FROM tbl_grn grn JOIN  tbl_pub_company pub ON grn.pub_id = pub.pub_id WHERE grn_id='$grn_id'  ;";
     
     $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $rec = $result->fetch_assoc();
    echo(json_encode($rec));
    $dbobj->close();

}

function viewDetails(){
    $grn_id = $_GET['grn_id'];

    $table = <<<EOT
    (SELECT bat_id,newsp_name,bat_cprice,bat_sprice,bat_qty,bat_rem,bat_rdate,bat_status 
    FROM tbl_batch JOIN tbl_newspaper 
    ON tbl_batch.newsp_id=tbl_newspaper.newsp_id 
    WHERE tbl_batch.grn_id='$grn_id'
    )temp

EOT;

    $primaryKey ='bat_id';

    $columns = array(
        array( 'db' => 'bat_id', 'dt'=> 0),
        array( 'db' => 'newsp_name', 'dt'=> 1),
        array( 'db' => 'bat_cprice', 'dt'=> 2),
        array( 'db' => 'bat_sprice', 'dt'=> 3),
        array( 'db' => 'bat_qty', 'dt'=> 4),
        array( 'db' => 'bat_rem', 'dt'=> 5),
        array( 'db' => 'bat_rdate', 'dt'=> 6),
        array( 'db' => 'bat_status', 'dt'=> 7)

    );
    require_once('config.php');
    $host = Config::$host ;
    $user = Config::$db_uname ;
    $pass = Config::$db_upass ;
    $db = Config::$db_name ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );


}

?>