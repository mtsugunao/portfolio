<?php
require_once 'dbconnect.php';
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');

$sql = "INSERT INTO info VALUES('" .$fname. "', '" .$lname. "', '" .$email. "', '" .$phone. "', NULL)";
$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));


if($result === TRUE){
?>
<html>
<head>
<link rel='stylesheet' href='otherproject/table.css'>
<title>Data added</title>
</head>
<body>
	<p>New record created successfully</p><br>
	<table border="1">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone</th>
		</tr>
		<tr>
			<td><?php echo $fname; ?></td>
			<td><?php echo $lname; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $phone; ?></td>
		</tr>
	</table>
	<a href="output.php">Output ALL recordes in the database</a>
</body>
</html>
<?php } ?>