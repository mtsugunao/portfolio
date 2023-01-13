<?php
require_once 'env.php';
function connect(){
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
   
    $mysqli = mysqli_connect($host, $user, $pass, $db);
    if(mysqli_connect_error()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }else {
        return $mysqli;
    }
}