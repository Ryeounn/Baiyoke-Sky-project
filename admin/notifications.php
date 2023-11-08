<?php
session_start();
ob_start();
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Notification</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <section class="home">
            <div class="text">Notification</div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="noti-user">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="new-user">New User</p>
                                    <p class="new-title">System users increase every day</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    $result = $classer->countID($conn);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $total_records = $row['count(id)'];
                                        }
                                    }
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $limit = 5;

                                    $total_page = ceil($total_records / $limit);

                                    if ($current_page > $total_page) {
                                        $current_page = $total_page;
                                    } else if ($current_page < 1) {
                                        $current_page = 1;
                                    }

                                    $start = ($current_page - 1) * $limit;
                                    $query = $classer->showPara($conn, $start, $limit);
                                    if ($query->num_rows > 0) {
                                        while ($rows = $query->fetch_assoc()) {
                                            $query2 = $classer->showImg($conn, $rows['username']);
                                            if ($query2->num_rows > 0) {
                                                while ($row = $query2->fetch_assoc()) {
                                                    ?>
                                                    <div class="notinew-items">
                                                        <p class="noti-date"><i class="far fa-clock"></i> <?php echo $rows['date'] ?></p>
                                                        <nav class="noti-noti"><?php echo $rows['id'] ?>. User <b><?php echo $rows['username'] ?></b> registered <?php echo $rows['st'] ?>.</nav>
                                                        <img class="noti-imgs" src="<?php echo $row['img'] ?>">
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <ul class="pagination">
                                        <?php
                                        if ($current_page > 1 && $total_page > 1) {
                                            echo '<a href="notifications.php?page=' . ($current_page - 1) . '"><i class="fas fa-step-backward"></i></a>';
                                        }

                                        for ($i = 1; $i <= $total_page; $i++) {
                                            if ($i == $current_page) {
                                                echo '<nav class="page">' . $i . ' | </nav>';
                                            } else {
                                                echo '<a href="notifications.php?page=' . $i . '">' . $i . ' | </a> ';
                                            }
                                        }

                                        if ($current_page < $total_page && $total_page > 1) {
                                            echo '<a href="notifications.php?page=' . ($current_page + 1) . '"><i class="fas fa-step-forward"></i></a>  ';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="noti-user">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="new-user">New Booking</p>
                                    <p class="new-title">Book a table in advance for more attentive service</p>
                                    <?php
                                    if (isset($_SESSION['booking'])) {
                                        ?>
                                        <div class="notinew-booking">
                                            <p class="noti-date"><i class="far fa-clock"></i><?php echo $_SESSION['booking'][6] ?></p>
                                            <span class="noti-noti">Name: <b><?php echo $_SESSION['booking'][0] ?></b></span><span class="noti-noti">Email: <b><?php echo $_SESSION['booking'][2] ?></b></span>
                                            <br/><p class="noti-booking">Booking: floor <b><?php echo $_SESSION['booking'][3] ?></b> - <b><?php echo $_SESSION['booking'][4] ?> ticket</b></p><img class="noti-img" src="../img/user/user.png">
                                            <p class="noti-note">Note: <?php echo $_SESSION['booking'][4] ?></p>
                                            <a class="noti-check" href="notifications.php?action=booking"><i class="fas fa-check-circle icon-check"></i></a><a class="noti-close" href="notifications.php?action=delete"><i class="fas fa-times-circle icon-close"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (isset($_GET['action']) && ($_GET['action'] == 'booking')) {
                            $name = $_SESSION['booking'][0];
                            $phone = $_SESSION['booking'][1];
                            $email = $_SESSION['booking'][2];
                            $floor = $_SESSION['booking'][3];
                            $quan = $_SESSION['booking'][4];
                            $note = $_SESSION['booking'][5];
                            $date = $_SESSION['booking'][6];
                            $result = $classer->addBooking($conn, $name, $phone, $email, $floor, $quan, $note, $date);
                            if ($result == true) {
                                unset($_SESSION['booking']);
                                header('location: notifications.php');
                            }
                        } else if (isset($_GET['action']) && ($_GET['action'] == 'delete')) {
                            unset($_SESSION['booking']);
                            header('location: notifications.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="productad-title table-color">Booking</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-color table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Floor</th>
                                <th>Quantity</th>
                                <th>Note</th>
                                <th>Date</th>
                            </tr>
                            <?php
                            $result = $classer->showBooking($conn);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>0<?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['floor'] ?></td>
                                        <td><?php echo $row['quantity'] ?></td>
                                        <td><?php echo $row['notes'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="productad-title table-color">Contact</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-color table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Note</th>
                            </tr>
                            <?php
                            $result = $classer->showContact($conn);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>0<?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['note'] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </body>
</html>
