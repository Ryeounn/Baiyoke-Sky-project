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
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Detail</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <?php
        if(isset($_SESSION['user']) && ($_SESSION['user'])){
            if (isset($_GET['action']) && ($_GET['action'] == 'add')) {
            $id = intval($_GET["id"]);
            $_SESSION['id_product'] = $id;
            if (isset($_SESSION[$_SESSION['user']][$id])) {
                $_SESSION[$_SESSION['user']][$id]['quantity']++;
            } else {
                $result = $classer->findProductById($conn, $id);
                $row = $result->fetch_assoc();
                if (isset($row['id'])) {
                    $_SESSION[$_SESSION['user']][$row['id']] = array("name" => $row['name'], "quantity" => 1, "price" => $row['price'], "image" => $row['img']);
                }
            }
        }
        }else{
            echo '<script>alert("Please login!")</script>';
            echo '<script>window.location = "./account.php"</script>';
        }
        ?>
        <div id="details">
            <?php
            if (isset($_SESSION[$_SESSION["user"]]) && $_SESSION[$_SESSION["user"]]) {
                $total_quantity = 0;
                $total_price = 0;
                foreach ($_SESSION[$_SESSION["user"]] as $id => $value) {
                    $arrProductID[] = $id;
                }
                $strIDs = implode(",", $arrProductID);
                $result = $classer->findProductById($conn, $strIDs);
                while ($row = $result->fetch_assoc()) {
                    $total_quantity += $row['quantity'];
                    $total_price += $row['price'] * $_SESSION[$_SESSION["user"]][$row['id']]['quantity'];
                }
            }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="detail-title">Detail</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-map">
                            <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><a class="slide-home" href="product.php"> Product </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Detail</b>
                        </div> 
                    </div>
                </div>
                <?php
                $id = $_GET['id'];
                $result = $classer->showDetails($conn, $id);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <img class="detail-img" src="<?php echo $row['img'] ?>">
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-infor">
                                    <div class="margin-items">
                                        <p class="detail-name"><?php echo $row['name'] ?></p>
                                        <p class="detail-time"><b>Time:</b> <?php echo $row['infor'] ?></p>
                                        <p class="detail-type"><b>Type:</b> <?php echo $row['type'] ?></p>
                                        <p class="detail-price"><b>Price:</b> <?php echo $row['price'] ?> Baht</p>
                                        <p class="detail-view"><i class="fas fa-eye icon-view"></i> <?php echo $row['view'] ?></p>
                                        <a class="btn btn-primary btn-addcard" href="details.php?action=add&id=<?php echo $row['id'] ?>"><i class="fas fa-shopping-cart icon-card"></i>Add to card</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="container">
            <?php
            $id = $_GET['id'];
            $result = $classer->showInfor($conn, $id);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="details-title">About <?php echo $row['name'] ?></p>
                            <div class="details-items">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-one-img">
                                            <img class="img-one" src="<?php echo $row['img_one'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-one">
                                            <p class="content-one"><?php echo $row['content_one'] ?></p>
                                            <p class="content-two"><?php echo $row['sub_content'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="details-items-two">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-two">
                                            <p class="contentt-one"><?php echo $row['content_two'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-two-img">
                                            <img class="img-one" src="<?php echo $row['img_two'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="details-items">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-three-img">
                                            <img class="img-one" src="<?php echo $row['img_three'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-three">
                                            <p class="content-one"><?php echo $row['content_three'] ?></p>
                                            <p class="content-two"><?php echo $row['sub_content3'] ?></p>
                                            <p class="content-two"><?php echo $row['sub_sm_content3'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <div id="sub-menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="sub-title">More</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $listproduct = $classer->showSubMenu($conn);
                    foreach ($listproduct as $item) {
                        echo '
                                <div class="col-lg-3">
                                    <div class="product-items">
                                        <img class="product-img" src="' . $item['img'] . '">
                                        <p class="product-name">' . $item['name'] . '</p>
                                        <p class="product-time"><b>Time:</b> ' . $item['infor'] . '</p>
                                        <p class="product-type"><b>Type:</b> ' . $item['type'] . '</p>
                                        <p class="product-price"><b>Price:</b> ' . $item['price'] . ' Baht</p>
                                        <i class="fas fa-eye"></i>' . $item['view'] . '
                                        <a class="btn btn-primary btndetails" href="details.php?action?details&id=' . $item['id'] . '">Details</a>
                                    </div>
                                </div>
                            ';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
