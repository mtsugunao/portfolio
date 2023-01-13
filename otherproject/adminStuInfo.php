<?php
session_start();

require_once '../dbconnect.php';
if (mysqli_connect_error()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "SELECT * FROM students";
$display = '<a href=adminLogged.php>Go to admin page</a><br>';

$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));
if (mysqli_num_rows($result) <= 0) {
    echo $display;
    echo "There is no records in the database";
    exit();
} else {
    ?>
    <html>
        <head>
            <link rel='stylesheet' href='table.css'>
            <title>Students Information</title>
        </head>
    <style>
        body {
            background-color: whitesmoke;
        }
    </style>
        <body>
            <?php echo $display; ?>
            <h2>
                Information in the students Database
            </h2>
            <table border="1">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Program</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Start Date</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["fname"] ?></td>
                        <td><?php echo $row["lname"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                        <td><?php echo $row["program"] ?></td>
                        <td><?php echo $row["age"] ?></td>
                        <td><?php echo $row["gender"] ?></td>
                        <td><?php echo $row["startdate"] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </body>
    </html>
<?php
} 