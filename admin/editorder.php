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
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Edit Order</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">Edit Order</div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <?php
                        if(isset($_POST['update']) && ($_POST['update'])){
                            $name = $_POST['name'];
                            $price = $_POST['price'];
                            $quan = $_POST['quantity'];
                            $st = $_POST['status'];
                            
                            $result = $classer->editOrrder($conn, $_SESSION['id_order'], $st);
                            $query = $classer->editStatus($conn, $_SESSION['id_order'], $name, $price, $quan);
                            echo '<script>alert("Edit Order Successfully")</script>';
                            echo '<script>window.location = "orderadmin.php"</script>';
                        }   
                        
                        ?>
                        <div class="infor-items">
                            <?php
                            if (isset($_GET['action']) && ($_GET['action']) == 'edit') {
                                $id = $_GET['id'];
                                $_SESSION['id_order'] = $id;
                                $result = $classer->showOrderedit($conn, $id);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="name" value="<?php echo $row['productName'] ?>" required>
                                                <label for="" class="form_label">Product Name</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="price" value="<?php echo $row['price'] ?>" required>
                                                <label for="" class="form_label">Price</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="quantity" value="<?php echo $row['quantity'] ?>" required>
                                                <label for="" class="form_label">Quantity</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="text" class="form_input" name="status" value="<?php echo $row['st'] ?>" required>
                                                <label for="" class="form_label">Status</label>
                                            </div>
                                            <div class="form_group">
                                                <input type="submit" name="update" value="Save" class="form_submit">
                                            </div>
                                        </form>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </section>
    </body>
</html>
