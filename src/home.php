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
        <title>Home</title>
    </head>
    <body>
        <div id="main">
            <?php
            require_once '../layouts/header.php';
            ?>
            <div id="slider">
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="3"></li>
                        <li data-target="#demo" data-slide-to="4"></li>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../img/home/banner-header.png" alt="Los Angeles" class="banner-img">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/home/banner-header1.png" alt="Chicago" class="banner-img">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/home/banner-header2.png" alt="New York" class="banner-img">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/home/banner-header3.png" alt="New York" class="banner-img">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/home/banner-header4.png" alt="New York" class="banner-img">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <i class="carousel-control-prev-icon"></i>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <i class="carousel-control-next-icon"></i>
                    </a>
                </div>
            </div>
            <?php
            $result = $classer->showSelect($conn);
            if ($result->num_rows > 0) {
                ?>
                <div id="advantage">
                    <div class="container">
                        <div class="row">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-3">
                                    <div class="div-advantage">
                                        <i class="<?php echo $row['icon'] ?>"></i>
                                        <p class="advantage-title"><?php echo $row['title'] ?></p>
                                        <p class="advantage-details"><?php echo $row['details'] ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div id="welcome">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <img class="welcome-img" src="../img/home/welcome.png">
                        </div>
                        <div class="col-lg-6">
                            <p class="welcome-title">Welcome to <i class="fas fa-utensils icon-welcome"></i> Restaurant</p>
                            <p class="welcome-description">“Welcome to Restaurant” is a common greeting that customers receive when entering a restaurant, typically followed by a friendly welcome and an invitation to be seated.</p>
                            <p class="welcome-description">This greeting sets the tone for the dining experience, creating a welcoming and hospitable environment that encourages customers to relax and enjoy their meal.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="chef">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="chef-title">Master Chef</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 fix-col">
                            <div class="chef-items1">
                                <p class="chef-content"></p>
                                <p class="chef1-label">Chef David</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="chef-items2">
                                <p class="chef-content"></p>
                                <p class="chef2-label">Chef Hiroshi</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="chef-items3">
                                <p class="chef-content"></p>
                                <p class="chef3-label">Chef Rachanun</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
            $result = $classer->showFood($conn);
            if ($result->num_rows > 0) {
                ?>
                <div id="menu">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="menuhome-title">Special food</p>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-3">
                                    <div class="menu-items">
                                        <img class="menu-img" src="<?php echo $row['img']?>">
                                        <p class="menu-food-title"><?php echo $row['title']?></p>
                                        <p class="menu-source"><b>From: </b><?php echo $row['source']?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <div id="comment">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="comment-items">
                                <p class="comment-title">Comment</p>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                                    <input type="text" class="comment-email" placeholder="Email..."><br>
                                    <input type="text" class="comment-name" placeholder="Name...">
                                    <input type="text" class="comment-number" placeholder="Phone..."><br>
                                    <textarea class="comment-text" placeholder="Comment..." rows="5"></textarea>
                                    <a href="" class="btn btn-primary comment-btn">Send</a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            
            <?php
            require_once '../layouts/footer.php';
            ?>
        </div>
    </body>
</html>
