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
        <title>Account</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="acount-title">Account</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-map">
                            <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Account</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <h2 class="signup_heading">Login</h2>
                        <?php
                        if (isset($_POST['login']) && ($_POST['login'])) {
                            $user = $_POST['name'];
                            $pass = $_POST['password'];
                            $result = $classer->checkUser($conn, $user, $pass);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($user == $row['username'] && $pass == $row['password']) {
                                        if ($row['role'] == 1) {
                                            $_SESSION['useradmin'] = $row['username'];
                                            $_SESSION['position'] = $row['position'];
                                            $myInfor = array($row['username'], $row['password'], $row['name'], $row['position'], $row['phone'], $row['email'], $row['address'], $row['role'], $row['date'], $row['img'], $row['id'], $row['gender'], $row['birthday']);
                                            $_SESSION['inforadmin'] = $myInfor;
                                            $_SESSION['error'] = "";
                                            header('location:../admin/homeadmin.php');
                                        } else if ($row['role'] == 2) {
                                            $_SESSION['user'] = $row['username'];
                                            $_SESSION['error'] = "";
                                            $myInfor = array($row['username'], $row['password'], $row['name'], $row['position'], $row['phone'], $row['email'], $row['address'], $row['role'], $row['date'], $row['img'], $row['id'], $row['gender'], $row['birthday']);
                                            $_SESSION['infor'] = $myInfor;
                                            header('location:home.php');
                                        } else if ($row['role'] == 0) {
                                            header('location:home.php');
                                        }
                                    }
                                }
                            } else {
                                $_SESSION['error'] = "Login Fail. Account don't exist. (404 Not Found Account). Contact: 0707181293 for support.";
                            }
                        } else {
                            $_SESSION['error'] = "";
                        }
                        ?>
                        <p class="signup_alreadynew">New Account ? <a href="create.php" class="signup_link signup_link-under">Create Account</a></p>
                        <form class="signup_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginForm">
                            <div class="form_group--2 local_btn-log">
                                <button class="btn btn-danger btn-gg"><i class="fa-brands fa-google"></i>&nbsp;Sign In with Google</button>
                                <button class="btn btn-primary btn-gg"><i class="fa-brands fa-twitter"></i>&nbsp;Sign In with Twitter</button>
                            </div>
                            <div class="form_group">
                                <input type="text" class="form_input"name="name" required="true">
                                <label for="" class="form_label">Username</label>
                            </div>
                            <div class="form_group">
                                <input type="password" class="form_input" name="password" required="true" autocomplete="false">
                                <label for="" class="form_label">Password</label>
                            </div>
                            <p class="signup_already">Forget Password ? <a href="forget.php" class="signup_link signup_link-under">Forget Password</a></p>
                            <div class="form_group">
                                <input type="submit" name="login" class="form_submit form_submit-text" value="Login">
                            </div>
                            <div class="form_group">
                                <p class="mess-error"><?php echo $_SESSION['error'] ?></p>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>

    </body>
</html>
