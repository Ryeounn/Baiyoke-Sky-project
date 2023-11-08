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
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Information</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div class="container">
            <div class="row">
                <?php
                $user = $_SESSION['infor'][0];
                $pass = $_SESSION['infor'][1];
                $result = $classer->showUserByID($conn, $user, $pass);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-2">
                            <div class="infor-navbar">
                                <div class="infor-header">
                                    <img class="infor-avt" id="imageFiles" onchange="chooseFile(this)" src="<?php echo $row['img'] ?>"><nav class="infor-name"><?php echo $row['name'] ?></nav>
                                </div>
                                <ul id="infor-list">
                                    <li class="infor-account"><a class="infor-linkacc" href="information.php">My Account</a></li>
                                    <li class="infor-account"><a class="infor-linkor" href="myorder.php">My Order</a></li>
                                    <li><a class="infor-linkor" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="infor-form">
                                <div id="div-load">
                                    <?php
                                    if (isset($_POST['save']) && ($_POST['save'])) {
                                        $user = $_SESSION['infor'][0];
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $phone = $_POST['phone'];
                                        $gender = $_POST['gender'];
                                        $birth = $_POST['birth'];

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

                                        $result = $classer->updateInforUser($conn, $user, $name, $email, $phone, $gender, $birth, $img_final);
                                        echo '<script>alert("Update Information Successfully!")</script>';
                                        echo '<script>window.location = "./information.php";</script>';
                                    }
                                    ?>
                                    <div class="infor-head-items">
                                        <p class="infor-title">My Profile</p>
                                        <p class="infor-subtitle">Manage and protect your account</p>
                                        <div class="infor-linerow"></div>
                                    </div>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="infor-form-items">
                                                    <p class="lbiname">Username</p>
                                                    <p class="lbiname">Name</p>
                                                    <p class="lbiname">Email</p>
                                                    <p class="lbiname">Phone</p>
                                                    <p class="lbiname">Gender</p>
                                                    <p class="lbiname">Birthday</p>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="infor-form-form">
                                                    <p class="txtiuser"><?php echo $row['username'] ?></p>
                                                    <input type="text" name="name" class="txtiname" value="<?php echo $row['name'] ?>"><br/>
                                                    <input type="email" name="email" class="txtiemail" value="<?php echo $row['email'] ?>"><br/>
                                                    <input type="text" name="phone" class="txtiphone" value="<?php echo $row['phone'] ?>"><br/>
                                                    <input type="radio" name="gender" class="txtigender" value="Male"><label class="rdgender">Male</label><input type="radio" name="gender" class="txtigender" value="Female"><label class="rdgender">Female</label><input type="radio" name="gender" class="txtigender" value="Other"><label class="rdgender">Other</label><br/>
                                                    <input type="date" name="birth" class="txtibirth" value="<?php echo $row['birthday'] ?>"><br/>
                                                </div>
                                            </div>
                                            <div class="infor-line-col"></div>
                                            <div class="col-lg-4">
                                                <div class="infor-items-img">
                                                    <img class="infor-changer-avt" id="image" src="<?php echo $row['img'] ?>">
                                                    <input type="file" id="imageFile" name="imageFile" onchange="chooseFile(this)" class="btnchangavt" accept=".png, .jpg, .jpeg">
                                                    <p class="infor-img-accept">Accept: .JPG, .JPEG, .PNG</p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="margin-left">
                                        <input type="submit" name="save" class="btn btn-danger" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
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
            </div>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
