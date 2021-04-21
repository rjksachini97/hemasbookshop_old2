<?php

function addNewspaperCart(){
	$dbobj = DB::connect();

	$userID = $_SESSION["session_cus"]["cus_id"];

	$newsp_id = $_POST['newspid'];
	$price = $_POST['price'];
	$batch_id = $_POST['batchid'];

	$sql = "INSERT INTO tbl_cart (cus_id,newsp_id,batch_id,newsp_price,status) VALUES ('$userID','$newspid','$batchid','$newspprice','1')";

 	$result = $dbobj->prepare($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}
	if(!$result->execute()){
		echo "0,Product not added try again";
	}else{
		echo "1,Product added, check cart";
	}
	
	$dbobj->close();
 }
}



function passSend(){
	$cusmsg = $_POST['message'];
	$cusname = $_POST['name'];
	$cusemail = $_POST['email'];
	$cusphone = $_POST['phone'];
	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'contactnesmo@gmail.com';          // SMTP username
	$mail->Password = 'nesmo1234'; // SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to

	$mail->setFrom('contactnesmo@gmail.com', 'Nesmo Contact');
	$mail->addReplyTo('contactnesmo@gmail.com', 'CodexWorld');
	$mail->addAddress('contactnesmo@gmail.com');   // Add a recipient
	$mail->addCC($cusemail);
	$mail->addBCC('contactnesmo@gmail.com');

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = '<h3>This is Message From Contact Form in Nesmo.lk</h3>'; // email Message Content
	$bodyContent .= '<p>Cus Name : '.$cusname.'<br>';
	$bodyContent .= 'Cus Email : '.$cusemail.'<br>';
	$bodyContent .= 'Cus Phone : '.$cusphone.'</p>';

	$mail->Subject = "Message From : ".$cusname;  // email header
	$mail->Body    = $bodyContent;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}

}


?>