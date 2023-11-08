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
        <title>Contact</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="contact-title">Contact</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-map">
                            <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> Contact</b>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <?php
                    if(isset($_POST['send']) && ($_POST['send'])){
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $note = $_POST['note'];
                        $result = $classer->addContact($conn, $name, $phone, $email, $note);
                        echo '<script>alert("Send Contact Information Successfully"); window.location = "contact.php";</script>';
                    }
                    ?>
                    <div class="col-lg-6">
                      <div class="form-booking">
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <p class="form-title">Contact Information</p>
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
                                    <input type="text" class="form_input" name="note" required>
                                    <label for="" class="form_label">Note</label>
                                </div>
                                <div class="form_group">
                                    <input type="submit" name="send" class="form_submit" value="Send">
                                </div>
                            </form>
                        </div>  
                    </div>
                    <div class="col-lg-6 margin-map">
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.407723582374!2d100.53781447464378!3d13.754268597237223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ec870c41a2f%3A0xf07222978e9f826f!2sBaiyoke%20Sky%20Hotel!5e0!3m2!1sen!2s!4v1693044638762!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
