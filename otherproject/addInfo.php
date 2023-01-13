<?php
session_start();
require_once '../dbconnect.php';

$err = [];

if (mysqli_connect_error()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$id = $_POST['id'];
$cou_name = $_POST['cou_name'];
$grade = $_POST['grade'];

$sql = "SELECT id FROM students WHERE id = '" . $id . "'";
$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));

if (mysqli_num_rows($result) != 1) {
    $err['err_id'] = "Invalid ID";
}

$q = "SELECT * FROM grades g INNER JOIN courses c on g.cou_name = c.cou_name WHERE c.cou_name = '" . $cou_name . "' AND g.stu_id = '" . $id . "'";
$r = mysqli_query(connect(), $q) or die(mysqli_error(connect()));
if (mysqli_num_rows($r) > 0) {
    $err['err_dup'] = "<p style='margin-left: 50px;'>Input must be duplicated</p>";
}

if (count($err) > 0) {
    $_SESSION = $err;
    header("Location: adminLogged.php");
    exit;
}

$query = "INSERT INTO grades(stu_id, cou_name, grade) VALUES('" . $id . "', '" . $cou_name . "', '" . $grade . "')";

$gradeResult = mysqli_query(connect(), $query) or die(mysqli_error(connect()));

if ($gradeResult === TRUE) {
    echo "<p style='margin: 20px; font-size: 20px;'>You successfully inserted '". $grade. "', '" .$cou_name. "', '" .$id. "' into the grades database</p>";
    echo "<a href=adminLogged.php style='margin: 20px;'>Go to admin page</a>";
} else {
    header("Location: adminLogged.php");
}