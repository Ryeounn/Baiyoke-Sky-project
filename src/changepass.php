<?php
session_start();
require_once '../Classes.php';
require_once '../dbconnect.php';
$classer = new Classes();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Change Password</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="forget">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="acount-title">Change Password</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><a class="slide-home" href="account.php"> Account </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Change Password</b>
                    </div>
                </div>
                <?php
                if(isset($_POST['change']) && ($_POST['change'])){
                    $old = $_POST['oldpass'];
                    $new = $_POST['newpass'];
                    $confirm = $_POST['cpass'];
                    
                    if($old === $_SESSION['forget'][2] && $new == $confirm){
                        $result = $classer->updatePassword($conn, $_SESSION['forget'][1], $confirm, $_SESSION['forget'][2]);
                        unset($_SESSION['forget']);
                        echo '<Script>alert("Change Password Successfully");window.location = "account.php";</script>';
                    }else{
                        echo '<Script>alert("Change Password Successfully");window.location = "changepass.php";</script>';
                    }
                }
                ?>
                <div class="row margin-top-one">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form class="signup_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                            <div class="form_group">
                                <input type="password" class="form_input" name="oldpass" value="<?php echo $_SESSION['forget'][2] ?>" required>
                                <label for="" class="form_label">Old Password</label>
                            </div>
                            <div class="form_group">
                                <input type="password" class="form_input" name="newpass" required>
                                <label for="" class="form_label">New Password</label>
                            </div>
                            <div class="form_group">
                                <input type="password" class="form_input" name="cpass" required>
                                <label for="" class="form_label">Confirm Password</label>
                            </div>
                            <div class="form_group">
                                <input type="submit" name="change" class="form_submit" value="Change">
                            </div>
                            <div class="form_group">
                                <p class="mess-error"></p>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </body>
</html>
