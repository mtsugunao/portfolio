<?php
session_start();
require_once '../dbconnect.php';
if(mysqli_connect_error()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$email = $_SESSION['email'];
$sql = "SELECT stu_id, fname, lname, cou_name, grade FROM grades LEFT OUTER JOIN students ON grades.stu_id =  students.id WHERE email = '".$email."'";
$display = '<a href=userLogged.php class=size>Go to user page</a>';
$result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));
if(mysqli_num_rows($result) <= 0){
    echo $display;
    ?> <p> <?php echo "You have not been graded yet"; ?></p>
        <?php
    exit();
}else {
    ?>
<html>
    <head>
        <link rel='stylesheet' href='table.css'>
        <title>Grade Output</title>
    </head>
    <style>
        body {
            background-color: whitesmoke;
        }
    </style>
    <body>
        <a href="userLogged.php">Go to user page</a>
        <h3>
            Grades from three table: students, grades, courses joined with student ID and course ID.
        </h3>
        <table border="1">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Course Name</th>
                <th scope="col">Grade</th>
            </tr>
<?php
while($row = mysqli_fetch_assoc($result)){
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
<?php } 