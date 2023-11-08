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
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Information</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">Information</div>
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <?php
                        if (isset($_POST['update']) && ($_POST['update'])) {
                            $name = $_POST['name'];
                            $pass = $_POST['pass'];
                            $cpass = $_POST['cpass'];
                            $pos = $_POST['position'];
                            $phone = $_POST['phone'];
                            $email = $_POST['email'];
                            $gender = $_POST['gender'];
                            $birth = $_POST['birthday'];
                            $address = $_POST['address'];
                            $user = $_SESSION['inforadmin'][0];

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

                            if ($pass == $cpass) {
                                $result = $classer->updateAdmin($conn, $name, $pass, $pos, $phone, $email, $address, $gender, $birth, $img_final, $user);
                                echo '<script>alert("Update Information Successfully")</script>';
                                echo '<script>window.location = "./information.php"</script>';
                            }else{
                              echo '<script>alert("Password and Confirm Password Not Match")</script>';  
                            }
                        }
                        ?>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                            <?php
                            if (isset($_SESSION['useradmin']) && ($_SESSION['useradmin'])) {
                                $user = $_SESSION['inforadmin'][0];
                                $pass = $_SESSION['inforadmin'][1];
                                $result = $classer->showUserByID($conn, $user, $pass);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="infor-items">

                                            <div class="form_group">
                                                <input type="text" class="form_input" name="name" value="<?php echo $row['name'] ?>" required>
                                                <label for="" class="form_label">Name</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="gender" value="<?php echo $row['gender'] ?>" required>
                                                <label for="" class="form_label">Gender</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="date" class="form_input" name="birthday" value="<?php echo $row['birthday'] ?>" required>
                                                <label for="" class="form_label">Birthday</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="password" class="form_input" name="pass" value="<?php echo $row['password'] ?>" required>
                                                <label for="" class="form_label">Password</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="password" class="form_input" name="cpass" value="<?php echo $row['password'] ?>" required>
                                                <label for="" class="form_label">Confirm Password</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="position" value="<?php echo $row['position'] ?>" required>
                                                <label for="" class="form_label">Position</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="phone" value="<?php echo $row['phone'] ?>" required>
                                                <label for="" class="form_label">Phone</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="email" class="form_input" name="email" value="<?php echo $row['email'] ?>" required>
                                                <label for="" class="form_label">Email</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="address" value="<?php echo $row['address'] ?>" required>
                                                <label for="" class="form_label">Address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="infor-items-img fix-div-img">
                                            <img class="infor-changer-avt" id="images" src="<?php echo $row['img'] ?>">
                                            <input type="file" id="imageFiles" name="imageFiles" onchange="chooseFile(this)" class="btnchangavt" accept=".png, .jpg, .jpeg">
                                            <p class="infor-img-accept">Accept: .JPG, .JPEG, .PNG</p>
                                        </div>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form_group fix-div-btn">
                                <input type="submit" name="update" value="Save" class="form_submit btn-save">
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    function chooseFile(fileInput) {
                        if (fileInput.files && fileInput.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#images').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(fileInput.files[0]);
                        }
                    }
                </script>
            </div>

        </section>
    </body>
</html>
