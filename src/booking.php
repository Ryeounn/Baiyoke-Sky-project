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
        <title>Booking</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="booking">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="booking-title">Booking</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-map">
                            <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Booking</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_POST['booking']) && ($_POST['booking'])){
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $floor = $_POST['floor'];
                        $quan = $_POST['quantity'];
                        $note = $_POST['note'];
                        
                        $booking = array($name,$phone,$email,$floor,$quan,$note, date("Y-d-m"));
                        $_SESSION['booking'] = $booking;
                        echo '<script>alert("Send Booking Information Successfully"); window.location = "booking.php";</script>';
                    }
                    ?>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="form-booking">
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <p class="form-title">Book A Table</p>
                                <div class="form_group">
                                    <input type="text" class="form_input" name="name" required>
                                    <label for="" class="form_label">Full Name</label>
                                </div>
                                <div class="form_group">
                                    <input type="text" class="form_input" name="phone" required>
                                    <label for="" class="form_label">Phone</label>
                                </div>
                                <div class="form_group">
                                    <input type="email" class="form_input" name="email" required>
                                    <label for="" class="form_label">Email</label>
                                </div>
                                <div class="form_group">
                                    <input type="number" class="form_input" name="floor" required>
                                    <label for="" class="form_label">Floor</label>
                                </div>
                                <div class="form_group">
                                    <input type="number" class="form_input" name="quantity" required>
                                    <label for="" class="form_label">Quantity</label>
                                </div>
                                <div class="form_group">
                                    <input type="text" class="form_input" name="note" required>
                                    <label for="" class="form_label">Note</label>
                                </div>
                                <div class="form_group">
                                    <input type="submit" name="booking" value="Send" class="form_submit">
                                </div>
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
    </body>
</html>
