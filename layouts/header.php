<?php
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
        <div id="header">
            <div class="header-menu">
                <img src="" class="header-logo">
                <ul id="nav">
                    <li><a class="margin-menu sub-menu" href="home.php">Home</a></li>
                    <li><a class="sub-menu" href="product.php">Menu</a>
<!--                                                <ul class="subnav">
                                                    <li><a href="#fengshui.html">Feng Shui Trees</a></li>
                                                    <li><a href="#lotustree.html">Stone Lotus</a></li>
                                                    <li><a href="#aquanticplant.html">Aquatic Plant</a></li>
                                                    <li><a href="#convolve.html">Convolve</a></li>
                                                    <li><a href="#officetree.html">Office Tree</a></li>
                                                </ul>-->
                    </li>
                    <li><a class="sub-menu" href="booking.php">Booking</a>
                        <!--                        <ul class="subnav">
                                                    <li><a href="#proplant.html">ProPlant</a></li>
                                                    <li><a href="#goodtrees.html">GoodTrees</a></li>
                                                    <li><a href="#prelotus.html">PreLotus</a></li>
                                                </ul>-->
                    </li>
                    <li><a class="sub-menu" href="aboutus.php">About Us</a></li>
                    <li><a class="sub-menu" href="contact.php">Contact</a></li>
                    
                    <?php
                    if (isset($_SESSION['user']) && ($_SESSION['user'])) {
                        $card = "Shopping Cart";
                        $account = null;
                        echo '<li><a class="sub-menu" href="shoppingcart.php">' . $card . '</a></li><li><a class="user-session" href="information.php">' . $_SESSION['infor'][2] . '</a></li>'
                        . '<a class="icon-logout" href="logout.php"><i class="fas fa-power-off"></i></a>';
                    } else {
                        $account = "Account";
                        $_SESSION['user'] = "";
                    }
                    ?>
                    <li><a class="sub-menu" href="account.php"><?php echo $account?></a></li>
                </ul>
                <div id="mobile-menu" class="mobilemenu">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>

        <script>
            var header = document.getElementById('header');
            var mobileMenu1 = document.getElementById('mobile-menu');
            console.log(mobileMenu1);
            var headerHeight = header.clientHeight;

            //close menu
            mobileMenu1.onclick = function () {
                var isClosed = header.clientHeight === headerHeight;
                if (isClosed) {
                    header.style.height = '300px';
                } else {
                    header.style.height = null;
                }
            }

            //auto close click select
            var menuItems = document.querySelectorAll('#nav li a[href*="#"]');
            for (var i = 0; i < menuItems.length; i++) {
                var menuItem = menuItems[i];

                menuItem.onclick = function () {
                    var isParenMenu = this.nextElementSibling && this.nextElementSibling.classList.contains('subnav');
                    if (isParenMenu) {
                        event.preventDefault();
                    } else {
                        header.style.height = null;
                    }
                }
            }
        </script>
    </body>
</html>
