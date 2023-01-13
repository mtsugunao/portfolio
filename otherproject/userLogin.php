<?php
session_start();
require_once '../dbconnect.php';

$err = [];
//check for required fields from the form

 if(!$targetemail = filter_input(INPUT_POST, 'email')){
     $err['email'] = 'Invalid email'; 
 }
 
 if (!$targetpasswd = filter_input(INPUT_POST, 'password')) {
//if ((!isset($_POST["username"])) || (!isset($_POST["password"]))) {
     $err['password'] = 'Invalid password';
}

if(!filter_var($targetemail, FILTER_VALIDATE_EMAIL)){
    $err['err_email'] = 'Invalid useraccount format';
}


if(count($err) > 0){
    $_SESSION = $err;
    header("Location: login.php");
    exit;
}

$sql = "SELECT email, fname, lname, password FROM students WHERE email = '".$targetemail.
        "' AND password = SHA1('".$targetpasswd."')";
$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of f_name l_name
	while ($info = mysqli_fetch_array($result)) {
		$_SESSION["fname"] = stripslashes($info['fname']);
		$_SESSION["lname"] = stripslashes($info['lname']);
                $_SESSION['email'] = $targetemail;
                $_SESSION['password'] = true;
	}

	//set authorization cookie using curent Session ID
	setcookie("auth", session_id(), time()+60*30, "/", "", 0);

	//create display string
	$_SESSION['msg'] = "<p class='label' style='text-align: center';>Welcome ".$_SESSION["fname"]." ".$_SESSION["lname"].!"</p>"
                ." You successfully logged in!";
        header("Location: userLogged.php");
} else {
	header("Location: login.php");
	exit;
}