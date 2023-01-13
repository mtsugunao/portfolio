<?php
session_start();

if(isset($_SESSION['admin_email']) && isset($_SESSION['admin_password'])){
    header('Location: adminLogged.php');
}
$err = $_SESSION;

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='login.css'>
<title>Administrator Login Form</title>
</head>
<body>
    <div class="login">
    <div "login-triangle"></div>
    <h2 class="login-header">Login as Administrator</h2>
        <form method="post" action="adminLogin.php" class="login-container">
            <p><input type="text" title="username" placeholder="username" name="email" required/></p>
            <?php if(isset($err['err_email'])){ ?>
            <p><?php echo $err['err_email']; ?></p>
            <?php }else if(isset($err['email'])){ ?>
            <p><?php echo $err['email']; ?></p>
            <?php } ?>
            <p><input type="password" title="username" placeholder="password" name="password" required/></p>
            <?php if(isset($err['password'])) : ?>
            <p><?php echo $err['password']; ?></p>
            <?php endif; ?>
        <p><input type="submit" name="submit" value="Login" /></p>
        <a href="../index.html">Go back to Main Page</a>
        </form>
    </div>
</body>
</html>