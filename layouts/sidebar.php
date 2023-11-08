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
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title></title>
    </head>
    <body>
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <?php
                    if (isset($_SESSION['useradmin']) && ($_SESSION['useradmin'])) {
                        $user = $_SESSION['inforadmin'][0];
                        $pass = $_SESSION['inforadmin'][1];
                        $result = $classer->showUserByID($conn, $user, $pass);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <span class="image">
                                    <a href="information.php"><img id="imager" onchange="chooseFile(this)" src="<?php echo $row['img'] ?>"></a>
                                </span>

                                <div class="text header-text">
                                    <span class="name"><?php echo $row['name'] ?></span>
                                    <span class="profession"><?php echo $row['position'] ?></span>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        $_SESSION['useradmin'] = "Blank";
                    }
                    ?>
                </div>

                <i class="fas fa-chevron-right toggle"></i>
            </header>

            <div class="menu-bar">
                <div class="menu">
                    <li class="search-box">
                        <i class="fas fa-search icon fix-icon"></i>
                        <input id="input" type="text" autocomplete="on" placeholder="Search...">
                    </li>
                    <ul class="menu-links">
                        <li class="nav-link">
                            <a href="homeadmin.php">
                                <i class="fas fa-home icon"></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="add.php">
                                <i class="fas fa-plus icon"></i>
                                <span class="text nav-text">Add</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="productadmin.php">
                                <i class="fas fa-ticket-alt icon"></i>
                                <span class="text nav-text">Product</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="useradmin.php">
                                <i class="fas fa-users icon"></i>
                                <span class="text nav-text">User</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="orderadmin.php">
                                <i class="fas fa-clipboard-check icon"></i>
                                <span class="text nav-text">Order</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="revenue.php">
                                <i class="fas fa-chart-pie icon"></i>
                                <span class="text nav-text">Revenue</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="notifications.php">
                                <i class="fas fa-bell icon"></i>
                                <span class="text nav-text">Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="bottom-content">
                    <li class="nav-link">
                        <a onclick="checkLogout();" href="logoutadmin.php">
                            <i class="fas fa-sign-out-alt icon"></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                    <li class="nav-link mode">
                        <div class="moon-sun">
                            <i class="fas fa-moon icon moon"></i>
                            <i class="fas fa-sun icon sun"></i>
                        </div>
                        <span class="mode-text text">Dark Mode</span>

                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </li>
                </div>
            </div>
        </nav>
        <script src="../js/script.js"></script>
        <script>
                            $('#input').keypress(function (event) {
                                var keycode = (event.keyCode ? event.keyCode : event.which);
                                if (keycode == '13') {
                                    const input = document.getElementById('input').value;
                                    if (input === 'dashboard' || input === 'Dashboard' || input === 'DASHBOARD') {
                                        window.location = 'homeadmin.php';
                                    } else if (input === 'product' || input === 'Product' || input === 'PRODUCT') {
                                        window.location = 'productadmin.php';
                                    } else if (input === 'user' || input === 'User' || input === 'USER') {
                                        window.location = 'useradmin.php';
                                    } else if (input === 'order' || input === 'Order' || input === 'ORDER') {
                                        window.location = 'orderadmin.php';
                                    } else if (input === 'revenue' || input === 'Revenue' || input === 'REVENUE') {
                                        window.location = 'revenue.php';
                                    } else if (input === 'logout' || input === 'Logout' || input === 'LOGOUT') {
                                        window.location = 'logoutadmin.php';
                                    } else if (input === 'information' || input === 'Information' || input === 'INFORMATION') {
                                        window.location = 'information.php';
                                    } else {
                                        alert('No Result');
                                    }
                                }
                            });
        </script>
        <script>
            function chooseFile(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                        $('#images').attr('src', e.target.result);
                        $('#imageFiles').attr('src', e.target.result);
                        $('#imager').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>
    </body>
</html>
