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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Revenue</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">Revenue</div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <?php
                        $result = $classer->showRevenue($conn);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="d-items">
                                    <i class="fas fa-signal icon-order"></i>
                                    <span class="order-title">Revenue</span>
                                    <span class="order-number"><?php echo $row['sum(price)'] ?> Baht</span>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        $result = $classer->showBestSeller($conn);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="d-items">
                                    <i class="fas fa-money-bill-alt icon-order"></i>
                                    <span class="order-title">Best Seller F.81</span>
                                    <span class="order-number"><?php echo $row['sum(price)'] ?> Baht</span>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        $result = $classer->showSlow($conn);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="d-items">
                                    <i class="fas fa-arrow-down icon-order"></i>
                                    <span class="order-title">Slowly F.18</span>
                                    <span class="order-number"><?php echo $row['sum(price)'] ?> Baht</span>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="container local-chart">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="">
                                <canvas id="revenue" width="300" height="300"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5">
                            <div class="">
                                <canvas id="quantity" width="300" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="productad-title table-color">Revenue</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-search">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                    <input class="txtSearch" name="search" type="text" placeholder="Search"><input type="submit" name="find" class="btn btn-primary" value="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-striped table-color">
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                            </tr>
                            <tr>
                                <?php
                                if (isset($_POST['find']) && ($_POST['find'])) {
                                    $key = $_POST['search'];
                                } else {
                                    $key = 1;
                                }
                                $result = $classer->showRevenuebyID($conn, $key);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <td><?php echo $row['orderID'] ?></td>
                                        <td><?php echo $row['productName'] ?></td>
                                        <td><?php echo $row['price'] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <script src="../js/revenue.js"></script>
    </body>
</html>
