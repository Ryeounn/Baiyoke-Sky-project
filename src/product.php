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
        <title>Product</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="product-title">Product</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-map">
                            <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Product</b>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <ul id="product-list">
                            <li class="first-li"><a href="product.php?action?product&id=0" class="first-list"><i class="fas fa-building"></i>Floor</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=1" class="second-list"><i class="fas fa-arrow-circle-right"></i>Floor 18</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=2" class="second-list"><i class="fas fa-arrow-circle-right"></i>Floor 75</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=3" class="second-list"><i class="fas fa-arrow-circle-right"></i>Floor 76</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=4" class="second-list"><i class="fas fa-arrow-circle-right"></i>Floor 79</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=5" class="second-list"><i class="fas fa-arrow-circle-right"></i>Floor 81</a></li>
                            <li class="first-li"><a href="product.php?action?product&id=6" class="first-list"><i class="fas fa-wallet"></i>Price</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=7" class="second-list"><i class="fas fa-arrow-circle-right"></i><500 Baht</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=8" class="second-list"><i class="fas fa-arrow-circle-right"></i><1000 Baht</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=9" class="second-list"><i class="fas fa-arrow-circle-right"></i><1500 Baht</a></li>
                            <li class="second-li"><a href="product.php?action?product&id=10" class="second-list"><i class="fas fa-arrow-circle-right"></i>>1500 Baht</a></li>
                        </ul>
                    </div> 
                    <div class="col-lg-9">
                        <div class="row">
                            <?php
                            if(isset($_GET['id']) && ($_GET['id']) > 0){
                                $iddm = $_GET['id'];
                            }else{
                                $iddm = 0;
                            }
                            $listproduct = $classer->showProduct($conn, $iddm);
                            foreach ($listproduct as $item) {
                                echo '
                                <div class="col-lg-4">
                                    <div class="product-items">
                                        <img class="product-img" src="' . $item['img'] . '">
                                        <p class="product-name">'.$item['name'].'</p>
                                        <p class="product-time"><b>Time:</b> '.$item['infor'].'</p>
                                        <p class="product-type"><b>Type:</b> '.$item['type'].'</p>
                                        <p class="product-price"><b>Price:</b> '.$item['price'].' Baht</p>
                                        <i class="fas fa-eye"></i>'.$item['view'].'
                                        <a class="btn btn-primary btndetails" href="details.php?action?details&id='.$item['id'].'">Details</a>
                                    </div>
                                </div>
                            ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once '../layouts/footer.php';
            ?>
    </body>
</html>
