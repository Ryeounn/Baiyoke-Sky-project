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
        <title>About Us</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="aboutus">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="about-title">About Us</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slide-map">
                            <a class="slide-home" href="home.php">Home </a><i class="fas fa-angle-double-right"></i><b class="slide-local"> About Us</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-gr">
                            <img class="about-img" src="../img/about/1.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="abcontent">
                            <p class="about-intro">Introduction</p>
                            <p class="about-content">This is considered an extremely ideal destination when experiencing cheap Thailand travel. This 88-storey building was completed in 1997. Baiyoke Sky is 309m high with 673 extremely classy and comfortable hotel rooms. This building is located on Ratchaprarop Road in Pratu area, in Ratchathewi district. This famous attraction in Thailand takes about 25 minutes to drive to Suvarnabhumi airport and only 5 minutes to walk to Rachaprarop train station. Baiyoke Sky building entrance fee is about 700-1000 baths.</p>
                        </div>
                    </div>
                </div>
                <div class="row margin-top">
                    <div class="col-lg-6">
                        <div class="abcontent">
                            <p class="about-dub">Dubbed the tallest building in Thailand</p>
                            <p class="about-content2">The tallest building in Thailand, Baiyoke Sky, owns a system of restaurants, bars, and shopping malls ready to serve all the needs of visitors. Not only that, visitors can also enjoy the panoramic view of Bangkok city when standing on the top floor of Baiyoke Sky building. This place is equipped with a modern rotating system to help tourists see the whole beautiful city.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-gr">
                            <img class="about-img" src="../img/about/2.jpg">
                        </div>
                    </div>
                </div>
                <div class="row margin-top">
                    <div class="col-lg-6">
                        <div class="about-gr">
                            <img class="about-img" src="../img/about/3.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="abcontent">
                            <p class="about-dub">Move to Baiyoke Sky</p>
                            <p class="about-content2">By taxi/tuktuk: In Bangkok, there are several buildings named Baiyoke. Therefore, you must clearly tell the driver to take you to Baiyoke Sky Tower or Baiyoke Tower II.</p>
                            <p class="about-content2">By train: You move to Phaya Thai BTS station, get off the train to the Airport Rail Link line, stop at Ratchaprarop station and then walk into Baiyoke Sky Tower.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="abcontent">
                            <p class="about-dub">Note when using the service</p>
                            <p class="about-content2"><i class="fas fa-comment"></i>For holidays such as Western New Year December 31 & January 1, Valentine's Day February 14, Songkran New Year April 13, Mother's Day August 12, Loy Krathong festival, Father's Day December 5, Christmas Day December 24-25, and some other holidays, ticket prices will change, so you need to check the price before choosing a restaurant to dine.</p>
                            <p class="about-content2"><i class="fas fa-comment"></i>After eating buffet at Baiyoke Sky, don't rush to leave Baiyoke Tower, remember to stop by the Observation Deck on floors 77 & 84 and feel free to visit and admire the panoramic view of Bangkok from above.</p>
                            <p class="about-content2"><i class="fas fa-comment"></i>When visiting Baiyoke Observation Deck, this is a non-smoking, no chewing gum area, please dress politely and follow the instructions of your guide and security. All to ensure you have a complete and enjoyable tour.</p>
                            <p class="about-content2"><i class="fas fa-comment"></i>If you eat Buffet at Baiyoke Sky on floors 75, 76 and 78, please note that the "allowed" dining time is only 1.5 hours (90 minutes) from the time you start eating, this is to ensure Make sure the restaurant still has enough space for the diners to come later.</p>
                            <p class="about-content2"><i class="fas fa-comment"></i>In addition, you can freely visit and shop at shopping malls near Baiyoke Sky building such as Central World, Siam Paragon...</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-gr1">
                            <img class="about-img" src="../img/about/4.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    require_once '../layouts/footer.php';
            ?>
    </body>
</html>
