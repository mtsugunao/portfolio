<?php
session_start();
$err = $_SESSION;

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' href='admin.css'>
        <title>Administrator Login</title>
    </head>
    <body>
        <p class='label'><?php echo $err['fullName']; //showing only once seesion key is unset after reload.   ?></p>
        <?php unset($_SESSION['fullName']); ?>
        <form method="post" action="adminStuInfo.php">
            <div class="cp_iptxt">
                <label style='font-size: 26px'>Retrieve all students information</label>
            </div>
            <input type="submit" name="submit" value="Retrieve" class="btns">
        </form>

        <form method="post" action="searchStuById.php">
            <div class="cp_iptxt">
                <label class='ef'>
                    <input type="number" placeholder="Search grade by Student ID" name='id'>
                </label>
            </div>
            <input type="submit" name="submit" value="Serach grade By ID" class="btns">
        </form>

        <form method="post" action="searchByName.php">
            <p  class='label'>Search by Student Name</p>
            <div class="cp_iptxt">
                <label class="ef">
                    <input type="text" placeholder="First Name" name='fname'>
                </label>
            </div>
            <div class="cp_iptxt">
                <label class="ef">
                    <input type="text" placeholder="Last Name" name='lname'>
                </label>
            </div>
            <input type="submit" name="submit" value="Serach By Name" class="btns">
        </form>

        <form method="post" action="addInfo.php">
            <p class='label'>Insert student grade into database.</p>
            <?php
            if(isset($err['err_dup'])){
                echo $err['err_dup'];
            }
            ?>
            <div class='cp_iptxt'>
                <label class="ef">
                    <input type="number" placeholder="ID" name='id' required>
                    <?php
                    if (isset($err['err_id'])) {
                        echo "<br>".$err['err_id'];
                    }
                    ?>
                </label>
            </div>
            <div class='cp_iptxt'>
                <label class="ef">
                <select name="cou_name" required>
		            <option value="">choose Course Name</option>
		            <option value="COSC109">COSC109</option>
		            <option value="COSC131">COSC131</option>
		            <option value="COSC111">COSC111</option>
		            <option value="COSC121">COSC121</option>
                    <option value="COSC126">COSC126</option>
                    <option value="COSC118">COSC118</option>
                    <option value="COSC213">COSC213</option>
                    <option value="COSC219">COSC219</option>
                    <option value="COSC222">COSC222</option>
                    <option value="COSC236">COSC236</option>
                    <option value="COSC304">COSC304</option>
                    <option value="COSC205">COSC205</option>
                    <option value="COSC211">COSC211</option>
                    <option value="COSC224">COSC224</option>
                    <option value="COSC231">COSC231</option>
                    <option value="COSC315">COSC315</option>
		        </select>
                    <?php
                    if (isset($err['err_cou'])) {
                        echo "<br>".$err['err_cou'];
                    }
                    ?>
                </label>
            </div>
            <div class='cp_iptxt'>
                <label class="ef">
                    <input type="number" step="0.1" name="grade" placeholder="Grade" required>
                </label>
            </div>
            <input type="submit" name="submit" value="Insert" class="btns"> 
        </form>

        <form action="logout.php" method="post">
            <input type="submit" name="logout" value="Logout" class="btns">
        </form>
    </body>
</html>
