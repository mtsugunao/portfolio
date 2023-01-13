<?php
require_once 'dbconnect.php';
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$sql = "SELECT `First Name`, `Last Name`, email, `Phone` FROM info";
$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));
if(mysqli_num_rows($result) <= 0){
	echo "There is no records in the database";
	exit();
}else{
?>
<html>
<head>
<link rel='stylesheet' href='otherproject/table.css'>
<title>Output</title>
</head>
<body>
	<a href="index.html">Go to Home</a><br>
	<h2>Information in the Database</h2>
	<table border="1">
		<tr>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">Email</th>
			<th scope="col">Phone</th>
		</tr>
<?php
	while ($row = mysqli_fetch_assoc($result)){
?>
		<tr>
			<td><?php echo $row["First Name"] ?></td>
			<td><?php echo $row["Last Name"]; ?></td>
			<td><?php echo $row["email"]; ?></td>
			<td><?php echo $row['Phone']; ?></td>
		</tr>
	<?php } ?>
	</table>
</body>
</html>
<?php } ?>