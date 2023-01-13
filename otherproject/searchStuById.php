<?php
session_start();

require_once '../dbconnect.php';
if (mysqli_connect_error()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$id = filter_input(INPUT_POST, 'id');
$sql = "SELECT stu_id, fname, lname, cou_name, grade FROM grades LEFT OUTER JOIN students ON grades.stu_id =  students.id WHERE students.id = '" . $id . "'";
$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));
if (mysqli_num_rows($result) <= 0) {
    ?>
    <a href="adminLogged.php">Go to Admin page</a><br>
    <?php
    echo "The student ID '" . $id . "' has not been graded or registered yet";
    exit();
} else {
    ?>
    <html>
        <head>
            <link rel='stylesheet' href='table.css'>
            <title>Searched by ID</title>
        </head>
        <style>
            body {
                background-color: whitesmoke;
            }
        </style>
        <body>
            <a href="adminLogged.php">Go to Admin page</a>
            <h2>
                Grade and Course searched by ID <?php echo "$id"; ?> 
            </h2>
            <table border="1">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Grade</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["stu_id"] ?></td>
                        <td><?php echo $row["fname"] ?></td>
                        <td><?php echo $row["lname"] ?></td>
                        <td><?php echo $row["cou_name"] ?></td>
                        <td><?php echo $row["grade"] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </body>
    </html>
    <?php
} 