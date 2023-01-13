<?php
session_start();
require_once '../dbconnect.php';
$err = [];
//check for required fields from the form
 if(!$targetemail = filter_input(INPUT_POST, 'email')){
     $err['email'] = 'Invalid email'; 
 }
 if (!$targetpasswd = filter_input(INPUT_POST, 'password')) {
     $err['password'] = 'Invalid password';
}

if(!filter_var($targetemail, FILTER_VALIDATE_EMAIL)){
    $err['err_email'] = 'Invalid useraccount format';
}

if(count($err) > 0){
    $_SESSION = $err;
    	header("Location: administrator.php");
	exit;
}else{
//create and issue the query
$sql = "SELECT email, fname, lname, password FROM administrator WHERE email = '".$targetemail.
        "' AND password = SHA1('".$targetpasswd."')";

$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of f_name l_name
	while ($info = mysqli_fetch_array($result)) {
		$_SESSION["fname"] = stripslashes($info['fname']);
		$_SESSION["lname"] = stripslashes($info['lname']);
                $_SESSION["admin_email"] = $targetemail;
                $_SESSION["admin_password"] = $targetpasswd;
	}

	$_SESSION['fullName'] = "".$_SESSION["fname"]." ".$_SESSION["lname"]." successfully logged in as an administrator!";
	//set authorization cookie using curent Session ID
	setcookie("auth", session_id(), time()+60*30, "/", "", 0);

	//create display string
        header("Location: adminLogged.php");
        
} else {
	//redirect back to login form if not authorized
	header("Location: administrator.php");
	exit;
}
}
