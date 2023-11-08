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
        <title>Delete Product</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="productad-title table-color">Product</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['action']) && ($_GET['action'] == 'del')) {
                        $id = $_GET['id'];
                    } else {
                        $id = 0;
                    }
                    $result = $classer->delProduct($conn, $id);
                    ?>
                    <table class="table table-bordered table-striped table-color">
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>View</th>
                            <th>Quantity</th>
                            <th>Sold</th>
                            <th>Inventory</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tr>
                            <?php
                            $result = $classer->showAllProduct($conn);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['type'] ?></td>
                                    <td><?php echo $row['infor'] ?></td>
                                    <td class="productad-img productad-details"><?php echo $row['details'] ?></td>
                                    <td><?php echo $row['price'] ?> Baht</td>
                                    <td><?php echo $row['view'] ?> <i class="fas fa-eye"></i></td>
                                    <td><?php echo $row['quantity'] ?> Ticket</td>
                                    <td><?php echo $row['sold'] ?> Ticket</td>
                                    <td><?php echo $row['inventory'] ?> Ticket</td>
                                    <td><img class="productad-img" src="<?php echo $row['img'] ?>"></td>
                                    <td class="product-icon"><a class="product-edit" href="productadmin.php?action=edit&id=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a></td>
                                    <td class="product-icon"><a class="product-remove" onclick="alert('Delete Product <?php echo $row['id'] ?> successfully')" href="#deleteproduct.php?action=del&id=<?php echo $row['id'] ?>"><i class="fas fa-trash-alt"></i></a></td> 
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
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
    </body>
</html>
