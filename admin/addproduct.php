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
        <title>Add Product</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <?php
            if (isset($_POST['create']) && ($_POST['create'])) {
                $proName = $_POST['pro_name'];
                $proInfor = $_POST['pro_infor'];
                $proDetails = $_POST['pro_details'];
                $proType = $_POST['pro_type'];
                $proPrice = $_POST['pro_price'];
                $proQuan = $_POST['pro_quan'];
                $proSold = $_POST['pro_sold'];
                $proInven = $_POST['pro_inven'];
                $proDate = $_POST['pro_date'];
                
                
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
                
                $result = $classer->createNewProduct($conn, $proName, $proInfor, $proDetails, $proType, $proPrice, $proQuan, $proSold, $proInven, $proDate, $img_final);
                echo '<script>alert("Create Product Successfully"); window.location = "productadmin.php";</script>';
            }
            ?>
            <div class="text">Add Product</div>
            <div class="container container-col">
                <div class="col-lg-12">
                    <div class="product-add-items">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <p class="form-product-title">Product</p>
                            <label class="lb-name">Product Name</label><input class="txt-name" name="pro_name" type="text"><label class="lb-name">Time</label><input name="pro_infor" class="txt-name" type="text">
                            <label class="lb-details">Details</label><input class="txt-details" name="pro_details" type="text">
                            <label class="lb-type">Type</label><input class="rd-type" name="pro_type" value="Adult and Children" type="radio"><span class="span-type">Adult and Children</span><input class="rd-type" name="pro_type" value="Adult" type="radio"><span class="span-type">Adult</span><input class="rd-type" name="pro_type" value="Children" type="radio"><span class="span-type">Children</span><br/>
                            <label class="lb-price">Price</label><input name="pro_price" class="txt-price" type="text"> <span class="currency">Baht</span><br/>
                            <label class="lb-quantity">Quantity</label><input name="pro_quan" class="txt-quan" type="number"><label class="lb-sold">Sold</label><input class="txt-sold" name="pro_sold" type="number"><label class="lb-inven">Inventory</label><input class="txt-inven" name="pro_inven" type="number"><br/>
                            <label class="lb-date">Date</label><input name="pro_date" class="txt-date" type="date"><br/>
                            <label class="lb-file">Image</label><input name="imageFiles" class="txt-file" type="file" accept=".png, .jpg, .jpeg"><br/>
                            <input class="btn btn-success btn-subpro" name="create" type="submit" value="CREATE"><input class="btn btn-danger btn-danpro" type="reset" value="CANCEL">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
