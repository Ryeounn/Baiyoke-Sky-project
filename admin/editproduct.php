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
        <title>Edit Product</title>
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
                        $infor = $_POST['infor'];
                        $details = $_POST['details'];
                        $type = $_POST['type'];
                        $view = $_POST['view'];
                        $price = $_POST['price'];
                        $quan = $_POST['quan'];
                        $sold = $_POST['sold'];
                        $inven = $_POST['inven'];
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

                        $result = $classer->updateProduct($conn, $name, $infor, $details, $type, $view, $price, $quan, $sold, $inven, $date, $_SESSION['id'], $img_final);
                        echo '<script>alert("Update Product Successfully!")</script>';
                        echo '<script>window.location = "./productadmin.php"</script>';
                    }
                    ?>
                    <div class="col-lg-2"></div>

                    <div class="col-lg-6">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['action']) && ($_GET['action']) == 'edit') {
                                $id = $_GET['id'];
                                $result = $classer->editProductByID($conn, $id);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $_SESSION['id'] = $row['id'];
                                        ?>
                                        <div class="form_group">
                                            <input type="text" class="form_input" name="name" value="<?php echo $row['name'] ?>" required>
                                            <label for="" class="form_label">Name</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="text" class="form_input" name="infor" value="<?php echo $row['infor'] ?>" required>
                                            <label for="" class="form_label">Time</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="text" class="form_input" name="details" value="<?php echo $row['details'] ?>" required>
                                            <label for="" class="form_label">Details</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="text" class="form_input" name="type" value="<?php echo $row['type'] ?>" required>
                                            <label for="" class="form_label">Type</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="number" class="form_input" name="view" value="<?php echo $row['view'] ?>" required>
                                            <label for="" class="form_label">View</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="number" class="form_input" name="price" value="<?php echo $row['price'] ?>" required>
                                            <label for="" class="form_label">Price</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="number" class="form_input" name="quan" value="<?php echo $row['quantity'] ?>" required>
                                            <label for="" class="form_label">Quantity</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="number" class="form_input" name="sold" value="<?php echo $row['sold'] ?>" required>
                                            <label for="" class="form_label">Sold</label>
                                        </div>
                                        <div class="form_group">
                                            <input type="number" class="form_input" name="inven" value="<?php echo $row['inventory'] ?>" required>
                                            <label for="" class="form_label">Inventory</label>
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
                        <?php } ?>
                    <?php } ?>
                <?php } ?>


        </section>
    </body>
</html>
