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
        <title>User</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">User</div>
            <div class="container">
                <div class="row">
                    <?php
                    $result = $classer->showAllUser($conn);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4">
                                <div class="d-items">
                                    <i class="fas fa-users icon-order"></i>
                                    <span class="order-title">User</span>
                                    <span class="order-number"><?php echo $row['count(id)'] ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php
                    $result = $classer->showCustomerUser($conn);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4">
                                <div class="d-items">
                                    <i class="fas fa-user-tie icon-order"></i>
                                    <span class="order-title">Customer</span>
                                    <span class="order-number"><?php echo $row['count(id)'] ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php
                    $result = $classer->showAdminUser($conn);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4">
                                <div class="d-items">
                                    <i class="fas fa-user-cog icon-order"></i>
                                    <span class="order-title">Admin</span>
                                    <span class="order-number"><?php echo $row['count(id)'] ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="row line-row">
                    <div class="col-lg-5">
                        <canvas class="canvas-size" id="user"></canvas>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                        <canvas class="canvas-size" id="date"></canvas>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="productad-title table-color">User</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-search">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                <input class="txtSearch" name="search" type="text" placeholder="Search"><input type="submit" name="find" class="btn btn-primary" value="Search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <?php
                if (isset($_GET['action']) && ($_GET['action'] == 'del')) {
                    $id = $_GET['id'];
                } else {
                    $id = 0;
                }
                $result = $classer->delUser($conn, $id);
                ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-striped table-color">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <tr>
                                <?php
                                if (isset($_POST['find']) && ($_POST['find'])) {
                                    $key = $_POST['search'];
                                } else {
                                    $key = 1;
                                }
                                $result = $classer->showUser($conn, $key);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['position'] ?></td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><img class="img-table" src="<?php echo $row['img'] ?>"></td>
                                        <td class="product-icon"><a class="product-edit" href="edituser.php?action=edit&id=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
                                        <td class="product-icon"><a class="product-remove" onclick="alert('Delete Product <?php echo $row['id'] ?> successfully')" href="useradmin.php?action=del&id=<?php echo $row['id'] ?>"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <script>
        $(function () {
            $("body").on("click", "a", function () {
                var att = $(this).attr("href");
                var filter = att.slice(1, att.length);
                console.log(filter);
                $("#div-load").load(filter);
            });
        });
    </script>
    <script src="../js/line.js"></script>
</body>
</html>
