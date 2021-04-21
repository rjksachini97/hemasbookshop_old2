<?php

if (isset($_POST["reset-request-submit"])) {

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "hemasbookshop/create_new_password.php?selector" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	require 'dbconnection.php';

	$userEmail = $_POST["email"];

	$sql = "DELETE FROM tbl_pwd_reset WHERE pwdreset_email=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		echo("There was an error!");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

	$sql = "INSERT INTO tbl_pwd_reset (pwdreset_email, pwdreset_selector, 	pwdreset_token, pwdreset_expires) VALUES (?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		echo("There was an error!");
		exit();
	}else{
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close();

	$to = $userEmail;

	$subject = 'Reset Your Password for Hemas Bookshop!';

	$message = '<p>We received a password reset request.The link to reset your password is below.If it did not make this request, you can ignore this email. </p>';

	$message


} else{
	header("Location:index.php");
}