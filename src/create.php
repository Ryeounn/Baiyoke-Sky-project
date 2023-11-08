<?php
session_start();
ob_start();
require_once '../dbconnect.php';
require_once '../Classes.php';
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
        <title>Create Account</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="create">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="acount-title">Account</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><a class="slide-home" href="account.php"> Account </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Create</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <?php
                        if (isset($_POST['create']) && ($_POST['create'])) {
                            $name = $_POST['name'];
                            $phone = $_POST['phone'];
                            $email = $_POST['email'];
                            $user = $_POST['user'];
                            $pass = $_POST['pass'];
                            $address = $_POST['address'];
                            $result = $classer->checkAccount($conn, $user);
                            if ($result->num_rows > 0) {
                                    echo '<script>alert("The account already exists on the system")</script>';
                            } else if ($result->num_rows == 0) {
                                $result = $classer->createUser($conn, $name, $phone, $email, $user, $pass, $address);
                                echo '<script>alert("Create successfully")</script>';
                                header('location: account.php');
                            }else{
                                
                            }
                        }else{
                            
                        }
                        ?>
                        <h2 class="signup_heading">Create Account</h2>
                        <p class="signup_already">Already have an account ? <a href="account.php" class="signup_link signup_link-under">Login</a></p>
                        <form class="signup_form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return checkInfor()">
                            <div class="form_group">
                                <input type="text" class="form_input" name="name" id="f_name" required>
                                <label for="" class="form_label">Full Name</label>
                            </div>
                            <div class="form_group">
                                <input type="text" class="form_input" name="phone" id="phone" required>
                                <label for="" class="form_label">Phone</label>
                            </div>
                            <div class="form_group">
                                <input type="email" class="form_input" name="email" id="txtemail" required>
                                <label for="" class="form_label">Email</label>
                            </div>
                            <div class="form_group">
                                <input type="text" class="form_input" name="user" id="user" required>
                                <label for="" class="form_label">Username</label>
                            </div>
                            <div class="form_group">
                                <input type="password" class="form_input" name="pass" id="txtpass" required>
                                <label for="" class="form_label">Password</label>
                            </div>
                            <div class="form_group">
                                <input type="password" class="form_input" id="txtcpass" required>
                                <label for="" class="form_label">Confirm Password</label>
                            </div>
                            <div class="form_group">
                                <input type="text" class="form_input" name="address" id="address" required>
                                <label for="" class="form_label">Address</label>
                            </div>
                            <div class="form_group">
                                <input type="submit" name="create" class="form_submit" value="Sign Up">
                            </div>
                            <div class="form_group">
                                <input type="checkbox" name="" id="ckcheck">
                                <label for="ckcheck">I have read and agree to the <a href="policy.php" class="signup_link signup_link-under">Term of Service</a></label>
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
        <script>
            function checkInfor() {
                var fi_name = document.getElementById('f_name').value;
                var la_name = document.getElementById('phone').value;
                var g_mail = document.getElementById('txtemail').value;
                var user = document.getElementById('user').value;
                var passW = document.getElementById('txtpass').value;
                var cpassW = document.getElementById('txtcpass').value;
                var address = document.getElementById('address').value;
                var filter = /^[a-zA-Z0-9_\.\-]+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (fi_name == '' || fi_name == null) {
                    alert('Please Enter First Name!');
                    document.getElementById('f_name').focus();
                    return false;
                } else {
                    if (phone == '' || phone == null) {
                        alert('Please Enter Last Name!');
                        document.getElementById('l_name').focus();
                        return false;
                    }
                    ;
                    if (g_mail == '' || g_mail == null) {
                        alert('Please Enter Email!');
                        document.getElementById('txtemail').focus();
                        return false;
                    } else {
                        if (!filter.test(g_mail)) {
                            alert('Invalid email. Please re-enter!');
                            document.getElementById('txtemail').focus();
                            return false;
                        }
                        ;
                    }
                    ;
                    if (user == '' || user == null) {
                        alert('Please Enter Username!');
                        document.getElementById('user').focus();
                        return false;
                    }
                    ;
                    if (passW == '' || passW == null) {
                        alert('Please Enter Password!');
                        document.getElementById('txtpass').focus();
                        return false;
                    } else {
                        if (passW.length < 8) {
                            alert('Password must not be less than 8 characters');
                            document.getElementById('txtpass').focus();
                            return false;
                        }
                        ;
                    }
                    ;
                    if (cpassW == '' || cpassW == null) {
                        alert('Please Enter Confirm Password!');
                        document.getElementById('txtcpass').focus();
                        return false;
                    } else {
                        if (passW !== cpassW) {
                            alert('Confirm Password must be same as Password');
                            document.getElementById('txtpass').focus();
                            return false;
                        }
                        ;
                    }
                    ;
                    if (address == '' || address == null) {
                        alert('Please Enter Address!');
                        document.getElementById('address').focus();
                        return false;
                    }
                    ;
                    if (!document.getElementById('ckcheck').checked) {
                        alert('Empty cells need to be checked!');
                        return false;
                    }
                    ;
                }
                return true;
            }
            ;
        </script>
    </body>
</html>
