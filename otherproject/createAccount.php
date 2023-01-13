<?php
require_once '../dbconnect.php';

if (isset($_POST['submit'])) {
    $email = strtolower($_POST['email']);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $password = SHA1($_POST['password']);
        $program = strtoupper($_POST['program']);
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $date = date("y-m-d");
        $sql = "SELECT email FROM students WHERE email = '" . $email . "'";
        $result = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));

        if (mysqli_num_rows($result) === 1) {
            echo '<p style="margin-left: 45px;">The email address "' . $email . '" is already in use, try again!</p>';
        } else {
            $query = "INSERT INTO students(id, fname, lname, email, password, program, age, gender, startdate) VALUES"
                    . "(NULL, '" . $firstname . "', '" . $lastname . "', '" . $email . "', ('" . $password . "'), '" . $program . "', '" . $age . "',"
                    . "'" . $gender . "', '" . $date . "')";
            $res = mysqli_query(connect(), $query) or die(mysqli_error(connect()));
        }

        if ($res === TRUE) {
            echo '<p style="margin-left: 45px;">Your account "' . $email . '" has been created. Thank you for joining us!</p>';
            echo '<a href=login.php style="margin-left: 45px";>Go to login</a>';
        }
    } else {
        echo "Invalid email format";
    }
}
?>
<html>
    <head>
        <link rel='stylesheet' href='admin.css'>
        <title>User information</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
            <form method="POST" action="">
                <div style="border: #ffb6c1 solid 1px; font-size: 30px; padding: 20px; box-shadow: #fceff2 0 0 10px; margin: 10px; background: #fceff2;text-align: center;">User Information</div>
                <div class="cp_iptxt">
                    <label class='ef'>
                        <input type="text" placeholder="First Name" name='fname' required>
                    </label>
                </div>
                <div class="cp_iptxt">
                    <label class='ef'>
                        <input type="text" placeholder="Last Name" name='lname' required>
                    </label>
                </div>      
                <div class="cp_iptxt">
                    <label class='ef'>
                        <input type="text" placeholder="Email" name='email' required>
                    </label>
                </div>
                <div class="cp_iptxt">
                    <label class='ef'>
                        <input type="password" placeholder="Password" name='password' required>
                    </label>
                </div>
                <div class="cp_iptxt">
                    <label class='ef'>
                        <input type="text" placeholder="Program" name='program' required>
                    </label>
                </div>
                <div class="cp_iptxt">
                    <label class='ef'>
                        <input type="number" placeholder="Age" name='age' min="0" max="200" step="1" required>
                    </label>
                </div>
                <div class="cp_ipradio">
                    <input type="radio" name="gender" value="Male" id="a_rd1">
                    <label for="a_rd1">Male</label>
                    <input type="radio" name="gender" value="Female" id="a_rd2">
                    <label for="a_rd2">Female</label>
                </div>
                <p><input type="submit" name="submit" value="Create Account" class="btns"/></p>
            </form>
            <a href="login.php" style="margin-left: 45px;">Go back to login page</a>
    </body>
</html>