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
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Order</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">Order</div>
            <div class="container">
                <div class="row">
                    <?php
                    $result = $classer->showOrder($conn);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4">
                                <div class="d-items">
                                    <i class="fas fa-clipboard-list icon-order"></i>
                                    <span class="order-title">Order</span>
                                    <span class="order-number"><?php echo $row['count(orderID)'] ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="col-lg-4">
                        <?php
                        $result = $classer->countOrderDone($conn);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="d-items">
                                    <i class="fas fa-clipboard-check icon-order"></i>
                                    <span class="order-title">Accept Order</span>
                                    <span class="order-number"><?php echo $row['count(st)'] ?> Done</span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="col-lg-4">
                        <?php
                        $result = $classer->countOrderPending($conn);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="d-items">
                                    <i class="fas fa-ticket-alt icon-order"></i>
                                    <span class="order-title">Pending Order</span>
                                    <span class="order-number"><?php echo $row['count(st)'] ?> Pending</span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="container local-chart">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="">
                            <canvas id="ticket" width="300" height="300"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                        <div class="">
                            <canvas id="can" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container local-chart">
                <p class="orderdetails-title table-color">Order Details</p>
                <div class="col-lg-12">
                    <div class="form-search">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <input class="txtSearch" name="search" type="text" placeholder="Search"><input type="submit" name="find" class="btn btn-primary" value="Search">
                        </form>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="table-color">Order ID</th>
                        <th class="table-color">Product Name</th>
                        <th class="table-color">Price</th>
                        <th class="table-color">Quantity</th>
                        <th class="table-color">Status</th>
                        <th class="table-color">Edit</th>
                    </tr>
                    <?php
                    if (isset($_POST['find']) && ($_POST['find'])) {
                        $key = $_POST['search'];
                    } else {
                        $key = 1;
                    }
                    $result = $classer->showOrderDetails($conn, $key);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="table-color"><?php echo $row['orderID'] ?></td>
                                <td class="table-color"><?php echo $row['productName'] ?></td>
                                <td class="table-color"><?php echo $row['price'] ?> Baht</td>
                                <td class="table-color"><?php echo $row['quantity'] ?> Ticket</td>
                                <td class="table-color"><?php echo $row['st'] ?></td>
                                <td class="product-icon"><a href="editorder.php?action=edit&id=<?php echo $row['orderID']?>"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>
            </div>
        </section>
    </body>
    <script src="../js/order.js"></script>
</html>
