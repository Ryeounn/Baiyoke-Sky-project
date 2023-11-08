<?php
session_start();
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Add User</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <?php
            if (isset($_POST['create']) && ($_POST['create'])) {
                $name = $_POST['name'];
                $user = $_POST['username'];
                $pass = $_POST['password'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $position = $_POST['position'];
                $date = $_POST['date'];
                $birth = $_POST['birth'];
                $gen = $_POST['user_gen'];

                $errror = [];
                $file = $_FILES['imageFiles'];
                $size_allow = 10;
                $filename = $file['name'];
                $filename = explode('.', $filename);
                $ext = end($filename);
                $new_file = md5(uniqid()) . '.' . $ext;
                $allow_ext = ['png', 'jpg', 'jpeg'];
                $img_final = "../img/uploads/" . $new_file;
                if (in_array($ext, $allow_ext)) {
                    $size = $file['size'] / 1024 / 1024;
                    if ($size <= $size_allow) {
                        $upload = move_uploaded_file($file['tmp_name'], '../img/uploads/' . $new_file);
                        if (!$upload) {
                            $errror[] = 'upload_err';
                        }
                    } else {
                        $errror[] = 'size_err';
                    }
                } else {
                    $errror[] = 'ext_err';
                }

                if ($position == 'Manager' || $position == 'Employee') {
                    $role = 1;
                } else {
                    $role = 2;
                }

                $result = $classer->createNewUser($conn, $user, $pass, $name, $gen, $birth, $position, $phone, $email, $address, $role, $date, $img_final);
                echo '<script>alert("Create User Successfully"); window.location = "useradmin.php";</script>';
            }
            ?>
            <div class="text">Add User</div>
            <div class="container container-col">
                <div class="col-lg-12">
                    <div class="product-add-items">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <p class="form-product-title">User</p>
                            <label class="lb-name">Name</label><input class="user_name" name="name" type="text"><label class="lb-quantity">Phone</label><input name="phone" class="user_phone" type="text"><br/>
                            <label class="lb-details">Username</label><input class="user_user" name="username" type="text"><label class="lb-details">Email</label><input class="user_email" name="email" type="text"><br/>
                            <label class="lb-type">Password</label><input class="user_password" name="password"  type="password"><label class="lb-details">Address</label><input class="user_address" name="address" type="text"><br/><br/>
                            <label class="lb-price">Position</label><input name="position" class="user_pos" type="radio" value="Manager"><span class="span-type">Manager</span><input name="position" class="user_pos" type="radio" value="Employee"><span class="span-type">Employee</span><input name="position" class="user_pos" type="radio" value="Customer"><span class="span-type">Customer</span><br/>
                            <label class="lb-price">Gender</label><input name="user_gen" class="user_pos user-gen" type="radio" value="Male"><span class="span-type">Male</span><input name="user_gen" class="user_pos" type="radio" value="Female"><span class="span-type">Female</span><input name="user_gen" class="user_pos" type="radio" value="Other"><span class="span-type">Other</span><br/>
                            <label class="lb-date">Birthday</label><input name="birth" class="user-date user-birth" type="date">
                            <label class="lb-date lb-birth">Date</label><input name="date" class="user-date user-dates" type="date"><br/>
                            <label class="lb-file">Image</label><input name="imageFiles" class="user-file" type="file" accept=".png, .jpg, .jpeg"><br/>
                            <input class="btn btn-success btn-subpro" name="create" type="submit" value="CREATE"><input class="btn btn-danger btn-danpro" type="reset" value="CANCEL">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
