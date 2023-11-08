<?php
session_start();
ob_start();
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
        <title>Forget Password</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="forget">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="acount-title">Account</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><a class="slide-home" href="account.php"> Account </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Forget Password</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <?php
                        if (isset($_POST['search']) && ($_POST['search'])){
                            $user = $_POST['name'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            
                            $result = $classer->searchAccount($conn, $user, $phone, $email);
                            if($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    $myForget = array($row['id'],$row['username'],$row['password']);
                                    $_SESSION['forget'] = $myForget;
                                    header('location:changepass.php');
                                }
                            }else{
                                $_SESSION['error'] = "404 Not Found Information.";
                            }
                        }
                        ?>
                        <h2 class="signup_heading">Forget Password</h2>
                        <p class="signup_already">Create New Account ? <a href="account.php" class="signup_link signup_link-under">Login</a></p>
                        <form class="signup_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                            <div class="form_group">
                                <input type="text" class="form_input" name="name" required>
                                <label for="" class="form_label">Username</label>
                            </div>
                            <div class="form_group">
                                <input type="email" class="form_input" name="email" required>
                                <label for="" class="form_label">Email</label>
                            </div>
                            <div class="form_group">
                                <input type="number" class="form_input" name="phone" required>
                                <label for="" class="form_label">Phone</label>
                            </div>
                            <div class="form_group">
                                <input type="submit" name="search" class="form_submit" value="Search">
                            </div>
                            <div class="form_group">
                                <p class="mess-error"></p>
                            </div><?php echo $_SESSION['error']?>
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
            <?php 
            require_once '../layouts/footer.php';
            ?>
        </div>
    </body>
</html>
