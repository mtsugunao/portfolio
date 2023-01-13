<?php
session_start();
if(!$logout = filter_input(INPUT_POST, 'logout')){
    exit('Invalid request');
}

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<title>Logged Out</title>
</head>
<body>
    <h2>You Logged out</h2>
    <a href="../index.html">Go to main page</a>
</body>
</html>