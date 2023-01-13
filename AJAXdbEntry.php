<?php
require_once 'dbconnect.php';
//session_start();
//include 'login-info.php';


if(mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
} else {
    // filter variables before entering into database to prevent SQL injection
    $email = filter_input(INPUT_POST,'email');
    //Validating at Server side if it is  validated email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    // create database insert query and insert it into database
    $insert = "INSERT INTO post (email, ID) values ('$email', NULL)";
    $insertResult = mysqli_query(connect(), $insert) or die(mysqli_error(connect()));

    // define a response for AJAX
    $response = "";
    if ($insertResult) {
        $response = "Email successfully inserted!";
    } else {
        $response = "Entry not added";
    }
    echo $response;
        
    } else {
    echo "Invalid email format.";
    }
}
$conn->close();
?>