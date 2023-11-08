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
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Edit User</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">Edit Product</div>
            <div class="container">
                <div class="row">
                    <?php
                    if (isset($_POST['update']) && ($_POST['update'])) {
                        $name = $_POST['name'];
                        $pos = $_POST['pos'];
                        $gender = $_POST['gender'];
                        $pass = $_POST['pass'];
                        $birth = $_POST['birthday'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $date = $_POST['date'];
                        
                        $errror = [];
                        $file = $_FILES['imageFile'];
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

                        $result = $classer->updateUser($conn, $name, $pos, $gender, $pass, $birth, $phone, $email, $address, $date, $_SESSION['id_user'], $img_final);
                        echo '<script>alert("Update User Successfully!")</script>';
                        echo '<script>window.location = "./useradmin.php"</script>';
                    }
                    ?>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['action']) && ($_GET['action']) == 'edit') {
                                $id = $_GET['id'];
                                $result = $classer->editUserByID($conn, $id);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $_SESSION['id_user'] = $row['id'];
                                        ?>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="name" value="<?php echo $row['name'] ?>" required>
                                                <label for="" class="form_label">Name</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="pos" value="<?php echo $row['position'] ?>" required>
                                                <label for="" class="form_label">Position</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="gender" value="<?php echo $row['gender'] ?>" required>
                                                <label for="" class="form_label">Gender</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="password" class="form_input" name="pass" value="<?php echo $row['password'] ?>" required>
                                                <label for="" class="form_label">Password</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="date" class="form_input" name="birthday" value="<?php echo $row['birthday'] ?>" required>
                                                <label for="" class="form_label">Birthday</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="phone" value="<?php echo $row['phone'] ?>" required>
                                                <label for="" class="form_label">Phone</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="email" value="<?php echo $row['email'] ?>" required>
                                                <label for="" class="form_label">Email</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="address" value="<?php echo $row['address'] ?>" required>
                                                <label for="" class="form_label">Address</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="date" class="form_input" name="date" value="<?php echo $row['date'] ?>" required>
                                                <label for="" class="form_label">Date</label>
                                            </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="infor-items-img margin-left-img">
                                        <img class="infor-changer-avt" id="image" src="<?php echo $row['img'] ?>">
                                        <input type="file" id="imageFile" name="imageFile" onchange="chooseFile(this)" class="btnchangavt" accept=".png, .jpg, .jpeg">
                                        <p class="infor-img-accept">Accept: .JPG, .JPEG, .PNG</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form_group">
                                        <input type="submit" name="update" value="Save" class="form_submit">
                                    </div>
                                </div>
                            </div>
                            </form>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                        <script>
                                function chooseFile(fileInput) {
                                    if (fileInput.files && fileInput.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#image').attr('src', e.target.result);
                                            $('#imageFiles').attr('src', e.target.result);
                                        }
                                        reader.readAsDataURL(fileInput.files[0]);
                                    }
                                }
                            </script>
            </div>
        </div>
    </section>
</body>
</html>
