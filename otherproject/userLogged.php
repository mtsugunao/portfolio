<?php session_start() ?>
<html>
    <head>
        <link rel='stylesheet' href='admin.css'>
        <title>User Logged in</title>
    </head>
            <?php echo $_SESSION['msg']; //showing only once seesion key is unset after reload.?>
            <?php unset($_SESSION['msg']); ?>
            <form method="post" action="stu_info.php">
                <div style="border: #ffb6c1 solid 1px; font-size: 26px; padding: 20px; box-shadow: #fceff2 0 0 10px; margin-bottom: 10px; margin-left: 50px; background: #fceff2;">Account Information</div>
            <input type="submit" name="submit" value="Retrieve" class="btns">
            </form>
            <form method="post" action="grade.php">
                <div style="border: #ffb6c1 solid 1px; font-size: 26px; padding: 20px; box-shadow: #fceff2 0 0 10px; margin-bottom: 10px; margin-left: 50px; background: #fceff2;">All grades</div>
            <input type="submit" name="submit" value="Retrieve" class="btns">
            </form>   
            <form action="logout.php" method="post">
                <input type="submit" name="logout" value="Logout" class="btns">
            </form>
    </body>